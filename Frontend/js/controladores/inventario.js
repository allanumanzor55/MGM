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
        console.log(datos);
        rellenarCardsInv(datos,clase)
    }
}

async function refrescarCardsInventario(clase) {
    const datos = await obtener(URL_INVENTARIO, {clase:clase})
    rellenarCardsInv(datos,clase)
}

function rellenarCardsInv(datos,clase){
    let idCard = `cardInventario${clase}`
    let content = `<div class="row pb-2 min-vh-50">`
    if (Array.isArray(datos)) {
        datos.forEach(Inventario => {
            content +=
                `<div class="col col-sm-4 col-md-3 col-lg-3">
                    <div class="card h-100 pb-2">
                        <img src="../Frontend/img/${clase}.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            ${(Inventario.descripcion.substr(0,10)+((Inventario.descripcion.length>10)?"...":"")).toUpperCase()}
                            <p class="card-text">
                            </p>
                        </div>
                        <div class="d-flex justify-content-between mx-2">
                            <a href="#" class="btn btn-outline-warning bi bi-plus"
                            data-bs-toggle="modal" data-bs-target="#InventarioModal" 
                            onmouseover="this.style.color='white'" onmouseout="this.style.color='#ffc107'"
                            onclick="mostrarDatosInventario(${Inventario.idInventario},'${clase}')"></a>
                            <div>
                                <a href="#" class="btn btn-outline-success bi bi-arrow-clockwise" 
                                onclick="modificarInventario(this,${Inventario.idInventario},'${clase}')"></a>
                                <a href="#" class="btn btn-outline-danger bi bi-trash"
                                onclick="eliminarInventario(this,${Inventario.idInventario},'${clase}')"></a>
                            </div>
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

async function modificarInventario(btn,id,clase) {
    const datos = await obtener(URL_INVENTARIO,{clase:clase,id:id})
    intercalarBotones(D_INVENTARIO.idForm+clase,false)
    document.getElementById(`cardInventario${clase}`).classList.remove('active','show')
    document.getElementById(`ingresar${clase}`).classList.add('active','show')
    document.getElementById(`ingresar${clase}-tab`).classList.add('active')
    document.getElementById(`cardInventario${clase}-tab`).classList.remove('active')
    rellenarFormulario(datos,clase)
}

async function confirmarModificarInventario(btn,clase){
    let idForm = D_INVENTARIO.idForm+clase
    await modificar(btn,URL_INVENTARIO,{clase:clase,idForm:idForm})
    intercalarBotones(D_INVENTARIO.idForm+clase,true)
}

function rellenarFormulario(datos,clase){
    let form = document.getElementById(`formInventario${clase}`).querySelectorAll('input,select')
    rellenarSelectEstilo(datos.idTipo)
    if(clase=="Prima"){
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