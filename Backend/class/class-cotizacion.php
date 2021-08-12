<?php
include_once('class-conexion.php');
include_once('interface-crud.php');
include_once('trait-acciones.php');
class Cotizacion extends Conexion implements CRUD{
    use Acciones;
    private $descripcion;
    private $empleado;
    private $cliente;
    private $productos;
    private $db;
    private $cnn;

    function __construct($descripcion,$empleado,$cliente,$productos)
    {
        $this->descripcion = $descripcion;
        $this->empleado = $empleado;
        $this->cliente = $cliente;
        $this->productos = $productos;
        $this->db = new Conexion();
        $this->cnn = $this->db->getConexion();
    }

    public function guardar(){
        try{
            $query = $this->cnn->prepare("CALL guardarCotizacion(:descripcion,:empleado,:cliente,@idCotizacion);");
            $query->execute($this->obtenerDatos());
            $result = $this->cnn->query("SELECT @idCotizacion as idCotizacion ")->fetch(PDO::FETCH_ASSOC);
            $query->closeCursor();
            try{
                foreach($this->productos as $producto){
                    $nProducto=array_merge($result,$producto);
                    $this->agregarProducto($nProducto);
                }
                return Acciones::error_message("agregado",true);
            }catch(Exception $e){
                return Acciones::error_message($e,false);
            }
            return Acciones::error_message("agregado",true);
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }

    public function agregarProducto($producto){
        try{
            $query = $this->cnn
            ->prepare("CALL agregarProductoCotizacion(:idCotizacion,:id,:cantidad);");
            $query->execute($producto);
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }

    static public function obtenerProductosCotizados($cnn,$id){
        $query = $cnn->prepare("CALL obtenerProductosCotizados(:id)");
        $query->execute(Array("id"=>$id));
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    static public function obtener($id,$cnn){
        try{
            $query = $cnn->prepare("CALL obtenerCotizacion(:id)");
            $query->execute(array("id"=>$id));
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    static public function obtenerTodos($cnn){
        try{
            $query = $cnn->prepare("CALL obtenerCotizaciones()");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }

    static public function obtenerPorEstado($cnn,$estado){
        try{
            $query = $cnn->prepare("CALL obtenerCotizacionEstado(:estado)");
            $query->execute(array("estado"=>$estado));
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    public function modificar($id){
        try{
            $query = $this->cnn->prepare("CALL modificarCotizacion(:descripcion,:id)");
            $datos = $this->obtenerDatos();
            unset($datos['tipoCotizacion']);
            $datos["id"]=$id;
            $query->execute($datos);
            return Acciones::error_message("modificado",true);
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }

    static public function modificarEstado($cnn,$id,$estado){
        try{
            $query = $cnn->prepare("CALL modificarEstadoCotizacion(:id,:estado);");
            $query->execute(array("id"=>$id,"estado"=>$estado));
            return Acciones::error_message("modificado",true);
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }

    static public function eliminar($id,$cnn){
        try{
            $query = $cnn->prepare("CALL eliminarCotizacion(:id)");
            $query->execute(array("id"=>$id));
            return Acciones::error_message("eliminado",true);
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }

    static public function buscar($valor,$cnn){
        try {
            $query = $cnn->prepare("CALL buscarCotizacion(:valor,:tipo)");
            $query->execute(array("valor"=>$valor,"tipo"=>$_GET['tipo']));
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }

    public function obtenerDatos()
    {
        return array(
            "descripcion"=>$this->descripcion,
            "empleado"=>$this->empleado,
            "cliente"=>$this->cliente
        );
    }
}

?>