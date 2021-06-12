const URL_INVENTARIO = '../Backend/api/inventario.php'
const D_INVENTARIO = {idForm:"formInventario"}
async function guardarInventario(btn,clase){
    let idForm = D_INVENTARIO.idForm+clase
    if(!(document.getElementById('selectEstilo').value === "null") || clase!="Prima"){
        let centinelaText = validarCamposNivel1(idForm)
        if(centinelaText!=false && clase){
            await guardar(btn,URL_INVENTARIO,{idForm:idForm,clase:clase}) 
        }else{
            Swal.fire({icon: 'warning',title: 'completa todos los campos'})
        }
    }else{
        Swal.fire({icon: 'warning',title: 'Hey... Selecciona un estilo'})
    }
}

async function eliminarInventario(btn,id,clase){
    await eliminar(btn,URL_INVENTARIO,{id:id,clase:clase})
    refrescarCardsInventario(clase)   
}

async function buscarInventario(valor,clase){
    if(valor!=""){
        const datos = await obtener(URL_INVENTARIO,{valor:valor,clase:clase})
        rellenarCardsInv(datos,clase)
    }else{
        refrescarCardsInventario(clase)
    }
}
/**
 * 
 * @param {String} clase String que define el tipo de inventario que querefemos mostrar(Materia Prima, Materiales, Herramientas o General)
 * @param {String} opcion String que define como se mostraran las cartas, con opciones de modificar y eliminar, sin ellos o con otra opcion
 */
async function refrescarCardsInventario(clase,opcion) {
    const datos = await obtener(URL_INVENTARIO, {clase:clase})
    rellenarCardsInv(datos,clase,opcion)
}


async function modificarInventario(btn,id,clase) {
    const datos = await obtener(URL_INVENTARIO,{clase:clase,id:id})
    intercalarBotones(D_INVENTARIO.idForm+clase,false)
    seleccionarTab(clase,true)
    rellenarFormulario(datos,clase)
}

async function mostrarDatosInventario(id,clase) {
    let datos = await obtener(URL_INVENTARIO, { id: id, clase:clase })
    datos.tipo = (clase!="Prima")?"sin tipo":datos.tipo
    let content = `<div class="row justify-content-center align-items-center">`
    content +=
        `<div class="col-5">
            <img src="img/${clase}.jpg" class="img-fluid" alt="" srcset="">
        </div>
        <div class="col-6">
            <div class="table-responsive">
                <table class="table table-responsive table-hover caption-bottom">
                    <caption>Datos ${clase}</caption>
                    <tbody>
                        <tr>
                            <th>Descripcion</th>
                            <td>${datos.descripcion}</td>
                        </tr>
                        ${(clase!="Prima")?
                            ``:
                            `<tr>
                                <td><strong>Categoria  </strong>${datos.tipo}</td>
                                <td><strong>Material  </strong>${datos.material}</td>
                            </tr>
                            <tr>
                                <th>Estilo</th>
                                <td>${datos.estilo}</td>
                            </tr>
                            ${(datos.tipo.toLowerCase()=="camisa" && datos.tipo.toLowerCase()=="pantalon")?
                                ``:
                                `<tr><th>Talla</th><td>${datos.talla}</td></tr>`
                            }`
                        }
                        ${(clase=="General")?
                            ``:
                            `<tr>
                                <th>Proveedor</th>
                                <td>${datos.empresa}</td>
                            </tr>`
                        }
                        ${(clase!="Herramienta"||clase!="General")?
                            ``:
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
    content+=`</div>`
    document.querySelector('#datosInventario').innerHTML=content
}

async function seleccionarTab(clase,centinela){
    
    if(centinela){
        document.getElementById(`cardInventario${clase}`).classList.remove('active','show')
        document.getElementById(`cardInventario${clase}-tab`).classList.remove('active')
        document.getElementById(`ingresar${clase}`).classList.add('active','show')
        document.getElementById(`ingresar${clase}-tab`).classList.add('active')
    }else{
        await refrescarCardsInventario(clase)
        document.getElementById(`cardInventario${clase}`).classList.add('active','show')
        document.getElementById(`cardInventario${clase}-tab`).classList.add('active')
        document.getElementById(`ingresar${clase}`).classList.remove('active','show')
        document.getElementById(`ingresar${clase}-tab`).classList.remove('active')
    }
}

async function confirmarModificarInventario(btn,clase){
    let idForm = D_INVENTARIO.idForm+clase
    await modificar(btn,URL_INVENTARIO,{clase:clase,idForm:idForm})
    intercalarBotones(D_INVENTARIO.idForm+clase,true)
}

function rellenarFormulario(datos,clase){
    let form = document.getElementById(`formInventario${clase}`).querySelectorAll('input,select')
    if(clase=="Prima"){
        console.log(datos);
        rellenarSelectEstilo(datos.idTipo,datos.tipo)
        form[0].value= datos.idInventario
        form[1].value = datos.idTipo
        form[2].value = datos.idCategoria
        form[3].value = datos.idTalla
        form[4].value = datos.idProveedor
        //5
        form[6].value = datos.descripcion
        form[7].value = datos.color
        form[8].value = datos.stock
        form[9].value = datos.precio
    }else if(clase=="Material"){    
        form[0].value = datos.idInventario    
        form[1].value = datos.idProveedor
        //2
        form[3].value = datos.descripcion
        form[4].value = datos.marca
        form[5].value = datos.stock
        form[6].value = datos.precio
    }else if(clase=="Herramienta"){
        form[0].value = datos.idInventario
        form[1].value = datos.idProveedor
        //2
        form[3].value = datos.descripcion
        form[4].value = datos.marca
        form[5].value = datos.stock
    }else if(clase =="General"){
        form[0].value = datos.idInventario
        //1
        form[2].value = datos.descripcion
        form[3].value = datos.stock
    }
}

function rellenarCardsInv(datos,clase,opcion){
    if(opcion!="Inventario"){
        document.getElementById('cardInventarioPrima').innerHTML=``
        document.getElementById('cardInventarioMaterial').innerHTML=``
        document.getElementById('tablaMateriales').innerHTML=``
    }
    let idCard = `cardInventario${clase}`
    let content = `<div class="row pb-2 min-vh-50">`
    let dInv=""
    if (Array.isArray(datos)) {
        datos.forEach(Inv => {
            dInv = (clase=="Material")?
            `${Inv.idInventario}|${Inv.descripcion}|${Inv.empresa}|${Inv.marca}|${Inv.precio}`:(clase=="Prima")?
            `${Inv.idInventario}|${Inv.descripcion}|${Inv.tipo}|${Inv.material}|${Inv.estilo}|${Inv.talla}|${Inv.empresa}`:``
            content +=
                `${(opcion=="Inventario")?
                    `<div class="col-sm-4 col-md-4 col-lg-4">`:
                    `<div class="col-sm-6 col-md-4 col-lg-3">`}
                    <div class="card h-100 pb-2">
                        <img src="../Frontend/img/${clase}.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            ${(Inv.descripcion.substr(0,20)+((Inv.descripcion.length>20)?"...":"")).toUpperCase()}
                            <p class="card-text">
                            </p>
                        </div>
                        <div class="d-flex justify-content-between mx-2">
                            ${(opcion=="Inventario")?
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
                            </div>`:
                            //Productos 
                            `<a title="Agregar" href="#" class="btn btn-outline-success  zmdi  zmdi-plus" 
                            ${(clase=="Material")?`data-bs-toggle="modal" data-bs-target="#cantidadMaterialModal"`:``}
                            ${(clase=="Prima"?`data-bs-dismiss="modal"`:``)}
                            onclick="agregarIdMaterial(this,'${dInv}','${clase}')"></a>`
                            }
                        </div>
                    </div>
                </div>`;
        })
        content += `</div>`;
        document.getElementById(idCard).innerHTML = content
    } else {
        document.getElementById(idCard).innerHTML = `No Existen Registros`
    }
}