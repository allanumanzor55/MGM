const URL_ROL = '../Backend/api/roles.php'
const D_ROL = { idForm: "formRol" }
async function guardarRol(btn) {
    await guardar(btn, URL_ROL, D_ROL)
    refrescarTablaRol()
    limpiarFormulario(D_ROL.idForm)
}

async function eliminarRol(btn, id) {
    await eliminar(btn, URL_ROL, { id: id, clase: D_ROL.clase })
    refrescarTablaRol()
}

async function modificarRol(btn, id) {
    btn.style.disabled = true;
    const datos = await obtener(URL_ROL, { id: id, clase: D_ROL.clase })
    console.log(datos)
    btn.style.disabled = false;
    let formRol = document.querySelectorAll("form#formRol input")
    let formPermiso = document.querySelectorAll("form#formPermisos input")
    for (const key in datos) {
        for (const inputRol of formRol) {
            if (key == inputRol.id) {
                inputRol.value = datos[key]
            }
        }
        for (let i = 0; i < formPermiso.length - 2; i++) {
            lector = formPermiso[i]
            editor = formPermiso[i + 1]
            gestor = formPermiso[i + 2]
            if (lector.id.includes(key) && editor.id.includes(key) && gestor.id.includes(key)) {
                if (datos[key] === "0") {
                    lector.disabled = false
                    lector.checked = false
                    editor.disabled = false
                    editor.checked = false
                    gestor.checked = false
                    gestor.disabled = false
                } else if (datos[key] === "1") {
                    lector.disabled = false
                    lector.checked = true
                    editor.disabled = false
                    editor.checked = false
                    gestor.checked = false
                    gestor.disabled = false
                } else if (datos[key] === "2") {
                    editor.checked = true
                    intercalarPermiso(editor, key)
                } else if (datos[key] === "3") {
                    gestor.checked = true
                    intercalarPermiso(gestor, key)
                }
            }
        }
    }
    intercalarBotones(D_ROL.idForm, false);
}

async function confirmarModificarRol(btn) {
    await modificar(btn, URL_ROL, D_ROL)
    intercalarBotones(D_ROL.idForm, true);
    refrescarTablaRol()
}

async function refrescarTablaRol() {
    let not = '<span title="Sin Permiso" class="text-black"><i class="zmdi zmdi-eye-off zmdi-hc-lg"></i></span>'
    let lec = '<span title="Lector" class="text-black"><i class="zmdi zmdi-eye zmdi-hc-lg"></i></span>'
    let edit = '<span title="Editor" class="text-black"><i class="zmdi zmdi-edit zmdi-hc-lg"></i></span>'
    let gest = '<span title="Gestor" class="text-warning"><i class="zmdi zmdi-star zmdi-hc-lg"></i></span>'
    const datos = await obtener(URL_ROL, { clase: D_ROL.clase })
    document.querySelector('table#tableRol tbody').innerHTML = ``;
    if (Array.isArray(datos)) {
        datos.forEach(function(rol, index) {
            document.querySelector('table#tableRol tbody').innerHTML += //html
                `<tr>
                <td>${rol.rol}</td>
                <td>${(rol.empleados==="0")?not:(rol.empleados==="1")?lec:(rol.empleados==="2")?edit:gest}</td>
                <td>${(rol.clientes==="0")?not:(rol.clientes==="1")?lec:(rol.clientes==="2")?edit:gest}</td>
                <td>${(rol.inventario==="0")?not:(rol.inventario==="1")?lec:(rol.inventario==="2")?edit:gest}</td>
                <td>${(rol.guiaRemision==="0")?not:(rol.guiaRemision==="1")?lec:(rol.guiaRemision==="2")?edit:gest}</td>
                <td>${(rol.bodegas==="0")?not:(rol.bodegas==="1")?lec:(rol.bodegas==="2")?edit:gest}</td>
                <td>${(rol.catalogo==="0")?not:(rol.catalogo==="1")?lec:(rol.catalogo==="2")?edit:gest}</td>
                <td>${(rol.cotizacion==="0")?not:(rol.cotizacion==="1")?lec:(rol.cotizacion==="2")?edit:gest}</td>
                <td>${(rol.configuracion==="0")?not:(rol.configuracion==="1")?lec:(rol.configuracion==="2")?edit:gest}</td>
                <td>
                    <a title="Actualizar" class="btn btn-success" 
                    data-bs-toggle="modal" data-bs-target="#modalRol"
                    onclick="modificarRol(this,${rol.idRol});intercalarBotones('formRol2',false)">
                        <i class=" zmdi  zmdi-refresh"></i>
                    </a>
                </td>
                <td>
                    <a title="Eliminar" class="btn btn-danger" onclick="eliminarRol(this,${rol.idRol})">
                        <i class=" zmdi  zmdi-delete"></i>
                    </a>
                </td>
            <tr>`
        })
    }
}

async function rellenarSelectRoles() {
    const datos = await obtener(URL_ROL, {})
    if (Array.isArray(datos) && datos.length < 1) {
        var option = document.createElement("option")
        option.value = 0
        option.text = "Sin Roles Creados"
        document.getElementById('selectRoles').appendChild(option)
    } else if (Array.isArray(datos)) {
        datos.forEach(dato => {
            var option = document.createElement("option")
            option.value = dato.idRol
            option.text = dato.rol
            document.getElementById('selectRoles').appendChild(option)
        })
    }
}

function intercalarPermiso(chk, tipo) {
    if (chk.value === "2") {
        if (chk.checked) {
            document.getElementById(`${tipo}Lector`).checked = false
            document.getElementById(`${tipo}Lector`).disabled = true
        } else {
            document.getElementById(`${tipo}Lector`).disabled = false
        }
    } else if (chk.value === "3") {
        if (chk.checked) {
            document.getElementById(`${tipo}Lector`).checked = false
            document.getElementById(`${tipo}Lector`).disabled = true
            document.getElementById(`${tipo}Editor`).checked = false
            document.getElementById(`${tipo}Editor`).disabled = true
        } else {
            document.getElementById(`${tipo}Lector`).disabled = false
            document.getElementById(`${tipo}Editor`).disabled = false
        }
    }
}

function otorgarPermiso(chk, id) {
    if (chk.checked) {
        document.getElementById(id).value = chk.value
    } else {
        document.getElementById(id).value = 0
    }
}