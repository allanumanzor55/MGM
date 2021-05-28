<?php
include_once('abstract-inventario.php');
class InventarioGeneral extends Inventario{
    public function __construct($descripcion,$stock)
    {
        parent::__construct($descripcion,0,$stock);
        $this->db = new Conexion();
        $this->cnn = $this->db->getConexion();
    }
    
    public function guardar(){
        try{
            $query = $this->cnn->prepare("CALL agregarInvGeneral(:descripcion,:stock);");
            $query->execute($this->obtenerDatos());
            return Acciones::error_message("agregado",true);
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    static public function obtener($id,$cnn){
        try{
            $query = $cnn->prepare("CALL obtenerInvGeneral(:id)");
            $query->execute(array("id"=>$id));
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    static public function obtenerTodos($cnn){
        try{
            $query = $cnn->prepare("CALL obtenerInvGenerales()");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }

    public function modificar($id){
        try{
            $query = $this->cnn->prepare("CALL modificarInvGeneral(:descripcion,:stock,:id);");
            $datos = $this->obtenerDatos();
            $datos["id"]=$id;
            $query->execute($datos);
            return Acciones::error_message("modificado",true);
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    static public function eliminar($id,$cnn){
        try{
            $query = $cnn->prepare("CALL eliminarInvGeneral(:id)");
            $query->execute(array("id"=>$id));
            return Acciones::error_message("eliminado",true);
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    static public function buscar($valor,$cnn){
        try {
            $query = $cnn->prepare("CALL buscarInvGeneral(:valor)");
            $query->execute(array("valor"=>$valor));
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }

    public function obtenerDatos()
    {
        return array(
            "descripcion"=>$this->getDescripcion(),
            "stock"=>$this->getStock()
        );
    }
}
?>