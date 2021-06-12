<?php
header('Content-Type: application/json');
include_once('../class/class-empleado.php');
//crear conexion para metodos estaticos, ya que en estos nos se pueden instanciar clases
$db = new Conexion();
$cnn = $db->getConexion();
switch($_SERVER['REQUEST_METHOD']){
    case 'POST'://guardar
        $empleado = new Empleado(intval($_POST['tipoEmpleado']),$_POST['dni'],$_POST['nombre'],$_POST['primerApellido'],
                                $_POST['segundoApellido'],$_POST['direccion'],$_POST['correo'],$_POST['celular'],
                                $_POST['telefono'],floatval($_POST['sueldo']));
        echo $empleado->guardar();
    break;
    case 'GET'://visualizar
        $response;
        if(isset($_GET['id']) && $_GET['id']!="undefined"){//obtener un registro
            echo json_encode(Empleado::obtener($_GET['id'],$cnn),true);
        }elseif(isset($_GET['valor']) && $_GET['valor']!="undefined"){//buscar
            echo json_encode(Empleado::buscar($_GET['valor'],$cnn),true);
        }elseif(isset($_GET['tipo']) && $_GET['tipo']!="undefined"){//obtener un registro por tipo
            echo json_encode(Empleado::obtenerPorTipo($cnn,$_GET['tipo']));
        }elseif(isset($_GET['clase']) && isset($_COOKIE['idUser']) && $_COOKIE['idUser']!="undefined"){
            $idUs = $_COOKIE['idUser'];
            $result = $cnn->query("SELECT idEmpleado FROM vw_usuarios WHERE idUsuario=$idUs")->fetch(PDO::FETCH_ASSOC);
            echo json_encode(Empleado::obtener($result['idEmpleado'],$cnn),true);
        }else{
            echo json_encode(Empleado::obtenerTodos($cnn),true);
        }
    break; 
    case 'PUT'://modificar
        $_PUT = json_decode(file_get_contents("php://input"), TRUE);
        $empleado = new Empleado($_PUT['tipoEmpleado'],$_PUT['dni'],$_PUT['nombre'],$_PUT['primerApellido'],
                                $_PUT['segundoApellido'],$_PUT['direccion'],$_PUT['correo'],$_PUT['celular'],
                                $_PUT['telefono'],floatval($_PUT['sueldo']));
        echo $empleado->modificar($_PUT['id']);
    break;
    case 'DELETE'://eliminar
        echo Empleado::eliminar($_GET['id'],$cnn);
    break;
}
?>