<?php include_once('validation.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('head.php'); ?>
    <title>Bodegas</title>
</head>

<body id="bg-landing" class="container-fluid px-0">
    <div class="container-fluid bg-opacity min-h-100 min-w-100">
        <header>
            <?php include_once('nav.php'); ?>
        </header>
        <div class="row" style="min-height: 8.1vh !important;"></div>
        <main class="row px-5">
            <div class="container vw-100 min-vh-100 bg-light pt-1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php" class="mg-color-1">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Bodegas</li>
                    </ol>
                </nav>
                <div class="table-responsive align-items-center bg-light min-vh-100 pt-2">
                    <div class="tab-content min-vh-50">
                        <div class="tab-pane show active" id="tabBodegas" role="tabpanel">
                            <div class="container-fluid">
                                <div class="d-flex justify-content-between">
                                    <span class="display-6" style="font-size: xx-large !important;">
                                        <strong>Bodegas</strong>
                                    </span>
                                    <?php
                                    include_once('../Backend/class/class-conexion.php');
                                    include_once('../Backend/class/class-login.php');
                                    $db = new Conexion();
                                    $cnn = $db->getConexion();
                                    $p = intval(Login::obtenerPermiso($cnn,'bodegas'));
                                    echo 
                                    Login::verf_perm("e",$p)||Login::verf_perm("g",$p)||Login::verf_perm("adm",$p)?
                                    '<a href="#" class="btn btn-outline-success"
                                    onclick="mostrarTab(\'tabIngresar\',\'tabBodegas\')">
                                    <i class="zmdi zmdi-plus"></i>
                                    </a>':
                                    '';
                                    ?>
                                </div>
                                <hr>
                                <div class="row gx-1" id="cardBodegas">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabIngresar" role="tabpanel">
                            <div class="container-fluid">
                                <div class="d-flex justify-content-between">
                                    <span class="display-6" style="font-size: xx-large !important;">
                                        <strong>Bodegas</strong>
                                    </span>
                                    <a href="#" class="btn btn-outline-secondary" onclick="mostrarTab('tabBodegas','tabIngresar')"><i class="zmdi zmdi-arrow-left"></i></a>
                                </div>
                                <hr>
                                <div class="row">
                                    <form id="formBodega">
                                    <input type="hidden" name="id" id="idBodega">
                                    <div class="col-12">
                                        <label for="descripcionBodega" class="form-label">Descripcion</label>
                                        <input type="text" class="form-control" name="descripcion" id="descripcionBodega">
                                    </div>
                                    <div class="col-12">
                                        <label for="ubicacionBodega" class="form-label">Ubicacion</label>
                                        <textarea name="ubicacion" id="ubicacionBodega" cols="30" rows="5" class="form-control"></textarea>
                                    </div>
                                    <div class="row justify-content-center my-3">
                                        <div class="col-5">
                                            <a class="btn btn-outline-warning btn-block" onclick="guardarBodega(this)" style="display: block !important">Guardar</a>
                                            <a class="btn btn-outline-success btn-block" onclick="confirmarModificarBodega(this)" style="display: none !important;">Modificar</a>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            <div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <footer>
        <script src="js/controladores/CRUD.js"></script>
        <script src="js/controladores/bodega.js"></script>
        <script>
            refrescarCardsBodega(
                <?php
                    include_once('../Backend/class/class-conexion.php');
                    include_once('../Backend/class/class-login.php');
                    $db = new Conexion();
                    $cnn = $db->getConexion();
                    $p = Login::obtenerPermiso($cnn,'bodegas');
                    echo Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)?$p:-1;
                ?>
            )
        </script>
    </footer>
    <?php include_once('canvas.php'); ?>
</body>

</html>