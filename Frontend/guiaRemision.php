<?php include_once('validation.php'); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include_once('head.php'); ?>
    <title>Guia De Remision</title>
</head>

<body id="bg-landing" class="container-fluid px-0">
    <div class="container-fluid bg-opacity min-h-100 min-w-100">
        <header>
            <?php include_once('nav.php'); ?>
        </header>
        <div class="row" style="min-height: 8.8vh !important;"></div>
        <main class="row px-5">
            <div class="container vw-100 min-vh-100 bg-light pt-1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php" class="mg-color-1">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a href="inventario.php" 
                            class="mg-color-1">Inventario</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Guia De Remision</li>
                    </ol>
                </nav>
                <div class="tab-content min-vh-100">
                    <div class="tab-pane fade show active min-vh-100" id="tab-guias">
                        <div  class="d-flex justify-content-between my-2">
                            <span class="display-6" style="font-size: xx-large !important;">
                                Guias de remisión
                            </span>
                            <?php
                                    include_once('../Backend/class/class-conexion.php');
                                    include_once('../Backend/class/class-login.php');
                                    $db = new Conexion();
                                    $cnn = $db->getConexion();
                                    $p = intval(Login::obtenerPermiso($cnn,'guiaRemision'));
                                    echo 
                                    Login::verf_perm("e",$p) || Login::verf_perm("g",$p)?
                                    '<a title="Crear guia de remision" class="btn btn-outline-success"
                                    onclick="mostrarTab(\'tab-ingresar\',\'tab-guias\')">
                                    <i class="zmdi zmdi-plus"></i>
                                    </a>':
                                    '';
                            ?>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-hover text-center" id="tableGuia">
                                
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade min-vh-100" id="tab-materiales">
                        <div  class="d-flex justify-content-between my-2">
                            <span class="display-6" style="font-size: xx-large !important;">
                                Materiales
                            </span>
                            <a title="Crear Guia De Remision" href="#" onclick="mostrarTab('tab-guias','tab-materiales')" class="btn btn-outline-secondary">
                            <i class="zmdi zmdi-arrow-left"></i></a>
                        </div>
                        <hr>
                        <div class="table-responsive" id="cardMaterialesGuia">
                        </div>
                    </div>
                    <div class="tab-pane fade min-vh-100" id="tab-materiasPrimas">
                        <div  class="d-flex justify-content-between my-2">
                            <span class="display-6" style="font-size: xx-large !important;">
                                Materia Prima
                            </span>
                            <a title="Regresar a guias" href="#" onclick="mostrarTab('tab-guias','tab-materiasPrimas')" class="btn btn-outline-secondary">
                            <i class="zmdi zmdi-arrow-left"></i></a>
                        </div>
                        <hr>
                        <div class="table-responsive" id="cardMateriaPrimaGuia">
                        </div>
                    </div>
                    <div class="tab-pane fade min-h-100" id="tab-ingresar">
                        <div class="d-flex justify-content-between my-2">
                            <span class="display-6" style="font-size: xx-large !important;">
                                Generar Guia De Remisión
                            </span>
                            <div>
                                <a class="btn btn-outline-danger" id="cancelarGenerar" hidden onclick="limpiarVariables()">
                                <i class="zmdi zmdi-close"></i>
                                Cancelar
                                </a>
                                <a title="Volver a registro" href="#" 
                                onclick="mostrarTab('tab-guias','tab-ingresar')" class="btn btn-outline-secondary">
                                <i class="zmdi zmdi-arrow-left"></i>
                                Volver a registros  
                            </a>
                            </div>                            
                        </div>
                        <hr>
                        <form id="formGuiaRemision" class="row" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="idGuiaRemision">
                            <div class="col-12">
                                <label for="bodegaSalida" class="form-label">Bodega Salida</label>
                                <select name="bodegaSalida" id="bodegaSalida" class="form-control select-bodega"
                                onchange="obtenerDatosInventarioPorBodega(this.value)">
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="motivoTraslado" class="form-label">Motivo Traslado</label>
                                <textarea name="motivoTraslado" id="motivoTraslado" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="col-12">
                                <label for="bodegaEntrada" class="form-label">Bodega Destino</label>
                                <select name="bodegaEntrada" id="bodegaEntrada" class="form-control select-bodega">
                                </select>
                            </div>
                            <div class="col-6 mt-3" id="btnMateriaPrima">
                                <a type="button" class="btn btn-outline-secondary" 
                                onclick="mostrarInventarioTraslado(this,'Prima')" style="display:block !important;">
                                <i class="zmdi zmdi-plus"> </i> 
                                Materia Prima
                                </a>
                            </div>
                            <div class="col-6 mt-3" id="btnMateriales">
                                <a type="button" class="btn btn-outline-secondary" 
                                onclick="mostrarInventarioTraslado(this,'Material')" style="display:block !important;">
                                <i class="zmdi zmdi-plus"></i>
                                Materiales
                                </a>
                            </div>
                            <input type="hidden" name="materiales" id="materiales">
                            <input type="hidden" name="materiaPrima" id="materiaPrima">
                            <div class="row justify-content-center my-3">
                                <div class="col-5">
                                    <a class="btn btn-outline-warning btn-block" onclick="generarGuia(this)" style="display: block !important">
                                    <div class="d-none d-sm-none d-md-block">
                                        Generar
                                        </div>
                                        <div class="d-block d-sm-block d-md-none">
                                        <i class="zmdi zmdi-floppy"></i>
                                        </div>
                                    </a>
                                    <a class="btn btn-outline-secondary btn-block" onclick="confirmarModificarGuia(this)" style="display: none !important;">Modificar</a>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Materia Prima
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body p-0" >
                                            <div class="container p-0" id="acordionPrima">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Materiales
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body p-0">
                                            <div class="container  p-0" id="acordionMaterial">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade min-h-100" id="tab-inventario">
                        <div class="d-flex justify-content-between my-2">
                            <span class="display-6" id="titleInventario" style="font-size: xx-large !important;">
                                
                            </span>
                            <a title="Cancelar" href="#" onclick="mostrarTab('tab-ingresar','tab-inventario')" class="btn btn-outline-secondary">
                                <i class="zmdi zmdi-arrow-left"></i>
                                Volver a generar
                            </a>
                        </div>
                        <div class="container-fluid">
                            <div id="cardInventarioPrima">
                            </div>
                            <div id="cardInventarioMaterial">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
    <footer>
        <script src="js/controladores/CRUD.js"></script>
        <script src="js/controladores/Settings/categorias.js"></script>
        <script src="js/controladores/inventario.js"></script>
        <script src="js/controladores/bodega.js"></script>
        <script src="js/controladores/guiaRemision/funcionesSecundarias.js"></script>
        <script src="js/controladores/guiaRemision/inventarioTraslado.js"></script>
        <script src="js/controladores/guiaRemision/guiaRemision.js"></script>
        <script>
            refrescarTableGuia()
            rellenarSelectBodega()
        </script>
    </footer>
    <?php include_once('canvas.php'); ?>
</body>

</html>