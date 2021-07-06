<nav id ="navbar-lp" class="navbar navbar-expand-lg navbar-light bg-light py-0 fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img src="img/logo-3.png" alt="" width="45" height="40" class="d-inline-block align-text-top"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <?php
                    include_once('../Backend/class/class-login.php');
                    $db = new Conexion();
                    $cnn = $db->getConexion();
                    $permisos = Login::obtenerPermisos($cnn);
                    Login::generarMenu($permisos);
                ?>
            </ul>
            <form class="d-flex">
                <ul class="navbar-nav me-auto" id="navbarPerfil">
                    <li class="nav-item">
                        <a title="Perfil" class="nav-link btn-mg-1 zmdi zmdi-account-circle zmdi-hc-2x" data-bs-toggle="offcanvas"
                        href="#perfilCanvas" role="button" aria-controls="perfilCanvas"></a>
                        <?php
                            include_once('../Backend/class/class-login.php');
                            $db = new Conexion();
                            $cnn = $db->getConexion();
                            $permisos = Login::obtenerPermisos($cnn);
                            echo Login::habilitarModulo(intval($permisos['configuracion']),
                            '<li class="nav-item"><a title="Configuraciones" href="#" class="nav-link btn-mg-1 zmdi zmdi-settings zmdi-hc-2x" onclick="accederConfiguraciones(this)"></a></li>');
                        ?>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</nav>
<!--?php
    

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Link
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
    </li>
?-->
