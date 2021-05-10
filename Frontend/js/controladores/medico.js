const URL_M = '../Backend/api/Medico.php';
let i=0;
selectSalas("CONSULTORIOS");
/**
 * Guardar Un Medico Obteniendo Sus Datos Por Medio De Un FormData el cual es
 * un objeto de los datos del formulario seleccionado, al guardarse y recibir respuesta
 * se actualiza la tabla de medicos y se limpia el formulario
*/
async function guardarMedico(btn){
    btn.style.disabled = true;
    try{
        await axios.post(URL_M,new FormData($('#formMedico')[0]));
        mostrarMedicos(null);
        $('#modalMedico').modal('hide');
        btn.style.disabled = false;
        limpiarFormulario('#formMedico input[type=text]');
    }catch(e){
        console.log(e.message);
    }
}

/**
 * Funcion Para Obtener Un Medico O Todos Los Medicos
 * @param   {Number}   id  
 * id del medico que se desea encontrar, en caso de que el 
 * id sea null o 0 se mostraran todos los medicos   
 * @return {Promise} Arreglo de Jsons De Los Datos Obtenidos
 */
async function obtenerMedicos(id){
    try{
        let URL = URL_M + ((id!=null || id>1)?`?id=${id}`:``);
        const {data} = await axios.get(URL);
        return data;
    }catch(e){
        console.error(e.message);
    }
}

/**
 * Actualiza la tabla de registros al realizar un cambio
 */
async function mostrarMedicos(datos){
    let datosMedicos = await obtenerMedicos(datos);
    rellenarTablaMedico(datosMedicos);
}


function rellenarTablaMedico(datosMedicos){
    let cardMedicos = document.getElementById('cardMedicos');
    cardMedicos.innerHTML = ``;
    if(Array.isArray(datosMedicos)){
        datosMedicos.forEach(medico => {
            cardMedicos.innerHTML+=//html
            `<div class="card">
                <img src="resource/img/Foto de Perfil.jpg" class="card-img-top rounded-circle" alt="...">
                <div class="card-body">
                    <h5 class="card-title">${medico.nombres+" "+ medico.primerApellido}</h5>
                    <h6 class="card-title">${medico.especialidad}</h6>
                </div>
                <div class="card-footer row justify-content-between">
                    <button type="button" class="btn btn-primary" 
                    data-toggle="modal" data-target="#modalMedico" 
                    onclick="habilitarEdicionMedico(${medico.id});intercalarBotones(0);">
                        ver mas
                    </button>
                    <button type="button" class="btn btn-danger"
                    onclick="eliminarMedico(${medico.id})">
                        <i class="zmdi zmdi-delete"></i>
                    </button>
                </div>
            </div>`;
        });
    }
}

/**
 * habilitamos la funcion para editar
 */
async function habilitarEdicionMedico(id) {
    datosMedico = await obtenerMedicos(id);
    let form = document.getElementById('formMedico');
    console.log(datosMedico);
    form[0].value = datosMedico.id;
    for(let key in datosMedico){
        for(i=1;i<form.length;i++){
            if(form[i].name==key){
                form[i].value= datosMedico[key];
            }
        }
    }
    $('#modalMedico').modal('show');
}

/**
 * @param {Number} id 
 * modifica los datos de un dato
 *  */
function modificarMedico(){
    let id = document.getElementById('idMedico').value;
    datosMedico = new FormData(document.getElementById('formMedico'));
    datosMedico = JSON.parse(JSON.stringify(Object.fromEntries(datosMedico)));
    axios.put(URL_M+`?id=${id}`,datosMedico)
    .then(r=>{
        mostrarMedicos();
    }).catch(error=>console.error(error));
}
/**
 * elimina un medico
 */
function eliminarMedico(id){
    Swal.fire({
        title: 'Estas seguro?',
        text: "No podras revertir esto!!",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33f',
        confirmButtonText: 'Si, seguro!!',
        cancelButtonText: 'Cancelar'
    }).then(result=>{
        if(result.isConfirmed){
            axios.delete(URL_M+`?id=${id}`)
            .then(r=>{
                mostrarMedicos();
            }).catch(error=>console.error(error));
        }
    }).catch(error=>console.error(error));
}

async function buscarMedico(valor){
    try{
        let {data} = await axios.get(URL_M+`?valor=${valor}`);
        rellenarTablaMedico(data);  
    }catch(e){
        console.error(e);
    }
}