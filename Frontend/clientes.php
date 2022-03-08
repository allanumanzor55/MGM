<?php include_once('validation.php');?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php include_once('head.php');?>
    <title>Clientes</title>
</head>
<body id="bg-landing" class="container-fluid px-0">
    <div class="container-fluid bg-opacity min-vh-100 w-100">
        <header>
            <?php include_once('nav.php'); ?>
        </header>
        <div class="row" style="min-height: 8.23vh !important;"></div>
        <main class="row px-5">
            <div class="container vw-100 min-vh-100 bg-light pt-1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php" class="mg-color-1">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Clientes</li>
                    </ol>
                </nav>
                <div class="align-items-start bg-light min-vh-100 pt-2">
                    <div class=" tab-content min-vh-50" id="pills-tabContentCliente">
                        <div class="tab-pane fade" id="ingresarCliente" role="tabpanel" aria-labelledby="ingresarClienteTab">
                            <div class="d-flex justify-content-between my-2">
                                <span id="titleCliente" class="display-6" style="font-size: xx-large !important;">
                                    <strong>Ingresar Cliente</strong>
                                </span>
                                <div>
                                <a href="#" class="btn btn-outline-secondary"
                                    onclick="mostrarTab('clienteTabContent','ingresarCliente')">
                                    <i class="zmdi zmdi-arrow-left"></i></a>
                                </div>
                            </div>
                            <hr>
                            <form id="formCliente" class="row g-3" enctype="multipart/form-data">
                                <input type="hidden" name="id" id="idCliente">
                                <div class="col-12">
                                    <label for="selectTipoCliente" class="form-label">Tipo Cliente</label>
                                    <select class="form-select" name="tipoCliente" id="selectTipoCliente" aria-placeholder="Select"
                                    onchange="document.getElementById('checkEmpresa').hidden=false">
                                        <option disabled selected>Selecciona el tipo de cliente</option>
                                        <option value="1">Al Detalle</option>
                                        <option value="2">Mayorista</option>
                                        <option value="3">Eventual</option>
                                    </select>
                                </div>
                                <div class="col-12" id="checkEmpresa" hidden>
                                    <div class="d-flex mt-2">
                                        <div class="me-3">
                                            <label class="form-check-label" for="flexCheckChecked">
                                            Es empresa?
                                            </label>
                                            <input class="form-check-input" name="chkEmpresa" type="checkbox" id="chkEmpresa" 
                                            onchange="esEmpresa(this.checked)" value="1">
                                        </div>
                                        <div id="checkRtn" hidden>
                                            <label class="form-check-label" for="flexCheckChecked">
                                            Tiene RTN?
                                            </label>
                                            <input class="form-check-input" name="chkRtn" type="checkbox" id="chkRtn" 
                                            onchange="tieneRTN(this.checked)" value="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12" hidden id="divNombreEmpresa">
                                    <label for="rtnCliente" class="form-label">Empresa</label>
                                    <input class="form-control" type="text" name="nombreEmpresa" id="nombreEmpresa">
                                </div>
                                <div class="col-12" hidden id="divRtn">
                                    <label for="rtnCliente" class="form-label">RTN</label>
                                    <input class="form-control" type="text" name="rtnEmpresa" id="rtnEmpresa">
                                </div>
                                <div class="col-12">
                                    <label for="formFile" class="form-label">Fotografia</label>
                                    <input class="form-control" type="file" name="foto" id="fotoCliente">
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                    <label for="dni" class="form-label ">DNI</label>
                                    <input type="text" name="dni" class="form-control readonly" id="dni">
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                    <label for="nombre" class="form-label ">Nombre</label>
                                    <input type="text" name="nombre" class="form-control readonly" id="nombre">
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                    <label for="primerApellido" class="form-label">Primer apellido</label>
                                    <input type="text" name="primerApellido" class="form-control" id="primerApellido">
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                    <label for="segundoApellido" class="form-label">Segundo apellido</label>
                                    <input type="text" name="segundoApellido" class="form-control" id="segundoApellido">
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                    <label for="correo" class="form-label">Correo</label>
                                    <input type="email" name="correo" class="form-control" id="correo">
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                    <label for="celular" class="form-label">Celular</label>
                                    <input type="text" name="celular" class="form-control" id="celular">
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                                    <label for="telefono" class="form-label">Telefono</label>
                                    <input type="text" name="telefono" class="form-control" id="telefono">
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                                    <label for="edad" class="form-label">Edad</label>
                                    <input type="number" name="edad" class="form-control" id="edad">
                                </div>
                                <div class="col-12">
                                    <label for="direccion" class="form-label">Direccion</label>
                                    <textarea class="form-control" name="direccion" id="direccion" cols="120" rows="4"></textarea>
                                </div>
                                
                                <div class="row justify-content-center my-3">
                                    <div class="col-4">
                                        <a class="btn btn-outline-warning" 
                                        <?php
                                            include_once('../Backend/class/class-conexion.php');
                                            include_once('../Backend/class/class-login.php');
                                            $db = new Conexion();
                                            $cnn = $db->getConexion();
                                            $p = Login::obtenerPermiso($cnn,'clientes');
                                            $p = (Login::verf_perm("g",$p) || Login::verf_perm("adm",$p))?$p:-1;
                                            echo 'onclick="guardarCliente(this,'.$p.')"';
                                        ?>
                                        style="display: block !important;">Guardar</a>
                                        <a class="btn btn-outline-success" 
                                        onclick=
                                        "confirmarModificarCliente(
                                            this,
                                            <?php
                                                include_once('../Backend/class/class-conexion.php');
                                                include_once('../Backend/class/class-login.php');
                                                $db = new Conexion();
                                                $cnn = $db->getConexion();
                                                $p = Login::obtenerPermiso($cnn,'clientes');
                                                echo Login::verf_perm('g',$p)?$p:-1;
                                            ?>)"
                                        style="display: none;">Modificar</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade show active" id="clienteTabContent" role="tabpanel" aria-labelledby="ClienteTab">
                            <div class="d-flex justify-content-between my-2">
                                <span class="display-6" style="font-size: xx-large !important;">
                                    <strong>Clientes</strong>
                                </span>
                                <div>
                                <?php
                                    include_once('../Backend/class/class-conexion.php');
                                    include_once('../Backend/class/class-login.php');
                                    $db = new Conexion();
                                    $cnn = $db->getConexion();
                                    $p = intval(Login::obtenerPermiso($cnn,'clientes'));
                                    echo 
                                    Login::verf_perm("e",$p)||Login::verf_perm("g",$p)||Login::verf_perm("adm",$p)?
                                    '<a href="#" class="btn btn-outline-success"
                                    onclick="mostrarTab(\'ingresarCliente\',\'clienteTabContent\')">
                                    <i class="zmdi zmdi-plus"></i>
                                    </a>':
                                    '';
                                ?>
                                </div>
                            </div>
                            <hr>
                            <div id="cardsCliente">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div class="modal fade" id="clienteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Informacion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="datosCliente">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <script src="js/controladores/CRUD.js"></script>
        <script src="js/controladores/clientes.js"></script>
        <script>
        refrescarCardClientes('Cliente',
                            <?php
                                include_once('../Backend/class/class-conexion.php');
                                include_once('../Backend/class/class-login.php');
                                $db = new Conexion();
                                $cnn = $db->getConexion();
                                $p = Login::obtenerPermiso($cnn,'clientes');
                                echo Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)?$p:-1;
                            ?>)
        </script>
    </footer>
    <?php include_once('canvas.php');?>
</body>
</html>