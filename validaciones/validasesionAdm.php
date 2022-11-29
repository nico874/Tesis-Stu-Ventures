<?php

session_start();

if(isset($_SESSION['idUsuarioAdmin']) && isset($_SESSION['CorreoAdmin']) && isset($_SESSION['ContraseñaAdmin']) ){
	
}else{
	echo'<script language = javascript> alert("Usuario no autenticado")
		self.location = "../Login.php"</script>';
}

?>