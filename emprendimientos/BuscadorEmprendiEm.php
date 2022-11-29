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

if (!isset($_GET['Orden'])) {
    $_GET['Orden'] = "";
    $Orden = $_GET['Orden'];
}
$Orden = $_GET['Orden']; 

if (!isset($_GET['TituloEmprendi'])) {
    $_GET['TituloEmprendi'] = "";
    $TituloEmprendi = $_GET['TituloEmprendi'];
}
$TituloEmprendi = $_GET['TituloEmprendi']; 



if ($Sede != "") {

    $sqlSede = "SELECT * from institucion WHERE Sede = '$Sede' ";
    $resultadoSede = mysqli_query($conexion, $sqlSede);
    $filaInstitu = mysqli_fetch_array($resultadoSede);
    $sqlPublicaciones = "SELECT * FROM publicacion WHERE Institucion_idInstitucion = '$filaInstitu[idInstitucion]' AND ActivoPubli ='1' ORDER BY RAND()   ";
    $resultadoPublic = mysqli_query($conexion, $sqlPublicaciones);
 
} else {

    if ($Categoria != "") {

        $sqlPublicaciones = "SELECT * FROM publicacion  WHERE Categoria ='$Categoria' AND  ActivoPubli ='1' ORDER BY RAND() ";
        $resultadoPublic = mysqli_query($conexion, $sqlPublicaciones);
    } else {
        if ($Orden != "") {
            $sqlPublicaciones = "SELECT * FROM publicacion  WHERE ActivoPubli ='1' ORDER BY Valoracion desc    ";
            $resultadoPublic = mysqli_query($conexion, $sqlPublicaciones);
        } else {
            if($TituloEmprendi != ""){
                $sqlPublicaciones = "SELECT * FROM publicacion  WHERE titulo LIKE '%".$TituloEmprendi."%' AND ActivoPubli ='1' ORDER BY RAND() ";
                $resultadoPublic = mysqli_query($conexion, $sqlPublicaciones);
            }else{
                $sqlPublicaciones = "SELECT * FROM publicacion  WHERE ActivoPubli ='1' ORDER BY RAND()  ";
                $resultadoPublic = mysqli_query($conexion, $sqlPublicaciones);
            }
           
        }
    }
}
?>

