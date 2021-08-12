const URL_CATALOGO = '../Backend/api/catalogo.php'
const D_CATALOGO = { idForm: 'formCatalogo' }
async function agregarProductoCatalogo(btn) {
    await guardar(btn, URL_CATALOGO, D_CATALOGO)
    refrescarCardCatalogo()
}

async function refrescarCardCatalogo(tipo, permiso) {
    const datos = await obtener(URL_CATALOGO, {})
    console.log(datos);
    rellenarCardsCatalogo(datos, tipo, permiso)
}

function rellenarCardsCatalogo(datos, tipo, permiso) {
    document.getElementById('cardsCatalogo').innerHTML = ``
    if (Array.isArray(datos)) {
        if (datos.length > 0) {
            datos.forEach(catalogo => {
                let fotos ='', indicadors = ''
                catalogo.foto.forEach(function(f,i){
                    indicadors+=
                    `<button type="button" data-bs-target="#carousel${catalogo.idCatalogo}" data-bs-slide-to="${i}" class="${i==0?'active':''}" aria-current="${i==0?'true':''}"></button>`
                    fotos+=
                    `<div class="carousel-item ${i==0?`active`:``}" style="min-height:250px !important; max-height:250px !important;">
                        <img src="data:${f.formatoFoto};base64, ${f.fotografia}" class="d-block w-100">
                    </div>`
                })
            let carousel = 
            `<div id="carousel${catalogo.idCatalogo}" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">${indicadors}</div>
                <div class="carousel-inner">${fotos}</div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carousel${catalogo.idCatalogo}" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carousel${catalogo.idCatalogo}" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>`
            document.getElementById('cardsCatalogo').innerHTML +=
            `<div class="col">
                <div class="card h-100 p-3">
                    ${carousel}
                    <div class="card-body">
                        <h5 class="card-title">${catalogo.nombreProducto}</h5>
                    <p class="card-text">${catalogo.descripcionProducto}</p>
                    </div>
                    <div class="d-flex justify-content-between align-items-end">
                        <p class="h6 align-text-bottom">
                            Precio: ${catalogo.precio}<br>
                            <small class="text-muted">
                            ${catalogo.exentoImpuesto==="1"?`Excento de impuesto`:``}
                            </small>
                        </p>
                        ${(tipo=='Catalogo')?
                        `${(permiso==3 || permiso==4)?
                            `<div>
                            <a href="#" class="btn btn-outline-success fs-4 zmdi zmdi-refresh"
                            onclick="modificarProductoCatalogo(this,${catalogo.idCatalogo})"></a>
                            <a href="#" class="btn btn-outline-danger fs-4 zmdi zmdi-delete"
                            onclick="eliminarProductoCatalogo(this,${catalogo.idCatalogo})"></a>
                            </div>`:
                            ``
                        }`:
                        `<div>
                            <a href="#" class="btn btn-outline-success"
                            onclick="agregarProductoCotizacion(this,${catalogo.idCatalogo})">
                            <i class="zmdi zmdi-plus"></i></a>
                        </div>`}
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
    form[5].checked = (datos.exentoImpuesto==="1")?true:false;
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
    mostrarTab('tab-catalogo', 'tab-ingresar')
}