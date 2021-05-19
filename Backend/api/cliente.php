<?php
header('Content-Type: application/json');
include_once('../class/class-cliente.php');
//crear conexion para metodos estaticos, ya que en estos nos se pueden instanciar clases
$db = new Conexion();
$cnn = $db->getConexion();
switch($_SERVER['REQUEST_METHOD']){
    case 'POST'://guardar
        $cliente = new Cliente( intval($_POST['tipoCliente']),$_POST['dni'],$_POST['nombre'],$_POST['primerApellido'],
                                $_POST['segundoApellido'],$_POST['direccion'],$_POST['correo'],$_POST['celular'],
                                $_POST['telefono'],floatval($_POST['edad']));
        echo $cliente->guardar();
    break;
    case 'GET'://visualizar
        $response;
        if(isset($_GET['id'])){//obtener un registro
            echo json_encode(Cliente::obtener($_GET['id'],$cnn),true);
        }elseif(isset($_GET['valor'])){//buscar
            echo json_encode(Cliente::buscar($_GET['valor'],$cnn),true);
        }else{//obtener todos
            echo json_encode(Cliente::obtenerTodos($cnn),true);
        }
    break; 
    case 'PUT'://modificar
        $_PUT = json_decode(file_get_contents("php://input"), TRUE);
        $cliente = new Cliente( $_POST['tipoCliente'],$_POST['dni'],$_POST['nombre'],$_POST['primerApellido'],
                                $_POST['segundoApellido'],$_POST['direccion'],$_POST['correo'],$_POST['celular'],
                                $_POST['telefono'],floatval($_POST['edad']));
        echo $cliente->modificar($_GET['id']);
    break;
    case 'DELETE'://eliminar
        echo Cliente::eliminar($_GET['id'],$cnn);
    break;
}
?>