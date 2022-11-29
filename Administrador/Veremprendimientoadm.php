<?php include("../bd/conexion.php");
include("../validaciones/validasesionAdm.php"); ?>
<?php


$idpublicacion = $_GET["idPublicacion"];

$sqlVerpublicacion = "SELECT * FROM publicacion WHERE idPublicacion = '$idpublicacion'";
$resultadover = mysqli_query($conexion, $sqlVerpublicacion);
$filas = mysqli_fetch_array($resultadover);

if ($filas['Valoracion'] == 0.0 && $filas['Valoracion'] < 1.0) {
    $trellas = "";
    $trellasWhite = "★★★★★";
}
if ($filas['Valoracion'] >= 1.0 && $filas['Valoracion'] < 2.0) {
    $trellas = "★";
    $trellasWhite = "★★★★";
}
if ($filas['Valoracion'] >= 2.0 && $filas['Valoracion'] < 3.0) {
    $trellas = "★★";
    $trellasWhite = "★★★";
}
if ($filas['Valoracion'] >= 3.0 && $filas['Valoracion'] < 4.0) {
    $trellas = "★★★";
    $trellasWhite = "★★";
}
if ($filas['Valoracion'] >= 4.0 && $filas['Valoracion'] < 5.0) {
    $trellas = "★★★★";
    $trellasWhite = "★";
}
if ($filas['Valoracion'] == 5.0) {
    $trellas = "★★★★★";
    $trellasWhite = "";
}

$sqluserid = "SELECT * FROM usuario WHERE idUsuario = '" . $filas['Usuario_idUsuario'] . "'";
$resultadouserid = mysqli_query($conexion, $sqluserid);
$filasuser = mysqli_fetch_array($resultadouserid);

$sqlinstitucion = "SELECT * FROM institucion WHERE idInstitucion = '" . $filas['Institucion_idInstitucion'] . "'";
$resultadins = mysqli_query($conexion, $sqlinstitucion);
$filasins = mysqli_fetch_array($resultadins);


$sqltelefono = "SELECT * FROM telefono WHERE Usuario_idUsuario = '" . $filasuser['idUsuario'] . "'";
$resultadotele = mysqli_query($conexion, $sqltelefono);
$filastele = mysqli_fetch_array($resultadotele);

$sqlCantidadPu = "SELECT COUNT(*) ActivoPubli FROM publicacion Where Usuario_idUsuario ='$filas[Usuario_idUsuario]' AND ActivoPubli = '1'";
$resultadoCantiPu = mysqli_query($conexion, $sqlCantidadPu);
$filasCantiPu = mysqli_fetch_assoc($resultadoCantiPu);

$sqlUsuario = "SELECT * FROM usuario WHERE idUsuario = '$_SESSION[idUsuarioAdmin]'";
$resultadoUsuario = mysqli_query($conexion, $sqlUsuario);
$filasUsuario  =  mysqli_fetch_array($resultadoUsuario);

$sqlUserValo = "SELECT COUNT(*) idValoracion FROM valoracion Where Usuario_idUsuario ='$_SESSION[idUsuarioAdmin]' AND Publicacion_idPublicacion = '$idpublicacion'";
$resultadoUserValo = mysqli_query($conexion, $sqlUserValo);
$filasUserValo = mysqli_fetch_assoc($resultadoUserValo);

$conta = $filasUserValo['idValoracion'];
if ($conta >= "1") {
    $accionDisabled = 1;
    $sqlUserValo = "SELECT * FROM valoracion Where Usuario_idUsuario ='$_SESSION[idUsuarioAdmin]' AND Publicacion_idPublicacion = '$idpublicacion'";
    $resultadoUserValo = mysqli_query($conexion, $sqlUserValo);
    $filasUserValo = mysqli_fetch_assoc($resultadoUserValo);
} else {
    $accionDisabled = 0;
}
$cont = $filasCantiPu['ActivoPubli'];

$sqlMensajes = "SELECT COUNT(*) Estado from chat Where Recibe_Usuarioid = '$_SESSION[idUsuarioAdmin]' AND Estado = '1'";
$resultaMensa = mysqli_query($conexion, $sqlMensajes);
$filamensa = mysqli_fetch_array($resultaMensa);

$Totalmensajes = $filamensa['Estado'];

$sqlChatMen = "SELECT * from chat Where Recibe_Usuarioid= '$_SESSION[idUsuarioAdmin]' AND Estado = '1' ORDER BY idCorres";
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/0086a4c4a4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/estilos.css">
    <script src="../js/funciones.js"></script>
    <title>Emprendimiento | Administrador</title>
    <style>
        #form #valoracion2 {
            font-size: 40px;
        }

        input[type="radio"] {
            display: none;
        }

        #valoracion2 {
            color: grey;
            cursor: pointer;

        }

        .clasificacion {
            direction: rtl;
            unicode-bidi: bidi-override;
        }

        #valoracion2:hover,
        #valoracion2:hover~#valoracion2 {
            color: orange;
        }

        input[type="radio"]:checked~#valoracion2 {
            color: orange;
        }
    </style>
</head>

<body>
    <div class="header-top"></div>

    <!--MENU-->

    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-white">
        <div class="container-fluid">
            <a href="MenuAdministrador.php" class="brand-logo "> <img src="../img/logo2.PNG" class="img-fluid" width="298px"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <div class="navbar-nav  ms-auto text-center " id="navEfecto">
                    <div class="dropdown">
                        <a class="btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-regular fa-comments" id="ColorIcon"></i> <b id="rigth"><?php echo $Totalmensajes ?></b>
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
                                        <a href="ChatAdmin.php?idCorres=<?php echo $filasChatMen['idCorres'] ?>" class="estilo0">
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
                            <i class="fa-solid fa-user-shield"></i> <?php echo $filasUsuario['Nombre'] ?> <?php echo $filasUsuario['Apellido_Paterno'] ?> <?php echo $filasUsuario['Apellido_Materno'] ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="MenuAdministrador.php"><i class="bi bi-three-dots"></i> Menú</a></li>
                            <li><a class="dropdown-item" href="PerfilAdmin.php"> <i class="fa-solid fa-user-shield"></i> Mi perfil</a></li>
                            <li><a class="dropdown-item" href="../validaciones/cerrarsesion.php"><i class="bi bi-box-arrow-right"></i> Cerrar sesión</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!--EMPRENDIMIENTO-->
    <section class="contenedorEmprendimiento">
        <div class="conta1"><br><br>
            <div class="person2">
                <a href="javascript: history.go(-1)"> <i class="bi bi-arrow-left-circle"></i> </a>
            </div>
            <h1 class="tituloEmprendi w3-center w3-animate-top"><i class="bi bi-shop" id="iconoMorado"></i> EMPRENDIMIENTO
                <hr>
            </h1>
            <div class="fondoWhite">
                <div class="row w3-animate-left">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <div class="card mb-6" id="cardImgEmprendi">
                            <a href="#!" data-bs-toggle="modal" data-bs-target="#modalImage">
                                <img src="data:image/jpg;base64, <?php echo base64_encode($filas["Foto_publicacion"]); ?>" class="card-img-top img-fluid " id="imgEmprendimiento" alt="...">
                            </a>
                            <div class="card-body" id="contenidoBody">
                                <h5 class="card-title titulo5"><?php echo ($filas["Titulo"]); ?>
                                    <hr>
                                </h5>
                                <div class="CategoriaImg">Categoría: <?php echo ($filas["Categoria"]); ?></div>
                                <?php
                                $sqlCantiValora = "SELECT COUNT(*) Usuario_idUsuario from valoracion WHERE Publicacion_idPublicacion = '$filas[idPublicacion]'";
                                $resulCantiValora = mysqli_query($conexion, $sqlCantiValora);
                                $filaCantiValora = mysqli_fetch_array($resulCantiValora);
                                $totalCantiValora =  $filaCantiValora['Usuario_idUsuario'];
                                ?>
                                <b class="d-flex justify-content-center align-items-center" id="valoracion"><?php echo $trellas ?> <span class="EstrellaBl "><?php echo $trellasWhite ?>
                                    </span><span class="CantiPerso"> (<?php echo  $totalCantiValora ?>)</span>
                                </b>
                                <p class="card-text"><b id="LinksEstas">Institución:</b> <?php echo ($filasins["Nombre_Institucion"]); ?>, <?php echo ($filasins["Sede"]); ?>.</p>
                                <p class="card-text"><b id="LinksEstas"></b><?php echo ($filas["Descripcion"]); ?></p>
                                <p class="card-text" name="Precio"><b id="LinksEstas">Precio: </b><?php echo ($filas["Precio"]); ?></p>
                                <div class="card-footer" id="fechaFooter">
                                    <small class="text-muted">Fecha de publicación: <?php echo ($filas["Fecha"]); ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-12">
                        <div class="card mb-6" id="cardImgEmprendi">
                            <form action="InstanciaChatAdmin.php" method="GET">
                                <div class="card-body" id="DatosEmprend">
                                    <h5 class="card-title titulo5">Emprendedor
                                        <hr>
                                    </h5>
                                    <input type="hidden" name="idPubli" value="<?php echo ($filas["idPublicacion"]); ?>">
                                    <input type="hidden" name="NombrePubli" value="<?php echo ($filas["Titulo"]); ?>">
                                    <input type="hidden" name="idUser" value="<?php echo ($filasuser["idUsuario"]); ?>">
                                    <p class="card-text" name="Nombre"><i class="fa-regular fa-user-tie"></i> <?php echo ($filasuser["Nombre"]); ?> <?php echo ($filasuser["Apellido_Paterno"]); ?> <?php echo ($filasuser["Apellido_Materno"]); ?></p>
                                    <hr class="hrcompletoFino"><br>
                                    <h5 class="card-title titulo5">Redes sociales
                                        <hr>
                                    </h5>
                                    <p class="card-text fb" id="redesEmprende" name="Facebook"><a href="https://www.facebook.com/<?php echo ($filasuser["Facebook"]); ?>"><i class=" icon-circle-md bi bi-facebook"></i> <?php echo ($filasuser["Facebook"]); ?></a></p>
                                    <p class="card-text ig" id="redesEmprende" name="Instagram"><a href="https://www.instagram.com/<?php echo ($filasuser["Instagram"]); ?>"><i class="icon-circle-md bi bi-instagram" id="IgColor"></i> <?php echo ($filasuser["Instagram"]); ?></a> </p>
                                    <p class="card-text wsp" id="redesEmprende" name="Numero"><a href="https://api.whatsapp.com/send?phone=<?php echo ($filastele["Numero"]); ?>"><i class="icon-circle-md  bi bi-whatsapp"></i>+56 <?php echo ($filastele["Numero"]); ?> </a> </p>
                                    <hr class="hrcompletoFino"><br>
                                    <div class="col-md-12">
                                        <p><b id="LinksEstas"><?php echo "$cont" ?></b> </p>
                                        <b id="LinksEstas">
                                            <p class="card-text" name="Publicaciones">Emprendimientos publicados</p>
                                        </b>

                                    </div>
                                    <hr class="hrcompletoFino"><br>
                                    <div class="">
                                        <p>
                                            <button class="btnChatear" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                 Acciones
                                            </button>
                                        </p>
                                        <div class="collapse" id="collapseExample">
                                            <div class="card card-body bg-light">
                                                <div class="d-flex justify-content-center">
                                                    <button type="submit" class="btnChatear">Enviar un Mensaje </button>
                                                </div><br>
                                                <div class="d-flex justify-content-center">
                                                    <a href="Administrador.php?Buscar=<?php echo $filas["Titulo"] ?>" class="btnChatear">Gestionar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="hrcompletoFino">
                            </form>
                            <form action="" id="form" method="GET">
                                <div class="card-body" id="DatosEmprend">
                                    <h5 class="card-title titulo5">Valoración
                                        <hr>
                                    </h5>
                                    <p class="card-text">Este emprendimiento actualmente tiene una calificación de <b id="LinksEstas"><?php echo $filas["Valoracion"] ?> </b> | Valoraciones: <b id="LinksEstas"><?php echo  $totalCantiValora ?>.</b> </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Swiper -->
                <div class="swiper mySwiper">
                    <h1 class="tituloEmprendi w3-center w3-animate-top">Publicaciones del Emprendedor
                        <hr>
                    </h1>
                    <div class="swiper-wrapper">

                        <?php
                        $sqlCantidadPubli = "SELECT * from publicacion Where Usuario_idUsuario ='$filas[Usuario_idUsuario]' AND ActivoPubli = '1'";
                        $resultadoCantiPubli = mysqli_query($conexion, $sqlCantidadPubli);
                        $contaPublis = 0;
                        while ($filasCantiPubli = mysqli_fetch_assoc($resultadoCantiPubli)) {
                            $contaPublis++;
                            if ($filasCantiPubli['idPublicacion'] != $idpublicacion) {
                        ?> <div class="swiper-slide">
                                    <div class="card h-100 " id="tajertaEmprendi1">

                                        <img src="data:image/jpg;base64, <?php echo base64_encode($filasCantiPubli["Foto_publicacion"]); ?>" class="card-img-top img-fluid " id="imgEmprendimiento" alt="...">

                                        <div class="CategoriaImg">Categoría: <?php echo ($filasCantiPubli["Categoria"]); ?></div>
                                        <div class="card-body">
                                            <h5 class="card-title titulo5"><?php echo ($filasCantiPubli["Titulo"]); ?>
                                                <hr>
                                            </h5>
                                            <?php
                                            $sqlCantiValora = "SELECT COUNT(*) Usuario_idUsuario from valoracion WHERE Publicacion_idPublicacion = '$filasCantiPubli[idPublicacion]'";
                                            $resulCantiValora = mysqli_query($conexion, $sqlCantiValora);
                                            $filaCantiValora = mysqli_fetch_array($resulCantiValora);
                                            $totalCantiValora =  $filaCantiValora['Usuario_idUsuario'];

                                            $sqlVerpublicacion1 = "SELECT * FROM publicacion WHERE idPublicacion = '$filasCantiPubli[idPublicacion]'";
                                            $resultadover1 = mysqli_query($conexion, $sqlVerpublicacion1);
                                            $filas1 = mysqli_fetch_array($resultadover1);

                                            if ($filas1['Valoracion'] == 0.0 && $filas1['Valoracion'] < 1.0) {
                                                $trellas1 = "";
                                                $trellasWhite1 = "★★★★★";
                                            }
                                            if ($filas1['Valoracion'] >= 1.0 && $filas1['Valoracion'] < 2.0) {
                                                $trellas1 = "★";
                                                $trellasWhite1 = "★★★★";
                                            }
                                            if ($filas1['Valoracion'] >= 2.0 && $filas1['Valoracion'] < 3.0) {
                                                $trellas1 = "★★";
                                                $trellasWhite1 = "★★★";
                                            }
                                            if ($filas1['Valoracion'] >= 3.0 && $filas1['Valoracion'] < 4.0) {
                                                $trellas1 = "★★★";
                                                $trellasWhite1 = "★★";
                                            }
                                            if ($filas1['Valoracion'] >= 4.0 && $filas1['Valoracion'] < 5.0) {
                                                $trellas1 = "★★★★";
                                                $trellasWhite1 = "★";
                                            }
                                            if ($filas1['Valoracion'] == 5.0) {
                                                $trellas1 = "★★★★★";
                                                $trellasWhite1 = "";
                                            }
                                            ?>
                                            <b class="d-flex justify-content-center align-items-center" id="valoracion"><?php echo $trellas1 ?> <span class="EstrellaBl "><?php echo $trellasWhite1 ?>
                                                </span><span class="CantiPerso"> (<?php echo  $totalCantiValora ?>)</span>
                                            </b>
                                            <p class="card-text"><b id="LinksEstas">Breve descripción:</b> <?php echo ($filasCantiPubli["Breve_Descripcion"]); ?></p>
                                            <p class="card-text" name="Precio"><b id="LinksEstas">Precio: </b><?php echo ($filasCantiPubli["Precio"]); ?></p>
                                        </div>
                                        <div class="BtnVerMas">
                                            <a class="btn VerMas" href="Veremprendimientoadm.php?idPublicacion=<?php echo $filasCantiPubli['idPublicacion'] ?>"> Ver más</a>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                        <?php if ($contaPublis <= 1) { ?>
                            <div class="bg-light Nm">
                                <h2 class="noMás">No se han encontrado más publicaciones :( </h2>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div><br><br>
                    <div class="swiper-pagination"></div>
                </div>

                <!-- Swiper JS -->
                <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

                <!-- Initialize Swiper -->
                <script>
                    var swiper = new Swiper(".mySwiper", {
                        slidesPerView: 2,
                        spaceBetween: 30,
                        slidesPerGroup: 2,

                        loopFillGroupWithBlank: true,
                        pagination: {
                            el: ".swiper-pagination",
                            clickable: true
                        },
                        navigation: {
                            nextEl: ".swiper-button-next",
                            prevEl: ".swiper-button-prev"
                        }
                    });
                </script>
            </div>

        </div><br><br>

    </section>

    <!--MODAL-->

    <div tabindex="-1" aria-labelledby="modalImage" aria-hidden="true" class="modal fade" id="modalImage">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <img src="data:image/jpg;base64, <?php echo base64_encode($filas["Foto_publicacion"]); ?>" class="card-img-top img-fluid " id="imgEmprendimiento" alt="...">
            </div>
        </div>
    </div>

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
                        educativos, Tesis)</span></p>
            </div>
        </div>
    </footer>
</body>

</html>