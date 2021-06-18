<?php include_once('validation.php');?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap.css.map">
  <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
  <link rel="stylesheet" href="css/landing-styles.css">
  <title>Configuraciones</title>
</head>

<body>
  <body id="bg-landing" class="container-fluid px-0">
    <div class="container-fluid bg-opacity min-vh-100 w-100">
      <header>
        <?php include_once('nav.php'); ?>
      </header>
      <div class="row" style="min-height: 8.1vh !important;"></div>
        <main class="row px-5">
          <div class="d-flex align-items-start bg-light min-vh-100 min-w-100 px-0 pt-2">
            <div class="nav flex-column nav-pills me-3 h-100" style="background-color: rgb(225,225,225);"
              id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <button class="nav-link nav-link-mg-2 active" id="v-pills-categoria-tab" data-bs-toggle="pill"
                data-bs-target="#v-pills-categoria" type="button" role="tab" aria-controls="v-pills-categoria"
                aria-selected="true">Categorias</button>
              <button class="nav-link nav-link-mg-2" id="v-pills-estilo-tab" data-bs-toggle="pill"
                data-bs-target="#v-pills-estilo" type="button" role="tab" aria-controls="v-pills-estilo"
                aria-selected="false">Estilos</button>
              <button class="nav-link nav-link-mg-2" id="v-pills-tallas-tab" data-bs-toggle="pill"
                data-bs-target="#v-pills-tallas" type="button" role="tab" aria-controls="v-pills-tallas"
                aria-selected="false">Tallas</button>
              <button class="nav-link nav-link-mg-2" id="v-pills-roles-tab" data-bs-toggle="pill"
              data-bs-target="#v-pills-roles" type="button" role="tab" aria-controls="v-pills-roles"
              aria-selected="false">Roles</button>
              <button class="nav-link nav-link-mg-2" id="v-pills-cargos-tab" data-bs-toggle="pill"
                data-bs-target="#v-pills-cargos" type="button" role="tab" aria-controls="v-pills-cargos"
                aria-selected="false">Cargos</button>
              <button class="nav-link nav-link-mg-2" id="v-pills-procesos-tab" data-bs-toggle="pill"
              data-bs-target="#v-pills-procesos" type="button" role="tab" aria-controls="v-pills-procesos"
              aria-selected="false">Procesos</button>
            </div>
            <div class="tab-content col-10 min-vh-100" id="v-pills-tabContent">
              
              <div class="tab-pane fade show active min-vh-100" id="v-pills-categoria" role="tabpanel"
                aria-labelledby="v-pills-categoria-tab">
                <div class="container-fluid">
                  <form class="row g-3 align-items-center" id="formCategoria" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="idCategoria" value="">
                    <div class="col-4">
                        <input type="text" class="form-control" id="descripcionCat" name="descripcion"
                          placeholder="Descripcion">
                    </div>
                    <div class="col-4">
                        <input type="text" class="form-control" id="material" name="material" placeholder="Material">
                    </div>
                    <div class="col-4">
                      <a type="button" class="btn btn-outline-danger" onclick="guardarCategoria(this)">Guardar</a>
                      <a type="button" class="btn btn-outline-success" onclick="confirmarModificarCategoria(this)" value="modificar" style="display: none !important;">Modificar</a>
                    </div>
                  </form>
                  <hr class="mx-auto my-3">
                  <div class="row">
                    <div class="table-responsive">
                      <table class="table table-hover text-center" id="tableCategoria">
                        <thead>
                          <tr>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Material</th>
                            <th scope="col">Modificar</th>
                            <th scope="col">Eliminar</th>
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane fade min-h-100" id="v-pills-estilo" role="tabpanel"
                aria-labelledby="v-pills-estilo-tab">
                <div class="container-fluid">
                  <form class="row g-3 align-items-center" id="formEstilo" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="idEstilo" value="">
                    <div class="col-4">
                        <select class="form-select" name="tipo" id="selectCategoria">
                        </select>
                    </div>
                    <div class="col-4">
                        <input type="text" class="form-control" id="estilo" name="estilo" placeholder="Estilo"> 
                    </div>
                    <div class="col-4">
                      <a type="button" class="btn btn-outline-danger" onclick="guardarEstilo(this)" style="display: block !important;">Guardar</a>
                      <a type="button" class="btn btn-outline-success" onclick="confirmarModificarEstilo(this)" value="modificar" style="display: none !important;">Modificar</a>
                    </div>
                  </form>
                  <hr class="mx-auto my-3">
                  <div class="row">
                    <div class="table-responsive">
                      <table class="table table-hover" id="tableEstilo">
                        <thead>
                          <tr>
                            <th scope="col">Categoria</th>
                            <th scope="col">Material</th>
                            <th scope="col">Estilo</th>
                            <th scope="col">Modificar</th>
                            <th scope="col">Eliminar</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="tab-pane fade min-h-100" id="v-pills-tallas" role="tabpanel"
                aria-labelledby="v-pills-tallas-tab">
                <div class="container-fluid">
                  <form class="row g-3 align-items-center" id="formTalla">
                    <input type="hidden" name="id" id="idTalla">
                    <div class="col-4">
                      <div class="input-group">
                        <input type="text" class="form-control" id="descripcionTal" name="descripcion" placeholder="Talla">
                      </div>
                    </div>
                    <div class="col-4">
                      <a type="button" class="btn btn-outline-danger" onclick="guardarTalla(this)" style="display: block !important;">Guardar</a>
                      <a type="button" class="btn btn-outline-success" onclick="confirmarModificarTalla(this)" value="modificar" style="display: none !important;">Modificar</a>
                    </div>
                  </form>
                  <hr class="mx-auto my-3">
                  <div class="row">
                    <div class="table-responsive">
                      <table class="table table-hover text-center" id="tableTalla">
                        <thead>
                          <tr>
                            <th scope="col">Talla</th>
                            <th scope="col">Modificar</th>
                            <th scope="col">Eliminar</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane fade min-h-100" id="v-pills-roles" role="tabpanel" aria-labelledby="v-pill-roles-tab">
                <form class="row g-3 align-items-center" id="formRol">
                  <div class="col-9">
                    <input type="hidden" name="id" id="Rol" value="">
                    <div class="col-12 input-group mb-2">
                      <input type="text" class="form-control" id="rol" name="rol" placeholder="Rol">
                    </div>
                    
                    <div class="col-12 input-group">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="1" id="chkEmpleado" name="empleados">
                        <label class="form-check-label" for="chkEmpleado">
                          Empleados
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="1" id="chkCliente" name="clientes">
                        <label class="form-check-label" for="chkCliente">
                          Clientes
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="1"  id="chkInventario" name="inventario">
                        <label class="form-check-label" for="chkInventario">
                          Inventario
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="1"  id="chkVenta" name="ventas">
                        <label class="form-check-label" for="chkVenta">
                          Ventas
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="1"  id="chkConfiguracion" name="configuracion">
                        <label class="form-check-label" for="chkConfiguracion">
                          Configuracion
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-3">
                    <a type="button" class="btn btn-outline-danger" onclick="guardarRol(this)" style="display: block !important;">Guardar</a>
                    <a type="button" class="btn btn-outline-success" onclick="confirmarModificarRol(this)" value="modificar" style="display: none !important;">Modificar</a>
                  </div>
                </form>
                <hr class="mx-auto my-3">
                <div class="row">
                  <div class="table-responsive">
                    <table class="table table-hover text-center" id="tableRol">
                      <thead class="table-light" style="border: none !important;">
                        <tr>
                          <th scope="col" class="align-middle" rowspan="2">Rol</th>
                          <th scope="col" class="align-middle" colspan="5">Permisos</th>
                          <th scope="col" class="align-middle" rowspan="2">Modificar</th>
                          <th scope="col" class="align-middle" rowspan="2">Eliminar</th>
                        </tr>
                        <tr>
                            <td scope="col" class="align-middle">Empleados</td>
                            <td scope="col" class="align-middle">Clientes</td>
                            <td scope="col" class="align-middle">Inventario</td>
                            <td scope="col" class="align-middle">Ventas</td>
                            <td scope="col" class="align-middle">Configuracion</td>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="tab-pane fade min-h-100" id="v-pills-cargos" role="tabpanel" aria-labelledby="v-pills-cargos-tab">
                <form class="row g-3 align-items-center" id="formCargo">
                  <input type="hidden" name="id" id="idCargo">
                  <div class="col-4">
                    <div class="input-group">
                      <input type="text" class="form-control" id="descripcionTip" name="descripcion" placeholder="Cargo">
                    </div>
                  </div>
                  <div class="col-4">
                    <select class="form-select" name="rol" id="selectRoles">
                    </select>
                  </div>
                  <div class="col-4">
                    <a type="button" class="btn btn-outline-danger" onclick="guardarCargo(this)" style="display:block !important;">Guardar</a>
                    <a type="button" class="btn btn-outline-success" onclick="confirmarModificarCargo(this)" value="modificar" style="display: none !important;">Modificar</a>
                  </div>
                </form>
                <hr class="mx-auto my-3">
                <div class="row">
                  <div class="table-responsive">
                    <table class="table table-hover text-center" id="tableCargo">
                      <thead>
                        <tr>
                          <th scope="col">Cargo</th>
                          <th scope="col">Modificar</th>
                          <th scope="col">Eliminar</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              
              <div class="tab-pane fade min-h-100" id="v-pills-procesos" role="tabpanel" aria-labelledby="v-pill-procesos-tab">
                <form class="row g-3 align-items-center" id="formProceso">
                  <div class="col-9">
                    <input type="hidden" name="id" id="Proceso" value="">
                    <div class="col-12 input-group mb-2">
                      <input type="text" class="form-control" id="descripcionProceso" name="descripcion" placeholder="Proceso">
                    </div>
                  </div>
                  <div class="col-3">
                    <a type="button" class="btn btn-outline-danger" onclick="guardarProceso(this)" style="display: block !important;">Guardar</a>
                    <a type="button" class="btn btn-outline-success" onclick="confirmarModificarProceso(this)" value="modificar" style="display: none !important;">Modificar</a>
                  </div>
                </form>
                <hr class="mx-auto my-3">
                <div class="row">
                  <div class="table-responsive">
                    <table class="table table-hover text-center" id="tableProceso">
                      <thead class="table-light" style="border: none !important;">
                        <tr>
                          <th scope="col" class="align-middle" rowspan="2">Proceso</th>
                          <th scope="col" class="align-middle" rowspan="2">Modificar</th>
                          <th scope="col" class="align-middle" rowspan="2">Eliminar</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
    <footer>
      <?php include_once('footer.php'); ?>
      <script src="js/controladores/CRUD.js"></script>
      <script src="js/controladores/Settings/categorias.js"></script>
      <script src="js/controladores/Settings/cargos.js"></script>
      <script src="js/controladores/Settings/roles.js"></script>
      <script src="js/controladores/Procesos/procesos.js"></script>
      <script>
        refrescarTablaCategoria()
        refrescarTablaEstilo()
        refrescarTablaTalla()
        refrescarTablaCargo()
        refrescarTablaRol()
        refrescarTablaProceso()//
        rellenarSelect()
        rellenarSelectEstilo()
        rellenarSelectTalla()
        rellenarSelectRoles()
        intercalarBotones("formCategoria",true)
      </script>
    </footer>
    <?php include_once('canvas.php');?>
</body>

</html>