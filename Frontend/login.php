<!DOCTYPE html>
<html lang="es">
<head>
    <?php include_once('head.php');?>
    <link rel="stylesheet" href="css/login-styles.css">
    <title>Login</title>
</head>
<body id="bg-login">
    <div id="gradient" class="container-fluid min-vh-100 m-0 p-0">
        <div class="row align-items-center justify-content-center min-vh-100 m-0 p-0">
            <div class="col-9 col-sm-6 col-md-6 col-xl-3 col-xxl-3 bg-white rounded p-2" style="background:rgba(255,255,255,0.9) !important;">
                <div class="row justify-content-center">
                    <img src="img/logo-3.png" alt="" class="img-fluid">
                </div>
                <div class="row justify-content-center">
                    <form id="formLogin">
                        <div class="form-floating mb-3">
                            <input name="usuario"  type="text" class="form-control rounded-mg" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput"> Usuario</label>
                        </div>
                        <div class="form-floating">
                            <input name="password" type="password" class="form-control rounded-mg" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword"> Contraseña</label>
                        </div>
                    </form>
                </div>
                <div class="d-grid gap-2 col-6 mx-auto mt-3">
                    <a class="btn btn-primary-mg rounded-mg" type="button" style="color: white;" onclick="login(this)">Login</a>
                </div>
            </div>
        </div>
    </div>
    <footer>
        
    </footer>
</body>
</html>