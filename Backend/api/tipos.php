<?php
header('Content-Type: application/json');
include_once('../class/class-login.php');
include_once('../class/class-tipoCliente.php');
//crear conexion para metodos estaticos, ya que en estos nos se pueden instanciar clases
$db = new Conexion();$cnn = $db->getConexion();
if(Login::validarLogin($cnn)){
    $p = Login::obtenerPermiso($cnn,"configuracion");
    if($_GET['clase']=="cliente"){
        switch($_SERVER['REQUEST_METHOD']){
            case 'POST'://guardar
                if(Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)){
                    $tipoCliente = new TipoCliente($_POST['descripcion']);
                    echo $tipoCliente->guardar();
                }else{
                    echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                    Login::logout($cnn);
                }
            break;
            case 'GET'://visualizar
                if(Login::verf_perm("an",$p)){
                    if(isset($_GET['id']) && $_GET['id']!="undefined"){//obtener un registro
                        echo json_encode(TipoCliente::obtener($_GET['id'],$cnn),true);
                    }elseif(isset($_GET['valor'])){//buscar
                        echo json_encode(TipoCliente::buscar($_GET['valor'],$cnn),true);
                    }else{//obtener todos
                        echo json_encode(TipoCliente::obtenerTodos($cnn),true);
                    }
                }else{
                    echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                    Login::logout($cnn);
                }
                
            break; 
            case 'PUT'://modificar
                if(Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)){
                    $_PUT = json_decode(file_get_contents("php://input"), TRUE);
                    $tipoCliente = new TipoCliente($_PUT['descripcion']);
                    echo $tipoCliente->modificar($_PUT['id']);
                }else{
                    echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                    Login::logout($cnn);
                }
            break;
            case 'DELETE'://eliminar
                if(Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)){
                    echo TipoCliente::eliminar($_GET['id'],$cnn);
                }else{
                    echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                    Login::logout($cnn);
                }
            break;
        }
    }elseif($_GET['clase']=="empleado"){
        include_once('../class/class-tipoEmpleado.php');
        switch($_SERVER['REQUEST_METHOD']){
            case 'POST'://guardar
                if(Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)){
                    $tipoEmpleado = new TipoEmpleado($_POST['descripcion'],$_POST['rol']);
                    echo $tipoEmpleado->guardar();
                }else{
                    echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                    Login::logout($cnn);
                }
                
            break;
            case 'GET'://visualizar
                if(Login::verf_perm("an",$p)){
                    if(isset($_GET['id']) && $_GET['id']!="undefined"){//obtener un registro
                        echo json_encode(TipoEmpleado::obtener($_GET['id'],$cnn),true);
                    }elseif(isset($_GET['valor']) && $_GET['valor']!="undefined"){//buscar
                        echo json_encode(TipoEmpleado::buscar($_GET['valor'],$cnn),true);
                    }else{//obtener todos
                        echo json_encode(TipoEmpleado::obtenerTodos($cnn),true);
                    }
                }else{
                    echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                    Login::logout($cnn);
                }
            break; 
            case 'PUT'://modificar
                if(Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)){
                    $_PUT = json_decode(file_get_contents("php://input"), TRUE);
                    $tipoEmpleado = new TipoEmpleado($_PUT['descripcion'],$_PUT['rol']);
                    echo $tipoEmpleado->modificar($_PUT['id']);
                }else{
                    echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                    Login::logout($cnn);
                }
                
            break;
            case 'DELETE'://eliminar
                if(Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)){
                    echo TipoEmpleado::eliminar($_GET['id'],$cnn);
                }else{
                    echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                    Login::logout($cnn);
                }
            break;
        }
    }
}
?>