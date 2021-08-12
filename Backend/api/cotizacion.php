<?php
header('Content-Type: application/json');
include_once('../class/class-login.php');
include_once('../class/class-cotizacion.php');
//crear conexion para metodos estaticos, ya que en estos nos se pueden instanciar clases
$db = new Conexion();
$cnn = $db->getConexion();
if(Login::validarLogin($cnn) || !Login::validarLogin($cnn)){
    $p = Login::obtenerPermiso($cnn,"cotizacion");
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST'://guardar
            $idUs = $_COOKIE['idUser'];
            $result = $cnn->query("SELECT id FROM vw_usuarios WHERE idUsuario=$idUs")->fetch(PDO::FETCH_ASSOC);
            $bodega = new Cotizacion($_POST['descripcionCotizacion'],
            $result['id'],$_POST['cliente'],json_decode($_POST['productos'],true));
            echo $bodega->guardar();
        break;
        case 'GET'://visualizar
            $response;
            if(isset($_GET['id']) && $_GET['id']!="undefined"){//obtener un registro
                if(isset($_GET['tipo']) && $_GET['tipo']!="undefined"){//obtener un registro
                    echo json_encode(Cotizacion::obtenerProductosCotizados($cnn,$_GET['id']));
                }else{
                    echo json_encode(Cotizacion::obtener($_GET['id'],$cnn),true);
                }
            }elseif(isset($_GET['valor']) && $_GET['valor']!="undefined"){//buscar
                echo json_encode(Cotizacion::buscar($_GET['valor'],$cnn),true);
            }else{
                if(isset($_GET['tipo']) && $_GET['tipo']!="undefined"){
                    echo json_encode(Cotizacion::obtenerPorEstado($cnn,$_GET['tipo']));
                }else{
                    echo json_encode(Cotizacion::obtenerTodos($cnn),true);
                }
            }
        break; 
        case 'PUT'://modificar
            if(Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)){
                $_PUT = json_decode(file_get_contents("php://input"), TRUE);
                if(isset($_PUT['campoModificado']) && $_PUT['campoModificado']!="undefined"){
                    if($_PUT['campoModificado']=="estado"){
                        echo Cotizacion::modificarEstado($cnn,intval($_PUT['id']),$_PUT['estado']);
                    }
                }else{

                }
            }else{
                echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                Login::logout($cnn);
            }
        break;
        case 'DELETE'://eliminar
            if(Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)){
                echo Cotizacion::eliminar($_GET['id'],$cnn);
            }else{
                echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                Login::logout($cnn);
            }
        break;
    }
}
?>