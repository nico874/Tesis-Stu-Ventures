<?php
include("../bd/conexion.php");
include("../validaciones/validarsesionEm.php"); 

$idCorres = $_GET['idCorres'];


$sqlEliminarChat= "UPDATE chats_correspon set ActivoChats = 2 WHERE idCorres = '$idCorres'";
if(mysqli_query($conexion, $sqlEliminarChat)){
    echo '<script language="javascript">alert("Se ha ELIMINADO el chat con éxito.");
    window.location.assign("Mensajes.php");</script>';
}else{
    echo '<script language="javascript">alert("No se ha podido ELIMINAR el chat con éxito.");
    window.location.assign("Mensajes.php");</script>';
}


?>