let datosForm

function obtenerDatos(idForm) {
    datosForm = new FormData(document.getElementById(idForm))
}
//clase se usara para empleados y categorias(que abarcan estilo, talla y tipo), tipo se usa para filtrar datos por algun tipo
/**
 * Funcion que guardar un objeto en la base de datos
 * @param {HTMLObjectElement} btn instancia del boton que se presiono al ejecutar la accion
 * @param {String} url  url de la direccion donde se hara la peticion
 * @param {JSON} datosPost  json con los parametros que puedes agregar, puede ser id, clase, tipo, etc... se usa para configurar la peticion
 * @returns Json con el mensaje de exito o error
 * @async
 */
async function guardar(btn, url, datosPost) {
    btn.disabled = true
    obtenerDatos(datosPost.idForm)
    try {
        const { data } = await axios.post(url + `?clase=${datosPost.clase}`, datosForm)
        if (data.centinela == "true") { limpiarFormulario(datosPost.idForm) }
        mostrarMensaje(data)
        btn.disabled = false;
    } catch (e) {
        Swal.fire({ icon: 'error', title: "Algo salio mal... al guardar", text: e.message })
        console.log("error");
    }
}
//clase se usara para empleados y categorias(que abarcan estilo, talla y tipo), tipo se usa para filtrar datos por algun tipo
/**
 * Funcion que obtiene los datos de un objeto
 * @param {String} url  url de la direccion donde se hara la peticion
 * @param {JSON} datosGet  json con los parametros que puedes agregar, puede ser id, clase, tipo, etc... se usa para configurar la peticion
 *          clase: clasificacion (empleados y clientes, talla,cat o estilo, materia prima, material, general)
 *          tipo: filtrar datos por un tipo especifico (bodega, tipo de empleado, etc...)
 * @returns Arreglo de Jsons con la informacion de el o los registro(s) obtenidos
 * @async
 */
async function obtener(url, datosGet) {
    try {
        const { data } = await axios.get(`${url}?id=${datosGet.id}&clase=${datosGet.clase}&tipo=${datosGet.tipo}&valor=${datosGet.valor}`);
        return data;
    } catch (e) {
        Swal.fire({ icon: 'error', title: "Algo salio mal...", text: e.message })
        return null;
    }
}
/**
 * Funcion que elimina un objeto en la base de datos
 * @param {HTMLObjectElement} btn instancia del boton que se presiono al ejecutar la accion
 * @param {String} url  url de la direccion donde se hara la peticion
 * @param {JSON} datosDelete  json con los parametros que puedes agregar, puede ser id, clase, tipo, etc... se usa para configurar la peticion
 * @returns Json con el mensaje de exito o error
 * @async
 */
async function eliminar(btn, url, datosDelete) {
    btn.disabled = true
    const result = await Swal.fire({
        title: 'Estas seguro?',
        text: "No podras revertir esto!!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ff6347',
        cancelButtonColor: '#d33f',
        confirmButtonText: 'Si, seguro!!'
    })
    if (result.isConfirmed) {
        try {
            const { data } = await axios.delete(url + `?id=${datosDelete.id}&clase=${datosDelete.clase}`)
            mostrarMensaje(data)
            btn.disabled = false
        } catch (e) {
            Swal.fire({ icon: 'error', title: "Algo salio mal...", text: e.message })
            btn.disabled = false
        }

    }
}
/**
 * Funcion que modifica un objeto en la base de datos
 * @param {HTMLObjectElement} btn instancia del boton que se presiono al ejecutar la accion
 * @param {String} url  url de la direccion donde se hara la peticion
 * @param {JSON} datosPur  json con los parametros que puedes agregar, puede ser id, clase, tipo, etc... se usa para configurar la peticion
 * @returns Json con el mensaje de exito o error
 * @async
 */
async function modificar(btn, url, datosPut) {
    try {
        btn.disabled = true
        obtenerDatos(datosPut.idForm)
        const { data } = await axios.put(url + `?clase=${datosPut.clase}`, JSON.stringify(Object.fromEntries(datosForm)))
        if (data.centinela == "true") { limpiarFormulario(datosPut.idForm) }
        mostrarMensaje(data)
        btn.disabled = false
    } catch (e) {
        Swal.fire({ icon: 'error', title: "Algo salio mal...", text: e.message })
        console.log(e);
        btn.disabled = false
    }
}
/**
 * Muestra el mensaje de exito o error de una peticion
 * @param {JSON} data json del mensaje de respuesta a peticion 
 * @returns SweetAlert con el mensaje
 */
function mostrarMensaje(data) {
    if (data.centinela === "true") {
        Swal.fire({ icon: 'success', title: data.mensaje })
    } else {
        Swal.fire({ icon: 'error', title: "Algo salio mal...", text: data.mensaje })
        console.error(data)
    }
}
/**
 * Intercala 2 botones, en especifico el de guardar y modificar
 * @param {String} idForm instancia del boton que se presiono al ejecutar la accion
 * @param {Boolean} centinela  booleana que indica cual de los 2 botones se interclaara
 */
function intercalarBotones(idForm, centinela) {
    let btnGuardar = document.querySelector(`form#${idForm} a.btn.btn-outline-warning`)
    let btnModificar = document.querySelector(`form#${idForm} a.btn.btn-outline-success`)
    console.log(btnGuardar)
    console.log(btnModificar)
    if (btnGuardar != null && btnModificar != null) {
        if (!centinela) {
            btnGuardar.style.display = "none";
            btnModificar.style.display = "block";
        } else {
            btnGuardar.style.display = "block";
            btnModificar.style.display = "none";
        }
    }
}
/**
 * @param {String} idForm id del formulario 
 * funcion que limpia todos los controles de un formulario
 */
function limpiarFormulario(idForm) {
    let form = document.getElementById(idForm).querySelectorAll(`input, textarea, select`)
    form.forEach(input => {
        if (input.type === "checkbox") {
            input.disabled = false
            input.checked = false

        } else if (input.type === "hidden") {
            input.value = "0"
        } else {
            input.value = ""
        }
    })
}
/**
 * Validamos que todos los controles del formulario esten llenos
 * @param {String} idForm id del formulario 
 * @returns centinela que informa si algun campo esta vacio
 */
function validarCamposNivel1(idForm) {
    let centinelaText = true
    document.getElementById(idForm).querySelectorAll(`input[type='text'], input[type='number'],input[type='email']`).forEach(node => {
        if (node.value == "") {
            centinelaText = false
        }
    })
    return centinelaText
}
/**
 * 
 * @param {HTMLObjectElement} btn instancia del objeto que se presiono
 * Nos valida el acceso a configuraciones
 */
async function accederConfiguraciones(btn) {
    const response = await Swal.fire({
        title: 'Ingrese La Contraseña Maestra',
        input: 'password',
        inputAttributes: {
            autocapitalize: 'off'
        },
        backdrop: true,
        showCancelButton: true,
        confirmButtonText: 'Ingresar',
        showLoaderOnConfirm: true,
        preConfirm: async (login) => {
                let datosLogin = new FormData();
                datosLogin.append("password",login)
                datosLogin.append("accion","MP")
                const {data} = await axios.post('../Backend/api/login.php',datosLogin)
                if (data) {
                    return data
                }else{
                    Swal.showValidationMessage(`Contraseña Incorrecta`)
                }
            } 
    })
    if (response.isConfirmed) {
        if (response.value) {
            window.location = "setting.php";
        }
    }
}

function mostrarTab(tabMostrar, tabOcultar) {
    document.getElementById(tabMostrar).classList.add('show', 'active')
    document.getElementById(tabMostrar).classList.remove('fade')
    document.getElementById(tabOcultar).classList.add('fade')
    document.getElementById(tabOcultar).classList.remove('show', 'active')
}