<?php include_once('validation.php');?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('head.php');?>
    <title>Empleados</title>
</head>
<body id="bg-landing" class="container-fluid px-0">
    <div class="container-fluid bg-opacity min-vh-100 w-100">
        <header>
            <?php include_once('nav.php'); ?>
        </header>
        <div class="row" style="min-height: 8.2vh !important;"></div>
        <main class="row px-5">
            <div class="container vw-100 min-vh-100 bg-light pt-1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php" class="mg-color-1">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Empleados</li>
                    </ol>
                </nav>
                <div class="align-items-start bg-light min-vh-100 pt-2">
                    <ul class="nav nav-pills mb-3" id="pills-tabEmpleado" role="tablist">
                    </ul>
                    <div class="tab-content min-vh-50" id="pills-tabContentEmpleado">
                        <div class="tab-pane fade" id="ingresarEmpleado" role="tabpanel" aria-labelledby="ingresarEmpleadoTab">
                        <div class="d-flex justify-content-between my-2">
                                <span class="display-6" style="font-size: xx-large !important;">
                                    <strong>Empleados</strong>
                                </span>
                                <a href="#" class="btn btn-outline-secondary"
                                    onclick="mostrarTab('tabsCargos','ingresarEmpleado')">
                                    <i class="zmdi zmdi-arrow-left"></i>
                                </a>
                            </div>
                            <hr>
                            <form id="formEmpleado" class="row g-3" enctype="multipart/form-data">
                                <input type="hidden" name="id" id=>
                                <div class="col-12">
                                    <label for="selectTipoEmpleado" class="form-label">Cargo</label>
                                    <select class="form-select" name="tipoEmpleado" id="selectTipoEmpleado">
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="formFile" class="form-label">Fotografia</label>
                                    <input class="form-control" type="file" name="foto" id="fotoEmpleado">
                                </div>
                                <div class="col-12"> 
                                    <label for="dni" class="form-label ">DNI</label>
                                    <input type="text" name="dni" class="form-control readonly" id="dni">
                                </div>
                                <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                                    <label for="nombre" class="form-label ">Nombre</label>
                                    <input type="text" name="nombre" class="form-control readonly" id="nombre">
                                </div>
                                <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                                    <label for="primerApellido" class="form-label">Primer apellido</label>
                                    <input type="text" name="primerApellido" class="form-control" id="primerApellido">
                                </div>
                                <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                                    <label for="segundoApellido" class="form-label">Segundo apellido</label>
                                    <input type="text" name="segundoApellido" class="form-control" id="segundoApellido">
                                </div>
                                <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                                    <label for="correo" class="form-label">Correo</label>
                                    <input type="email" name="correo" class="form-control" id="correo">
                                </div>
                                <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                                    <label for="celular" class="form-label">Celular</label>
                                    <input type="text" name="celular" class="form-control" id="celular">
                                </div>
                                <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                                    <label for="telefono" class="form-label">Telefono</label>
                                    <input type="text" name="telefono" class="form-control" id="telefono">
                                </div>
                                <div class="col-12">
                                    <label for="direccion" class="form-label">Direccion</label>
                                    <textarea class="form-control" name="direccion" id="direccion" cols="120" rows="4"></textarea>
                                </div>
                                <div class="col-12">
                                    <label for="sueldo" class="form-label">Sueldo</label>
                                    <input type="number" name="sueldo" class="form-control" id="sueldo">
                                </div>
                                <div class="row justify-content-center my-3">
                                    <div class="col-4">
                                        <a class="btn btn-outline-warning" onclick="guardarEmpleado(this)" style="display: block !important;">Guardar</a>
                                        <a class="btn btn-outline-success" onclick="confirmarModificarEmpleado(this)" style="display: none;">Modificar</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="tabsCargos" class="tab-pane show active">
                            <div class="d-flex justify-content-between my-2">
                                <span class="display-6" style="font-size: xx-large !important;">
                                    <strong>Empleados</strong>
                                </span>
                                <?php
                                    include_once('../Backend/class/class-conexion.php');
                                    include_once('../Backend/class/class-login.php');
                                    $db = new Conexion();
                                    $cnn = $db->getConexion();
                                    $p = intval(Login::obtenerPermiso($cnn,'empleados'));
                                    echo 
                                    Login::verf_perm("e",$p)||Login::verf_perm("g",$p)||Login::verf_perm("adm",$p)?
                                    '<a href="#" class="btn btn-outline-success"
                                    onclick="mostrarTab(\'ingresarEmpleado\',\'tabsCargos\')">
                                    <i class="zmdi zmdi-plus"></i>
                                    </a>':
                                    ''; 
                                ?>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    </div>
    <div class="modal fade" id="empleadoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Informacion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="datosEmpleado">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <script src="js/controladores/CRUD.js"></script>
        <script src="js/controladores/empleados.js"></script>
        <script src="js/controladores/Settings/cargos.js"></script>
        <script>
            crearTabsCargos(<?php
            include_once('../Backend/class/class-conexion.php');
            include_once('../Backend/class/class-login.php');
            $db = new Conexion();$cnn = $db->getConexion();
            $p = Login::obtenerPermiso($cnn,'empleados');
            echo Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)?$p:-1;
            ?>)
            rellenarSelectCargos()
        </script>
    </footer>
    <?php include_once('canvas.php');?>
</body>

</html>