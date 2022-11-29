<?php include("bd/conexion.php"); ?>

<?php

$sqlInstituciones = "SELECT * FROM institucion";
$resultadoInstituciones = mysqli_query($conexion, $sqlInstituciones);
$filasInstituciones =  mysqli_fetch_array($resultadoInstituciones);

$sqlSede = "SELECT Sede from institucion WHERE Nombre_Institucion = '$filasInstituciones[Nombre_Institucion]' ";
$resultadoSede = mysqli_query($conexion, $sqlSede);
$Sede = (isset($_POST['Sede'])) ? $_POST['Sede'] : "";
$_SESSION['Sede'] = $Sede;

$sqlSede2 = "SELECT Sede from institucion WHERE Nombre_Institucion = '$filasInstituciones[Nombre_Institucion]' ";
$resultadoSede2 = mysqli_query($conexion, $sqlSede2);
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
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <script src="js/funciones.js"></script>
    <link rel="stylesheet" href="css/estilos.css">
    <title>Emprendimientos</title>
    <script>
        function ConfirmarVermás() {
            var respuesta = confirm("Serás redireccionado a Inicio de sesión para poder ver más información de los emprendimientos");
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
                    <a class="nav-item nav-link active1 " href="Emprendimientos.php"><i class="bi bi-shop"></i> Emprendimientos</a>
                    <a class="nav-item nav-link " href="TopEmprendimientos.php"><i class="bi bi-sort-up"></i>
                        Top semanal</a>
                    <a class="nav-item nav-link" href="Contacto.php"><i class="bi bi-envelope-paper"></i> Contacto</a>
                    <a class="nav-item nav-link" href="donacion.php"><i class="bi bi-piggy-bank"></i> Donación</a>
                    <a class="nav-item nav-link" href="Registro.php"><i class="bi bi-person-plus"></i> Registrarme</a>
                    <a class="nav-item nav-link" href="Login.php" target="_blank"><i class="bi bi-box-arrow-in-right"></i> Inicio de
                        sesión</a>
                </div>
            </div>
        </div>
    </nav>

    <!--IMAGEN-->

    <section class="view">
        <div class="imagenTop bg-image">
            <img src="img/emprendi4.jpeg" class="w-100" id="imgCentral" alt="" />

        </div>
    </section>

    <!--FILTRO DE BUSQUEDA-->

    <section class="contenederEmprendis"><br>
        <div class="container-fluid">
            <h1 class="tituloEmprendi w3-center w3-animate-top"><i class="bi bi-shop" id="iconoMorado"></i> EMPRENDIMIENTOS
                <hr>
            </h1>
            <div id="TextoCentro"><br>
                <p id="textoCenter3">En esta sección econtrarás todos los <b id="LinksEstas">emprendimientos disponibles de estudiantes</b> que forman parte de Stu-Ventures, busca y mucha suerte.
                    Recuerda que para ver más del emprendimiento <a href="Login.php" target="_blank"><b id="btnregistro">debes inciar sesión.</b></a></p>
                <div class="container">
                    <form action="Emprendimientos.php" method="GET">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-5 col-sm-12 col-xs-12 input-wrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" class="input-icon" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                                <input type="search" name="TituloEmprendi" class="form-control" id="CampoBuscar" placeholder="Ingresa el título del emprendimiento">
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn" id="btnBuscar" value="Buscar">Buscar</button>
                            </div>

                        </div>
                    </form><br>
                </div>
                <form action="Emprendimientos.php" method="GET">
                    <div class="Categorías">
                        <div class="container">
                            <div class="row" id="Categ">
                                <div class="form-group col-md-2">
                                    <a href="Emprendimientos.php?categoria=Intelectual"><i class="bi bi-book"></i>
                                        <label for="Intelectual">Intelectual</label></a>
                                </div>
                                <div class="form-group col-md-2">
                                    <a href="Emprendimientos.php?categoria=Tecnología"><i class="bi bi-cpu"></i>
                                        <label for="Tecnología">Tecnología</label></a>
                                </div>
                                <div class="form-group col-md-2">
                                    <a href="Emprendimientos.php?categoria=Útiles">
                                        <i class="bi bi-brush"></i>
                                        <label for="Útiles">Útiles</label></a>
                                </div>
                                <div class="form-group col-md-2">
                                    <a href="Emprendimientos.php?categoria=Material">
                                        <i class="bi bi-archive"></i>
                                        <label for="Material">Material</label></a>
                                </div>
                                <div class="form-group col-md-2">
                                    <a href="Emprendimientos.php?categoria=Ropa">
                                        <i class="bi bi-eyeglasses"></i>
                                        <label for="Ropa">Ropa</label></a>
                                </div>
                                <div class="form-group col-md-2">
                                    <a href="Emprendimientos.php?categoria=Comida">
                                        <i class="bi bi-cup-straw"></i>
                                        <label for="Comida">Comida</label></a>
                                </div>
                            </div>
                        </div>
                    </div><br>
                </form>
            </div>

            <div class="left w3-center w3-animate-left" id="FiltroBusqueda">
                <form action="Emprendimientos.php" method="GET">
                    <div class="form-group col-md-12">
                        <i class="bi bi-filter-square" id="iconoMorado"></i>
                        <h5 class="card-title titulo5">Filtro de busqueda
                            <hr>
                        </h5>

                    </div><br>
                    <div class="row g-3 d-flex justify-content-center">
                        <div class="form-group col-md-10">
                            <select name="Instituciones" id="Instituciones" class="form-select">
                                <option value="">Institución...</option>
                                <option value="<?php $filasInstituciones['Nombre_Institucion'] ?>"><?php echo $filasInstituciones['Nombre_Institucion'] ?></option>
                            </select>
                        </div>
                        <div class="form-group col-md-10">
                            <select name="Sede" id="Sede" class="form-select">
                                <option value="">Sede...</option>
                                <?php while ($filasSede = mysqli_fetch_array($resultadoSede)) { ?>
                                    <option name="Sede" value="<?php echo $filasSede['Sede']; ?>"><?php echo $filasSede['Sede']; ?></option>
                                <?php  } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-10">
                            <select name="categoria" id="categoria" class="form-select">
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
                        <div class="form-group col-md-10">
                            <select name="Vistos" id="Vistos" class="form-select">
                                <option value="">Vistos... </option>
                                <option value="MasVistos">Más vistos</option>
                            </select>
                        </div>
                        <div class="form-group col-md-10">
                            <select name="Orden" id="Orden" class="form-select">
                                <option value="">Orden... </option>
                                <option value="Descendente">Descendente</option>
                            </select>

                        </div>
                        <div class="form-group col-md-10">
                            <input type="submit" class="BtnFiltro" name="Buscar" value="Filtrar">
                            <a href="Emprendimientos.php"><button class="BtnFiltro2">Limpiar filtros</button></a>
                        </div>
                    </div>
                </form><br><br>
            </div>

            <!--FILTRO DE BUSQUEDA RESPONSIVO-->

            <div class="d-xl-none">
                <p>
                    <button class="BtnFiltroColla" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
                        <i class="bi bi-filter-square" id="IcoWhite"> Filtro</i>
                    </button>
                </p>
                <div class="collapse collapse-horizontal" id="collapseWidthExample">
                    <div class="left ">
                        <form action="Emprendimientos.php" method="GET">
                            <div class="form-group col-md-12">
                                <h5 class="card-title titulo5">Filtro de busqueda
                                    <hr>
                                </h5>

                            </div><br>
                            <div class="row g-3 d-flex justify-content-center">
                                <div class="form-group col-md-10">
                                    <select name="Instituciones" id="Instituciones" class="form-select">
                                        <option value="">Institución...</option>
                                        <option value="<?php $filasInstituciones['Nombre_Institucion'] ?>"><?php echo $filasInstituciones['Nombre_Institucion'] ?></option>
                                    </select>
                                </div>
                                <div class="form-group col-md-10">
                                    <select name="Sede" id="Sede" class="form-select">
                                        <option value="">Sede...</option>
                                        <?php while ($filasSede2 = mysqli_fetch_array($resultadoSede2)) { ?>
                                            <option name="Sede" value="<?php echo $filasSede2['Sede']; ?>"><?php echo $filasSede2['Sede']; ?></option>
                                        <?php  } ?>
                                    </select>
                                </div>


                                <div class="form-group col-md-10">
                                    <select name="categoria" id="categoria" class="form-select">
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
                                <div class="form-group col-md-10">
                                    <select name="Vistos" id="Vistos" class="form-select">
                                        <option value="">Vistos... </option>
                                        <option value="MasVistos">Más vistos</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-10">
                                    <select name="Orden" id="Orden" class="form-select">
                                        <option value="">Orden... </option>
                                        <option value="Descendente">Descendente</option>
                                    </select>

                                </div>
                                <div class="form-group col-md-10">
                                    <input type="submit" class="BtnFiltro" name="Buscar" value="Filtrar">
                                    <a href="Emprendimientos.php"><button class="BtnFiltro2">Limpiar filtros</button></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="container">
                <!--TARJETAS-->

                <div class="row">
                    <?php
                    include 'emprendimientos/BuscadorEmprendi.php';
                    $contaVueltas = 0;
                    while ($filasPublicaciones = mysqli_fetch_array($resultadoPublic)) {
                        $contaVueltas++;
                        if ($filasPublicaciones['Valoracion'] == 0.0 && $filasPublicaciones['Valoracion'] < 1.0) {
                            $trellas = "";
                            $trellasWhite = "★★★★★";
                        }
                        if ($filasPublicaciones['Valoracion'] >= 1.0 && $filasPublicaciones['Valoracion'] < 2.0) {
                            $trellas = "★";
                            $trellasWhite = "★★★★";
                        }
                        if ($filasPublicaciones['Valoracion'] >= 2.0 && $filasPublicaciones['Valoracion'] < 3.0) {
                            $trellas = "★★";
                            $trellasWhite = "★★★";
                        }
                        if ($filasPublicaciones['Valoracion'] >= 3.0 && $filasPublicaciones['Valoracion'] < 4.0) {
                            $trellas = "★★★";
                            $trellasWhite = "★★";
                        }
                        if ($filasPublicaciones['Valoracion'] >= 4.0 && $filasPublicaciones['Valoracion'] < 5.0) {
                            $trellas = "★★★★";
                            $trellasWhite = "★";
                        }
                        if ($filasPublicaciones['Valoracion'] == 5.0) {
                            $trellas = "★★★★★";
                            $trellasWhite = "";
                        }

                    ?>
                        <div class="masCards col-lg-4 col-md-6 col-sm-6 " id="tajertaEmprendi">
                            <div class="card h-100 " id="contenidoCardEmprendi">

                                <img src="data:image/jpg;base64, <?php echo base64_encode($filasPublicaciones["Foto_publicacion"]); ?>" class="card-img-top img-fluid " id="imgEmprendimiento" alt="...">

                                <div class="CategoriaImg">Categoría: <?php echo ($filasPublicaciones["Categoria"]); ?></div>
                                <div class="card-body">
                                    <h5 class="card-title titulo5"><?php echo ($filasPublicaciones["Titulo"]); ?>
                                        <hr>
                                    </h5>
                                    <?php
                                    $sqlCantiValora = "SELECT COUNT(*) Usuario_idUsuario from valoracion WHERE Publicacion_idPublicacion = '$filasPublicaciones[idPublicacion]'";
                                    $resulCantiValora = mysqli_query($conexion, $sqlCantiValora);
                                    $filaCantiValora = mysqli_fetch_array($resulCantiValora);
                                    $totalCantiValora =  $filaCantiValora['Usuario_idUsuario'];
                                    ?>
                                    <b class="d-flex justify-content-center align-items-center" id="valoracion"><?php echo $trellas ?> <span class="EstrellaBl "><?php echo $trellasWhite ?>
                                        </span><span class="CantiPerso"> (<?php echo  $totalCantiValora ?>)</span>
                                    </b>
                                    <?php
                                    $sqlIntituSede = "SELECT * from institucion WHERE idInstitucion = '$filasPublicaciones[Institucion_idInstitucion]'";
                                    $resulSqlI = mysqli_query($conexion, $sqlIntituSede);
                                    $FilaInstituSede = mysqli_fetch_array($resulSqlI);
                                    ?>
                                    <p class="card-text">Institución: <?php echo ($FilaInstituSede["Nombre_Institucion"]); ?>, <?php echo ($FilaInstituSede["Sede"]); ?>.</p>
                                    <p class="card-text"><?php echo ($filasPublicaciones["Breve_Descripcion"]); ?></p>
                                    <p class="card-text" name="Precio">Precio: <?php echo ($filasPublicaciones["Precio"]); ?></p>

                                </div>
                                <div class="BtnVerMas">
                                    <a class="btn VerMas" target="_blank" href="Login.php" onclick=" return ConfirmarVermás()">Ver más...</a>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">Fecha de publicación: <?php echo ($filasPublicaciones["Fecha"]); ?></small>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if ($contaVueltas > 9) {   ?>
                        <div class="d-flex justify-content-center">
                            <button class="masEm" name="MostrarMás" id="MostrarMás">MOSTRAR MÁS EMPRENDIMIENTOS</button>
                        </div>
                    <?php } ?>
                    <?php if ($contaVueltas < 1) {   ?>
                        <div class="d-flex justify-content-center">
                            <h1 class="colorTurquesaCentro">LAMENTABLEMENTE NO SE HAN ENCONTRADO EMPRENDIMIENTOS ;(</h1>
                        </div>
                    <?php } ?>
                </div>
            </div> <br>
            <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
            <script>
                $(".masCards").slice(0, 9).show()
                $(".masEm").on("click", function() {
                    $(".masCards:hidden").slice(0, 9).slideDown()
                    if ($(".masCards:hidden").length == 0) {
                        $(".masEm").fadeOut('slow');
                    }

                })
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