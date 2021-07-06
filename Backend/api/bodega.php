<?php
header('Content-Type: application/json');
include_once('../class/class-bodega.php');
//crear conexion para metodos estaticos, ya que en estos nos se pueden instanciar clases
$db = new Conexion();
$cnn = $db->getConexion();
switch($_SERVER['REQUEST_METHOD']){
    case 'POST'://guardar
        $bodega = new Bodega($_POST['descripcion'],$_POST['ubicacion']);
        echo $bodega->guardar();
    break;
    case 'GET'://visualizar
        $response;
        if(isset($_GET['id']) && $_GET['id']!="undefined"){//obtener un registro
            echo json_encode(Bodega::obtener($_GET['id'],$cnn),true);
        }elseif(isset($_GET['valor']) && $_GET['valor']!="undefined"){//buscar
            echo json_encode(Bodega::buscar($_GET['valor'],$cnn),true);
        }else{
            echo json_encode(Bodega::obtenerTodos($cnn),true);
        }
    break; 
    case 'PUT'://modificar
        $_PUT = json_decode(file_get_contents("php://input"), TRUE);
        $bodega = new Bodega($_PUT['descripcion'],$_PUT['ubicacion']);
        echo $bodega->modificar($_PUT['id']);
    break;
    case 'DELETE'://eliminar
        echo Bodega::eliminar($_GET['id'],$cnn);
    break;
}
?>