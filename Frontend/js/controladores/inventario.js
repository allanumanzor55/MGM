const URL_INVENTARIO = '../Backend/api/inventario.php'
const D_INVENTARIO = { idForm: "formInventario" }
async function guardarInventario(btn, clase) {
    let idForm = D_INVENTARIO.idForm + clase
    if (!(document.getElementById('selectEstilo').value === "null") || clase != "Prima") {
        let centinelaText = validarCamposNivel1(idForm)
        if (centinelaText != false && clase) {
            await guardar(btn, URL_INVENTARIO, { idForm: idForm, clase: clase })
        } else {
            Swal.fire({ icon: 'warning', title: 'completa todos los campos' })
        }
    } else {
        Swal.fire({ icon: 'warning', title: 'Hey... Selecciona un estilo' })
    }
}

async function eliminarInventario(btn, id, clase) {
    await eliminar(btn, URL_INVENTARIO, { id: id, clase: clase })
    refrescarCardsInventario(clase, "Inventario")
}

async function buscarInventario(valor, clase) {
    if (valor != "") {
        const datos = await obtener(URL_INVENTARIO, { valor: valor, clase: clase })
        rellenarCardsInv(datos, clase, "Inventario")
    } else {
        refrescarCardsInventario(clase, "Inventario")
    }
}
/**
 * 
 * @param {String} clase String que define el tipo de inventario que querefemos mostrar(Materia Prima, Materiales, Herramientas o General)
 * @param {String} opcion String que define como se mostraran las cartas, con opciones de modificar y eliminar, sin ellos o con otra opcion
 */
async function refrescarCardsInventario(clase, opcion) {
    const datos = await obtener(URL_INVENTARIO, { clase: clase })
    rellenarCardsInv(datos, clase, opcion)
}
/**
 * 
 * @param {String} clase Tipo de inventario, puede ser prima, material, general, etc..
 * @param {String} opcion Opcion de mostrar inventario, puede ser para inventario u otro
 */
async function obtenerInventario(clase, opcion) {
    const datos = await obtener(URL_INVENTARIO, { clase: clase })
    console.log(datos);
    rellenarCardsInv(datos, clase, opcion)
}

async function modificarInventario(btn, id, clase) {
    const datos = await obtener(URL_INVENTARIO, { clase: clase, id: id })
    intercalarBotones(D_INVENTARIO.idForm + clase, false)
    seleccionarTab(clase, true, false)
    intercalarBotonInventario(clase,true)
    rellenarFormulario(datos, clase)
}

async function modificarStock(btn, id, clase) {
    btn.disabled = true
    let result =
        await Swal.fire({
            title: 'Ingrese el nuevo stock de inventario',
            showCancelButton: true,
            input: 'text',
            confirmButtonText: 'Modificar',
            cancelButtonText: 'Cancelar'
        })
    if (result.isConfirmed) {
        try {
            let datos = { id: id, stock: result.value, campoModificado: "stock", tipoInventario: clase }
            const { data } =
                await axios.put(URL_INVENTARIO, datos)
            mostrarMensaje(data)
        } catch (e) {
            Swal.fire({ icon: 'error', title: "Algo salio mal...", text: e.message })
            console.log(e)
        }
    } else {
        console.log("Denegado")
    }
    btn.disabled = false
}

async function mostrarDatosInventario(id, clase) {
    let datos = await obtener(URL_INVENTARIO, { id: id, clase: clase })
    datos.tipo = (clase != "Prima") ? "sin tipo" : datos.tipo
    let content = `<div class="row justify-content-center align-items-center">`
    content +=
        `<div class="col-5">
            <img src="img/${clase}.jpg" class="img-fluid" alt="" srcset="">
        </div>
        <div class="col-6">
            <div class="table-responsive">
                <table class="table table-responsive table-hover caption-bottom">
                    <caption>Bodega: ${datos.bodega}</caption>
                    <tbody>
                        <tr>
                            <th>Descripcion</th>
                            <td>${datos.descripcion}</td>
                        </tr>
                        ${(clase != "Prima") ?
                        `` :
                        `<tr>
                            <td><strong>Categoria  </strong>${datos.tipo}</td>
                            <td><strong>Material  </strong>${datos.material}</td>
                        </tr>
                        <tr>
                            <th>Estilo</th>
                            <td>${datos.estilo}</td>
                        </tr>
                        ${(datos.tipo.toLowerCase() == "camisa" && datos.tipo.toLowerCase() == "pantalon") ?
                        `` :
                        `<tr><th>Talla</th><td>${datos.talla}</td></tr>`
                        }`
                    }
                        ${(clase == "General") ?
                        `` :
                        `<tr>
                            <th>Proveedor</th>
                            <td>${datos.empresa}</td>
                        </tr>`
                    }
                        ${(clase != "Herramienta" || clase != "General") ?
                        `` :
                        `<tr>
                            <th>Precio</th>
                            <td>${datos.precio}</td>
                        </tr>`
                        }
                        <tr>
                            <th>Stock</th>
                            <td>${datos.stock}<td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>`
    content += `</div>`
    document.querySelector('#datosInventario').innerHTML = content
    document.querySelector('#inventarioModalFooter').innerHTML =
    `<button type="button" class="btn btn-outline-secondary" 
    data-bs-dismiss="modal">Cerrar</button>
    <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal"
    onclick="modificarStock(this,${id},'${clase}')">
    <i class="zmdi zmdi-plus zmdi-hc-lg"></i> Modificar Stock  
    </button>`
}

async function seleccionarTab(clase, centinela) {
    if (centinela) {
        document.getElementById(`cardInventario${clase}`).classList.remove('active', 'show')
        document.getElementById(`ingresar${clase}`).classList.add('active', 'show')
    } else {
        await refrescarCardsInventario(clase, 'Inventario')
        document.getElementById(`cardInventario${clase}`).classList.add('active', 'show')
        document.getElementById(`ingresar${clase}`).classList.remove('active', 'show')
    }
}

async function confirmarModificarInventario(btn, clase) {

    let idForm = D_INVENTARIO.idForm + clase
    await modificar(btn, URL_INVENTARIO, { clase: clase, idForm: idForm })
    intercalarBotones(D_INVENTARIO.idForm + clase, true)
    intercalarBotonInventario(clase,false)
    seleccionarTab(clase,false)
    window.scroll(0, 0)
    document.querySelectorAll(`.form-select, .label-bodega`).forEach(el => el.style.display = 'block')
}

function rellenarFormulario(datos, clase) {

    let form = document.getElementById(`formInventario${clase}`).querySelectorAll('input,select')
    form[0].value = datos.idInventario
    form[1].style.display = 'none'
    document.querySelectorAll('.label-bodega').forEach(el => el.style.display = 'none')
    if (clase == "Prima") {
        rellenarSelectEstilo(datos.idTipo, datos.tipo)
        form[2].value = datos.idTipo
        form[3].value = datos.idCategoria
        form[4].value = datos.idTalla
        form[5].value = datos.idProveedor
        //5
        form[7].value = datos.descripcion
        form[8].value = datos.color
        form[9].value = datos.stock
        form[10].value = datos.precio
        form[11].value = datos.puntoReorden
    } else if (clase == "Material") {
        form[2].value = datos.idProveedor
        //2
        form[4].value = datos.descripcion
        form[5].value = datos.marca
        form[6].value = datos.stock
        form[7].value = datos.precio
        form[8].value = datos.puntoReorden
    } else if (clase == "Herramienta") {
        form[2].value = datos.idProveedor
        //2
        form[4].value = datos.descripcion
        form[5].value = datos.marca
        form[6].value = datos.stock
    } else if (clase == "General") {
        //2
        form[3].value = datos.descripcion
        form[4].value = datos.stock
    }
}

function rellenarCardsInv(datos, clase, opcion) {
    let idCard = `cardInventario${clase}`
    let content = `<div class="row pb-2 min-vh-50">`
    let dInv = ""
    if (opcion != "Inventario") {
        document.getElementById('cardInventarioPrima').innerHTML = ``
        document.getElementById('cardInventarioMaterial').innerHTML = ``
        //document.getElementById('tablaMateriales').innerHTML=``
    }
    if (Array.isArray(datos)) {
        if (datos.length == 0) {
            document.getElementById(idCard).innerHTML = `No Existen Registros`
        } else {
            datos.forEach(Inv => {
                let advertencia = ""
                if (clase == "Material" || clase == "Prima") {
                    let puntoR = parseInt(Inv.puntoReorden)
                    let stock = parseInt(Inv.stock)
                    if (stock > puntoR) {
                        advertencia = `<i class="zmdi zmdi-circle zmdi-hc-lg text-success"></i>`
                    } else if (stock == puntoR) {
                        advertencia = `<i class="zmdi zmdi-circle zmdi-hc-lg text-warning"></i>`
                    } else if (stock < puntoR) {
                        advertencia = `<i class="zmdi zmdi-circle zmdi-hc-lg text-danger"></i>`
                    }
                }
                dInv = (clase == "Material") ?
                    `${Inv.idInventario}|${Inv.descripcion}|${Inv.empresa}|${Inv.marca}|${Inv.precio}` : (clase == "Prima") ?
                        `${Inv.idInventario}|${Inv.descripcion}|${Inv.tipo}|${Inv.material}|${Inv.estilo}|${Inv.talla}|${Inv.empresa}` : ``
                content +=
                    `${(opcion == "Inventario") ?
                        `<div class="col-sm-4 col-md-4 col-lg-3">`
                        :
                        `<div class="col-sm-6 col-md-4 col-lg-3">`
                    }
                        <div class="card h-100 pb-2">
                            <img src="../Frontend/img/${clase}.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <span>
                                        ${(Inv.descripcion.substr(0, 30) + ((Inv.descripcion.length > 30) ? "..." : "")).toUpperCase()}
                                    </span>
                                    <p class="card-text">
                                        ${(opcion == "Inventario") ? advertencia : ``}    
                                    </p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mx-2">
                                ${(opcion == "Inventario") ?
                        //Inv
                        `<div>
                            <a href="#" class="btn btn-outline-warning  zmdi  zmdi-plus"
                            data-bs-toggle="modal" data-bs-target="#inventarioModal" 
                            onmouseover="this.style.color='white'" onmouseout="this.style.color='#ffc107'"
                            onclick="mostrarDatosInventario(${Inv.idInventario},'${clase}')"></a>
                        </div>
                        <div>
                            <a title="Actualizar" href="#" class="btn btn-outline-success  zmdi  zmdi-refresh" 
                                onclick="modificarInventario(this,${Inv.idInventario},'${clase}')"></a>
                            <a title="Eliminar" href="#" class="btn btn-outline-danger  zmdi  zmdi-delete"
                            onclick="eliminarInventario(this,${Inv.idInventario},'${clase}')"></a>
                        </div>`
                        :
                        `${(opcion == "guiaRemision") ?
                            //Guia de remision
                            `<a title="Agregar" href="#" class="btn btn-outline-success  zmdi  zmdi-plus"
                                        onclick="agregarInventarioGuia(this,${Inv.idInventario},'${clase}')"></a>`
                            :
                            `<a title="Agregar" href="#" class="btn btn-outline-success  zmdi  zmdi-plus" 
                                        ${(clase == "Material") ? `data-bs-toggle="modal" data-bs-target="#cantidadMaterialModal"` : ``}
                                        ${(clase == "Prima" ? `data-bs-dismiss="modal"` : ``)}
                                        onclick="agregarIdMaterial(this,${dInv},'${clase}')"></a>`
                        }`
                    }</div></div></div>`
            })
            content += `</div>`;
            document.getElementById(idCard).innerHTML = content
        }
    } else {
        document.getElementById(idCard).innerHTML = `No Existen Registros`
    }
}

function intercalarBotonInventario(tipo, centinela) {
    let btnIngresar = document.getElementById(`ingresarBtn${tipo}`)
    let btnRegresar = document.getElementById(`regresarBtn${tipo}`)
    if (centinela) {
        btnIngresar.style.display = 'none'
        btnRegresar.style.display = 'block'
    } else {
        btnIngresar.style.display = 'block'
        btnRegresar.style.display = 'none'
    }
}
