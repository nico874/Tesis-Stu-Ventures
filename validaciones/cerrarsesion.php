<?php

session_start();

unset($_SESSION['Correo']);
unset($_SESSION['Contraseña']);
unset($_SESSION['idUsuario']);

unset($_SESSION['CorreoEm']);
unset($_SESSION['ContraseñaEm']);
unset($_SESSION['idUsuarioEm']);

unset($_SESSION['CorreoAdmin']);
unset($_SESSION['ContraseñaAdmin']);
unset($_SESSION['idUsuarioAdmin']);

session_destroy();

header("Location:../SesionCerrada.html");

?>