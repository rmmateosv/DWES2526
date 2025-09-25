<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <?php           
            for($i=1;$i<=10;$i++){
                if($i%2==0){
                    $color='white';
                }
                else{
                   $color='gray'; 
                }
                echo '<tr style="background-color:'.$color.'">';
                for($j=1;$j<=10;$j++){
                    echo '<td>'.$i*$j.'</td>';
                }
                echo '</tr>';
            }
        ?>
    </table>
    <table>
        <?php           
            for($i=1;$i<=10;$i++){                
                echo '<tr style="background-color:'.($i%2==0?'white':'gray').'">';
                for($j=1;$j<=10;$j++){
                    echo '<td>'.$i*$j.'</td>';
                }
                echo '</tr>';
            }
        ?>
    </table>
</body>
</html>