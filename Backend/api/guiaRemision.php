<?php
header('Content-Type: application/json');
include_once('../class/class-guiaRemision.php');
//crear conexion para metodos estaticos, ya que en estos nos se pueden instanciar clases
$db = new Conexion();
$cnn = $db->getConexion();
switch($_SERVER['REQUEST_METHOD']){
    case 'POST'://guardar
        $guiaRemision = new GuiaRemision($_COOKIE['id'],$_POST['motivoTraslado'],$_POST['bodegaSalida'],$_POST['bodegaEntrada'],
        json_decode($_POST['materiaPrima'],true),json_decode($_POST['materiales'],true));
        echo $guiaRemision->guardar();
    break;
    case 'GET'://visualizar
        if(isset($_GET['id']) && $_GET['id']!="undefined"){//obtener un registro
            echo json_encode(GuiaRemision::obtener($_GET['id'],$cnn),true);
        }elseif(isset($_GET['valor']) && $_GET['valor']!="undefined"){//buscar
            echo json_encode(GuiaRemision::buscar($_GET['valor'],$cnn),true);
        }else{//obtener todos
            echo json_encode(GuiaRemision::obtenerTodos($cnn),true);
        }
    break; 
    case 'PUT'://modificar
        $_PUT = json_decode(file_get_contents("php://input"), true);
        $_PUT['materiales'] = json_decode($_PUT['materiales'],true);
        $_PUT['materiaPrima'] = json_decode($_PUT['materialPrima'],true);
        if(isset($_PUT['id'])&& $_PUT['id']!="undefined"){
            //$guiaRemision = new GuiaRemision($_PUT['materiaPrima'],$_PUT['materiales']);
            //echo $guiaRemision->modificar($_PUT['id']);
        }
    break;
    case 'DELETE'://eliminar
        echo GuiaRemision::eliminar($_GET['id'],$cnn);
    break;
}
?>