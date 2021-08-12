async function refrescarTableGuia(permiso) {
    datos = await obtener(URL_GUIA, {})
    rellenarTableGuia(datos, permiso)
}

async function rellenarTableGuia(datos, permiso) {
    let content =
        `<thead>
            <tr>
                <th scope="col">Codigo</th>
                <th scope="col">Fecha</th>
                <th scope="col">Motivo Traslado</th>
                <th scope="col">Bodega Salida</th>
                <th scope="col">Bodega Destino</th>
                <th scope="col">Materia Prima/Materiales</th>
                ${permiso==3 || permiso==4?`<th scope="col">Eliminar</th>`:``}
            </tr>
        </thead>
        <tbody>`
    if (Array.isArray(datos)) {
        datos.forEach(guia => {
                    content +=
                        `<tr>
                    <td>${guia.codigo}</td>
                    <td>${guia.fecha}</td>
                    <td>${guia.motivoTraslado.substr(0,45)}${(guia.motivoTraslado.length>45)?'...':''}</td>
                    <td>${guia.bodegaSalida}</td>
                    <td>${guia.bodegaEntrada}</td>
                    <td>
                        <a title="Materias Primas" href="#" class="btn btn-outline-warning mx-1"
                        onclick="mostrarMateriaPrimaGuia(${guia.idGuia})"><i class="zmdi zmdi-store"></i></a>
                        <a title="Materiales" href="#" class="btn btn-outline-warning mx-1"
                        onclick="mostrarMaterialesGuia(${guia.idGuia})"><i class="zmdi zmdi-dropbox"></i></a>
                    </td>
                    ${permiso==3 || permiso==4?
                        `<td><a href="#" class="btn btn-outline-danger"><i class="zmdi zmdi-delete"></i></a></td>`:
                        ``
                    }
                    
                </tr>`
        })
    }
    document.getElementById('tableGuia').innerHTML = content;
}

/**
 * 
 * @param {String} idAcordion id del acordion de materiales que se rellenara
 */
function rellenarAcordionMateriales(idAcordion) {
    document.getElementById(idAcordion).innerHTML = ``
    datosMaterialesSeleccionados.forEach(function(mat, index) {
        let mt = materialesAgregados[materialesAgregados.findIndex(el => el.id === mat.idInventario)]
        if (typeof(mt) != "undefined") {
            mt = mt.cantidad
        }
        document.getElementById(idAcordion).innerHTML +=
            `<div class="row m-2 p-0 align-items-center border rounded">
                    <div class="col-lg-3">
                        <img src="img/Material.jpg" class="img-fluid">
                    </div>
                    <div class="col-lg-9">
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
                                    <td colspan="3">${mt}</td>
                                </tr>
                            </table>
                            <div class="d-flex justify-content-between mb-2">
                                <div>
                                </div>
                                <div>
                                <a title="Quitar material" class="btn btn-outline-danger zmdi zmdi-delete" 
                                onclick="quitarInventarioGuia(${index},'Material')"></a>
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
function rellenarAcordionPrima(idAcordion) {
    document.getElementById(idAcordion).innerHTML = ``
    datosMateriaPrimaSelecionada.forEach(function(prim, index) {
        let mp = materiasPrimasAgregadas[materiasPrimasAgregadas.findIndex(el => el.id === prim.idInventario)]
        if (typeof(mp) != "undefined") {
            mp = mp.cantidad
        }
        document.getElementById(idAcordion).innerHTML +=
            `<div class="row m-2 p-0 align-items-center border rounded">
                        <div class="col-lg-3">
                            <img src="img/Prima.jpg" class="img-fluid">
                        </div>
                        <div class="col-9">
                        <div class="table-responsive mt-4">
                            <table class="table table-hover caption-bottom">
                                <tr>
                                    <th>Descripcion</th>
                                    <td colspan="4">${prim.descripcion}</td>
                                </tr>
                                <tr>
                                    <th>Categoria</th>
                                    <td>${prim.tipo} ${prim.material}</td>
                                    <th>Estilo</th>
                                    <td>${prim.estilo}</td>
                                </tr>
                                <tr>
                                    <th>Talla</th>
                                    <td>${prim.talla}</td>
                                    <th>Proveedor</th>
                                    <td>${prim.empresa}</td>
                                </tr>
                                <tr>
                                    <th>Cantidad</th>
                                    <td colspan="3">${mp}</td>
                                </tr>
                            </table>
                            <div class="d-flex justify-content-between mb-2">
                                <div>
                                </div>
                                <div>
                                <a title="Quitar Materia" class="btn btn-outline-danger zmdi zmdi-delete" 
                                onclick="quitarInventarioGuia(${index},'Prima')"></a>
                                </div>
                            </div>
                        </div>
                        </div>
            </div>`
    })
}

function limpiarVariables() {
    centinelaMateriaPrima = false
    centinelaMateriales = false
    materialesAgregados = []
    materiasPrimasAgregadas = []
    datosMateriaPrima = []
    datosMateriales = []
    datosMateriaPrimaSelecionada = []
    datosMaterialesSeleccionados = []
    document.getElementById('bodegaSalida').value = 0
    document.getElementById('bodegaSalida').disabled = false
    document.getElementById('cancelarGenerar').hidden = true
    document.getElementById('formGuiaRemision').querySelectorAll('input,textarea').forEach(el => el.value = "")
    document.getElementById('acordionPrima').innerHTML = ``
    document.getElementById('acordionMaterial').innerHTML = ``
}