<?php include_once('validation.php');?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('head.php');?>
    <title>Inventario Final</title>
</head>

<body id="bg-landing" class="container-fluid px-0">
    <div class="container-fluid bg-opacity min-vh-100 w-100">
        <header>
            <?php include_once('nav.php'); ?>
        </header>
        <div class="row" style="min-height: 8.1vh !important;"></div>
        <main class="row px-5">
            <div class="align-items-start bg-light min-vh-100 pt-2">
                <ul class="nav nav-pills mb-3" id="pills-tabInventarioFinal" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link nav-link-mg-2 active" id="ingresarInventarioFinalTab" data-bs-toggle="pill" data-bs-target="#ingresarInventarioFinal" type="button" role="tab" aria-controls="ingresarInventarioFinal" aria-selected="true">Ingresar</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link nav-link-mg-2" id="inventarioFinalTab" data-bs-toggle="pill" data-bs-target="#inventarioFinalTabContent" type="button" role="tab" aria-controls="inventarioFinal" aria-selected="false" onclick="refrescarCardInventarioFinals('InventarioFinal','#inventarioFinalTabContent')"">Inventario</button>
                        </li>
                </ul>
                <div class=" tab-content min-vh-50" id="pills-tabContentInventarioFinal">
                    <div class="tab-pane fade show active" id="ingresarInventarioFinal" role="tabpanel" aria-labelledby="ingresarInventarioFinalTab">
                        <form id="formInventarioFinal" class="row g-3" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="idInventarioFinal">
                            
                            <div class="row justify-content-center my-3">
                                <div class="col-4">
                                    <a class="btn btn-outline-danger" onclick="guardarInventarioFinal(this)" style="display: block !important;">Guardar</a>
                                    <a class="btn btn-outline-success" onclick="confirmarModificarInventarioFinal(this)" style="display: none;">Modificar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade show active" id="inventarioFinalTabContent" role="tabpanel" aria-labelledby="InventarioFinalTab">
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div class="modal fade" id="inventarioFinalModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Informacion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="datosInventarioFinal">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <script src="js/controladores/CRUD.js"></script>
        <script src="js/controladores/FichaProducto/funcionesSecundarias.js"></script>
        <script src="js/controladores/FichaProducto/productog.js"></script>
        <script src="js/controladores/inventarioFinal.js"></script>
    </footer>
    <?php include_once('canvas.php');?>
</body>
</html>