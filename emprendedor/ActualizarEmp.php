<?php include("../bd/conexion.php");
include("perfilEmprendedor.php");


$consulta = "SELECT * from usuario WHERE idUsuario = '" . $_SESSION['idUsuarioEm'] . "'";
$resultado = mysqli_query($conexion, $consulta);
$filas = mysqli_fetch_array($resultado);

$nombre = $_POST["nombre"];
$apellidoP = $_POST["apellidoP"];
$apellidoM = $_POST["ApellidoM"];
$direc = $_POST["direc"];
$comuna = $_POST["comuna"];
$telef = $_POST["telef"];
$Instagram = $_POST["Instagram"];
$Facebook = $_POST["Facebook"];
$contraseña = $_POST["contraseña"];
$Nuevacontra =  password_hash($_POST["Nuevacontra"], PASSWORD_DEFAULT);
$Pass = $_POST["Pass"];

if (isset($Pass)) {
    if (password_verify($contraseña, $filas['Contraseña'])) {
        $sql7 = $conexion->prepare("UPDATE usuario set Contraseña = ? WHERE idUsuario = ?");
        $sql7->bind_param("si", $Nuevacontra, $_SESSION['idUsuarioEm']);
        $sql7->execute();
        if ($sql7->close()){
            echo '<script language="javascript">alert("Se ha actualizado con éxito tu contraseña!");
            window.location.assign("../emprendedor/perfilEmprendedor.php");</script>';
        }
    } else {
        echo '<script language="javascript">alert("No se ha actualizado con éxito tu contraseña, por favor revisa tu contraseña actual");
    window.location.assign("../emprendedor/perfilEmprendedor.php");</script>';
    }
}
if (!isset($Pass)) {

    $sql4 = $conexion->prepare("UPDATE usuario set Nombre = ?, Apellido_Paterno = ? , Apellido_Materno = ? ,Instagram = ?, Facebook = ? WHERE idUsuario = ?");
    $sql4->bind_param("sssssi", $nombre, $apellidoP, $apellidoM, $Instagram, $Facebook, $_SESSION['idUsuarioEm']);
    $sql4->execute();

    $sql5 = $conexion->prepare("UPDATE telefono set Numero = ? WHERE Usuario_idUsuario =  ?");
    $sql5->bind_param("ii", $telef, $_SESSION['idUsuarioEm']);
    $sql5->execute();

    $sql6 = $conexion->prepare("UPDATE direccion set Direccion = ? , Comuna = ? WHERE idDireccion =  ?");
    $sql6->bind_param("ssi", $direc, $comuna, $columna3['idDireccion']);
    $sql6->execute();

    if ($sql4->close() && $sql5->close() && $sql6->close()) {

        echo '<script language="javascript">alert("Se han actualizado con éxito tus datos!");
        window.location.assign("../emprendedor/perfilEmprendedor.php");</script>';
    } else {
        echo "Error: " . $sql4 . "<br>" . mysqli_error($conexion);
    }
}


?>
