<?php
    header('Content-Type: application/json');
    //crear conexion para metodos estaticos, ya que en estos nos se pueden instanciar clases
    $db = new Conexion();
    $cnn = $db->getConexion();
    $_POST = json_decode(file_get_contents("php://input"), true); 
    if($_GET['clase']=="cliente"){
        include_once('../class/class-tipoCliente.php');
        switch($_SERVER['REQUEST_METHOD']){
            case 'POST'://guardar
                $tipoCliente = new TipoCliente($_POST['descripcion']);
                echo $tipoCliente->guardar();
            break;
            case 'GET'://visualizar
                if(isset($_GET['id'])){//obtener un registro
                    echo json_encode(TipoCliente::obtener($_GET['id'],$cnn),true);
                }elseif(isset($_GET['valor'])){//buscar
                    echo json_encode(TipoCliente::buscar($_GET['valor'],$cnn),true);
                }else{//obtener todos
                    echo json_encode(TipoCliente::obtenerTodos($cnn),true);
                }
            break; 
            case 'PUT'://modificar
                $_PUT = json_decode(file_get_contents("php://input"), TRUE);
                $tipoCliente = new TipoCliente($_PUT['descripcion']);
                echo $tipoCliente->modificar($_GET['id']);
            break;
            case 'DELETE'://eliminar
                echo TipoCliente::eliminar($_GET['id'],$cnn);
            break;
        }
    }elseif($_GET['clase']=="empleado"){
        include_once('../class/class-tipoEmpleado.php');
        switch($_SERVER['REQUEST_METHOD']){
            case 'POST'://guardar
                $tipoEmpleado = new TipoEmpleado($_POST['descripcion']);
                echo $tipoEmpleado->guardar();
            break;
            case 'GET'://visualizar
                if(isset($_GET['id'])){//obtener un registro
                    echo json_encode(TipoEmpleado::obtener($_GET['id'],$cnn),true);
                }elseif(isset($_GET['valor'])){//buscar
                    echo json_encode(TipoEmpleado::buscar($_GET['valor'],$cnn),true);
                }else{//obtener todos
                    echo json_encode(TipoEmpleado::obtenerTodos($cnn),true);
                }
            break; 
            case 'PUT'://modificar
                $_PUT = json_decode(file_get_contents("php://input"), TRUE);
                $tipoEmpleado = new TipoEmpleado($_PUT['descripcion']);
                echo $tipoEmpleado->modificar($_GET['id']);
            break;
            case 'DELETE'://eliminar
                echo TipoEmpleado::eliminar($_GET['id'],$cnn);
            break;
        }
    }
    
?>