<?php
include('bd/conexion.php');

$emailPass = $_POST["Correo"];

$consulta = "SELECT E.idCorreo_electronico, E.Direccion_correo, U.idUsuario, U.Nombre, U.Tipo_usuario, U.Contraseña, U.Activo
FROM correo_electronico E
INNER JOIN usuario U ON E.Usuario_idUsuario = U.idUsuario
WHERE E.Direccion_correo ='$emailPass'";

$resultado = mysqli_query($conexion, $consulta);


if($filas = mysqli_fetch_array($resultado)){
    
    $to = "$emailPass";
    $subject = 'Recuperación de contraseña';
    $message = 'Hola '.$filas['Nombre'].',
    <br/><br/>Tu contraseña es la siguiente: '.$filas['Contraseña'].'   , recuerda no compartirla. <span style="color: #ed1b24"></span> 
    <br/><br/>Esperamos haberte ayudado,
    <br/>Stu-Ventures 2022.';;

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: stuventurescontacto@gmail.com' . "\r\n" .
    'Reply-To: stuventurescontacto@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

    if (mail($to, $subject, $message, $headers)) {
        echo '<script language="javascript">alert("¡Se ha enviado tu contraseña! revisa tu correo electronico.");window.location.href="login.php"</script>';

    }else{
        echo '<script language="javascript">alert("No se pudo.");window.location.href="login.php"</script>';
    }
}else{
    echo '<script language="javascript">alert("No existe una cuenta asociada a ese correo.");window.location.href="Correo.php"</script>';
}
        


?>