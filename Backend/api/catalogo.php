<?php
header('Content-Type: application/json');
include_once('../class/class-catalogo.php');
//crear conexion para metodos estaticos, ya que en estos nos se pueden instanciar clases
$db = new Conexion();
$cnn = $db->getConexion();
switch($_SERVER['REQUEST_METHOD']){
    case 'POST'://guardar
        $bodega = new Catalogo($_POST['nombreProducto'],$_POST['descripcionProducto'],$_POST['precio']);
        echo $bodega->guardar();
    break;
    case 'GET'://visualizar
        $response;
        if(isset($_GET['id']) && $_GET['id']!="undefined"){//obtener un registro
            echo json_encode(Catalogo::obtener($_GET['id'],$cnn),true);
        }elseif(isset($_GET['valor']) && $_GET['valor']!="undefined"){//buscar
            echo json_encode(Catalogo::buscar($_GET['valor'],$cnn),true);
        }else{
            echo json_encode(Catalogo::obtenerTodos($cnn),true);
        }
    break; 
    case 'PUT'://modificar
        $_PUT = json_decode(file_get_contents("php://input"), TRUE);
        $bodega = new Catalogo($_PUT['nombreProducto'],$_PUT['descripcionProducto'],$_PUT['precio']);
        echo $bodega->modificar($_PUT['id']);
    break;
    case 'DELETE'://eliminar
        echo Catalogo::eliminar($_GET['id'],$cnn);
    break;
}
?>