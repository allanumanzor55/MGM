const URL_LOGIN = '../Backend/api/Login.php';
async function login(){
    var datosLogin = new FormData(document.getElementById('formLogin'));
    datosLogin.append("accion","login");
    const {data} = await axios.post(URL_LOGIN,datosLogin);
    if (data.valido) {
        $('#modalInicioSesion').modal('hide');
        await Swal.fire({
            icon: 'success',
            title: 'Bienvenido',
            showConfirmButton: false,
            timer: 1500
        });
        window.location.href = "index.php"
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Las credenciales estan incorrectas',
        });
    }
}
function logout(){

}
