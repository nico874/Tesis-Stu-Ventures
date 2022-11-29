<?php include("../bd/conexion.php");
include("../validaciones/validasesionAdm.php");

$idPubli = $_GET['idPubli'];
$NombrePubli = $_GET['NombrePubli'];
$idUser = $_GET['idUser'];



$sqlSelecCorresCompro = "SELECT * from chats_correspon WHERE De = '$_SESSION[idUsuarioAdmin]' AND Para = '$idUser' AND idEmprendi = '$idPubli'";
$resultCompro = mysqli_query($conexion, $sqlSelecCorresCompro);
$columCompro = mysqli_fetch_array($resultCompro);
if (isset($columCompro)) {
    $idCorres =  $columCompro['idCorres'];
    header("Location:ChatAdmin.php?idCorres=$idCorres");
} else {
    date_default_timezone_set("America/Santiago");
    $fecha = date("Y-m-d G:i:s");
    $sqlCorres = "INSERT INTO chats_correspon (De,Para,FechaCorres,idEmprendi) VALUES ('$_SESSION[idUsuarioAdmin]','$idUser','$fecha', '$idPubli')";

    if (mysqli_query($conexion, $sqlCorres)) {

        $sqlSelecCorres = "SELECT * from chats_correspon WHERE De = '$_SESSION[idUsuarioAdmin]' AND Para = '$idUser ' AND idEmprendi = '$idPubli'";

        if ($resultCorres = mysqli_query($conexion, $sqlSelecCorres)) {
            $columCorres = mysqli_fetch_array($resultCorres);
            $idCorres =  $columCorres['idCorres'];

            header("Location:ChatAdmin.php?idCorres=$idCorres");
        } else {
            echo 'Error';
        }
    } else {
        echo 'fatal error';
    }
}
