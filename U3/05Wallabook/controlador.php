<?php
require_once 'BD.php';
session_start();

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
            //Guardar el us logeado en la sesión
            $_SESSION['us'] = $u;
            //Redirigir a index
            header('location:index.php');
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
   elseif(isset($_POST['cerrar'])){
      //Cerrar sesión y redirigir a login
      session_destroy();
      header('location:login.php');
   }
   elseif(isset($_POST['crearL'])){
      //Chequear campos rellenos
      if(empty($_POST['isbn']) || empty($_POST['titulo']) || empty($_POST['descripcion']) ||
      empty($_POST['autor']) || empty($_POST['precio']) || empty($_FILES['foto']['name'])){
         $error = 'Todos los campos son obligatorios';
      }
      else{
         $libro = new Libros(null,date('Y-m-d H:i:s'),$_POST['isbn'],$_POST['titulo'],
         $_POST['autor'],$_POST['descripcion'],$_FILES['foto'],'Disponible',$_POST['precio'],
         $_SESSION['us']->getId(),null);
         if($bd->crearLibro($libro)){
            $mensaje='Libro Creado con id:'.$libro->getId();
         }
         else{
            $error = (isset($error) ? 'Excepción' . $error : 'Error al crear el libro');
         }
      }
   }
   elseif(isset($_POST['borrarL'])){
      //Chequear que el libro existe y se puede borrar si no hay comprador
      $l = $bd->obtenerLibro($_POST['borrarL']);
      if($l!=null && $l->getComprador()==null){
         //Se puede borrar
         if($bd->borrarLibro($l->getId())){
            $mensaje='Libro borrado';
         }
         else{
            $error = (isset($error) ? 'Excepción' . $error : 'No se puede borrar el libro');   
         }
      }
      else{
         $error = (isset($error) ? 'Excepción' . $error : 'No existe el libro o está vendido');
      }
   }
}
