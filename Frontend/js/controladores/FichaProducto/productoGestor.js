const URL_PRODUCTO = '../Backend/api/fichaProducto.php'
const D_PRODUCTO = { idForm: "formFichaProducto" }
let jsonMaterialesFichaProductos = []
/**Json para inventario que se almacenara en un json estatico*/
let jsonMaterial={idInventario:"",descripcion:"",empresa:"",marca:"",precio:0,cantidad:0}
/**Arreglo de materiales que se han ingresado y que perduraran en el sistema para asi manejar un mini-CRUD */
let jsonMateriales = []
/**JSON de La materia prima que se ha seleccionado y que perdurara en el sistema para asi manejar un mini-CRUD */
let jsonMateriaPrima={idInventario:"",descripcion:"",tipo:"",material:"",estilo:"",talla:"",empresa:""}
/** Arreglo de Json's de los materiales que se enviaran por medio de post */
let datosPostMateriales =[]
let cantidadMaterial=0,material=0
let centinelaMateriales = false, centinelaMateriaPrima = false
async function guardarFichaProducto(btn) {
    if (centinelaMateriaPrima) {
        if (centinelaMateriales) {
            if (validarCamposNivel1(D_PRODUCTO.idForm)) {
                document.getElementById('materiales').value = JSON.stringify(datosPostMateriales)
                try {
                    await guardar(btn, URL_PRODUCTO, D_PRODUCTO) 
                    limpiarVariables()
                } catch (error) {
                    Swal.fire({ icon: 'error', title: "Algo salio mal... ", text: error.message})
                }
            } else {
                Swal.fire({ icon: 'warning', title: 'completa todos los campos' })
            }
        } else {
            Swal.fire({ icon: 'warning', title: 'ingrese materiales' })
        }
    } else {
        Swal.fire({ icon: 'warning', title: 'ingrese la materia prima a usar' })
    }
}

async function eliminarFichaProducto(btn,id){ 
    try {
        await eliminar(btn,URL_PRODUCTO,{id:id})
        refrescarAcordionFichaProducto()
    }catch (error) {
        Swal.fire({ icon: 'error', title: "Algo salio mal... ", text: e.message})
    }
}

async function modificarFichaProducto(id){
    try {
        limpiarVariables()
        const datosFichaProducto = await obtener(URL_PRODUCTO,{id:id})
        console.log(datosFichaProducto);
        document.getElementById('idFichaProducto').value = id
        document.getElementById('descripcionPro').value=datosFichaProducto.descripcionFicha
        document.getElementById('precioPro').value=datosFichaProducto.precio
        document.getElementById('materiaPrima').value= datosFichaProducto.idMateriaPrima
        jsonMateriaPrima.idInventario = datosFichaProducto.idMateriaPrima
        jsonMateriaPrima.descripcion = datosFichaProducto.descripcionMateriaPrima
        jsonMateriaPrima.tipo = datosFichaProducto.tipo
        jsonMateriaPrima.material = datosFichaProducto.material
        jsonMateriaPrima.estilo = datosFichaProducto.estilo 
        jsonMateriaPrima.talla = datosFichaProducto.talla 
        jsonMateriaPrima.empresa = datosFichaProducto.proveedor
        jsonMateriales = datosFichaProducto.materiales
        jsonMateriales.forEach(element => {
            datosPostMateriales.push({material:element.idMaterial,cantidad:parseInt(element.cantidad)})
        });
        document.getElementById('materiales').value = JSON.stringify(datosPostMateriales)
        centinelaMateriaPrima=true
        centinelaMateriales=true
        rellenarAcordionPrima()
        rellenarAcordionMateriales('datosMaterial')
        intercalarBotones('formFichaProducto2',false)
        seleccionarTabFichaProducto(true)
    } catch (error) {
        Swal.fire({ icon: 'error', title: "Algo salio mal... ", text: error.message})
        console.log(error);
    }
}

async function confirmarModificarFichaProducto(btn){
    try{
        document.getElementById('v-pills-producto-tab').disabled=true
        await modificar(btn,URL_PRODUCTO,{idForm:"formFichaProducto"})
        await refrescarAcordionFichaProducto(btn)
        limpiarVariables()
        intercalarBotones('formFichaProducto2',true)
        document.getElementById('v-pills-producto-tab').disabled=false
    }catch(e){
        Swal.fire({ icon: 'error', title: "Algo salio mal... ", text: e.message})
    }
}

/**
 * funcion que agrega el id del material (ya sea prima o material general) 
 * @param {HTMLObject} btn 
 * @param {String} datosMaterial String de datos de material, que se convertira en un array con split
 * @param {*} clase //tipo de inventario
 */
function agregarIdMaterial(btn, datosMaterial, clase) {
    let j=0
    datosMaterial = datosMaterial.split('|')
    if(clase=="Prima"){
        centinelaMateriaPrima=true
        document.getElementById('materiaPrima').value=datosMaterial[0]
        for(let i in jsonMateriaPrima){
            jsonMateriaPrima[i] = datosMaterial[j]
            j++
        }
        rellenarAcordionPrima()
    }else if(clase=="Material"){
        datosMaterial.push(0)
        material = datosMaterial[0]//idInventario
        for(let i in jsonMaterial){
            jsonMaterial[i] = datosMaterial[j]
            j++
        }
        document.getElementById('cantidadMaterial').focus()
    }
}

/**
 * 
 * @param {int} value 
 * funcion que agrega la cantidad del material agregado a la ficha
 */
function agregarCantidadMaterial(value){
    value = parseInt(value)
    if(value>0){
        cantidadMaterial=value
        document.getElementById('btnCantidad').disabled=false
    }else{
        document.getElementById('btnCantidad').disabled=true
    }
}

/**
 * agrega el material a la ficha de producto
 */
function agregarMaterial() {
    centinelaMateriales=true
    jsonMaterial.cantidad = cantidadMaterial
    datosPostMateriales.push({material:material,cantidad:cantidadMaterial})
    document.getElementById('materiales').value = JSON.stringify(datosPostMateriales)
    jsonMateriales.push(jsonMaterial)
    jsonMaterial={idInventario:"",descripcion:"",empresa:"",marca:"",precio:0,cantidad:0}
    document.getElementById('cantidadMaterial').value=0
    document.getElementById('btnCantidad').disabled=true
    rellenarAcordionMateriales('datosMaterial')
}

/**
 * elimina la materia prima seleccionada
 */
function quitarMateriaPrima(){
    document.getElementById('materiaPrima').value=0
    document.getElementById('datosPrima').innerHTML= `No hay materia prima seleccionada`
}

/**
 * 
 * @param {int} index elimina el indice del arreglo perteneciente al json del material seleccionado
 */
function quitarMaterial(index){
    jsonMateriales.splice(index,1)
    datosPostMateriales.splice(index,1)
    document.getElementById('materiales').value = JSON.stringify(datosPostMateriales)
    rellenarAcordionMateriales('datosMaterial')
}

/**
 * inicializa todas las variables para que no hayan problemas despues de guardar o modificar un producto
 */
function limpiarVariables(){
    jsonMaterialesFichaProductos = []
    datosPostMateriales = []
    jsonMateriales = []
    jsonMateriaPrima={idInventario:"",descripcion:"",tipo:"",material:"",estilo:"",talla:"",empresa:""}
    jsonMaterial={idInventario:"",descripcion:"",empresa:"",marca:"",precio:0,cantidad:0}
    cantidadMaterial=0,material=0
    centinelaMateriales = false, centinelaMateriaPrima = false
    quitarMateriaPrima()
    document.getElementById('datosMaterial').innerHTML=`No hay materiales seleccionados`
    document.getElementById('materiales').value = ""
}


