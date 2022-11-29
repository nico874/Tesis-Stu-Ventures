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

$sqlChatMen = "SELECT * from chat Where Recibe_Usuarioid= '$_SESSION[idUsuarioEm]' AND Estado = '1' ORDER BY idCorres";
$resultChatMen = mysqli_query($conexion, $sqlChatMen);

$sqlPublis = "SELECT COUNT(*) idPublicacion from publicacion WHERE Usuario_idUsuario = '$_SESSION[idUsuarioEm]' AND ActivoPubli = '1' ";
$resultaPublis = mysqli_query($conexion, $sqlPublis);
$filaPublis = mysqli_fetch_array($resultaPublis);

$TotalPublis = $filaPublis['idPublicacion'];
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
    <title>Mis Emprendimientos | Emprendedor</title>
</head>
<script>
    function ConfirmarDeleteUser() {
        var respuesta = confirm("¿Estas seguro que deseas ElIMINAR este emprendimiento?");
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

    <!--IMAGEN-->

    <section class="view">
        <div class="imagenTop bg-image">
            <img src="../img/estu02.jpg" class="w-100" id="imgCentral" alt="" />

        </div>
    </section>

    <!--FILTRO DE BUSQUEDA-->
    <section class="contenederEmprendis"><br>
        <div class="container-fluid">
            <div class="container">
                <div class="person2">
                    <a href="MenuEmprendedor.php"> <i class="bi bi-arrow-left-circle"></i> </a>
                </div>
            </div>
            <h1 class="tituloEmprendi w3-center w3-animate-top"> <i class="bi bi-shop-window" id="iconoMorado"></i> MIS EMPRENDIMIENTOS
                <hr>
            </h1>
            <div id="TextoCentro"><br>
                <p id="textoCenter3">Bienvenido a "Mis emprendimientos", aqui podrás <b id="LinksEstas">gestionar tus emprendimientos publicados</b> en Stu-ventures.</p>
                <p>Actualmente tienes <b id="rigth"><?php echo $TotalPublis; ?> emprendimientos</b> publicados.</p>
                <div class="container">
                    <form action="Misemprendimientos.php" method="GET">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-5 col-sm-12 col-xs-12 input-wrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" class="input-icon" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                                <input type="search" class="form-control" name="Buscar" id="CampoBuscar" placeholder="Ingresa el título del emprendimiento">
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn" id="btnBuscar" value="Buscar">Buscar</button>
                            </div>
                        </div>
                    </form><br>
                </div>
            </div>
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
                                        <div class="col-md-12" id="IconoAdm6">
                                            <i class="bi bi-info-circle"></i>
                                        </div>
                                        <div class="col-md-12">
                                            En "mis emprendimientos" podrás <b id="LinksEstas">ver</b>, <b id="LinksEstas">actualizar</b>, <b id="LinksEstas">suspender temporalmente un emprendimiento</b> y <b id="LinksEstas">eliminarlo</b>.
                                            Podrás saber la puntuación, las visitas y las interacciones por cada uno de tus emprendimientos.
                                        </div>
                                    </div>
                                    <div class="conte">
                                        <div class="col-md-12" id="IconoAdm5">
                                            <i class="bi bi-eye"></i>
                                        </div>
                                        <div class="col-md-12">
                                            Este icono te indicará que podrás <b id="LinksEstas"> consultar</b> los datos del emprendimiento seleccionado.
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
                    <div class="fondoWhite2">
                        <?php
                        include 'readMisPubli.php';
                        $conta = 0;
                        $contaVueltas = 0;
                        while ($columnasPublic = mysqli_fetch_array($resultadoPublic)) {
                            $contaVueltas++;
                            if ($columnasPublic['Valoracion'] == 0.0 && $columnasPublic['Valoracion'] < 1.0) {
                                $trellas = "";
                                $trellasWhite = "★★★★★";
                            }
                            if ($columnasPublic['Valoracion'] >= 1.0 && $columnasPublic['Valoracion'] < 2.0) {
                                $trellas = "★";
                                $trellasWhite = "★★★★";
                            }
                            if ($columnasPublic['Valoracion'] >= 2.0 && $columnasPublic['Valoracion'] < 3.0) {
                                $trellas = "★★";
                                $trellasWhite = "★★★";
                            }
                            if ($columnasPublic['Valoracion'] >= 3.0 && $columnasPublic['Valoracion'] < 4.0) {
                                $trellas = "★★★";
                                $trellasWhite = "★★";
                            }
                            if ($columnasPublic['Valoracion'] >= 4.0 && $columnasPublic['Valoracion'] < 5.0) {
                                $trellas = "★★★★";
                                $trellasWhite = "★";
                            }
                            if ($columnasPublic['Valoracion'] == 5.0) {
                                $trellas = "★★★★★";
                                $trellasWhite = "";
                            }
                            $conta = 5;

                        ?><div class="card  " style="max-width: 100%;" id="cardTop2">
                                <div class="row g-0">
                                    <div class="col-md-4" id="imagenTop2">
                                        <img src="data:image/jpg;base64, <?php echo base64_encode($columnasPublic["Foto_publicacion"]); ?>" class="img-fluid rounded-start" id="imgEmprendimiento" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-end align-items-end ">
                                                <div class=" CategoriaTop">
                                                    Categoría: <?php echo ($columnasPublic["Categoria"]); ?>
                                                </div>
                                            </div><br>
                                            <h5 class="card-title titulo5"><?php echo ($columnasPublic["Titulo"]); ?>
                                                <hr>
                                            </h5>
                                            <?php
                                            $sqlCantiValora = "SELECT COUNT(*) Usuario_idUsuario from valoracion WHERE Publicacion_idPublicacion = '$columnasPublic[idPublicacion]'";
                                            $resulCantiValora = mysqli_query($conexion, $sqlCantiValora);
                                            $filaCantiValora = mysqli_fetch_array($resulCantiValora);
                                            $totalCantiValora =  $filaCantiValora['Usuario_idUsuario'];

                                            $sqlChatsValora = "SELECT COUNT(*) De from chats_correspon WHERE  De = '$_SESSION[idUsuarioEm]'";
                                            $resulChatsValora = mysqli_query($conexion, $sqlChatsValora);
                                            $filaChatsValora = mysqli_fetch_array($resulChatsValora);
                                            $totalChatsValora =  $filaChatsValora['De'];
                                            ?>
                                            <b class="d-flex justify-content-center align-items-center" id="valoracion"><?php echo $trellas ?> <span class="EstrellaBl "><?php echo $trellasWhite ?>
                                                </span><span class="CantiPerso"> (<?php echo  $totalCantiValora ?>)</span>
                                            </b>
                                            <?php
                                            $sqlIntituSede = "SELECT * from institucion WHERE idInstitucion = '$columnasPublic[Institucion_idInstitucion]'";
                                            $resulSqlI = mysqli_query($conexion, $sqlIntituSede);
                                            $FilaInstituSede = mysqli_fetch_array($resulSqlI);
                                            ?>
                                            <?php if ($columnasPublic["ActivoPubli"] == 1) { ?>
                                                <p class="font-italic mb-0 card-text Activo"><b>EMPRENDIMIENTO ACTIVO </b></p>
                                            <?php } elseif ($columnasPublic["ActivoPubli"] == 2) { ?>
                                                <p class="font-italic mb-0 text-danger "><b>SUSPENDIDO POR UN ADMINISTRADOR</b></p>
                                            <?php } elseif ($columnasPublic["ActivoPubli"] == 0) { ?>
                                                <p class="font-italic mb-0 card-text colomorado1 "><b>EMPRENDIMIENTO INACTIVO</b></p>
                                            <?php } ?>
                                            <?php $sqlConsulCorres = "SELECT  COUNT(*)  idCorres from chats_correspon WHERE idEmprendi = '$columnasPublic[idPublicacion] '";
                                            $resultadoSqlCorres = mysqli_query($conexion, $sqlConsulCorres);
                                            $columnaSqlCorres = mysqli_fetch_array($resultadoSqlCorres);

                                            $totalInterac = $columnaSqlCorres['idCorres']; ?>

                                            <p class="card-text mb-0 ">Institución: <?php echo ($FilaInstituSede["Nombre_Institucion"]); ?>, <?php echo ($FilaInstituSede["Sede"]); ?>.</p>
                                            <p class="card-text mb-0 ">Fecha de publicación: <?php echo ($columnasPublic["Fecha"]); ?>.</p>
                                            <p class="card-text mb-0 ">Puntuación de valoración: <b id="rigth"> <?php echo ($columnasPublic["Valoracion"]); ?></b>.</p>
                                            <p class="card-text mb-0 ">Visitas:<b id="rigth"> <?php echo ($columnasPublic["Visitas"]); ?> </b>.</p>
                                            <p class="card-text mb-0">Interacciones: <b id="rigth"> <?php echo $totalInterac ?></b>.</p>
                                            <div class="card-footer">
                                                <small class="text-muted"> </small>
                                            </div>

                                            <form action="modalEm.php" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="idPubli" value="<?php echo $columnasPublic['idPublicacion'] ?>">
                                                <input type="hidden" name="ActivoPubli" value="<?php echo ($columnasPublic["ActivoPubli"]); ?>">
                                                <input type="hidden" name="Valoracion" value="<?php echo ($columnasPublic["Valoracion"]); ?>">
                                                <input type="hidden" name="Visitas" value="<?php echo ($columnasPublic["Visitas"]); ?>">
                                                <input type="hidden" name="TotalValora" value="<?php echo $totalCantiValora; ?>">
                                                <input type="hidden" name="TotalChats" value="<?php echo $totalChatsValora; ?>">
                                                <input type="hidden" name="Foto" value="<?php echo base64_encode($columnasPublic['Foto_publicacion']); ?>">
                                                <input type="hidden" name="Titulo" value="<?php echo $columnasPublic['Titulo']; ?>">
                                                <input type="hidden" name="Categoria" value="<?php echo $columnasPublic['Categoria'] ?>">
                                                <input type="hidden" name="BreveDescrip" value="<?php echo $columnasPublic['Breve_Descripcion'] ?>">
                                                <input type="hidden" name="Descripcion" value="<?php echo $columnasPublic['Descripcion'] ?>">
                                                <input type="hidden" name="Fecha" value="<?php echo $columnasPublic['Fecha'] ?>">
                                                <input type="hidden" name="Precio" value="<?php echo $columnasPublic['Precio'] ?>">
                                                <?php
                                                $sqlInstitu = "SELECT * FROM institucion WHERE idInstitucion = '$columnasPublic[Institucion_idInstitucion]'";
                                                $resultInstitu = mysqli_query($conexion, $sqlInstitu);
                                                $filasIns = mysqli_fetch_array($resultInstitu);
                                                ?>
                                                <input type="hidden" name="Institucion" value="<?php echo $filasIns['Nombre_Institucion'] ?>">
                                                <input type="hidden" name="Sede" value="<?php echo $filasIns['Sede'] ?>">
                                                <p class="card-text mb-0 "><b> ACCION:</b> </p>
                                                <div class="d-flex justify-content-center">
                                                    <button type="submit" class="VerDatos" name="accion" value="Ver"><i class="bi bi-eye" id="accionesIco"></i></button>

                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($contaVueltas > 10) {   ?>
                            <div class="d-flex justify-content-center">
                                <button class="masEm" name="MostrarMás" id="MostrarMás">MOSTRAR MÁS EMPRENDIMIENTOS</button>
                            </div>
                        <?php } ?>
                        <?php if ($contaVueltas < 1) {   ?>
                            <div class="d-flex justify-content-center">
                                <h1 class="colorTurquesaCentro">NO SE HA ENCONTRADO UN EMPRENDIMIENTO ;(</h1>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <script>
                    $(".card").slice(0, 10).show()
                    $(".masEm").on("click", function() {
                        $(".card:hidden").slice(0, 10).slideDown()
                        if ($(".card:hidden").length == 0) {
                            $(".masEm").fadeOut('slow');
                        }
                    })
                </script>
                <br><br>
            </div>
        </div>
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