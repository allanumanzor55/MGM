<?php
include_once('class-conexion.php');
include_once('interface-crud.php');
include_once('trait-acciones.php');
class Pedido extends Conexion implements CRUD{
    use Acciones;
    //private $fecha;
    private $descripcion;
    private $cliente;
    private $estadoPago;
    private $productos = array();
    private $db,$cnn;
    public function __construct($descripcion,$cliente,$estadoPago,$productos)
    {
        //$this->setFecha($fecha);
        $this->setDescripcion($descripcion);
        $this->setCliente($cliente);
        $this->setEstadoPago($estadoPago);
        $this->setProductos($productos);
        $this->db = new Conexion();
        $this->cnn = $this->db->getConexion();
    }

    public function guardar(){
        try{
            $query = $this->cnn
                ->prepare("CALL crearPedido(?,?,?,@idPedido);");
            $query->execute($this->obtenerDatos());
            $query->closeCursor();
            $result = $this->cnn->query("SELECT @idPedido as pedido")->fetch(PDO::FETCH_ASSOC);
            try{
                foreach($this->productos as $producto){
                    $nProducto=array_merge($result,$producto);
                    $this->agregarProducto($nProducto);
                }
                return Acciones::error_message("registros",true);
            }catch(PDOException $e){
                echo Acciones::error_message($e,false);
            }
        }catch(PDOException $e){
            echo Acciones::error_message($e,false);
        }
        
    }
    
    public function agregarProducto($producto){
        $query = $this->cnn
            ->prepare("CALL agregarProductoPedido(:pedido,:producto,:cantidad);");
        $query->execute($producto);
        $query->closeCursor();
    }

    static public function obtener($id,$cnn){
        try{
            $query = $cnn
                ->prepare("CALL obtenerPedido(?);");
            $query->execute(array($id));
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){
            return Acciones::error_message($e,false);
        }
    }
    static public function obtenerTodos($cnn){
        try{
            $query = $cnn
                ->prepare("CALL obtenerPedidos();");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){
            Acciones::error_message($e,false);
        }
    }
    public function modificar($id){

    }
    static public function eliminar($id,$cnn){
        try{
            $query = $cnn
                ->prepare("CALL eliminarPedido(?);");
            $query->execute(array($id));
            return Acciones::error_message("eliminado",true);
        }catch(PDOException $e){
            return Acciones::error_message($e,false);
        }
    }
    static public function buscar($valor,$cnn){
        try{
            $query = $cnn
                ->prepare("CALL buscarPedido(?);");
            $query->execute(array($valor));
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){
            return Acciones::error_message($e,false);
        }
    }
    
    public function obtenerDatos()
    {
        return array(
            $this->getDescripcion(),
            $this->getCliente(),
            $this->getEstadoPago()
        );
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
    
    
    /**
     * Get the value of productos
     */ 
    public function getProductos()
    {
        return $this->productos;
    }

    /**
     * Set the value of productos
     *
     * @return  self
     */ 
    public function setProductos($productos)
    {
        $this->productos = $productos;

        return $this;
    }
}
?>