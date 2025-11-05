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