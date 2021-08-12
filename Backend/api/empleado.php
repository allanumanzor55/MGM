<?php
header('Content-Type: application/json');
include_once('../class/class-login.php');
include_once('../class/class-empleado.php');
//crear conexion para metodos estaticos, ya que en estos nos se pueden instanciar clases
$db = new Conexion();
$cnn = $db->getConexion();
if(Login::validarLogin($cnn)){
    $p = Login::obtenerPermiso($cnn,"empleados");
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST'://guardar
            if(Login::verf_perm("e",$p)||Login::verf_perm("g",$p)||Login::verf_perm("adm",$p)){
                $empleado = new Empleado($_FILES['foto'],intval($_POST['tipoEmpleado']),$_POST['dni'],$_POST['nombre'],$_POST['primerApellido'],
                                    $_POST['segundoApellido'],$_POST['direccion'],$_POST['correo'],$_POST['celular'],
                                    $_POST['telefono'],floatval($_POST['sueldo']));
                echo $empleado->guardar();
            }else{
                echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                Login::logout($cnn);
            }
        break;
        case 'GET'://visualizar
            $response;
            if(Login::verf_perm("an",$p)){
                if(isset($_GET['id']) && $_GET['id']!="undefined"){//obtener un registro
                    echo json_encode(Empleado::obtener($_GET['id'],$cnn),true);
                }elseif(isset($_GET['valor']) && $_GET['valor']!="undefined"){//buscar
                    echo json_encode(Empleado::buscar($_GET['valor'],$cnn),true);
                }elseif(isset($_GET['tipo']) && $_GET['tipo']!="undefined"){//obtener un registro por tipo
                    echo json_encode(Empleado::obtenerPorTipo($cnn,$_GET['tipo']));
                }elseif(isset($_GET['clase']) && isset($_COOKIE['idUser']) && $_COOKIE['idUser']!="undefined"){
                    $idUs = $_COOKIE['idUser'];
                    $result = $cnn->query("SELECT id FROM vw_usuarios WHERE idUsuario=$idUs")->fetch(PDO::FETCH_ASSOC);
                    echo json_encode(Empleado::obtener($result['id'],$cnn),true);
                }else{
                    echo json_encode(Empleado::obtenerTodos($cnn),true);
                }
            }else{
                echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                Login::logout($cnn);
            }
        break; 
        case 'PUT'://modificar
            if(Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)){
                $_PUT = json_decode(file_get_contents("php://input"), TRUE);
                $_PUT['foto']= isset($_PUT['foto'])?$_PUT['foto']:array("name"=>'',"size"=>'',"tmp_name"=>'',"type"=>'jpg');
                $empleado = new Empleado($_PUT['foto'],$_PUT['tipoEmpleado'],$_PUT['dni'],$_PUT['nombre'],$_PUT['primerApellido'],
                                        $_PUT['segundoApellido'],$_PUT['direccion'],$_PUT['correo'],$_PUT['celular'],
                                        $_PUT['telefono'],floatval($_PUT['sueldo']));
                echo $empleado->modificar($_PUT['id']);
            }else{
                echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                Login::logout($cnn);
            }
            
        break;
        case 'DELETE'://eliminar
            if(Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)){
                echo Empleado::eliminar($_GET['id'],$cnn);
            }else{
                echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                Login::logout($cnn);
            }
        break;
    }
}

?>