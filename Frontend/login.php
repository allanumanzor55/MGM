<!DOCTYPE html>
<html lang="es">

<head>
    <?php include_once('head.php'); ?>
    <link rel="stylesheet" href="css/login-styles.css">
    <title>Login</title>
</head>

<body>
    <style>
        input.form-control {
            background-color: transparent;
            border-top: 0;
            border-left: 0;
            border-right: 0;
            border-color: gray;
        }

        .form-control:focus {
            background-color: transparent;
            border-top: 0;
            border-left: 0;
            border-right: 0;
            border-color: tomato;
            color: black !important;
            box-shadow: none;
        }

        div.form-floating label {
            color: gray !important;
        }

        .btn-outline-warning {
            font-size: large !important;
            color: tomato !important;
            border-color: tomato !important;
        }

        .btn-outline-warning:hover {
            color: white !important;
            background-color: tomato !important;
        }
    </style>
    <div id="gradient" class="container-fluid min-vh-100">
        <div class="container-fluid m-0 p-0">
            <div class="row">
                <div class="col-6 min-vh-100" id="back">
                    <img src="img/logo-3.png" alt="" class="img-fluid p-5">
                </div>
                <!--#10243D-->
                <div class="col-6 min-vh-100" style="background-color: #fff;">
                    <div class="row align-items-center justify-content-center min-vh-100 m-0 p-0">
                        <div class="row justify-content-center">
                            <div class="row">
                                <p class="h5 text-center" style="color:tomato;">
                                    <span class="display-2">Bienvenido!</span>
                                    <br>
                                    <small class="text-muted">Ingresa tu usuario y contraseña</small>
                                </p>
                            </div>
                            <form id="formLogin" class="mt-5 px-5">
                                <div class="form-floating mb-3 mx-5">
                                    <input name="usuario" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
                                    <label for="flotingInput"> Usuario</label>
                                </div>
                                <div class="form-floating mx-5">
                                    <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                                    <label for="floatingPassword"> Contraseña</label>
                                </div>
                            </form>
                            <div class="d-grid gap-2 col-3 mt-3">
                                <a class="btn btn-outline-warning rounded-mg" type="button" style="color: white;" onclick="login(this)">Iniciar Sesión</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>