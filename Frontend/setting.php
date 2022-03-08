<?php include_once('validation.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once('head.php'); ?>
  <title>Configuraciones</title>
</head>

<body>
  <style>
    .col.btn-outline-warning{
      color: tomato;
      border-color:  tomato;
    }
    .col.btn-outline-warning:hover{
      color:white;
      border-color: tomato;
      background-color: tomato;
    }
  </style>
  <body id="bg-landing" class="container-fluid px-0">
    <div class="container-fluid bg-opacity min-vh-100 w-100">
      <header>
        <?php include_once('nav.php'); ?>
      </header>
      <div class="row" style="min-height: 8.23vh !important;"></div>
      <main class="px-5">
        <div class="row justify-content-center bg-light px-0 pt-2">
          <div class="tab-content col-10 min-vh-100" id="tab-tabContent">
            <div class="tab-pane show active min-vh-100" id="tab-panel" role="tabpanel">
              <div class="d-flex justify-content-between my-2">
                <span class="display-5" style="font-size: xx-large !important;">
                  <strong>Panel de configuraciones</strong>
                </span>
                <a href="#" class="mt-2 pt-1" style="color:tomato;">
                  Cambiar contraseña maestra
                </a>
              </div>
              
              <div class="row align-items-center justify-content-center" style="min-height:75vh !important;">
                <div class="col-10">
                  <div class="row gy-2 justify-content-center align-items-center">
                    <div class="col col-12 col-sm-12 col-md-5 col-lg-5 col-xl-3 mx-1 btn btn-outline-warning align-middle pt-5" style="height: 180px !important;" onclick="mostrarTab('tab-categoria','tab-panel')">
                      <span class="display-6 text-center">Categorias</span>
                    </div>
                    <div class="col col-12 col-sm-12 col-md-5 col-lg-5 col-xl-3 mx-1 align-middle btn btn-outline-warning pt-5" style="height: 180px !important;" onclick="mostrarTab('tab-estilo','tab-panel')">
                      <span class="display-6 text-center">Estilos</span>
                    </div>
                    <div class="col col-12 col-sm-12 col-md-5 col-lg-5 col-xl-3 mx-1 align-middle btn btn-outline-warning pt-5" style="height: 180px !important;" onclick="mostrarTab('tab-tallas','tab-panel')">
                      <span class="display-6 text-center">Tallas</span>
                    </div>
                    <div class="col col-12 col-sm-12 col-md-5 col-lg-5 col-xl-3 mx-1 align-middle btn btn-outline-warning pt-5" style="height: 180px !important;" onclick="mostrarTab('tab-roles','tab-panel')">
                      <span class="display-6 text-center">Roles</span>
                    </div>
                    <div class="col col-12 col-sm-12 col-md-5 col-lg-5 col-xl-3 mx-1 align-middle btn btn-outline-warning pt-5" style="height: 180px !important;" onclick="mostrarTab('tab-cargos','tab-panel')">
                      <span class="display-6 text-center">Cargos</span>
                    </div>
                    <div class="col col-12 col-sm-12 col-md-5 col-lg-5 col-xl-3 mx-1 align-middle btn btn-outline-warning pt-5" style="height: 180px !important;">
                      <span class="display-6 text-center">Empresa</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade min-h-100" id="tab-categoria" role="tabpanel" aria-labelledby="tab-categoria-tab">
              <div class="d-flex justify-content-between my-2">
                <span class="display-6" style="font-size: xx-large !important;">
                  Categorias
                </span>
                <span>
                  <a href="#" href="" class="btn btn-outline-secondary" onclick="mostrarTab('tab-panel','tab-categoria')">
                    <i class="zmdi zmdi-arrow-left"></i>
                  </a>
                  <a href="" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalIngresar" onclick="modificarModalIngresar('categoria')">
                    <i class="zmdi zmdi-plus"></i>
                  </a>
                </span>
              </div>
              
              <div class="container-fluid">
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
            
            <div class="tab-pane fade min-h-100" id="tab-estilo" role="tabpanel" aria-labelledby="tab-estilo-tab">
              <div class="d-flex justify-content-between my-2">
                <span class="display-6" style="font-size: xx-large !important;">
                  Estilos
                </span>
                <span>
                  <a href="#" href="" class="btn btn-outline-secondary" onclick="mostrarTab('tab-panel','tab-estilo')">
                    <i class="zmdi zmdi-arrow-left"></i>
                  </a>
                  <a href="" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalIngresar" onclick="modificarModalIngresar('estilo')">
                      <i class="zmdi zmdi-plus"></i>
                  </a>
                </span>
              </div>
              
              <div class="container-fluid">
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

            <div class="tab-pane fade min-h-100" id="tab-tallas" role="tabpanel" aria-labelledby="tab-tallas-tab">
              <div class="d-flex justify-content-between my-2">
                <span class="display-6" style="font-size: xx-large !important;">
                  Tallas
                </span>
                <span>
                  <a href="#" href="" class="btn btn-outline-secondary" onclick="mostrarTab('tab-panel','tab-tallas')">
                    <i class="zmdi zmdi-arrow-left"></i>
                  </a>
                  <a href="" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalIngresar" onclick="modificarModalIngresar('talla')">
                    <i class="zmdi zmdi-plus"></i>
                  </a>
                </span>
              </div>
              
              <div class="container-fluid">
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

            <div class="tab-pane fade min-h-100" id="tab-roles" role="tabpanel">
              <div class="d-flex justify-content-between my-2">
                <span class="display-6" style="font-size: xx-large !important;">
                  Roles
                </span>
                <span>
                  <div>
                    <a href="#" class="btn btn-outline-secondary" onclick="mostrarTab('tab-panel','tab-roles')">
                      <i class="zmdi zmdi-arrow-left"></i>
                    </a>
                    <a title="Agregar" class="btn btn-outline-warning" 
                    onclick="intercalarBotones('formRol2',true);limpiarFormulario('formRol');limpiarFormulario('formPermisos')"
                    data-bs-toggle="modal" data-bs-target="#modalRol">
                      <i class="zmdi zmdi-plus"></i>
                    </a>
                  </div>
                </span>
              </div>
              
              <div class="row">
                <div class="table-responsive">
                  <table class="table table-hover text-center" id="tableRol">
                    <thead class="table-light" style="border: none !important;">
                      <tr>
                        <th scope="col" class="align-middle" rowspan="2">Rol</th>
                        <th scope="col" class="align-middle" colspan="9">Permisos</th>
                        <th scope="col" class="align-middle" rowspan="2">Modificar</th>
                        <th scope="col" class="align-middle" rowspan="2">Eliminar</th>
                      </tr>
                      <tr>
                        <td scope="col" class="align-middle">Empleado</td>
                        <td scope="col" class="align-middle">Clientes</td>
                        <td scope="col" class="align-middle">Inventario</td>
                        <td scope="col" class="align-middle">Guia Remision</td>
                        <td scope="col" class="align-middle">Bodega</td>
                        <td scope="col" class="align-middle">Catalogo</td>
                        <td scope="col" class="align-middle">Cotizacion</td>
                        <td scope="col" class="align-middle">Ordenes</td>
                        <td scope="col" class="align-middle">Configuracion</td>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="tab-pane fade min-h-100" id="tab-cargos" role="tabpanel">
              <div class="d-flex justify-content-between my-2">
                <span class="display-6" style="font-size: xx-large !important;">
                  Cargos
                </span>
                <span>
                  <a href="#" href="" class="btn btn-outline-secondary" onclick="mostrarTab('tab-panel','tab-cargos')">
                    <i class="zmdi zmdi-arrow-left"></i>
                  </a>
                  <a href="" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalIngresar" onclick="modificarModalIngresar('cargo')">
                      <i class="zmdi zmdi-plus"></i>
                  </a>
                </span>
              </div>
              
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

          </div>
        </div>
      </main>
    </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalRol" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalRolLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalRolLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="formRol">
              <input type="hidden" name="id" id="idRol">
              <div class="col-6 input-group mb-2">
                    <input type="text" class="form-control" id="rol" name="rol" placeholder="Rol">
              </div>
              <div class="col-6 input-group mb-2">
                    <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion">
              </div>
              <input type="hidden" name="empleado" id="empleados" value="0">
              <input type="hidden" name="cliente" id="clientes" value="0">
              <input type="hidden" name="inventario" id="inventario" value="0">
              <input type="hidden" name="guiaRemision" id="guiaRemision" value="0">
              <input type="hidden" name="bodega" id="bodegas" value="0">
              <input type="hidden" name="catalogo" id="catalogo" value="0">
              <input type="hidden" name="cotizacion" id="cotizacion" value="0">
              <input type="hidden" name="pedido" id="pedido" value="0">
              <input type="hidden" name="configuracion" id="configuracion" value="0">
            </form>
            <form id="formPermisos">
              <table class="table table-hover text-center">
                <thead>
                  <tr>
                    <th>Modulo</th>
                    <th>Lectura</th>
                    <th>Edicion</th>
                    <th>Gestion</th>
                    <th>Alta Gestion</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                  <tr>
                    <td>Empleados</td>
                    <td>
                    <div class="d-flex justify-content-center form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="empleadosLector"
                      value="1" onchange="otorgarPermiso(this,'empleados')">
                    </div>
                    </td>
                    <td>
                    <div class="d-flex justify-content-center form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="empleadosEditor" 
                      onchange="intercalarPermiso(this,'empleados');otorgarPermiso(this,'empleados')" value="2">
                    </div>
                    </td>
                    <td>
                    <div class="d-flex justify-content-center form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="empleadosGestor" 
                      onchange="intercalarPermiso(this,'empleados');otorgarPermiso(this,'empleados')" value="3">
                    </div>
                    </td>
                    <td>
                    <div class="d-flex justify-content-center form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="empleadosAdministrador" 
                      onchange="intercalarPermiso(this,'empleados');otorgarPermiso(this,'empleados')" value="4">
                    </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Clientes</td>
                    <td>
                    <div class="d-flex justify-content-center form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="clientesLector"
                      value="1" onchange="otorgarPermiso(this,'clientes')">
                    </div>
                    </td>
                    <td>
                    <div class="d-flex justify-content-center form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="clientesEditor"
                      onchange="intercalarPermiso(this,'clientes');otorgarPermiso(this,'clientes')" value="2">
                    </div>
                    </td>
                    <td>
                    <div class="d-flex justify-content-center form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="clientesGestor" 
                      onchange="intercalarPermiso(this,'clientes');otorgarPermiso(this,'clientes')" value="3">
                    </div>
                    </td>
                    <td>
                    <div class="d-flex justify-content-center form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="clientesAdministrador" 
                      onchange="intercalarPermiso(this,'clientes');otorgarPermiso(this,'clientes')" value="4">
                    </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Inventario</td>
                    <td>
                    <div class="d-flex justify-content-center form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="inventarioLector"
                      value="1" onchange="otorgarPermiso(this,'inventario')">
                    </div>
                    </td>
                    <td>
                    <div class="d-flex justify-content-center form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="inventarioEditor"
                      onchange="intercalarPermiso(this,'inventario');otorgarPermiso(this,'inventario')" value="2">
                    </div>
                    </td>
                    <td>
                    <div class="d-flex justify-content-center form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="inventarioGestor" 
                      onchange="intercalarPermiso(this,'inventario');otorgarPermiso(this,'inventario')" value="3">
                    </div>
                    </td>
                    <td>
                    <div class="d-flex justify-content-center form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="inventarioAdministrador" 
                      onchange="intercalarPermiso(this,'inventario');otorgarPermiso(this,'inventario')" value="4">
                    </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Guia Remision</td>
                    <td>
                    <div class="d-flex justify-content-center form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="guiaRemisionLector"
                      value="1" onchange="otorgarPermiso(this,'guiaRemision')">
                    </div>
                    </td>
                    <td>
                    <div class="d-flex justify-content-center form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="guiaRemisionEditor"
                      onchange="intercalarPermiso(this,'guiaRemision');otorgarPermiso(this,'guiaRemision')" value="2">
                    </div>
                    </td>
                    <td>
                    <div class="d-flex justify-content-center form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="guiaRemisionGestor" 
                      onchange="intercalarPermiso(this,'guiaRemision');otorgarPermiso(this,'guiaRemision')" value="3">
                    </div>
                    </td>
                    <td>
                    <div class="d-flex justify-content-center form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="guiaRemisionAdministrador" 
                      onchange="intercalarPermiso(this,'guiaRemision');otorgarPermiso(this,'guiaRemision')" value="4">
                    </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Bodega</td>
                    <td>
                    <div class="d-flex justify-content-center form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="bodegasLector"
                      value="1" onchange="otorgarPermiso(this,'bodegas')">
                    </div>
                    </td>
                    <td>
                    <div class="d-flex justify-content-center form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="bodegasEditor"
                      onchange="intercalarPermiso(this,'bodegas');otorgarPermiso(this,'bodegas')" value="2">
                    </div>
                    </td>
                    <td>
                    <div class="d-flex justify-content-center form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="bodegasGestor" 
                      onchange="intercalarPermiso(this,'bodegas');otorgarPermiso(this,'bodegas')" value="3">
                    </div>
                    </td>
                    <td>
                    <div class="d-flex justify-content-center form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="bodegasAdministrador" 
                      onchange="intercalarPermiso(this,'bodegas');otorgarPermiso(this,'bodegas')" value="4">
                    </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Catalogo</td>
                    <td>
                    <div class="d-flex justify-content-center form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="catalogoLector"
                      value="1" onchange="otorgarPermiso(this,'catalogo')">
                    </div>
                    </td>
                    <td>
                    <div class="d-flex justify-content-center form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="catalogoEditor"
                      onchange="intercalarPermiso(this,'catalogo');otorgarPermiso(this,'catalogo')" value="2">
                    </div>
                    </td>
                    <td>
                    <div class="d-flex justify-content-center form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="catalogoGestor" 
                      onchange="intercalarPermiso(this,'catalogo');otorgarPermiso(this,'catalogo')" value="3">
                    </div>
                    </td>
                    <td>
                    <div class="d-flex justify-content-center form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="catalogoAdministrador" 
                      onchange="intercalarPermiso(this,'catalogo');otorgarPermiso(this,'catalogo')" value="4">
                    </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Cotizacion</td>
                    <td>
                    <div class="d-flex justify-content-center form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="cotizacionLector"
                      value="1" onchange="otorgarPermiso(this,'cotizacion')">
                    </div>
                    </td>
                    <td>
                    <div class="d-flex justify-content-center form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="cotizacionEditor"
                      onchange="intercalarPermiso(this,'cotizacion');otorgarPermiso(this,'cotizacion')" value="2">
                    </div>
                    </td>
                    <td>
                    <div class="d-flex justify-content-center form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="cotizacionGestor" 
                      onchange="intercalarPermiso(this,'cotizacion');otorgarPermiso(this,'cotizacion')" value="3">
                    </div>
                    </td>
                    <td>
                    <div class="d-flex justify-content-center form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="cotizacionAdministrador" 
                      onchange="intercalarPermiso(this,'cotizacion');otorgarPermiso(this,'cotizacion')" value="4">
                    </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Ordenes</td>
                    <td>
                    <div class="d-flex justify-content-center form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="pedidoLector"
                      value="1" onchange="otorgarPermiso(this,'pedido')">
                    </div>
                    </td>
                    <td>
                    <div class="d-flex justify-content-center form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="pedidoEditor"
                      onchange="intercalarPermiso(this,'pedido');otorgarPermiso(this,'pedido')" value="2">
                    </div>
                    </td>
                    <td>
                    <div class="d-flex justify-content-center form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="pedidoGestor" 
                      onchange="intercalarPermiso(this,'pedido');otorgarPermiso(this,'pedido')" value="3">
                    </div>
                    </td>
                    <td>
                    <div class="d-flex justify-content-center form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="pedidoAdministrador" 
                      onchange="intercalarPermiso(this,'pedido');otorgarPermiso(this,'pedido')" value="4">
                    </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Configuracion</td>
                    <td>
                    <div class="d-flex justify-content-center form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="configuracionLector"
                      value="1" onchange="otorgarPermiso(this,'configuracion')">
                    </div>
                    </td>
                    <td>
                    <div class="d-flex justify-content-center form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="configuracionEditor"
                      onchange="intercalarPermiso(this,'configuracion');otorgarPermiso(this,'configuracion')" value="2">
                    </div>
                    </td>
                    <td>
                    <div class="d-flex justify-content-center form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="configuracionGestor" 
                      onchange="intercalarPermiso(this,'configuracion');otorgarPermiso(this,'configuracion')" value="3">
                    </div>
                    </td>
                    <td>
                    <div class="d-flex justify-content-center form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="configuracionAdministrador" 
                      onchange="intercalarPermiso(this,'configuracion');otorgarPermiso(this,'configuracion')" value="4">
                    </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>
          <div class="modal-footer">
            <form class="d-flex" id="formRol2">
            <a class="mx-1 btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</a>
            <a class="mx-1 btn btn-outline-warning" onclick="guardarRol(this)"
            data-bs-dismiss="modal">Agregar</a>
            <a class="mx-1 btn btn-outline-success btn-block" onclick="confirmarModificarRol(this)" style="display: none !important;"
            data-bs-dismiss="modal">Modificar</a>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modalIngresar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div id="body">
          
          </div>
        </div>
      </div>
    </div>
    <footer>
      <script src="js/controladores/CRUD.js"></script>
      <script src="js/controladores/Settings/others.js"></script>
      <script src="js/controladores/Settings/categorias.js"></script>
      <script src="js/controladores/Settings/cargos.js"></script>
      <script src="js/controladores/Settings/roles.js"></script>
      <script>
        refrescarTablaCategoria()
        refrescarTablaEstilo()
        refrescarTablaTalla()
        refrescarTablaCargo()
        refrescarTablaRol()
        intercalarBotones("formCategoria", true)
      </script>
    </footer>
    <?php include_once('canvas.php'); ?>
  </body>

</html>