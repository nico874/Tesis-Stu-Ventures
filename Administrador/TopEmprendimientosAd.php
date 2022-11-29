<?php include("../bd/conexion.php");
include("../validaciones/validasesionAdm.php"); ?>
<?php

$sqlUsuario = "SELECT * FROM usuario WHERE idUsuario = '$_SESSION[idUsuarioAdmin]'";
$resultadoUsuario = mysqli_query($conexion, $sqlUsuario);
$filasUsuario  =  mysqli_fetch_array($resultadoUsuario);

$sqlInstituciones = "SELECT * FROM institucion";
$resultadoInstituciones = mysqli_query($conexion, $sqlInstituciones);
$filasInstituciones =  mysqli_fetch_array($resultadoInstituciones);

$sqlSede = "SELECT Sede from institucion WHERE Nombre_Institucion = '$filasInstituciones[Nombre_Institucion]' ";
$resultadoSede = mysqli_query($conexion, $sqlSede);
$Sede = (isset($_POST['Sede'])) ? $_POST['Sede'] : "";
$_SESSION['Sede'] = $Sede;

$sqlMensajes = "SELECT COUNT(*) Estado from chat Where Recibe_Usuarioid = '$_SESSION[idUsuarioAdmin]' AND Estado = '1'";
$resultaMensa = mysqli_query($conexion, $sqlMensajes);
$filamensa = mysqli_fetch_array($resultaMensa);

$Totalmensajes = $filamensa['Estado'];

date_default_timezone_set("America/Santiago");

$semana = date("W");

if (!isset($_GET['TituloEmprendi'])) {
    $_GET['TituloEmprendi'] = "";
    $TituloEmprendi = $_GET['TituloEmprendi'];
}
$TituloEmprendi = $_GET['TituloEmprendi'];

if (!isset($_GET['categoria'])) {
    $_GET['categoria'] = "";
    $Categoria = $_GET['categoria'];
}
$Categoria = $_GET['categoria'];

if ($TituloEmprendi != "") {
    $sqlEmprendiFecha = "SELECT * from publicacion Where  titulo LIKE '%" . $TituloEmprendi . "%' AND ActivoPubli = '1' AND WEEK(fecha)=$semana  ORDER BY Valoracion desc LIMIT 9 ";
    $resulFecha = mysqli_query($conexion, $sqlEmprendiFecha);
} else {
    if ($Categoria != "") {

        $sqlPublicaciones = "SELECT * FROM publicacion  WHERE Categoria ='$Categoria'  AND ActivoPubli = '1' AND WEEK(fecha)=$semana ORDER BY Valoracion desc LIMIT 9 ";
        $resulFecha = mysqli_query($conexion, $sqlPublicaciones);
    } else {
        $sqlEmprendiFecha = "SELECT * from publicacion Where  ActivoPubli = '1' AND WEEK(fecha)=$semana ORDER BY Valoracion desc LIMIT 10 ";
        $resulFecha = mysqli_query($conexion, $sqlEmprendiFecha);
    }
}
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="../js/funciones.js"></script>
    <link rel="stylesheet" href="../css/estilos.css">
    <title>Top semanal | Administrador</title>

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


    <!--IMAGEN-->
    <section class="view">
        <div class="imagenTop bg-image">
            <img src="../img/topEmprendi.png" class="w-100" id="imgCentral" alt="" />
        </div>
    </section>

    <!--TARJETAS-->
    <section class="contenederEmprendis"><br>
        <div class="container">
            <div class="person2">
                <a href="MenuAdministrador.php"> <i class="bi bi-arrow-left-circle"></i> </a>
            </div>
        </div>
        <h1 class="tituloEmprendi w3-center w3-animate-top"><i class="bi bi-sort-up" id="iconoMorado"></i> TOP SEMANAL
            <hr>
        </h1>
        <div id="TextoCentro"><br>
            <div class="container">
                <p>¡Top semanal de los <b id="rigth">10</b> emprendimientos <b id="LinksEstas">MEJORES VALORADOS!</b> </p>
                <p><b id="LinksEstas">¡RECUERDA!</b></p>
                <p>El top semanal de Stu-Ventures se basa en generar una sección aparte de los <b id="rigth">10</b> emprendimientos mejores valorados
                    por semana para darles una mayor visibilidad, otorgándoles este "reconocimiento por semana".</p><br>
            </div>
        </div>

        <!--TARJETAS-->
        <div class="container">
            <div class="row g-3">
                <?php
                $conta = 0;
                $contaVueltas = 0;
                while ($filaFecha = mysqli_fetch_array($resulFecha)) {
                    $contaVueltas++;
                    if ($filaFecha['Valoracion'] == 0.0 && $filaFecha['Valoracion'] < 1.0) {
                        $trellas = "";
                        $trellasWhite = "★★★★★";
                    }
                    if ($filaFecha['Valoracion'] >= 1.0 && $filaFecha['Valoracion'] < 2.0) {
                        $trellas = "★";
                        $trellasWhite = "★★★★";
                    }
                    if ($filaFecha['Valoracion'] >= 2.0 && $filaFecha['Valoracion'] < 3.0) {
                        $trellas = "★★";
                        $trellasWhite = "★★★";
                    }
                    if ($filaFecha['Valoracion'] >= 3.0 && $filaFecha['Valoracion'] < 4.0) {
                        $trellas = "★★★";
                        $trellasWhite = "★★";
                    }
                    if ($filaFecha['Valoracion'] >= 4.0 && $filaFecha['Valoracion'] < 5.0) {
                        $trellas = "★★★★";
                        $trellasWhite = "★";
                    }
                    if ($filaFecha['Valoracion'] == 5.0) {
                        $trellas = "★★★★★";
                        $trellasWhite = "";
                    }
                    $conta = 5;

                ?>
                    <div class="card col-lg-6 col-md-6 col-sm-12  w3-center w3-animate-left" id="tajertaEmprendi2">
                        <div class="d-flex justify-content-center">
                            <img src="data:image/jpg;base64, <?php echo base64_encode($filaFecha["Foto_publicacion"]); ?>" class="img-fluid " id="ImgTop" alt="...">
                        </div>
                        <div class="card-body">
                            <div class=" CategoriaTop">
                                Categoría: <?php echo ($filaFecha["Categoria"]); ?>
                            </div>
                            <h5 class="card-title titulo5"><?php echo ($filaFecha["Titulo"]); ?>
                                <hr>
                            </h5>
                            <?php
                            $sqlCantiValora = "SELECT COUNT(*) Usuario_idUsuario from valoracion WHERE Publicacion_idPublicacion = '$filaFecha[idPublicacion]'";
                            $resulCantiValora = mysqli_query($conexion, $sqlCantiValora);
                            $filaCantiValora = mysqli_fetch_array($resulCantiValora);
                            $totalCantiValora =  $filaCantiValora['Usuario_idUsuario'];
                            ?>
                            <b class="d-flex justify-content-center align-items-center" id="valoracion"><?php echo $trellas ?> <span class="EstrellaBl "><?php echo $trellasWhite ?>
                                </span><span class="CantiPerso"> (<?php echo  $totalCantiValora ?>)</span>
                            </b>
                            <?php
                            $sqlIntituSede = "SELECT * from institucion WHERE idInstitucion = '$filaFecha[Institucion_idInstitucion]'";
                            $resulSqlI = mysqli_query($conexion, $sqlIntituSede);
                            $FilaInstituSede = mysqli_fetch_array($resulSqlI);
                            ?>
                            <p class="card-text">Institución: <?php echo ($FilaInstituSede["Nombre_Institucion"]); ?>, <?php echo ($FilaInstituSede["Sede"]); ?>.</p>
                            <p class="card-text">Breve Descripición: <?php echo ($filaFecha["Breve_Descripcion"]); ?>...</p>
                            <p class="card-text" name="Precio">Precio: <?php echo ($filaFecha["Precio"]); ?></p>
                            <div class="BtnVerMas">
                                <a class="btn VerMasTop" href="Veremprendimientoadm.php?idPublicacion=<?php echo $filaFecha['idPublicacion'] ?>"> Ver más</a>
                            </div>
                            <div class="card-footer d-flex justify-content-start">
                                <small class="text-muted">Fecha de publicación: <?php echo ($filaFecha["Fecha"]); ?></small>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <?php if ($contaVueltas < 1) { ?>
                <h1 class="colorTurquesaCentro">LAMENTABLEMENTE ESTA SEMANA NO HAY UN EMPRENDIMIENTO EN EL TOP;(</h1>
            <?php  } ?>
        </div> <br>
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
                <p class="rights"><span>&copy; Todos los derechos reservados, Stu-Ventures, Chile 2022 (Fines
                        educativos, Tesis)</span></p>
            </div>
        </div>
    </footer>
</body>

</html>