<?php include_once('validation.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('head.php'); ?>
    <title>Catalogo</title>
</head>

<body id="bg-landing" class="container-fluid px-0">
    <div class="container-fluid bg-opacity min-vh-100 w-100">
        <header>
            <?php include_once('nav.php'); ?>
        </header>
        <div class="row" style="min-height: 8.2vh !important;"></div>
        <main class="row px-5">
            <div class="align-items-start bg-light min-vh-100 pt-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php" class="mg-color-1">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Catalogo</li>
                    </ol>
                </nav>
                <div class=" tab-content min-vh-50" id="pills-tabContentCatalogo">
                    <div class="tab-pane fade show active" id="tab-catalogo" role="tabpanel" aria-labelledby="InventarioFinalTab">
                        <div class="d-flex justify-content-between my-2">
                            <span class="display-6" style="font-size: xx-large !important;">
                                <strong>Catalogo De Productos</strong>
                            </span>
                            <?php
                            include_once('../Backend/class/class-conexion.php');
                            include_once('../Backend/class/class-login.php');
                            $db = new Conexion();$cnn = $db->getConexion();
                            $p = intval(Login::obtenerPermiso($cnn,'catalogo'));
                            echo 
                            Login::verf_perm("e",$p)||Login::verf_perm("g",$p)||Login::verf_perm("adm",$p)?
                            '<a title="Agregar Producto" href="#" class="btn btn-outline-success"
                            onclick="mostrarTab(\'tab-ingresar\',\'tab-catalogo\')">
                            <i class="zmdi zmdi-plus"></i>
                            </a>':
                            '';
                            ?>
                        </div>
                        <hr>
                        <div class="col-12 bg-light pt-3">
                            <div class="row row-cols-1 row-cols-sm-2 row row-cols-md-3 row-cols-lg-4 g-4" id="cardsCatalogo">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-ingresar" role="tabpanel" aria-labelledby="ingresarInventarioFinalTab">
                        <div class="d-flex justify-content-between my-2">
                            <span class="display-6" style="font-size: xx-large !important;">
                                <strong>Catalogo De Productos</strong>
                            </span>
                            <a title="Volver a registros" href="#" onclick="mostrarTab('tab-catalogo','tab-ingresar')" class="btn btn-outline-secondary">
                                <i class="zmdi zmdi-arrow-left"></i></a>
                        </div>
                        <hr>
                        <form id="formCatalogo" class="row g-3" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="idCatalogo">
                            <div class="col-12">
                                <label for="fotoCatalogo" class="form-label">Fotografia</label>
                                <input class="form-control" type="file" name="foto[]" id="fotoCatalogo" multiple>
                            </div>
                            <div class="col-6">
                                <label for="nombreProducto" class="form-label ">Nombre Producto</label>
                                <input type="text" name="nombreProducto" class="form-control readonly" id="nombreProducto">
                            </div>
                            <div class="col-6">
                                <label for="precio" class="form-label ">Precio</label>
                                <input type="number" name="precio" class="form-control readonly" id="precio">
                            </div>
                            <div class="col-12">
                                <label for="descripcionProducto" class="form-label ">Descripcion Producto</label>
                                <textarea class="form-control" name="descripcionProducto" id="descripcioProducto" cols="30" rows="4"></textarea>
                            </div>
                            <div class="mt-2">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Excento de ISV?
                                    </label>
                                    <input class="form-check-input" name="exentoImpuesto" type="checkbox" value="1" id="exentoImpuesto">
                            </div>
                            <div class="row justify-content-center my-3">
                                <div class="col-4">
                                    <a class="btn btn-outline-warning" onclick="agregarProductoCatalogo(this)" style="display: block !important;">Guardar</a>
                                    <a class="btn btn-outline-success" onclick="confirmarModificarCatalogo(this)" style="display: none;">Modificar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <footer>
        <script src="js/controladores/CRUD.js"></script>
        <script src="js/controladores/catalogo.js"></script>
        <script>refrescarCardCatalogo(
            'Catalogo',
            <?php
                include_once('../Backend/class/class-conexion.php');
                include_once('../Backend/class/class-login.php');
                $db = new Conexion();
                $cnn = $db->getConexion();
                $p = Login::obtenerPermiso($cnn,'catalogo');
                echo Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)?$p:-1;
            ?>)</script>
    </footer>
    <?php include_once('canvas.php'); ?>
</body>

</html>