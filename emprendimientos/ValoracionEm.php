<?php include("../bd/conexion.php");
include("../validaciones/validarsesionEm.php");
?>
<?php


$estrellas = $_GET["estrellaS"];
$idPubli = $_GET["idPubli"];

    $SqlValora = "INSERT INTO valoracion (Cantidad, Usuario_idUsuario, Publicacion_idPublicacion) VALUES ('$estrellas', '$_SESSION[idUsuarioEm]', '$idPubli')";
    
    if (mysqli_query($conexion, $SqlValora)) {
        $contador = 0;
        $suma = 0;
        
        $consultaValora = "SELECT * from valoracion Where Publicacion_idPublicacion = '$idPubli'";
        $resultValora = mysqli_query($conexion, $consultaValora);
    
        while ($filasValora = mysqli_fetch_array($resultValora)) {
            $Cantidad = $filasValora['Cantidad'];
            $suma = $suma + $Cantidad;
            $contador++;
        }
        $resultadoValora = $suma / $contador;

        $SqlValoraUp = "UPDATE  publicacion set Valoracion = '$resultadoValora' WHERE idPublicacion = '$idPubli'";
        $resultValoracion = mysqli_query($conexion, $SqlValoraUp);
     

        header("Location:../emprendedor/VerEmprendimiento.php?idPublicacion=$idPubli");
    } else {
        echo "Error";
    }




?>