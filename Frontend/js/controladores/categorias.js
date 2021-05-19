const URL_CTL = '../Backend/api/categoria_tipo_talla.php'
const v =[{form:"formCategoria",clase:"tipo"},{form:"formEstilo",clase:"categoria"},{form:"formTalla",clase:"talla"}]
rellenarSelect()
intercalarBotones("formCategoria",true)
//CATEGORIAS/TIPOS
async function guardarCategoria(btn){
    const respuesta = await guardar(btn,URL_CTL,{clase:v[0].clase,idForm:v[0].form})
    limpiarFormulario(v[0].form)
    refrescarTablaCategoria()
}

async function eliminarCategoria(btn,id){
    const respuesta = await eliminar(btn,URL_CTL,{id:id,clase:v[0].clase})
    refrescarTablaCategoria()
}

async function modificarCategoria(btn,id){
    btn.style.disabled=true;
    const datos = await obtener(URL_CTL,{id:id,clase:v[0].clase})
    btn.style.disabled=false;
    let form = document.querySelectorAll("form#formCategoria input")
    form[0].value=datos.idTipo
    form[1].value=datos.descripcion
    form[2].value=datos.material
    intercalarBotones(v[0].form,false);
}

async function confirmarModificarCategoria(btn){
    const respuesta = await modificar(btn,URL_CTL,{clase:v[0].clase,idForm:v[0].form})
    console.log(respuesta);
    intercalarBotones(v[0].form,true);
    limpiarFormulario(v[0].form)
    refrescarTablaCategoria()
}

async function refrescarTablaCategoria(){
    const datos = await obtener(URL_CTL,{clase:v[0].clase})
    document.querySelector('table#tableCategoria tbody').innerHTML=``;
    datos.forEach(function(categoria,index){
        document.querySelector('table#tableCategoria tbody').innerHTML+=//html
        `<tr>
            <td>${categoria.descripcion}</td>
            <td>${categoria.material}</td>
            <td>
                <a class="btn btn-success" onclick="modificarCategoria(this,${categoria.idTipo})">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>
            </td>
            <td>
                <a class="btn btn-danger" onclick="eliminarCategoria(this,${categoria.idTipo})">
                    <i class="bi bi-trash"></i>
                </a>
            </td>
        <tr>`
    })
}

async function rellenarSelect(){
    const datos = await obtener(URL_CTL,{clase:v[0].clase})
    datos.forEach(dato=>{
        var option = document.createElement("option");
        option.value = dato.idTipo;
        option.text = dato.descripcion+" | "+dato.material;
        document.getElementById('selectCategoria').appendChild(option);
    })
}

//ESTILOS
async function guardarEstilo(btn){
    const respuesta = await guardar(btn,URL_CTL,{clase:v[1].clase,idForm:v[1].form})
    limpiarFormulario(v[1].form)
    refrescarTablaEstilo()
}

async function eliminarEstilo(btn,id){
    const respuesta = await eliminar(btn,URL_CTL,{id:id,clase:v[1].clase})
    console.log(respuesta);
    refrescarTablaEstilo()
}

async function modificarEstilo(btn,id){
    btn.style.disabled=true;
    const datos = await obtener(URL_CTL,{id:id,clase:v[1].clase})
    btn.style.disabled=false;
    let form = document.querySelectorAll("form#formEstilo input, form#formEstilo select")
    console.log(datos);
    console.log(form);
    form[0].value=datos.idCategoria
    form[1].value=datos.idTipo
    form[2].value=datos.estilo
    intercalarBotones(v[1].form,false);
}

async function confirmarModificarEstilo(btn){
    const respuesta = await modificar(btn,URL_CTL,{clase:v[1].clase,idForm:v[1].form})
    console.log(respuesta);
    intercalarBotones(v[1].form,true);
    refrescarTablaEstilo()
}

async function refrescarTablaEstilo(){
    const datos = await obtener(URL_CTL,{clase:v[1].clase})
    document.querySelector('table#tableEstilo tbody').innerHTML=``;
    datos.forEach(function(estilo,index){
        document.querySelector('table#tableEstilo tbody').innerHTML+=//html
        `<tr>
            <td>${estilo.tipo}</td>
            <td>${estilo.material}</td>
            <td>${estilo.estilo}</td>
            <td>
                <a class="btn btn-success" onclick="modificarEstilo(this,${estilo.idCategoria})">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>
            </td>
            <td>
                <a class="btn btn-danger" onclick="eliminarEstilo(this,${estilo.idCategoria})">
                    <i class="bi bi-trash"></i>
                </a>
            </td>
        <tr>`
    })
}

//TALLAS
async function guardarTalla(btn){
    const respuesta = await guardar(btn,URL_CTL,{clase:v[2].clase,idForm:v[2].form})
    limpiarFormulario(v[2].form)
    refrescarTablaTalla()
}

async function eliminarTalla(btn,id){
    const respuesta = await eliminar(btn,URL_CTL,{id:id,clase:v[2].clase})
    console.log(respuesta);
    refrescarTablaTalla()
}

async function modificarTalla(btn,id){
    btn.style.disabled=true;
    const datos = await obtener(URL_CTL,{id:id,clase:v[2].clase})
    btn.style.disabled=false;
    let form = document.querySelectorAll("form#formTalla input, form#formTalla select")
    form[0].value=datos.idTalla
    form[1].value=datos.descripcion
    intercalarBotones(v[2].form,false);
}

async function confirmarModificarTalla(btn){
    const respuesta = await modificar(btn,URL_CTL,{clase:v[2].clase,idForm:v[2].form})
    console.log(respuesta);
    intercalarBotones(v[2].form,true);
    refrescarTablaTalla()
}

async function refrescarTablaTalla(){
    const datos = await obtener(URL_CTL,{clase:v[2].clase})
    document.querySelector('table#tableTalla tbody').innerHTML=``;
    datos.forEach(function(talla,index){
        document.querySelector('table#tableTalla tbody').innerHTML+=//html
        `<tr>
            <td>${talla.descripcion}</td>
            <td>
                <a class="btn btn-success" onclick="modificarTalla(this,${talla.idTalla})">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>
            </td>
            <td>
                <a class="btn btn-danger" onclick="eliminarTalla(this,${talla.idTalla})">
                    <i class="bi bi-trash"></i>
                </a>
            </td>
        <tr>`
    })
}

