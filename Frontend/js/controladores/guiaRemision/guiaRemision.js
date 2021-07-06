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
    const datos = obtener(URL_GUIA, { id: idGuia })
}

async function mostrarMateriaPrimaGuia(idGuia) {
    mostrarTab('tab-materiasPrimas', 'tab-guias')
    const datos = obtener(URL_GUIA, { id: idGuia })
}