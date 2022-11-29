<?php include("../bd/conexion.php");
include("../validaciones/validasesionAdm.php"); ?>
<?php




$idUsuario = $_GET['idUsuario'];




    $consultaU = "DELETE from correo_electronico WHERE Usuario_idUsuario = '".$idUsuario."'";
    $consultaUs = "DELETE from telefono WHERE Usuario_idUsuario ='".$idUsuario."'";
    $consultaUsar = "DELETE from direccion WHERE  Usuario_idUsuario = '".$idUsuario."'";
    $consultaUsa = "DELETE  from usuario WHERE idUsuario ='".$idUsuario."'";
   


if(mysqli_query($conexion, $consultaU) && mysqli_query($conexion, $consultaUs) && mysqli_query($conexion, $consultaUsar) && mysqli_query($conexion, $consultaUsa) ){
    echo '<script language="javascript">alert("Se ha eliminado con exito el usuario!");
    window.location.assign("../Administrador/GestionarUsers.php");</script>';
    
}else{
    echo '<script language="javascript">alert("No se ha podido eliminar al usuario!");
    window.location.assign("../Administrador/GestionarUsers.php");</script>';
}

?>