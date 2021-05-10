<?php
    header('Content-Type: application/json');
    //crear conexion para metodos estaticos, ya que en estos nos se pueden instanciar clases
    include_once('../class/class-categoria.php');
    include_once('../class/class-estilo.php');
    $db = new Conexion();
    $cnn = $db->getConexion();
    $_POST = json_decode(file_get_contents("php://input"), true); 
    if($_POST['clase']=="categoria"){
        switch($_SERVER['REQUEST_METHOD']){
            case 'POST'://guardar
                $categoria = new Categoria($_POST['descripcion']);
                echo $categoria->guardar();
            break;
            case 'GET'://visualizar
                if(isset($_GET['id'])){//obtener un registro
                    echo json_encode(Categoria::obtener($_GET['id'],$cnn),true);
                }elseif(isset($_GET['valor'])){//buscar
                    echo json_encode(Categoria::buscar($_GET['valor'],$cnn),true);
                }else{//obtener todos
                    echo json_encode(Categoria::obtenerTodos($cnn),true);
                }
            break; 
            case 'PUT'://modificar
                $_PUT = json_decode(file_get_contents("php://input"), TRUE);
                $categoria = new Categoria($_PUT['descripcion']);
                echo $categoria->modificar($_GET['id']);
            break;
            case 'DELETE'://eliminar
                echo Categoria::eliminar($_GET['id'],$cnn);
            break;
        }
    }elseif($_POST['clase']=="estilo"){
        switch($_SERVER['REQUEST_METHOD']){
            case 'POST'://guardar
                $estilo = new Estilo($_POST['descripcion']);
                echo $estilo->guardar();
            break;
            case 'GET'://visualizar
                if(isset($_GET['id'])){//obtener un registro
                    echo json_encode(Estilo::obtener($_GET['id'],$cnn),true);
                }elseif(isset($_GET['valor'])){//buscar
                    echo json_encode(Estilo::buscar($_GET['valor'],$cnn),true);
                }else{//obtener todos
                    echo json_encode(Estilo::obtenerTodos($cnn),true);
                }
            break; 
            case 'PUT'://modificar
                $_PUT = json_decode(file_get_contents("php://input"), TRUE);
                $estilo = new Estilo($_PUT['descripcion']);
                echo $estilo->modificar($_GET['id']);
            break;
            case 'DELETE'://eliminar
                echo Estilo::eliminar($_GET['id'],$cnn);
            break;
        }
    }
    
?>