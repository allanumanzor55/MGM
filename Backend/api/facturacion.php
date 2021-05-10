<?php
header('Content-Type: application/json');
include_once('../class/class-facturacion.php');
//crear conexion para metodos estaticos, ya que en estos nos se pueden instanciar clases
$db = new Conexion();
$cnn = $db->getConexion();
switch($_SERVER['REQUEST_METHOD']){
    case 'POST'://guardar
        
    break;
    case 'GET'://visualizar
        $response;
        if(isset($_GET['id'])){//obtener un registro
            //$response = 
        }elseif(isset($_GET['valor'])){//buscar
            //$response = 
        }else{//obtener todos
            //$response = 
        }
        echo ($response==false)?'{"mensaje":"no existe registro}':json_encode($response);//imprimimos en pantalla el resultado y lo convertimos a json
    break; 
    case 'PUT'://modificar
        $_PUT = json_decode(file_get_contents("php://input"), TRUE);
        //echo //imprimimos el resultado en pantalla 
    break;
    case 'DELETE'://eliminar
        //echo //imprimimos en pantalla la respuesta
    break;
}
?>