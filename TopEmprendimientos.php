<?php include("bd/conexion.php"); ?>

<?php


$sqlInstituciones = "SELECT * FROM institucion";
$resultadoInstituciones = mysqli_query($conexion, $sqlInstituciones);
$filasInstituciones =  mysqli_fetch_array($resultadoInstituciones);

$sqlSede = "SELECT Sede from institucion WHERE Nombre_Institucion = '$filasInstituciones[Nombre_Institucion]' ";
$resultadoSede = mysqli_query($conexion, $sqlSede);
$Sede = (isset($_POST['Sede'])) ? $_POST['Sede'] : "";
$_SESSION['Sede'] = $Sede;

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
    $sqlEmprendiFecha = "SELECT * from publicacion Where  titulo LIKE '%" . $TituloEmprendi . "%' AND WEEK(fecha)=$semana ORDER BY Valoracion desc LIMIT 9 ";
    $resulFecha = mysqli_query($conexion, $sqlEmprendiFecha);
} else {
    if ($Categoria != "") {

        $sqlPublicaciones = "SELECT * FROM publicacion  WHERE Categoria ='$Categoria' AND WEEK(fecha)=$semana ORDER BY Valoracion desc LIMIT 9 ";
        $resulFecha = mysqli_query($conexion, $sqlPublicaciones);
    } else {
        $sqlEmprendiFecha = "SELECT * from publicacion Where  ActivoPubli ='1' AND WEEK(fecha)=$semana ORDER BY Valoracion desc LIMIT 10 ";
        $resulFecha = mysqli_query($conexion, $sqlEmprendiFecha);
    }
}



?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/stu-ventures2.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="js/funciones.js"></script>
    <link rel="stylesheet" href="css/estilos.css">
    <title>Top Semanal</title>
    <script>
        function ConfirmarVerm??s() {
            var respuesta = confirm("Ser??s redireccionado a Inicio de sesi??n para poder ver m??s informaci??n de los emprendimientos");
            if (respuesta == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>
</head>

<body>
    <div class="header-top"></div>

    <!--MENU-->
    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-white">
        <div class="container-fluid">
            <a href="index.html" class="brand-logo "> <img src="img/logo2.PNG" class="img-fluid" width="298px"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <div class="navbar-nav  ms-auto text-center " id="navEfecto">
                    <a class="nav-item nav-link " href="Index.html"><i class="bi bi-house-door"></i> Inicio</a>
                    <a class="nav-item nav-link " href="Emprendimientos.php"><i class="bi bi-shop"></i> Emprendimientos</a>
                    <a class="nav-item nav-link active1 " href="TopEmprendimientos.php"><i class="bi bi-sort-up"></i>
                        Top semanal</a>
                    <a class="nav-item nav-link" href="Contacto.php"><i class="bi bi-envelope-paper"></i> Contacto</a>
                    <a class="nav-item nav-link" href="donacion.php"><i class="bi bi-piggy-bank"></i> Donaci??n</a>
                    <a class="nav-item nav-link" href="Registro.php"><i class="bi bi-person-plus"></i> Registrarme</a>
                    <a class="nav-item nav-link" href="Login.php" target="_blank"><i class="bi bi-box-arrow-in-right"></i> Inicio de
                        sesi??n</a>
                </div>
            </div>
        </div>
    </nav>

    <!--IMAGEN-->
    <section class="view">
        <div class="imagenTop bg-image">
            <img src="img/empren3.png" class="w-100" id="imgCentral" alt="" />
        </div>
    </section>

    <section class="contenederEmprendis"><br>
        <div class="container-fluid">
            <h1 class="tituloEmprendi w3-center w3-animate-top"><i class="bi bi-sort-up" id="iconoMorado"></i> TOP SEMANAL
                <hr>
            </h1>
            <div id="TextoCentro"><br>
                <p id="textoCenter3">??Top semanal de los 10 emprendimientos <b id="LinksEstas">MEJORES VALORADOS!</b> Recuerda que para ver m??s del emprendimiento <a href="Login.php" target="_blank"><b id="btnregistro">debes inciar sesi??n.</b></a></p>
                <br>
            </div>
            <div class="container">
                <!--TARJETAS-->
                <div class="row g-3">
                    <?php
                    $conta = 0;
                    $contaVueltas = 0;
                    while ($filaFecha = mysqli_fetch_array($resulFecha)) {
                        $contaVueltas++;
                        if ($filaFecha['Valoracion'] == 0.0 && $filaFecha['Valoracion'] < 1.0) {
                            $trellas = "";
                            $trellasWhite = "???????????????";
                        }
                        if ($filaFecha['Valoracion'] >= 1.0 && $filaFecha['Valoracion'] < 2.0) {
                            $trellas = "???";
                            $trellasWhite = "????????????";
                        }
                        if ($filaFecha['Valoracion'] >= 2.0 && $filaFecha['Valoracion'] < 3.0) {
                            $trellas = "??????";
                            $trellasWhite = "?????????";
                        }
                        if ($filaFecha['Valoracion'] >= 3.0 && $filaFecha['Valoracion'] < 4.0) {
                            $trellas = "?????????";
                            $trellasWhite = "??????";
                        }
                        if ($filaFecha['Valoracion'] >= 4.0 && $filaFecha['Valoracion'] < 5.0) {
                            $trellas = "????????????";
                            $trellasWhite = "???";
                        }
                        if ($filaFecha['Valoracion'] == 5.0) {
                            $trellas = "???????????????";
                            $trellasWhite = "";
                        }
                        $conta = 5;

                    ?>
                        <div class="card col-lg-6 col-md-6 col-sm-12  " id="tajertaEmprendi2">
                            <div class="d-flex justify-content-center">
                                <img src="data:image/jpg;base64, <?php echo base64_encode($filaFecha["Foto_publicacion"]); ?>" class="img-fluid " id="ImgTop" alt="...">
                            </div>
                            <div class="card-body">
                                <div class=" CategoriaTop">
                                    Categor??a: <?php echo ($filaFecha["Categoria"]); ?>
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
                                <p class="card-text">Instituci??n: <?php echo ($FilaInstituSede["Nombre_Institucion"]); ?>, <?php echo ($FilaInstituSede["Sede"]); ?>.</p>
                                <p class="card-text">Breve Descripici??n: <?php echo ($filaFecha["Breve_Descripcion"]); ?>...</p>
                                <p class="card-text" name="Precio">Precio: <?php echo ($filaFecha["Precio"]); ?></p>
                                <div class="BtnVerMas">
                                    <a class="btn VerMasTop" target="_blank" href="Login.php" onclick=" return ConfirmarVerm??s()"> Ver m??s...</a>
                                </div>
                                <div class="card-footer d-flex justify-content-start">
                                    <small class="text-muted">Fecha de publicaci??n: <?php echo ($filaFecha["Fecha"]); ?></small>
                                </div>

                            </div>
                        </div>
                    <?php } ?>
                    <?php if ($contaVueltas < 1) { ?>
                        <h1 class="colorTurquesaCentro">LAMENTABLEMENTE ESTA SEMANA NO HAY UN EMPRENDIMIENTO ;(</h1>
                    <?php  } ?>
                </div>
            </div> <br>
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
                            <li><a href="index.html">Inicio</a></li>
                            <li><a href="Contacto.php">Contacto</a></li>
                            <li><a href="donacion.php">Donaciones</a></li>
                            <li><a href="Preguntas.html"> Preguntas frecuentes</a></li>
                            <li><a href="Politicas.html"> T??rminos y condiciones</a></li>
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