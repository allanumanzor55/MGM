<?php
include_once('../class/class-conexion.php');
class Fotografia extends Conexion{
    private $nombreFoto;
    private $tamanoFoto;
    private $formatoFoto;
    private $contenidoFoto;
    private $db;
    private $cnn;
    public function __construct($nombreFoto,$tamanoFoto,$formatoFoto,$contenidoFoto)
    {
        $this->nombreFoto = $nombreFoto;
        $this->tamanoFoto = $tamanoFoto;
        $this->formatoFoto = $formatoFoto;
        $this->contenidoFoto = $contenidoFoto;
        $this->db= new Conexion();
        $this->cnn = $this->db->getConexion();
    }

    public function guardarFotoUsuario(){
        $extension="";
        if ($this->formatoFoto=="image/x-png"||$this->formatoFoto=="image/png"){
            $extension="image/png";
        }elseif ($this->formatoFoto=="image/pjpeg"||$this->formatoFoto=="image/jpeg"||$this->formatoFoto=="image/jpg"){
            $extension="image/jpeg";
        }elseif ($this->formatoFoto=="image/gif"||$this->formatoFoto=="image/gif"){
            $extension="image/gif";
        }
        $imgBinary= fopen($this->contenidoFoto,"rb");
        $imgConvert = fread($imgBinary,$this->tamanoFoto);
        $imgConvert = base64_encode($imgConvert);
        fclose($imgBinary);
        $query = $this->cnn->prepare("INSERT INTO fotografias_usuarios (fotografia,nombreFoto,tamano,formato) VALUES (?,?,?,?)");
        $query
            ->execute(array($imgConvert,$this->nombreFoto,$this->tamanoFoto,$extension));
        $id = $this->cnn->lastInsertId();
        $query->closeCursor();
        $this->cnn = null;
        return $id;
    }

    public function guardarFotoProducto($idProducto){
        $extension="";
        if ($this->formatoFoto=="image/x-png"||$this->formatoFoto=="image/png"){
            $extension="image/png";
        }elseif ($this->formatoFoto=="image/pjpeg"||$this->formatoFoto=="image/jpeg"||$this->formatoFoto=="image/jpg"){
            $extension="image/jpeg";
        }elseif ($this->formatoFoto=="image/gif"||$this->formatoFoto=="image/gif"){
            $extension="image/gif";
        }
        $imgBinary= fopen($this->contenidoFoto,"rb");
        $imgConvert = fread($imgBinary,$this->tamanoFoto);
        $imgConvert = base64_encode($imgConvert);
        fclose($imgBinary);
        $query = $this->cnn->prepare("INSERT INTO fotografias_productos (idProducto,fotografia,nombreFoto,tamanoFoto,formatoFoto) VALUES (?,?,?,?,?)");
        $query
            ->execute(array($idProducto,$imgConvert,$this->nombreFoto,$this->tamanoFoto,$extension));
        $query->closeCursor();
        $this->cnn = null;
    }

    static public function obtenerFoto($id){
        $db = new Conexion();
        $cnn = $db->getConexion();
        $r = $cnn->query("SELECT fotografia FROM fotografias WHERE idFotografia = {$id}")->fetch(PDO::FETCH_ASSOC);
        return $r['fotografia']; 
    }

    static public function obtenerFotoProducto($idProducto){
        $db = new Conexion();
        $cnn = $db->getConexion();
        $query = $cnn->prepare('CALL obtenerFotoProducto(?)');
        $query->execute(array($idProducto));
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    static public function obtenerFotosProducto($idProducto)
    {
        $db = new Conexion();
        $cnn = $db->getConexion();
        $query = $cnn->prepare('CALL obtenerFotosProducto(?)');
        $query->execute(array($idProducto));
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>