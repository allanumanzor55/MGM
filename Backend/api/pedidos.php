<?php
header('Content-Type: application/json');
include_once('../class/class-pedido.php');
//crear conexion para metodos estaticos, ya que en estos nos se pueden instanciar clases
$db = new Conexion();
$cnn = $db->getConexion();
switch($_SERVER['REQUEST_METHOD']){
    case 'POST'://guardar
    break;
    case 'GET'://visualizar
        if(isset($_GET['id'])){//obtener un registro
            echo json_encode(Pedido::obtener($_GET['id'],$cnn),true);
        }elseif(isset($_GET['valor'])){//buscar
            echo json_encode(Pedido::buscar($_GET['valor'],$cnn),true);
        }else{//obtener todos
            echo json_encode(Pedido::obtenerTodos($cnn),true);
        }
    break; 
    case 'PUT'://modificar
        $_PUT = json_decode(file_get_contents("php://input"), TRUE);
        
    break;
    case 'DELETE'://eliminar
        Pedido::eliminar($_GET['id'],$cnn);
    break;
}
?>