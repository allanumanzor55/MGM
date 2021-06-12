/**
 * Rellena el acordeon de bootstrap relacionado a materiales, se usa para refrescar los materieales agregados
 * o eliminados
 */
function rellenarAcordionMateriales(idAcordion){
    document.getElementById(idAcordion).innerHTML=``
    jsonMateriales.forEach(function(mat,index){
        document.getElementById(idAcordion).innerHTML+=
        `<div class="row m-2 align-items-center border rounded">
            <div class="col-3">
                <img src="img/Material.jpg" class="img-fluid">
            </div>
            <div class="col-9">
                <div class="table-responsive mt-4">
                    <table class="table table-hover caption-bottom">
                        <tr rowspan="3">
                        </tr>
                        <tr>
                            <th>Descripcion</th>
                            <td colspan="3">${mat.descripcion}</td>
                        </tr>
                        <tr>
                            <th>Marca</th>
                            <td colspan="3">${mat.marca}</td>
                        </tr>
                        <tr>
                            <th>Precio</th>
                            <td colspan="3">${mat.precio}</td>
                        </tr>
                        <tr>
                            <th>Proveedor</th>
                            <td colspan="3">${mat.empresa}</td>
                        </tr>
                        <tr>
                            <th>Cantidad</th>
                            <td colspan="3">${mat.cantidad}</td>
                        </tr>
                    </table>
                    <div class="d-flex justify-content-between mb-2">
                        <div>
                        </div>
                        <div>
                        <a title="Quitar material" class="btn btn-outline-danger  zmdi  zmdi-delete" onclick="quitarMaterial(${index})"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>`
    })
}

/**
 * Rellena el acordeon de materia prima al agregar o eliminar el elementos seleccionado
 */
function rellenarAcordionPrima(){
    document.getElementById('datosPrima').innerHTML=
    `<div class="col-3">
        <img src="img/Prima.jpg" class="img-fluid">
    </div>
    <div class="col-9">
        <div class="table-responsive mt-4">
            <table class="table table-hover caption-bottom">
                <tr>
                    <th>Descripcion</th>
                    <td colspan="4">${jsonMateriaPrima.descripcion}</td>
                </tr>
                <tr>
                    <th>Categoria</th>
                    <td>${jsonMateriaPrima.tipo} ${jsonMateriaPrima.material}</td>
                    <th>Estilo</th>
                    <td>${jsonMateriaPrima.estilo}</td>
                </tr>
                <tr>
                    <th>Talla</th>
                    <td>${jsonMateriaPrima.talla}</td>
                    <th>Proveedor</th>
                    <td>${jsonMateriaPrima.empresa}</td>
                </tr>
            </table>
            <div class="d-flex justify-content-between mb-2">
                <div>
                </div>
                <div>
                <a title="Quitar Materia"  class="btn btn-outline-danger  zmdi  zmdi-delete" onclick="quitarMateriaFichaProducto()"></a>
                </div>
            </div>
        </div>
    </div>`
}

/**
 * Refresca el acordeon de productos
 */
async function refrescarAcordionFichaProducto(btn){
    try {
        let datosFichaProducto = await obtener(URL_PRODUCTO,{})
        rellenarAcordionFichaProducto(datosFichaProducto)
    }catch (error) {
        Swal.fire({ icon: 'error', title: "Algo salio mal... ", text: error.message})
    }
}

/**
 * rellena el acordeon de la ficha de productos al realizar cualquier accion
 */
function rellenarAcordionFichaProducto(datosFichaProducto){
    document.getElementById('cardFichaProducto').innerHTML=``
    datosFichaProducto.forEach(function(producto,index){
        actualizarJsonMateriales(producto)
        document.getElementById('cardFichaProducto').innerHTML+=
        `<div class="row m-2 align-items-center border rounded">
            <div class="col-3">
                <img src="img/FichaProducto.jpg" class="img-fluid">
            </div>
            <div class="col-9">
                <div class="table-responsive mt-4">
                    <table class="table table-hover">
                        <tr>
                            <th>Descripcion FichaProducto</th>
                            <td colspan="3">${producto.descripcionFicha}</td>
                        </tr>
                        <tr>
                            <th>Descripcion Materia Prima</th>
                            <td colspan="3">${producto.descripcionMateriaPrima}</td>
                        </tr>
                        <tr>
                            <th>Categoria</th>
                            <td>${producto.tipo+" "+producto.material}</td>
                            <th>Estilo</th>
                            <td>${producto.estilo}</td>
                        </tr>
                        <tr>
                            <th>Talla</th>
                            <td>${producto.talla}</td>
                            <th>Color</th>
                            <td>${producto.color}</td>
                        </tr>
                        <tr>
                            <th>Precio</th>
                            <td>${producto.precio}</td>
                            <td colspan="2"></td>
                        </tr>
                    </table>
                    <div class="d-flex justify-content-between mb-2">
                        <div>
                            <a title="Ver materiales" class="btn btn-outline-warning  zmdi  zmdi-archive mx-1"
                            data-bs-toggle="modal" data-bs-target="#materialesFichaProductoModal"
                            onclick="verMaterialesFichaProducto(${producto.idFichaProducto})"></a>
                        </div>
                        <div>
                            <a  title="Actualizar" class="btn btn-outline-success  zmdi  zmdi-refresh mx-1"
                            onclick="modificarFichaProducto(${producto.idFichaProducto})"></a>
                            <a title="Eliminar" class="btn btn-outline-danger  zmdi  zmdi-delete mx-1" 
                            onclick="eliminarFichaProducto(this,${producto.idFichaProducto})"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>`
    })
}

async function actualizarJsonMateriales(producto){
    let jsonMat = {idFichaProducto:0,materiales:""}
    jsonMat.idFichaProducto = producto.idFichaProducto
    jsonMat.materiales=producto.materiales
    jsonMaterialesFichaProductos.push(jsonMat)
}

/**
 * Funcion que muestra los materiales que se usan en un producto ya ingresado
 */
function verMaterialesFichaProducto(id){
    document.getElementById('tablaMateriales').innerHTML=``
    document.getElementById('materialesModalTitulo').innerHTML = "Materiales"
    jsonMateriales = jsonMaterialesFichaProductos.find(materiales=>materiales.idFichaProducto==id)
    jsonMateriales.materiales.forEach(function(m,index){
        document.getElementById('tablaMateriales').innerHTML+=
        `<div class="row mx-2 mt-1 p-0 align-items-center border rounded">
            <div class="col-3"><img src="img/Material.jpg" class="img-fluid"></div>
            <div class="col-9">
                <div class="table-responsive mt-4">
                    <table class="table table-hover caption-bottom">
                        <tr>    <th>Descripcion</th>    <td colspan="7">${m.descripcion}</td>   </tr>
                        <tr>    <th>Marca</th>          <td colspan="3">${m.marca}</td>         
                                <th>Proveedor</th>      <td colspan="3">${m.empresa}</td>       </tr>
                        <tr>    <th>Precio</th>         <td colspan="3">${m.precio}</td>        
                                <th>Cantidad</th>       <td colspan="3">${m.cantidad}</td>      </tr>
                    </table>
                    <div class="d-flex justify-content-between mb-2">
                        <div></div>
                        <div>
                            <!--a title="Quitar material" class="btn btn-outline-danger  zmdi  zmdi-delete" onclick="quitarMaterialFichaProducto(${index})"></!--a>
                        </div>
                    </div>
                </div>
            </div>
        </div>`
    })
    
}

function abrirModalMateriales() { 
    document.getElementById('materialesModalTitulo').innerHTML = "Materiales"
    refrescarCardsInventario('Material', 'FichaProducto')
}

function abrirModalMateriaPrima() {
    document.getElementById('materialesModalTitulo').innerHTML = "Materia Prima"
    refrescarCardsInventario('Prima', 'FichaProducto')
}

/**Selecciona uno de los 2 tabs pertenecientes a producto*/
async function seleccionarTabFichaProducto(centinela){
    if(centinela){
        document.getElementById(`v-pills-producto`).classList.remove('active','show')
        document.getElementById(`v-pills-producto-tab`).classList.remove('active')
        document.getElementById(`v-pills-ingresar`).classList.add('active','show')
        document.getElementById(`v-pills-ingresar-tab`).classList.add('active')
    }else{
        document.getElementById(`v-pills-producto`).classList.add('active','show')
        document.getElementById(`v-pills-producto-tab`).classList.add('active')
        document.getElementById(`v-pills-ingresar`).classList.remove('active','show')
        document.getElementById(`v-pills-ingresar-tab`).classList.remove('active')
    }
}