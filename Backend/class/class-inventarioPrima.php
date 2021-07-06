<?php
include_once('abstract-inventario.php');
class InventarioPrima extends Inventario{
    private $categoria;
    private $talla;
    private $proveedor;
    private $color; 
    private $bodega;
    private $puntoReorden;
    public function __construct($descripcion,$categoria,$proveedor,$talla,$color,$precio,$stock,$puntoReorden,$bodega)
    {
        parent::__construct($descripcion,$precio,$stock);
        $this->setCategoria($categoria);
        $this->setTalla($talla);
        $this->setProveedor($proveedor);
        $this->setColor($color);
        $this->setBodega($bodega);
        $this->setPuntoReorden($puntoReorden);
        $this->db = new Conexion();
        $this->cnn = $this->db->getConexion();
    }
    
    public function guardar(){
        try{
            $query = $this->cnn->prepare("CALL agregarProducto(:descripcion,:categoria,:proveedor,:talla,:color,:stock,:precio,:puntoReorden,:bodega);");
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
            $query = $cnn->prepare("CALL obtenerProducto(:id)");
            $query->execute(array("id"=>$id));
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    static public function obtenerTodos($cnn){
        try{
            $query = $cnn->prepare("CALL obtenerProductos()");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }

    static public function obtenerPorBodega($cnn,$bodega){
        try{
            $query = $cnn->prepare("CALL obtenerInvPrimasPorBodega(?)");
            $query->execute(array($bodega));
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }

    public function modificar($id){
        try{
            $query = $this->cnn->prepare("CALL modificarProducto(:descripcion,:categoria,:proveedor,:talla,:color,:stock,:precio,:puntoReorden,:id);");
            $datos = $this->obtenerDatos();
            unset($datos['tipoProducto']);
            $datos["id"]=$id;
            $query->execute($datos);
            return Acciones::error_message("modificado",true);
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    static public function eliminar($id,$cnn){
        try{
            $query = $cnn->prepare("CALL eliminarProducto(:id)");
            $query->execute(array("id"=>$id));
            return Acciones::error_message("eliminado",true);
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    static public function buscar($valor,$cnn){
        try {
            $query = $cnn->prepare("CALL buscarProducto(:valor)");
            $query->execute(array("valor"=>$valor));
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }

    static public function buscarPorBodega($valor,$bodega,$cnn){
        try {
            $query = $cnn->prepare("CALL buscarInvPrimaPorBodega(?,?)");
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
            "categoria"=>$this->getCategoria(),
            "proveedor"=>$this->getProveedor(),
            "talla"=>$this->getTalla(),
            "color"=>$this->getColor(),
            "stock"=>$this->getStock(),
            "precio"=>$this->getPrecio(),
            "puntoReorden"=>$this->getPuntoReorden()
        );
    }

    
    /**
     * Get the value of categoria
     */ 
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set the value of categoria
     *
     * @return  self
     */ 
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get the value of estilo
     */ 
    public function getEstilo()
    {
        return $this->estilo;
    }

    /**
     * Set the value of estilo
     *
     * @return  self
     */ 
    public function setEstilo($estilo)
    {
        $this->estilo = $estilo;

        return $this;
    }

    /**
     * Get the value of talla
     */ 
    public function getTalla()
    {
        return $this->talla;
    }

    /**
     * Set the value of talla
     *
     * @return  self
     */ 
    public function setTalla($talla)
    {
        $this->talla = $talla;

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

    /**
     * Get the value of color
     */ 
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set the value of color
     *
     * @return  self
     */ 
    public function setColor($color)
    {
        $this->color = $color;

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