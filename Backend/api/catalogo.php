<?php
header('Content-Type: application/json');
include_once('../class/class-login.php');
include_once('../class/class-catalogo.php');
//crear conexion para metodos estaticos, ya que en estos nos se pueden instanciar clases
$db = new Conexion();
$cnn = $db->getConexion();
if(Login::validarLogin($cnn)){
    $p = Login::obtenerPermiso($cnn,"catalogo");
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST'://guardar
            if(Login::verf_perm("e",$p)||Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)){
                $_POST['exentoImpuesto'] = isset($_POST['exentoImpuesto'])?$_POST['exentoImpuesto']:0;
                $bodega = new Catalogo($_FILES['foto'],$_POST['nombreProducto'],$_POST['descripcionProducto'],$_POST['precio'],boolval($_POST['exentoImpuesto']));
                echo $bodega->guardar();
            }else{
                echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                Login::logout($cnn);
            }
        break;
        case 'GET'://visualizar
            $response;
            if(isset($_GET['id']) && $_GET['id']!="undefined"){//obtener un registro
                echo json_encode(Catalogo::obtener($_GET['id'],$cnn),true);
            }elseif(isset($_GET['valor']) && $_GET['valor']!="undefined"){//buscar
                echo json_encode(Catalogo::buscar($_GET['valor'],$cnn),true);
            }else{
                echo json_encode(Catalogo::obtenerTodos($cnn),true);
            }
        break; 
        case 'PUT'://modificar
            if(Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)){
                $_PUT = json_decode(file_get_contents("php://input"), TRUE);
                $_PUT['exentoImpuesto'] = isset($_PUT['exentoImpuesto'])?$_PUT['exentoImpuesto']:0;
                $_FILES['foto'] = isset($_FILES['foto'])?$_FILES['foto']:array();
                $bodega = new Catalogo($_FILES['foto'],$_PUT['nombreProducto'],$_PUT['descripcionProducto'],$_PUT['precio'],$_PUT['exentoImpuesto']);
                echo $bodega->modificar($_PUT['id']);
            }else{
                echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                Login::logout($cnn);
            }
        break;
        case 'DELETE'://eliminar
            if(Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)){
                echo Catalogo::eliminar($_GET['id'],$cnn);
            }else {
                echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                Login::logout($cnn);
            }
        break;
    }
}
?>