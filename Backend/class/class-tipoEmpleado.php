<?php
include_once('abstract-modelo.php');
class TipoEmpleado extends Modelo{

    public function __construct($descripcion)
    {
        parent::__construct($descripcion);
    }

    public function guardar(){
        try{
            $query = $this->cnn->prepare("CALL agregarTipoEmpleado(:descripcion)");
            $query->execute($this->obtenerDatos());
            return Acciones::error_message("agregado",true);
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }

    static public function obtener($id,$cnn){
        try{
            $query = $cnn->prepare("CALL obtenerTipoEmpleado(:id)");
            $query->execute(array("id"=>$id));
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    static public function obtenerTodos($cnn){
        try{
            $query = $cnn->prepare("CALL obtenerTipoEmpleados()");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    public function modificar($id){
        try{
            $query = $this->cnn->prepare("CALL modificarTipoEmpleado(:descripcion,:id)");
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
            $query = $cnn->prepare("CALL eliminarTipoEmpleado(:id)");
            $query->execute(array("id"=>$id));
            return Acciones::error_message("eliminado",true);
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    static public function buscar($valor,$cnn){

    }
    public function obtenerDatos(){
        return array(
            "descripcion" => $this->getDescripcion()
        );
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