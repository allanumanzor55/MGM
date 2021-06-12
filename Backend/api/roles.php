<?php
    header('Content-Type: application/json');
    //crear conexion para metodos estaticos, ya que en estos nos se pueden instanciar clases
    include_once('../class/class-roles.php');
    $db = new Conexion();
    $cnn = $db->getConexion();
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST'://guardar
            //$_POST = json_decode(file_get_contents("php://input"), true); 
            $_POST['empleados'] =(!isset($_POST['empleados']))?false:$_POST['empleados'];
            $_POST['clientes'] =(!isset($_POST['clientes']))?false:$_POST['clientes'];
            $_POST['inventario'] =(!isset($_POST['inventario']))?false:$_POST['inventario'];
            $_POST['ventas'] =(!isset($_POST['ventas']))?false:$_POST['ventas'];
            $_POST['configuracion'] =(!isset($_POST['configuracion']))?false:$_POST['configuracion'];
            $rol = new Roles($_POST['rol'],boolval($_POST['empleados']),boolval($_POST['clientes']),boolval($_POST['inventario']),boolval($_POST['ventas']),boolval($_POST['configuracion']));
            echo $rol->guardar();
        break;
        case 'GET'://visualizar
            if(isset($_GET['id']) && $_GET['id']!="undefined"){//obtener un registro
                echo json_encode(Roles::obtener($_GET['id'],$cnn),true);
            }elseif(isset($_GET['valor']) && $_GET['valor']!="undefined"){//buscar
                echo json_encode(Roles::buscar($_GET['valor'],$cnn),true);
            }else{//obtener todos
                echo json_encode(Roles::obtenerTodos($cnn),true);
            }
        break; 
        case 'PUT'://modificar
            $_PUT = json_decode(file_get_contents("php://input"),true);
            if(isset($_PUT)){
                $_PUT['empleados'] =(!isset($_PUT['empleados']))?false:$_PUT['empleados'];
                $_PUT['clientes'] =(!isset($_PUT['clientes']))?false:$_PUT['clientes'];
                $_PUT['inventario'] =(!isset($_PUT['inventario']))?false:$_PUT['inventario'];
                $_PUT['ventas'] =(!isset($_PUT['ventas']))?false:$_PUT['ventas'];
                $_PUT['configuracion'] =(!isset($_PUT['configuracion']))?false:$_PUT['configuracion'];
                $rol = new Roles($_PUT['rol'],$_PUT['empleados'],$_PUT['clientes'],$_PUT['inventario'],$_PUT['ventas'],$_PUT['configuracion']);
                echo $rol->modificar($_PUT['id']);
            }else{
                echo file_get_contents("php://input");
            }
        break;
        case 'DELETE'://eliminar
            echo Roles::eliminar($_GET['id'],$cnn);
        break;
    }
?>