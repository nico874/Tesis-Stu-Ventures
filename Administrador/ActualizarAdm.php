<?php include("../bd/conexion.php");
include("../validaciones/validasesionAdm.php");

?>
<?php

$consulta = "SELECT * from usuario WHERE idUsuario = '" . $_SESSION['idUsuarioAdmin'] . "'";
$resultado = mysqli_query($conexion, $consulta);
$filas = mysqli_fetch_array($resultado);

if(!isset($_POST['contraseña']) && !isset($_POST['Nuevacontra']) && !isset($_POST['Pass'])){
    $_POST['contraseña'] = "";
    $_POST['Nuevacontra'] = "";
    $_POST['Pass'] = "";
    $contraseña = $_POST["contraseña"];
    $Nuevacontra = password_hash($_POST["Nuevacontra"], PASSWORD_DEFAULT);
    $Pass = $_POST["Pass"];
}else{
    $contraseña = $_POST["contraseña"];
    $Nuevacontra = password_hash($_POST["Nuevacontra"], PASSWORD_DEFAULT);
    $Pass = $_POST["Pass"];
}


if($Nuevacontra ){
    $sql7 =$conexion->prepare("UPDATE usuario set Contraseña = ? WHERE idUsuario = ?");
    $sql7->bind_param("si",$Nuevacontra,$_SESSION['idUsuarioAdmin']);
    $sql7->execute();

        if (password_verify($contraseña,$filas['Contraseña'])) {
            if ($sql7->close())
                echo '<script language="javascript">alert("Se ha actualizado con éxito tu nueva contraseña!");
            window.location.assign("../Administrador/PerfilAdmin.php");</script>';
        } else {
            echo '<script language="javascript">alert("No se ha podido actualizar tu contraseña!, por favor revisa tu contraseña actual");
        window.location.assign("../Administrador/PerfilAdmin.php");</script>';
        }
}else{
    echo '<script language="javascript">alert("No se han actualizado tus datos!");
    window.location.assign("../Administrador/PerfilAdmin.php");</script>';
} 


?>