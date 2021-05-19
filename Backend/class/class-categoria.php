<?php
include_once('interface-crud.php');
include_once('abstract-modelo.php');
class Categoria extends Modelo implements CRUD{
    private $tipo;
    private $estilo;
    public function __construct($tipo,$estilo)
    {
        parent::__construct0();
        $this->setTipo($tipo);
        $this->setEstilo($estilo);
    }

    public function guardar(){
        try{
            $query = $this->cnn->prepare("CALL agregarCategoria(:tipo,:estilo)");
            $query->execute($this->obtenerDatos());
            return Acciones::error_message("agregado",false);
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    static public function obtener($id,$cnn){
        try{
            $query = $cnn->prepare("CALL obtenerCategoria(:id)");
            $query->execute(array("id"=>$id));
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    static public function obtenerTodos($cnn){
        try{
            $query = $cnn->prepare("CALL obtenerCategorias()");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    public function modificar($id){
        try{
            $query = $this->cnn->prepare("CALL modificarCategoria(:tipo,:estilo,:id)");
            $datos = $this->obtenerDatos();
            $datos["id"]=$id;
            $query->execute($datos);
            return Acciones::error_message("modificado",false);
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    static public function eliminar($id,$cnn){
        try{
            $query = $cnn->prepare("CALL eliminarCategoria(:id)");
            $query->execute(array("id"=>$id));
            return Acciones::error_message("eliminado",true);
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    static public function buscar($valor,$cnn){
        try {
            $query = $cnn->prepare("CALL buscarCategoria(:valor)");
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
            "tipo"=>$this->getTipo(),
            "estilo"=>$this->getEstilo()
        );
    }
    
    public function getTipo()
    {
        return $this->tipo; 
    }

    public function setTipo($tipo)
    {
        $this->tipo=$tipo;
    }

    public function getMaterial()
    {
        return $this->material; 
    }

    public function setMaterial($material)
    {
        $this->material=$material;
    }

    public function getEstilo()
    {
        return $this->estilo; 
    }

    public function setEstilo($estilo)
    {
        $this->estilo=$estilo;
    }
}
?>