<?php
header('Content-Type: application/json');
include_once('../class/class-login.php');
include_once('../class/class-ordenes.php');
//crear conexion para metodos estaticos, ya que en estos nos se pueden instanciar clases
$db = new Conexion();
$cnn = $db->getConexion();
if(Login::validarLogin($cnn)){
    $p = Login::obtenerPermiso($cnn,"pedido");
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST'://guardar
            if(Login::verf_perm("e",$p)||Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)){
                $bodega = new Ordenes($_POST['idCotizacion']);
                echo $bodega->guardar();
            }else{
                echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                Login::logout($cnn);
            }
        break;
        case 'GET'://visualizar
            if(Login::verf_perm("an",$p)){
                $response;
                if(isset($_GET['id']) && $_GET['id']!="undefined"){//obtener un registro
                    echo json_encode(Ordenes::obtener($_GET['id'],$cnn),true);
                }elseif(isset($_GET['valor']) && $_GET['valor']!="undefined"){//buscar
                    echo json_encode(Ordenes::buscar($_GET['valor'],$cnn),true);
                }else{
                    echo json_encode(Ordenes::obtenerTodos($cnn),true);
                }
            }else{
                Login::logout($cnn);
            }
        break; 
        case 'PUT'://modificar
            if(Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)){
                $_PUT = json_decode(file_get_contents("php://input"), TRUE);
                $bodega = new Ordenes($_PUT['idCotizacion']);
                echo $bodega->modificar($_PUT['id']);
            }else{
                echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                Login::logout($cnn);
            }
        break;
        case 'DELETE'://eliminar
            if(Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)){
                echo Ordenes::eliminar($_GET['id'],$cnn);
            }else{
                echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                Login::logout($cnn);
            }
        break;
    }
}

?>