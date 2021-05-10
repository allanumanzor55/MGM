<?php
include_once('class-conexion.php');
include_once('interface-crud.php');
class Pedido extends Conexion implements CRUD{
    private $fecha;
    private $cliente;
    private $estadoPago;

    
    public function __construct($fecha,$cliente,$estadoPago)
    {
        $this->setFecha($fecha);
        $this->setCliente($cliente);
        $this->setEstadoPago($estadoPago);
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
     * Get the value of cliente
     */ 
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set the value of cliente
     *
     * @return  self
     */ 
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get the value of estadoPago
     */ 
    public function getEstadoPago()
    {
        return $this->estadoPago;
    }

    /**
     * Set the value of estadoPago
     *
     * @return  self
     */ 
    public function setEstadoPago($estadoPago)
    {
        $this->estadoPago = $estadoPago;

        return $this;
    }
}
?>