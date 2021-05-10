<?php
header('Content-Type: application/json');
include_once('../class/class-login.php');
//crear conexion para metodos estaticos, ya que en estos nos se pueden instanciar clases
$db = new Conexion();
$cnn = $db->getConexion();
switch($_POST['accion']){
    case 'LOGIN':
        
    break;
    case 'VERIFICAR':
        
    break; 
    case 'PERMISOS':
        
    break;
    case 'LOGOUT':
        
    break;
}
?>