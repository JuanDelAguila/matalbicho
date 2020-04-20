<?php
$hostname='localhost';
$database ='matalbicho';
$username = 'root';
$password ='matalbicho';

$conexion =new mysqli($hostname,$username,$password, $database);
if($conexion -> connect_errno){
    echo "Error en la conexión";
}


?>