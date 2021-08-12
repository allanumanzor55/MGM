const URL_EMPLEADO = '../Backend/api/empleado.php'
const D_EMPLEADO = { idForm: "formEmpleado" }
let tipoEmpleado = ""
let idCardEmpleado = ""
async function guardarEmpleado(btn) {
    await guardar(btn, URL_EMPLEADO, D_EMPLEADO)
}

async function refrescarCardEmpleados(tipoEmpleado, idCard, permiso) {
    idCardEmpleado = idCard
    const datos = await obtener(URL_EMPLEADO, { tipo: tipoEmpleado })
    rellenarCardsEmpleado(datos, idCardEmpleado, tipoEmpleado, permiso)
}

async function modificarEmpleadoPorTipo(btn, idCard, tipoEmpleado, id) {
    idCardEmpleado = idCard
    const datos = await obtener(URL_EMPLEADO, { tipo: tipoEmpleado, id: id })
    intercalarBotones(D_EMPLEADO.idForm, false)
    idCard = idCard.replace('#', '')
    mostrarTab('ingresarEmpleado', 'tabsCargos')
        //mostrarTab('ingresarEmpleado', idCard)
    rellenarFormulario(datos)
}

async function confirmarModificarEmpleado(btn) {
    await modificar(btn, URL_EMPLEADO, { idForm: D_EMPLEADO.idForm })
    intercalarBotones(D_EMPLEADO.idForm, true)
    document.getElementsByClassName('nav-link nav-link-mg-2 active')[0].click()
}
async function buscarEmpleado(valor) {
    if (valor != "" && tipoEmpleado != "" && idCardEmpleado != "") {
        const datos = await obtener(URL_EMPLEADO, { valor: valor, tipo: tipoEmpleado })
        rellenarCardsEmpleado(datos, idCardEmpleado, tipoEmpleado)
    } else {
        if (tipoEmpleado != "" && idCardEmpleado != "") {
            refrescarCardEmpleados(tipoEmpleado, idCardEmpleado)
        }
    }
}


async function eliminarEmpleadoPorTipo(btn, idCard, tipoEmpleado, id) {
    idCardEmpleado = idCard
    await eliminar(btn, URL_EMPLEADO, { id: id })
    refrescarCardEmpleados(tipoEmpleado, idCard)
}

function rellenarCardsEmpleado(datos, idCard, tipoEmpleado, permiso) {
    let content = `<div class="row pb-2">`
    if (Array.isArray(datos)) {
        datos.forEach(empleado => {
                    content +=
                        `<div class="col col-sm-4 col-md-3 col-lg-3">
                <div class="card h-100 p-1">
                    <img src="data:${empleado.formato};base64, ${empleado.fotografia}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h6 class="card-title">${(empleado.nombre + " " + empleado.primerApellido).toUpperCase()}</h6>
                        <p class="card-text">
                            <strong>celular:</strong><br>
                            ${(empleado.celular == "") ? "N/D" : empleado.celular}
                        </p>
                    </div>
                    <div class="d-flex justify-content-between p-2">
                        <a href="#" class="btn btn-outline-warning    zmdi  zmdi-plus"
                        data-bs-toggle="modal" data-bs-target="#empleadoModal" 
                        onmouseover="this.style.color='white'" onmouseout="this.style.color='#ffc107'"
                        onclick="mostrarDatosEmpleado(${empleado.idEmpleado})"></a>
                        ${permiso==3 || permiso==4 || permiso==4?
                        `<div>
                            <a title="Actualizar" href="#" class="btn btn-outline-success    zmdi  zmdi-refresh"
                            onclick="modificarEmpleadoPorTipo(this,'${idCard}',${tipoEmpleado},${empleado.idEmpleado})"></a>
                            <a title="Eliminar" href="#" class="btn btn-outline-danger    zmdi  zmdi-delete"
                            onclick="eliminarEmpleadoPorTipo(this,'${idCard}',${tipoEmpleado},${empleado.idEmpleado})"></a>
                        </div>`:
                        ''}
                    </div>
                </div>
            </div>`;
        })
        content += `</div>`;
        document.querySelector(idCard).innerHTML = content
    } else {
        document.querySelector(idCard).innerHTML = `No Existen Registros`
    }
}


function rellenarFormulario(datos) {
    let form = document.getElementById(`formEmpleado`).querySelectorAll('input,select,textarea')
    console.log(form);
    form[0].value = datos.idEmpleado
    form[1].value = datos.tipoEmpleado
        //2
    form[3].value = datos.dni
    form[4].value = datos.nombre
    form[5].value = datos.primerApellido
    form[6].value = datos.segundoApellido
    form[7].value = datos.direccion
    form[8].value = datos.correo
    form[9].value = datos.celular
    form[10].value = datos.telefono
    form[11].value = datos.sueldo
}

async function mostrarDatosEmpleado(id) {
    const datos = await obtener(URL_EMPLEADO, { id: id })
    let content = `<div class="row justify-content-center align-items-center">`
    content +=
        `<div class="col-5">
            <img src="data:${datos.formato};base64, ${datos.fotografia}" class="img-fluid" alt="" srcset="">
        </div>
        <div class="col-6">
            <div class="table-responsive">
                <table class="table table-responsive table-hover caption-bottom">
                    <caption>Datos empleado</caption>
                    <tbody>
                        <tr>
                            <th>Nombre</th>
                            <td>${datos.nombre+" "+datos.primerApellido+" "+datos.segundoApellido}</td>
                        </tr>
                        <tr>
                            <th>Usuario</th>
                            <td>${datos.usuario}</td>
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
                            <th>Sueldo</th>
                            <td>${datos.sueldo}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>`
    content += `</div>`
    document.querySelector('#datosEmpleado').innerHTML = content
}