<?php
include_once('class-fotografia.php');
include_once('class-conexion.php');
include_once('interface-crud.php');
include_once('trait-acciones.php');
abstract class Persona extends Conexion implements CRUD{
    use Acciones;
    private $foto;
    private $idFoto;
    private $dni;
    private $nombre;
    private $primerApellido;
    private $segundoApellido;
    private $direccion;
    private $correo;
    private $celular;
    private $telefono;
    private $edad;

    public function __construct($foto,$dni, $nombre, $primerApellido, $segundoApellido, $direccion,
    $correo, $celular, $telefono)
    {
        $this->setFoto($foto);
        $this->setDni($dni);
        $this->setNombre($nombre);
        $this->setPrimerApellido($primerApellido);
        $this->setSegundoApellido($segundoApellido);
        $this->setDireccion($direccion);
        $this->setCorreo($correo);
        $this->setCelular($celular);
        $this->setTelefono($telefono);    
    }

    /**
     * Get the value of dni
     */ 
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set the value of dni
     *
     * @return  self
     */ 
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of primerApellido
     */ 
    public function getPrimerApellido()
    {
        return $this->primerApellido;
    }

    /**
     * Set the value of primerApellido
     *
     * @return  self
     */ 
    public function setPrimerApellido($primerApellido)
    {
        $this->primerApellido = $primerApellido;

        return $this;
    }

    /**
     * Get the value of segundoApellido
     */ 
    public function getSegundoApellido()
    {
        return $this->segundoApellido;
    }

    /**
     * Set the value of segundoApellido
     *
     * @return  self
     */ 
    public function setSegundoApellido($segundoApellido)
    {
        $this->segundoApellido = $segundoApellido;

        return $this;
    }

    /**
     * Get the value of direccion
     */ 
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set the value of direccion
     *
     * @return  self
     */ 
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get the value of correo
     */ 
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set the value of correo
     *
     * @return  self
     */ 
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get the value of celular
     */ 
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set the value of celular
     *
     * @return  self
     */ 
    public function setCelular($celular)
    {
        $this->celular = $celular;

        return $this;
    }

    /**
     * Get the value of telefono
     */ 
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set the value of telefono
     *
     * @return  self
     */ 
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get the value of edad
     */ 
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
    
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set the value of foto
     *
     * @return  self
     */ 
    public function setFoto($foto)
    {
        $this->foto = new Fotografia($foto['name'],$foto['size'],$foto['type'],$foto['tmp_name']);
        return $this;
    }

    /**
     * Get the value of idFoto
     */ 
    public function getIdFoto()
    {
        return $this->idFoto;
    }

    /**
     * Set the value of idFoto
     *
     * @return  self
     */ 
    public function setIdFoto($idFoto)
    {
        $this->idFoto = $idFoto;

        return $this;
    }
}
?>