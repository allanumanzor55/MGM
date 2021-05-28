const URL_EMPLEADO = '../Backend/api/empleado.php'
const D_EMPLEADO = { idForm: "formEmpleado" }
async function guardarEmpleado(btn) {
    await guardar(btn, URL_EMPLEADO, D_EMPLEADO)
}

async function refrescarCardEmpleados(tipo, idCard) {
    const datos = await obtener(URL_EMPLEADO, { tipo: tipo })
    let content = `<div class="row pb-2">`
    if (Array.isArray(datos)) {
        datos.forEach(empleado => {
            content +=
                `<div class="col col-sm-4 col-md-3 col-lg-2">
                <div class="card h-100 p-1">
                    <img src="../Frontend/img/perfil.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h6 class="card-title">${(empleado.nombre + " " + empleado.primerApellido).toUpperCase()}</h6>
                        <p class="card-text">
                            <strong>celular:</strong><br>
                            ${(empleado.celular == "") ? "N/D" : empleado.celular}
                        </p>
                    </div>
                    <div class="d-flex justify-content-between p-2">
                        <a href="#" class="btn btn-outline-warning fs-5 bi bi-plus"
                        data-bs-toggle="modal" data-bs-target="#empleadoModal" 
                        onmouseover="this.style.color='white'" onmouseout="this.style.color='#ffc107'"
                        onclick="mostrarDatosEmpleado(${empleado.idEmpleado})"></a>
                        <div>
                            <a href="#" class="btn btn-outline-success fs-5 bi bi-arrow-clockwise"
                            onclick="modificarEmpleadoPorTipo(this,'${idCard}',${tipo},${empleado.idEmpleado})"></a>
                            <a href="#" class="btn btn-outline-danger fs-5 bi bi-trash"
                            onclick="eliminarEmpleadoPorTipo(this,'${idCard}',${tipo},${empleado.idEmpleado})"></a>
                        </div>
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

async function modificarEmpleadoPorTipo(btn, idCard, tipo, id) {
    const datos = await obtener(URL_EMPLEADO,{tipo:tipo,id:id})
    intercalarBotones(D_EMPLEADO.idForm,false)
    document.querySelector(idCard).classList.remove('active','show')
    document.querySelector(`#ingresarEmpleado`).classList.add('active','show')
    document.querySelector(`#ingresarEmpleadoTab`).classList.add('active')
    document.querySelector(idCard.slice(0,-7)).classList.remove('active')
    rellenarFormulario(datos)
    console.log(datos);
}

async function confirmarModificarEmpleado(btn) {
    await modificar(btn,URL_EMPLEADO,{idForm:D_EMPLEADO.idForm})
    intercalarBotones(D_EMPLEADO.idForm,true)
}

function rellenarFormulario(datos){
    let form = document.getElementById(`formEmpleado`).querySelectorAll('input,select,textarea')
    console.log(form);
    form[0].value=datos.idEmpleado
    form[1].value=datos.tipoEmpleado
    //2
    form[3].value=datos.dni
    form[4].value=datos.nombre
    form[5].value=datos.primerApellido
    form[6].value=datos.segundoApellido
    form[7].value=datos.direccion
    form[8].value=datos.correo
    form[9].value=datos.celular
    form[10].value=datos.telefono
    form[11].value=datos.sueldo
}

async function eliminarEmpleadoPorTipo(btn, idCard, tipo, id) {
    await eliminar(btn, URL_EMPLEADO, { id: id })
    refrescarCardEmpleados(tipo, idCard)
}

async function mostrarDatosEmpleado(id) {
    const datos = await obtener(URL_EMPLEADO, { id: id })
    let content = `<div class="row justify-content-center align-items-center">`
    content +=
        `<div class="col-5">
            <img src="img/perfil.jpg" class="img-fluid" alt="" srcset="">
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
    content+=`</div>`
    document.querySelector('#datosEmpleado').innerHTML=content
}