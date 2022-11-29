<?php include("../bd/conexion.php");
include("../validaciones/validasesion.php");

date_default_timezone_set("America/Santiago");

$fecha = date("Y-m-d G:i:s");
$idEmprendedor = $_GET['idEmprendedor'];
$mensaje = $_GET['mensaje'];
$idCorres = $_GET['idCorres'];
$estado=1;
$est=0;

$sqlSelecCorres =$conexion->prepare("INSERT INTO chat (idCorres, Envia_Usuarioid, Recibe_Usuarioid, Mensaje, Tiempo_mensaje, Estado, Usuario_idUsuario) VALUES (?,?,?,?,?,?,?)");
$sqlSelecCorres->bind_param("issssii",$idCorres,$_SESSION['idUsuario'],$idEmprendedor,$mensaje,$fecha,$estado,$_SESSION['idUsuario']);
$sqlSelecCorres->execute();
$resultCorres  = $sqlSelecCorres->get_result();
if ($sqlSelecCorres->close()) {
    $UpdateChat =$conexion->prepare("UPDATE chat set Estado = ? WHERE Envia_Usuarioid = ? AND idCorres = ? ");
    $UpdateChat->bind_param("isi",$est,$idEmprendedor,$idCorres);
    $UpdateChat->execute();
    $xda= $UpdateChat->get_result();


    header("Location:ChatVisitante.php?idCorres=$idCorres");
} else {
    echo 'Error';
}
?>