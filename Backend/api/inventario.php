<?php
header('Content-Type: application/json');
include_once('../class/class-inventarioPrima.php');
include_once('../class/class-inventarioPrima.php');
include_once('../class/class-inventarioMaterial.php');
include_once('../class/class-inventarioHerramienta.php');
include_once('../class/class-inventarioGeneral.php');
//crear conexion para metodos estaticos, ya que en estos nos se pueden instanciar clases
$db = new Conexion();$cnn = $db->getConexion();
$response;$inventario;
$_GET['clase'] = (isset($_GET['clase']) && $_GET['clase']!="undefined")?$_GET['clase']:0;
switch($_SERVER['REQUEST_METHOD']){
    case 'POST'://guardar
        //$_POST = json_decode(file_get_contents("php://input"), TRUE);
        if($_GET['clase']=="Prima" ){//Guardar Inventario Prima
            $inventario= new InventarioPrima($_POST['descripcion'],$_POST['estilo'],$_POST['proveedor'],
                                    $_POST['talla'],$_POST['color'],floatval($_POST['precio']),
                                    intval($_POST['stock']));
        
        }elseif($_GET['clase']=="Material"){
            $inventario= new InventarioMaterial($_POST['descripcion'],$_POST['marca'],$_POST['proveedor'],
                                    floatval($_POST['precio']),intval($_POST['stock']));
        }elseif($_GET['clase']=="Herramienta"){
            $inventario = new InventarioHerramienta($_POST['descripcion'],$_POST['marca'],$_POST['proveedor'],$_POST['stock']);
        }elseif($_GET['clase']=="General"){
            $inventario = new InventarioGeneral($_POST['descripcion'],$_POST['stock']);
        }
        if(is_object($inventario)){
            echo $inventario->guardar();
        }
    break;
    case 'GET'://visualizar
        if($_GET['clase']=="Prima" ){//Mostrar Inventario Prima
            if(isset($_GET['id']) && $_GET['id']!="undefined"){//obtener un registro
                $response =InventarioPrima::obtener($_GET['id'],$cnn);
            }elseif(isset($_GET['valor']) && $_GET['valor']!="undefined"){//buscar
                $response =InventarioPrima::buscar($_GET['valor'],$cnn);
            }else{//obtener todos
                $response =InventarioPrima::obtenerTodos($cnn);
            }
        }elseif($_GET['clase']=="Material"){//Mostrar Inventario Material
            if(isset($_GET['id']) && $_GET['id']!="undefined"){//obtener un registro
                $response =InventarioMaterial::obtener($_GET['id'],$cnn);
            }elseif(isset($_GET['valor']) && $_GET['valor']!="undefined"){//buscar
                $response =InventarioMaterial::buscar($_GET['valor'],$cnn);
            }else{//obtener todos
                $response =InventarioMaterial::obtenerTodos($cnn);
            }
        }elseif($_GET['clase']=="Herramienta"){//Mostrar Inventario Herramienta
            if(isset($_GET['id']) && $_GET['id']!="undefined"){//obtener un registro
                $response =InventarioHerramienta::obtener($_GET['id'],$cnn);
            }elseif(isset($_GET['valor']) && $_GET['valor']!="undefined"){//buscar
                $response =InventarioHerramienta::buscar($_GET['valor'],$cnn);
            }else{//obtener todos
                $response =InventarioHerramienta::obtenerTodos($cnn);
            }
        }elseif($_GET['clase']=="General"){//Mostrar Inventario General
            if(isset($_GET['id']) && $_GET['id']!="undefined"){//obtener un registro
                $response =InventarioGeneral::obtener($_GET['id'],$cnn);
            }elseif(isset($_GET['valor']) && $_GET['valor']!="undefined"){//buscar
                $response =InventarioGeneral::buscar($_GET['valor'],$cnn);
            }else{//obtener todos
                $response =InventarioGeneral::obtenerTodos($cnn);
            }
        }
        echo json_encode($response,true);
    break; 
    case 'PUT'://modificar
        $_PUT = json_decode(file_get_contents("php://input"), TRUE);
        if($_GET['clase']=="Prima"){//Guardar Inventario Prima
            $inventario= new InventarioPrima($_PUT['descripcion'],$_PUT['estilo'],$_PUT['proveedor'],
                                    $_PUT['talla'],$_PUT['color'],floatval($_PUT['precio']),
                                    intval($_PUT['stock']));
        
        }elseif($_GET['clase']=="Material"){
            $inventario= new InventarioMaterial($_PUT['descripcion'],$_PUT['marca'],$_PUT['proveedor'],
                                    floatval($_PUT['precio']),intval($_PUT['stock']));
        }elseif($_GET['clase']=="Herramienta"){
            $inventario = new InventarioHerramienta($_PUT['descripcion'],$_PUT['marca'],$_PUT['proveedor'],$_PUT['stock']);
        }elseif($_GET['clase']=="General"){
            $inventario = new InventarioGeneral($_PUT['descripcion'],$_PUT['stock']);
        }
        if(is_object($inventario)){
            echo $inventario->modificar($_PUT['id']);
        }
    break;
    case 'DELETE'://eliminar
        if($_GET['clase']=="Prima" ){//Guardar Inventario Prima
            $response = InventarioPrima::eliminar($_GET['id'],$cnn);
        }elseif($_GET['clase']=="Material"){
            $response = InventarioMaterial::eliminar($_GET['id'],$cnn);
        }elseif($_GET['clase']=="Herramienta"){
            $response = InventarioHerramienta::eliminar($_GET['id'],$cnn);
        }elseif($_GET['clase']=="General"){
            $response = InventarioGeneral::eliminar($_GET['id'],$cnn);
        }
        echo $response;
    break;
}
?>