<?php include_once('validation.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once('head.php');?>
    <title>Mario Graphics</title>
</head>
<body id="bg-landing" class="container-fluid px-0">
    <div class="container-fluid  bg-opacity min-vh-100 min-mw-100 mx-0 px-0">
        <header class="row">
            <nav id="navbar-lp" class="navbar navbar-expand navbar-expand-sm navbar-expand-md navbar-expand-lg navbar-light bg-light py-0 fixed-top">
                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link btn-mg-1 fs-3 bi bi-list" data-bs-toggle="offcanvas" href="#offcanvasScrolling" role="button" aria-controls="offcanvasExample"></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link btn-mg-1 fs-4 bi bi-search mt-1"></a>
                        </li>
                    </ul>
                    <div class="d-flex" id="navbarTogglerDemo03">
                        <a class="navbar-brand navbar-mg-1 pt-2" href="#">MGraphics Memories</a>
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a href="login.php" class="nav-link btn-mg-1 fs-3 bi bi-people"></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main class="row align-items-center vh-100 wh-100 m-0">
            <div class="col-8 mx-4">
                <h1 id="logo-text-mg-1" class="display-1 text-white">MGraphics Memories</h1>
            </div>
            <div class="col-3 px-0 mx-0 ">
                <img src="img/Logo-2.png" alt="logo" class="img-fluid rounded">
            </div>
        </main>
    </div>
    <div class="container-fluid bg-light mx-0">
        <div class="row">
            <div class="col-2" style="background-color: rgb(225,225,225);">
                <div class="container-fluid px-0 mx-0 py-3">
                    <div class="row">
                        <form>
                            <div class="form-floating">
                                <input type="search" class="form-control" id="floatingSearch" placeholder="Buscar">
                                <label for="floatingSearch"><i class="bi bi-search"></i> Buscar</label>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="row">
                        <form>
                            <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
                                <div class="card-header">Categoria</div>
                                <div class="card-body">
                                    <div class="form-check">
                                        <input class="form-check-input radio-mg-1" type="radio" name="categorias" id="categoria1" checked>
                                        <label class="form-check-label" for="categoria1">
                                            Camisas
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input radio-mg-1" type="radio" name="categorias" id="categoria2">
                                        <label class="form-check-label" for="categoria2">
                                            Gorras
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input radio-mg-1" type="radio" name="categorias" id="categoria2">
                                        <label class="form-check-label" for="categoria3">
                                            Tazas
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input radio-mg-1" type="radio" name="categorias" id="categoria2">
                                        <label class="form-check-label" for="categoria4">
                                            Llaveros
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
                                <div class="card-header">Material</div>
                                <div class="card-body">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="materiales" id="material1">
                                        <label class="form-check-label" for="material1">
                                            Algodon
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="materiales" id="material2">
                                        <label class="form-check-label" for="material2">
                                            Seda
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="materiales" id="material2">
                                        <label class="form-check-label" for="material3">
                                            Lino
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="materiales" id="material2">
                                        <label class="form-check-label" for="material4">
                                            Policoton
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
                                <div class="card-header">Estilos</div>
                                <div class="card-body">
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-10 bg-light pt-3">
                <div class="row row-cols-1 row-cols-sm-2 row row-cols-md-3 row-cols-lg-4 g-4">
                    <div class="col">
                        <div class="card h-100">
                            <img src="img/camisa.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Producto</h5>
                                <p class="card-text">Descripcion</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="#" class="btn btn-mg-2 fs-4 bi bi-fullscreen"></a>
                                <a href="#" class="btn btn-mg-2 fs-4 bi bi-cart-plus"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <img src="img/camisa.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Producto</h5>
                                <p class="card-text">Descripcion</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="#" class="btn btn-mg-2 fs-4 bi bi-fullscreen"></a>
                                <a href="#" class="btn btn-mg-2 fs-4 bi bi-cart-plus"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <img src="img/camisa.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Producto</h5>
                                <p class="card-text">Descripcion</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="#" class="btn btn-mg-2 fs-4 bi bi-fullscreen"></a>
                                <a href="#" class="btn btn-mg-2 fs-4 bi bi-cart-plus"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <img src="img/camisa.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Producto</h5>
                                <p class="card-text">Descripcion</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="#" class="btn btn-mg-2 fs-4 bi bi-fullscreen"></a>
                                <a href="#" class="btn btn-mg-2 fs-4 bi bi-cart-plus"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <img src="img/camisa.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Producto</h5>
                                <p class="card-text">Descripcion</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="#" class="btn btn-mg-2 fs-4 bi bi-fullscreen"></a>
                                <a href="#" class="btn btn-mg-2 fs-4 bi bi-cart-plus"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <img src="img/camisa.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Producto</h5>
                                <p class="card-text">Descripcion</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="#" class="btn btn-mg-2 fs-4 bi bi-fullscreen"></a>
                                <a href="#" class="btn btn-mg-2 fs-4 bi bi-cart-plus"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <img src="img/camisa.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Producto</h5>
                                <p class="card-text">Descripcion</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="#" class="btn btn-mg-2 fs-4 bi bi-fullscreen"></a>
                                <a href="#" class="btn btn-mg-2 fs-4 bi bi-cart-plus"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once('canvas.php');?>
</body>
</html>