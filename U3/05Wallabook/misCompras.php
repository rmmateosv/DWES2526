<?php
require_once 'cabecera.php';

?>
<div class="container">
    <h4>Mis Compras</h4>
    <div style="display: flex; flex-direction:row">
    <?php
    $libros = $bd->obtenerLibrosComprados($_SESSION['us']->getId());
    foreach($libros as $l){
         echo '<div style="display: flex; flex-direction:column; align-items:center;">';
            echo '<a href="detalle.php?libro=' . $l->getId() . '"><img width="100px" src="https://s3.us-east-1.amazonaws.com/' . $bucket .
                '/' . $l->getCarpetaS3fotos() . '"></a>';
            echo '<h7>' . $l->getTitulo() . '</h7>';
            echo '<h7>' . $l->getPrecio() . '</h7>';
            echo '<p>' . $l->getDescripcion() . '</p>';
            echo '<p>' . $l->getVendedor()->getNombre() . '</p>';
            echo '</div>';
    }
    ?>
    </div>
</div>
<?php
require_once 'pie.php';
?>