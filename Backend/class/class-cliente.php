<?php
include_once('abstract-persona.php');
class Cliente extends Persona{
    private $tipoCliente;
    private $edad;
    private $nombreEmpresa;
    private $rtnEmpresa;
    private $db;
    private $cnn;
    public function __construct($foto,$tipoCliente, $dni, $nombre, $primerApellido, $segundoApellido, 
    $direccion, $correo, $celular, $telefono, $edad,$nombreEmpresa,$rtnEmpresa)
    {
        parent::__construct($foto,$dni,$nombre,$primerApellido,$segundoApellido,$direccion,$correo,
        $celular,$telefono);
        $this->setTipoCliente($tipoCliente);
        $this->setEdad($edad);
        $this->setNombreEmpresa($nombreEmpresa);
        $this->setRtnEmpresa($rtnEmpresa);
        $this->db = new Conexion();
        $this->cnn = $this->db->getConexion();
    }

    public function guardar(){
        try{
            $this->setIdFoto($this->getFoto()->guardarFotoUsuario());
            $query = $this->cnn->prepare("CALL guardarCliente(:idFoto,:nombreEmpresa,:rtnEmpresa,:tipoCliente,:dni,:nombre,:primerApellido,:segundoApellido,:direccion,:correo,:celular,:telefono,:edad)");
            $query->execute($this->obtenerDatos());
            return Acciones::error_message("agregado",true);
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    static public function obtener($id,$cnn){
        try{
            $query = $cnn->prepare("CALL obtenerCliente(:id)");
            $query->execute(array("id"=>$id));
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    static public function obtenerTodos($cnn){
        try{
            $query = $cnn->prepare("CALL obtenerClientes()");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    public function modificar($id){
        try{
            $query = $this->cnn->prepare("CALL modificarCliente(:nombreEmpresa,:rtnEmpresa,:tipoCliente,:dni,:nombre,:primerApellido,:segundoApellido,:direccion,:correo,:celular,:telefono,:edad,:id);");
            $datos = $this->obtenerDatos();
            unset($datos['idFoto']);
            $datos["id"]=$id;
            $query->execute($datos);
            return Acciones::error_message("modificado",true);
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    static public function eliminar($id,$cnn){
        try{
            $query = $cnn->prepare("CALL eliminarCliente(:id)");
            $query->execute(array("id"=>$id));
            return Acciones::error_message("eliminado",true);
        }catch(Exception $e){
            return Acciones::error_message($e,false);          
        }
    }
    static public function buscar($valor,$cnn){
        try {
            $query = $cnn->prepare("CALL buscarCliente(:valor)");
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
            "idFoto"=>$this->getIdFoto(),
            "nombreEmpresa"=>$this->getNombreEmpresa(),
            "rtnEmpresa"=>$this->getRtnEmpresa(),
            "tipoCliente"=>$this->getTipoCliente(),
            "dni"=>$this->getDni(),
            "nombre"=>$this->getNombre(),
            "primerApellido"=>$this->getPrimerApellido(),
            "segundoApellido"=>$this->getSegundoApellido(),
            "direccion"=>$this->getDireccion(),
            "correo"=>$this->getCorreo(),
            "celular"=>$this->getCelular(),
            "telefono"=>$this->getTelefono(),
            "edad"=>$this->getEdad()
        );
    }

    /**
     * Get the value of tipoCliente
     */ 
    public function getTipoCliente()
    {
        return $this->tipoCliente;
    }

    /**
     * Set the value of tipoCliente
     *
     * @return  self
     */ 
    public function setTipoCliente($tipoCliente)
    {
        $this->tipoCliente = $tipoCliente;

        return $this;
    }

    public function getEdad()
    {
        return $this->edad;
    }

    /**
     * Set the value of edad
     *
     * @return  self
     */ 
    public function setEdad($edad)
    {
        $this->edad = $edad;

        return $this;
    }

    
    public function getNombreEmpresa()
    {
        return $this->nombreEmpresa;
    }

    /**
     * Set the value of nombreEmpresa
     *
     * @return  self
     */ 
    public function setNombreEmpresa($nombreEmpresa)
    {
        $this->nombreEmpresa = $nombreEmpresa;
        return $this;
    }

    public function getRtnEmpresa()
    {
        return $this->rtnEmpresa;
    }

    /**
     * Set the value of rtnEmpresa
     *
     * @return  self
     */ 
    public function setRtnEmpresa($rtnEmpresa)
    {
        $this->rtnEmpresa = $rtnEmpresa;

        return $this;
    }
}
?>