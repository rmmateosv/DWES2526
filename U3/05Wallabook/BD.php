<?php
require_once 'Usuarios.php';
require_once 'Libros.php';
require_once 'Mensajes.php';
require_once 'S3.php';
class BD{
    private $conexion=null;

    public function __construct()
    {
        //Conexión con la BD
        try {
            //Recuperamos datos de conexión de variables de entorno del sistema
            $host=getenv('RDS_HOST');
            $puerto=getenv('RDS_PUERTO');
            $bd=getenv('RDS_BD');
            $us=getenv('RDS_USUARIO');
            $ps=getenv('RDS_PS');
            if(!$host || !$puerto || !$bd || !$us || !$ps){
                throw new Exception('Rellena variables de entorno con las credenciales de acceso');
            }
            $url = 'mysql:host='.$host.";port=$puerto;dbname=$bd";
            //$url = 'mysql:host='.$host.';port='.$puerto.';dbname='.$bd;
            $this->conexion = new PDO($url,$us,$ps);
        } 
        catch(PDOException $e){
            global $error;
            $error = 'ERROR BD'.$e->getMessage();
        }
        catch (\Throwable $th) {
            global $error;
            $error = 'ERROR GENÉRCO'.$th->getMessage();
        }
    }
    public function login($email, $ps){
        $resultado=null;
        try {
            //Select para comprobar si hay un registro con ese email y esa contraseña
            $consulta = $this->conexion->prepare('SELECT * from usuarios 
                where email=? and ps=sha2(?,512)');
            $params = array($email,$ps);
            //Ejecutar la consulta pasando los parámetros que sustituye a las ?
            //execute: Devuelve true si el select se ejecuta, pero eso 
            //no quiere decir que el select devuelva algún registro.
            if($consulta->execute($params)){
                //Comprobar si el select ha encontrado el usuario por email y ps
                if($fila=$consulta->fetch()){
                    //Los datos son correctos, se encuentra un usuario
                    $resultado = new Usuarios($fila['id'],$fila['email'],$fila['nombre'],$fila['perfil']);
                }
            }
        } catch(PDOException $e){
            global $error;
            $error = 'ERROR BD'.$e->getMessage();
        }
        catch (\Throwable $th) {
            global $error;
            $error = 'ERROR GENÉRCO'.$th->getMessage();
        }
        return $resultado;
    }
    public function crearUsuario(Usuarios $us, $ps){
        $resultado = false;
        try {
            //Consulta INSERT con parámetros
            $consulta = $this->conexion->prepare('INSERT into usuarios 
                            values(default,?,sha2(?,512),?,?)');
            $params=array($us->getEmail(),$ps,$us->getNombre(),$us->getPerfil());
            if($consulta->execute($params)){
                //Comprobar si se ha insertado realmente
                if($consulta->rowCount()==1){
                    //REcuperar el id del registro insertado y ponerlo en $us
                    $us->setId($this->conexion->lastInsertId());
                    $resultado=true;
                }
            }
        } catch(PDOException $e){
            global $error;
            $error = 'ERROR BD'.$e->getMessage();
        }
        catch (\Throwable $th) {
            global $error;
            $error = 'ERROR GENÉRCO'.$th->getMessage();
        }
        return $resultado;
    }
    public function obtenerUsuario($email){
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare('SELECT * from usuarios 
                        where email = ?');
            $params = array($email);
            if($consulta->execute($params)){
                if($fila=$consulta->fetch()){
                    $resultado = new Usuarios($fila['id'],$fila['email'],
                    $fila['nombre'],$fila['perfil']);
                }
            }
        } catch(PDOException $e){
            global $error;
            $error = 'ERROR BD'.$e->getMessage();
        }
        catch (\Throwable $th) {
            global $error;
            $error = 'ERROR GENÉRCO'.$th->getMessage();
        }

        return $resultado;
    }
    public function crearLibro(Libros $libro){
        $resultado=false;
        try {
            //Crear el libro
            $rutaS3= $libro->getVendedor().'/'.$libro->getFechaC().$libro->getCarpetaS3fotos()['name'];
            $consulta = $this->conexion->prepare('INSERT into libros values 
            (default,?,?,?,?,?,?,?,?,?,null)');
            $params = array($libro->getFechaC(),
                            $libro->getIsbn(),
                            $libro->getTitulo(),
                            $libro->getAutor(),
                            $libro->getDescripcion(),
                            $rutaS3,
                            $libro->getEstado(),
                            $libro->getPrecio(),
                            $libro->getVendedor());
            if($consulta->execute($params) && $consulta->rowCount()==1){
                //Rellenar el id del libro
                $libro->setId($this->conexion->lastInsertId());
                //Subir la foto a S3
                $s3 = new S3();
                if($s3->cargarObjeto($libro->getCarpetaS3fotos()['tmp_name'],$rutaS3)){
                    $resultado=true;
                }
                else{
                    //SI NO SE SUBE LA FOTO, BORRAMOS EL LIBRO
                    $consulta=$this->conexion->prepare('DELETE from libros where id=?');
                    $params=array($libro->getId());
                    if($consulta->execute($params) && $consulta->rowCount()==1){
                        $error='Error, libro no creado porque no se ha podido subir la foto';
                    }
                    else{
                        //No ha subido foto y libro está creado
                        $error='Error, libro se ha creado, pero no se ha podido subir la foto';
                    }
                }
                
            }
            
        }  catch(PDOException $e){
            global $error;
            $error = 'ERROR BD'.$e->getMessage();
        }
        catch (\Throwable $th) {
            global $error;
            $error = 'ERROR GENÉRCO'.$th->getMessage();
        }
        return $resultado;
    }
    public function obtenerMisLibros($idUsuario){
        $resultado = array();
        try {
            $consulta = $this->conexion->prepare('SELECT * from libros where vendedor = ?');
            $params =  array($idUsuario);
            if($consulta->execute($params)){
                while($fila=$consulta->fetch()){
                    $resultado[]=new Libros($fila['id'],
                    $fila['fechaC'],
                    $fila['isbn'],
                    $fila['titulo'],
                    $fila['autor'],
                    $fila['descripcion'],
                    $fila['carpetaS3Fotos'],
                    $fila['estado'],
                    $fila['precio'],
                    $fila['vendedor'],
                    $fila['comprador']);
                }
            }
        } catch(PDOException $e){
            global $error;
            $error = 'ERROR BD'.$e->getMessage();
        }
        catch (\Throwable $th) {
            global $error;
            $error = 'ERROR GENÉRCO'.$th->getMessage();
        }
        return $resultado;
    }
    public function obtenerLibro($id){
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare('SELECT * from libros where id = ?');
            $params=array($id);
            if($consulta->execute($params)){
                if($fila=$consulta->fetch()){
                    $resultado = new Libros($fila['id'],
                                                $fila['fechaC'],
                                                $fila['isbn'],
                                                $fila['titulo'],
                                                $fila['autor'],
                                                $fila['descripcion'],
                                                $fila['carpetaS3Fotos'],
                                                $fila['estado'],
                                                $fila['precio'],
                                                $fila['vendedor'],
                                                $fila['comprador']);
                }
            }
        } 
         catch(PDOException $e){
            global $error;
            $error = 'ERROR BD'.$e->getMessage();
        }
        catch (\Throwable $th) {
             global $error;
            $error = 'ERROR GENÉRCO'.$th->getMessage();
        }

        return $resultado;
    }
    public function borrarLibro($id){
        $resultado = false;
        try {
            $consulta = $this->conexion->prepare('DELETE from libros where id = ?');
            $params=array($id);
            if($consulta->execute($params) && $consulta->rowCount()==1){
                $resultado = true;
            }
        } 
         catch(PDOException $e){
            global $error;
            $error = 'ERROR BD'.$e->getMessage();
        }
        catch (\Throwable $th) {
             global $error;
            $error = 'ERROR GENÉRCO'.$th->getMessage();
        }

        return $resultado;
    }
    /**
     * Get the value of conexion
     */ 
    public function getConexion()
    {
        return $this->conexion;
    }

    /**
     * Set the value of conexion
     *
     * @return  self
     */ 
    public function setConexion($conexion)
    {
        $this->conexion = $conexion;

        return $this;
    }
}
?>