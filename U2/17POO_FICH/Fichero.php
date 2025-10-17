<?php
require_once 'Alumno.php';
class Fichero
{
     private $nombre = 'alumnos.txt';

     public function guardarAlumno($a)
     {
          $resultado = false;

          try {
               //Abrir el fichero
               $f = fopen($this->nombre, 'a+');
               //Guardar alumnos, campo a campo
               fwrite($f, $a->getNombre() . ';' .
                    $a->getFoto() . ';' .
                    $a->getSexo() . ';' .
                    $a->getFecha() . ';' .
                    $a->getHora() . ';' .
                    $a->getCiclo() . ';' .
                    implode(' ', $a->getAsig()) . ';' .
                    implode(' ', $a->getBeca()) . ';' .
                    $a->getObserv() .
                    PHP_EOL);
               //Cerrar fichero
               fclose($f);
               $resultado=true;
          } catch (\Throwable $th) {
               global $error;
               $error = $th->getMessage();
          }
          return $resultado;
     }

     public function obtenerAlumnos() {
          $resultado = array();
          try {
            //Comprobar si existe el fichero
            if(file_exists($this->nombre))   {
               //Pasar las línea del fichero a un array con cada línea
               $contenido = file($this->nombre,FILE_IGNORE_NEW_LINES);
               foreach($contenido as $linea){
                    //Seperar la línea por ;
                    $datos = explode(';',$linea);
                    //Crear un alumno con la información de la línea
                    $a = new Alumno($datos[0],$datos[1],$datos[2],$datos[3],
                              $datos[4],$datos[5],explode(' ',$datos[6]),$datos[7],$datos[8]);
                    //Añadir el alumno al resultado
                    $resultado[]=$a;
               }
            }
          } catch (\Throwable $th) {
               global $error;
               $error = $th->getMessage();
          }
          return $resultado;
     }
}
