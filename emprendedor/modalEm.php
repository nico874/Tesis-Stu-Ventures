<?php include("../bd/conexion.php");
include("../validaciones/validarsesionEm.php"); ?>

<?php

$idPubli = (isset($_POST['idPubli'])) ? $_POST['idPubli'] : "";
$ActivoPubli = (isset($_POST['ActivoPubli'])) ? $_POST['ActivoPubli'] : "";
$Valoracion = (isset($_POST['Valoracion'])) ? $_POST['Valoracion'] : "";
$TotalValora = (isset($_POST['TotalValora'])) ? $_POST['TotalValora'] : "";
$Visitas = (isset($_POST['Visitas'])) ? $_POST['Visitas'] : "";
$TotalChats = (isset($_POST['TotalChats'])) ? $_POST['TotalChats'] : "";
$Foto = (isset($_POST['Foto'])) ? $_POST['Foto'] : "";
$Titulo = (isset($_POST['Titulo'])) ? $_POST['Titulo'] : "";
$Categoria = (isset($_POST['Categoria'])) ? $_POST['Categoria'] : "";
$BreveDescrip = (isset($_POST['BreveDescrip'])) ? $_POST['BreveDescrip'] : "";
$Descripcion = (isset($_POST['Descripcion'])) ? $_POST['Descripcion'] : "";
$Fecha = (isset($_POST['Fecha'])) ? $_POST['Fecha'] : "";
$Precio = (isset($_POST['Precio'])) ? $_POST['Precio'] : "";
$Emprendedor = (isset($_POST['Emprendedor'])) ? $_POST['Emprendedor'] : "";
$Institucion = (isset($_POST['Institucion'])) ? $_POST['Institucion'] : "";
$Sede = (isset($_POST['Sede'])) ? $_POST['Sede'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";
$FotoNueva = (isset($_POST['FotoNueva']));
$hola = 0;

$mostrarModal = false;


switch ($accion) {

    case "btnEliminar":

        $consultaP = "UPDATE publicacion set ActivoPubli = '3' WHERE idPublicacion = '$idPubli'";

        if (mysqli_query($conexion, $consultaP)) {
            header('Location: Misemprendimientos.php');
        } else {
            echo "ERROR";
        }

        break;

    case "Seleccionar":
        $mostrarModal = true;
        $accionDisabled = "";
        $accionDisa = "disabled";
        break;


    case "btnActualizaAct":

        $consultaP = "UPDATE publicacion set ActivoPubli = '1' WHERE idPublicacion = '$idPubli'";
        if (mysqli_query($conexion, $consultaP)) {

            header('Location: Misemprendimientos.php?Activo=1');
        }
        break;
    case "BtnActualizar":
        if (isset($FotoNueva)) {
            $archivo = addslashes(file_get_contents($_FILES['FotoNueva']['tmp_name']));
            if (isset($archivo) && $archivo != "") {

                $tipo = $_FILES['FotoNueva']['type'];
                $tamano = $_FILES['FotoNueva']['size'];
                $temp = $_FILES['FotoNueva']['tmp_name'];

                if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano > 50000 && $tamano < 1000000))) {
                    echo '<script language="javascript">alert("No se ha podido actualizar tu emprendimiento, ¡La imagen debe ser mayor de 50 kb y menor a 1mb!");
                        window.location.assign("../emprendedor/Misemprendimientos.php");</script>';
                } else {
                    $moneda = number_format((float)$Precio, 0);
                    $conslutaUpInsti = "SELECT * FROM institucion WHERE Sede = '$Sede'";
                    $resultadoUpInsti = mysqli_query($conexion, $conslutaUpInsti);
                    $filasUpInsti = mysqli_fetch_array($resultadoUpInsti);

                    $consultaUpPu = "UPDATE publicacion set Titulo = '$Titulo', Categoria= '$Categoria', Breve_Descripcion = '$BreveDescrip', Descripcion = '$Descripcion', Precio = '$ $moneda', 
                    Institucion_idInstitucion = '$filasUpInsti[idInstitucion]' WHERE idPublicacion = '$idPubli'";
                    $consultaUpPufoto = "UPDATE publicacion set Foto_publicacion = '$archivo' WHERE idPublicacion = '$idPubli'";
                    if (mysqli_query($conexion, $consultaUpPu) && mysqli_query($conexion, $consultaUpPufoto)) {
                        $hola = 1;
                    }
                }
            }
        }
        break;
    case "Inactivo":
        $consultaP = "UPDATE publicacion set ActivoPubli = '0' WHERE idPublicacion = '$idPubli'";
        if (mysqli_query($conexion, $consultaP)) {
            header("Location:Misemprendimientos.php");
        }

        break;
}
$sqlUsuario = "SELECT * FROM usuario WHERE idUsuario = '$_SESSION[idUsuarioEm]'";
$resultadoUsuario = mysqli_query($conexion, $sqlUsuario);
$filasUsuario  =  mysqli_fetch_array($resultadoUsuario);

$sqlMensajes = "SELECT COUNT(*) Estado from chat Where Recibe_Usuarioid = '$_SESSION[idUsuarioEm]' AND Estado = '1'";
$resultaMensa = mysqli_query($conexion, $sqlMensajes);
$filamensa = mysqli_fetch_array($resultaMensa);

$Totalmensajes = $filamensa['Estado'];

$sqlChatMen = "SELECT * from chat Where Recibe_Usuarioid= '$_SESSION[idUsuarioEm]' AND Estado = '1' ORDER BY idCorres";
$resultChatMen = mysqli_query($conexion, $sqlChatMen);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/stu-ventures2.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/0086a4c4a4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/estilos.css">
    <script src="../js/funciones.js"></script>
    <title>Detalles emprendimiento | Emprendedor</title>
</head>
<script>
    function ConfirmarActivo() {
        var respuesta = confirm("¿Estas seguro que deseas ACTIVAR tu emprendimiento?");
        if (respuesta == true) {
            return true;
        } else {
            return false;
        }
    }

    function ConfirmarDeleteUser() {
        var respuesta = confirm("¿Estas seguro que deseas ElIMINAR tu emprendimiento?");
        if (respuesta == true) {
            return true;
        } else {
            return false;
        }
    }

    function ConfirmarSupender() {
        var respuesta = confirm("¿Estas seguro que deseas SUSPENDER tu emprendimiento?");
        if (respuesta == true) {
            return true;
        } else {
            return false;
        }
    }

    function ConfirmarActualizarEm() {
        var respuesta = confirm("¿Estás seguro que quieres actualizar este emprendimiento?");
        if (respuesta == true) {
            return true;

        } else {
            return false;
        }
    }
</script>

<body>
    <div class="header-top"></div>

    <!--MENU-->

    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-white">
        <div class="container-fluid">
            <a href="MenuEmprendedor.php" class="brand-logo "> <img src="../img/logo2.PNG" class="img-fluid" width="298px"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <div class="navbar-nav  ms-auto text-center " id="navEfecto">
                    <div class="dropdown">
                        <a class="btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-regular fa-comments"></i> <b id="rigth"><?php echo $Totalmensajes ?></b>
                        </a>
                        <ul class="dropdown-menu" id="dropdown-menu2">
                            <h4>Mensajes pendientes</h4>
                            <?php
                            $contaVueltas = 0;
                            while ($filasChatMen = mysqli_fetch_array($resultChatMen)) {
                                $contaVueltas++;
                            ?>
                                <li>
                                    <div class="message-feed media" id="mensa2">
                                        <a href="ChatEmprende.php?idCorres=<?php echo $filasChatMen['idCorres'] ?>" class="estilo0">
                                            <div class="message-container3">
                                                <div class="media-body3">
                                                    <?php
                                                    $sqlImgChat = "SELECT idEmprendi from chats_correspon WHERE idCorres='$filasChatMen[idCorres]' ";
                                                    $sqlresultImgChat = mysqli_query($conexion, $sqlImgChat);
                                                    $filaImgChat = mysqli_fetch_array($sqlresultImgChat);

                                                    $sqlImgChat2 = "SELECT * from publicacion WHERE idPublicacion = $filaImgChat[idEmprendi]  ";
                                                    $sqlresultImgChat2 = mysqli_query($conexion, $sqlImgChat2);
                                                    $filaImgChat2 = mysqli_fetch_array($sqlresultImgChat2);
                                                    ?>
                                                    <img src="data:image/jpg;base64, <?php echo base64_encode($filaImgChat2["Foto_publicacion"]); ?>" alt="avatar" class="img-avatar">
                                                    <div class="mf-content3">
                                                        <pre><?php echo $filasChatMen['Mensaje'] ?></pre>
                                                    </div>

                                                </div>
                                            </div>
                                        </a>
                                        <div class="message my-message" style="float:left; min-width: 300px;"></div>
                                    </div>
                                </li>
                            <?php } ?>
                            <?php if ($contaVueltas < 1) { ?>
                                <li>
                                    <div class="message-container3">
                                        <div class="media-body2">
                                            <div class="mf-content3">
                                                <pre> No tienes mensajes pendientes :)</pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="message my-message" style="float:left; min-width: 300px;"></div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="dropdown">
                        <a class="btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-regular fa-user-tie"></i> <?php echo $filasUsuario['Nombre'] ?> <?php echo $filasUsuario['Apellido_Paterno'] ?> <?php echo $filasUsuario['Apellido_Materno'] ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="MenuEmprendedor.php"><i class="bi bi-three-dots"></i> Menú</a></li>
                            <li><a class="dropdown-item" href="perfilEmprendedor.php"> <i class="fa-regular fa-user-tie"></i> Mi perfil</a></li>
                            <li><a class="dropdown-item" href="../validaciones/cerrarsesion.php"><i class="bi bi-box-arrow-right"></i> Cerrar sesión</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>



    <!--FILTRO DE BUSQUEDA-->
    <section class="contenederEmprendis"><br>


        <div class="left w3-center w3-animate-left" id="FiltroBusqueda">
            <form action="Administrador.php" method="GET">
                <div class="form-group col-md-12">
                    <h5 class="card-title titulo5">Para que sepas
                        <hr>
                    </h5><br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">

                                <div class="conte">
                                    <div class="col-md-12" id="IconoAdm7">
                                        <i class="bi bi-pencil-square"></i>
                                    </div>
                                    <div class="col-md-12">
                                        Este icono te indica que al hacer "clic" en dicho boton, podrás <b id="LinksEstas"> actualizar</b> los datos del emprendimiento.
                                    </div>
                                </div>
                                <div class="conte">
                                    <div class="col-md-12" id="IconoAdm8">
                                        <i class="bi bi-unlock"></i>
                                    </div>
                                    <div class="col-md-12">
                                        Este icono te indicará que el emprendimiento se encuentra <b id="LinksEstas">activo</b> y que <b id="LinksEstas">puedes suspenderlo</b> al hacer "clic" en dicho boton.
                                    </div>
                                </div>
                                <div class="conte">
                                    <div class="col-md-12" id="IconoAdm9">
                                        <i class="bi bi-lock"></i>
                                    </div>
                                    <div class="col-md-12">
                                        Esto icono te indicará que el emprendimiento se encuentra <b id="LinksEstas">inactivo</b> y que <b id="LinksEstas">podrás volver a activarlo</b> al hacer "clic" en dicho boton.
                                    </div>
                                </div>
                                <div class="conte">
                                    <div class="col-md-12" id="IconoAdm10">
                                        <i class="bi bi-trash"></i>
                                    </div>
                                    <div class="col-md-12">
                                        Este icono te indica que al hacer "clic" en dicho boton, podrás <b id="LinksEstas">eliminar</b> el emprendimiento.
                                    </div>
                                </div>
                                <div class="conte">
                                    <div class="col-md-12" id="IconoAdm5">
                                        <i class="bi bi-camera"></i>
                                    </div>
                                    <div class="col-md-12">
                                        Por último, la foto debe ser <b id="LinksEstas"> mayor a 50kb y menor a 1mb</b> dado los recursos actuales de Stu-Ventures:( . 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br>
            </form><br><br>
        </div>
        <div class="container">
            <div class="row g-3">
                <div class="fondoWhite">
                    <form action="modalEm.php" method="post" class="row g-3 needs-validation" novalidate enctype="multipart/form-data">
                        <div class="container">
                            <div class="person2">
                                <a href="Misemprendimientos.php"> <i class="bi bi-arrow-left-circle"></i> </a>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <h1 class="tituloEmprendi w3-center w3-animate-top">DETALLES EMPRENDIMIETO
                                <hr>
                            </h1>
                        </div>
                        <div class="d-flex justify-content-center">
                            <?php if ($ActivoPubli == 1) { ?>
                                <p class="font-italic mb-0 Activo text-center"><b>| EMPRENDIMIENTO ACTIVO |</b></p>
                            <?php } ?>
                            <?php if ($ActivoPubli == 2) { ?>
                                <p class="font-italic mb-0 text-danger text-center"><b>| SUSPENDIDO POR UN ADMINISTRADOR |</b></p>
                            <?php } ?>
                            <?php if ($ActivoPubli == 0) { ?>
                                <p class="font-italic mb-0 colomorado1 text-center"><b>| EMPRENDIMIENTO INACTIVO |</b></p>
                            <?php } ?>
                        </div>
                        <div class="px-4 pt-0 pb-4 cover bg-light" id="imgModal">
                            <div class="media align-items-end profile-head">
                                <div class="d-flex justify-content-center profile mr-3" id="FotoRedonda">
                                    <?php if ($FotoNueva != "1") {
                                        $sqlPublic = "SELECT * from publicacion WHERE idPublicacion = '$idPubli' ";
                                        $resultadoPublic = mysqli_query($conexion, $sqlPublic);
                                        $columnasPublic = mysqli_fetch_array($resultadoPublic);
                                        $Foto =  base64_encode($columnasPublic['Foto_publicacion']);
                                    ?>
                                        <img src="data:image/jpg;base64, <?php echo $Foto; ?>" alt="..." width="550" class="img-fluid">
                                    <?php } else { ?>
                                        <img src="data:image/jpg;base64, <?php echo $Foto ?>" alt="..." width="550" class="img-fluid">
                                    <?php } ?>

                                </div><br>
                                <?php
                                if ($Valoracion == 0.0 && $Valoracion < 1.0) {
                                    $trellas = "";
                                    $trellasWhite = "★★★★★";
                                }
                                if ($Valoracion >= 1.0 && $Valoracion < 2.0) {
                                    $trellas = "★";
                                    $trellasWhite = "★★★★";
                                }
                                if ($Valoracion >= 2.0 && $Valoracion < 3.0) {
                                    $trellas = "★★";
                                    $trellasWhite = "★★★";
                                }
                                if ($Valoracion >= 3.0 && $Valoracion < 4.0) {
                                    $trellas = "★★★";
                                    $trellasWhite = "★★";
                                }
                                if ($Valoracion >= 4.0 && $Valoracion < 5.0) {
                                    $trellas = "★★★★";
                                    $trellasWhite = "★";
                                }
                                if ($Valoracion == 5.0) {
                                    $trellas = "★★★★★";
                                    $trellasWhite = "";
                                }

                                ?>
                                <b class="d-flex justify-content-center align-items-center" id="valoracion"><?php echo $trellas ?> <span class="EstrellaBl "><?php echo $trellasWhite ?>
                                    </span><span class="CantiPerso"> (<?php echo  $TotalValora ?>)</span>
                                </b>
                            </div>
                        </div>

                        <div class="px-4 py-3 bg-light">
                            <div class=" d-flex justify-content-end text-center">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                        <h5 class="font-weight-bold mb-0 d-block"><?php echo $Valoracion; ?> </h5>
                                        <small class="text-muted"> <b id="rigth">Puntuación </b></small>
                                    </li>
                                    <li class="list-inline-item">
                                        <h5 class="font-weight-bold mb-0 d-block"><?php echo $TotalValora; ?></h5>
                                        <small class="text-muted"> <b id="rigth">Valoraciones </b></small>
                                    </li>
                                    <li class="list-inline-item">
                                        <h5 class="font-weight-bold mb-0 d-block"><?php echo $Visitas; ?></h5>
                                        <small class="text-muted"> <b id="rigth">Visitas </b></small>
                                    </li>
                                </ul>
                            </div>
                            <div class="p-2 textoCentra" id="informa">
                                <p class="font-italic mb-0" name="Titulo"><b id="LinksEstas">Titulo:</b> <?php echo $Titulo; ?></p>
                                <p class="font-italic mb-0" name="Categoria"><b id="LinksEstas">Categoria: </b><?php echo $Categoria; ?></p>
                                <p class="font-italic mb-0" name="BreveDescrip"><b id="LinksEstas">Descripción Breve:</b> <?php echo $BreveDescrip; ?></p>
                                <p class="font-italic mb-0" name="Descripcion"><b id="LinksEstas">Descripción:</b> <?php echo $Descripcion; ?></p>
                                <p class="font-italic mb-0" name="Fecha"><b id="LinksEstas">Fecha de publicación:</b> <?php echo $Fecha; ?></p>
                                <p class="font-italic mb-0" name="Precio"><b id="LinksEstas">Precio:</b><?php echo $Precio; ?></p>
                                <p class="font-italic mb-0" name="Institucion"><b id="LinksEstas">Institución:</b> <?php echo $Institucion; ?></p>
                                <p class="font-italic mb-0" name="Sede"><b id="LinksEstas">Sede:</b> <?php echo $Sede; ?></p>
                            </div>
                        </div>

                        <div class="card-footer">
                            <small class="text-muted"> </small>
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <p class="card-text"><b id="LinksEstas"> ACCIONES:</b> </p>
                        </div>
                        <div class="d-flex justify-content-center">
                            <input type="hidden" name="idPubli" value="<?php echo $idPubli  ?>">
                            <input type="hidden" name="ActivoPubli" value="<?php echo $ActivoPubli ?>">
                            <input type="hidden" name="Valoracion" value="<?php echo $Valoracion ?>">
                            <input type="hidden" name="Visitas" value="<?php echo $Visitas ?>">
                            <input type="hidden" name="TotalValora" value="<?php echo $TotalValora; ?>">
                            <input type="hidden" name="Foto" value="<?php echo ($Foto) ?>">
                            <input type="hidden" name="Titulo" value="<?php echo $Titulo ?>">
                            <input type="hidden" name="Categoria" value="<?php echo $Categoria ?>">
                            <input type="hidden" name="BreveDescrip" value="<?php echo $BreveDescrip ?>">
                            <input type="hidden" name="Descripcion" value="<?php echo $Descripcion ?>">
                            <input type="hidden" name="Fecha" value="<?php echo $Fecha ?>">
                            <input type="hidden" name="Precio" value="<?php echo $Precio ?>">
                            <input type="hidden" name="Institucion" value="<?php echo $Institucion ?>">
                            <input type="hidden" name="Sede" value="<?php echo $Sede ?>">
                            <button type="submit" class="Seleccionar" name="accion" value="Seleccionar"><i class="bi bi-pencil-square" id="accionesIco"></i></button>
                            <?php if ($ActivoPubli == 1) { ?>
                                <button value="Inactivo" type="submit" class="SeleccionarUnlock" name="accion" onclick=" return ConfirmarSupender()" title="SUSPENDER emprendimiento"><i class="bi bi-unlock" id="accionesIco"></i></button>
                            <?php } ?>
                            <?php if ($ActivoPubli == 0) { ?>
                                <button type="submit" class="EliminarS" name="accion" value="btnActualizaAct" title="Habilitar Emprendimiento" onclick=" return ConfirmarActivo()"><i class="bi bi-lock" id="accionesIco"></i></button>
                            <?php } ?>
                            <button value="btnEliminar" type="submit" class="EliminarSe" name="accion" onclick=" return ConfirmarDeleteUser()"><i class="bi bi-trash" id="accionesIco"></i></button>

                        </div>
                    </form>
                </div>
            </div><br><br>
            <form action="" method="post" class="row g-3 needs-validation" novalidate enctype="multipart/form-data">
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content" id="modal1">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body"><br>
                                <div class="row ">
                                    <?php if ($accion != "Seleccionar") { ?>
                                        <h5 class="card-title titulo5">Detalles Emprendimiento
                                            <hr>
                                        </h5>
                                    <?php } ?>
                                    <?php if ($accion == "Seleccionar") { ?>
                                        <h5 class="card-title titulo5">Editar Emprendimiento
                                            <hr>
                                        </h5>
                                    <?php } ?>
                                    <input type="hidden" class="form-control" value="<?php echo $idPubli; ?>" name="idPubli" id="idPubli">
                                    <?php if ($accion != "Seleccionar") { ?>
                                        <div class="px-4 pt-0 pb-4 cover bg-light" id="imgModal">
                                            <div class="media align-items-end profile-head">
                                                <div class="d-flex justify-content-center profile mr-3" id="FotoRedonda">
                                                    <img src=" <?php echo $Foto ?>" alt="..." width="330" class="img">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="bg-light p-4 d-flex justify-content-end text-center" id="ValoresEm">
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <h5 class="font-weight-bold mb-0 d-block"><?php echo $Valoracion; ?></h5>
                                                    <small class="text-muted"> <i class="fas fa-user mr-1"></i>Puntuación</small>
                                                </li>
                                                <li class="list-inline-item">
                                                    <h5 class="font-weight-bold mb-0 d-block"><?php echo $TotalValora; ?></h5>
                                                    <small class="text-muted"> <i class="fas fa-image mr-1"></i>Valoraciones</small>
                                                </li>
                                            </ul>
                                        </div>
                                        <h2 class="mb-0 colomorado">Información</h2><br><br>

                                        <div class="px-4 py-3 bg-light">
                                            <div class="p-4 textoCentra" id="informa">
                                                <p class="font-italic mb-0"><b id="LinksEstas">Titulo:</b> <?php echo $Titulo; ?></p>
                                                <p class="font-italic mb-0"><b id="LinksEstas">Categoria: </b><?php echo $Categoria; ?></p>
                                                <p class="font-italic mb-0"><b id="LinksEstas">Descripción Breve:</b> <?php echo $BreveDescrip; ?></p>
                                                <p class="font-italic mb-0"><b id="LinksEstas">Descripción:</b> <?php echo $Descripcion; ?></p>
                                                <p class="font-italic mb-0"><b id="LinksEstas">Fecha de publicación:</b> <?php echo $Fecha; ?></p>
                                                <p class="font-italic mb-0"><b id="LinksEstas">Precio: </b><?php echo $Precio; ?></p>
                                                <p class="font-italic mb-0"><b id="LinksEstas">Institución:</b> <?php echo $Institucion; ?></p>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <?php if ($accion == "Seleccionar") { ?>
                                        <div class="form-group col-md-12">
                                            <div class="px-4 pt-0 pb-4 cover bg-light" id="imgModal">
                                                <div class="media align-items-end profile-head">
                                                    <div class="d-flex justify-content-center profile mr-3" id="FotoRedonda">
                                                        <img src="data:image/jpg;base64, <?php echo $Foto ?>" alt="..." width="330" class="img">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($accion == "Seleccionar") { ?>
                                        <div class="form-group col-md-6">
                                            <label for="Titulo">Emprendimiento<b id="rojo">*</b>:</label>
                                            <input type="text" class="form-control" value="<?php echo $Titulo; ?>" name="Titulo" id="Titulo" required <?php echo $accionDisabled ?>>
                                        </div>
                                    <?php } ?>
                                    <?php if ($accion == "Seleccionar") { ?>
                                        <div class="form-group col-md-6">
                                            <label for="Categoria">Categoria<b id="rojo">*</b>:</label>
                                            <?php
                                            $consultaPubli = "SELECT * from publicacion";
                                            $resultadoPubli = mysqli_query($conexion, $consultaPubli);

                                            ?>
                                            <select name="Categoria" id="Categoria" class="form-select" required <?php echo $accionDisabled ?>>
                                                <option name="Categoria" value="<?php echo $Categoria; ?>"><?php echo $Categoria; ?></option>
                                                <option name="Categoria" value="Intelectual">Intelectual</option>
                                                <option name="Categoria" value="Deporte">Deporte</option>
                                                <option name="Categoria" value="Tecnología">Tecnología</option>
                                                <option name="Categoria" value="Entretenimiento">Entretenimiento</option>
                                                <option name="Categoria" value="Útiles">Útiles</option>
                                                <option name="Categoria" value="Material">Material</option>
                                                <option name="Categoria" value="Ropa">Ropa</option>
                                                <option name="Categoria" value="Comida">Comida</option>
                                                <option name="Categoria" value="Bebidas">Bebidas</option>
                                                <option name="Categoria" value="Salud">Salud</option>
                                                <option name="Categoria" value="Accesorios">Accesorios</option>
                                                <option name="Categoria" value="Cosméticos">Cosméticos</option>
                                                <option name="Categoria" value="Electrodomésticos">Electrodomésticos</option>
                                                <option name="Categoria" value="Electrónica">Electrónica</option>
                                                <option name="Categoria" value="Hogar y muebles">Hogar y muebles</option>
                                                <option name="Categoria" value="Herramientas">Herramientas</option>
                                                <option name="Categoria" value="Mascotas">Mascotas</option>
                                            </select>
                                        </div>
                                    <?php } ?>

                                    <?php if ($accion == "Seleccionar") { ?>
                                        <div class="form-group col-md-12">
                                            <label for="BreveDescrip">Descripción Breve<b id="rojo">*</b>:</label>
                                            <textarea name="BreveDescrip" class="form-control" style="min-height: 100px;" id="BreveDescrip" <?php echo $accionDisabled ?> required><?php echo $BreveDescrip; ?> </textarea>
                                        </div>
                                    <?php } ?>
                                    <?php if ($accion == "Seleccionar") { ?>
                                        <div class="form-group col-md-12" id="DescripcionDiv">
                                            <label for="Descripcion">Descripcion<b id="rojo">*</b>:</label>
                                            <textarea name="Descripcion" id="Descripcion" style="  min-height: 200px;" class="form-control" required <?php echo $accionDisabled ?>><?php echo $Descripcion; ?></textarea>
                                        </div>
                                    <?php } ?>
                                    <?php if ($accion == "Seleccionar") { ?>
                                        <div class="form-group col-md-6">
                                            <label for="Precio">Precio<b id="rojo">*</b>:</label>
                                            <input type="text" class="form-control" pattern="^[1-9]\d*$" value="<?php echo $Precio; ?>" name="Precio" id="Precio" required <?php echo $accionDisabled; ?>>
                                            <div class="invalid-feedback">
                                                Debes ingresar un valor númerico positivo y sin ningún símbolo.
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($accion == "Seleccionar") { ?>
                                        <input type="hidden" name="Visitas" value="<?php echo $Visitas ?>">
                                        <input type="hidden" class="form-control" value="<?php echo $Fecha; ?>" name="Fecha" id="Fecha">
                                        <input type="hidden" class="form-control" value="<?php echo $Valoracion; ?>" name="Valoracion" id="Valoracion">
                                        <input type="hidden" class="form-control" value="<?php echo $TotalValora; ?>" name="TotalValora" id="TotalValora">
                                        <input type="hidden" class="form-control" value="<?php echo $Institucion; ?>" name="Institucion" id="Institucion">
                                    <?php } ?>
                                    <?php if ($accion == "Seleccionar") { ?>
                                        <div class="form-group col-md-6">
                                            <label for="Sede">Sede<b id="rojo">*</b>:</label>
                                            <?php
                                            $consultaInstitu = "SELECT * from institucion";
                                            $resultadoInstitu = mysqli_query($conexion, $consultaInstitu);
                                            $filasInstitu = mysqli_fetch_array($resultadoInstitu);

                                            $sqlSede = "SELECT Sede from institucion WHERE Nombre_Institucion = '$filasInstitu[Nombre_Institucion]' ";
                                            $resultadoSede = mysqli_query($conexion, $sqlSede);
                                            ?>
                                            <select name="Sede" id="Sede" class="form-select" required <?php echo $accionDisabled ?>>
                                                <option name="Sede" value="<?php echo $Sede; ?>"><?php echo $Sede; ?></option>
                                                <?php while ($filasSede = mysqli_fetch_array($resultadoSede)) { ?>
                                                    <option name="Sede" value="<?php echo $filasSede['Sede']; ?>"><?php echo $filasSede['Sede']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    <?php } ?>
                                    <?php if ($accion == "Seleccionar") { ?>
                                        <div class="form-group col-md-12">
                                            <label for="FotoNueva">Foto Nueva<b id="rojo">*</b>:</label>
                                            <input type="file" accept="image/*" class="form-control" name="FotoNueva" id="imagen" required>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <?php if ($accion == "Seleccionar") { ?>
                                    <button type="submit" class="Seleccionar" name="accion" value="BtnActualizar" onclick=" return ConfirmarActualizarEm()">Actualizar</button>
                                <?php } ?>
                                <button type="button" class="VerDatos" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <?php if ($mostrarModal) { ?>
                <script>
                    $(window).on('load', function() {
                        $("#exampleModal").modal('show');
                    });
                </script>
            <?php } ?>
    </section>
    <script>
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
    <!--BOTON IR ARRIBA-->
    <span class="ir-arriba bi bi-chevron-double-up"></span>

    <!--PIE DE PAGINA-->
    <div class="final"></div>
    <footer class="section footer-minimal context-dark">
        <div class="container wow-outer">
            <div class="wow fadeIn">
                <div class="row row-60">
                    <div class="col-12">
                        <ul class="footer-minimal-nav">
                            <li><a href="../Index.html" target="_blank">Inicio</a></li>
                            <li><a href="../Contacto.php" target="_blank">Contacto</a></li>
                            <li><a href="../donacion.php" target="_blank">Donaciones</a></li>
                            <li><a href="../Preguntas.html" target="_blank"> Preguntas frecuentes</a></li>
                            <li><a href="../Politicas.html" target="_blank"> Términos y condiciones</a></li>
                        </ul>
                    </div>
                    <br><br><br>
                    <div class="col-12">
                        <ul class="social-list">
                            <li><a class="icon icon-sm icon-circle icon-circle-md icon-bg-white bi bi-facebook" href="https://www.facebook.com/profile.php?id=100085513805805" target="_blank"></a></li>
                            <li><a class="icon icon-sm icon-circle icon-circle-md icon-bg-white bi bi-instagram" href="https://www.instagram.com/stu.ventures/" target="_blank"></a></li>
                            <li><a class="icon icon-sm icon-circle icon-circle-md icon-bg-white bi bi-twitter" href="https://twitter.com/StuVentures" target="_blank"></a></li>
                            <li><a class="icon icon-sm icon-circle icon-circle-md icon-bg-white bi bi-whatsapp" href="https://api.whatsapp.com/send?phone=979476221" target="_blank"></a></li>
                        </ul>
                    </div>
                </div>
                <br>
                <p class="rights"><span>&copy; Todos los derechos reservados, Stu-Ventures, Chile 2022 (Fines
                        educativos, Tesis)</span>
            </div>
        </div>
    </footer>
</body>

</html>