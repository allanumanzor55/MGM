const URL_GUIA = '../Backend/api/guiaRemision.php'
const D_GUIA = { idForm: 'formGuiaRemision' }
let centinelaMateriales = false,
    centinelaMateriaPrima = false
let datosMateriales, datosMateriaPrima,
    datosMaterialesSeleccionados = [],
    datosMateriaPrimaSelecionada = []
    /**Array Materiales que se han agregado a la guia de remision (contienen el id y cantidad en un json) */
let materialesAgregados = []
    /**Array Materias Primas que se han agregado a la guia de remision (contienen el id y cantidad en un json) */
let materiasPrimasAgregadas = []
    /**Array de los datos de los  Materiales que se han agregado a la guia de remision (contienen toda la info en json) */
async function generarGuia(btn) {
    if (centinelaMateriaPrima || centinelaMateriales) {
        document.getElementById('materiales').value = JSON.stringify(materialesAgregados)
        document.getElementById('materiaPrima').value = JSON.stringify(materiasPrimasAgregadas)
        document.getElementById('bodegaSalida').disabled = false
        await guardar(btn, URL_GUIA, D_GUIA)
        limpiarVariables()
        await refrescarTableGuia(URL_GUIA, {})
        mostrarTab('tab-ingresar', 'tab-guias')
    } else {
        Swal.fire({ icon: 'warning', title: "Hey!", text: "Agregue los Materiales/Materias Primas que se trasaladaran" })
    }
}

async function mostrarMaterialesGuia(idGuia) {
    mostrarTab('tab-materiales', 'tab-guias')
    const datos = await obtener(URL_GUIA, { id: idGuia })
    const { materiales } = datos
    document.getElementById('cardMaterialesGuia').innerHTML = ``
    materiales.forEach(mat => {
        document.getElementById('cardMaterialesGuia').innerHTML +=
            `<div class="row m-2 p-0 align-items-center border rounded">
                    <div class="col-lg-3">
                        <img src="img/Material.jpg" class="img-fluid">
                    </div>
                    <div class="col-12 col-lg-9">
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
                                <a title="Quitar material" class="btn btn-outline-danger 
                                zmdi zmdi-delete"></a>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>`
    });
}

async function mostrarMateriaPrimaGuia(idGuia) {
    mostrarTab('tab-materiasPrimas', 'tab-guias')
    const datos = await obtener(URL_GUIA, { id: idGuia })
    const { materiaPrima } = datos
    document.getElementById('cardMateriaPrimaGuia').innerHTML = ``
    materiaPrima.forEach(prim => {
        document.getElementById('cardMateriaPrimaGuia').innerHTML +=
            `<div class="row m-2 p-0 align-items-center border rounded">
                        <div class="col-lg-3">
                            <img src="img/Prima.jpg" class="img-fluid">
                        </div>
                        <div class="col-12 col-lg-9">
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
                                    <td colspan="3">${prim.cantidad}</td>
                                </tr>
                            </table>
                            <div class="d-flex justify-content-between mb-2">
                                <div>
                                </div>
                                <div>
                                <a title="Quitar Materia" 
                                class="btn btn-outline-danger zmdi zmdi-delete" ></a>
                                </div>
                            </div>
                        </div>
                        </div>
            </div>`
    })

}