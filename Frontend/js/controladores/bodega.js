const URL_BODEGA = '../Backend/api/bodega.php'
const D_BODEGA = { idForm: "formBodega" }
async function guardarBodega(btn) {
    await guardar(btn, URL_BODEGA, D_BODEGA)
    await refrescarCardsBodega()
}
async function refrescarCardsBodega(permiso) {
    const datos = await obtener(URL_BODEGA, {})
    rellenarCardsBodega(datos, permiso)
}

function rellenarCardsBodega(datos, permiso) {
    let content = ``
    datos.forEach(bodega => {
                content +=
                    `<div class="col-12 col-sm-6 col-md-6 col-lg-3 mt-2" style="max-height: 10rem !important;">
                <div class="card border-secondary">
                    <div class="card-body">
                        <div style="min-height:3rem !important;">
                            <h6 class="h6 card-title">${bodega.descripcion}</h6>
                            <p class="card-text"></p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div></div>
                            <div>
                                <a title="ver inventario" 
                                href="inventario.php?idBodega=${bodega.idBodega}"
                                class="btn btn-outline-warning"><i class="zmdi zmdi-square-right"></i></a>
                                ${permiso==3 || permiso==4?
                                `<a title="actualizar" onclick="modificarBodega(${bodega.idBodega})"
                                class="btn btn-outline-success"><i class="zmdi zmdi-refresh"></i></a>`:
                                ``}
                            </div>
                        </div>
                    </div>
                </div>
            </div>`
    });
    document.getElementById('cardBodegas').innerHTML = content
}

async function modificarBodega(id) {
    const datos = await obtener(URL_BODEGA, { id: id })
    intercalarBotones(D_BODEGA.idForm, false)
    let form = document.getElementById(D_BODEGA.idForm).querySelectorAll('input,textarea')
    console.log(form);
    form[0].value = datos.idBodega
    form[1].value = datos.descripcion
    form[2].value = datos.ubicacion
    mostrarTab('tabIngresar', 'tabBodegas')
}

async function confirmarModificarBodega(btn) {
    await modificar(btn, URL_BODEGA, D_BODEGA)
    intercalarBotones(D_BODEGA.idForm, true)
    refrescarCardsBodega()
    mostrarTab('tabBodegas', 'tabIngresar')
}
async function cargarNombreBodega(id) {
    const { descripcion } = await obtener(URL_BODEGA, { id: id })
    document.querySelectorAll('.tituloBodega').forEach(el => el.innerHTML = descripcion)
}

async function rellenarSelectBodega() {

    const datos = await obtener(URL_BODEGA, {})
    document.querySelectorAll('.select-bodega').forEach(select => {
        select.innerHTML = `<option value="0"> Elegir bodega </option>`
        datos.forEach(el => select.innerHTML += `<option value="${el.idBodega}">${el.descripcion}</option>`)
    })
}