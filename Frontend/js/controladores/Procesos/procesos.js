const URL_PROCESO = '../Backend/api/procesos.php'
const D_PROCESO = {idForm:'formProceso'}
async function guardarProceso(btn){
    await guardar(btn,URL_PROCESO,D_PROCESO)
    refrescarTablaProceso()
}
async function eliminarProceso(btn,id){
    await eliminar(btn,URL_PROCESO,{id:id,clase:D_PROCESO.clase})
    refrescarTablaProceso()
}

async function modificarProceso(btn,id){
    btn.style.disabled=true;
    const datos = await obtener(URL_PROCESO,{id:id,clase:D_PROCESO.clase})
    btn.style.disabled=false;
    let form = document.querySelectorAll("form#formProceso input")
    form[0].value=datos.idProceso
    form[1].value=datos.descripcion
    intercalarBotones(D_PROCESO.idForm,false);
}

async function confirmarModificarProceso(btn){
    await modificar(btn,URL_PROCESO,D_PROCESO)
    intercalarBotones(D_PROCESO.idForm,true);
    refrescarTablaProceso()
}

async function refrescarTablaProceso(){
    const datos = await obtener(URL_PROCESO,{clase:D_PROCESO.clase})
    document.querySelector('table#tableProceso tbody').innerHTML=``;
    if(Array.isArray(datos)){
        datos.forEach(function(proceso,index){
            document.querySelector('table#tableProceso tbody').innerHTML+=//html
            `<tr>
                <td>${proceso.descripcion}</td>
                <td>
                    <a title="Actualizar" class="btn btn-outline-success" onclick="modificarProceso(this,${proceso.idProceso})">
                        <i class=" zmdi  zmdi-refresh"></i>
                    </a>
                </td>
                <td>
                    <a title="Eliminar" class="btn btn-outline-danger" onclick="eliminarProceso(this,${proceso.idProceso})">
                        <i class=" zmdi  zmdi-delete"></i>
                    </a>
                </td>
            <tr>`
        })
    }
}

function rellenarDataListProcesos(){
    
}