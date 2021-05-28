const URL_ROL= '../Backend/api/roles.php'
const D_ROL = {idForm:"formRol"}
async function guardarRol(btn){
    await guardar(btn,URL_ROL,D_ROL)
    refrescarTablaRol()
}

async function eliminarRol(btn,id){
    await eliminar(btn,URL_ROL,{id:id,clase:D_ROL.clase})
    refrescarTablaRol()
}

async function modificarRol(btn,id){
    btn.style.disabled=true;
    const datos = await obtener(URL_ROL,{id:id,clase:D_ROL.clase})
    btn.style.disabled=false;
    let form = document.querySelectorAll("form#formRol input")
    console.log(datos);
    console.log(form);
    form[0].value=datos.idRol
    form[1].value=datos.rol
    form[2].checked =(datos.empleados==="1")?true:false;
    form[3].checked = (datos.clientes==="1")?form[3].checked=true:false
    form[4].checked = (datos.inventario==="1")?form[4].checked=true:false
    form[5].checked = (datos.ventas==="1")?form[5].checked=true:false
    form[6].checked = (datos.configuracion==="1")?form[6].checked=true:false
    intercalarBotones(D_ROL.idForm,false);
}

async function confirmarModificarRol(btn){
    await modificar(btn,URL_ROL,D_ROL)
    intercalarBotones(D_ROL.idForm,true);
    refrescarTablaRol()
}

async function refrescarTablaRol(){
    const datos = await obtener(URL_ROL,{clase:D_ROL.clase})
    document.querySelector('table#tableRol tbody').innerHTML=``;
    datos.forEach(function(rol,index){
        document.querySelector('table#tableRol tbody').innerHTML+=//html
        `<tr>
            <td>${rol.rol}</td>
            <td>${rol.empleados}</td>
            <td>${rol.clientes}</td>
            <td>${rol.inventario}</td>
            <td>${rol.ventas}</td>
            <td>${rol.configuracion}</td>
            <td>
                <a class="btn btn-success" onclick="modificarRol(this,${rol.idRol})">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>
            </td>
            <td>
                <a class="btn btn-danger" onclick="eliminarRol(this,${rol.idRol})">
                    <i class="bi bi-trash"></i>
                </a>
            </td>
        <tr>`
    })
}

async function rellenarSelectRols(){
    const datos = await obtener(URL_ROL,{clase:D_ROL.clase})
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
        option.text = "Sin Roles"
        document.getElementById('selectTipoEmpleado').appendChild(option)
    }
}
