<?php
include_once('abstract-inventario.php');
class InventarioHerramienta extends Inventario{
    private $marca;
    private $proveedor;
    private $bodega;
    public function __construct($descripcion,$marca,$proveedor,$stock,$bodega)
    {
        parent::__construct($descripcion,0,$stock);
        $this->setMarca($marca);
        $this->setProveedor($proveedor);
        $this->setBodega($bodega);
        $this->db = new Conexion();
        $this->cnn = $this->db->getConexion();
    }
    
    public function guardar(){
        try{
            $query = $this->cnn->prepare("CALL agregarHerramienta(:descripcion,:marca,:proveedor,:stock,:bodega);");
            $datos = $this->obtenerDatos();
            $datos['bodega'] = $this->getBodega();
            $query->execute($datos);
            return Acciones::error_message("agregado",true);
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    static public function obtener($id,$cnn){
        try{
            $query = $cnn->prepare("CALL obtenerHerramienta(:id)");
            $query->execute(array("id"=>$id));
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    static public function obtenerTodos($cnn){
        try{
            $query = $cnn->prepare("CALL obtenerHerramientas()");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }

    static public function obtenerPorBodega($cnn,$bodega){
        try{
            $query = $cnn->prepare("CALL obtenerInvHerramientasPorBodega(?)");
            $query->execute(array($bodega));
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }

    public function modificar($id){
        try{
            $query = $this->cnn->prepare("CALL modificarHerramienta(:descripcion,:marca,:proveedor,:stock,:id);");
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
            $query = $cnn->prepare("CALL eliminarHerramienta(:id)");
            $query->execute(array("id"=>$id));
            return Acciones::error_message("eliminado",true);
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    static public function buscar($valor,$cnn){
        try {
            $query = $cnn->prepare("CALL buscarHerramienta(:valor)");
            $query->execute(array("valor"=>$valor));
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }

    static public function buscarPorBodega($valor,$bodega,$cnn){
        try {
            $query = $cnn->prepare("CALL buscarHerramientaPorBodega(?,?)");
            $query->execute(array($valor,$bodega));
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
            "marca"=>$this->getMarca(),
            "proveedor"=>$this->getProveedor(),
            "stock"=>$this->getStock()
        );
    }

    
    /**
     * Get the value of marca
     */ 
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * Set the value of marca
     *
     * @return  self
     */ 
    public function setMarca($marca)
    {
        $this->marca = $marca;

        return $this;
    }

    /**
     * Get the value of proveedor
     */ 
    public function getProveedor()
    {
        return $this->proveedor;
    }

    /**
     * Set the value of proveedor
     *
     * @return  self
     */ 
    public function setProveedor($proveedor)
    {
        $this->proveedor = $proveedor;

        return $this;
    }
    
    public function getBodega()
    {
        return $this->bodega;
    }

    /**
     * Set the value of bodega
     *
     * @return  self
     */ 
    public function setBodega($bodega)
    {
        $this->bodega = $bodega;

        return $this;
    }
}
?>