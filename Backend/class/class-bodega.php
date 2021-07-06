<?php
include_once('class-conexion.php');
include_once('interface-crud.php');
include_once('trait-acciones.php');
class Bodega extends Conexion implements CRUD{
    use Acciones;
    private $descripcion;
    private $ubicacion;
    private $db;
    private $cnn;

    function __construct($descripcion,$ubicacion)
    {
        $this->descripcion = $descripcion;
        $this->ubicacion = $ubicacion;
        $this->db = new Conexion();
        $this->cnn = $this->db->getConexion();
    }

    public function guardar(){
        try{
            $query = $this->cnn->prepare("CALL agregarBodega(:descripcion,:ubicacion);");
            $query->execute($this->obtenerDatos());
            return Acciones::error_message("agregado",true);
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }

    static public function obtener($id,$cnn){
        try{
            $query = $cnn->prepare("CALL obtenerBodega(:id)");
            $query->execute(array("id"=>$id));
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    static public function obtenerTodos($cnn){
        try{
            $query = $cnn->prepare("CALL obtenerBodegas()");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }

    public function modificar($id){
        try{
            $query = $this->cnn->prepare("CALL modificarBodega(:descripcion,:ubicacion,:id)");
            $datos = $this->obtenerDatos();
            unset($datos['tipoBodega']);
            $datos["id"]=$id;
            $query->execute($datos);
            return Acciones::error_message("modificado",true);
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    static public function eliminar($id,$cnn){
        try{
            $query = $cnn->prepare("CALL eliminarBodega(:id)");
            $query->execute(array("id"=>$id));
            return Acciones::error_message("eliminado",true);
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }

    static public function buscar($valor,$cnn){
        try {
            $query = $cnn->prepare("CALL buscarBodega(:valor,:tipo)");
            $query->execute(array("valor"=>$valor,"tipo"=>$_GET['tipo']));
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }

    public function obtenerDatos()
    {
        return array(
            "descripcion"=>$this->descripcion,
            "ubicacion"=>$this->ubicacion
        );
    }
}

?>
