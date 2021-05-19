<?php
include_once('abstract-modelo.php');
class Material extends Modelo{
    public function __construct($descripcion)
    {
        parent::__construct($descripcion);
        $this->db = new Conexion();
        $this->cnn = $this->db->getConexion();
    }
    public function guardar(){
        try{
            $query = $this->cnn->prepare("CALL agregarMaterial(:descripcion)");
            $query->execute($this->obtenerDatos());
            return '{"mensaje":"registro agregado exitosamente","centinela":"true"}';
        }catch(Exception $e){
            return '{"mensaje":"'.$e.'", "centinela":"false"';
        }
    }
    static public function obtener($id,$cnn){
        try{
            $query = $cnn->prepare("CALL obtenerMaterial(:id)");
            $query->execute(array("id"=>$id));
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return '{"mensaje":"'.$e.'", "centinela":"false"';
        }
    }
    static public function obtenerTodos($cnn){
        try{
            $query = $cnn->prepare("CALL obtenerMaterials()");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return '{"mensaje":"'.$e.'", "centinela":"false"';
        }
    }
    public function modificar($id){
        try{
            $query = $this->cnn->prepare("CALL modificarMaterial(:descripcion,:id)");
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
            $query = $cnn->prepare("CALL eliminarMaterial(:id)");
            $query->execute(array("id"=>$id));
            return '{"mensaje":"registro eliminado exitosamente","centinela":"true"}';
        }catch(Exception $e){
            return '{"mensaje":"'.$e.'", "centinela":"false"';          
        }
    }
    static public function buscar($valor,$cnn){
        try {
            $query = $cnn->prepare("CALL buscarMaterial(:valor)");
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
}
?>