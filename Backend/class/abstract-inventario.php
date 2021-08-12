<?php
include_once('class-fotografia.php');
include_once('interface-crud.php');
include_once('trait-acciones.php');
abstract class Inventario extends Fotografia implements CRUD{
    use Acciones;
    private $descripcion;
    private $precio;
    private $stock;
    protected $cnn;
    protected $db;

    public function __construct($descripcion,$precio,$stock)
    {
        $this->setDescripcion($descripcion);
        $this->setPrecio($precio);
        $this->setStock($stock);
    }
    
    static public function modificarStock($id,$stock,$tipoInventario){
        try{
            $db = new Conexion();
            $cnn = $db->getConexion();
            $query = $cnn->prepare('CALL modificarStock(?,?,?);');
            $query->execute(Array($id,intval($stock),$tipoInventario));
            $query->closeCursor();
            return Acciones::error_message("(Stock) Modificado",true);
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    /**
     * Get the value of descripcion
     */ 
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */ 
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    
    /**
     * Get the value of precio
     */ 
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     *
     * @return  self
     */ 
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get the value of stock
     */ 
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set the value of stock
     *
     * @return  self
     */ 
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }
}
?>