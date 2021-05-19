<?php
    header('Content-Type: application/json');
    //crear conexion para metodos estaticos, ya que en estos nos se pueden instanciar clases
    include_once('../class/class-tipoCategoria.php');
    include_once('../class/class-categoria.php');
    include_once('../class/class-talla.php');
    $db = new Conexion();
    $cnn = $db->getConexion();
    if($_GET['clase']=="tipo"){
        switch($_SERVER['REQUEST_METHOD']){
            case 'POST'://guardar
                //$_POST = json_decode(file_get_contents("php://input"), true); 
                $tipo = new Tipo($_POST['descripcion'],$_POST['material']);
                echo $tipo->guardar();
            break;
            case 'GET'://visualizar
                if(isset($_GET['id']) && $_GET['id']!="undefined"){//obtener un registro
                    echo json_encode(Tipo::obtener($_GET['id'],$cnn),true);
                }elseif(isset($_GET['valor'])){//buscar
                    echo json_encode(Tipo::buscar($_GET['valor'],$cnn),true);
                }else{//obtener todos
                    echo json_encode(Tipo::obtenerTodos($cnn),true);
                }
            break; 
            case 'PUT'://modificar
                $_PUT = json_decode(file_get_contents("php://input"),true);
                if(isset($_PUT)){
                    $tipo = new Tipo($_PUT['descripcion'],$_PUT['material']);
                    echo $tipo->modificar($_PUT['id']);
                }else{
                    echo file_get_contents("php://input");
                }
            break;
            case 'DELETE'://eliminar
                echo Tipo::eliminar($_GET['id'],$cnn);
            break;
        }
    }elseif($_GET['clase']=="categoria"){
        switch($_SERVER['REQUEST_METHOD']){
            case 'POST'://guardar
                $categoria = new Categoria($_POST['tipo'],$_POST['estilo']);
                echo $categoria->guardar();
            break;
            case 'GET'://visualizar
                if(isset($_GET['id']) && $_GET['id']!="undefined"){//obtener un registro
                    echo json_encode(Categoria::obtener($_GET['id'],$cnn),true);
                }elseif(isset($_GET['valor'])){//buscar
                    echo json_encode(Categoria::buscar($_GET['valor'],$cnn),true);
                }else{//obtener todos
                    echo json_encode(Categoria::obtenerTodos($cnn),true);
                }
            break; 
            case 'PUT'://modificar
                $_PUT = json_decode(file_get_contents("php://input"), TRUE);
                $categoria = new Categoria($_PUT['tipo'],$_PUT['estilo']);
                echo $categoria->modificar($_GET['id']);
            break;
            case 'DELETE'://eliminar
                echo Categoria::eliminar($_GET['id'],$cnn);
            break;
        }
    }elseif($_GET['clase']=="talla"){
        switch($_SERVER['REQUEST_METHOD']){
            case 'POST'://guardar
                $talla = new Talla($_POST['descripcion']);
                echo $talla->guardar();
            break;
            case 'GET'://visualizar
                if(isset($_GET['id']) && $_GET['id']!="undefined"){//obtener un registro
                    echo json_encode(Talla::obtener($_GET['id'],$cnn),true);
                }elseif(isset($_GET['valor'])){//buscar
                    echo json_encode(Talla::buscar($_GET['valor'],$cnn),true);
                }else{//obtener todos
                    echo json_encode(Talla::obtenerTodos($cnn),true);
                }
            break; 
            case 'PUT'://modificar
                $_PUT = json_decode(file_get_contents("php://input"), TRUE);
                $talla = new Talla($_PUT['descripcion']);
                echo $talla->modificar($_PUT['id']);
            break;
            case 'DELETE'://eliminar
                echo Talla::eliminar($_GET['id'],$cnn);
            break;
        }
    }
    
?>