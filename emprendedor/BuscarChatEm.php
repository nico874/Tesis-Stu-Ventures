<?php include("../bd/conexion.php");

if (!isset($_GET['Buscar'])) {
    $_GET['Buscar'] = "";
    $Buscar = $_GET['Buscar'];
}

$Buscar = "%{$_GET['Buscar']}%"; 

$sqlPubli =$conexion->prepare("SELECT * from usuario Where Nombre LIKE ? AND idUsuario = ?");
$sqlPubli->bind_param("si",$Buscar,$filasCorres['De']);
$sqlPubli->execute();
$resultaPubli= $sqlPubli->get_result();


?>