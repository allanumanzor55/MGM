<?php
header('Content-Type: application/json');
include_once('../class/class-login.php');
include_once('../class/class-fichaProducto.php');
//crear conexion para metodos estaticos, ya que en estos nos se pueden instanciar clases
$db = new Conexion();
$cnn = $db->getConexion();
if (Login::validarLogin($cnn)) {
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST'://guardar
            $productoFinal = new FichaProducto($_POST['descripcion'],$_POST['materiaPrima'],$_POST['precio'],json_decode($_POST['materiales'],true));
            echo $productoFinal->guardar();
        break;
        case 'GET'://visualizar
            if(isset($_GET['id']) && $_GET['id']!="undefined"){//obtener un registro
                echo json_encode(FichaProducto::obtener($_GET['id'],$cnn),true);
            }elseif(isset($_GET['valor']) && $_GET['valor']!="undefined"){//buscar
                echo json_encode(FichaProducto::buscar($_GET['valor'],$cnn),true);
            }else{//obtener todos
                echo json_encode(FichaProducto::obtenerTodos($cnn),true);
            }
        break; 
        case 'PUT'://modificar
            $_PUT = json_decode(file_get_contents("php://input"), true);
            $_PUT['materiales'] = json_decode($_PUT['materiales'],true);
            if(isset($_PUT['id'])&& $_PUT['id']!="undefined"){
                $productoFinal = new FichaProducto($_PUT['descripcion'],$_PUT['materiaPrima'],$_PUT['precio'],$_PUT['materiales']);
                echo $productoFinal->modificar($_PUT['id']);
            }
        break;
        case 'DELETE'://eliminar
            echo FichaProducto::eliminar($_GET['id'],$cnn);
        break;
    }
}
?>