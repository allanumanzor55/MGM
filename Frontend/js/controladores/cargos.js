const URL_CARGO= '../Backend/api/tipos.php'
const D_CARGO = {idForm:"formCargo",clase:"empleado"}
async function guardarCargo(btn){
    await guardar(btn,URL_CARGO,D_CARGO)
    refrescarTablaCargo()
}

async function eliminarCargo(btn,id){
    await eliminar(btn,URL_CARGO,{id:id,clase:D_CARGO.clase})
    refrescarTablaCargo()
}

async function modificarCargo(btn,id){
    btn.style.disabled=true;
    const datos = await obtener(URL_CARGO,{id:id,clase:D_CARGO.clase})
    btn.style.disabled=false;
    let form = document.querySelectorAll("form#formCargo input")
    form[0].value=datos.idTipoEmpleado
    form[1].value=datos.descripcion 
    intercalarBotones(D_CARGO.idForm,false);
}

async function confirmarModificarCargo(btn){
    await modificar(btn,URL_CARGO,D_CARGO)
    intercalarBotones(D_CARGO.idForm,true);
    refrescarTablaCargo()
}

async function refrescarTablaCargo(){
    const datos = await obtener(URL_CARGO,{clase:D_CARGO.clase})
    document.querySelector('table#tableCargo tbody').innerHTML=``;
    datos.forEach(function(cargo,index){
        document.querySelector('table#tableCargo tbody').innerHTML+=//html
        `<tr>
            <td>${cargo.descripcion}</td>
            <td>
                <a class="btn btn-success" onclick="modificarCargo(this,${cargo.idTipoEmpleado})">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>
            </td>
            <td>
                <a class="btn btn-danger" onclick="eliminarCargo(this,${cargo.idTipoEmpleado})">
                    <i class="bi bi-trash"></i>
                </a>
            </td>
        <tr>`
    })
}

async function rellenarSelectCargos(){
    const datos = await obtener(URL_CARGO,{clase:D_CARGO.clase})
    if(Array.isArray(datos)){
        datos.forEach(dato=>{
            var option = document.createElement("option")
            option.value = dato.idTipoEmpleado
            option.text = dato.descripcion
            document.getElementById('selectTipoEmpleado').appendChild(option)
        })
    }else{
        var option = document.createElement("option")
        option.value = 0
        option.text = "Sin Cargoes"
        document.getElementById('selectTipoEmpleado').appendChild(option)
    }
}

async function crearTabsCargos(){
    const datos = await obtener(URL_CARGO,{clase:D_CARGO.clase})
    let tabContents=``,tab=``
    if(Array.isArray(datos)){
        datos.forEach(dato=>{
            let desc = dato.descripcion.substr(0,1).toUpperCase() + dato.descripcion.toLowerCase().substr(1)
            tab+=
            `<li class="nav-item" role="presentation">
                <button class="nav-link nav-link-mg-2" id="${desc}Tab" data-bs-toggle="pill"
                data-bs-target="#${desc}TabContent" type="button" role="tab"
                aria-controls="${desc}" aria-selected="false"
                onclick="refrescarCardEmpleados(${dato.idTipoEmpleado},this.dataset.bsTarget)">
                    ${desc}
                </button>
            </li>`
            tabContents+=
            `<div class="tab-pane fade" id="${desc}TabContent" role="tabpanel"
                aria-labelledby="${desc}Tab">
            </div>
            `
        })
        document.getElementById('pills-tabEmpleado').innerHTML+=tab
        document.getElementById('pills-tabContentEmpleado').innerHTML+=tabContents
    }
}