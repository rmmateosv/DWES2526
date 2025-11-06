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
            $host=getenv('RDS_HOST');
            $puerto=getenv('RDS_PUERTO');
            $bd=getenv('RDS_BD');
            $us=getenv('RDS_USUARIO');
            $ps=getenv('RDS_PS');
            if(!$host || !$puerto || !$bd || !$us || !$ps){
                throw new Exception('Rellena variables de entorno con las credenciales de acceso');
            }
            
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
}
?>