<?php
header('Content-Type: application/json');
include_once('../class/class-login.php');
include_once('../class/class-tipoCategoria.php');
include_once('../class/class-categoria.php');
include_once('../class/class-talla.php');
$db = new Conexion();
$cnn = $db->getConexion();
if(Login::validarLogin($cnn)){
    $p = Login::obtenerPermiso($cnn,"configuracion");
    if($_GET['clase']=="tipo"){
        switch($_SERVER['REQUEST_METHOD']){
            case 'POST'://guardar
                if(Login::verf_perm("e",$p)||Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)){
                    $tipo = new Tipo($_POST['descripcion'],$_POST['material']);
                    echo $tipo->guardar();
                }else{
                    echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                    Login::logout($cnn);
                }
            break;
            case 'GET'://visualizar
                if(Login::verf_perm("an",$p)){
                    if(isset($_GET['id']) && $_GET['id']!="undefined"){//obtener un registro
                        echo json_encode(Tipo::obtener($_GET['id'],$cnn),true);
                    }elseif(isset($_GET['valor']) && $_GET['valor']!="undefined"){//buscar
                        echo json_encode(Tipo::buscar($_GET['valor'],$cnn),true);
                    }else{//obtener todos
                        echo json_encode(Tipo::obtenerTodos($cnn),true);
                    }
                }
            break; 
            case 'PUT'://modificar
                if(Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)){
                    $_PUT = json_decode(file_get_contents("php://input"),true);
                    $tipo = new Tipo($_PUT['descripcion'],$_PUT['material']);
                    echo $tipo->modificar($_PUT['id']);
                }else{
                    echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                    Login::logout($cnn);
                }
            break;
            case 'DELETE'://eliminar
                if(Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)){
                    echo Tipo::eliminar($_GET['id'],$cnn);
                }else{
                    echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                    Login::logout($cnn);
                }
            break;
        }
    }elseif($_GET['clase']=="categoria"){
        switch($_SERVER['REQUEST_METHOD']){
            case 'POST'://guardar
                if(Login::verf_perm("e",$p)||Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)){
                    $categoria = new Categoria($_POST['tipo'],$_POST['estilo']);
                    echo $categoria->guardar();
                }else{
                    echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                    Login::logout($cnn);
                }
            break;
            case 'GET'://visualizar
                if(Login::verf_perm("an",$p)){
                    if(isset($_GET['id']) && $_GET['id']!="undefined"){//obtener un registro
                        echo json_encode(Categoria::obtener($_GET['id'],$cnn),true);
                    }elseif(isset($_GET['valor']) && $_GET['valor']!="undefined"){//buscar
                        echo json_encode(Categoria::buscar($_GET['valor'],$cnn),true);
                    }elseif(isset($_GET['tipo']) && $_GET['tipo']!="undefined"){//obtener registros por tipo
                        echo json_encode(Categoria::obtenerPorTipo(intval($_GET['tipo']),$cnn),true);
                    }else{//obtener todos
                        echo json_encode(Categoria::obtenerTodos($cnn),true);
                    }
                }else{
                    echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                    Login::logout($cnn);
                }
            break; 
            case 'PUT'://modificar
                if(Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)){
                    $_PUT = json_decode(file_get_contents("php://input"), TRUE);
                    $categoria = new Categoria($_PUT['tipo'],$_PUT['estilo']);
                    echo $categoria->modificar($_PUT['id']);
                }else{
                    echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                    Login::logout($cnn);
                }
            break;
            case 'DELETE'://eliminar
                if(Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)){
                    echo Categoria::eliminar($_GET['id'],$cnn);
                }else{
                    echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                    Login::logout($cnn);
                }
            break;
        }
    }elseif($_GET['clase']=="talla"){
        switch($_SERVER['REQUEST_METHOD']){
            case 'POST'://guardar
                if(Login::verf_perm("e",$p)||Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)){
                    $talla = new Talla($_POST['descripcion']);
                    echo $talla->guardar();
                }else{
                    echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                    Login::logout($cnn);
                }
            break;
            case 'GET'://visualizar
                if(Login::verf_perm("an",$p)){
                    if(isset($_GET['id']) && $_GET['id']!="undefined"){//obtener un registro
                        echo json_encode(Talla::obtener($_GET['id'],$cnn),true);
                    }elseif(isset($_GET['valor']) && $_GET['valor']!="undefined"){//buscar
                        echo json_encode(Talla::buscar($_GET['valor'],$cnn),true);
                    }else{//obtener todos
                        echo json_encode(Talla::obtenerTodos($cnn),true);
                    }
                }else{
                    echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                    Login::logout($cnn);
                }
            break; 
            case 'PUT'://modificar
                if(Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)){
                    $_PUT = json_decode(file_get_contents("php://input"), TRUE);
                    $talla = new Talla($_PUT['descripcion']);
                    echo $talla->modificar($_PUT['id']);
                }else{
                    echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                    Login::logout($cnn);
                }
            break;
            case 'DELETE'://eliminar
                if(Login::verf_perm("g",$p) || Login::verf_perm("adm",$p)){
                    echo Talla::eliminar($_GET['id'],$cnn);
                }else{
                    echo '{"mensaje":"Acceso Denegado","centinela":"false"}';
                    Login::logout($cnn);
                }
            break;
        }
    }
}
?>