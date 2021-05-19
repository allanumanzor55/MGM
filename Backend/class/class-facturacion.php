<?php
include_once('class-conexion.php');
include_once('interface-crud.php');
class Facturacion extends Conexion implements CRUD{
    private $pedido;
    private $fecha;
    private $subtotal;
    private $isv;
    private $total;

    public function __construct($pedido,$fecha,$subtotal,$isv,$total)
    {
        $this->setPedido($pedido);
        $this->setFecha($fecha);
        $this->setSubtotal($subtotal);
        $this->setIsv($isv);
        $this->setTotal($total);        
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

    public function obtenerDatos()
    {
        
    }
    /**
     * Get the value of pedido
     */ 
    public function getPedido()
    {
        return $this->pedido;
    }

    /**
     * Set the value of pedido
     *
     * @return  self
     */ 
    public function setPedido($pedido)
    {
        $this->pedido = $pedido;

        return $this;
    }

    /**
     * Get the value of fecha
     */ 
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */ 
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get the value of subtotal
     */ 
    public function getSubtotal()
    {
        return $this->subtotal;
    }

    /**
     * Set the value of subtotal
     *
     * @return  self
     */ 
    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;

        return $this;
    }

    /**
     * Get the value of isv
     */ 
    public function getIsv()
    {
        return $this->isv;
    }

    /**
     * Set the value of isv
     *
     * @return  self
     */ 
    public function setIsv($isv)
    {
        $this->isv = $isv;

        return $this;
    }


    /**
     * Get the value of total
     */ 
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set the value of total
     *
     * @return  self
     */ 
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }
}
?>