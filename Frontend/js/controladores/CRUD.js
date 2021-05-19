let datos;
function obtenerDatos(idForm){
    datos = new FormData(document.getElementById(idForm))    
}

async function guardar(btn,url,datosPost){
    btn.style.disabled=true
    obtenerDatos(datosPost.idForm)
    const {data} = await axios.post(url+`?clase=${datosPost.clase}`,datos)
    btn.style.disabled=false;
    return data;
}

async function obtener(url,datosGet){
    const {data} = await axios.get(url+`?id=${datosGet.id}&clase=${datosGet.clase}`);
    return data;
}

async function eliminar(btn,url,datosDelete){
    btn.style.disabled=true
    const result = await Swal.fire({
        title: 'Estas seguro?',
        text: "No podras revertir esto!!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33f',
        confirmButtonText: 'Si, seguro!!'
    })
    if (result.isConfirmed) {
        const {data} = await axios.delete(url+`?id=${datosDelete.id}&clase=${datosDelete.clase}`)
        btn.style.disabled=false
        return data
    }
}
async function modificar(btn,url,datosPut){
    btn.style.disabled=true
    obtenerDatos(datosPut.idForm)
    const {data} = await axios.put(url+`?clase=${datosPut.clase}`,JSON.stringify(Object.fromEntries(datos)))
    btn.style.disabled=false
    return data;
}

function intercalarBotones(idForm,centinela){
    let btnGuardar = document.querySelector(`form#${idForm} input[type='button'].btn.btn-danger`)
    let btnModificar = document.querySelector(`form#${idForm} input[type='button'].btn.btn-success`)
    if(!centinela){
        btnGuardar.style.display="none";
        btnGuardar.style.disabled=true;
        btnModificar.style.display="block";
        btnModificar.style.display=false;
    }else{
        btnGuardar.style.display="block";
        btnGuardar.style.disabled=false;
        btnModificar.style.display="none";
        btnModificar.style.display=true; 
    }
}

function limpiarFormulario(idForm){
    let form = document.querySelectorAll(`form#${idForm} input[type='text']`)
    form.forEach(input=>{
        input.value = ""
    })
    form[0].focus()
}