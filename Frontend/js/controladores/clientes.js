const URL_CLIENTE = '../Backend/api/cliente.php'
const D_CLIENTE = { idForm: "formCliente" }
async function guardarCliente(btn, permiso) {
    await guardar(btn, URL_CLIENTE, D_CLIENTE)
    refrescarCardClientes('Cliente', permiso)
}

function esEmpresa(chk) {
    document.getElementById('checkRtn').hidden = (chk) ? false : true
    document.getElementById('divRtn').hidden = true
    document.getElementById('chkRtn').checked = false
    document.getElementById('nombreEmpresa').value = ""
    document.getElementById('rtnEmpresa').value = ""
    document.getElementById('divNombreEmpresa').hidden = (chk) ? false : true
}

function tieneRTN(chk) {
    document.getElementById('divRtn').hidden = (chk) ? false : true
    document.getElementById('rtnEmpresa').value = ""
}

async function refrescarCardClientes(tipoVisualizacion, permiso) {
    const datos = await obtener(URL_CLIENTE, {})
    console.log(datos)
    rellenarCardsCliente(datos, tipoVisualizacion, permiso)
}

async function modificarCliente(btn, id) {
    const datos = await obtener(URL_CLIENTE, { id: id })
    mostrarTab('ingresarCliente', 'clienteTabContent')
    document.getElementById('titleCliente').innerHTML = 'Modificar Cliente'
    intercalarBotones(D_CLIENTE.idForm, false)
    rellenarFormulario(datos)
}

async function confirmarModificarCliente(btn, permiso) {
    await modificar(btn, URL_CLIENTE, { idForm: D_CLIENTE.idForm })
    document.getElementById('titleCliente').innerHTML = 'Ingresar Cliente'
    intercalarBotones(D_CLIENTE.idForm, true)
    refrescarCardClientes("Cliente", permiso)

}
async function buscarCliente(valor) {
    if (valor != "" && tipoCliente != "" && idCardCliente != "") {
        const datos = await obtener(URL_CLIENTE, { valor: valor, tipo: tipoCliente })
        rellenarCardsCliente(datos, idCardCliente, tipoCliente)
    } else {
        if (tipoCliente != "" && idCardCliente != "") {
            refrescarCardClientes(tipoCliente, idCardCliente)
        }
    }
}

async function eliminarCliente(btn, id) {
    await eliminar(btn, URL_CLIENTE, { id: id })
    refrescarCardClientes()
}

function rellenarCardsCliente(datos, tipoVisualizacion, permiso) {
    let content = `<div class="row pb-2">`
    if (Array.isArray(datos)) {
        datos.forEach(cliente => {
                    content +=
                        `<div class="col col-sm-4 col-md-3 col-lg-3">
                            <div class="card h-100 p-1">
                                <div class="style="min-height:250px !important; max-height:250px !important"">
                                    <img src="data:${cliente.formato};base64, ${cliente.fotografia}" 
                                    class="img-fluid" alt="...">
                                </div>
                            <div class="card-body">
                                <h6 class="card-title">${(cliente.nombre + " " + cliente.primerApellido).toUpperCase()}</h6>
                                <p class="card-text">
                                    <strong>celular:</strong><br>
                                    ${(cliente.celular == "") ? "N/D" : cliente.celular}
                                </p>
                            </div>
                            <div class="d-flex justify-content-between p-2">
                                ${tipoVisualizacion=="Cliente"?//Tipo De Visualizacio
                                `<a href="#" class="btn btn-outline-warning    zmdi  zmdi-plus"
                                data-bs-toggle="modal" data-bs-target="#clienteModal" 
                                onmouseover="this.style.color='white'" onmouseout="this.style.color='#ffc107'"
                                onclick="mostrarDatosCliente(${cliente.idCliente})"></a>
                                ${permiso==3 || permiso==4?//sSi es visualizacion de 'Cliente' se otorgan los permisos
                                    `<div>
                                        <a title="Actualizar" href="#" class="btn btn-outline-success zmdi zmdi-refresh"
                                        onclick="modificarCliente(this,${cliente.idCliente})"></a>
                                        <a title="Eliminar" href="#" class="btn btn-outline-danger zmdi zmdi-delete"
                                        onclick="eliminarCliente(this,${cliente.idCliente})"></a>
                                    </div>`:
                                    ``
                                }`:
                                `<div>
                                    <a href="#" class="btn btn-outline-success"
                                    onclick="crearCotizacion(this,${cliente.idCliente})">
                                    <i class="zmdi zmdi-plus"></i></a>
                                </div>`
                                }
                            </div>
                    </div>
                </div>`;
        })
        content += `</div>`;
        document.getElementById('cardsCliente').innerHTML = content
    } else {
        document.getElementById('cardsCliente').innerHTML = `No Existen Registros`
    }
}


function rellenarFormulario(datos) {
    let form = document.getElementById(`formCliente`).querySelectorAll('input,select,textarea')
    console.log(form);
    form[0].value = datos.idCliente
    form[1].value = datos.tipoCliente
    form[4].value = datos.nombreEmpresa
    form[5].value = datos.rtnEmpresa
    //6
    form[7].value = datos.dni
    form[8].value = datos.nombre
    form[9].value = datos.primerApellido
    form[10].value = datos.segundoApellido
    form[11].value = datos.direccion
    form[12].value = datos.correo
    form[13].value = datos.celular
    form[14].value = datos.telefono
    form[15].value = datos.edad
}

async function mostrarDatosCliente(id) {
    const datos = await obtener(URL_CLIENTE, { id: id })
    console.log(datos);
    let content = `<div class="row justify-content-center align-items-center">`
    content +=
        `<div class="col-5">
            <img src="data:${datos.formato};base64, ${datos.fotografia}" class="img-fluid" alt="" srcset="">
        </div>
        <div class="col-6">
            <div class="table-responsive">
                <table class="table table-responsive table-hover caption-bottom">
                    <caption>Datos cliente</caption>
                    <tbody>
                        <tr>
                            <th>Nombre</th>
                            <td>${datos.nombre+" "+datos.primerApellido+" "+datos.segundoApellido}</td>
                        </tr>
                        <tr>
                            <th>Usuario</th>
                            <td>Todavia No Lo Hago</td>
                        </tr>
                        <tr>
                            <th>Correo</th>
                            <td>${datos.correo}</td>
                        </tr>
                        <tr>
                            <td><strong>Celular  </strong>${datos.celular}</td>
                            <td><strong>Telefono  </strong>${datos.telefono}</td>
                        </tr>
                        <tr rowspan="6">
                            <td colspan="2">
                            <strong>Direccion</strong><br>
                            ${datos.direccion}
                            <td>
                        </tr>
                        <tr>
                            <th>Edad</th>
                            <td>${datos.edad}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>`
    content += `</div>`
    document.querySelector('#datosCliente').innerHTML = content
}