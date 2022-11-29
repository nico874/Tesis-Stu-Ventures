<?php 
include("../bd/conexion.php");

if(!isset($_GET['Buscar'])){
    $_GET['Buscar'] = "";
    $Buscar = $_GET['Buscar'];
}
$Buscar = "%{$_GET['Buscar']}%"; 



$sqlPublicaciones =$conexion->prepare("SELECT * FROM publicacion  WHERE titulo LIKE ? AND Usuario_idUsuario = ? AND ActivoPubli BETWEEN 0 AND 2 ");
$sqlPublicaciones->bind_param("si",$Buscar,$_SESSION['idUsuarioEm']);
$sqlPublicaciones->execute();
$resultadoPublic = $sqlPublicaciones->get_result();

?>