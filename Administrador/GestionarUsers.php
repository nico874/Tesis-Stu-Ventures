<?php include("../bd/conexion.php");
include("../validaciones/validasesionAdm.php"); ?>
<?php


$idUser = (isset($_POST['idUser'])) ? $_POST['idUser'] : "";
$TotalEm = (isset($_POST['TotalEm'])) ? $_POST['TotalEm'] : "";
$TotalEm1 = (isset($_POST['TotalEm1'])) ? $_POST['TotalEm1'] : "";
$TotalEm2 = (isset($_POST['TotalEm2'])) ? $_POST['TotalEm2'] : "";
$Estado = (isset($_POST['Estado'])) ? $_POST['Estado'] : "";
$rutUser = (isset($_POST['rutUser'])) ? $_POST['rutUser'] : "";
$Nombre = (isset($_POST['Nombre'])) ? $_POST['Nombre'] : "";
$ApellidoP = (isset($_POST['ApellidoP'])) ? $_POST['ApellidoP'] : "";
$ApellidoM = (isset($_POST['ApellidoM'])) ? $_POST['ApellidoM'] : "";
$Direccion = (isset($_POST['Direccion'])) ? $_POST['Direccion'] : "-";
$Comuna = (isset($_POST['Comuna'])) ? $_POST['Comuna'] : "-";
$Contacto = (isset($_POST['Contacto'])) ? $_POST['Contacto'] : "-";
$Correo = (isset($_POST['Correo'])) ? $_POST['Correo'] : "";
$TipoUsuario = (isset($_POST['TipoUsuario'])) ? $_POST['TipoUsuario'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

$mostrarModal = false;

switch ($accion) {

    case "btnEliminar":


        if ($TipoUsuario == 3) {
        } else {

            $consultaU = "UPDATE usuario set Activo = '0' WHERE idUsuario = '$idUser' ";
            $consultaEmprendis = "UPDATE publicacion set ActivoPubli = '2' WHERE Usuario_idUsuario = '$idUser' AND ActivoPubli BETWEEN 0 AND 2";

            if (mysqli_query($conexion, $consultaU) && mysqli_query($conexion, $consultaEmprendis)) {
                header('Location: GestionarUsers.php');
            }
        }
        break;
    case "btnActualiza":

        if ($TipoUsuario == 3) {
        } else {

            $consultaU = "UPDATE usuario set Activo = '1' WHERE idUsuario = '$idUser'";

            $consultaEmprendis = "UPDATE publicacion set ActivoPubli = '1' WHERE Usuario_idUsuario = '$idUser' AND ActivoPubli = '2' ";
            if (mysqli_query($conexion, $consultaU) && mysqli_query($conexion, $consultaEmprendis)) {
                header('Location: GestionarUsers.php');
            }
        }
        break;


    case "Seleccionar":
        $mostrarModal = true;

        $sqlConsul = "SELECT * from usuario WHERE idUsuario = '$idUser'";
        $resultadoSql = mysqli_query($conexion, $sqlConsul);
        $columnaSql = mysqli_fetch_array($resultadoSql);

        if ($columnaSql['Tipo_usuario'] == 1) {

            $Visitante = "Visitante";
            $consulta5 = "SELECT * from telefono WHERE Usuario_idUsuario = ' $columnaSql[idUsuario]'";
            $resultado5 =  mysqli_query($conexion, $consulta5);
            $columna5 = mysqli_fetch_array($resultado5);

            $consultaMail = "SELECT * from correo_electronico WHERE Usuario_idUsuario = '" . $columnaSql['idUsuario'] . "'";
            $resultadorMail = mysqli_query($conexion, $consultaMail);
            $columnaMail = mysqli_fetch_array($resultadorMail);

            $idUser = $columnaSql['idUsuario'];
            $rutUser = $columnaSql['rut'];
            $Estado = $columnaSql['Activo'];
            $Nombre = $columnaSql['Nombre'];
            $ApellidoP = $columnaSql['Apellido_Paterno'];
            $ApellidoM = $columnaSql['Apellido_Materno'];
            $Contacto = $columna5['Numero'];
            $Correo = $columnaMail['Direccion_correo'];
            $TipoUsuario = $Visitante;
        }
        if ($columnaSql['Tipo_usuario'] == 2) {

            $Emprendedor = "Emprendedor";

            $consulta3 = "SELECT *  from direccion WHERE Usuario_idUsuario = '$columnaSql[idUsuario]'";
            $resultado3 = mysqli_query($conexion, $consulta3);
            $columna3 = mysqli_fetch_array($resultado3);

            $consulta5 = "SELECT * from telefono WHERE Usuario_idUsuario = ' $columnaSql[idUsuario]'";
            $resultado5 =  mysqli_query($conexion, $consulta5);
            $columna5 = mysqli_fetch_array($resultado5);

            $sqlCantiEm = "SELECT COUNT(*) idPublicacion from publicacion Where Usuario_idUsuario = ' $columnaSql[idUsuario]'";
            $resultaCantiEm = mysqli_query($conexion, $sqlCantiEm);
            $filaEm = mysqli_fetch_array($resultaCantiEm);

            $TotalCantiEm = $filaEm['idPublicacion'];

            $sqlCantiEm1 = "SELECT COUNT(*) idPublicacion from publicacion Where Usuario_idUsuario = ' $columnaSql[idUsuario]' AND ActivoPubli = '1'";
            $resultaCantiEm1 = mysqli_query($conexion, $sqlCantiEm1);
            $filaEm1 = mysqli_fetch_array($resultaCantiEm1);

            $TotalCantiEm1 = $filaEm1['idPublicacion'];

            $sqlCantiEm2 = "SELECT COUNT(*) idPublicacion from publicacion Where Usuario_idUsuario = ' $columnaSql[idUsuario]' AND ActivoPubli = '0'";
            $resultaCantiEm2 = mysqli_query($conexion, $sqlCantiEm2);
            $filaEm2 = mysqli_fetch_array($resultaCantiEm2);

            $TotalCantiEm2 = $filaEm2['idPublicacion'];

            $consultaMail = "SELECT * from correo_electronico WHERE Usuario_idUsuario = '" . $columnaSql['idUsuario'] . "'";
            $resultadorMail = mysqli_query($conexion, $consultaMail);
            $columnaMail = mysqli_fetch_array($resultadorMail);

            $idUser = $columnaSql['idUsuario'];
            $TotalEm =  $TotalCantiEm;
            $TotalEm1 =  $TotalCantiEm1;
            $TotalEm2 = $TotalCantiEm2;
            $Estado = $columnaSql['Activo'];
            $rutUser = $columnaSql['rut'];
            $Nombre = $columnaSql['Nombre'];
            $ApellidoP = $columnaSql['Apellido_Paterno'];
            $ApellidoM = $columnaSql['Apellido_Materno'];
            $Direccion =  $columna3['Direccion'];
            $Comuna =  $columna3['Comuna'];
            $Contacto = $columna5['Numero'];
            $Correo = $columnaMail['Direccion_correo'];
            $TipoUsuario =  $Emprendedor;
        }
        if ($columnaSql['Tipo_usuario'] == 3) {

            $admin = "Administrador";

            $consulta3 = "SELECT *  from direccion WHERE Usuario_idUsuario = '$columnaSql[idUsuario]'";
            $resultado3 = mysqli_query($conexion, $consulta3);
            $columna3 = mysqli_fetch_array($resultado3);

            $consulta5 = "SELECT * from telefono WHERE Usuario_idUsuario = ' $columnaSql[idUsuario]'";
            $resultado5 =  mysqli_query($conexion, $consulta5);
            $columna5 = mysqli_fetch_array($resultado5);

            $consultaMail = "SELECT * from correo_electronico WHERE Usuario_idUsuario = '" . $columnaSql['idUsuario'] . "'";
            $resultadorMail = mysqli_query($conexion, $consultaMail);
            $columnaMail = mysqli_fetch_array($resultadorMail);

            $idUser = $columnaSql['idUsuario'];
            $rutUser = $columnaSql['rut'];
            $Estado = $columnaSql['Activo'];
            $Nombre = $columnaSql['Nombre'];
            $ApellidoP = $columnaSql['Apellido_Paterno'];
            $ApellidoM = $columnaSql['Apellido_Materno'];
            $Direccion =  $columna3['Direccion'];
            $Comuna =  $columna3['Comuna'];
            $Contacto = $columna5['Numero'];
            $Correo = $columnaMail['Direccion_correo'];
            $TipoUsuario =  $admin;
        }


        break;
}

$sqlMensajes = "SELECT COUNT(*) Estado from chat Where Recibe_Usuarioid = '$_SESSION[idUsuarioAdmin]' AND Estado = '1'";
$resultaMensa = mysqli_query($conexion, $sqlMensajes);
$filamensa = mysqli_fetch_array($resultaMensa);

$Totalmensajes = $filamensa['Estado'];

$sqlUsuario = "SELECT * FROM usuario WHERE idUsuario = '$_SESSION[idUsuarioAdmin]'";
$resultadoUsuario = mysqli_query($conexion, $sqlUsuario);
$filasUsuario  =  mysqli_fetch_array($resultadoUsuario);

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
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/0086a4c4a4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/estilos.css">
    <script src="../js/funciones.js"></script>
    <title>Gestionar usuarios | Administrador</title>

</head>
<script>
    function ConfirmarDeleteUser() {
        var respuesta = confirm("¿Estas seguro que deseas SUSPENDER a este usuario?");
        if (respuesta == true) {
            return true;
        } else {
            return false;
        }
    }

    function ConfirmarActivo() {
        var respuesta = confirm("¿Estás seguro que quieres ACTIVAR nuevamente este usuario?");
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
            <img src="../img/gestion3.png" class="w-100" id="imgCentral" alt="" />
        </div>
    </section>

    <section class="contenedorUsers"><br>
        <div class="container-fluid">
            <div class="container">
                <div class="person2">
                    <a href="MenuAdministrador.php"> <i class="bi bi-arrow-left-circle"></i> </a>
                </div>
            </div>
            <h1 class="tituloEmprendi w3-center w3-animate-top"><i class="bi bi-people" id="iconoMorado"></i> GESTIONAR USUARIOS
                <hr>
            </h1>
            <div id="TextoCentro"><br>
                <p id="textoCenter3">Bienvenido a "Gestión de usuarios", aquí podrás <b id="LinksEstas">consultar</b> los datos de los usuarios y también suspenderlos de Stu-Ventures.</p>
                <div class="container">
                    <form action="GestionarUsers.php" method="GET">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-5 col-sm-12 col-xs-12 input-wrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" class="input-icon" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                                <input type="search" class="form-control" name="Buscar" id="CampoBuscar" placeholder="Ingresa el e-mail del usuario">
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btnBuscar" id="btnBuscar" value="Buscar">Buscar</button>
                            </div>
                        </div>
                    </form><br>
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
                                        <div class="col-md-12" id="IconoAdm6">
                                            <i class="bi bi-info-circle"></i>
                                        </div>
                                        <div class="col-md-12">
                                            En "gestión de usuarios" podrás <b id="LinksEstas">ver</b>, <b id="LinksEstas">suspender temporalmente un emprendimiento, activarlo </b> y <b id="LinksEstas">eliminarlo</b>.
                                            Podrás ver la información del emprendimiento, quién es el emprendedor, estado, visitas, valoraciones, entre otros.
                                        </div>
                                    </div>
                                    <div class="conte">
                                        <div class="col-md-12" id="IconoAdm14">
                                            <i class="bi bi-eye"></i>
                                        </div>
                                        <div class="col-md-12">
                                            Este icono te indicará que podrás <b id="LinksEstas"> consultar</b> los datos del usuario seleccionado al hacer "clic" en dicho boton.
                                        </div>
                                    </div>

                                    <div class="conte">
                                        <div class="col-md-12" id="IconoAdm8">
                                            <i class="bi bi-unlock"></i>
                                        </div>
                                        <div class="col-md-12">
                                            Esto icono te indicará que el usuario se encuentra <b id="LinksEstas">activo</b> y que <b id="LinksEstas">podrás suspenderlo</b> al hacer "clic" en dicho boton.
                                        </div>
                                    </div>
                                    <div class="conte">
                                        <div class="col-md-12" id="IconoAdm10">
                                            <i class="bi bi-lock"></i>
                                        </div>
                                        <div class="col-md-12">
                                            Esto icono te indicará que el usuario se encuentra <b id="LinksEstas">suspendido</b> y que <b id="LinksEstas">podrás volver a activarlo</b> al hacer "clic" en dicho boton.
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div><br>
                </form><br><br>
            </div>
            <div class="container">

                <script>
                    // EVITAR REENVIO DE DATOS.
                    if (window.history.replaceState) { // verificamos disponibilidad
                        window.history.replaceState(null, null, window.location.href);
                    }
                </script>
                <form action="" method="post">
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">

                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row ">
                                        <div class="col-md-5" id="ModalUser">
                                            <!-- Profile widget -->
                                            <div class="rounded overflow-hidden">
                                                <div class="bg-light text-center">
                                                    <div class="row g-0">
                                                        <div class="col-md-4 d-flex justify-content-center align-items-center">
                                                            <div class="FondoPerson">
                                                                <div class="person">
                                                                    <i class="bi bi-person" class="root-287"></i>
                                                                </div>
                                                            </div><br>
                                                        </div>
                                                        <div class="col-md-8 ">
                                                            <div class="card-body">
                                                                <h5 class="card-title titulo5">USUARIO
                                                                    <hr>
                                                                </h5>
                                                                <p class="font-weight ">Nombre: <?php echo $Nombre; ?> <?php echo $ApellidoP; ?> <?php echo $ApellidoM; ?> </p>
                                                                <p class="font-weight">E-mail: <?php echo $Correo; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> <br>
                                                <?php if ($TipoUsuario != "Visitante" && $TipoUsuario != "Administrador") { ?>
                                                    <div class="bg-light p-4 d-flex justify-content-end text-center">
                                                        <ul class="list-inline mb-0">
                                                            <li class="list-inline-item">
                                                                <h5 class="font-weight-bold mb-0 d-block"> <?php echo $TotalEm ?></h5><small class="text-muted"><b id="rigth">Emprendimientos</b> </small>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <h5 class="font-weight-bold mb-0 d-block"><?php echo $TotalEm1 ?></h5><small class="text-muted"><b id="rigth">Activos</b> </small>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <h5 class="font-weight-bold mb-0 d-block"><?php echo $TotalEm2 ?></h5><small class="text-muted"><b id="rigth">Inactivos</b> </small>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                <?php } ?>
                                                <div class="px-4 py-3">
                                                    <div class="d-flex justify-content-start">
                                                        <h5 class="card-title titulo5">INFORMACIÓN
                                                            <hr>
                                                        </h5>
                                                    </div>
                                                    <div class="p-4 rounded shadow-sm bg-light">
                                                        <?php if ($Estado == 1) {
                                                            $Estado = "ACTIVO";
                                                        ?>
                                                            <p class="font-italic mb-0"><b>USUARIO <?php echo  $Estado; ?></b></p>
                                                        <?php } else {
                                                            $Estado = "SUSPENDIDO";
                                                        ?>
                                                            <p class="font-italic mb-0 text-danger"><b>USUARIO <?php echo  $Estado; ?></b></p>
                                                        <?php } ?>
                                                        <p class="font-italic mb-0">Tipo de usuario: <?php echo $TipoUsuario; ?></p>
                                                        <p class="font-italic mb-0">Rut: <?php echo $rutUser; ?></p>
                                                        <?php if ($TipoUsuario != "Visitante") { ?>
                                                            <p class="font-italic mb-0">Dirección: <?php echo $Direccion; ?></p>
                                                            <p class="font-italic mb-0">Comuna: <?php echo $Comuna; ?></p>
                                                        <?php } ?>
                                                        <p class="font-italic mb-0">Número de contacto: <?php echo $Contacto; ?></p>
                                                    </div>
                                                </div>
                                                <?php if ($TipoUsuario != "Visitante" && $TipoUsuario != "Administrador") {

                                                    $consultEmprenFoto = "SELECT * from publicacion WHERE Usuario_idUsuario = '$idUser' AND ActivoPubli BETWEEN 0 AND 2";
                                                    $resulEmprenFoto = mysqli_query($conexion, $consultEmprenFoto);
                                                ?>
                                                    <div class="py-4 px-4">
                                                        <div class="d-flex justify-content-start">
                                                            <h5 class="card-title titulo5">EMPRENDIMIENTOS
                                                                <hr>
                                                            </h5>
                                                        </div>
                                                        <div class="row bg-light" id="FotosEmpre">
                                                            <?php while ($filasEmprenFoto = mysqli_fetch_array($resulEmprenFoto)) { ?>
                                                                <div class="col-lg-6 mb-2 pr-lg-1"><img src="data:image/jpg;base64, <?php echo base64_encode($filasEmprenFoto['Foto_publicacion']); ?>" alt="" class="img-fluid rounded shadow-sm">
                                                                    <h5 class="card-title titulo5"><?php echo $filasEmprenFoto['Titulo'] ?> </h5>
                                                                    <div class="d-flex justify-content-center">
                                                                        <a class="btn VerMas2" href="Veremprendimientoadm.php?idPublicacion=<?php echo $filasEmprenFoto['idPublicacion'] ?>"> Ver más</a>
                                                                    </div>
                                                                </div>

                                                            <?php  } ?>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button value="btnCancelar" type="submit" class="VerDatos" name="accion">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">

                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Rut</th>
                                <th>Usuario</th>
                                <th>Tipo</th>
                                <th>E-mail </th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <tr>
                                <?php
                                include '../bd/ReadUser.php';
                                $cont = 0;
                                while ($columnasUsers1 = mysqli_fetch_array($resultadouser1)) { ?>

                            <tr class="datosUser">
                                <?php
                                    $consultaUsers1mail = "SELECT * from correo_electronico WHERE Usuario_idUsuario = '" . $columnasUsers1['idUsuario'] . "'";
                                    $resultadorUsers1mail = mysqli_query($conexion, $consultaUsers1mail);

                                    while ($columnasUsers1mail = mysqli_fetch_array($resultadorUsers1mail)) {
                                        $cont++;

                                ?>

                                    <td><?php echo $cont; ?></td>
                                    <td><?php echo $columnasUsers1['rut']; ?></td>
                                    <td><?php echo $columnasUsers1['Nombre']; ?> <?php echo $columnasUsers1['Apellido_Paterno']; ?> <?php echo $columnasUsers1['Apellido_Materno']; ?></td>
                                    <?php if ($columnasUsers1['Tipo_usuario'] == 1) {
                                            $EmprendedoR = "Visitante";
                                    ?>
                                        <td><?php echo  $EmprendedoR ?></td>
                                    <?php } ?>
                                    <?php if ($columnasUsers1['Tipo_usuario'] == 2) {
                                            $EmprendedoR = "Emprendedor";
                                    ?>
                                        <td><?php echo  $EmprendedoR ?></td>
                                    <?php } ?>
                                    <?php if ($columnasUsers1['Tipo_usuario'] == 3) {
                                            $EmprendedoR = "Administrador";
                                    ?>
                                        <td><?php echo  $EmprendedoR ?></td>
                                    <?php } ?>

                                    <td><?php echo $columnasUsers1mail['Direccion_correo']; ?></td>
                                    <?php if ($columnasUsers1['Activo'] == 0) {
                                            $ActivoIna = "Inactivo";
                                    ?>
                                        <td><?php echo  $ActivoIna; ?></td>
                                    <?php } ?>
                                    <?php if ($columnasUsers1['Activo'] == 1) {
                                            $ActivoIna = "Activo";
                                    ?>
                                        <td><?php echo  $ActivoIna; ?></td>
                                    <?php } ?>

                                    <td>
                                        <?php if ($columnasUsers1['Tipo_usuario'] == 2) {
                                        ?>
                                            <form action="" method="post">
                                                <input type="hidden" name="idUser" value="<?php echo $columnasUsers1['idUsuario'] ?>">

                                                <button type="submit" class="VerDatos2" name="accion" value="Seleccionar" title="Ver datos de usuario"><i class="bi bi-eye" id="accionesIcoPe"></i></button>
                                                <?php if ($columnasUsers1['Activo'] == 0) { ?>
                                                    <button type="submit" class="EliminarS2" name="accion" value="btnActualiza" title="Habilitar usuario" onclick=" return ConfirmarActivo()"><i class="bi bi-lock" id="accionesIcoPe"></i></button>
                                                <?php } else { ?>
                                                    <button value="btnEliminar" type="submit" class="Seleccionar2" name="accion" onclick=" return ConfirmarDeleteUser()" title="Suspender usuario"><i class="bi bi-unlock" id="accionesIcoPe"></i></button>
                                                <?php  } ?>



                                            </form>
                                        <?php } ?>
                                        <?php if ($columnasUsers1['Tipo_usuario'] == 1) {


                                        ?>
                                            <form action="" method="post">
                                                <input type="hidden" name="idUser" value="<?php echo $columnasUsers1['idUsuario'] ?>">
                                                <button type="submit" class="VerDatos2" name="accion" value="Seleccionar" title="Ver datos de usuario"><i class="bi bi-eye" id="accionesIcoPe"></i></button>
                                                <?php if ($columnasUsers1['Activo'] == 0) { ?>
                                                    <button type="submit" class="EliminarS2" name="accion" value="btnActualiza" title="Habilitar usuario" onclick=" return ConfirmarActivo()"><i class="bi bi-lock" id="accionesIcoPe"></i></button>
                                                <?php } else { ?>
                                                    <button value="btnEliminar" type="submit" class="Seleccionar2" name="accion" title="Suspender usuario" onclick=" return ConfirmarDeleteUser()"><i class="bi bi-unlock" id="accionesIcoPe"></i></button>
                                                <?php  } ?>
                                            </form>
                                        <?php } ?>

                                        <?php if ($columnasUsers1['Tipo_usuario'] == 3) { ?>
                                            <form action="" method="post">
                                                <input type="hidden" name="idUser" value="<?php echo $columnasUsers1['idUsuario'] ?>">
                                                <button type="submit" class="VerDatos2" name="accion" value="Seleccionar"><i class="bi bi-eye" id="accionesIcoPe"></i></button>

                                            </form>
                                        <?php } ?>
                                    </td>
                                <?php } ?>
                            <?php } ?>
                            </tr>
                        </tbody>
                    </table>
                    <?php if ($cont > 10) { ?>
                        <div class="d-flex justify-content-center">
                            <button class="masEm" name="MostrarMás" id="MostrarMás">MOSTRAR MÁS USUARIOS</button>
                        </div>
                    <?php } ?>
                    <?php if ($cont < 1) {   ?>
                        <div class="d-flex justify-content-center">
                            <h1 class="colorTurquesaCentro">NO SE HA ENCONTRADO UN USUARIO ;(</h1>
                        </div>
                    <?php } ?>

                </div>
                <script>
                    $(".datosUser").slice(0, 18).show()
                    $(".masEm").on("click", function() {
                        $(".datosUser:hidden").slice(0, 18).slideDown()
                        if ($(".datosUser:hidden").length == 0) {
                            $(".masEm").fadeOut('slow');
                        }
                    })
                </script>
                <?php if ($mostrarModal) { ?>
                    <script>
                        $(window).on('load', function() {
                            $("#exampleModal").modal('show');
                        });
                    </script>
                <?php } ?>
            </div><br><br>
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