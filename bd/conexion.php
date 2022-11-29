<?php


$usuario = "root";
$contrseña = "";
$servidor = "localhost";
$basededatos = "stu-ventures";

$conexion = mysqli_connect ($servidor, $usuario, $contrseña);

$db = mysqli_select_db( $conexion, $basededatos);
if(!$db){
    die ("Error al conectar" . mysqli_connect_error());
}else{
	
}
