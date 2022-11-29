<?php include("../bd/conexion.php");

if (!isset($_GET['Buscar'])) {
    $_GET['Buscar'] = "";
    $Buscar = $_GET['Buscar'];
}

$Buscar = "%{$_GET['Buscar']}%"; 


$sqlPubli =$conexion->prepare("SELECT * from publicacion Where Titulo LIKE ?  AND idPublicacion = ?");
$sqlPubli->bind_param("si",$Buscar,$filasCorres['idEmprendi']);
$sqlPubli->execute();
$resultaPubli= $sqlPubli->get_result();


?>