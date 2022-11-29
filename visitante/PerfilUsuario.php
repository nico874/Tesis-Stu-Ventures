<?php include("../bd/conexion.php");
include("../validaciones/validasesion.php");
?>
<?php

$consulta = "SELECT * from usuario WHERE idUsuario = '" . $_SESSION['idUsuario'] . "'";
$resultado = mysqli_query($conexion, $consulta);
$columna = mysqli_fetch_array($resultado);

$consulta2 = "SELECT * from correo_electronico WHERE Usuario_idUsuario = '$_SESSION[idUsuario] '";
$resultado2 =  mysqli_query($conexion, $consulta2);
$columna2 = mysqli_fetch_array($resultado2);

$consulta5 = "SELECT Numero from telefono WHERE Usuario_idUsuario = '" . $_SESSION['idUsuario'] . "'";
$resultado5 =  mysqli_query($conexion, $consulta5);
$columna5 = mysqli_fetch_array($resultado5);

$sqlMensajes = "SELECT COUNT(*) Estado from chat Where Recibe_Usuarioid = '$_SESSION[idUsuario]' AND Estado = '1'";
$resultaMensa = mysqli_query($conexion, $sqlMensajes);
$filamensa = mysqli_fetch_array($resultaMensa);

$Totalmensajes = $filamensa['Estado'];

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
    <title>Mi Perfil | Visitante</title>
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
                            <?php while ($filasChatMen = mysqli_fetch_array($resultChatMen)) { ?>
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
                            <li></li>
                        </ul>
                    </div>
                    <div class="dropdown">
                        <a class="btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user"></i> <?php echo $columna['Nombre'] ?> <?php echo $columna['Apellido_Paterno'] ?> <?php echo $columna['Apellido_Materno'] ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="MenuVisitante.php"><i class="bi bi-three-dots"></i> Menú</a></li>
                            <li class="active1"><a class="dropdown-item" href="PerfilUsuario.php"> <i class="fa-solid fa-user"></i> Mi perfil</a></li>
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
            <img src="../img/miperfil.jpg" class="w-100" id="imgCentral" alt="...">

        </div>
    </section>

    <!--MI PERFIL-->
    <section class="contenidoPerfil"> <br>
        <div class="container-fluid">
            <div class="container">
                <div class="person2">
                    <a href="MenuVisitante.php"> <i class="bi bi-arrow-left-circle"></i> </a>
                </div>
            </div>
            <h1 class="tituloEmprendi w3-center w3-animate-top"><i class="fa-solid fa-user" id="iconoMorado"></i> MI PERFIL
                <hr>
            </h1>

            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12" id="IzquerdaPequeña">
                    <div class="fondoblanco1">
                        <div class="col-md-12" id="border1">
                            <div class="row">
                                <div class="col-md-6" id="borderiz">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <div class="col-md-6" id="TexFull">
                                    <a href="PerfilUsuario.php" class="link">MIS DATOS</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" id="border1">
                            <div class="row">
                                <div class="col-md-6" id="borderiz">
                                    <i class="bi bi-key"></i>
                                </div>
                                <div class="col-md-6" id="TexFull">
                                    <a href="CambioContraseñaVi.php">CAMBIAR CONTRASEÑA</a>
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
                                        <button type="submit" class="btnEnviar">Enviar</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12" id="Derecha">
                    <div class="fondoblanco d-flex align-items-center">
                        <form action="ActualizarVisit.php" method="POST" class="needs-validation " id="Perfil" novalidate>
                            <div class="row">
                                <div class="col-md-12" id="InputsForms1">
                                    <label for="Rut" class="form-label">Rut<b id="rojo">*</b></label>
                                    <input type="numeric" name="rut" value="<?php echo  $columna["rut"]; ?>" class="form-control" id="rut" oninput="checkRut(this)" disabled required>
                                    <span id="icon">
                                        <i class="bi bi-lock" title="Campo no editable"></i>
                                    </span>
                                </div>
                                <div class="valid-feedback">
                                </div>
                                <div class="invalid-feedback">
                                    Debes ingresar un rut valido.
                                </div>
                                <div class="col-md-12" id="InputsForms">
                                    <label for="Nombre" class="form-label"> Nombre<b id="rojo">*</b></label>
                                    <input type="text" name="nombre" value="<?php echo  $columna["Nombre"]; ?>" id="nombre" class="form-control input" required>
                                    <span id="icon">
                                        <i class="bi bi-pen" title="Campo editable"></i>
                                    </span>
                                </div>
                                <div class="col-md-12" id="InputsForms">
                                    <label for="ApellidoP" class="form-label">Apellido paterno<b id="rojo">*</b></label>
                                    <input type="text" name="apellidoP" value="<?php echo  $columna["Apellido_Paterno"]; ?>" id="ApellidoPaterno" class="form-control" required>
                                    <span id="icon">
                                        <i class="bi bi-pen" title="Campo editable"></i>
                                    </span>
                                </div>
                                <div class="col-md-12" id="InputsForms">
                                    <label for="ApellidoM" class="form-label">Apellido materno<b id="rojo">*</b></label>
                                    <input type="text" name="ApellidoM" value="<?php echo  $columna["Apellido_Materno"]; ?>" id="ApellidoMaterno" class="form-control" required>
                                    <span id="icon">
                                        <i class="bi bi-pen" title="Campo editable"></i>
                                    </span>
                                </div>
                                <div class="col-md-12" id="InputsForms">
                                    <label for="Télefono" class="form-label">Télefono<b id="rojo">*</b></label>
                                    <input type="numeric" name="telef" value="<?php echo  $columna5["Numero"]; ?>" id="Telefono" class="form-control" pattern="[0-9]{9}" required title="Ingrese su número de contacto con el 9">
                                    <span id="icon">
                                        <i class="bi bi-pen" title="Campo editable"></i>
                                    </span>
                                </div>
                                <div class="col-md-12" id="InputsForms1">
                                    <label for="E-mail" class="form-label">E-mail<b id="rojo">*</b></label>
                                    <input type="email" name="direcCorre" value="<?php echo  $columna2["Direccion_correo"]; ?>" id="email" class="form-control" pattern=".+@gmail\.com" disabled required>
                                    <span id="icon">
                                        <i class="bi bi-lock" title="Campo no editable"></i>
                                    </span>
                                    <div class="invalid-feedback">
                                        Ej: Ejemplo@gmail.com.
                                    </div>
                                </div><br>

                                <div class="d-flex justify-content-center align-items-center">
                                    <button type="submit" class="btn btnRegistrarme" id="Actualizar" onclick="return ConfirmarActualizardatos()">Actualizar</button>
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
                                <i class="fa-solid fa-user" ></i>
                                </div>
                            </div><br>
                            <span class="font-weight-bold">Usuario <b>VISITANTE</b></span><br>
                            <span class="text-black-50 textoCentra">Tu cuenta del tipo VISITANTE te permite ver todos los emprendimientos de estudiantes publicados en Stu-Ventures y
                                poder hacer todas las consultas que consideres pertinente al emprendedor! </span>
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
                <p class="rights"><span>&copy; Todos los derechos reservados, Stu-Ventures, Chile 2022 (Fines educativos)</span></p>
            </div>
        </div>
    </footer>
</body>


</html>