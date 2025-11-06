<?php
require_once 'BD.php';

//Crear conexión a la BD
$bd = new BD();
if($bd->getConexion()!=null){
   $mensaje = 'Conecta.....';
}
?>