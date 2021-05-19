<?php
include_once('abstract-modelo.php');
class TipoCliente extends Modelo{
    private $descripcion;

    public function __construct($descripcion)
    {
        parent::__construct($descripcion);
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

    public function obtenerDatos(){
        
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