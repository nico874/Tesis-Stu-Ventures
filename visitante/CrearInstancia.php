<?php 
include("../bd/conexion.php");
include("../validaciones/validasesion.php"); 

$idPubli = $_GET['idPubli'];
$NombrePubli = $_GET['NombrePubli'];
$idUser = $_GET['idUser'];

$sqlSelecCorresCompro = "SELECT * from chats_correspon WHERE De = '$_SESSION[idUsuario]' AND Para = '$idUser' AND idEmprendi = '$idPubli' ";
$resultCompro = mysqli_query($conexion, $sqlSelecCorresCompro);
$columCompro = mysqli_fetch_array($resultCompro);
if(isset($columCompro) ){
    if($columCompro['ActivoChats'] == 0){
        $sqlUpdateChat = "UPDATE chats_correspon set ActivoChats = '1' WHERE idCorres = '$columCompro[idCorres]'";
        mysqli_query($conexion, $sqlUpdateChat);
        $idCorres =  $columCompro['idCorres'];
        header("Location:ChatVisitante.php?idCorres=$idCorres");
    }else{
        $idCorres =  $columCompro['idCorres'];
        header("Location:ChatVisitante.php?idCorres=$idCorres");
    }
   
}else{
    date_default_timezone_set("America/Santiago");
    $fecha = date("Y-m-d G:i:s");
    $sqlCorres = "INSERT INTO chats_correspon (De,Para,FechaCorres,ActivoChats,idEmprendi) VALUES ('$_SESSION[idUsuario]','$idUser','$fecha' , '1','$idPubli')";

    if(mysqli_query($conexion, $sqlCorres)){
    
        $sqlSelecCorres = "SELECT * from chats_correspon WHERE De = '$_SESSION[idUsuario]' AND Para = '$idUser' AND idEmprendi= '$idPubli' AND ActivoChats BETWEEN 1 AND 2";
      
        if($resultCorres = mysqli_query($conexion, $sqlSelecCorres)){
            $columCorres = mysqli_fetch_array($resultCorres);
            $idCorres =  $columCorres['idCorres'];
           
            header("Location:ChatVisitante.php?idCorres=$idCorres");
        
        }else{
            echo 'Error';
        }
    }else{
        echo 'fatal error';
    }    
}
