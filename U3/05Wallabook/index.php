<?php
require_once 'cabecera.php';

require_once 'pie.php';
?>
<div class="container">
<h1>Inicio</h1>
<div style="display: flex; flex-direction:row">
    <?php
    $anuncios = $bd->obtenerAnuncios();
    foreach($anuncios as $a){
        echo '<div style="display: flex; flex-direction:column; align-items:center;">';
        echo '<img width="100px" src="https://s3.us-east-1.amazonaws.com/' . $bucket . 
             '/' .$a->getCarpetaS3fotos().'">';
        echo '<h7>'.$a->getTitulo().'</h7>';
        echo '<h7>'.$a->getPrecio().'</h7>';
        echo '<p>'.$a->getDescripcion().'</p>';
        echo '</div>';
    }
    ?>

</div>
</div>


