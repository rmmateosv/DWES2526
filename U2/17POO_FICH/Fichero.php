<?php
require_once 'Alumno.php';
class Fichero{
    private $nombre = 'alumnos.txt';

   public function guardarAlumno($a){
        //Abrir el fichero
        $f = fopen($this->nombre,'a+');
        //Guardar alumnos, campo a campo
        fwrite($f, $a->getNombre().';'.
        $a->getFoto().';'.
        $a->getSexo().';'.
        $a->getFecha().';'.
        $a->getHora().';'.
        $a->getCiclo().';'.
        implode(' ',$a->getAsig()).';'.
        implode(' ',$a->getBeca()).';'.
        $a->getObserv().';'.
        PHP_EOL);
        //Cerrar ficheor
        fclose($f);
   }

   public function obtenerAlumnos(){

   }

}
?>