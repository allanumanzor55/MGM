<?php
header('Content-Type: application/json');
include_once('../class/class-login.php');
//crear conexion para metodos estaticos, ya que en estos nos se pueden instanciar clases
$db = new Conexion();
$cnn = $db->getConexion();
switch($_POST['accion']){
    case 'LOGIN':
        $login = new Login($_POST['usuario'],$_POST['password']);
        echo json_encode($login->login());
    break;
    case 'VERIFICAR':
        
    break; 
    case 'PERMISOS':
        echo json_encode(Login::obtenerPermisos($cnn));
    break;
    case 'LOGOUT':
        Login::logout($cnn);
    break;
    case 'MP':
        if(isset($_POST['password'])){
            echo Login::verificarPM($cnn,$_POST['password']);
        }
    break;
}
?>