<?php include("../bd/conexion.php");
include("../validaciones/validarsesionEm.php");
?>
<?php

$consulta = "SELECT * from usuario WHERE idUsuario = '" . $_SESSION['idUsuarioEm'] . "'";
$resultado = mysqli_query($conexion, $consulta);
$columna = mysqli_fetch_array($resultado);

$consulta2 = "SELECT E.Direccion_correo, U.idUsuario FROM correo_electronico E INNER JOIN usuario U ON E.Usuario_idUsuario = U.idUsuario
            WHERE U.idUsuario = '" . $_SESSION['idUsuarioEm'] . "'";
$resultado2 =  mysqli_query($conexion, $consulta2);
$columna2 = mysqli_fetch_array($resultado2);

$consulta3 = "SELECT idDireccion, Direccion, Comuna  FROM direccion WHERE Usuario_idUsuario = '" . $_SESSION['idUsuarioEm'] . "'";
$resultado3 = mysqli_query($conexion, $consulta3);
$columna3 = mysqli_fetch_array($resultado3);


$consulta5 = "SELECT Numero from telefono WHERE Usuario_idUsuario = '" . $_SESSION['idUsuarioEm'] . "'";
$resultado5 =  mysqli_query($conexion, $consulta5);
$columna5 = mysqli_fetch_array($resultado5);

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/0086a4c4a4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <script src="../js/funciones.js"></script>
    <link rel="stylesheet" href="../css/estilos.css">
    <title>Mi Perfil | Emprendedor</title>
</head>
<script>
    function ConfirmarActualizardatos() {
        var respuesta = confirm("Para actualizar tus datos debes hacer click en aceptar");
        if (respuesta == true) {
            return true;
        } else {
            return false;
        }
    }

    function ConfirmarContacto() {
        var respuesta = confirm("¿Estás seguro de contactarte con un ADMINISTRADOR?, ");
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
            <a href="emprendedor.php" class="brand-logo "> <img src="../img/logo2.PNG" class="img-fluid" width="298px"></a>
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
                            <i class="fa-regular fa-user-tie"></i> <?php echo $columna['Nombre'] ?> <?php echo $columna['Apellido_Paterno'] ?> <?php echo $columna['Apellido_Materno'] ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="MenuEmprendedor.php"><i class="bi bi-three-dots"></i> Menú</a></li>
                            <li class="active1"><a class="dropdown-item " href="perfilEmprendedor.php"> <i class="fa-regular fa-user-tie"></i> Mi perfil </a></li>
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
            <img src="../img/universitario5.jpg" class="w-100" id="imgCentral" alt="...">
        </div>
    </section>

    <!--MI PERFIL-->
    <section class="contenidoPerfil"> <br>
        <div class="container-fluid">
            <div class="container">
                <div class="person2">
                    <a href="perfilEmprendedor.php"> <i class="bi bi-arrow-left-circle"></i> </a>
                </div>
            </div>
            <h1 class="tituloInfo w3-center w3-animate-top"><i class="fa-regular fa-user-tie" id="iconoMorado"></i> MI PERFIL
                <hr>
            </h1>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12" id="IzquerdaPequeña">
                    <div class="fondoblanco1">
                        <div class="col-md-12" id="border1">
                            <div class="row">
                                <div class="col-md-6" id="borderiz">
                                    <i class="fa-regular fa-user-tie"></i>
                                </div>
                                <div class="col-md-6" id="TexFull">
                                    <a href="PerfilEmprendedor.php">MIS DATOS</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" id="border1">
                            <div class="row">
                                <div class="col-md-6" id="borderiz">
                                    <i class="bi bi-key"></i>
                                </div>
                                <div class="col-md-6" id="TexFull">
                                    <a href="CambioContraseñaEm.php" class="link">CAMBIAR CONTRASEÑA</a>
                                </div>
                            </div>
                        </div><br>
                        <div class="fondoGris1 p-4 d-flex flex-column align-items-center  p-3 py-5">

                            <form action="" method="GET" class="needs-validation " novalidate>
                                <span class="font-weight-bold  d-flex justify-content-center">¿Necestias ayuda?</span><br>
                                <div class="textoCentra">
                                    <span class="text-black-50 ">Envíanos un mensaje para que un ADMINISTRADOR te pueda contactar por correo rápidamente.</span>
                                </div><br>
                                <div class="d-flex justify-content-center">
                                    <button class="btnChatear " type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                        Contactar 
                                    </button>
                                </div>
                                <div class="collapse" id="collapseExample"><br>
                                    <div class="card card-body">
                                        <p class="text-danger small ">*Todos los campos son obligatorios</p>
                                        <input type="text" name="asunto" value="" id="asunto" class="form-control" placeholder="Asunto" required>
                                        <textarea rows="3" class="form-control" name="mensaje" id="mensaje" placeholder="Mensaje" required></textarea><br>
                                        <button type="submit" class="btnEnviar" onclick="ConfirmarContacto()">Enviar</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12" id="Derecha">
                    <div class="fondoblanco d-flex align-items-center">
                        <form action="ActualizarEmp.php" method="POST" class="needs-validation " id="Perfil" novalidate>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="CambioContra" class="form-label">¿Desea cambiar su contraseña?</label>
                                    <div class="radioSi">
                                        <input type="radio" class="si" name="Pass" value="1" id="pass" onclick="cambiarPass()">Si
                                        
                                    </div><input type="radio" class="si" name="Pass" value="0" id="pass" onclick="cambiarPassNo()">No
                                    
                                </div>
                                <div class="col-md-12" id="InputsForms">
                                    <label for="Contraseña" class="form-label">Mi contraseña actual<b id="rojo">*</b>:</label>
                                    <input type="password" name="contraseña" value="" id="Contraseña" class="form-control" placeholder="**********" disabled required>
                                    <span id="icon">
                                        <i class="bi bi-pen" title="Campo editable"></i>
                                    </span>
                                </div>
                                <div class="col-md-12" id="InputsForms">
                                    <label for="Contraseña" class="form-label">Nueva contraseña<b id="rojo">*</b>:</label>
                                    <input type="password" name="Nuevacontra" value="" id="Nuevacontra" class="form-control" placeholder="**********" disabled required>
                                    <span id="icon">
                                        <i class="bi bi-pen" title="Campo editable"></i>
                                    </span>
                                </div>

                                <div class="d-flex justify-content-center align-items-center">
                                    <button type="submit" class="btn btnRegistrarme" id="Actualizar" onclick="return ConfirmarActualizardatos()" disabled>Actualizar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12" id="IzquerdaPequeña">
                    <div class="fondoblanco2">
                        <div class="fondoGris1 d-flex flex-column align-items-center  p-3 py-5">
                            <div class="FondoPerson">
                                <div class="person">
                                    <i class="fa-regular fa-user-tie"></i>
                                </div>
                            </div><br>
                            <span class="font-weight-bold">Usuario <b>EMPRENDEDOR</b></span><br>
                            <span class="text-black-50 textoCentra">Tu cuenta del tipo EMPRENDEDOR te permite
                                publicar emprendimientos, gestionarlos y atender todas las consultas que consideres pertinente. </span>
                        </div>
                    </div>
                </div>
            </div><br><br>


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
        </div>
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