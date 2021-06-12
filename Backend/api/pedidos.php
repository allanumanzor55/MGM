<?php
header('Content-Type: application/json');
include_once('../class/class-pedido.php');
//crear conexion para metodos estaticos, ya que en estos nos se pueden instanciar clases
$db = new Conexion();
$cnn = $db->getConexion();
$_POST = json_decode(file_get_contents("php://input"), true); 
switch($_SERVER['REQUEST_METHOD']){
    case 'POST'://guardar
        $pedido = new Pedido($_POST['descripcion'],$_POST['cliente'],$_POST['estadoPago'],$_POST['productos']);
        echo $pedido->guardar();
    break;
    case 'GET'://visualizar
        if(isset($_GET['id']) && $_GET['id']!="undefined"){//obtener un registro
            echo json_encode(Pedido::obtener($_GET['id'],$cnn),true);
        }elseif(isset($_GET['valor']) && $_GET['valor']!="undefined"){//buscar
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