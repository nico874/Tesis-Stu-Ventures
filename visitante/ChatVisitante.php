<?php include("../bd/conexion.php");
include("../validaciones/validasesion.php"); ?>

<?php

$idCorres = $_GET['idCorres'];

$sqlUsuario = "SELECT * FROM usuario WHERE idUsuario = '$_SESSION[idUsuario]'";
$resultadoUsuario = mysqli_query($conexion, $sqlUsuario);
$filasUsuario  =  mysqli_fetch_array($resultadoUsuario);

$sql = "SELECT * from chats_correspon Where De ='$_SESSION[idUsuario]' ORDER BY idCorres DESC";
$result = mysqli_query($conexion, $sql);
$fila = mysqli_fetch_array($result);
if($fila['ActivoChats'] == 2 || $fila['ActivoChats'] == 0){
    $sqlUpChat = "UPDATE chats_correspon set ActivoChats = '1' WHERE idCorres='$idCorres '";
    $resulUpChat = mysqli_query($conexion,$sqlUpChat);
}

$sqlMensajes = "SELECT COUNT(*) Estado from chat Where Recibe_Usuarioid = '$_SESSION[idUsuario]' AND Estado = '1'";
$resultaMensa = mysqli_query($conexion, $sqlMensajes);
$filamensa = mysqli_fetch_array($resultaMensa);

$Totalmensajes = $filamensa['Estado'];

$sqlMensajesTotal = "SELECT COUNT(*) idCorres from chats_correspon Where De = '$_SESSION[idUsuario]' ";
$resultaMensaTotal = mysqli_query($conexion, $sqlMensajesTotal);
$filamensaTotal = mysqli_fetch_array($resultaMensaTotal);

$TotalmensajesTotal = $filamensaTotal['idCorres'];

$sqlChatMen = "SELECT * from chat Where Recibe_Usuarioid= '$_SESSION[idUsuario]' AND Estado = '1' ORDER BY idCorres";
$resultChatMen = mysqli_query($conexion, $sqlChatMen);

$sqlUpdateChat = "UPDATE chat set Estado = '0' WHERE Recibe_Usuarioid= '$_SESSION[idUsuario]' AND idCorres = '$idCorres'";
$resultUpdateChat = mysqli_query($conexion, $sqlUpdateChat);
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
    <title>Chat | Visitante</title>
</head>

<script>
    $(document).ready(function() {
        var refreshId = setInterval(function() {
            $("#historiaChat").load(location.href + " #historiaChat>*", "");
        }, 2000);
    });
    $(document).ready(function() {
        var refreshId = setInterval(function() {
            $("#NuevosMsg").load(location.href + " #NuevosMsg>*", "");
        }, 2000);
    });
    $(document).ready(function() {
        var refreshId = setInterval(function() {
            $("#ContadorMsg").load(location.href + " #ContadorMsg>*", "");
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
    <!--CHATS-->
    <section class="contenedorChat"><br>
        <div class="container">
            <div class="person2">
                <a href="javascript: history.go(-1)"> <i class="bi bi-arrow-left-circle"></i> </a>
            </div>

            <div class="contenedorRight">
                <?php
                if (isset($_GET['idCorres'])) {
                    $idCorres = $_GET['idCorres'];
                    $sqlPubliCorre = "SELECT idEmprendi from chats_correspon WHERE idCorres ='$_GET[idCorres]'";
                    $resuk = mysqli_query($conexion, $sqlPubliCorre);
                    $filaPubliCorre = mysqli_fetch_array($resuk);
                    $sqlPubliC = "SELECT * from publicacion Where idPublicacion = '$filaPubliCorre[idEmprendi]'";
                    $resultaPubliC = mysqli_query($conexion, $sqlPubliC);
                    $columnaPubliC = mysqli_fetch_array($resultaPubliC);

                    if ($columnaPubliC['Valoracion'] == 0.0 && $columnaPubliC['Valoracion'] < 1.0) {
                        $trellas = "";
                        $trellasWhite = "★★★★★";
                    }
                    if ($columnaPubliC['Valoracion'] >= 1.0 && $columnaPubliC['Valoracion'] < 2.0) {
                        $trellas = "★";
                        $trellasWhite = "★★★★";
                    }
                    if ($columnaPubliC['Valoracion'] >= 2.0 && $columnaPubliC['Valoracion'] < 3.0) {
                        $trellas = "★★";
                        $trellasWhite = "★★★";
                    }
                    if ($columnaPubliC['Valoracion'] >= 3.0 && $columnaPubliC['Valoracion'] < 4.0) {
                        $trellas = "★★★";
                        $trellasWhite = "★★";
                    }
                    if ($columnaPubliC['Valoracion'] >= 4.0 && $columnaPubliC['Valoracion'] < 5.0) {
                        $trellas = "★★★★";
                        $trellasWhite = "★";
                    }
                    if ($columnaPubliC['Valoracion'] == 5.0) {
                        $trellas = "★★★★★";
                        $trellasWhite = "";
                    }
                ?>
                    <div class="bg-light p-4 d-flex flex-column align-items-center  p-3 py-4">
                        <h2 class="colomorado">Más detalles </h2>
                        <img src="data:image/jpg;base64, <?php echo base64_encode($columnaPubliC["Foto_publicacion"]); ?>" alt="avatar" class="Fotoredonda"><br>
                        <?php
                        $sqlCantiValora = "SELECT COUNT(*) Usuario_idUsuario from valoracion WHERE Publicacion_idPublicacion = '$columnaPubliC[idPublicacion]'";
                        $resulCantiValora = mysqli_query($conexion, $sqlCantiValora);
                        $filaCantiValora = mysqli_fetch_array($resulCantiValora);
                        $totalCantiValora =  $filaCantiValora['Usuario_idUsuario'];
                        ?>
                        <b class="d-flex justify-content-center align-items-center" id="valoracion"><?php echo $trellas ?> <span class="EstrellaBl "><?php echo $trellasWhite ?>
                            </span><span class="CantiPerso"> (<?php echo  $totalCantiValora ?>)</span>
                        </b>
                        <span class="text-black-50 textoCentra"><?php echo  $columnaPubliC['Descripcion'] ?> </span>
                        <span class="text-black-50 textoCentra">Precio:<?php echo  $columnaPubliC['Precio'] ?> </span>
                    </div>
                <?php } ?>
            </div>
            <div class="user_header">
                <?php
                if (isset($_GET['idCorres'])) {
                    $idCorres = $_GET['idCorres'];
                    $sqlPubliCorre = "SELECT idEmprendi from chats_correspon WHERE idCorres ='$_GET[idCorres]'";
                    $resuk = mysqli_query($conexion, $sqlPubliCorre);
                    $filaPubliCorre = mysqli_fetch_array($resuk);

                    $sqlPubliC = "SELECT * from publicacion Where idPublicacion = '$filaPubliCorre[idEmprendi]'";
                    $resultaPubliC = mysqli_query($conexion, $sqlPubliC);
                    $columnaPubliC = mysqli_fetch_array($resultaPubliC);

                    $sqlPubliCa = "SELECT * from usuario Where idUsuario = '$columnaPubliC[Usuario_idUsuario]'";
                    $resultaPubliCa = mysqli_query($conexion, $sqlPubliCa);
                    $columnaPubliCa = mysqli_fetch_array($resultaPubliCa);

                    $diponibilidad = "";
                    $NoDisponible = "disabled";

                    if ($columnaPubliC['ActivoPubli'] == 1) {
                        $diponibilidad = "disponible";
                        $NoDisponible = "";
                    } else {
                        $diponibilidad = "Nodisponible";
                        $NoDisponible = "disabled";
                    }
                ?>

                    <div class="chat-about">

                        <h2 class="colomorado"><?php echo $columnaPubliC['Titulo'] ?></h2>
                        <h6>Emprendedor: <?php echo $columnaPubliCa['Nombre'] ?> <?php echo $columnaPubliCa['Apellido_Paterno'] ?> </h6>
                        <!--<?php if ($diponibilidad == "disponible") { ?>
                                        <i class="fa fa-circle online"></i> Emprendimiento disponible
                                    <?php } elseif ($diponibilidad = "Nodisponible") { ?>
                                        <i class="fa fa-circle offline"></i> Emprendimiento No Disponible
                                    <?php } ?>-->
                    </div>

                <?php } ?>

            </div>
            <div class="historiaChat" id="historiaChat">
                <?php
                if (isset($_GET['idCorres'])) {
                    $acciDesabi = "";
                    $idCorres = $_GET['idCorres'];
                    $sqlChat = "SELECT * from chat Where idCorres = '$idCorres'";
                    $resultChat = mysqli_query($conexion, $sqlChat);

                    $sqlPubliC = "SELECT * from publicacion Where idPublicacion = '$filaPubliCorre[idEmprendi]'";
                    $resultaPubliC = mysqli_query($conexion, $sqlPubliC);
                    $columnaPubliC = mysqli_fetch_array($resultaPubliC);

                    if (mysqli_num_rows($resultChat) == 0) {
                        $NoHay = "No hay registros";
                    } else {
                        $NoHay = "";
                        $idEm = $columnaPubliC['Usuario_idUsuario'];
                        while ($filasChat = mysqli_fetch_array($resultChat)) { ?>

                            <?php if ($filasChat['Envia_Usuarioid'] == $_SESSION['idUsuario']) { ?>
                                <div class="message-feed right">
                                    <div class="message-container">
                                        <div class="media-body">
                                            <div class="mf-content1">
                                                <pre> <?php echo $filasChat['Mensaje'] ?></pre>
                                            </div>
                                            <small class="mf-date"><?php echo $filasChat['Tiempo_mensaje'] ?></small>
                                        </div>
                                    </div>
                                </div>
                            <?php } elseif ($filasChat['Envia_Usuarioid'] == $idEm) { ?>
                                <div class="message-feed media" id="mensa2">
                                    <div class="message-container2">
                                        <div class="media-body">
                                            <img src="data:image/jpg;base64, <?php echo base64_encode($columnaPubliC["Foto_publicacion"]); ?>" alt="avatar" class="img-avatar">
                                            <div class="mf-content2">
                                                <pre>  <?php echo $filasChat['Mensaje'] ?></pre>
                                            </div>
                                            <small class="mf-date"><?php echo $filasChat['Tiempo_mensaje'] ?></small>
                                        </div>
                                    </div>
                                    <div class="message my-message" style="float:left; min-width: 300px;"></div>
                                </div>
                            <?php } ?>
                <?php }
                    }
                } else {
                    $NoHay = "No has seleccionado un chat";
                    $acciDesabi = "disabled";
                }
                echo $NoHay;  ?>
            </div>
            <div class="msb-reply">
                <form method="GET" class="needs-validation" id="FrmAJAX" novalidate>
                    <input type="hidden" name="idCorres" value="<?php echo $idCorres ?>">
                    <input type="hidden" name="idEmprendedor" value="<?php echo  $columnaPubliC['Usuario_idUsuario'] ?>">
                    <?php if ($acciDesabi == "") { ?>
                        <div class="input-group-prepend">
                            <div class="row" id="MiInput">
                                <textarea name="mensaje" class="form-control" id="exampleFormControlTextarea1" placeholder="Escribe tú mensaje aquí..." required style="max-height: 90px;"></textarea>
                                <button type="submit" id="btnChatEnviar"><i class="bi bi-send"></i></button>
                            </div>
                        </div>

                    <?php } ?>
                </form>
            </div>
            <script>
                $(document).ready(function() {
                    $('#btnChatEnviar').click(function() {
                        var datos = $('#FrmAJAX').serialize();
                        $.ajax({
                            type: "GET",
                            url: "InsertarMensaje.php",
                            data: datos,
                            success: function(data) {
                                $("form").trigger('reset');
                            }

                        });
                        return false;
                    });

                });
            </script>
        </div><br><br>
    </section>
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