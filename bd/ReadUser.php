<?php 
include("../bd/conexion.php");

if(!isset($_GET['Buscar'])){
    $_GET['Buscar'] = "";
    $Buscar = $_GET['Buscar'];
}

$Buscar = "%{$_GET['Buscar']}%"; 


$sqlUser1 =$conexion->prepare("SELECT  E.Direccion_correo, U.idUsuario, U.rut, U.Nombre, U.Apellido_Paterno, U.Apellido_Materno, U.Tipo_usuario, U.Activo FROM correo_electronico E
INNER JOIN usuario U ON E.Usuario_idUsuario = U.idUsuario
WHERE E.Direccion_correo LIKE ? ORDER BY RAND()");
$sqlUser1->bind_param("s",$Buscar);
$sqlUser1->execute();
$resultadouser1=$sqlUser1->get_result();





?>