const URL_CATALOGO = '../Backend/api/catalogo.php'
const D_CATALOGO = { idForm: 'formCatalogo' }
async function agregarProductoCatalogo(btn) {
    await guardar(btn, URL_CATALOGO, D_CATALOGO)
    refrescarCardCatalogo()
}

async function refrescarCardCatalogo(tipo) {
    const datos = await obtener(URL_CATALOGO, {})
    rellenarCardsCatalogo(datos, tipo)
}

function rellenarCardsCatalogo(datos, tipo) {
    document.getElementById('cardsCatalogo').innerHTML = ``
    if (Array.isArray(datos)) {
        if (datos.length > 0) {
            datos.forEach(catalogo => {
                        document.getElementById('cardsCatalogo').innerHTML +=
                            `<div class="col">
                        <div class="card h-100 p-3">
                            <img src="img/Catalogo.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">${catalogo.nombreProducto}</h5>
                            <p class="card-text">${catalogo.descripcionProducto}</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div>Precio: ${catalogo.precio}</div>
                                ${(tipo=="Catalogo")?
                                `<div>
                                <a href="#" class="btn btn-outline-success fs-4 zmdi zmdi-refresh"
                                onclick="modificarProductoCatalogo(this,${catalogo.idCatalogo})"></a>
                                <a href="#" class="btn btn-outline-danger fs-4 zmdi zmdi-delete"
                                onclick="eliminarProductoCatalogo(this,${catalogo.idCatalogo})"></a>
                                </div>`:
                                `<a href="#" class="btn btn-outline-success"
                                onclick="agregarProductoCotizacion(this,${catalogo.idCatalogo})">
                                <i class="zmdi zmdi-plus"></i>
                                </a>`}
                            </div>
                        </div>
                    </div>`
            });
        } else {
            document.getElementById('cardsCatalogo').innerHTML = `No hay registros`
        }
    }
}

async function eliminarProductoCatalogo(btn, id) {
    await eliminar(btn, URL_CATALOGO, { id: id })
    refrescarCardCatalogo()
}

async function modificarProductoCatalogo(btn,id) {
    btn.disabled=true
    const datos = await obtener(URL_CATALOGO, { id: id })
    let form = document.getElementById(D_CATALOGO.idForm).querySelectorAll('input,textarea,number')
    form[0].value = datos.idCatalogo
    form[2].value = datos.nombreProducto
    form[3].value = datos.descripcionProducto
    form[4].value = datos.precio
    mostrarTab('tab-ingresar', 'tab-catalogo')
    intercalarBotones(D_CATALOGO.idForm, false)
    btn.disabled=false
}

async function confirmarModificarCatalogo(btn) {
    await modificar(btn, URL_CATALOGO, D_CATALOGO)
    intercalarBotones(D_CATALOGO.idForm, true)
    let form = document.getElementById(D_CATALOGO.idForm).querySelectorAll('input,textarea,number')
    form[0].value = ""
    form[2].value = ""
    form[3].value = ""
    form[4].value = ""
    await refrescarCardCatalogo('Catalogo')
    mostrarTab('tab-catalogo', 'tab-ingresar')
}