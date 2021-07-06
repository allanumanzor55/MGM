<?php
header('Content-Type: application/json');
include_once('../class/class-cotizacion.php');
//crear conexion para metodos estaticos, ya que en estos nos se pueden instanciar clases
$db = new Conexion();
$cnn = $db->getConexion();
switch($_SERVER['REQUEST_METHOD']){
    case 'POST'://guardar
        $bodega = new Cotizacion($_POST['descripcionCotizacion'],json_decode($_POST['productos'],true));
        echo $bodega->guardar();
    break;
    case 'GET'://visualizar
        $response;
        if(isset($_GET['id']) && $_GET['id']!="undefined"){//obtener un registro
            if(isset($_GET['tipo']) && $_GET['tipo']!="undefined"){//obtener un registro
                echo json_encode(Cotizacion::obtenerProductosCotizados($cnn,$id));
            }else{
                echo json_encode(Cotizacion::obtener($_GET['id'],$cnn),true);
            }
        }elseif(isset($_GET['valor']) && $_GET['valor']!="undefined"){//buscar
            echo json_encode(Cotizacion::buscar($_GET['valor'],$cnn),true);
        }else{
            echo json_encode(Cotizacion::obtenerTodos($cnn),true);
        }
    break; 
    case 'PUT'://modificar
        $_PUT = json_decode(file_get_contents("php://input"), TRUE);
        $bodega = new Cotizacion($_PUT['descripcion'],$_PUT['productos']);
        echo $bodega->modificar($_PUT['id']);
    break;
    case 'DELETE'://eliminar
        echo Cotizacion::eliminar($_GET['id'],$cnn);
    break;
}
?>