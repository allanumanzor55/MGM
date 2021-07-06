const URL_COTIZACION = '../Backend/api/cotizacion.php'
const D_COTIZACION = { idForm: "formCotizacion" }
let datosProductos = [],
    datosProductosAgregados = []
let productosAgregados = []

async function obtenerProductos() {
    datosProductos = await obtener(URL_CATALOGO, {})
}

async function generarCotizacion(btn) {
    let descripcion
    let result =
        await Swal.fire({
            title: 'Desea agregar una descripcion a la cotizacion?',
            showCancelButton: true,
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
        })
    if (result.isConfirmed) {
        result = await Swal.fire({
            title: 'Agregue el detalle de la cotizacion:',
            input: 'textarea',
            showCancelButton: true,
            confirmButtonText: 'Enviar Cotizacion'
        })
        if (result.isConfirmed) {
            document.getElementById('descripcionCotizacion').value = result.value
            document.getElementById('productos').value = JSON.stringify(productosAgregados)
            await guardar(btn, URL_COTIZACION, D_COTIZACION)
        }
    } else {
        result = await Swal.fire({
            title: 'Desea enviar la solicitud?',
            showCancelButton: true,
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
        })
        if (result.isConfirmed) {
            document.getElementById('descripcionCotizacion').value = ""
            document.getElementById('productos').value = JSON.stringify(productosAgregados)
            await guardar(btn, URL_COTIZACION, D_COTIZACION)
        }
    }
}

async function agregarProductoCotizacion(btn, id) {
    id = id.toString()
    const result =
        await Swal.fire({
            title: 'Ingresa la cantidad',
            input: 'text',
            showCancelButton: true,
            confirmButtonText: 'Agregar'
        })
    if (result.isConfirmed) {
        productosAgregados.push({ id: id, cantidad: result.value })
        datosProductosAgregados.push(datosProductos.find(el => el.idCatalogo === id))
        datosProductos.splice(datosProductos.findIndex(el => el.idCatalogo === id), 1)
        document.getElementById('nProductosAgregados').innerHTML = contarProductos()
        mostrarCatalogo()
        rellenarTableProductos()
    }
}

function quitarProductoCotizacion(index) {
    let id = datosProductosAgregados[index].idCatalogo.toString()
    productosAgregados.splice(productosAgregados.findIndex(el => el.id === id), 1)
    datosProductos.push(datosProductosAgregados.find(el => el.idCatalogo === id))
    datosProductosAgregados.splice(datosProductosAgregados.findIndex(el => el.idCatalogo === id), 1)
    document.getElementById('nProductosAgregados').innerHTML = contarProductos()
    rellenarTableProductos()
}

function contarProductos() {
    let cantidadProductos = 0
    productosAgregados.forEach(pro => cantidadProductos += parseInt(pro.cantidad))
    return cantidadProductos
}

async function refrescarTableCotizacion() {
    const datos = await obtener(URL_COTIZACION, {})
    rellenarTableCotizacion(datos)
}

function rellenarTableCotizacion(datos) {
    let content = `<thead>
                        <tr>
                            <th>Descripcion</th>
                            <th>Ver Productos</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>`
    if (Array.isArray(datos)) {
        if (datos.length > 0) {
            datos.forEach(cotizacion => {
                content +=
                    `<tr>
                        <td>${cotizacion.descripcion}</td>
                        <td><a class="btn btn-outline-warning"><i class="zmdi zmdi-dropbox"></i></a></td>
                        <td><a class="btn btn-outline-danger"><i class="zmdi zmdi-trash"></i></a></td>
                    </tr>`
            });
            content = `</tbody>`
        } else {
            content += `<tr><td colspan="3">No hay registros</td><tr>`
        }
    }
    document.getElementById('tableCotizacion').innerHTML = content
}

function mostrarCatalogo() {
    rellenarCardsCatalogo(datosProductos, 'Cotizacion')
    mostrarTab('tab-catalogo', 'tab-ingresar')
}

function rellenarTableProductos() {
    let subtotal = 0
    let content =
        `<table class="table">
            <thead>
                <tr>
                    <th class="col-8">Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
                    <th>Quitar</th>
                </tr>
            </thead>
            <tbody>`
    datosProductosAgregados.forEach(function(pro, index) {
        let cantidad = parseInt(productosAgregados.find(el => el.id === pro.idCatalogo).cantidad)
        let precio = parseFloat(pro.precio)
        let total = cantidad * precio
        subtotal += total
        content +=
            `<tr>
                <td class="col-8">${pro.nombreProducto}</td>
                <td>
                ${cantidad}
                </td>
                <td>${precio.toFixed(2)}</td>
                <td>${total.toFixed(2)}</td>
                <td>
                <a onclick="quitarProductoCotizacion(${index})"
                class="btn btn-outline-danger"><i class="zmdi zmdi-close"></i></a></td>
            </tr>`
    })
    let isv = subtotal * 0.15
    content +=
        `</tbody></table>
        <table class="table table-borderless">
        <tbody>
            <tr>
                <td class="col-8"></td>
                <td></td>
                <th style="text-align: right !important;">Subtotal</th>
                <td>${subtotal.toFixed(2)}</td>
            </tr>
            <tr>
                <td class="col-8"></td>
                <td></td>
                <th style="text-align: right !important;">ISV</th>
                <td>${isv.toFixed(2)}</td>
            </tr>
            <tr>
                <td class="col-8"></td>
                <td></td>
                <th style="text-align: right !important;">Total</th>
                <td>${subtotal+isv}</td>
            </tr>
        </tbody>
        </table>`
    document.getElementById('tableProductos').innerHTML = content
}