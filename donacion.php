<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/stu-ventures2.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/estilos.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="js/funciones.js"></script>
    <title>Donación</title>
</head>

<body>

    <div class="header-top"></div>

    <!--MENU-->

    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-white">
        <div class="container-fluid">
            <a href="index.html" class="brand-logo "> <img src="img/logo2.PNG" class="img-fluid" width="300px"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <div class="navbar-nav  ms-auto text-center " id="navEfecto">
                    <a class="nav-item nav-link " href="Index.html"><i class="bi bi-house-door"></i> Inicio</a>
                    <a class="nav-item nav-link " href="Emprendimientos.php"><i class="bi bi-shop"></i>
                        Emprendimientos</a>
                    <a class="nav-item nav-link " href="TopEmprendimientos.php"><i class="bi bi-sort-up"></i>
                        Top semanal</a>
                    <a class="nav-item nav-link " href="Contacto.php"><i class="bi bi-envelope-paper"></i> Contacto</a>
                    <a class="nav-item nav-link active1 " href="donacion.php"><i class="bi bi-piggy-bank"></i>
                        Donación</a>
                    <a class="nav-item nav-link" href="Registro.php"><i class="bi bi-person-plus"></i> Registrarme</a>
                    <a class="nav-item nav-link" href="Login.php" target="_blank"><i class="bi bi-box-arrow-in-right"></i> Inicio de
                        sesión</a>
                </div>
            </div>
        </div>
    </nav>

    <!--SECCION DE DONACION-->
    <section class="donacion">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <img src="img/dona02.png" class="img-fluid rounded-start w3-center w3-animate-left" alt="...">
                </div>
                <div class="col-md-8">
                    <h1 class="tituloDona w3-center w3-animate-top"><i class="bi bi-piggy-bank" id="iconoMorado"></i> DONACIÓN
                        <hr>
                    </h1>
                    <div class="card-body w3-center ">
                        <h5 class="card-titledona">¿Sabías que es lo que logras generar con tu <b id="LinksEstas">DONACION</b>?</h5><br>
                        <p class="card-textdona">Gracias a tu donación voluntaria, estarás apoyando a Stu-Ventures para poder ir mejorando constantemente y
                            seguir adelante en su principal objetivo, ayudar a dar visibilidad
                            a los emprendimientos de estudiantes de casas de estudio asociadas.</p>
                        <p>Si consideras que puedes apoyarnos, haz click en el botón de <b id="LinksEstas">DONATE</b> y serás redigido a <b id="LinksEstas">PAYPAL</b>:</p>
                        <form action="https://www.paypal.com/donate" class="formdona" method="post" target="_top">
                            <input type="hidden" name="hosted_button_id" value="GUQPRRABQXYVA" />
                            <input type="image" width="200px" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
                            <img alt="" border="0" src="https://www.paypal.com/en_CL/i/scr/pixel.gif" width="1" height="1" />
                        </form><br>
                        <div class="card-footer text-muted">¡Muchas gracias por tu contribución!</div>
                    </div>
                </div>
            </div>
        </div>
    </section><br><br>
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
                            <li><a href="index.html">Inicio</a></li>
                            <li><a href="Contacto.php">Contacto</a></li>
                            <li><a href="donacion.php">Donaciones</a></li>
                            <li><a href="Preguntas.html"> Preguntas frecuentes</a></li>
                            <li><a href="Politicas.html"> Términos y condiciones</a></li>
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