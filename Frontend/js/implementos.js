function limpiarFormulario(query) {
    let form = document.querySelAll(query);
    form.forEach(el => {
        el.value = "";
    })
}
/**alternamos la visibilidad de los botones segun la operacion
 * 1 es para guardar, cualquier otro es para modificar
 */
function intercalarBotones(opcion) {
    let bt1 = document.getElementById('btnGuardar');
    let bt2 = document.getElementById('btnModificar');
    if (opcion == 1) { //si es 1 se va a guardar
        bt1.style.display = 'block';
        bt2.style.display = 'none';
    } else { //si no es 1 se va a modificar
        bt1.style.display = 'none';
        bt2.style.display = 'block';
    }
}