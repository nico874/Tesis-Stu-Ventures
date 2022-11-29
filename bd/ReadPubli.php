<?php
include("../bd/conexion.php");


if (!isset($_GET['Buscar'])) {
    $_GET['Buscar'] = "";
    $Buscar = $_GET['Buscar'];
}
$Buscar = "%{$_GET['Buscar']}%";

if (!isset($_GET['Activo'])) {
    $_GET['Activo'] = "";
}
$Activo = "$_GET[Activo]";

if ($Activo == 1) {
    $Activo = 1;
    $sqlPublic = $conexion->prepare("SELECT * from publicacion WHERE Titulo LIKE ? AND ActivoPubli LIKE ? ORDER BY RAND()");
    $sqlPublic->bind_param("ss", $Buscar, $Activo);
    $sqlPublic->execute();
    $resultadoPublic = $sqlPublic->get_result();
} elseif ($Activo == 0) {
    $Activo = 0;
    $sqlPublic = $conexion->prepare("SELECT * from publicacion WHERE Titulo LIKE ? AND ActivoPubli LIKE ? ORDER BY RAND()");
    $sqlPublic->bind_param("ss", $Buscar, $Activo);
    $sqlPublic->execute();
    $resultadoPublic = $sqlPublic->get_result();
} elseif ($Activo == 2) {
    $Activo = 2;
    $sqlPublic = $conexion->prepare("SELECT * from publicacion WHERE Titulo LIKE ? AND ActivoPubli LIKE ? ORDER BY RAND()");
    $sqlPublic->bind_param("ss", $Buscar, $Activo);
    $sqlPublic->execute();
    $resultadoPublic = $sqlPublic->get_result();
} elseif ($Activo == 3) {
    $Activo = 3;
    $sqlPublic = $conexion->prepare("SELECT * from publicacion WHERE Titulo LIKE ? AND ActivoPubli LIKE ? ORDER BY RAND()");
    $sqlPublic->bind_param("ss", $Buscar, $Activo);
    $sqlPublic->execute();
    $resultadoPublic = $sqlPublic->get_result();
} elseif ($Activo != 0 &&  $Activo != 1 && $Activo != 2) {
    $sqlPublic = $conexion->prepare("SELECT * from publicacion WHERE Titulo LIKE ? AND ActivoPubli BETWEEN 0 AND 2 ORDER BY RAND()");
    $sqlPublic->bind_param("s", $Buscar);
    $sqlPublic->execute();
    $resultadoPublic = $sqlPublic->get_result();
}
