<?php include("../bd/conexion.php");
include("../validaciones/validasesionAdm.php"); ?>
<?php


$idPubli = (isset($_POST['idPubli'])) ? $_POST['idPubli'] : "";
$ActivoPubli = (isset($_POST['ActivoPubli'])) ? $_POST['ActivoPubli'] : "";
$Valoracion = (isset($_POST['Valoracion'])) ? $_POST['Valoracion'] : "";
$TotalValora = (isset($_POST['TotalValora'])) ? $_POST['TotalValora'] : "";
$Visitas = (isset($_POST['Visitas'])) ? $_POST['Visitas'] : "";
$titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : "";
$Categoria = (isset($_POST['Categoria'])) ? $_POST['Categoria'] : "";
$BreveDescrip = (isset($_POST['BreveDescrip'])) ? $_POST['BreveDescrip'] : "";
$Descripcion = (isset($_POST['Descripcion'])) ? $_POST['Descripcion'] : "-";
$Fecha = (isset($_POST['Fecha'])) ? $_POST['Fecha'] : "-";
$Precio = (isset($_POST['Precio'])) ? $_POST['Precio'] : "-";
$Emprendedor = (isset($_POST['Emprendedor'])) ? $_POST['Emprendedor'] : "-";
$Institucion = (isset($_POST['Institucion'])) ? $_POST['Institucion'] : "-";
$Foto = (isset($_POST['Foto'])) ? $_POST['Foto'] : "-";
$Sede = (isset($_POST['Sede'])) ? $_POST['Sede'] : "-";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

$mostrarModal = false;

switch ($accion) {

  case "btnEliminar":

    $consultaP = "UPDATE publicacion set ActivoPubli = '2' WHERE idPublicacion = '$idPubli'";
    $consultaPubli = "SELECT * from publicacion Where idPublicacion = '$idPubli' ";
    $resultaPubli = mysqli_query($conexion, $consultaPubli);
    $filasPubli = mysqli_fetch_array($resultaPubli);
    $filasUserId =  $filasPubli['Usuario_idUsuario'];

    if (mysqli_query($conexion, $consultaP)) {
      header("Location:InstanciaChatAdmin.php?idUser=$filasUserId&idPubli=$idPubli");
    }

    break;

  case "btnActualiza":

    $consultaP = "UPDATE publicacion set ActivoPubli = '1' WHERE idPublicacion = '$idPubli'";
    if (mysqli_query($conexion, $consultaP)) {

      header('Location: Administrador.php?Activo=1');
    }
    break;

  case "btnCancelar":
    header('Location: Administrador.php');
    break;
  case "Selec":
    $sqlConsul = "SELECT * from publicacion WHERE idPublicacion = '$idPubli'";
    $resultadoSql = mysqli_query($conexion, $sqlConsul);
    $columnaSql = mysqli_fetch_array($resultadoSql);

    $titulo = $columnaSql['Titulo'];
    header("Location: Administrador.php?Buscar=$titulo");
    break;
  case "s2":
    $consultaP = "UPDATE publicacion set ActivoPubli = '3' WHERE idPublicacion = '$idPubli'";

    $consultaPubli = "SELECT * from publicacion Where idPublicacion = '$idPubli' ";
    $resultaPubli = mysqli_query($conexion, $consultaPubli);
    $filasPubli = mysqli_fetch_array($resultaPubli);
    $filasUserId =  $filasPubli['Usuario_idUsuario'];

    if (mysqli_query($conexion, $consultaP)) {
      header("Location:InstanciaChatAdmin.php?idUser=$filasUserId&idPubli=$idPubli");
    }

    break;
  case "Seleccionar":

    $mostrarModal = true;

    $sqlConsul = "SELECT * from publicacion WHERE idPublicacion = '$idPubli'";
    $resultadoSql = mysqli_query($conexion, $sqlConsul);
    $columnaSql = mysqli_fetch_array($resultadoSql);

    $sqlConsulCorres = "SELECT  COUNT(*)  idCorres from chats_correspon WHERE idEmprendi = '$idPubli'";
    $resultadoSqlCorres = mysqli_query($conexion, $sqlConsulCorres);
    $columnaSqlCorres = mysqli_fetch_array($resultadoSqlCorres);

    $totalInterac = $columnaSqlCorres['idCorres'];

    $consultaInstitu = "SELECT * from institucion WHERE idInstitucion = '" . $columnaSql['Institucion_idInstitucion'] . "'";
    $resultadorInstitu = mysqli_query($conexion, $consultaInstitu);
    $columnaInstitu = mysqli_fetch_array($resultadorInstitu);

    $consulta5 = "SELECT * from usuario WHERE idUsuario = ' $columnaSql[Usuario_idUsuario]'";
    $resultado5 =  mysqli_query($conexion, $consulta5);
    $columna5 = mysqli_fetch_array($resultado5);

    $consulta6 = "SELECT * from correo_electronico WHERE Usuario_idUsuario = ' $columnaSql[Usuario_idUsuario]'";
    $resultado6 =  mysqli_query($conexion, $consulta6);
    $columna6 = mysqli_fetch_array($resultado6);

    $idPubli = $columnaSql['idPublicacion'];
    $Foto = base64_encode($columnaSql['Foto_publicacion']);
    $titulo = $columnaSql['Titulo'];
    $Categoria = $columnaSql['Categoria'];
    $BreveDescrip = $columnaSql['Breve_Descripcion'];
    $Descripcion = $columnaSql['Descripcion'];
    $Fecha = $columnaSql['Fecha'];
    $Precio = $columnaSql['Precio'];
    $Emprendedor = $columna5['Nombre'];
    $ApellidoPEmprende = $columna5['Apellido_Paterno'];
    $ApellidoMEmprende = $columna5['Apellido_Materno'];
    $Correo = $columna6['Direccion_correo'];
    $Institucion = $columnaInstitu['Nombre_Institucion'];
    $Sede = $columnaInstitu['Sede'];
}
$sqlUsuario = "SELECT * FROM usuario WHERE idUsuario = '$_SESSION[idUsuarioAdmin]'";
$resultadoUsuario = mysqli_query($conexion, $sqlUsuario);
$filasUsuario  =  mysqli_fetch_array($resultadoUsuario);

$sqlMensajes = "SELECT COUNT(*) Estado from chat Where Recibe_Usuarioid = '$_SESSION[idUsuarioAdmin]' AND Estado = '1'";
$resultaMensa = mysqli_query($conexion, $sqlMensajes);
$filamensa = mysqli_fetch_array($resultaMensa);

$Totalmensajes = $filamensa['Estado'];

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
  <title>Gestionar emprendimientos | Administrador</title>

</head>
<script>
  function ConfirmarDeleteUser() {
    var respuesta = confirm("¿Estas seguro que deseas SUSPENDER este emprendimiento?, recuerda que DEBES ENVIAR LA JUSTIFICACION al hacer click en aceptar.");
    if (respuesta == true) {
      return true;
    } else {
      return false;
    }
  }

  function ConfirmarActivo() {
    var respuesta = confirm("¿Estás seguro que quieres ACTIVAR nuevamente este emprendimiento?");
    if (respuesta == true) {
      return true;

    } else {
      return false;
    }
  }

  function ConfirmarEliminar() {
    var respuesta = confirm("¿Estás seguro que quieres ELIMINAR este emprendimiento?");
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
      <img src="../img/fondo7.jpg" class="w-100" id="imgCentral" alt="" />

    </div>
  </section>

  <!--FILTRO DE BUSQUEDA-->
  <section class="contenederEmprendis"><br>
    <div class="container-fluid">
      <div class="container">
        <div class="person2">
          <a href="MenuAdministrador.php"> <i class="bi bi-arrow-left-circle"></i> </a>
        </div>
      </div>
      <h1 class="tituloEmprendi w3-center w3-animate-top"><i class="bi bi-shop-window" id="iconoMorado"></i> GESTIONAR EMPRENDIMIENTOS
        <hr>
      </h1>

      <div id="TextoCentro"><br>
        <p id="textoCenter3">Bienvenido a "Gestión de emprendimientos", aqui podrás <b id="LinksEstas">consultar</b> los datos de las emprendimientos y también <b id="LinksEstas">suspenderlos</b> de Stu-Ventures</p>
        <div class="container">
          <form action="Administrador.php" method="GET">
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
                      En "gestionar emprendimientos" podrás <b id="LinksEstas">ver</b>, <b id="LinksEstas">suspender temporalmente un emprendimiento, activarlo </b> y <b id="LinksEstas">eliminarlo</b>.
                      Podrás ver la información del emprendimiento, quién es el emprendedor, estado, visitas, valoraciones, entre otros.
                    </div>
                  </div>
                  <div class="conte">
                    <div class="col-md-12" id="IconoAdm8">
                      <i class="bi bi-unlock"></i>
                    </div>
                    <div class="col-md-12">
                      Este icono te indicará que el emprendimiento se encuentra <b id="LinksEstas">activo</b> y que <b id="LinksEstas">puedes suspenderlo</b> al hacer "clic" en dicho boton.
                    </div>
                  </div>
                  <div class="conte">
                    <div class="col-md-12" id="IconoAdm9">
                      <i class="bi bi-lock"></i>
                    </div>
                    <div class="col-md-12">
                      Esto icono te indicará que el emprendimiento se encuentra <b id="LinksEstas">inactivo</b> y que <b id="LinksEstas">podrás volver a activarlo</b> al hacer "clic" en dicho boton.
                    </div>
                  </div>
                  <div class="conte">
                    <div class="col-md-12" id="IconoAdm10">
                      <i class="bi bi-trash"></i>
                    </div>
                    <div class="col-md-12">
                      Este icono te indica que al hacer "clic" en dicho boton, podrás <b id="LinksEstas">eliminar</b> el emprendimiento.
                    </div>
                  </div>
                  <div class="conte">
                    <div class="col-md-12" id="IconoAdm15">
                      <i class="bi bi-stop-circle"></i>
                    </div>
                    <div class="col-md-12">
                      Por último, este icono te indica que al hacer "clic" en dicho boton, podrás ver los <b id="LinksEstas">emprendimientos inactivos</b> de los emprendedores.
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
          <div class="fondoWhite2  ">
            <div class="d-flex justify-content-end" id="FiltroAdmEm">
              <form action="Administrador.php" method="GET">
                <button type="submit" name="Activo" value="1" class="Activos"> <i class="bi bi-unlock"></i>Activos</button>
                <button type="submit" name="Activo" value="2" class="Supendidos"> <i class="bi bi-lock"></i> Suspendidos</button>
                <button type="submit" name="Activo" value="0" class="Inactivos"> <i class="bi bi-stop-circle"></i> Inactivos</button>
                <button type="submit" name="Activo" value="3" class="Eliminado"> <i class="bi bi-trash"></i> Eliminados</button>
              </form>
            </div>
            <?php
            include '../bd/ReadPubli.php';
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

            ?>
              <div class="card tarjeta2" style="max-width: 100%; height:auto;" id="cardTop2">
                <div class="row g-0">
                  <div class="col-md-4" id="imagenTop2">
                    <img src="data:image/jpg;base64, <?php echo base64_encode($columnasPublic["Foto_publicacion"]); ?>" class="img-fluid rounded-start" alt="..." max-hei>
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
                      ?>
                      <b class="d-flex justify-content-center align-items-center" id="valoracion"><?php echo $trellas ?> <span class="EstrellaBl "><?php echo $trellasWhite ?>
                        </span><span class="CantiPerso"> (<?php echo  $totalCantiValora ?>)</span>
                      </b>
                      <?php
                      $sqlIntituSede = "SELECT * from institucion WHERE idInstitucion = '$columnasPublic[Institucion_idInstitucion]'";
                      $resulSqlI = mysqli_query($conexion, $sqlIntituSede);
                      $FilaInstituSede = mysqli_fetch_array($resulSqlI);
                      ?>
                      <?php
                      $consultaUserPublic = "SELECT * from usuario WHERE idUsuario = '" . $columnasPublic['Usuario_idUsuario'] . "'";
                      $resultadorUserPublic = mysqli_query($conexion, $consultaUserPublic);
                      $consultaUserCorreo = "SELECT * from correo_electronico WHERE Usuario_idUsuario = '" . $columnasPublic['Usuario_idUsuario'] . "'";
                      $resultadorUserCorreo = mysqli_query($conexion, $consultaUserCorreo);

                      while ($columnasUsersPublic = mysqli_fetch_array($resultadorUserPublic)) {

                      ?>
                        <?php if ($columnasPublic['ActivoPubli'] == 1) { ?>
                          <p class="card-text Activo "><b>EMPRENDIMIENTO ACTIVO </b>
                          <?php } elseif ($columnasPublic['ActivoPubli'] == 2) { ?>
                          <p class="card-text colomorado1"><b>EMPRENDIMIENTO SUSPENDIDO </b>
                          <?php } elseif ($columnasPublic['ActivoPubli'] == 0) { ?>
                          <p class="card-text Inactivos1"><b>EMPRENDIMIENTO INACTIVO </b>
                          <?php } elseif ($columnasPublic['ActivoPubli'] == 3) { ?>
                          <p class="card-text rojo "><b>EMPRENDIMIENTO ELIMINADO </b>
                          <?php } ?>
                          <p class="card-text">Emprendedor: <?php echo $columnasUsersPublic['Nombre']; ?> <?php echo $columnasUsersPublic['Apellido_Paterno']; ?> <?php echo $columnasUsersPublic['Apellido_Materno']; ?>.</p>
                          <?php while ($columnasUsersCorreo =  mysqli_fetch_array($resultadorUserCorreo)) { ?>
                            <p class="card-text">E-mail: <?php echo $columnasUsersCorreo['Direccion_correo']; ?>.</p>
                          <?php } ?>

                          <p class="card-text">Institución: <?php echo ($FilaInstituSede["Nombre_Institucion"]); ?>, <?php echo ($FilaInstituSede["Sede"]); ?>.</p>
                          <small class="card-text">Fecha de publicación: <?php echo ($columnasPublic["Fecha"]); ?>.</small>

                          <div class="card-footer">
                            <small class="text-muted"> </small>
                          </div>

                          <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="idPubli" value="<?php echo $columnasPublic['idPublicacion'] ?>">
                            <input type="hidden" name="ActivoPubli" value="<?php echo $columnasPublic['ActivoPubli'] ?>">
                            <input type="hidden" name="Valoracion" value="<?php echo ($columnasPublic["Valoracion"]); ?>">
                            <input type="hidden" name="Visitas" value="<?php echo ($columnasPublic["Visitas"]); ?>">
                            <input type="hidden" name="TotalValora" value="<?php echo $totalCantiValora; ?>">
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

                            <p class="card-text"><b> ACCIONES:</b> </p>

                            <div class="d-flex justify-content-center">
                              <?php if ($columnasPublic['ActivoPubli'] == 1) { ?>
                                <?php if ($Buscar == "%%") { ?>
                                  <button type="submit" class="VerDatos" name="accion" value="Selec" title="VER emprendimiento"><i class="bi bi-cursor" id="accionesIco"></i></button>
                                <?php } else { ?>
                                  <button type="submit" class="VerDatos" name="accion" value="Seleccionar" title="VER emprendimiento"><i class="bi bi-eye" id="accionesIco"></i></button>
                                <?php } ?>
                                <button value="btnEliminar" type="submit" class="SeleccionarUnlock" name="accion" onclick=" return ConfirmarDeleteUser()" title="SUSPENDER emprendimiento"><i class="bi bi-unlock" id="accionesIco"></i></button>
                              <?php } ?>
                              <?php if ($columnasPublic['ActivoPubli'] == 2) { ?>
                                <?php if ($Buscar == "%%") { ?>
                                  <button type="submit" class="VerDatos" name="accion" value="Selec" title="VER emprendimiento"><i class="bi bi-cursor" id="accionesIco"></i></button>
                                <?php } else { ?>
                                  <button type="submit" class="VerDatos" name="accion" value="Seleccionar" title="VER emprendimiento"><i class="bi bi-eye" id="accionesIco"></i></button>
                                <?php } ?>
                                <button type="submit" class="EliminarS" name="accion" value="btnActualiza" title="Habilitar Emprendimiento" onclick=" return ConfirmarActivo()"><i class="bi bi-lock" id="accionesIco"></i></button>
                                <button type="submit" class="s2 " name="accion" value="s2" title="Eliminar Emprendimiento" onclick=" return ConfirmarEliminar()"><i class="bi bi-trash" id="accionesIco"></i></button>
                              <?php } ?>
                              <?php if ($columnasPublic['ActivoPubli'] == 0) { ?>
                                <?php if ($Buscar == "%%") { ?>
                                  <button type="submit" class="VerDatos" name="accion" value="Selec" title="VER emprendimiento"><i class="bi bi-cursor" id="accionesIco"></i></button>
                                <?php } else { ?>
                                  <button type="submit" class="VerDatos" name="accion" value="Seleccionar" title="VER emprendimiento"><i class="bi bi-eye" id="accionesIco"></i></button>
                                <?php } ?>
                                <button type="submit" class="s2 " name="accion" value="s2" title="Eliminar Emprendimiento" onclick=" return ConfirmarEliminar()"><i class="bi bi-trash" id="accionesIco"></i></button>
                              <?php } ?>
                              <?php if ($columnasPublic['ActivoPubli'] == 3) { ?>
                                  <button type="submit" class="VerDatos" name="accion" value="Seleccionar" title="VER emprendimiento"><i class="bi bi-eye" id="accionesIco"></i></button>
                              <?php }  ?>
                            <?php } ?>

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
                <h1 class="colorTurquesaCentro">LAMENTABLEMENTE NO SE HA ENCONTRADO UN EMPRENDIMIENTO ;(</h1>
              </div>
            <?php } ?>
          </div>
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

      <form action="" method="post" class="row g-3 needs-validation" novalidate enctype="multipart/form-data">
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content" id="modal1">
              <div class="modal-header">
                <div class="px-4 pt-0 pb-4 cover bg-light" id="imgModal">
                  <div class="media align-items-end profile-head ">

                  </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div><br>
              <div class="modal-body">
                <div class="row g-3">
                  <div class="bg-light text-center">
                    <div class="row g-0">
                      <div class="col-md-4 d-flex justify-content-center align-items-center">
                        <div class="FondoPerson">
                          <div class="person">
                            <i class="fa-regular fa-user-tie"></i>
                          </div>
                        </div><br>
                      </div>
                      <div class="col-md-8 ">
                        <div class="card-body">
                          <h5 class="card-title titulo5">Emprendedor
                            <hr>
                          </h5>
                          <p class="font-weight "><?php echo $Emprendedor; ?> <?php echo $ApellidoPEmprende; ?> <?php echo $ApellidoMEmprende; ?> </p>
                          <p class="font-weight"> <?php echo $Correo; ?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <input type="hidden" class="form-control" value="<?php echo $idPubli; ?>" name="idPubli" id="idPubli">
                  <?php if ($accion = "Seleccionar") { ?>
                    <div class="px-4 pt-0 pb-4 cover bg-light" id="imgModal">
                      <div class="media align-items-end profile-head">
                        <div class="d-flex justify-content-center profile mr-3" id="FotoRedonda">
                          <img src="data:image/jpg;base64, <?php echo $Foto ?>" alt="..." width="330" class="img">
                        </div>
                      </div>
                    </div>


                    <div class="px-4 py-3 bg-light">
                      <div class="p-4 textoCentra" id="informa">
                        <div class="d-flex justify-content-start">
                          <h5 class="card-title titulo5">INFORMACIÓN
                            <hr>
                          </h5>
                        </div>


                        <div class="bg-light d-flex justify-content-end text-center">
                          <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                              <h5 class="font-weight-bold mb-0 d-block"><?php echo $Valoracion; ?></h5>
                              <small class="text-muted"> <b id="rigth">Puntuación emprendimiento</b></small>
                            </li>
                            <li class="list-inline-item">
                              <h5 class="font-weight-bold mb-0 d-block"><?php echo $TotalValora; ?></h5>
                              <small class="text-muted"> <b id="rigth">Valoraciones</b> </small>
                            </li>
                            <li class="list-inline-item">
                              <h5 class="font-weight-bold mb-0 d-block"><?php echo $Visitas; ?></h5>
                              <small class="text-muted"> <b id="rigth">Visitas</b> </small>
                            </li>
                            <li class="list-inline-item">
                              <h5 class="font-weight-bold mb-0 d-block"><?php echo $totalInterac; ?></h5>
                              <small class="text-muted"> <b id="rigth">Interacciones</b> </small>
                            </li>
                          </ul>
                        </div><br>
                        <?php if ($ActivoPubli == 1) { ?>
                          <p class="font-italic "><b>EMPRENDIMIENTO: ACTIVO </b></p>
                        <?php } elseif ($ActivoPubli == 2) { ?>
                          <p class="font-italic text-danger "><b>EMPRENDIMIENTO SUSPENDIDO </b></p>
                        <?php } elseif ($ActivoPubli == 0) { ?>
                          <p class="card-text colomorado1 "><b>EMPRENDIMIENTO INACTIVO </b>
                          <?php } ?>
                          <p class="font-italic mb-0">Titulo: <?php echo $titulo; ?></p>
                          <p class="font-italic mb-0">Categoría: <?php echo $Categoria; ?></p>
                          <p class="font-italic mb-0">Descripción Breve: <?php echo $BreveDescrip; ?></p>
                          <p class="font-italic mb-0">Descripción: <?php echo $Descripcion; ?></p>
                          <p class="font-italic mb-0">Fecha de publicación: <?php echo $Fecha; ?></p>
                          <p class="font-italic mb-0">Precio: <?php echo $Precio; ?></p>
                          <p class="font-italic mb-0">Institución: <?php echo $Institucion; ?></p>
                          <p class="font-italic mb-0">Sede: <?php echo $Sede; ?></p>

                      </div>
                    </div>
                  <?php } ?>
                  <?php if ($accion != "Seleccionar") { ?>
                    <div class="form-group col-md-12">

                      <img name="Foto" width="100%" height="200px" alt="" src="data:image/jpg;base64, <?php echo $Foto ?>"><br>
                      <div class="d-flex justify-content-center">
                        <b class="ValoraGrande" id="valoracion"><?php echo $trellas ?><span class="EstrellaBl "><?php echo $trellasWhite ?></b>
                      </div>
                    </div>

                    <div class="form-group col-md-12">
                      <label for="Titulo">Emprendedor:</label>
                      <input type="text" class="form-control" value="<?php echo $Emprendedor; ?> <?php echo $ApellidoPEmprende; ?> <?php echo $ApellidoMEmprende; ?>" name="Emprendedor" id="Emprendedor" disabled>
                    </div>

                    <div class="form-group col-md-12">
                      <label for="Correo">Correo:</label>
                      <input type="mail" class="form-control" value="<?php echo $Correo; ?>" name="Correo" id="Correo" disabled>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="Titulo">Emprendimiento:</label>
                      <input type="text" class="form-control" value="<?php echo $titulo; ?>" name="Titulo" id="Titulo" disabled>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="Categoria">Categoría:</label>
                      <input type="text" class="form-control" value="<?php echo $Categoria; ?>" name="Categoria" id="Categoria" disabled>

                    </div>

                    <div class="form-group col-md-6">
                      <label for="Punta">Puntuación de valoración:</label>
                      <input type="text" class="form-control" value="<?php echo $Valoracion; ?>" name="Valoracion" id="Valoracion" required disabled>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="Cantid">Valoraciones:</label>
                      <input type="text" class="form-control" value="<?php echo $TotalValora; ?>" name="TotalValora" id="TotalValora" required disabled>
                    </div>

                    <div class="form-group col-md-12">
                      <label for="BreveDescrip">Descripción Breve:</label>
                      <textarea name="BreveDescrip" class="form-control" id="BreveDescrip" style="min-height: 100px;" disabled><?php echo $BreveDescrip; ?></textarea>
                    </div>

                    <div class="form-group col-md-12" id="DescripcionDiv">
                      <label for="Descripcion">Descripcion:</label>
                      <textarea name="Descripcion" id="Descripcion" style="  min-height: 200px;" class="form-control" required disabled><?php echo $Descripcion; ?></textarea>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="Fecha">Fecha de publicación:</label>
                      <input type="text" class="form-control" value="<?php echo $Fecha; ?>" name="Fecha" id="Fecha" disabled>

                    </div>

                    <div class="form-group col-md-6">
                      <label for="Precio">Precio:</label>
                      <input type="text" class="form-control" value="<?php echo $Precio; ?>" name="Precio" id="Precio" required disabled>

                    </div>

                    <div class="form-group col-md-6">
                      <label for="Institucion">Institución:</label>
                      <input type="text" class="form-control" value="<?php echo $Institucion; ?>" name="Institucion" id="Institucion" disabled>

                    </div>

                    <div class="form-group col-md-6">
                      <label for="Sede">Sede:</label>
                      <input type="text" class="form-control" value="<?php echo $Sede; ?>" name="Sede" id="Sede" disabled>

                    </div>
                  <?php } ?>

                </div>
              </div>
              <div class="modal-footer">
                <a href="GestionarUsers.php?Buscar=<?php echo $Correo ?>">Ver emprendedor</a>
                <button type="button" class="VerDatos" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
              </div>
            </div>
          </div>
        </div>
      </form>

      <?php if ($mostrarModal) { ?>
        <script>
          $(window).on('load', function() {
            $("#exampleModal").modal('show');
          });
        </script>
      <?php } ?>
    </div> <br><br>

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