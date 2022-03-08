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
        <div class="row" style="min-height: 8.2vh !important;"></div>
        <main class="row px-5 min-vh-100">
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
                                    <strong>Cotizaciones
                                    <span id="titleCotizacion">Pendientes</span>
                                    </strong>
                                </span>
                            <?php
                                include_once('../Backend/class/class-conexion.php');
                                include_once('../Backend/class/class-login.php');
                                $db = new Conexion();
                                $cnn = $db->getConexion();
                                $p = intval(Login::obtenerPermiso($cnn,'cotizacion'));
                                echo 
                                Login::verf_perm("e",$p)||Login::verf_perm("g",$p)||Login::verf_perm("adm",$p)?
                                '<a href="#" class="btn btn-outline-success"
                                onclick="mostrarCliente(this)">
                                <i class="zmdi zmdi-plus"></i>
                                </a>':
                                '';
                            ?>
                        </div>
                        <hr>
                        <div class="row justify-content-end mb-1">
                            <div class="col-3">
                                <select class="form-select"
                                <?php
                                    include_once('../Backend/class/class-conexion.php');
                                    include_once('../Backend/class/class-login.php');
                                    $db = new Conexion();
                                    $cnn = $db->getConexion();
                                    $p = Login::obtenerPermiso($cnn,'cotizacion');
                                    $p = Login::verf_perm("g",$p)?$p:-1;
                                    echo 'onchange="obtenerCotizacionesPorEstado('.$p.',this.value)"';
                                ?>>
                                    <option value="PENDIENTE">Pendientes</option>
                                    <option value="APROBADA">Aprobadas</option>
                                    <option value="RECHAZADA">Rechazadas</option>
                                </select>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-responsive table-hover text-center" id="tableCotizacion"></table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-clientes">
                        <div class="d-flex justify-content-between my-2">
                            <span class="display-6" style="font-size: xx-large !important;">
                                <strong>Seleccionar Cliente</strong>
                            </span>
                            <a title="Volver a registros" href="#" onclick="mostrarTab('tab-cotizacion','tab-clientes')" class="btn btn-outline-secondary">
                                <i class="zmdi zmdi-arrow-left"></i></a>
                        </div>
                        <hr>
                        <div class="container">
                            <div class="row justify-content-center" id="cardsCliente">

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-ingresar" role="tabpanel" aria-labelledby="InventarioFinalTab">
                        <div class="d-flex justify-content-between my-2">
                            <span class="display-6" style="font-size: xx-large !important;">
                                <strong>Cotizar</strong>
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
                                        <input type="hidden" name="cliente" id="idCliente">
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
                                                <a class="btn btn-outline-warning" 
                                                <?php
                                                    include_once('../Backend/class/class-conexion.php');
                                                    include_once('../Backend/class/class-login.php');
                                                    $db = new Conexion();
                                                    $cnn = $db->getConexion();
                                                    $p = Login::obtenerPermiso($cnn,'guiaRemision');
                                                    $per = Login::verf_perm("g",$p)?$p:-1;
                                                    echo 'onclick="generarCotizacion(this,'.$per.')"'; 
                                                ?>
                                                style="display: block !important;">
                                                    <i class="zmdi zmdi-shopping-cart"></i>
                                                    <div class="d-none d-sm-none d-md-block"> Solicitar Cotizacion</div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-catalogo" role="tabpanel" aria-labelledby="ingresarInventarioFinalTab">
                        <div class="d-flex justify-content-between my-2">
                            <span class="display-6" style="font-size: xx-large !important;">
                                <strong>Catalogo De Productos</strong>
                            </span>
                            <a title="Volver a registros" href="#" onclick="mostrarTab('tab-ingresar','tab-catalogo')" class="btn btn-outline-success">
                                <i class="zmdi zmdi-arrow-left"></i></a>
                        </div>
                        <hr>
                        <div class="row row-cols-1 row-cols-sm-2 row row-cols-md-3 row-cols-lg-4 g-4" id="cardsCatalogo">
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-productos" role="tabpanel">
                        <div class="d-flex justify-content-between my-2">
                            <span class="display-6" style="font-size: xx-large !important;">
                                <strong>Productos Cotizados</strong>
                            </span>
                            <a title="Volver a registros" href="#" onclick="mostrarTab('tab-cotizacion','tab-productos')" class="btn btn-outline-secondary">
                                <i class="zmdi zmdi-arrow-left"></i></a>
                        </div>
                        <hr>
                        <div class="row row-cols-1 row-cols-sm-2 row row-cols-md-3 row-cols-lg-4 g-4" id="cardsProductosCotizados">
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
    <footer hidden>
        <script src="js/controladores/CRUD.js"></script>
        <script src="js/controladores/catalogo.js"></script>
        <script src="js/controladores/clientes.js"></script>|
        <script src="js/controladores/cotizacion.js"></script>
        <script>
            obtenerProductos()
            obtenerCotizacionesPorEstado(
                <?php
                    include_once('../Backend/class/class-conexion.php');
                    include_once('../Backend/class/class-login.php');
                    $db = new Conexion();
                    $cnn = $db->getConexion();
                    $p = Login::obtenerPermiso($cnn,'cotizacion');
                    echo Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)?$p:-1;
                ?>,
                "PENDIENTE"
            )
            rellenarTableProductos()
        </script>
    </footer>
    <?php include_once('canvas.php'); ?>
</body>

</html>