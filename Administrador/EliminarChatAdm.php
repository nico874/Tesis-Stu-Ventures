<?php include("../bd/conexion.php");
include("../validaciones/validasesionAdm.php"); 

$idCorres = $_GET['idCorres'];

$sqlEliminarChat= "UPDATE chats_correspon set ActivoChats = 0 WHERE idCorres = '$idCorres'";
if(mysqli_query($conexion, $sqlEliminarChat)){
    echo '<script language="javascript">alert("Se ha ELIMINADO el chat con éxito.");
    window.location.assign("MensajesAdmin.php");</script>';
}else{
    echo '<script language="javascript">alert("No se ha podido ELIMINAR el chat con éxito.");
    window.location.assign("MensajesAdmin.php");</script>';
}


?>