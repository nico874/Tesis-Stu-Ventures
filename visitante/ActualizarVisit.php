<?php include("../bd/conexion.php");
include("PerfilUsuario.php");

?>
<?php

$consulta = "SELECT * from usuario WHERE idUsuario = '" . $_SESSION['idUsuario'] . "'";
$resultado = mysqli_query($conexion, $consulta);
$filas = mysqli_fetch_array($resultado);

$nombre = $conexion->real_escape_string($_POST["nombre"]);
$apellidoP = $_POST["apellidoP"];
$apellidoM = $_POST["ApellidoM"];
$telef = $_POST["telef"];
$contraseña = $_POST["contraseña"];
$Nuevacontra =  password_hash($_POST["Nuevacontra"], PASSWORD_DEFAULT);
$Pass = $_POST["Pass"];


if (isset($Pass)) {
    if (password_verify($contraseña, $filas['Contraseña'])) {
        $sql7 = $conexion->prepare("UPDATE usuario set Contraseña = ? WHERE idUsuario = ?");
        $sql7->bind_param("si",$Nuevacontra,$_SESSION['idUsuario']);
        $sql7->execute();
        if ($sql7->close()) {
            echo '<script language="javascript">alert("Se ha actualizado con éxito tu contraseña!");
            window.location.assign("../visitante/PerfilUsuario.php");</script>';
        }
    } else {
        echo '<script language="javascript">alert("No se ha actualizado con éxito tu contraseña, por favor revisa tu contraseña actual");
window.location.assign("../visitante/PerfilUsuario.php");</script>';
    }
}
if (!isset($Pass)) {
    $sql = $conexion->prepare("UPDATE usuario set Nombre = ?, Apellido_Paterno = ? , Apellido_Materno = ?  WHERE idUsuario = ?");
    $sql->bind_param("sssi",$nombre,$apellidoP,$apellidoM,$_SESSION['idUsuario']);
    $sql->execute();


    $sql2 =$conexion->prepare("UPDATE telefono set Numero =  ? WHERE Usuario_idUsuario = ?");
    $sql2->bind_param("ii",$telef, $_SESSION['idUsuario']);
    $sql2->execute();
    if ($sql->close() && $sql2->close()) {

        echo '<script language="javascript">alert("Se han actualizado con exito tus datos!");
    window.location.assign("PerfilUsuario.php");</script>';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
    }
}

?>