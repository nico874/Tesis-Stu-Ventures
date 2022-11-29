<?php

session_start();

if(isset($_SESSION['time']) && isset($_SESSION['idUsuario']) && isset($_SESSION['Correo']) && isset($_SESSION['Contraseña']) ){
	
}
else{
	echo'<script language = javascript> alert("Usuario no autenticado")
		self.location = "../Login.php"</script>';
}

?>