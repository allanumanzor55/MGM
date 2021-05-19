<?php
include_once('class-conexion.php');
include_once('interface-crud.php');
include_once('trait-acciones.php');
abstract class Modelo Extends Conexion implements CRUD {
    use acciones;
    private $descripcion;
    protected $db;
    protected $cnn;
    public function __construct($descripcion)
    {
        $this->setDescripcion($descripcion);
        $this->db = new Conexion();
        $this->cnn = $this->db->getConexion();
    }

    public function __construct0()
    {
        $this->db = new Conexion();
        $this->cnn = $this->db->getConexion();
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