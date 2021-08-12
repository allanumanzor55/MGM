<?php include_once('validation.php');?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php include_once('head.php');?>
    <title>FichaProducto</title>
</head>
<body id="bg-landing" class="container-fluid p-0">
    <div class="container-fluid bg-opacity min-vh-100 w-100">
        <header>
            <?php include_once('nav.php'); ?>
        </header>
        <div class="row" style="min-height: 8.1vh !important;"></div>
        <main class="row px-5">
            <div class="d-flex align-items-start bg-light min-vh-100 min-w-100 px-0 pt-2">
                <div class="nav flex-column nav-pills me-3 h-100" style="background-color: rgb(225,225,225);" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link nav-link-mg-2 active" id="v-pills-ingresar-tab" data-bs-toggle="pill" data-bs-target="#v-pills-ingresar" type="button" role="tab" aria-controls="v-pills-ingresar" aria-selected="true">Ingresar producto</button>
                    <button class="nav-link nav-link-mg-2" id="v-pills-producto-tab" data-bs-toggle="pill" data-bs-target="#v-pills-producto" type="button" role="tab" aria-controls="v-pills-producto" aria-selected="false" onclick="refrescarAcordionFichaProducto()">FichaProductos</button>
                </div>
                <div class="tab-content col-10 min-vh-100" id="v-pills-tabContent">
                    <div class="tab-pane fade show active min-vh-100" id="v-pills-ingresar" role="tabpanel" aria-labelledby="v-pills-ingresar-tab">
                        <div class="container-fluid">
                            <form class="row g-3 align-items-center" id="formFichaProducto" enctype="multipart/form-data">
                                <input type="hidden" name="id" id="idFichaProducto" value="">
                                <div class="col-12">
                                    <input type="text" class="form-control" id="descripcionPro" name="descripcion" placeholder="Descripcion">
                                </div>
                                <div class="col-6" id="btnMateriaPrima">
                                    <a type="button" class="btn btn-outline-success" onclick="abrirModalMateriaPrima()" style="display:block !important;" data-bs-toggle="modal" data-bs-target="#materialesModal">Seleccionar Materia Prima</a>
                                </div>
                                <div class="col-6" id="btnMateriales">
                                    <a type="button" class="btn btn-outline-success" onclick="abrirModalMateriales()" style="display:block !important;" data-bs-toggle="modal" data-bs-target="#materialesModal">Agregar Materiales</a>
                                </div>
                                <div class="col-12">
                                    <input type="number" class="form-control" id="precioPro" name="precio" placeholder="Precio">
                                </div>
                                <input type="hidden" name="materiaPrima" id="materiaPrima" value="">
                                <input type="hidden" name="materiales" id="materiales" value="">
                            </form>
                            <form id="formFichaProducto2" class="row mt-2">
                                <div class="col">
                                    <a type="button" class="btn btn-outline-danger" onclick="guardarFichaProducto(this)" style="display: block !important;">Guardar</a>
                                    <a type="button" class="btn btn-outline-success" onclick="confirmarModificarFichaProducto(this)" value="modificar" style="display: none !important;">Modificar</a>
                                </div>
                            </form>
                            <hr>
                            <div class="row">
                                <div class="accordion accordion-flush" id="acordionMateriales">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsePrima" aria-expanded="false" aria-controls="flush-collapsePrima">
                                                <h3 class="display-6" style="font-size: x-large !important;">Materia Prima</h3>
                                            </button>
                                        </h2>
                                        <div id="flush-collapsePrima" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#acordionMateriales">
                                            <div class="container">
                                                <div class="row m-2 align-items-center border rounded" id="datosPrima">
                                                    <h3 class="display-6" style="font-size: large !important;">No hay Materia Prima Seleccionada</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item" id="accordion-item-materiales">
                                        <h2 class="accordion-header" id="flush-headingTwo">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseMaterial" aria-expanded="false" aria-controls="flush-collapseMaterial">
                                                <h3 class="display-6" style="font-size: x-large !important;">Materiales</h3>
                                            </button>
                                        </h2>
                                        <div id="flush-collapseMaterial" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#acordionMateriales">
                                            <div class="container" id="datosMaterial">
                                                <h3 class="display-6" style="font-size: large !important;">No hay Materiales Seleccionados</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade min-h-100" id="v-pills-producto" role="tabpanel" aria-labelledby="v-pills-producto-tab">
                        <div class="container-fluid" id="cardFichaProducto">
                            
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    </div>
    <div class="modal fade" id="materialesModal" tabindex="-1" aria-labelledby="materialesModaTitulo" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="materialesModalTitulo">Materia Prima</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="cardInventarioPrima"></div>
                    <div id="cardInventarioMaterial"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="materialesFichaProductoModal" tabindex="-1" aria-labelledby="materialesModalTitulo" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="materialesModalTitulo">Materiales </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="tablaMateriales"></div>    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="cantidadMaterialModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="cantidadModalTitulo" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cantidadModalTitulo">Ingrese la cantidad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="number" name="" id="cantidadMaterial" class="form-control" onchange="agregarCantidadMaterial(this.value)" onkeyup="agregarCantidadMaterial(this.value)">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button id="btnCantidad" type="button" class="btn btn-primary" data-bs-target="#cantidadMaterialModal" data-bs-dismiss="modal" onclick="agregarMaterial()" disabled>Agregar material</button>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <script src="js/controladores/CRUD.js"></script>
        <script src="js/controladores/Settings/categorias.js"></script>
        <script src="js/controladores/inventario.js"></script>
        <script src="js/controladores/FichaProducto/funcionesSecundarias.js"></script>
        <script src="js/controladores/FichaProducto/productog.js"></script>
    </footer>
    <?php include_once('canvas.php');?>
</body>

</html>