<?php
header('Content-Type: application/json');
include_once('../class/class-empleado.php');
//crear conexion para metodos estaticos, ya que en estos nos se pueden instanciar clases
$db = new Conexion();
$cnn = $db->getConexion();
$_POST = json_decode(file_get_contents("php://input"), true); 
switch($_SERVER['REQUEST_METHOD']){
    case 'POST'://guardar
        $empleado = new Empleado(intval($_POST['tipoEmpleado']),$_POST['dni'],$_POST['nombre'],$_POST['primerApellido'],
                                $_POST['segundoApellido'],$_POST['direccion'],$_POST['correo'],$_POST['celular'],
                                $_POST['telefono'],floatval($_POST['sueldo']));
        echo $empleado->guardar();
    break;
    case 'GET'://visualizar
        $response;
        if(isset($_GET['id'])){//obtener un registro
            echo json_encode(Empleado::obtener($_GET['id'],$cnn),true);
        }elseif(isset($_GET['valor'])){//buscar
            echo json_encode(Empleado::buscar($_GET['valor'],$cnn),true);
        }else{//obtener todos
            echo json_encode(Empleado::obtenerTodos($cnn),true);
        }
    break; 
    case 'PUT'://modificar
        $_PUT = json_decode(file_get_contents("php://input"), TRUE);
        parse_str(file_get_contents("php://input"),$_PUT);
        $empleado = new Empleado($_POST['tipoEmpleado'],$_POST['dni'],$_POST['nombre'],$_POST['primerApellido'],
                                $_POST['segundoApellido'],$_POST['direccion'],$_POST['correo'],$_POST['celular'],
                                $_POST['telefono'],floatval($_POST['sueldo']));
        echo $empleado->modificar($_GET['id']);
    break;
    case 'DELETE'://eliminar
        echo Empleado::eliminar($_GET['id'],$cnn);
    break;
}
?>