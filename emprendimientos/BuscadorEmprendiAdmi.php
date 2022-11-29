<?php
include("../bd/conexion.php");


$sqlCount = "SELECT COUNT(*) idPublicacion FROM publicacion Where ActivoPubli ='1'";
$resulCount = mysqli_query($conexion, $sqlCount);
$filaCount = mysqli_fetch_array($resulCount);
$cantidadEmprend = $filaCount['idPublicacion'];

if (isset($_POST['limite'])) {
    $limite = $_POST['limite'];
    switch ($limite) {
        case 0:
            $valorLimite = $cantidadEmprend;
            break;
        case 3:
            $valorLimite = $limite;
            break;
        case 4:
            $valorLimite = $limite;
            break;
        case 999:
            $valorLimite = $cantidadEmprend;
            break;
    }
} else {
    $valorLimite = $cantidadEmprend;
}
if (!isset($_GET['Sede'])) {
    $_GET['Sede'] = "";
    $Sede = $_GET['Sede'];
}
$Sede = $_GET['Sede'];

if (!isset($_GET['categoria'])) {
    $_GET['categoria'] = "";
    $Categoria = $_GET['categoria'];
}
$Categoria = $_GET['categoria'];

if (!isset($_GET['Vistos'])) {
    $_GET['Vistos'] = "";
    $Vistos = $_GET['Vistos'];
}
$Vistos = $_GET['Vistos'];

if (!isset($_GET['Orden'])) {
    $_GET['Orden'] = "";
    $Orden = $_GET['Orden'];
}
$Orden = $_GET['Orden'];

if (!isset($_GET['TituloEmprendi'])) {
    $_GET['TituloEmprendi'] = "";
    $TituloEmprendi = $_GET['TituloEmprendi'];
}
$TituloEmprendi = "%{$_GET['TituloEmprendi']}%";

$acti = 1;


if ($Sede != "") {

    $sqlSede = "SELECT * from institucion WHERE Sede = '$Sede' ";
    $resultadoSede = mysqli_query($conexion, $sqlSede);
    $filaInstitu = mysqli_fetch_array($resultadoSede);
    $sqlPublicaciones = "SELECT * FROM publicacion WHERE Institucion_idInstitucion = '$filaInstitu[idInstitucion]' AND ActivoPubli ='1'  ORDER BY RAND()  ";
    $resultadoPublic = mysqli_query($conexion, $sqlPublicaciones);
} else {

    if ($Categoria != "") {

        $sqlPublicaciones = "SELECT * FROM publicacion  WHERE Categoria ='$Categoria' AND  ActivoPubli ='1' ORDER BY RAND() ";
        $resultadoPublic = mysqli_query($conexion, $sqlPublicaciones);
    } else {
        if ($Vistos != "") {
            $sqlPublicaciones = "SELECT * FROM publicacion  WHERE ActivoPubli ='1' ORDER BY Visitas desc   ";
            $resultadoPublic = mysqli_query($conexion, $sqlPublicaciones);
        } elseif ($Orden != "") {
            $sqlPublicaciones = "SELECT * FROM publicacion  WHERE ActivoPubli ='1' ORDER BY Valoracion desc   ";
            $resultadoPublic = mysqli_query($conexion, $sqlPublicaciones);
        } else {
            if ($TituloEmprendi != "") {
                $sqlPublicaciones = $conexion->prepare("SELECT * FROM publicacion  WHERE titulo LIKE ?  AND ActivoPubli = ? ORDER BY RAND()");
                $sqlPublicaciones->bind_param("si", $TituloEmprendi, $acti);
                $sqlPublicaciones->execute();
                $resultadoPublic = $sqlPublicaciones->get_result();
            } else {
                $sqlPublicaciones = "SELECT * FROM publicacion  WHERE ActivoPubli ='1'   ORDER BY RAND()";
                $resultadoPublic = mysqli_query($conexion, $sqlPublicaciones);
            }
        }
    }
}
if ($Sede != "" && $Categoria != "") {
    $sqlSede = "SELECT * from institucion WHERE Sede = '$Sede' ";
    $resultadoSede = mysqli_query($conexion, $sqlSede);
    $filaInstitu = mysqli_fetch_array($resultadoSede);
    $sqlPublicaciones = "SELECT * FROM publicacion WHERE Institucion_idInstitucion = '$filaInstitu[idInstitucion]' AND ActivoPubli ='1' AND Categoria ='$Categoria' ORDER BY RAND()  ";
    $resultadoPublic = mysqli_query($conexion, $sqlPublicaciones);
}
if ($Sede != "" && $Vistos != "") {
    $sqlSede = "SELECT * from institucion WHERE Sede = '$Sede' ";
    $resultadoSede = mysqli_query($conexion, $sqlSede);
    $filaInstitu = mysqli_fetch_array($resultadoSede);
    $sqlPublicaciones = "SELECT * FROM publicacion WHERE Institucion_idInstitucion = '$filaInstitu[idInstitucion]' AND ActivoPubli ='1' ORDER BY Visitas desc  ";
    $resultadoPublic = mysqli_query($conexion, $sqlPublicaciones);
}
if ($Sede != "" && $Orden != "") {
    $sqlSede = "SELECT * from institucion WHERE Sede = '$Sede' ";
    $resultadoSede = mysqli_query($conexion, $sqlSede);
    $filaInstitu = mysqli_fetch_array($resultadoSede);
    $sqlPublicaciones = "SELECT * FROM publicacion WHERE Institucion_idInstitucion = '$filaInstitu[idInstitucion]' AND ActivoPubli ='1' ORDER BY Valoracion desc  ";
    $resultadoPublic = mysqli_query($conexion, $sqlPublicaciones);
}
if ($Categoria != "" && $Orden != "") {
    $sqlPublicaciones = "SELECT * FROM publicacion  WHERE Categoria ='$Categoria' AND  ActivoPubli ='1' ORDER BY Valoracion desc ";
    $resultadoPublic = mysqli_query($conexion, $sqlPublicaciones);
}
if ($Categoria != "" && $Vistos != "") {
    $sqlPublicaciones = "SELECT * FROM publicacion  WHERE Categoria ='$Categoria' AND  ActivoPubli ='1' ORDER BY Visitas desc ";
    $resultadoPublic = mysqli_query($conexion, $sqlPublicaciones);
}
if ($Vistos  != "" && $Orden != "") {
    $sqlPublicaciones = "SELECT * FROM publicacion  WHERE ActivoPubli ='1'  ORDER BY Visitas desc, Valoracion desc ";
    $resultadoPublic = mysqli_query($conexion, $sqlPublicaciones);
}
if ($Sede != "" && $Categoria != "" && $Orden != "") {
    $sqlSede = "SELECT * from institucion WHERE Sede = '$Sede' ";
    $resultadoSede = mysqli_query($conexion, $sqlSede);
    $filaInstitu = mysqli_fetch_array($resultadoSede);
    $sqlPublicaciones = "SELECT * FROM publicacion WHERE Institucion_idInstitucion = '$filaInstitu[idInstitucion]' AND Categoria ='$Categoria' AND ActivoPubli ='1' ORDER BY Valoracion desc  ";
    $resultadoPublic = mysqli_query($conexion, $sqlPublicaciones);
}
if ($Sede != "" && $Categoria != "" && $Vistos != "") {
    $sqlSede = "SELECT * from institucion WHERE Sede = '$Sede' ";
    $resultadoSede = mysqli_query($conexion, $sqlSede);
    $filaInstitu = mysqli_fetch_array($resultadoSede);
    $sqlPublicaciones = "SELECT * FROM publicacion WHERE Institucion_idInstitucion = '$filaInstitu[idInstitucion]' AND Categoria ='$Categoria' AND ActivoPubli ='1' ORDER BY Visitas desc  ";
    $resultadoPublic = mysqli_query($conexion, $sqlPublicaciones);
}
