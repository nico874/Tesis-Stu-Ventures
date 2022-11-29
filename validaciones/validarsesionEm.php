<?php

session_start();

if(isset($_SESSION['idUsuarioEm']) && isset($_SESSION['CorreoEm']) && isset($_SESSION['ContraseñaEm']) ){
	
}else{
	echo'<script language = javascript> alert("Usuario no autenticado")
		self.location = "../Login.php"</script>';
}

?>