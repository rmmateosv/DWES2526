<?php
require_once 'Usuarios.php';
require_once 'Libros.php';
require_once 'Mensajes.php';

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