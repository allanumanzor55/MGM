<?php
include_once('abstract-inventario.php');
class InventarioMaterial extends Inventario{
    private $marca;
    private $proveedor;
    private $bodega;
    private $puntoReorden;
    public function __construct($descripcion,$marca,$proveedor,$precio,$stock,$puntoReorden,$bodega)
    {
        parent::__construct($descripcion,$precio,$stock);
        $this->setMarca($marca);
        $this->setProveedor($proveedor);
        $this->setBodega($bodega);
        $this->setPuntoReorden($puntoReorden);
        $this->db = new Conexion();
        $this->cnn = $this->db->getConexion();
    }
    
    public function guardar(){
        try{
            $query = $this->cnn->prepare("CALL agregarMaterial(:descripcion,:marca,:proveedor,:precio,:stock,:puntoReorden,:bodega);");
            $datos = $this->obtenerDatos();
            $datos['bodega'] =$this->getBodega();
            $query->execute($datos);
            return Acciones::error_message("agregado",true);
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    static public function obtener($id,$cnn){
        try{
            $query = $cnn->prepare("CALL obtenerMaterial(:id)");
            $query->execute(array("id"=>$id));
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    static public function obtenerTodos($cnn){
        try{
            $query = $cnn->prepare("CALL obtenerMateriales()");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }

    static public function obtenerPorBodega($cnn,$bodega){
        try{
            $query = $cnn->prepare("CALL obtenerInvMaterialesPorBodega(?)");
            $query->execute(array($bodega));
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }

    public function modificar($id){
        try{
            $query = $this->cnn->prepare("CALL modificarMaterial(:descripcion,:marca,:proveedor,:precio,:stock,:puntoReorden,:id);");
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
            $query = $cnn->prepare("CALL eliminarMaterial(:id)");
            $query->execute(array("id"=>$id));
            return Acciones::error_message("eliminado",true);
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    static public function buscar($valor,$cnn){
        try {
            $query = $cnn->prepare("CALL buscarMaterial(:valor)");
            $query->execute(array("valor"=>$valor));
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }

    static public function buscarPorBodega($valor,$bodega,$cnn){
        try {
            $query = $cnn->prepare("CALL buscarMaterialPorBodega(?,?)");
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
            "precio"=>$this->getPrecio(),
            "stock"=>$this->getStock(),
            "puntoReorden"=>$this->getPuntoReorden()
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

    public function getPuntoReorden()
    {
        return $this->puntoReorden;
    }

    /**
     * Set the value of puntoReorden
     *
     * @return  self
     */ 
    public function setPuntoReorden($puntoReorden)
    {
        $this->puntoReorden = $puntoReorden;

        return $this;
    }
}
?>