<?php include("../bd/conexion.php"); ?>

<?php

$Rut=$conexion->real_escape_string($_GET["rut"]);
$Nombre=$conexion->real_escape_string($_GET["nombre"]);
$ApellidoPaterno=$conexion->real_escape_string($_GET["ApellidoPaterno"]);
$ApellidoMaterno=$conexion->real_escape_string($_GET["ApellidoMaterno"]);
$TipoUsuario=$conexion->real_escape_string($_GET["TipoUsuario"]);
$Telefono=$conexion->real_escape_string($_GET["Telefono"]);
$email=$conexion->real_escape_string($_GET["email"]);
$Contrasena=$conexion->real_escape_string($_GET["Contrasena"]);
$Contrasena = password_hash($_GET["Contrasena"], PASSWORD_DEFAULT);

//$query = $conexion->prepare("SELECT * FROM correo_electronico WHERE Direccion_correo = ? ");
//$query->bind_param("s", $correo);
//$query->execute();
$act =1;


if ($TipoUsuario == 1) {
    $sql1 =$conexion->prepare("INSERT INTO usuario (rut, Tipo_usuario, Activo, Contraseña, Nombre, Apellido_Paterno, Apellido_Materno) VALUES (?,?,?,?,?,?,?)");
    $sql1->bind_param("ssissss",$Rut,$TipoUsuario, $act,$Contrasena, $Nombre, $ApellidoPaterno, $ApellidoMaterno);
    if ($sql1->execute()) {
        $sql2 =$conexion->prepare("SELECT idUsuario from usuario WHERE rut = ?");
        $sql2->bind_param("s", $Rut);
        $sql2->execute();
        $resultado1 = $sql2->get_result();
        //$resultado1 = mysqli_stmt_get_result($sql2);
        $fila1 = $resultado1->fetch_assoc();
        //$fila1 = mysqli_fetch_assoc($resultado1);
        echo 'si';
        if ($sql2->close()) {
            $sql3 =$conexion->prepare("INSERT INTO correo_electronico (Direccion_correo, Usuario_idUsuario) VALUES (?,?)");
            $sql3->bind_param("si", $email,$fila1["idUsuario"]); 
            $sql3->execute();
            //mysqli_stmt_execute($sql3);
        } 
        if ($sql3->close()) {
            $sql4 =$conexion->prepare("INSERT INTO telefono (Numero, Usuario_idUsuario) VALUES (?,?)");
            $sql4->bind_param("ii",$Telefono,$fila1["idUsuario"]);
            $sql4->execute();
            //mysqli_stmt_execute($sql4);
        }   
        if ($sql4->close()) {
            echo '<script language="javascript">alert("Te has registrado correctamente, VISITANTE");
            window.location.assign("../Login.php");</script>';
        }
    } else {
        echo '<script language="javascript">alert("No te has podido registrar :( vuelve a intentarlo");
        window.location.assign("../Registro.php");</script>';
    }
} else {
    
}
if ($TipoUsuario == 2) {

    $Fechanacimiento = $_GET["Fechanacimiento"];
    $Direccion = $_GET["Direccion"];
    $Comuna = $_GET["Comuna"];
    $Instagram = $_GET["Instagram"];
    $Facebook = $_GET["Facebook"];

    $sql5 =$conexion->prepare("INSERT INTO usuario (rut, Tipo_usuario, Activo, Contraseña, Nombre, Apellido_Paterno, Apellido_Materno, Fecha_Nacimiento, Instagram, Facebook) VALUES (?,?,?,?,?,?,?,?,?,?)");
        $sql5->bind_param("ssisssssss", $Rut,$TipoUsuario, $act, $Contrasena, $Nombre, $ApellidoPaterno, $ApellidoMaterno,$Fechanacimiento, $Instagram,$Facebook);
    if ($sql5->execute()) {
        $sql6 =$conexion->prepare("SELECT idUsuario from usuario WHERE rut = ?");
        $sql6->bind_param("s",$Rut);
        $sql6->execute();
        $resultado2 = $sql6->get_result();
        $fila2 = $resultado2->fetch_assoc();

        if ($sql6->close()) {
            $sql7 =$conexion->prepare("INSERT INTO correo_electronico (Direccion_correo, Usuario_idUsuario) VALUES (?,?)");
            $sql7->bind_param("si",$email,$fila2["idUsuario"]);
            $sql7->execute();
        }
        if ($sql7->close()) {
            $sql8 =$conexion->prepare("INSERT INTO telefono (Numero, Usuario_idUsuario) VALUES (?,?)");
            $sql8->bind_param("si",$Telefono,$fila2["idUsuario"]); 
            $sql8->execute();      
        }
        if ($sql8->close()) {
            $sql9 =$conexion->prepare("INSERT INTO direccion (Direccion, comuna, Usuario_idUsuario) VALUES (?,?,?)");
            $sql9->bind_param("ssi",$Direccion,$Comuna,$fila2["idUsuario"]);  
        }
        if ($sql9->execute()) {
            echo '<script language="javascript">alert("Te has registrado correctamente, EMPRENDEDOR");
            window.location.assign("../Login.php");</script>';
        }
    } else {
        echo '<script language="javascript">alert("No te has podido registrar :( vuelve a intentarlo");
        window.location.assign("../Registro.php");</script>';
    }
} else {
    
}



?>