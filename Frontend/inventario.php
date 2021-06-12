<?php include_once('validation.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="css/landing-styles.css">
    <title>Inventario</title>
  </head>
  <body id="bg-landing" class="container-fluid px-0">
    <div class="container-fluid bg-opacity min-h-100 min-w-100">
      <header>
        <?php include_once('nav.php'); ?>
      </header>
      <div class="row" style="min-height: 8.1vh !important;"></div>
      <main class="row px-5">
        <div class="container vw-100 min-vh-100 bg-light pt-1">
          <div class="table-responsive align-items-start bg-light min-vh-100 pt-2">
              <ul class="nav nav-pills mb-3" id="pills-tabInventario" role="tablist">
                  <li class="nav-item" role="presentation">
                              <button class="nav-link nav-link-mg-2 active" id="inventarioMateriaPrimaTab" data-bs-toggle="pill"
                              data-bs-target="#tabContentInventarioMateriaPrima" type="button" role="tab"
                              aria-controls="inventarioMateriaPrima" aria-selected="true">Materia prima</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link nav-link-mg-2" id="inventarioMaterialesTab" data-bs-toggle="pill"
                    data-bs-target="#tabContentInventarioMateriales" type="button" role="tab"
                    aria-controls="inventarioMateriales" aria-selected="false">Materiales</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link nav-link-mg-2" id="inventarioHerramientasTab" data-bs-toggle="pill"
                    data-bs-target="#tabContentInventarioHerramientas" type="button" role="tab"
                    aria-controls="inventarioHerramientas" aria-selected="false">
                        Herramientas
                    </button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link nav-link-mg-2" id="inventarioGeneralTab" data-bs-toggle="pill"
                    data-bs-target="#tabContentInventarioGeneral" type="button" role="tab"
                    aria-controls="inventarioGeneral" aria-selected="false">
                        General
                    </button>
                  </li>
              </ul>
              <div class="tab-content min-vh-50" id="pills-tabContentInventario">
                  <!--CONTENIDO DE FORMULARIOS Y CARDS-->
                  <!--Materia Prima-->
                  <div class="tab-pane fade show active" id="tabContentInventarioMateriaPrima" role="tabpanel"
                  aria-labelledby="inventarioMateriaPrimaTab">
                    <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                      <li class="nav-item" role=" presentation">
                        <button class="nav-link nav-link-mg-1 active" id="ingresarPrima-tab" data-bs-toggle="tab" data-bs-target="#ingresarPrima" type="button" role="tab" aria-controls="ingresarPrima" aria-selected="true">Ingresar</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link nav-link-mg-1" id="cardInventarioPrima-tab" data-bs-toggle="tab" data-bs-target="#cardInventarioPrima" type="button" role="tab" aria-controls="cardInventarioPrima" aria-selected="false"
                        onclick="refrescarCardsInventario('Prima','Inventario')">Registros Inventario</button>
                      </li>
                      <li class="nav-item col ms-2" role="presentation">
                        <input type="text" class="form-control" placeholder="Buscar" id="buscarPrima" onkeyup="buscarInventario(this.value,'Prima')" onfocus="seleccionarTab('Prima',false)">
                      </li>
                    </ul>
                    <div class="tab-content min-vh-50" id="tabContentInventarioMateriaPrima">
                      <div class="tab-pane fade show active" id="ingresarPrima" role="tabpanel" aria-labelledby="ingresarPrima-tab">
                        <div class="container">
                          <form id="formInventarioPrima" class="row" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="idInventarioPrima">
                            <div class="col-12">
                                <label for="selectCategoria" class="form-label">Categoria</label>
                                <select class="form-select" name="categoria" id="selectCategoria"
                                onchange="rellenarSelectEstilo(this.value,this.options[this.selectedIndex].text)">
                                </select>
                            </div>
                            <div class="col-12">
                              <label for="selectEstilo" class="form-label">Estilo</label>
                              <select class="form-select" name="estilo" id="selectEstilo">
                              </select>
                            </div>
                            <div class="col-12" id="divTalla" style="display: none !important;">
                              <label for="selectTalla" class="form-label">Talla</label>
                              <select class="form-select" name="talla" id="selectTalla">
                              </select>
                            </div>
                            <div class="col-12">
                              <label for="selectProveedor" class="form-label">Proveedor</label>
                              <select class="form-select" name="proveedor" id="selectProveedorInvPrima">
                                <option value="1">TelMax</option>
                              </select>
                            </div>
                            <div class="col-12">
                              <label for="formFile" class="form-label">Fotografia</label>
                              <input class="form-control" type="file" name="foto" id="fotoInvPrima">
                            </div>
                            <div class="col-12">
                                <label for="descripcion" class="form-label">Descripcion</label>
                                <input type="text" class="form-control" name="descripcion" id="descripcionInvPrima">
                            </div>
                            <div class="col-12">
                                <label for="color" class="form-label">Color</label>
                                <input type="text" name="color" class="form-control" id="color">
                            </div>
                            <div class="col-12">
                              <label for="stock" class="form-label">Stock</label>
                              <input type="number" name="stock" class="form-control" id="stockInvPrima">
                          </div>
                            <div class="col-12">
                                <label for="precio" class="form-label">Precio</label>
                                <input type="number" name="precio" class="form-control" id="precioInvPrima">
                            </div>
                            <div class="row justify-content-center my-3">
                              <div class="col-5">
                                <a class="btn btn-outline-danger btn-block" onclick="guardarInventario(this,'Prima')" style="display: block !important">Guardar</a>
                                <a class="btn btn-outline-success btn-block" onclick="confirmarModificarInventario(this,'Prima')" style="display: none !important;">Modificar</a>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                      <div class="tab-pane fade min-vh-50" id="cardInventarioPrima" role="tabpanel" aria-labelledby="cardInventarioPrima-tab">
                        
                      </div>
                    </div>
                  </div>
                  <!--Materiales-->
                  <div class="tab-pane fade show" id="tabContentInventarioMateriales" role="tabpanel"
                  aria-labelledby="inventarioMateriaPrimaTab">
                    <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                      <li class="nav-item" role=" presentation">
                        <button class="nav-link nav-link-mg-1 active" id="ingresarMaterial-tab" data-bs-toggle="tab" data-bs-target="#ingresarMaterial" type="button" role="tab" aria-controls="ingresar" aria-selected="true">Ingresar</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link nav-link-mg-1" id="cardInventarioMaterial-tab" data-bs-toggle="tab" data-bs-target="#cardInventarioMaterial" type="button" role="tab" aria-controls="cardInventario" aria-selected="false"
                        onclick="refrescarCardsInventario('Material','Inventario')">Registros Materiales</button>
                      </li>
                      <li class="nav-item col ms-2" role="presentation">
                        <input type="text" class="form-control" placeholder="Buscar" id="buscarMaterial" onkeyup="buscarInventario(this.value,'Material')" onfocus="seleccionarTab('Material',false)">
                      </li>
                    </ul>
                    <div class="tab-content min-vh-50" id="myTabContent">
                      <div class="tab-pane fade show active min-vh-50" id="ingresarMaterial" role="tabpanel" aria-labelledby="ingresarMaterial-tab">
                        <div class="container">
                          <form id="formInventarioMaterial" class="row g-3" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="idInventarioMaterial">
                            <div class="col-12">
                              <label for="selectProveedor" class="form-label">Proveedor</label>
                              <select class="form-select" name="proveedor" id="selectProveedorInvMaterial">
                                <option value="1">TelMax</option>
                              </select>
                            </div>
                            <div class="col-12">
                              <label for="formFile" class="form-label">Fotografia</label>
                              <input class="form-control" type="file" name="foto" id="fotoInvMaterial">
                            </div>
                            <div class="col-12">
                                <label for="descripcion" class="form-label">Descripcion</label>
                                <input type="text" class="form-control" name="descripcion" id="descripcionInvMaterial">
                            </div>
                            <div class="col-12">
                                <label for="marca" class="form-label">Marca</label>
                                <input type="text" name="marca" class="form-control" id="marca">
                            </div>
                            <div class="col-12">
                              <label for="stock" class="form-label">Stock</label>
                              <input type="number" name="stock" class="form-control" id="stockInvMaterial">
                          </div>
                            <div class="col-12">
                                <label for="precio" class="form-label">Precio</label>
                                <input type="number" name="precio" class="form-control" id="precioInvMaterial">
                            </div>
                            <div class="row justify-content-center my-3">
                              <div class="col-5">
                                <a class="btn btn-outline-danger btn-block" onclick="guardarInventario(this,'Material')" style="display: block !important">Guardar</a>
                                <a class="btn btn-outline-success btn-block" onclick="confirmarModificarInventario(this,'Material')" style="display: none !important;">Modificar</a>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                      <div class="tab-pane fade min-vh-50" id="cardInventarioMaterial" role="tabpanel" aria-labelledby="cardInventarioMat-tab">
                      </div>
                    </div>
                  </div>
                  <!--Herramientas-->
                  <div class="tab-pane fade show" id="tabContentInventarioHerramientas" role="tabpanel"
                  aria-labelledby="inventarioMateriaPrimaTab">
                    <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                      <li class="nav-item" role=" presentation">
                        <button class="nav-link nav-link-mg-1 active" id="ingresarHerramienta-tab" data-bs-toggle="tab" data-bs-target="#ingresarHerramienta" type="button" role="tab" aria-controls="ingresar" aria-selected="true">Ingresar</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link nav-link-mg-1" id="cardInventarioHerramienta-tab" data-bs-toggle="tab" data-bs-target="#cardInventarioHerramienta" type="button" role="tab" aria-controls="cardInventario" aria-selected="false"
                        onclick="refrescarCardsInventario('Herramienta','Inventario')">Registros Herramientas</button>
                      </li>
                      <li class="nav-item col ms-2" role="presentation">
                        <input type="text" class="form-control" placeholder="Buscar" id="buscarHerramienta" onkeyup="buscarInventario(this.value,'Herramienta')" onfocus="seleccionarTab('Herramienta',false)">
                      </li>
                    </ul>
                    <div class="tab-content min-vh-50" id="myTabContent">
                      <div class="tab-pane fade show active" id="ingresarHerramienta" role="tabpanel" aria-labelledby="ingresarHerramienta-tab">
                        <div class="container">
                          <form id="formInventarioHerramienta" class="row g-3" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="idInventarioHerramienta">
                            <div class="col-12">
                              <label for="selectProveedor" class="form-label">Proveedor</label>
                              <select class="form-select" name="proveedor" id="selectProveedorInvHerramienta">
                                <option value="1">TelMax</option>
                              </select>
                            </div>
                            <div class="col-12">
                              <label for="formFile" class="form-label">Fotografia</label>
                              <input class="form-control" type="file" name="foto" id="fotoInvHerramienta">
                            </div>
                            <div class="col-12">
                                <label for="descripcion" class="form-label">Descripcion</label>
                                <input type="text" class="form-control" name="descripcion" id="descripcionInvHerramienta">
                            </div>
                            <div class="col-12">
                                <label for="marca" class="form-label">Marca</label>
                                <input type="text" name="marca" class="form-control" id="marcaInvHerramienta">
                            </div>
                            <div class="col-12">
                              <label for="stock" class="form-label">Stock</label>
                              <input type="number" name="stock" class="form-control" id="stockInvHerramienta">
                            </div>
                            <div class="row justify-content-center my-3">
                              <div class="col-5">
                                <a class="btn btn-outline-danger btn-block" onclick="guardarInventario(this,'Herramienta')" style="display: block !important">Guardar</a>
                                <a class="btn btn-outline-success btn-block" onclick="confirmarModificarInventario(this,'Herramienta')" style="display: none !important;">Modificar</a>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                      <div class="tab-pane fade min-vh-50" id="cardInventarioHerramienta" role="tabpanel" aria-labelledby="cardInventarioHerramienta-tab">
                      </div>
                    </div>
                  </div>
                  <!--General-->
                  <div class="tab-pane fade show" id="tabContentInventarioGeneral" role="tabpanel"
                  aria-labelledby="inventarioMateriaPrimaTab">
                    <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                      <li class="nav-item" role=" presentation">
                        <button class="nav-link nav-link-mg-1 active" id="ingresarGeneral-tab" data-bs-toggle="tab" data-bs-target="#ingresarGeneral" type="button" role="tab" aria-controls="ingresar" aria-selected="true">Ingresar</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link nav-link-mg-1" id="cardInventarioGeneral-tab" data-bs-toggle="tab" data-bs-target="#cardInventarioGeneral" type="button" role="tab" aria-controls="cardInventario" aria-selected="false"
                        onclick="refrescarCardsInventario('General','Inventario')">Registros Inventario General</button>
                      </li>
                      <li class="nav-item col ms-2" role="presentation">
                        <input type="text" class="form-control" placeholder="Buscar" id="buscarGeneral" onkeyup="buscarInventario(this.value,'General')" onfocus="seleccionarTab('General',false)">
                      </li>
                    </ul>
                    <div class="tab-content min-vh-50" id="myTabContent">
                      <div class="tab-pane fade show active" id="ingresarGeneral" role="tabpanel" aria-labelledby="ingresarGeneral-tab">
                        <div class="container">
                          <form id="formInventarioGeneral" class="row g-3" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="idInventarioGeneral">
                            <div class="col-12">
                              <label for="formFile" class="form-label">Fotografia</label>
                              <input class="form-control" type="file" name="foto" id="fotoInvGeneral">
                            </div>
                            <div class="col-12">
                                <label for="descripcion" class="form-label">Descripcion</label>
                                <input type="text" class="form-control" name="descripcion" id="descripcionInvGeneral">
                            </div>
                            <div class="col-12">
                              <label for="stock" class="form-label">Stock</label>
                              <input type="number" name="stock" class="form-control" id="stockInvGeneral">
                            </div>
                            <div class="row justify-content-center my-3">
                              <div class="col-5">
                                <a class="btn btn-outline-danger btn-block" onclick="guardarInventario(this,'General')" style="display: block !important">Guardar</a>
                                <a class="btn btn-outline-success btn-block" onclick="confirmarModificarInventario(this,'General')" style="display: none !important;">Modificar</a>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                      <div class="tab-pane fade min-vh-50" id="cardInventarioGeneral" role="tabpanel" aria-labelledby="cardInventarioPrima-tab">
                      </div>
                    </div>
                  </div>
              </div>
          </div>
        </div>
      </main>
    </div>
    <div class="modal fade" id="inventarioModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Informacion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="datosInventario">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
    </div>
    <footer>
      <?php include_once('footer.php'); ?>
      <script src="js/controladores/CRUD.js"></script>
      <script src="js/controladores/Settings/categorias.js"></script>
      <script src="js/controladores/inventario.js"></script>
      <script>
        rellenarSelect()
        rellenarSelectEstilo()
        rellenarSelectTalla()
        intercalarBotones("formCategoria",true)
      </script>
    </footer>
    <?php include_once('canvas.php');?>
  </body>
</html>