const URL_LOGIN = '../Backend/api/login.php';
async function login(btn) {
    btn.disabled = true
    var datosLogin = new FormData(document.getElementById('formLogin'));
    datosLogin.append("accion", "LOGIN");
    const { data } = await axios.post(URL_LOGIN, datosLogin)
    if (data.validado) {
        await Swal.fire({
            icon: 'success',
            title: data.mensaje,
            showConfirmButton: false,
            timer: 1500
        });
        window.location.href = "index.php"
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: data.mensaje,
        });
    }
    btn.disabled = false
}
async function logout() {
    const r = await Swal.fire({
        icon: 'question',
        title: "Cerrar Sesion",
        text: "Estas seguro que deseas cerrar sesion?",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33f',
        confirmButtonText: 'Si, seguro!!'
    })
    if (r.isConfirmed) {
        let datosLogout = new FormData()
        datosLogout.append("accion", "LOGOUT")
        await axios.post(URL_LOGIN, datosLogout)
        window.location.href = "login.php"
    }
}

function getCookie(c_name) {
    if (document.cookie.length > 0) {
        c_start = document.cookie.indexOf(c_name + "=");
        if (c_start != -1) {
            c_start = c_start + c_name.length + 1;
            c_end = document.cookie.indexOf(";", c_start);
            if (c_end == -1)
                c_end = document.cookie.length;
            return unescape(document.cookie.substring(c_start, c_end));
        }
    }
    return "";
}

async function perfil(){
    const datos = await obtener('../Backend/api/empleado.php',{clase:""})
    form = document.getElementById('formPerfil').querySelectorAll('input,textarea')
    form.forEach(el=>{el.disabled=true;el.style.border='none'})
    document.getElementById('perfilDNI').value = datos.dni
    document.getElementById('perfilUsuario').value = datos.usuario
    document.getElementById('perfilNombres').value = datos.nombre
    document.getElementById('perfilApellidos').value = datos.primerApellido + " " + datos.segundoApellido
    document.getElementById('perfilCelular').value = datos.celular
    document.getElementById('perfilTelefono').value = datos.telefono
    document.getElementById('perfilDireccion').value = datos.direccion
}
