const URLs = {
    "medicos":"Medicos.php",
    "administradores":"EmpleadoAdm.php",
    "enfermeras":"Enfermera.php",
    "tecnicos":"TecnicoLab.php"
};

async function guardar(btn){
    btn.style.disabled=true;
    let datos = new FormData(document.getElementById('form'+btn.dataset.object));
    await axios.post(btn.dataset.url,datos)
    btn.style.disabled=false;
    $('#modal'+btn.dataset.object).modal('hide');
    obtener(btn.dataset.url,null);
}

async function eliminar(btn){
    btn.style.disabled=true;
    Swal.fire({
        title: 'Estas seguro?',
        text: "No podras revertir esto!!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33f',
        confirmButtonText: 'Si, seguro!!'
    }).then((result) => {
            if (result.isConfirmed) {
                await axios.delete(btn.dataset.url+`?id=${btn.dataset.id}`);
                btn.style.disabled=false
            }
        }
    );
}




async function obtener(url,id){
    let URL = (`../Backend/api/`) + url +((id>0||id!=null)?`?id=${id}`:``);    
    try{
        const {data}= await axios.get(URL)
        return data;
    }catch(e){console.error(e.message)}
}

