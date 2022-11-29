<?php include("../bd/conexion.php");
include("../validaciones/validarsesionEm.php"); ?>

<?php
$sqlUsuario = "SELECT * FROM usuario WHERE idUsuario = '$_SESSION[idUsuarioEm]'";
$resultadoUsuario = mysqli_query($conexion, $sqlUsuario);
$filasUsuario  =  mysqli_fetch_array($resultadoUsuario);

$consultaInstitu = "SELECT * from institucion ";
$resultadoInstitu = mysqli_query($conexion, $consultaInstitu);
$filasInstitu = mysqli_fetch_array($resultadoInstitu);

$sqlSede = "SELECT Sede from institucion WHERE Nombre_Institucion = '$filasInstitu[Nombre_Institucion]' ";
$resultadoSede = mysqli_query($conexion, $sqlSede);

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
    <link rel="stylesheet" href="../css/estilos.css">
    <script src="../js/funciones.js"></script>
    <title>Publicar emprendimiento | Emprendedor</title>
</head>
<script>
    function ConfirmarPublicar() {
        var respuesta = confirm("¿Estas seguro que deseas publicar este EMPRENDIMIENTO?");
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
            <img src="../img/biblio1.jpg" class="w-100" id="imgCentral" alt="" />
        </div>
    </section>

    <section class="contenedorPublicarEm"><br>
        <div class="container">
            <div class="person2">
                <a href="MenuEmprendedor.php"> <i class="bi bi-arrow-left-circle"></i> </a>
            </div>
        </div>
        <h1 class="tituloInfo w3-center w3-animate-top"> <i class="bi bi-cloud-upload" id="iconoMorado"></i> PUBLICAR EMPRENDIMIENTO
            <hr>
        </h1>

        <div class="container"><br>
            <div class="row ">
                <div class="col-md-6 w3-animate-left fondoWhite5" id="DescripPubli">
                    <br>
                    <p class="textoCentra">Junto a Stu-Ventures podrás <b id="LinksEstas">dar a conocer tu emprendimiento</b> o productos mediante una alta visibilidad.
                    </p>
                    <div class="row " id="paddingTexto">
                        <div class="col-md-3 d-flex justify-content-center align-items-center" id="IconoAdm11">
                            <i class="bi bi-megaphone"></i>
                        </div>
                        <div class="col-md-10 ">
                            <p class="textoCentra"> Una de las mejores formas de promocionar tu emprendimiento es hacerlo aparecer en medio influyentes como Stu-Ventures. </p>
                        </div>
                        <div class="col-md-3 d-flex justify-content-center align-items-center" id="IconoAdm12">
                            <i class="bi bi-clock"></i>
                        </div>
                        <div class="col-md-10 ">
                            <p class="textoCentra"> Stu-Ventures te permite <b id="LinksEstas">ahorrar tiempo</b> ya que publicita tu o tus emprendimientos permitiendo la difusión de estos. </p>
                        </div>
                        <div class="col-md-10 d-flex justify-content-center align-items-center" id="IconoAdm13">
                            <i class="bi bi-cash-stack"></i>
                        </div>
                        <div class="col-md-10 ">
                            <p class="textoCentra"> Stu-Ventures te permite <b id="LinksEstas">publicar constantemente</b> emprendimientos con la mejor relación calidad. <b id="LinksEstas">¡Compruébalo!</b> </p>
                        </div>
                        <div class="d-flex justify-content-center">
                                <h1 class="colorTurquesaCentro1">¡NO ESPERES MÁS Y PUBLICA YA!</h1>
                            </div>
                        <div class="col-md-12 " id="iconoPu">
                            <img src="../img/idea2.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-6" id="FormPubli">
                    <form action="InsertarPublicacion.php" method="POST" class="row g-3 needs-validation" id="formRegistro" novalidate enctype="multipart/form-data">
                        <p class="textoCentra ">Para poder dar a conocer tu emprendimiento en Stu-Ventures, debes completar el siguiente formulario:</p>
                        <hr class="hrcompleto2">
                        <p class="text-danger small ">*Recuerda completar todos los campos.</p>
                        <div class="row g-3">
                            <div class="form-group col-md-6">

                                <input type="text" class="form-control" name="Titulo" id="Titulo" placeholder="Nombre del emprendimiento" required>
                            </div>
                            <div class="form-group col-md-6">

                                <select name="categoria" id="categoria" class="form-select" required>
                                    <option value="">Categoría...</option>
                                    <option name="opciones" value="Intelectual">Intelectual</option>
                                    <option name="opciones" value="Deporte">Deporte</option>
                                    <option name="opciones" value="Tecnología">Tecnología</option>
                                    <option value="Entretenimiento">Entretenimiento</option>
                                    <option name="opciones" value="Útiles">Útiles</option>
                                    <option name="opciones" value="Material">Material</option>
                                    <option name="opciones" value="Ropa">Ropa</option>
                                    <option name="opciones" value="Comida">Comida</option>
                                    <option name="opciones" value="Bebidas">Bebidas</option>
                                    <option name="opciones" value="Salud">Salud</option>
                                    <option name="opciones" value="Accesorios">Accesorios</option>
                                    <option name="opciones" value="Cosméticos">Cosméticos</option>
                                    <option name="opciones" value="Electrodomésticos">Electrodomésticos</option>
                                    <option name="opciones" value="Electrónica">Electrónica</option>
                                    <option name="opciones" value="Hogar y muebles">Hogar y muebles</option>
                                    <option name="opciones" value="Herramientas">Herramientas</option>
                                    <option name="opciones" value="Mascotas">Mascotas</option>
                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <textarea name="BreveDescripcion" id="BreveDescripcion" style="min-height: 100px;" class="form-control" placeholder="Descripción breve" required>
</textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <textarea name="Descripcion" id="Descripcion" style="min-height: 200px;" class="form-control" placeholder="Descripción general" required>
</textarea>

                            </div>

                            <div class="form-group col-md-6">
                                <select name="Institucion" id="Institucion" class="form-select" required>
                                    <option value="">Institución...</option>
                                    <option name="opInstitu" value="<?php echo $filasInstitu['Nombre_Institucion']; ?>"><?php echo $filasInstitu['Nombre_Institucion']; ?></option>

                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <select name="Sede" id="Sede" class="form-select" required>
                                    <option value="">Sede...</option>
                                    <?php while ($filasSede = mysqli_fetch_array($resultadoSede)) { ?>
                                        <option name="opSede" value="<?php echo $filasSede['Sede']; ?>"><?php echo $filasSede['Sede']; ?></option>
                                    <?php } ?>
                                </select>


                            </div>
                            <div class="form-group col-md-6"> 
                                <input type="text" pattern="^[1-9]\d*$" class="form-control" name="precio" id="precio" placeholder="Precio" required>
                                <div class="invalid-feedback">
                                    Debes ingresar un valor númerico positivo y sin ningún símbolo.
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="file" accept="image/*" class="form-control" name="foto" id="imagen" placeholder="Imagen" required>
                               
                            </div>
                            <div class="form-group col-md-12 text-center" >
                                <input type="checkbox" class="form-check-input" required>  Acepto seguir los <a href="../Politicas.html"  target="_blank" id="btnregistro">términos y condiciones </a> de Stu-Ventures. De no cumplir, estoy en conocimiento 
                                de que se eliminará mi publicación.
                                <br>
                            </div>
                        </div>
                        <button type="submit" class="btnEnviar" name="subir" onclick=" return ConfirmarPublicar()">Publicar</button><br>
                    </form><br>
                </div>

            </div><br><br>
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