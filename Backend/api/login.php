<?php
header('Content-Type: application/json');
include_once('../class/class-login.php');
//crear conexion para metodos estaticos, ya que en estos nos se pueden instanciar clases
$db = new Conexion();
$cnn = $db->getConexion();
if(isset($_GET['masterPassword'])){
    if($_GET['masterPassword']=="1234"){
        echo "Hola";
    }else{
        echo new Error("Contraseña Incorrecta");
    }
}
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