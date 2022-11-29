<?php include("../bd/conexion.php");
include("../validaciones/validarsesionEm.php"); ?>
<?php

$sqlUsuario = "SELECT * FROM usuario WHERE idUsuario = '$_SESSION[idUsuarioEm]'";
$resultadoUsuario = mysqli_query($conexion, $sqlUsuario);
$filasUsuario  =  mysqli_fetch_array($resultadoUsuario);

$sqlMensajes = "SELECT COUNT(*) Estado from chat Where Recibe_Usuarioid = '$_SESSION[idUsuarioEm]' AND Estado = '1'";
$resultaMensa = mysqli_query($conexion, $sqlMensajes);
$filamensa = mysqli_fetch_array($resultaMensa);

$Totalmensajes = $filamensa['Estado'];

$sqlMensajesTotal = "SELECT COUNT(*) idCorres from chats_correspon Where Para = '$_SESSION[idUsuarioEm]' AND ActivoChats BETWEEN 0 AND 1 ";
$resultaMensaTotal = mysqli_query($conexion, $sqlMensajesTotal);
$filamensaTotal = mysqli_fetch_array($resultaMensaTotal);

$TotalmensajesTotal = $filamensaTotal['idCorres'];

$sqlChatMen = "SELECT * from chat Where Recibe_Usuarioid= '$_SESSION[idUsuarioEm]' AND Estado = '1' ORDER BY idCorres";
$resultChatMen = mysqli_query($conexion, $sqlChatMen);

$sqlPublica = "SELECT * from publicacion Where Usuario_idUsuario = '$_SESSION[idUsuarioEm]' AND ActivoPubli = '1' ORDER BY Visitas desc LIMIT 1 ";
$resultPublica = mysqli_query($conexion, $sqlPublica);
$Publicacion = mysqli_fetch_array($resultPublica);

$sqlPublica2 = "SELECT * from publicacion Where Usuario_idUsuario = '$_SESSION[idUsuarioEm]' AND ActivoPubli = '1' ORDER BY Valoracion desc LIMIT 1 ";
$resultPublica2 = mysqli_query($conexion, $sqlPublica2);
$Publicacion2 = mysqli_fetch_array($resultPublica2);
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
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/estilos.css">
    <script src="../js/funciones.js"></script>
    <title>Menú | Emprendedor</title>

</head>

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
                            <i class="fa-regular fa-user-tie" id="ColorIcon"></i> <?php echo $filasUsuario['Nombre'] ?> <?php echo $filasUsuario['Apellido_Paterno'] ?> <?php echo $filasUsuario['Apellido_Materno'] ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="active1"><a class="dropdown-item" href="MenuEmprendedor.php"><i class="bi bi-three-dots"></i> Menú</a></li>
                            <li><a class="dropdown-item" href="perfilEmprendedor.php"> <i class="fa-regular fa-user-tie"></i> Mi perfil</a></li>
                            <li><a class="dropdown-item" href="../validaciones/cerrarsesion.php"><i class="bi bi-box-arrow-right"></i> Cerrar sesión</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <section class="contenederEmprendis"><br>
        <h1 class="tituloEmprendi w3-center w3-animate-top"><i class="bi bi-three-dots" id="iconoMorado"></i> MENÚ EMPRENDEDOR
            <hr>
        </h1>
        <div id="fondoGris"><br>
            <div class="container">
                <div class="row">
                    <div class="col-md-9" id="textoCenter1">
                        <p><b id="LinksEstas">Bienvenid@ emprendedor</b>, nos alegramos que estes aquí. Te recordamos que con tu cuenta del tipo emprendedor puedes realizar lo siguiente: </p>
                        <li>Publicar los emprendientos que quieras sin límite, siempre y cuando cumplan con los términos y condiciones. Haz "clic" en el siguiente enlace para ver los <a href="../Politicas.html"  target="_blank" id="btnregistro">términos y condiciones</a>.</li>
                        <li>Gestionar tus emprendimientos publicados.</li>
                        <li>Responder a los usuarios consultantes sobre el emprendimiento.</li> <br>
                        <p class="texocen"><b id="LinksEstas">PUBLICA, RESPONDE Y RECUERDA ¡MANTENER UN REPESTO!</b></p>
                    </div>
                    <div class="col-md-3 d-flex justify-content-end align-items-center" id="UserIdenti">
                        <a href="perfilEmprendedor.php">
                            <div class="imageUser d-flex justify-content-center align-items-center">
                                <i class="fa-regular fa-user-tie"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="fondoWhite ">
                <div class="moraCent">
                    <h2>ACCESOS </h2>
                    <hr class="fullhr">
                </div>

                <div class="row " style="padding: 0px;">
                    <div class="col-lg-4 col-md-12 mb-4 mb-lg-0" id="imagesHome">
                        <div class="image1">
                            <a class="" href="Misemprendimientos.php">
                                <img alt="" src="../img/universidad-2030.jpg" width="100%" height="250px" id="imagenMenu4" />
                                <div class="MásEmprendi4 d-flex justify-content-center align-items-center">
                                    <p> <i class="bi bi-shop-window" id="IconoBlanco"></i> MIS EMPRENDIMIENTOS </p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 mb-4 mb-lg-0 " id="imagesHome">
                        <div class="image2">
                            <a class="" href="PublicarEmprendimiento.php">
                                <img alt="" src="../img/idea2.jpg" width="100%" height="250px" id="imagenMenu5" />

                                <div class="MásEmprendi5 d-flex justify-content-center align-items-center">
                                    <p> <i class="bi bi-cloud-upload" id="IconoBlanco"></i> PUBLICAR</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 mb-4 mb-lg-0" id="imagesHome">
                        <div class="image2">
                            <a class="" href="Mensajes.php">
                                <img alt="" src="../img/chat1.jpg" width="100%" height="250px" id="imagenMenu6" />
                                <div class="MásEmprendi6 d-flex justify-content-center align-items-center">
                                    <p> <i class="bi bi-chat-dots" id="IconoBlanco"></i> MIS MENSAJES</p>
                                    </span>
                            </a>
                        </div><br>
                    </div>
                </div>
                <div class="fondoGris1">
                    <div class="moraCent3"><br>
                        <h2 class="text-center">MI RESUMEN
                            <hr>
                        </h2>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-12  d-flex justify-content-center align-items-center" id="imgMenuRed">
                            <img src="../img/chat3.jpg" alt="">
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12  d-flex justify-content-center align-items-center" id="textoCenter2">
                            <p>Actualmente te han consultado <b id="rigth"><?php echo $TotalmensajesTotal ?></b> usuarios por tu/s emprendiento/s.</p>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12   d-flex justify-content-center align-items-center" id="imgMenuRed">
                            <img src="../img/Estudiante.jpg" alt="">
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12  d-flex justify-content-center align-items-center" id="textoCenter2">
                            <p>Tienes <b id="rigth"><?php echo $Totalmensajes ?></b> mensaje/s pendiente/s.</p>
                        </div>
                        <?php if ($Publicacion != "") { ?>
                            <div class="col-lg-3 col-md-6 col-sm-12   d-flex justify-content-center align-items-center" id="imgMenuRed">
                                <img src="../img/gestionUsers2.jpg" alt="">
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-12  d-flex justify-content-center align-items-center" id="textoCenter2">
                                <p>Tu emprendimiento más visto es <b id="rigth"><?php echo $Publicacion['Titulo']; ?></b>, con un total de <b id="rigth"><?php echo $Publicacion['Visitas']; ?></b> visitas.</p>
                            </div>
                        <?php } ?>
                        <?php if ($Publicacion2 != "") { ?>
                            <div class="col-lg-3 col-md-6 col-sm-12   d-flex justify-content-center align-items-center" id="imgMenuRed">
                                <img src="../img/visitas.jpeg" alt="">
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12  d-flex justify-content-center align-items-center" id="textoCenter2">
                                <p>Tu emprendimiento mejor valorado es <b id="rigth"><?php echo $Publicacion2['Titulo']; ?></b>, con una puntuación de <b id="rigth"><?php echo $Publicacion2['Valoracion']; ?></b>.</p>
                            </div>
                        <?php } ?>

                    </div><br>
                </div>
            </div>
        </div><br><br>
    </section>

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
                <p class="rights"><span>&copy; Todos los derechos reservados, Stu-Ventures, Chile 2022 (Fines educativos)</span></p>
            </div>
        </div>
    </footer>

</body>

</html>