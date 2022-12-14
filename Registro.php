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
    <link rel="stylesheet" href="css/estilos.css">
    <script src="js/funciones.js"></script>
    <script src="js/validarRut.js"></script>
    <title>Registro de usuario</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 " id="inicio4">
                <img src="img/esturegistro.jpeg" alt="" class="img-fluid">
            </div>
            <div class="col-lg-7 col-md-12 col-sm-12" id="inicio2">

                <div class="header-top1"></div>
                <div class="d-flex justify-content-start">
                    <div class="person2">
                        <a href="Index.html"> <i class="bi bi-arrow-left-circle"></i> </a>
                    </div>
                </div>
                <img src="img/stu-ventures2.png" alt="">
                <h1 class="tituloRegistro w3-center w3-animate-top"><i class="bi bi-person-plus" id="iconoMorado"></i>
                    REGISTRO
                    <hr>
                </h1>

                <form action="bd/insertarUser.php" class="row g-3 needs-validation " id="formRegistro" novalidate>
                    <p class="textoCentra">Mediante tu registro, podr??s acceder a Stu-Ventures sin que se soliciten
                        nuevamente tus datos para poder navegar y interactuar.</p>

                    <p class="text-danger small textoCentra">*Completa los datos solicitados seg??n el tipo de usuario que
                        ser??s y ??se parte de Stu-Ventures!</p>
                    <div class="col-md-12 ">
                        <label for="validationCustom01" class="d-flex justify-content-start textoCentra">Que usuario deseas
                            ser:</label>
                        <div class="form-check">
                            <input type="radio" class="form-check-input d-flex justify-content-start" name="TipoUsuario" value="1" id="navega" required onclick="determinanteUsuario()">
                            <label class="form-check-label d-flex justify-content-start" for="validationFormCheck2">Navegar
                                por el sitio.</label>
                        </div>
                        <div class="form-check mb-3">
                            <input type="radio" class="form-check-input" name="TipoUsuario" value="2" id="emprendedor" required onclick="determinanteEmprendedor()">
                            <label class="form-check-label d-flex justify-content-start" for="validationFormCheck3">Publicar
                                mi
                                emprendimiento.</label>

                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="registro">


                        <div class="col-md-12">
                            <input type="numeric" name="rut" value="" id="rut" oninput="checkRut(this)" class="form-control" placeholder="Rut" required>
                            <div class="valid-feedback">

                            </div>
                            <div class="invalid-feedback">
                                Debes ingresar un rut valido.
                            </div>
                        </div>
                        <div class="col-md-12">
                            <i class="d-flex justify-content-start"><b>(Fecha de nacimiento)</b></i>
                            <input type="date" name="Fechanacimiento" value="" id="Fechanacimiento" placeholder="Fecha de nacimiento" class="form-control" min="1930-01-01" max="2004-12-31" required>
                        </div>
                        <div class="col-md-12">
                            <input type="text" name="nombre" value="" id="nombre" class="form-control" placeholder="Nombre" required>
                        </div>
                        <div class="col-md-12">
                            <input type="text" name="ApellidoPaterno" value="" id="ApellidoPaterno" class="form-control" placeholder="Apellido Paterno" required>

                        </div>
                        <div class="col-md-12">
                            <input type="text" name="ApellidoMaterno" value="" id="ApellidoMaterno" class="form-control" placeholder="Apellido Materno" required>
                        </div>
                        <div class="col-md-12">
                            <input type="text" name="Direccion" value="" id="Direcci??n" class="form-control" placeholder="Direcci??n" required>
                        </div>
                        <div class="col-md-12">
                            <input type="text" name="Comuna" value="" id="Comuna" class="form-control" placeholder="Comuna" required>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="registro">

                        <div class="col-md-12">
                            <input type="numeric" name="Telefono" value="" id="Telefono" pattern="[0-9]{9}" class="form-control" placeholder="N??mero de contacto" required title="Ingrese su n??mero de contacto con el 9">
                        </div>
                        <div class="col-md-12">
                            <i class="d-flex justify-content-start"><b>(Opcional)</b></i>
                            <input type="text" name="Instagram" value="" id="Instagram" class="form-control" placeholder="Instagram">
                            <div class="invalid-feedback">

                            </div>
                        </div>
                        <div class="col-md-12">
                            <i class="d-flex justify-content-start"><b>(Opcional)</b></i>
                            <input type="text" name="Facebook" value="" id="Facebook" class="form-control" placeholder="Facebook">
                        </div>
                        <div class="col-md-12">
                            <input type="email" name="email" value="" id="email" pattern=".+@gmail\.com" class="form-control" placeholder="E-mail" required>
                            <div class="invalid-feedback">
                                Ej: Ejemplo@gmail.com.
                            </div>
                        </div>
                        <div class="col-md-12">
                            <input type="email" name="email" value="" id="emailInstitucional" class="form-control" pattern=".+@inacapmail\.cl" size="30" placeholder="E-mail Institucional" required>
                            <div class="invalid-feedback">
                                Debes ingresar tu Inacapmail.
                            </div>
                        </div>
                        <div class="col-md-12">
                            <input type="password" name="Contrasena" value="" id="Contrase??a" class="form-control" placeholder="Contrase??a" required>
                        </div>
                        <div class="col-md-12 d-flex justify-content-center align-items-center">
                            <button type="submit" class="btn btnRegistrarme">Registrarme</button>

                        </div>
                        <p class="TienesCuen">??Ya tienes una cuenta? Entonces ve a <a href="Login.php" target="_blank" class="link"> inicio
                                de sesi??n.</a></p>
                    </div>
                </form>

            </div>
        </div>
    </div>
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
</body>

</html>