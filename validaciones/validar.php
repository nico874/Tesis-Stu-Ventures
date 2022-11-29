<?php include("../bd/conexion.php"); ?>
<?php


session_start();

$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];

$query = $conexion->prepare("SELECT * FROM correo_electronico WHERE Direccion_correo = ? ");
$query->bind_param("s", $correo);
$query->execute();

$resultado = $query->get_result();
$fila = $resultado->fetch_assoc();

$query2 = $conexion->prepare("SELECT * FROM usuario WHERE idUsuario = ? ");
$query2->bind_param("i", $fila['Usuario_idUsuario']);
$query2->execute();
$resultado2 = $query2->get_result();
$fila2 = $resultado2->fetch_assoc();


if (is_array($fila) && is_array($fila2)) {
    if ($fila2['Activo'] == 1) {
        if ($fila['Direccion_correo'] == ($correo) && (password_verify($contraseña, $fila2['Contraseña']))) {

            if ($fila2['Tipo_usuario'] == 1) {
                $_SESSION['time'] = time();
                $_SESSION['idUsuario'] = $fila2['idUsuario'];
                $_SESSION['Nombre'] = $fila2['Nombre'];
                $_SESSION['Correo'] = $fila['Direccion_correo'];
                $_SESSION['Contraseña'] = $fila2['Contraseña'];

                header("Location:../visitante/MenuVisitante.php");
            }
            if ($fila2['Tipo_usuario'] == 2) {

                $_SESSION['idUsuarioEm'] = $fila2['idUsuario'];
                $_SESSION['NombreEm'] = $fila2['Nombre'];
                $_SESSION['CorreoEm'] = $fila['Direccion_correo'];
                $_SESSION['ContraseñaEm'] = $fila2['Contraseña'];

                header("Location:../emprendedor/MenuEmprendedor.php");
            }
            if ($fila2['Tipo_usuario'] == 3) {

                $_SESSION['idUsuarioAdmin'] = $fila2['idUsuario'];
                $_SESSION['NombreAdmin'] = $fila2['Nombre'];
                $_SESSION['CorreoAdmin'] = $fila['Direccion_correo'];
                $_SESSION['ContraseñaAdmin'] = $fila2['Contraseña'];

                header("location:../Administrador/MenuAdministrador.php");
            }
        }
        echo '<script language = javascript> alert("Error al iniciar sesión, por favor vuelve a intentarlo")
        self.location = "../Login.php"</script>';
    } else {
        echo '<script language = javascript> alert("Tu cuenta ha sido suspendida, por favor contactanos para obtener más detalles")
        self.location = "../Contacto.php"</script>';
    }
} else {
    echo '<script language = javascript> alert("Error al iniciar sesión, por favor vuelve a intentarlo")
    self.location = "../Login.php"</script>';
}

?>