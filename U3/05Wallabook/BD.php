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
        try {
            //Select para comprobar si hay un registro con ese email y esa contraseña
            $consulta = $this->conexion->prepare('SELECT * from usuarios 
                where email=? and ps=sha2(?,512)');
        } catch(PDOException $e){
            global $error;
            $error = 'ERROR BD'.$e->getMessage();
        }
        catch (\Throwable $th) {
            global $error;
            $error = 'ERROR GENÉRCO'.$th->getMessage();
        }
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