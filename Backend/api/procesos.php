<?php
header('Content-Type: application/json');
include_once('../class/class-procesos.php');
//crear conexion para metodos estaticos, ya que en estos nos se pueden instanciar clases
$db = new Conexion();
$cnn = $db->getConexion();
switch($_SERVER['REQUEST_METHOD']){
    case 'POST'://guardar
        $proceso = new Procesos($_POST['descripcion']);
        echo $proceso->guardar();
    break;
    case 'GET'://visualizar
        $response;
        if(isset($_GET['id']) && $_GET['id']!="undefined"){//obtener un registro
            $response= Procesos::obtener($_GET['id'],$cnn);
        }elseif(isset($_GET['valor']) && $_GET['valor']!="undefined"){//obtener un registro
            $response= Procesos::buscar($_GET['valor'],$cnn);
        }else{//obtener todos
            $response= Procesos::obtenerTodos($cnn);
        }
        echo (!$response)?'{"mensaje":"no existe registro}':json_encode($response);//imprimimos en pantalla el resultado y lo convertimos a json
    break; 
    case 'PUT'://modificar
        $_PUT = json_decode(file_get_contents("php://input"), TRUE);
        $proceso = new Procesos($_PUT['descripcion']);
        echo $proceso->modificar($_PUT['id']);
    break;
    case 'DELETE'://eliminar
        echo Procesos::eliminar($_GET['id'],$cnn);
    break;
}
?>