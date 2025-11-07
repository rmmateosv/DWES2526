<?php
require_once 'BD.php';

//Crear conexión a la BD
$bd = new BD();
if($bd->getConexion()!=null){
   $mensaje = 'Conecta.....';
   if(isset($_POST['iniciar'])){
      //comprobaciones
      if(empty($_POST['email']) || empty($_POST['ps'])){
         $error='Rellena datos de acceso';
      }
      else{
         $u=$bd->login($_POST['email'],$_POST['ps']);
         if($u==null){
            $error=(isset($error)?'Excepción'.$error:'Error en el acceso');
         }
         else{
            $mensaje = 'Login correcto';
         }
      }
   }
}
?>