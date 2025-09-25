<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
 <?php
    //Comprobar si se ha pulsado en guardar
    if(isset($_GET['guardar'])){
        //Crear y rellenar array asociativo
        $datos=array();
        $datos['Nombre']=$_GET['alumno'];
        $datos['Modulo']=$_GET['modulo'];
        $datos['nota1']=$_GET['n1'];
        $datos['nota2']=$_GET['n2'];
        $datos['nota3']=$_GET['n3'];
        //Mostrar array en formato boletín
        ?>
        <h1 style="text-align: center;">BOLETÍN</h1>
        <h2 style="text-align: center;"><?php echo $datos['Nombre']?></h2>
        <table align="center" border="1" style="text-align: center;">
            <tr>
                <th colspan="3">
                    <?php echo $datos['Modulo']?>
                </th>
            </tr>
            <tr>
                <td>1ª Evaluación</td>
                <td>2ª Evaluación</td>
                <td>3ª Evaluación</td>
            </tr>
             <tr>
                <td style="color:<?php echo ($datos['nota1']>=5?'green':'red')?>;"><?php echo $datos['nota1']?> </td>
                <td style="color:<?php echo ($datos['nota2']>=5?'green':'red')?>;"><?php echo $datos['nota2']?> </td>
                <td style="color:<?php echo ($datos['nota3']>=5?'green':'red')?>;"><?php echo $datos['nota3']?> </td>
            </tr>
        </table>
        <?php
        //Hacer un vardump del array asociativo
        var_dump($datos);

    }
    else{
        echo '<h1>Error, no puedes acceder de esta forma a la página</h1>';
    }
 ?>
</body>
</html>