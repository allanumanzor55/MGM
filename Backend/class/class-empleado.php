<?php
include_once('abstract-persona.php');
class Empleado extends Persona{
    private $sueldo;
    private $tipoEmpleado;
    private $db;
    private $cnn;
    public function __construct($tipoEmpleado, $dni, $nombre, $primerApellido, $segundoApellido, 
    $direccion, $correo, $celular, $telefono, $sueldo)
    {
        parent::__construct($dni,$nombre,$primerApellido,$segundoApellido,$direccion,$correo,
        $celular,$telefono);
        $this->setTipoEmpleado($tipoEmpleado);
        $this->setSueldo($sueldo);
        $this->db = new Conexion();
        $this->cnn = $this->db->getConexion();
    }

    public function guardar(){
        try{
            $query = $this->cnn->prepare("CALL guardarEmpleado(:tipoEmpleado,:dni,:nombre,:primerApellido,:segundoApellido,:direccion,:correo,:celular,:telefono,:sueldo);");
            $query->execute($this->obtenerDatos());
            return Acciones::error_message("agregado",true);
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    static public function obtener($id,$cnn){
        try{
            $query = $cnn->prepare("CALL obtenerEmpleado(:id)");
            $query->execute(array("id"=>$id));
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    static public function obtenerTodos($cnn){
        try{
            $query = $cnn->prepare("CALL obtenerEmpleados()");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    public function modificar($id){
        try{
            $query = $this->cnn->prepare("CALL modificarEmpleado(:dni,:nombre,:primerApellido,:segundoApellido,:direccion,:correo,:celular,:telefono,:sueldo,:id)");
            $datos = $this->obtenerDatos();
            unset($datos['tipoEmpleado']);
            $datos["id"]=$id;
            $query->execute($datos);
            return Acciones::error_message("modificado",true);
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    static public function eliminar($id,$cnn){
        try{
            $query = $cnn->prepare("CALL eliminarEmpleado(:id)");
            $query->execute(array("id"=>$id));
            return Acciones::error_message("eliminado",true);
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    static public function buscar($valor,$cnn){
        try {
            $query = $cnn->prepare("CALL buscarEmpleado(:valor)");
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
            "tipoEmpleado"=>$this->getTipoEmpleado(),
            "dni"=>$this->getDni(),
            "nombre"=>$this->getNombre(),
            "primerApellido"=>$this->getPrimerApellido(),
            "segundoApellido"=>$this->getSegundoApellido(),
            "direccion"=>$this->getDireccion(),
            "correo"=>$this->getCorreo(),
            "celular"=>$this->getCelular(),
            "telefono"=>$this->getTelefono(),
            "sueldo"=>$this->getSueldo()
        );
    }

    /**
     * Get the value of tipoEmpleado
     */ 
    public function getTipoEmpleado()
    {
        return $this->tipoEmpleado;
    }

    /**
     * Set the value of tipoEmpleado
     *
     * @return  self
     */ 
    public function setTipoEmpleado($tipoEmpleado)
    {
        $this->tipoEmpleado = $tipoEmpleado;
        return $this;
    }

    /**
     * Get the value of sueldo
     */ 
    public function getSueldo()
    {
        return $this->sueldo;
    }

    /**
     * Set the value of sueldo
     *
     * @return  self
     */ 
    public function setSueldo($sueldo)
    {
        $this->sueldo = $sueldo;
        return $this;
    }
}
?>