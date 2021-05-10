<?php
include_once('class-conexion.php');
include_once('interface-crud.php');
class Inventario extends Conexion implements CRUD{
    private $descripcion;
    private $categoria;
    private $estilo;
    private $talla;
    private $proveedor;
    private $color;
    private $precio;
    private $stock;
    
    public function __construct($descripcion,$categoria,$estilo,$talla,$proveedor,$color,$precio,$stock)
    {
        $this->setDescripcion($descripcion);
        $this->setCategoria($categoria);
        $this->setEstilo($estilo);
        $this->setProveedor($proveedor);
        $this->setColor($color);
        $this->setPrecio($precio);
        $this->setStock($stock);
    }
    public function FunctionName(Type $var = null)
    {
        # code...
    }
    public function guardar(){
        
    }
    static public function obtener($id,$cnn){

    }
    static public function obtenerTodos($cnn){

    }
    public function modificar($id){

    }
    static public function eliminar($id,$cnn){

    }
    static public function buscar($valor,$cnn){

    }

    /**
     * Get the value of descripcion
     */ 
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */ 
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
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

    /**
     * Get the value of precio
     */ 
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     *
     * @return  self
     */ 
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get the value of stock
     */ 
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set the value of stock
     *
     * @return  self
     */ 
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }
}
?>