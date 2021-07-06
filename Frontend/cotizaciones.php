<?php include_once('validation.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('head.php'); ?>
    <title>Cotizaciones</title>
</head>

<body id="bg-landing" class="container-fluid px-0">
    <div class="container-fluid bg-opacity min-vh-100 w-100">
        <header>
            <?php include_once('nav.php'); ?>
        </header>
        <div class="row" style="min-height: 9vh !important;"></div>
        <main class="row px-5">
            <div class="align-items-start bg-light min-vh-100 pt-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php" class="mg-color-1">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cotizacion</li>
                    </ol>
                </nav>
                <div class=" tab-content min-vh-50" id="pills-tabContentCotizacion">
                    <div class="tab-pane show active" id="tab-cotizacion" role="tabpanel" aria-labelledby="ingresarInventarioFinalTab">
                        <div class="d-flex justify-content-between my-2">
                            <span class="display-6" style="font-size: xx-large !important;">
                                Estado De Cotizaciones
                            </span>
                            <a title="Crear Cotizacion" href="#" onclick="mostrarTab('tab-ingresar','tab-cotizacion')" class="btn btn-outline-success">
                                <i class="zmdi zmdi-plus"></i></a>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-responsive text-center" id="tableCotizacion"></table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-ingresar" role="tabpanel" aria-labelledby="InventarioFinalTab">
                        <div class="d-flex justify-content-between my-2">
                            <span class="display-6" style="font-size: xx-large !important;">
                                Cotizar
                            </span>
                            <a title="Volver a registros" href="#" onclick="mostrarTab('tab-cotizacion','tab-ingresar')" class="btn btn-outline-success">
                                <i class="zmdi zmdi-arrow-left"></i></a>
                        </div>
                        <hr>
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-3">
                                    <div class="card text-white mb-3" style="max-width: 18rem;">
                                        <div class="card-header" style="background-color: tomato !important; border:none !important;">Productos Cotizados</div>
                                        <div class="card-body">
                                            <li class="list-group-item d-flex justify-content-between align-items-center rounded border-none text-white" style="background-color: tomato !important;">
                                                Productos Agregados
                                                <span class="badge bg-white rounded-pill" style="color:tomato !important;" id="nProductosAgregados">0</span>
                                            </li>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3" id="btnMateriaPrima">
                                            <a type="button" class="btn btn-outline-warning" onclick="mostrarCatalogo()" style="display:block !important;">
                                                Abrir Catalogo</a>
                                    </div>
                                    <form id="formCotizacion" class="row g-3" enctype="multipart/form-data">
                                        <input type="hidden" name="id" id="idCotizacion">
                                        <input type="hidden" name="descripcionCotizacion" id="descripcionCotizacion">
                                        <input type="hidden" name="productos" id="productos">
                                    </form>
                                </div>
                                <div class="col-9">
                                    <div class="row justify-content-center my-3">
                                        <div class="table-responsive" id="tableProductos">
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-end">
                                            <div class="col-3">
                                                <a class="btn btn-outline-warning" onclick="generarCotizacion(this)" style="display: block !important;">
                                                    <div class="d-none d-sm-none d-md-block"><i class="zmdi zmdi-shopping-cart"></i> Solicitar Cotizacion</div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--div class="tab-pane fade" id="tab-ingresar2" role="tabpanel" aria-labelledby="InventarioFinalTab">
                        <div class="d-flex justify-content-between my-2">
                            <span class="display-6" style="font-size: xx-large !important;">
                                Generar Cotizacion
                            </span>
                            <a title="Volver a registros" href="#" onclick="mostrarTab('tab-cotizacion','tab-ingresar')" class="btn btn-outline-success">
                                <i class="zmdi zmdi-arrow-left"></i></a>
                        </div>
                        <hr>
                        <form id="formCotizacion" class="row g-3" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="idCotizacion">
                            <div class="col-12">
                                <label for="descripcionCotizacion" class="form-label">Descripcion</label>
                                <textarea name="descripcionCotizacion" id="descripcionCotizacion" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="col-12 mt-3" id="btnMateriaPrima">
                                <a type="button" class="btn btn-outline-success" onclick="mostrarCatalogo()" style="display:block !important;">
                                    Abrir Catalogo</a>
                            </div>
                            <input type="hidden" name="productos">
                            <div class="row justify-content-center my-3">
                                <div class="col-4">
                                    <a class="btn btn-outline-danger" onclick="generarCotizacion(this)" style="display: block !important;">
                                        <div class="d-none d-sm-none d-md-block">Consultar</div>
                                        <div class="d-block d-sm-block d-md-none"><i class="zmdi zmdi-edit"></i></div>
                                    </a>
                                    <a class="btn btn-outline-success" onclick="confirmarModificarCotizacion(this)" style="display: none;">Modificar</a>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Productos
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body p-0">
                                            <div class="container p-0" id="acordionProducto">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div-->
                    <div class="tab-pane fade" id="tab-catalogo" role="tabpanel" aria-labelledby="ingresarInventarioFinalTab">
                        <div class="d-flex justify-content-between my-2">
                            <span class="display-6" style="font-size: xx-large !important;">
                                Catalogo De Productos
                            </span>
                            <a title="Volver a registros" href="#" onclick="mostrarTab('tab-ingresar','tab-catalogo')" class="btn btn-outline-success">
                                <i class="zmdi zmdi-arrow-left"></i></a>
                        </div>
                        <hr>
                        <div class="row row-cols-1 row-cols-sm-2 row row-cols-md-3 row-cols-lg-4 g-4" id="cardsCatalogo">
                        </div>
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
        <script src="js/controladores/catalogo.js"></script>
        <script src="js/controladores/cotizacion.js"></script>
        <script>
            obtenerProductos()
            refrescarTableCotizacion()
            rellenarTableProductos()
        </script>
    </footer>
    <?php include_once('canvas.php'); ?>
</body>

</html>