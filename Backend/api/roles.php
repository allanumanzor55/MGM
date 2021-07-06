<?php
    header('Content-Type: application/json');
    //crear conexion para metodos estaticos, ya que en estos nos se pueden instanciar clases
    include_once('../class/class-roles.php');
    $db = new Conexion();
    $cnn = $db->getConexion();
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST'://guardar
            //$_POST = json_decode(file_get_contents("php://input"), true); 
            $rol = new Roles($_POST['rol'],$_POST['descripcion'],intval($_POST['empleado']),intval($_POST['cliente']),intval($_POST['inventario']),
            intval($_POST['guiaRemision']),intval($_POST['bodega']),intval($_POST['catalogo']),intval($_POST['cotizacion']),intval($_POST['configuracion']));
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
                $rol = new Roles($_PUT['rol'],$_PUT['descripcion'],intval($_PUT['empleado']),intval($_PUT['cliente']),intval($_PUT['inventario']),
                intval($_PUT['guiaRemision']),intval($_PUT['bodega']),intval($_PUT['catalogo']),intval($_PUT['cotizacion']),intval($_PUT['configuracion']));
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