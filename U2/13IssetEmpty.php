<?php
if(isset($v1)){
    echo 'La variable $v1 está inicializada';
}
else{
    echo 'La variable $v1 no está inicializada';
}
$v2 = '';
if(isset($v2)){
    echo '<br>La variable $v2 está inicializada';
}
else{
    echo '<br>La variable $v2 no está inicializada';
}
if(empty($v1)){
    echo '<br>La variable $v1 no está inicializada o tiene valor vacío';
}
else{
    echo '<br>La variable $v1 está inicializada';
}
if(empty($v2)){
    echo '<br>La variable $v2 no está inicializada o tiene valor vacío';
}
else{
    echo '<br>La variable $v2 está inicializada y tiene valor';
}
$v3 = 10;
if(empty($v3)){
    echo '<br>La variable $v3 no está inicializada o tiene valor vacío';
}
else{
    echo '<br>La variable $v3 está inicializada y tiene valor';
}
?>