<nav id ="navbar-lp" class=" resonsive navbar navbar-expand navbar-light bg-light py-0 fixed-top">
    <a class="navbar-brand mx-0" href="#">
        <img src="img/logo-3.png" alt="" width="45" height="40" class="d-inline-block align-text-top">
    </a>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a title="Inicio" class="nav-link btn-mg-1 zmdi zmdi-home zmdi-hc-lg" href="index.php"></a>
                </li>
                <div class="d-flex ">
                    <li class="nav-item">
                        <a title="Inventario" class="nav-link btn-mg-1 zmdi zmdi-store zmdi-hc-lg"
                            href="inventario.php"></a>
                    </li>
                    <li class="nav-item">
                        <a title="Inventario Final" class="nav-link btn-mg-1 zmdi zmdi-view-dashboard zmdi-hc-lg"
                            href="inventarioFinal.php"></a>
                    </li>
                    <li class="nav-item">
                        <a title="Ficha De Productos" class="nav-link btn-mg-1 zmdi zmdi-card zmdi-hc-lg"
                            href="fichaProductos.php"></a>
                    </li>
                    
                    <li class="nav-item">
                        <a title="Empleados" class="nav-link btn-mg-1 zmdi zmdi-male-alt zmdi-hc-lg"
                            href="empleados.php"></a>
                    </li>
                    <li class="nav-item">
                        <a title="Clientes" class="nav-link btn-mg-1 zmdi zmdi-accounts zmdi-hc-lg" href="clientes.php"></a>
                    </li>
                    <li class="nav-item">
                        <a title="Ventas" class="nav-link btn-mg-1 zmdi zmdi-local-shipping zmdi-hc-lg" href="ventas.php" tabindex="-1"
                            aria-disabled="true"></a>
                    </li>
                </div>
            </ul>
        </ul>
        <div class="d-flex" id="navbarTogglerDemo03">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a title="Perfil" class="nav-link btn-mg-1 zmdi zmdi-account-circle zmdi-hc-lg" data-bs-toggle="offcanvas"
                        href="#perfilCanvas" role="button" aria-controls="perfilCanvas"></a>
                </li>
                <li class="nav-item">
                    <a title="Configuraciones" href="#" class="nav-link btn-mg-1 zmdi zmdi-settings zmdi-hc-lg" 
                    onclick="accederConfiguraciones(this)"></a>
                </li>
            </ul>
        </div>
    </div>
</nav>