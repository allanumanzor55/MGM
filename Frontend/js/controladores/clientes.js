const URL_CLIENTE = '../Backend/api/cliente.php'
const D_CLIENTE = { idForm: "formCliente" }
async function guardarCliente(btn) {
    await guardar(btn, URL_CLIENTE, D_CLIENTE)
}

async function refrescarCardClientes() {
    const datos = await obtener(URL_CLIENTE, {})
    console.log(datos)
    rellenarCardsCliente(datos)
}

async function modificarCliente(btn, id) {
    const datos = await obtener(URL_CLIENTE, { id: id })
    document.getElementById('clienteTabContent').classList.remove('active', 'show')
    document.getElementById('ingresarCliente').classList.add('active', 'show')
    document.getElementById('ingresarClienteTab').classList.add('active')
    document.getElementById('clienteTab').classList.remove('active')
    intercalarBotones(D_CLIENTE.idForm, false)
    rellenarFormulario(datos)
}

async function confirmarModificarCliente(btn) {
    await modificar(btn, URL_CLIENTE, { idForm: D_CLIENTE.idForm })
    intercalarBotones(D_CLIENTE.idForm, true)
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

function rellenarCardsCliente(datos) {
    let content = `<div class="row pb-2">`
    if (Array.isArray(datos)) {
        datos.forEach(cliente => {
            content +=
                `<div class="col col-sm-4 col-md-3 col-lg-3">
                <div class="card h-100 p-1">
                    <img src="../Frontend/img/perfil.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h6 class="card-title">${(cliente.nombre + " " + cliente.primerApellido).toUpperCase()}</h6>
                        <p class="card-text">
                            <strong>celular:</strong><br>
                            ${(cliente.celular == "") ? "N/D" : cliente.celular}
                        </p>
                    </div>
                    <div class="d-flex justify-content-between p-2">
                        <a href="#" class="btn btn-outline-warning    zmdi  zmdi-plus"
                        data-bs-toggle="modal" data-bs-target="#clienteModal" 
                        onmouseover="this.style.color='white'" onmouseout="this.style.color='#ffc107'"
                        onclick="mostrarDatosCliente(${cliente.idCliente})"></a>
                        <div>
                            <a title="Actualizar" href="#" class="btn btn-outline-success zmdi zmdi-refresh"
                            onclick="modificarCliente(this,${cliente.idCliente})"></a>
                            <a title="Eliminar" href="#" class="btn btn-outline-danger zmdi zmdi-delete"
                            onclick="eliminarCliente(this,${cliente.idCliente})"></a>
                        </div>
                    </div>
                </div>
            </div>`;
        })
        content += `</div>`;
        document.getElementById('clienteTabContent').innerHTML = content
    } else {
        document.getElementById('clienteTabContent').innerHTML = `No Existen Registros`
    }
}


function rellenarFormulario(datos) {
    let form = document.getElementById(`formCliente`).querySelectorAll('input,select,textarea')
    console.log(form);
    form[0].value = datos.idCliente
    form[1].value = datos.tipoCliente
        //2
    form[3].value = datos.dni
    form[4].value = datos.nombre
    form[5].value = datos.primerApellido
    form[6].value = datos.segundoApellido
    form[7].value = datos.direccion
    form[8].value = datos.correo
    form[9].value = datos.celular
    form[10].value = datos.telefono
    form[11].value = datos.edad
}

async function mostrarDatosCliente(id) {
    const datos = await obtener(URL_CLIENTE, { id: id })
    let content = `<div class="row justify-content-center align-items-center">`
    content +=
        `<div class="col-5">
            <img src="img/perfil.jpg" class="img-fluid" alt="" srcset="">
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