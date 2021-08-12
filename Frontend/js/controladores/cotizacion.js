const URL_COTIZACION = '../Backend/api/cotizacion.php'
const D_COTIZACION = { idForm: "formCotizacion" }
let datosProductos = [],
    datosProductosAgregados = []
let productosAgregados = []


async function crearCotizacion(btn, idCliente) {
    mostrarTab('tab-ingresar', 'tab-clientes')
    document.getElementById('idCliente').value = idCliente
}

async function generarCotizacion(btn, permiso) {
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
            await obtenerCotizacionesPorEstado(permiso, 'PENDIENTE')
            datosProductosAgregados = []
            productosAgregados = []
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

async function cambiarEstadoCotizacion(nuevoEstado, id, permiso) {
    nuevoEstado = (nuevoEstado == 1) ? "APROBADA" : (nuevoEstado == 0 ? "RECHAZADA" : "PENDIENTE")
    await axios.put(URL_COTIZACION, { id: id, campoModificado: "estado", estado: nuevoEstado })
    await obtenerCotizacionesPorEstado(permiso, 'PENDIENTE')
}

async function obtenerProductos() {
    datosProductos = await obtener(URL_CATALOGO, {})

}

async function obtenerCotizacionesPorEstado(permiso, estado) {
    document.getElementById('titleCotizacion').innerHTML = estado.toLowerCase() + "s"
    const datos = await obtener(URL_COTIZACION, { tipo: estado })
    rellenarTableCotizacion(datos, permiso)
}

async function refrescarTableCotizacion() {
    const datos = await obtener(URL_COTIZACION, {})
    console.log(datos)
    rellenarTableCotizacion(datos)
}

async function obtenerProductosCotizados(id) {
    const datos = await obtener(URL_COTIZACION, { id: id, tipo: 'ProductosCotizados' })
    const table = document.getElementById('cardsProductosCotizados')
    table.innerHTML = ''
    datos.forEach(producto => {
        table.innerHTML +=
            `<div class="col">
                        <div class="card h-100 p-3">
                            <img src="img/Catalogo.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">${producto.nombreProducto}</h5>
                            <p class="card-text">${producto.descripcionProducto}</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-end">
                                <p class="h6 align-text-bottom">
                                    Precio: ${producto.precio}<br>
                                    <small class="text-muted">
                                    Cantidad: ${producto.cantidad}
                                    </small>
                                </p>
                                <div>
                                    <a href="#" class="btn btn-outline-warning"
                                    onclick="">
                                    <i class="zmdi zmdi-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>`
    });
}

function rellenarTableCotizacion(datos, permiso) {
    let opt = ''
    if (Array.isArray(datos) && datos.length > 0) {
        if (datos["EstadoCotizacion"] != "undefined") {
            opt = datos[0].EstadoCotizacion == "PENDIENTE" ? `<th>Aprobar</th><th>Rechazar</th>` : ``
        }
    }
    let content = `<thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Descripcion</th>
                            <th>Atendio</th>
                            <th>Cliente</th>
                            <th>Ver Productos</th>
                            ${opt}
                        </tr>
                    </thead>
                    <tbody>`
    if (Array.isArray(datos)) {
        if (datos.length > 0) {
            datos.forEach(cotizacion => {
                        content +=
                            `<tr>
                        <td>${cotizacion.fecha}</td>
                        <td>${cotizacion.descripcion}</td>
                        <td>${cotizacion.nombreEmpleado}</td>
                        <td>${cotizacion.nombreCliente}</td>
                        <td><a title="Ver Productos" 
                        onclick="mostrarTab('tab-productos','tab-cotizacion');obtenerProductosCotizados(${cotizacion.idCotizacion})" class="btn btn-outline-warning"><i class="zmdi zmdi-dropbox"></td>
                        ${permiso==3 || permiso==4?
                            `${cotizacion.EstadoCotizacion=="PENDIENTE"?
                                `<td><a title="Aprobar" 
                                onclick="cambiarEstadoCotizacion(1,${cotizacion.idCotizacion},${permiso})"
                                class="btn btn-outline-success"><i class="zmdi zmdi-check"></i></a></td>
                                <td><a title="Anular" 
                                onclick="cambiarEstadoCotizacion(0,${cotizacion.idCotizacion},${permiso})"
                                class="btn btn-outline-danger"><i class="zmdi zmdi-close"></i></a></td>`:
                                ``
                            }`
                            :
                            ``
                        } 
                    </tr>`
            });
            content += `</tbody>`
        } else {
            content += `<tr><td colspan="3">No hay registros</td><tr>`
        }
    }
    document.getElementById('tableCotizacion').innerHTML = content
}

function mostrarCliente(btn) {
    btn.disabled = true
    refrescarCardClientes('Catalogo', -1)
    mostrarTab('tab-clientes', 'tab-cotizacion')
    btn.disabled = false
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
                    <th>Precio</th>
                    <th>ISV</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Quitar</th>
                </tr>
            </thead>
            <tbody>`
    datosProductosAgregados.forEach(function(pro, index) {
        let cantidad = parseInt(productosAgregados.find(el => el.id === pro.idCatalogo).cantidad)
        let precio = parseFloat(pro.precio)
        let isv = (pro.exentoImpuesto === "0") ? precio * 0.15 : 0
        let total = cantidad * (precio + isv)
        subtotal += total
        content +=
            `<tr>
                <td class="col-8">${pro.nombreProducto}</td>
                <td>${precio.toFixed(2)}</td>
                <td>${isv.toFixed(2)}</td>
                <td>
                ${cantidad}
                </td>
                <td>${total.toFixed(2)}</td>
                <td>
                <a onclick="quitarProductoCotizacion(${index})"
                class="btn btn-outline-danger"><i class="zmdi zmdi-close"></i></a></td>
            </tr>`
    })
    content +=
        `</tbody></table>
        <table class="table table-borderless">
        <tbody>
            <tr>
                <td class="col-8"></td>
                <td></td>
                <th style="text-align: right !important;">Total</th>
                <td>${subtotal.toFixed(2)}</td>
            </tr>
        </tbody>
        </table>`
    document.getElementById('tableProductos').innerHTML = content

document.getElementById('tableProductos').innerHTML = content
}