<?php
require_once 'BD.php';

//Crear conexión a la BD
$bd = new BD();
if ($bd->getConexion() != null) {
   if (isset($_POST['iniciar'])) {
      //comprobaciones
      if (empty($_POST['email']) || empty($_POST['ps'])) {
         $error = 'Rellena datos de acceso';
      } else {
         $u = $bd->login($_POST['email'], $_POST['ps']);
         if ($u == null) {
            $error = (isset($error) ? 'Excepción' . $error : 'Error en el acceso');
         } else {
            $mensaje = 'Login correcto';
         }
      }
   } elseif (isset($_POST['crearUS'])) {
      //Validaciones
      //Campos vacíos
      if (empty($_POST['nombre']) || empty($_POST['email']) || empty($_POST['ps']) || empty($_POST['ps2'])) {
         $error = 'Todos los campos son obligatorios';
      } elseif ($_POST['ps'] != $_POST['ps2']) {
         $error = 'Las contraseñas deben coincidir';
      } else {
         //Validar si email duplicado
         $u = $bd->obtenerUsuario($_POST['email']);
         if ($u != null) {
            $error = 'Error, email ya está registrado';
         } else {
            //Si llego aquí, $u es null
            $u = new Usuarios(null, $_POST['email'], $_POST['nombre'], 'U');
            if ($bd->crearUsuario($u, $_POST['ps'])) {
               $mensaje = 'Usuario creado con ID:' . $u->getId();
            } else {
               $error = (isset($error) ? 'Excepción' . $error : 'Error al crear el usuario');
            }
         }
      }
   }
}
