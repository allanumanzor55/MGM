/**
 * 
 * @param {HtmlObject} btn Instancia del boton, la cual nos ayudara a desabilitarlo o habilitarlo cuando queramos
 * @param {Int} idInv Id del inventario que agregaremos a la guia de remision
 * @param {String} tipoInventario 
 * Agrega un inventario a la guia(puede ser material o prima), a parte de ello maneja las estructuras
 * de datos para los inventarios seleccionados y los que residen en el sistema
 */
async function agregarInventarioGuia(btn, idInv, tipoInventario) {
    const result =
        await Swal.fire({
            title: 'Ingresa la cantidad',
            input: 'text',
            showCancelButton: true,
            confirmButtonText: 'Agregar'
        })
    if (result.isConfirmed) {
        idInv = idInv.toString()
        if (tipoInventario == "Prima") {
            materiasPrimasAgregadas.push({ id: idInv, cantidad: result.value })
            modificarArrayDatosInventario(tipoInventario, idInv, true)
            document.getElementById('materiaPrima').value = JSON.stringify(materiasPrimasAgregadas)
            rellenarCardsInv(datosMateriaPrima, 'Prima', "guiaRemision")
            rellenarAcordionPrima(`acordionPrima`)
            centinelaMateriaPrima = true
        } else if (tipoInventario == "Material") {
            materialesAgregados.push({ id: idInv, cantidad: result.value })
            modificarArrayDatosInventario(tipoInventario, idInv, true)
            document.getElementById('materiales').value = JSON.stringify(materialesAgregados)
            rellenarCardsInv(datosMateriales, 'Material', "guiaRemision")
            rellenarAcordionMateriales(`acordionMaterial`)
            centinelaMateriales = true
        }
    }
}

/**
 * En caso que se agregue un material o materia prima, el lo quita del arreglo de inventario y lo almacena
 * en otra variable por si lo vuelve a eliminar se agregue a datos materia
 */
function modificarArrayDatosInventario(tipo, idInv, cen) {
    if (cen) {
        if (tipo == "Prima") {
            datosMateriaPrimaSelecionada.push(datosMateriaPrima.find(el => el.idInventario === idInv))
            datosMateriaPrima.splice(datosMateriaPrima.findIndex(el => el.idInventario === idInv), 1)
        } else if (tipo == "Material") {
            datosMaterialesSeleccionados.push(datosMateriales.find(el => el.idInventario === idInv))
            datosMateriales.splice(datosMateriales.findIndex(el => el.idInventario === idInv), 1)
        }
    } else {
        if (tipo == "Prima") {
            datosMateriaPrima.push(datosMateriaPrimaSelecionada.find(el => el.idInventario === idInv))
            datosMateriaPrimaSelecionada.splice(datosMateriaPrimaSelecionada.findIndex(el => el.idInventario === idInv), 1)
        } else if (tipo == "Material") {
            datosMateriales.push(datosMaterialesSeleccionados.find(el => el.idInventario === idInv))
            datosMaterialesSeleccionados.splice(datosMaterialesSeleccionados.findIndex(el => el.idInventario === idInv), 1)
        }
    }
}

/**
 * 
 * @param {int} index indice del arreglo del cual queremos eliminar la instancia
 * @param {String} tipo tipo de inventario
 * elimina la instancia seleccionada del arreglo de inventarios agregados (ya sea prima o material)
 */
function quitarInventarioGuia(index, tipo) {
    if (tipo == 'Prima') {
        let id = datosMateriaPrimaSelecionada[index].idInventario.toString()
        materiasPrimasAgregadas.splice(materiasPrimasAgregadas.findIndex(el => el.idInventario === id), 1)
        modificarArrayDatosInventario('Prima', id, false)
        rellenarAcordionPrima('acordionPrima')
    } else {
        let id = datosMaterialesSeleccionados[index].idInventario.toString()
        materialesAgregados.splice(materialesAgregados.findIndex(el => el.idInventario === id), 1)
        modificarArrayDatosInventario('Material', id, false)
        rellenarAcordionMateriales('acordionMaterial')
    }
}

/**
 * 
 * @param {HtmlObject} btn 
 * @param {String} tipoInventario 
 * Muestra los inventarios que no se han seleccionado para agregarlos a la guia de remision
 */
async function mostrarInventarioTraslado(btn, tipoInventario) {
    if (document.getElementById('bodegaSalida').value != "0") {
        btn.disabled = true
        rellenarCardsInv((tipoInventario == "Prima") ?
            datosMateriaPrima : datosMateriales, tipoInventario, "guiaRemision")
        btn.disabled = false
        mostrarTab('tab-inventario', 'tab-ingresar')
    } else {
        Swal.fire({ icon: 'warning', title: "Hey!", text: "Primero selecciona la bodega de salida" })
    }

}

async function obtenerDatosInventarioPorBodega(idBodega) {
    document.getElementById('cancelarGenerar').hidden = false
    document.getElementById('bodegaSalida').disabled = true
    datosMateriaPrima = await obtener(URL_INVENTARIO, { clase: 'Prima', tipo: idBodega })
    datosMateriales = await obtener(URL_INVENTARIO, { clase: 'Material', tipo: idBodega })
}