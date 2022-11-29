<?php include("../bd/conexion.php");
include("../validaciones/validasesionAdm.php");

date_default_timezone_set("America/Santiago");

$fecha = date("Y-m-d G:i:s");
$idEmprendedor = $_GET['idEmprendedor'];
$mensaje = $_GET['mensaje'];
$idCorres = $_GET['idCorres'];

$estado =1;
$est=0;


$sqlSelecCorres =$conexion->prepare("INSERT INTO chat (idCorres, Envia_Usuarioid, Recibe_Usuarioid, Mensaje, Tiempo_mensaje, Estado, Usuario_idUsuario)  VALUES (?,?,?,?,?,?,?)");
$sqlSelecCorres->bind_param("issssii",$idCorres,$_SESSION['idUsuarioAdmin'],$idEmprendedor,$mensaje,$fecha,$estado,$_SESSION['idUsuarioAdmin']);
$sqlSelecCorres->execute();
$resultCorres= $sqlSelecCorres->get_result();
if ($sqlSelecCorres->close()) {
    $UpdateChat =$conexion->prepare("UPDATE chat set Estado = ? WHERE Envia_Usuarioid = ? AND idCorres= ? ");
    $UpdateChat->bind_param("iii",$est,$idEmprendedor,$idCorres);
    $UpdateChat->execute();
    $xda= $UpdateChat->get_result();
    header("Location:ChatAdmin.php?idCorres=$idCorres");
} else {
    header("Location:ChatAdmin.php?idCorres=$idCorres");
}

?>