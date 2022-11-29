<?php include("../bd/conexion.php");
include("../validaciones/validarsesionEm.php");
?>

<?php

date_default_timezone_set("America/Santiago");

$Titulo = $_POST["Titulo"];
$categoria = $_POST["categoria"];
$BreveDescripcion = $_POST["BreveDescripcion"];
$Descripcion = $_POST["Descripcion"];
$Sede = $_POST["Sede"];
$precio = $_POST["precio"];
$moneda = number_format((float)$precio, 0);
$foto = addslashes(file_get_contents($_FILES['foto']['tmp_name']));
$date = date('Y-m-d H:i:s');
$actp = 1;
$val = 0;
$visit = 0;
$subir = $_POST['subir'];

//Si se quiere subir una imagen
if (isset($subir)) {
    //Recogemos el archivo enviado por el formulario
    $archivo = $_FILES['foto']['name'];
    //Si el archivo contiene algo y es diferente de vacio
    if (isset($archivo) && $archivo != "") {
        //Obtenemos algunos datos necesarios sobre el archivo
        $tipo = $_FILES['foto']['type'];
        $tamano = $_FILES['foto']['size'];
        $temp = $_FILES['foto']['tmp_name'];
        //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
        if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano > 50000))) {
            echo '<script language="javascript">alert("No se ha podido publicar tu emprendimiento, ¡La imagen debe ser mayor de 50 kb!");
        window.location.assign("../emprendedor/PublicarEmprendimiento.php");</script>';
        } else {
            $sqlSedeI = $conexion->prepare("SELECT idInstitucion from institucion WHERE Sede = ? ");
            $sqlSedeI->bind_param("s", $Sede);
            $sqlSedeI->execute();
            $resultSql = $sqlSedeI->get_result();
            $filasSedeI = $resultSql->fetch_assoc();
            $sql = "INSERT INTO publicacion (Titulo, ActivoPubli, Categoria, Descripcion, Foto_publicacion, Visitas, Precio, Fecha, Usuario_idUsuario, Breve_Descripcion, Institucion_idInstitucion, Valoracion ) VALUES 
        ('$Titulo','$actp','$categoria','$Descripcion','$foto','$visit','$ $moneda','$date','$_SESSION[idUsuarioEm]','$BreveDescripcion','$filasSedeI[idInstitucion]','$val')";
            $sqlPubli = $conexion->prepare($sql);
            $sqlPubli->execute();
            if ($sqlPubli->close()) {
                echo '<script language="javascript">window.location.assign("Misemprendimientos.php");</script>';
            } else {
                echo '<script language="javascript">alert("No se ha podio publicar tu emprendimiento!");
            window.location.assign("../emprendedor/PublicarEmprendimiento.php");</script>';
            }
        }
    }
}


?>