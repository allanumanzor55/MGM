<?php
header('Content-Type: application/json');
include_once('../class/class-login.php');
//crear conexion para metodos estaticos, ya que en estos nos se pueden instanciar clases
include_once('../class/class-cliente.php');
$db = new Conexion();
$cnn = $db->getConexion();
if(Login::validarLogin($cnn)){
    $p = Login::obtenerPermiso($cnn,"clientes");
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST'://guardar
            if(Login::verf_perm("e",$p)||Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)){
                $cliente = new Cliente( $_FILES['foto'], intval($_POST['tipoCliente']),$_POST['dni'],$_POST['nombre'],$_POST['primerApellido'],
                                    $_POST['segundoApellido'],$_POST['direccion'],$_POST['correo'],$_POST['celular'],
                                    $_POST['telefono'],floatval($_POST['edad']),$_POST['nombreEmpresa'],$_POST['rtnEmpresa']);
                echo $cliente->guardar();
            }else{
                echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                Login::logout($cnn);
            }
        break;
        case 'GET'://visualizar
            if(Login::verf_perm("an",$p)){
                $response;
                if(isset($_GET['id']) && $_GET['id']!="undefined"){//obtener un registro
                    echo json_encode(Cliente::obtener($_GET['id'],$cnn),true);
                }elseif(isset($_GET['valor']) && $_GET['valor']!="undefined"){//buscar
                    echo json_encode(Cliente::buscar($_GET['valor'],$cnn),true);
                }elseif(isset($_GET['clase']) && $_GET['clase']!="undefined" && 
                        isset($_COOKIE['idUser']) && $_COOKIE['idUser']!="undefined"){
                    $idUs = $_COOKIE['idUser'];
                    $result = $cnn->query("SELECT id FROM vw_usuarios WHERE idUsuario=$idUs")->fetch(PDO::FETCH_ASSOC);
                    echo json_encode(Cliente::obtener($result['id'],$cnn),true);
                }else{//obtener todos
                    echo json_encode(Cliente::obtenerTodos($cnn),true);
                }
            }else{
                die();
            }
        break; 
        case 'PUT'://modificar
            if(Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)){
                $_PUT = json_decode(file_get_contents("php://input"), TRUE);
                $_PUT['foto']= isset($_PUT['foto'])?$_PUT['foto']:array("name"=>'',"size"=>'',"tmp_name"=>'',"type"=>'jpg');
                $cliente = new Cliente($_FILES['foto'], $_PUT['tipoCliente'],$_PUT['dni'],$_PUT['nombre'],$_PUT['primerApellido'],
                                        $_PUT['segundoApellido'],$_PUT['direccion'],$_PUT['correo'],$_PUT['celular'],
                                        $_PUT['telefono'],floatval($_PUT['edad']),$_PUT['nombreEmpresa'],$_PUT['rtnEmpresa']);
                echo $cliente->modificar($_PUT['id']);
            }else{
                echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                Login::logout($cnn);
            }
        break;
        case 'DELETE'://eliminar
            if(Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)){
                echo Cliente::eliminar($_GET['id'],$cnn);
            }else{
                echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                Login::logout($cnn);
            }
        break;
    }
}
?>