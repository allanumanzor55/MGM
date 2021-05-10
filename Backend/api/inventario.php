<?php
header('Content-Type: application/json');
include_once('../class/class-inventario.php');
include_once('../class/class-conexion.php');
//crear conexion para metodos estaticos, ya que en estos nos se pueden instanciar clases
$db = new Conexion();
$cnn = $db->getConexion();
switch($_SERVER['REQUEST_METHOD']){
    case 'POST'://guardar
        $inventario = new Inventario($_POST['descripcion'],$_POST['categoria'],$_POST['estilo'],
                                    $_POST['talla'],$_POST['proveedor'],$_POST['color'],
                                    floatval($_POST['precio']),intval($_POST['precio']));
        $inventario->guardar();
    break;
    case 'GET'://visualizar
        $response;
        if(isset($_GET['id'])){//obtener un registro
            echo json_encode(Inventario::obtener($_GET['id'],$cnn),true);
        }elseif(isset($_GET['valor'])){//buscar
            echo json_encode(Inventario::buscar($_GET['valor'],$cnn),true);
        }else{//obtener todos
            echo json_encode(Inventario::obtenerTodos($cnn),true);
        }
    break; 
    case 'PUT'://modificar
        $_PUT = json_decode(file_get_contents("php://input"), TRUE);
        $inventario = new Inventario($_PUT['descripcion'],$_PUT['categoria'],$_PUT['estilo'],
                                    $_PUT['talla'],$_PUT['proveedor'],$_PUT['color'],
                                    floatval($_PUT['precio']),intval($_PUT['precio']));
        $inventario->modificar();
    break;
    case 'DELETE'://eliminar
        Inventario::eliminar($_GET['id'],$cnn);
    break;
}
?>