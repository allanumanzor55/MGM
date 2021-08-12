<?php
header('Content-Type: application/json');
include_once('../class/class-login.php');
include_once('../class/class-inventarioPrima.php');
include_once('../class/class-inventarioMaterial.php');
include_once('../class/class-inventarioHerramienta.php');
include_once('../class/class-inventarioGeneral.php');
//crear conexion para metodos estaticos, ya que en estos nos se pueden instanciar clases
$db = new Conexion();$cnn = $db->getConexion();
if(Login::validarLogin($cnn)){
    $p = Login::obtenerPermiso($cnn,"inventario");
    $response;
    $_GET['clase'] = 
    (isset($_GET['clase']) && $_GET['clase']!="undefined")?$_GET['clase']:0;
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST'://guardar
            //$_POST = json_decode(file_get_contents("php://input"), TRUE);
            $nInventario = null;
            if(Login::verf_perm("e",$p)||Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)){
                if($_GET['clase']=="Prima" ){//Guardar Inventario Prima
                    $nInventario= new InventarioPrima($_POST['descripcion'],$_POST['estilo'],$_POST['proveedor'],
                                            $_POST['talla'],$_POST['color'],floatval($_POST['precio']),
                                            intval($_POST['stock']),$_POST['puntoReorden'],$_POST['bodega']);
                
                }elseif($_GET['clase']=="Material"){
                    $nInventario= new InventarioMaterial($_POST['descripcion'],$_POST['marca'],$_POST['proveedor'],
                                            floatval($_POST['precio']),intval($_POST['stock']),$_POST['puntoReorden'],$_POST['bodega']);
                }elseif($_GET['clase']=="Herramienta"){
                    $nInventario = new InventarioHerramienta($_POST['descripcion'],$_POST['marca'],$_POST['proveedor'],$_POST['stock'],$_POST['bodega']);
                }elseif($_GET['clase']=="General"){
                    $nInventario = new InventarioGeneral($_POST['descripcion'],$_POST['stock'],$_POST['bodega']);
                }
                if(is_object($nInventario)){
                    echo $nInventario->guardar();
                }
            }else{
                echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                Login::logout($cnn);
            }
            
        break;
        case 'GET'://visualizar
            if(Login::verf_perm("an",$p)){
                if($_GET['clase']=="Prima" ){//Mostrar Inventario Prima
                    if(isset($_GET['id']) && $_GET['id']!="undefined"){//obtener un registro
                        $response =InventarioPrima::obtener($_GET['id'],$cnn);
                    }elseif(isset($_GET['valor']) && $_GET['valor']!="undefined"){//buscar
                        if(isset($_GET['tipo']) && $_GET['tipo']!="undefined"){
                            $response =InventarioPrima::buscarPorBodega($_GET['valor'],$_GET['tipo'],$cnn);
                        }else{
                            $response =InventarioPrima::buscar($_GET['valor'],$cnn);
                        }
                    }elseif(isset($_GET['tipo']) && $_GET['tipo']!="undefined"){//obtener un registro por tipo
                        $response = InventarioPrima::obtenerPorBodega($cnn,$_GET['tipo']);
                    }else{//obtener todos
                        $response =InventarioPrima::obtenerTodos($cnn);
                    }
                }elseif($_GET['clase']=="Material"){//Mostrar Inventario Material
                    if(isset($_GET['id']) && $_GET['id']!="undefined"){//obtener un registro
                        $response =InventarioMaterial::obtener($_GET['id'],$cnn);
                    }elseif(isset($_GET['valor']) && $_GET['valor']!="undefined"){//buscar
                        if(isset($_GET['tipo']) && $_GET['tipo']!="undefined"){
                            $response =InventarioMaterial::buscarPorBodega($_GET['valor'],$_GET['tipo'],$cnn);
                        }else{
                            $response =InventarioMaterial::buscar($_GET['valor'],$cnn);
                        }
                    }elseif(isset($_GET['tipo']) && $_GET['tipo']!="undefined"){//obtener un registro por tipo
                        $response = InventarioMaterial::obtenerPorBodega($cnn,$_GET['tipo']);
                    }else{//obtener todos
                        $response =InventarioMaterial::obtenerTodos($cnn);
                    }
                }elseif($_GET['clase']=="Herramienta"){//Mostrar Inventario Herramienta
                    if(isset($_GET['id']) && $_GET['id']!="undefined"){//obtener un registro
                        $response =InventarioHerramienta::obtener($_GET['id'],$cnn);
                    }elseif(isset($_GET['valor']) && $_GET['valor']!="undefined"){//buscar
                        if(isset($_GET['tipo']) && $_GET['tipo']!="undefined"){
                            $response =InventarioHerramienta::buscarPorBodega($_GET['valor'],$_GET['tipo'],$cnn);
                        }else{
                            $response =InventarioHerramienta::buscar($_GET['valor'],$cnn);
                        }
                    }elseif(isset($_GET['tipo']) && $_GET['tipo']!="undefined"){//obtener un registro por tipo
                        $response = InventarioHerramienta::obtenerPorBodega($cnn,$_GET['tipo']);
                    }else{//obtener todos
                        $response =InventarioHerramienta::obtenerTodos($cnn);
                    }
                }elseif($_GET['clase']=="General"){//Mostrar Inventario General
                    if(isset($_GET['id']) && $_GET['id']!="undefined"){//obtener un registro
                        $response =InventarioGeneral::obtener($_GET['id'],$cnn);
                    }elseif(isset($_GET['valor']) && $_GET['valor']!="undefined"){//buscar
                        if(isset($_GET['tipo']) && $_GET['tipo']!="undefined"){
                            $response =InventarioGeneral::buscarPorBodega($_GET['valor'],$_GET['tipo'],$cnn);
                        }else{
                            $response =InventarioGeneral::buscar($_GET['valor'],$cnn);
                        }
                    }elseif(isset($_GET['tipo']) && $_GET['tipo']!="undefined"){//obtener un registro por tipo
                        $response = InventarioGeneral::obtenerPorBodega($cnn,$_GET['tipo']);
                    }else{//obtener todos
                        $response =InventarioGeneral::obtenerTodos($cnn);
                    }
                }
                echo json_encode($response,true);
            }else{
                echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                Login::logout($cnn);
            }
        break; 
        case 'PUT'://modificar
            if(Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)){
                $nInventario = null;
                $_PUT = json_decode(file_get_contents("php://input"), TRUE);
                if(isset($_GET['clase']) and $_GET['clase']=="Prima"){//Guardar Inventario Prima
                    $nInventario= new InventarioPrima($_PUT['descripcion'],$_PUT['estilo'],$_PUT['proveedor'],
                                            $_PUT['talla'],$_PUT['color'],floatval($_PUT['precio']),
                                            intval($_PUT['stock']),$_PUT['puntoReorden'],"");
                }elseif(isset($_GET['clase']) and $_GET['clase']=="Material"){
                    $nInventario= new InventarioMaterial($_PUT['descripcion'],$_PUT['marca'],$_PUT['proveedor'],
                                            floatval($_PUT['precio']),intval($_PUT['stock']),$_PUT['puntoReorden'],"");
                }elseif(isset($_GET['clase']) and $_GET['clase']=="Herramienta"){
                    $nInventario = new InventarioHerramienta($_PUT['descripcion'],$_PUT['marca'],$_PUT['proveedor'],$_PUT['stock'],"");
                }elseif(isset($_GET['clase']) and $_GET['clase']=="General"){
                    $nInventario = new InventarioGeneral($_PUT['descripcion'],$_PUT['stock'],"");
                }elseif(isset($_PUT['campoModificado'])){//modificacion por campos
                    if($_PUT['campoModificado']=="stock"){
                        echo Inventario::modificarStock($_PUT['id'],$_PUT['stock'],$_PUT['tipoInventario']);
                    }
                }
                if(isset($_GET['clase'])){
                    if(is_object($nInventario)){
                        echo $nInventario->modificar($_PUT['id']);
                    }
                }
            }else{
                echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                Login::logout($cnn);
            }
        break;
        case 'DELETE'://eliminar
            if(Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)){
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
            }else{
                echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                Login::logout($cnn);
            }
        break;
    }
}
?>