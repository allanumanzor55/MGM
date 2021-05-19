//TALLAS
async function guardarRol(btn){
    const respuesta = await guardar(btn,URL_CTL,{clase:v[2].clase,idForm:v[2].form})
    limpiarFormulario(v[2].form)
    refrescarTablaRol()
}

async function eliminarRol(btn,id){
    const respuesta = await eliminar(btn,URL_CTL,{id:id,clase:v[2].clase})
    console.log(respuesta);
    refrescarTablaRol()
}

async function modificarRol(btn,id){
    btn.style.disabled=true;
    const datos = await obtener(URL_CTL,{id:id,clase:v[2].clase})
    btn.style.disabled=false;
    let form = document.querySelectorAll("form#formRol input, form#formRol select")
    form[0].value=datos.idRol
    form[1].value=datos.descripcion
    intercalarBotones(v[2].form,false);
}

async function confirmarModificarRol(btn){
    const respuesta = await modificar(btn,URL_CTL,{clase:v[2].clase,idForm:v[2].form})
    console.log(respuesta);
    intercalarBotones(v[2].form,true);
    refrescarTablaRol()
}

async function refrescarTablaRol(){
    const datos = await obtener(URL_CTL,{clase:v[2].clase})
    document.querySelector('table#tableRol tbody').innerHTML=``;
    datos.forEach(function(talla,index){
        document.querySelector('table#tableRol tbody').innerHTML+=//html
        `<tr>
            <td>${talla.descripcion}</td>
            <td>
                <a class="btn btn-success" onclick="modificarRol(this,${talla.idRol})">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>
            </td>
            <td>
                <a class="btn btn-danger" onclick="eliminarRol(this,${talla.idRol})">
                    <i class="bi bi-trash"></i>
                </a>
            </td>
        <tr>`
    })
}