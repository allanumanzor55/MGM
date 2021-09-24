const URL_CTL = '../Backend/api/categoria_tipo_talla.php'
const D_CATEGORIA = [{ idForm: "formCategoria", clase: "tipo" }, { idForm: "formEstilo", clase: "categoria" }, { idForm: "formTalla", clase: "talla" }]

//CATEGORIAS/TIPOS
async function guardarCategoria(btn) {
    await guardar(btn, URL_CTL, D_CATEGORIA[0])
    refrescarTablaCategoria()
    refrescarTablaEstilo()
    rellenarSelect()
}

async function eliminarCategoria(btn, id) {
    await eliminar(btn, URL_CTL, { id: id, clase: D_CATEGORIA[0].clase })
    refrescarTablaCategoria()
    refrescarTablaEstilo()
    rellenarSelect()
}

async function modificarCategoria(btn, id) {
    modificarModalIngresar('categoria')
    btn.style.disabled = true
    const datos = await obtener(URL_CTL, { id: id, clase: D_CATEGORIA[0].clase })
    btn.style.disabled = false
    let form = document.querySelectorAll("form#formCategoria input")
    form[0].value = datos.idTipo
    form[1].value = datos.descripcion
    form[2].value = datos.material
    intercalarBotones(D_CATEGORIA[0].idForm, false)
}

async function confirmarModificarCategoria(btn) {
    await modificar(btn, URL_CTL, D_CATEGORIA[0])
    intercalarBotones(D_CATEGORIA[0].idForm, true)
    refrescarTablaCategoria()
    rellenarSelect()
}

async function refrescarTablaCategoria() {
    const datos = await obtener(URL_CTL, { clase: D_CATEGORIA[0].clase })
    document.querySelector('table#tableCategoria tbody').innerHTML = ``
    if (Array.isArray(datos)) {
        datos.forEach(function(categoria, index) {
            document.querySelector('table#tableCategoria tbody').innerHTML += //html
                `<tr>
                <td>${categoria.descripcion}</td>
                <td>${categoria.material}</td>
                <td>
                    <a title="Actualizar" class="btn btn-outline-success" onclick="modificarCategoria(this,${categoria.idTipo})"
                    data-bs-toggle="modal" data-bs-target="#modalIngresar">
                        <i class=" zmdi  zmdi-refresh"></i>
                    </a>
                </td>
                <td>
                    <a title="Eliminar" class="btn btn-outline-danger" onclick="eliminarCategoria(this,${categoria.idTipo})">
                        <i class=" zmdi  zmdi-delete"></i>
                    </a>
                </td>
            <tr>`
        })
    } else {
        document.querySelector('table#tableTalla tbody').innerHTML += //html
            `<tr>
                <td colspan="3">
                    No hay registros
                </td>
            <tr>`
    }
}

async function rellenarSelect() {
    document.getElementById('selectCategoria').innerHTML = ``
    if (!(typeof document.getElementById('selectCategoria') === "undefined")) {
        const datos = await obtener(URL_CTL, { clase: D_CATEGORIA[0].clase })
        if (Array.isArray(datos)) {
            datos.forEach(dato => {
                var option = document.createElement("option")
                option.value = dato.idTipo
                option.text = dato.descripcion + " | " + dato.material
                document.getElementById('selectCategoria').appendChild(option)
            })
        }
    }

}

//ESTILOS
async function guardarEstilo(btn) {
    await guardar(btn, URL_CTL, D_CATEGORIA[1])
    refrescarTablaEstilo()
}

async function eliminarEstilo(btn, id) {
    await eliminar(btn, URL_CTL, { id: id, clase: D_CATEGORIA[1].clase })
    refrescarTablaEstilo()
}

async function modificarEstilo(btn, id) {
    modificarModalIngresar('estilo')
    btn.style.disabled = true
    const datos = await obtener(URL_CTL, { id: id, clase: D_CATEGORIA[1].clase })
    btn.style.disabled = false
    let form = document.querySelectorAll("form#formEstilo input, form#formEstilo select")
    form[0].value = datos.idCategoria
    form[1].value = datos.idTipo
    form[2].value = datos.estilo
    intercalarBotones(D_CATEGORIA[1].idForm, false)
}

async function confirmarModificarEstilo(btn) {
    await modificar(btn, URL_CTL, D_CATEGORIA[1])
    intercalarBotones(D_CATEGORIA[1].idForm, true)
    refrescarTablaEstilo()
}

async function refrescarTablaEstilo() {
    const datos = await obtener(URL_CTL, { clase: D_CATEGORIA[1].clase })
    document.querySelector('table#tableEstilo tbody').innerHTML = ``
    if (Array.isArray(datos)) {
        datos.forEach(function(estilo, index) {
            document.querySelector('table#tableEstilo tbody').innerHTML += //html
                `<tr>
                <td>${estilo.tipo}</td>
                <td>${estilo.material}</td>
                <td>${estilo.estilo}</td>
                <td>
                    <a title="Actualizar" class="btn btn-outline-success" onclick="modificarEstilo(this,${estilo.idCategoria})"
                    data-bs-toggle="modal" data-bs-target="#modalIngresar">
                        <i class=" zmdi  zmdi-refresh"></i>
                    </a>
                </td>
                <td>
                    <a title="Eliminar" class="btn btn-outline-danger" onclick="eliminarEstilo(this,${estilo.idCategoria})">
                        <i class=" zmdi  zmdi-delete"></i>
                    </a>
                </td>
            <tr>`
        })
    } else {
        document.querySelector('table#tableTalla tbody').innerHTML += //html
            `<tr>
                <td colspan="3">
                    No hay registros
                </td>
            <tr>`
    }
}

async function rellenarSelectEstilo(idTipo, tipo) {
    let datos
    let tipoSelect
    if (typeof idTipo != "undefined") {
        if (tipo.includes("|")) {
            tipo = tipo.replace(" ", "").split("|")
            tipoSelect = tipo[0]
        } else {
            tipoSelect = tipo
        }
        if ((tipoSelect.toLowerCase() == "camisa" || tipoSelect.toLowerCase() == "pantalon")) {
            document.getElementById('divTalla').style.display = 'block'
        } else {
            document.getElementById('divTalla').style.display = 'none'
        }
    }

    if (!(document.getElementById('selectEstilo') === null)) {
        if (!(typeof idTipo === "undefined")) {
            datos = await obtener(URL_CTL, { clase: D_CATEGORIA[1].clase, tipo: idTipo })
        }
        document.getElementById('selectEstilo').innerHTML = ``
        if (Array.isArray(datos) && datos.length > 0) {
            document.getElementById('selectEstilo').removeAttribute("disabled")
            datos.forEach(dato => {
                var option = document.createElement("option")
                option.value = dato.idCategoria
                option.text = dato.estilo
                document.getElementById('selectEstilo').appendChild(option)
            })
        } else {
            var option = document.createElement("option")
            option.value = null
            option.text = "no hay estilos"
            document.getElementById('selectEstilo').appendChild(option)
            document.getElementById('selectEstilo').setAttribute("disabled", "true")
        }
    }
}

//TALLAS
async function guardarTalla(btn) {
    await guardar(btn, URL_CTL, D_CATEGORIA[2])
    refrescarTablaTalla()
}

async function eliminarTalla(btn, id) {
    await eliminar(btn, URL_CTL, { id: id, clase: D_CATEGORIA[2].clase })
    refrescarTablaTalla()
}

async function modificarTalla(btn, id) {
    modificarModalIngresar('talla')
    btn.style.disabled = true
    const datos = await obtener(URL_CTL, { id: id, clase: D_CATEGORIA[2].clase })
    btn.style.disabled = false
    let form = document.querySelectorAll("form#formTalla input, form#formTalla select")
    form[0].value = datos.idTalla
    form[1].value = datos.descripcion
    intercalarBotones(D_CATEGORIA[2].idForm, false)
}

async function confirmarModificarTalla(btn) {
    await modificar(btn, URL_CTL, D_CATEGORIA[2])
    intercalarBotones(D_CATEGORIA[2].idForm, true)
    refrescarTablaTalla()
}

async function refrescarTablaTalla() {
    const datos = await obtener(URL_CTL, { clase: D_CATEGORIA[2].clase })
    document.querySelector('table#tableTalla tbody').innerHTML = ``
    if (Array.isArray(datos)) {
        datos.forEach(function(talla, index) {
            document.querySelector('table#tableTalla tbody').innerHTML += //html
                `<tr>
                <td>${talla.descripcion}</td>
                <td>
                    <a title="Actualizar" class="btn btn-outline-success" onclick="modificarTalla(this,${talla.idTalla})"
                    data-bs-toggle="modal" data-bs-target="#modalIngresar">
                        <i class=" zmdi  zmdi-refresh"></i>
                    </a>
                </td>
                <td>
                    <a title="Eliminar" class="btn btn-outline-danger" onclick="eliminarTalla(this,${talla.idTalla})">
                        <i class=" zmdi  zmdi-delete"></i>
                    </a>
                </td>
            <tr>`
        })
    } else {
        document.querySelector('table#tableTalla tbody').innerHTML += //html
            `<tr>
                <td colspan="3">
                    No hay registros
                </td>
            <tr>`
    }
}

async function rellenarSelectTalla() {
    if (!(document.getElementById('selectTalla') === null)) {
        const datos = await obtener(URL_CTL, { clase: D_CATEGORIA[2].clase })
        datos.forEach(dato => {
            var option = document.createElement("option")
            option.value = dato.idTalla
            option.text = dato.descripcion
            document.getElementById('selectTalla').appendChild(option)
        })
    }
}