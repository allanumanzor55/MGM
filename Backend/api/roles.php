<?php
header('Content-Type: application/json');
//crear conexion para metodos estaticos, ya que en estos nos se pueden instanciar clases
include_once('../class/class-login.php');
include_once('../class/class-roles.php');
$db = new Conexion();
$cnn = $db->getConexion();
if(Login::validarLogin($cnn)){
    $p = Login::obtenerPermiso($cnn,"configuracion");
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST'://guardar
            if(Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)){
                $rol = new Roles($_POST['rol'],$_POST['descripcion'],intval($_POST['empleado']),intval($_POST['cliente']),intval($_POST['inventario']),
                intval($_POST['guiaRemision']),intval($_POST['bodega']),intval($_POST['catalogo']),intval($_POST['cotizacion']),intval($_POST['pedido']),
                intval($_POST['configuracion']));
                echo $rol->guardar();
            }else{
                echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                Login::logout($cnn);
            }
        break;
        case 'GET'://visualizar
            if(Login::verf_perm("an",$p)){
                if(isset($_GET['id']) && $_GET['id']!="undefined"){//obtener un registro
                    echo json_encode(Roles::obtener($_GET['id'],$cnn),true);
                }elseif(isset($_GET['valor']) && $_GET['valor']!="undefined"){//buscar
                    echo json_encode(Roles::buscar($_GET['valor'],$cnn),true);
                }else{//obtener todos
                    echo json_encode(Roles::obtenerTodos($cnn),true);
                }
            }else{
                echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                Login::logout($cnn);
            }
        break; 
        case 'PUT'://modificar
            if(Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)){
                $_PUT = json_decode(file_get_contents("php://input"),true);
                if(isset($_PUT)){
                    $rol = new Roles($_PUT['rol'],$_PUT['descripcion'],intval($_PUT['empleado']),intval($_PUT['cliente']),intval($_PUT['inventario']),
                    intval($_PUT['guiaRemision']),intval($_PUT['bodega']),intval($_PUT['catalogo']),intval($_PUT['cotizacion']),intval($_PUT['pedido']),
                    intval($_PUT['configuracion']));
                    echo $rol->modificar($_PUT['id']);
                }else{
                    echo file_get_contents("php://input");
                }
            }else{
                echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                Login::logout($cnn);
            }
        break;
        case 'DELETE'://eliminar
            if(Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)){
                echo Roles::eliminar($_GET['id'],$cnn);
            }else{
                echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                Login::logout($cnn);
            }
        break;
    }
}
?>