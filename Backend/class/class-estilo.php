<?php
include_once('interface-crud.php');
include_once('class-conexion.php');
class Estilo extends Conexion implements CRUD{
    private $descripcion;
    private $db;
    private $cnn;
    public function __construct($descripcion)
    {
        $this->setDescripcion($descripcion);
        $this->db = new Conexion();
        $this->cnn = $this->db->getConexion();
    }
    public function guardar(){
        try{
            $query = $this->cnn->prepare("CALL agregarEstilo(:descripcion)");
            $query->execute($this->obtenerDatos());
            return '{"mensaje":"registro agregado exitosamente","centinela":"true"}';
        }catch(Exception $e){
            return '{"mensaje":"'.$e.'", "centinela":"false"';
        }
    }
    static public function obtener($id,$cnn){
        try{
            $query = $cnn->prepare("CALL obtenerEstilo(:id)");
            $query->execute(array("id"=>$id));
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return '{"mensaje":"'.$e.'", "centinela":"false"';
        }
    }
    static public function obtenerTodos($cnn){
        try{
            $query = $cnn->prepare("CALL obtenerEstilos()");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return '{"mensaje":"'.$e.'", "centinela":"false"';
        }
    }
    public function modificar($id){
        try{
            $query = $this->cnn->prepare("CALL modificarEstilo(:descripcion,:id)");
            $datos = $this->obtenerDatos();
            $datos["id"]=$id;
            $query->execute($datos);
            return '{"mensaje":"registro modificado exitosamente","centinela":"true"}';
        }catch(Exception $e){
            return '{"mensaje":"'.$e.'", "centinela":"false"';
        }
    }
    static public function eliminar($id,$cnn){
        try{
            $query = $cnn->prepare("CALL eliminarEstilo(:id)");
            $query->execute(array("id"=>$id));
            return '{"mensaje":"registro eliminado exitosamente","centinela":"true"}';
        }catch(Exception $e){
            return '{"mensaje":"'.$e.'", "centinela":"false"';          
        }
    }
    static public function buscar($valor,$cnn){
        try {
            $query = $cnn->prepare("CALL buscarEstilo(:valor)");
            $query->execute(array("valor"=>$valor));
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return '{"mensaje":"'.$e.'", "centinela":"false"';
        }
    }
    public function obtenerDatos()
    {
        return array(
            "descripcion"=>$this->getDescripcion()
        );
    }

    /**
     *  Get the value of descripcion
     */ 
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     *  Set the value of descripcion
     *
     * @return  self
     */ 
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }
}
?>