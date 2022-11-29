<!DOCTYPE html>
<html lang="en">

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
    <link rel="stylesheet" href="css/estilos.css">
    <title>Inicio de sesión</title>
</head>

<body class="sinMarg">

    <div class="row" id="imagesIni">
        <div class="col-lg-8 col-md-8 col-sm-12" id="inicio1">
            <img src="img/estudiantes10.jpg" class="img-fluid" alt="">
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12" id="inicio2">
            <div class="header-top1"></div>
            <div class="contenido">
                <img src="img/stu-ventures2.png" alt="">
                <h1 class="tituloInicio w3-center w3-animate-top"><i class="bi bi-box-arrow-in-right" id="iconoMorado"></i> INICIO DE SESIÓN
                    <hr>
                </h1>
                <form action="validaciones/validar.php" method="POST" class="needs-validation " id="formInicio" novalidate><br>
                    <label>Ingresa los siguientes datos para poder iniciar sesión: </label><br><br>
                    <div class="mb-4">
                        <input type="email" name="correo" value="" class="form-control"  placeholder="E-mail" required>
                    </div>
                    <div class="mb-4">
                        <input type="password" name="contraseña" value="" class="form-control" placeholder="Contraseña" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn " id="btnEnviari">Iniciar </button>
                    </div>
                    <div class="linea"></div>
                    <div class="my-3 text-center ">
                        <span><a class="link" href="Correo.php"> ¿Olvidaste tu contraseña?
                            </a></span><br>
                        <span>¿No tienes una cuenta? <a class="link" href="Registro.php"> Haz clic aquí para ir a registrarte. </a></span><br>
                    </div>
                </form>
            </div>

        </div>
    </div>
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
</body>

</html>