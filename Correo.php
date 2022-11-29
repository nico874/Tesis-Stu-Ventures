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
    <link rel="stylesheet" href="css/estilos.css">
    <title>Recuperar Contraseña</title>
</head>

<body>
    <div class="row" id="imagesIni">
        <div class="col-lg-8 col-md-8 col-sm-12" id="inicio1">
            <img src="img/estudiantes7.jpg" class="img-fluid" alt="">
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12" id="inicio2">
            <div class="header-top1"></div>
            <div class="d-flex justify-content-start">
                <div class="person2">
                    <a href="login.php"> <i class="bi bi-arrow-left-circle"></i> </a>
                </div>
            </div>
            <div class="contenido">
                <img src="img/stu-ventures2.png" alt="">
                <h1 class="tituloInicio w3-center w3-animate-top"><i class="bi bi-key" id="iconoMorado"></i> RECUPERAR CONTRASEÑA
                    <hr>
                </h1>
                <form action="validaciones/validar.php" method="POST" class="needs-validation " id="formInicio" novalidate><br>
                    <label>Ingresa tu correo electrónico E-MAIL registrado: </label><br><br>
                    <div class="mb-4">
                        <input type="mail" name="Correo" class="form-control" placeholder="E-mail" required>
                    </div>
                    <div class="">
                        <label class="form-check-label" for="validationFormCheck2"><b class="link">NOTA:</b> Se te enviará la contraseña a tu E-mail registrado.</label> 
                    </div><br>
                    <div class="d-grid">
                        <button type="submit" class="btn " id="btnEnviari">Enviar</button>
                    </div>
                    <div class="linea"></div><br>
                    <p>¿No puedes acceder a tu cuenta?<a class="link" href="Contacto.php"> Contáctanos</a>.</p>
                </form>
            </div>
        </div>
</body>
</html>