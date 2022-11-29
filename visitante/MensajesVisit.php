<?php include("../bd/conexion.php");
include("../validaciones/validasesion.php"); ?>

<?php

//if(isset($_GET['idCorres'])){}
$sqlUsuario = "SELECT * FROM usuario WHERE idUsuario = '$_SESSION[idUsuario]'";
$resultadoUsuario = mysqli_query($conexion, $sqlUsuario);
$filasUsuario  =  mysqli_fetch_array($resultadoUsuario);

$sql = "SELECT * from chats_correspon Where De ='$_SESSION[idUsuario]' AND ActivoChats BETWEEN 1 AND 2  ORDER BY idCorres DESC";
$result = mysqli_query($conexion, $sql);

$sqlMensajes = "SELECT COUNT(*) Estado from chat Where Recibe_Usuarioid = '$_SESSION[idUsuario]' AND Estado = '1'";
$resultaMensa = mysqli_query($conexion, $sqlMensajes);
$filamensa = mysqli_fetch_array($resultaMensa);

$Totalmensajes = $filamensa['Estado'];

$sqlMensajesTotal = "SELECT COUNT(*) idCorres from chats_correspon Where De = '$_SESSION[idUsuario]' AND ActivoChats BETWEEN 1 AND 2 ";
$resultaMensaTotal = mysqli_query($conexion, $sqlMensajesTotal);
$filamensaTotal = mysqli_fetch_array($resultaMensaTotal);

$TotalmensajesTotal = $filamensaTotal['idCorres'];

$sqlChatMen = "SELECT * from chat Where Recibe_Usuarioid= '$_SESSION[idUsuario]' AND Estado = '1' ORDER BY idCorres";
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
    <link rel="stylesheet" href="../css/estilos.css">
    <script src="../js/funciones.js"></script>
    <title>Mensajes | Visitante</title>
</head>
<script>
    $(document).ready(function() {
        var refreshId = setInterval(function() {
            $("#ChatsHistory").load(location.href + " #ChatsHistory*", "");
        }, 2000);
    });
    $(document).ready(function() {
        var refreshId = setInterval(function() {
            $("#NuevosMsg").load(location.href + " #NuevosMsg>*", "");
        }, 2000);
    });
    $(document).ready(function() {
        var refreshId = setInterval(function() {
            $("#card-body").load(location.href + " #card-body>*", "");
        }, 2000);
    });
    $(function() {
        if ($('#ms-menu-trigger')[0]) {
            $('body').on('click', '#ms-menu-trigger', function() {
                $('.ms-menu').toggleClass('toggled');
            });
        }
    });
</script>
<script>
    function ConfirmarEliminarEm() {
        var respuesta = confirm("¿Estas seguro que deseas eliminar este chat?");
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
            <a href="MenuVisitante.php" class="brand-logo "> <img src="../img/logo2.PNG" class="img-fluid" width="298px"></a>
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
                                        <a href="ChatVisitante.php?idCorres=<?php echo $filasChatMen['idCorres'] ?>" class="estilo0">
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
                                                        <pre>  <?php echo $filasChatMen['Mensaje'] ?></pre>
                                                    </div>

                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="message my-message" style="float:left; min-width: 300px;"></div>
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
                            <i class="fa-solid fa-user"></i> <?php echo $filasUsuario['Nombre'] ?> <?php echo $filasUsuario['Apellido_Paterno'] ?> <?php echo $filasUsuario['Apellido_Materno'] ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="MenuVisitante.php"><i class="bi bi-three-dots"></i> Menú</a></li>
                            <li><a class="dropdown-item" href="PerfilUsuario.php"> <i class="fa-solid fa-user"></i> Mi perfil</a></li>
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
            <img src="../img/chat5.jpg" class="w-100" id="imgCentral" alt="" />

        </div>
    </section>

    <!--CHATS-->
    <section class="contenedorChats1"><br>
        <div class="container-fluid">
            <div class="container">
                <div class="person2">
                    <a href="javascript: history.go(-1)"> <i class="bi bi-arrow-left-circle"></i> </a>
                </div>
            </div>
            <h1 class="tituloEmprendi w3-center w3-animate-top"><i class="bi bi-chat-dots" id="iconoMorado"></i> MENSAJES
                <hr>
            </h1>

            <div id="TextoCentro"><br>
                <div class="container">
                    <p id="textoCenter3">En esta sección podrás ver tus interacciones con los emprendedores. Actualmente tienes <b id="rigth"><?php echo $TotalmensajesTotal ?></b> chats.  </p>
                    <form action="MensajesVisit.php" method="GET">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-5 col-sm-12 col-xs-12 input-wrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" class="input-icon" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                                <input type="search" name="Buscar" class="form-control" id="CampoBuscar" placeholder=" Ingresa el título del emprendimiento">
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn" id="btnBuscar" value="Buscar">Buscar</button>
                            </div>
                        </div><br>
                    </form>
                </div>
            </div>
            <div class="left w3-center w3-animate-left" id="FiltroBusqueda">
                <form action="Administrador.php" method="GET">
                    <div class="form-group col-md-12">

                        <h5 class="card-title titulo5">Recuerda que...
                            <hr>
                        </h5><br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="conte">
                                        <div class="col-md-12" id="IconoAdm1">
                                            <i class="bi bi-eyeglasses"></i>
                                        </div>
                                        <div class="col-md-12">
                                            Podrás ver el emprendimineto haciendo "clic" en el boton <b id="LinksEstas"> ver emprendi.</b>
                                        </div>
                                    </div>
                                    <div class="conte">
                                        <div class="col-md-12" id="IconoAdm2">
                                            <i class="bi bi-chat-text"></i>
                                        </div>
                                        <div class="col-md-12">
                                            Puedes <b id="LinksEstas">ver y enviar</b> mensajes al emprendedor haciendo "clic" en el botón chatear.
                                        </div>
                                    </div>
                                    
                                    <div class="conte">
                                        <div class="col-md-12" id="IconoAdm4">
                                            <i class="bi bi-check2-all"></i>
                                        </div>
                                        <div class="col-md-12">
                                            Por último, al <b id="LinksEstas">ver los mensajes</b> los estarás dejando <b id="LinksEstas">automaticamente en leído</b>.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div><br>


                </form><br><br>
            </div>
            <div class="container bootstrap snippets bootdey">
                <div class="row g-3">
                    <div class="fondoWhite2 ">

                        <?php
                        $contaVueltas = 0;
                        while ($filasCorres = mysqli_fetch_array($result)) {
                            include 'BuscarChatVisit.php';
                        ?>
                            <?php
                            while ($filaPubli = mysqli_fetch_array($resultaPubli)) {
                                $contaVueltas++;
                            ?>
                                <div class="card mb-3 cardChats" style="width: 100%;">
                                    <div class="row g-0" id="CuerpoCard">
                                        <div class="col-md-4" id="imagenChat" style="text-align: center; ">
                                            <img src="data:image/jpg;base64, <?php echo base64_encode($filaPubli["Foto_publicacion"]); ?>" alt="avatar" class="img-avatar" width="100%">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <?php $sqlChatUser = "SELECT * from chat Where Envia_Usuarioid = '$filasCorres[Para]' AND Estado = '1' AND idCorres='$filasCorres[idCorres]'";
                                                $resulta = mysqli_query($conexion, $sqlChatUser);
                                                $contador = "";
                                                while ($filaChatUser = mysqli_fetch_array($resulta)) {
                                                    $suma = 0;
                                                    if ($filaChatUser['Estado'] == 1) {
                                                        $contador++;
                                                    }
                                                    if (($filaChatUser['Estado'] == 0)) {
                                                        $contador = "";
                                                    }
                                                } ?>
                                                <div class="row ">
                                                    <div class="col-md-4 ">
                                                        Emprendimiento:
                                                        <div class="name">
                                                            <?php echo $filaPubli['Titulo'] ?><br><br>

                                                        </div>
                                                        <?php $sqlCon = "SELECT * from usuario Where idUsuario = '$filaPubli[Usuario_idUsuario]'";
                                                        $resulCon = mysqli_query($conexion, $sqlCon);
                                                        $filaCon = mysqli_fetch_array($resulCon);

                                                        ?>
                                                    </div>
                                                    <div class="col-md-4 ">
                                                        <?php if ($contador >= 1) { ?>
                                                            Emprendedor:
                                                            <div class="name"><?php echo $filaCon['Nombre'] ?> <?php echo $filaCon['Apellido_Paterno'] ?> <?php echo $filaCon['Apellido_Materno'] ?> </div><br>
                                                            <p><b id="rigth">Nuevos mensajes <?php echo $contador ?></b></p><br>
                                                        <?php } else { ?>
                                                            Emprendedor:
                                                            <div class="name"><?php echo $filaCon['Nombre'] ?> <?php echo $filaCon['Apellido_Paterno'] ?> <?php echo $filaCon['Apellido_Materno'] ?> </div><br>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-md-4 ">
                                                        <a class="btn VerMaschat" style="margin-bottom: 10px;" href="Veremprendimientovi.php?idPublicacion=<?php echo $filaPubli['idPublicacion'] ?>" class="list-group-item media border-0 ">Ver Emprendi</a><br>
                                                        <a class="btn VerMaschat" style="margin-bottom: 10px;" href="ChatVisitante.php?idCorres=<?php echo $filasCorres['idCorres'] ?>" class="list-group-item media border-0 ">Chatear</a>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                        <?php if ($contaVueltas > 10) {   ?>
                            <div class="d-flex justify-content-center">
                                <button class="masEm" name="MostrarMás" id="MostrarMás">MOSTRAR MÁS CHATS</button>
                            </div>
                        <?php } ?>
                        <?php if ($contaVueltas < 1) {   ?>
                            <div class="d-flex justify-content-center">
                                <h1 class="colorTurquesaCentro">LAMENTABLEMENTE NO SE HA ENCONTRADO UN CHAT ;(</h1>
                            </div>
                        <?php } ?>
                    </div>
                </div><br><br>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>
        $(".cardChats").slice(0, 10).show()
        $(".masEm").on("click", function() {
            $(".cardChats:hidden").slice(0, 10).slideDown()
            if ($(".cardChats:hidden").length == 0) {
                $(".masEm").fadeOut('slow');
            }
        })
    </script>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
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