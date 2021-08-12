<?php
include_once('../class/interface-crud.php');
include_once('../class/trait-acciones.php');
include_once('../class/class-conexion.php');
class Roles extends Conexion implements CRUD{
    use Acciones;
    private $rol;
    private $descripcion;
    private $empleados;
    private $clientes;
    private $inventario;
    private $guiaRemision;
    private $bodega;
    private $catalogo;
    private $cotizacion;
    private $configuracion;
    private $pedido;
    private $db;
    private $cnn;
    public function __construct($rol,$descripcion,$empleados,$clientes,$inventario,$guiaRemision,$bodega,$catalogo,$cotizacion,$pedido,$configuracion)
    {
        $this->rol = $rol;
        $this->descripcion = $descripcion;
        $this->empleados = $empleados;
        $this->clientes = $clientes;
        $this->inventario = $inventario;
        $this->guiaRemision = $guiaRemision;
        $this->bodega = $bodega;
        $this->catalogo = $catalogo;
        $this->cotizacion = $cotizacion;
        $this->pedido = $pedido;
        $this->configuracion = $configuracion;  
        $this->db = new Conexion();
        $this->cnn = $this->db->getConexion();  
    }

    public function guardar(){
        try{
            $query = $this->cnn
            ->prepare("CALL agregarRol(:rol,:descripcion,:empleados,:clientes,:inventario,:guiaRemision,:bodega,:catalogo,:cotizacion,:pedido,:configuracion)");
            $query->execute($this->obtenerDatos());
            return Acciones::error_message("agregado",true);
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    static public function obtener($id,$cnn){
        try{
            $query = $cnn->prepare("CALL obtenerRol(:id)");
            $query->execute(array("id"=>$id));
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }

    static public function obtenerTodos($cnn){
        try{
            $query = $cnn->prepare("CALL obtenerRoles()");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    public function modificar($id){
        try{
            $query = $this->cnn
            ->prepare("CALL modificarRol(:rol,:descripcion,:empleados,:clientes,:inventario,:guiaRemision,:bodega,:catalogo,:cotizacion,:pedido,:configuracion,:id);");
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
            $query = $cnn->prepare("CALL eliminarRol(:id)");
            $query->execute(array("id"=>$id));
            return Acciones::error_message("eliminado",true);
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    static public function buscar($valor,$cnn){
        try {
            $query = $cnn->prepare("CALL buscarRol(:valor)");
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
            "rol" =>$this->rol,
            "descripcion" =>$this->descripcion,
            "empleados" =>$this->empleados,
            "clientes" =>$this->clientes,
            "inventario" =>$this->inventario,
            "guiaRemision" =>$this->guiaRemision,
            "bodega" =>$this->bodega,
            "catalogo" =>$this->catalogo,
            "cotizacion" =>$this->cotizacion,
            "pedido" =>$this->pedido,
            "configuracion" =>$this->configuracion
        );
    }
}
?>