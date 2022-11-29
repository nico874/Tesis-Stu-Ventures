<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="img/stu-ventures2.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="js/funciones.js"></script>
  <link rel="stylesheet" href="css/estilos.css">
  <title>Contacto</title>
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
          <a class="nav-item nav-link " href="TopEmprendimientos.php"><i class="bi bi-sort-up"></i>
            Top semanal</a>
          <a class="nav-item nav-link active1 " href="Contacto.php"><i class="bi bi-envelope-paper"></i> Contacto</a>
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
      <img src="img/usuarios.png" class="w-100" alt="" />
    </div>
  </section>


  <!--FORMULARIO DE CONTACTO-->
  <section class="contenedorContacto"><br><br>
    <div class="container">
      <h1 class="tituloInfo w3-center w3-animate-top"><i class="bi bi-envelope-paper" id="iconoMorado"></i> CONTACTO
        <hr>
      </h1>
      <div class="row w3-center ">
        <div class="col-sm-8 col-md-6 col-lg-3">

          <article class="box-contacts" id="Cr">
            <div class="box-contacts-body">
              <i class="bi bi-envelope-paper"></i>
              <p class="box-contacts-link">
                stuventurescontacto@gmail.com
              </p>
            </div>
          </article>

        </div>
        <div class="col-sm-8 col-md-6 col-lg-3">
          <a href="https://www.instagram.com/stu.ventures/" target="_blank">
            <article class="box-contacts" id="Ig">
              <div class="box-contacts-body">
                <i class="bi bi-instagram"></i>
                <p class="box-contacts-link">
                  @Stu-Ventures
                </p>
              </div>
            </article>
          </a>
        </div>

        <div class="col-sm-8 col-md-6 col-lg-3">
          <a href="https://www.facebook.com/profile.php?id=100085513805805" target="_blank">
            <article class="box-contacts" id="Fb">
              <div class="box-contacts-body">
                <i class="bi bi-facebook"></i>
                <p class="box-contacts-link">
                  Stu-Ventures
                </p>
              </div>
            </article>
          </a>
        </div>
        <div class="col-sm-8 col-md-6 col-lg-3">
          <a href="https://twitter.com/StuVentures" target="_blank">
            <article class="box-contacts" id="Tw">
              <div class="box-contacts-body">
                <i class="bi bi-twitter"></i>
                <p class="box-contacts-link">
                  @Stu-Ventures
                </p>
              </div>
            </article>
          </a>
        </div>
      </div>

      <form id="formContacto" class="needs-validation " novalidate>
        <p class="textoCentra">Nos complace el interés que tienes por <b id="LinksEstas">contactarte con nosotros</b>, por favor completa el siguiente formulario y te responderemos con gusto a la brevedad.</p>
        <hr class="hrcompleto">
        <div class="row">
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <p class="text-danger small ">*Todos los campos son obligatorios</p>
         
            <input type="text" name="nombre" value="" id="nombre" class="form-control" placeholder="Nombre" required>
            <input type="email" name="email" value="" id="email" class="form-control" placeholder="E-mail" required>
            <input type="text" name="asunto" value="" id="asunto" class="form-control" placeholder="Asunto" required>
            <textarea rows="3" class="form-control" name="mensaje" id="mensaje" placeholder="Mensaje" required></textarea><br>
            <div class="btnSend">
              <button type="submit" class="btnEnviar">Enviar</button>
            </div><br>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <p class="textoCentra">En caso de que no recibas una pronta respuesta contactanos a travéz de nuestras redes sociales o encuentranos en la siguiente dirección:</p>
            <b> Bravo de Saravia #1234</b></p>
            <div class="mapa">
              <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13322.683472489705!2d-70.681837!3d-33.40575!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9662c69cd9765137%3A0xea8f33587d4b65d5!2sBravo%20de%20Saravia%2C%20Renca%2C%20Regi%C3%B3n%20Metropolitana!5e0!3m2!1ses-419!2scl!4v1660084336965!5m2!1ses-419!2scl" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>
        </div>
      </form><br><br>
    </div>
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
        </p>
      </div>
    </div>
  </footer>
</body>

</html>