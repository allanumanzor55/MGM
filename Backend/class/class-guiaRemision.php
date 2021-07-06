<?php
include_once('interface-crud.php');
include_once('class-conexion.php');
include_once('trait-acciones.php');
class GuiaRemision extends Conexion implements CRUD {
    use Acciones;
    private $empleado;
    private $motivoTraslado;
    private $bodegaSalida;
    private $bodegaEntrada;
    private $materiaPrima;
    private $materiales;
    private $db;
    private $cnn;
    public function __construct($empleado,$motivoTraslado,$bodegaSalida,$bodegaEntrada,$materiaPrima,$materiales)
    {
        $this->setEmpleado($empleado);
        $this->setMotivoTraslado($motivoTraslado);
        $this->setBodegaSalida($bodegaSalida);
        $this->setBodegaEntrada($bodegaEntrada);
        $this->setMateriaPrima($materiaPrima);
        $this->setMateriales($materiales);
        $this->db = new Conexion();
        $this->cnn = $this->db->getConexion();
    }

    public function guardar(){
        try{
            $query = $this->cnn->prepare("CALL guardarGuia(:empleado,:motivoTraslado,:bodegaSalida,:bodegaEntrada,@idGuia)");
            $query->execute($this->obtenerDatos());
            $result = $this->cnn->query("SELECT @idGuia AS idGuia ")->fetch(PDO::FETCH_ASSOC);
            try{
                foreach($this->materiaPrima as $materiaPrima){
                    $nMateriaPrima=array_merge($result,$materiaPrima);
                    $this->agregarMateriaPrima($nMateriaPrima);
                }
                foreach($this->materiales as $material){
                    $nMaterial=array_merge($result,$material);
                    $this->agregarMaterial($nMaterial);
                }
                return Acciones::error_message("agregados",true);
            }catch(PDOException $e){
                return Acciones::error_message($e,false);
            }
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    
    public function agregarMaterial($nMaterial)
    {
        try{
            $query = $this->cnn->prepare("CALL agregarMaterialGuia(:idGuia,:id,:cantidad)");
            $query->execute($nMaterial);
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }

    public function agregarMateriaPrima($nMateriaPrima)
    {
        try{
            $query = $this->cnn->prepare("CALL agregarMateriaPrimaGuia(:idGuia,:id,:cantidad)");
            $query->execute($nMateriaPrima);
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }

    static public function obtener($id,$cnn){
        try{
            $array = Array("id"=>$id);
            $result = Acciones::query_get($cnn,"CALL obtenerGuia(:id)",$array,false);
            $result['materiales'] = Acciones::query_get($cnn,"CALL obtenerMaterialesGuia(:id)",$array,true);
            $result['materiaPrima'] = Acciones::query_get($cnn,"CALL obtenerMateriasPrimasGuia(:id)",$array,true);
            return $result;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }

    static public function obtenerTodos($cnn){
        try{
            $result = Acciones::query_get($cnn,"CALL obtenerGuias()",null,true);
            $nResult = array();
            foreach ($result as $value) {
                $array = Array("id"=>$value["idGuia"]);
                $resultMateriales = Acciones::query_get($cnn,"CALL obtenerMaterialesGuia(:id)",$array,true);
                $resultMateriaPrima= Acciones::query_get($cnn,"CALL obtenerMateriasPrimasGuia(:id)",$array,true);
                $value['materiales'] = $resultMateriales;
                $value['materiasPrimas'] = $resultMateriaPrima;
                $nResult[] = $value;
            }
            return $nResult;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }

    //terminado
    public function modificar($id){
        try{
            $query = $this->cnn->prepare("CALL modificarGuia(:descripcion,:materiaPrima,:precio,:id);");
            $datos = $this->obtenerDatos();
            $datos["id"]=$id;
            $query->execute($datos);
            $query->closeCursor();
            /*
            $result['idGuia']=$id;
            $bool = 0;
            try{
                foreach($this->materiales as $material){
                    $nProducto=array_merge($result,$material);
                    $nProducto['cen']=$bool;
                    $this->modificarMaterial($nProducto);
                    $bool=1;
                }
                return Acciones::error_message("modificados",true);
            }catch(PDOException $e){
                return Acciones::error_message($e,false);
            }*/
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    
    //terminado
    static public function eliminar($id,$cnn){
        try{
            $query = $cnn->prepare("CALL eliminarGuia(:id)");
            $query->execute(array("id"=>$id));
            return Acciones::error_message("eliminado",true);
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }

    static public function buscar($valor,$cnn){

    }

    public function modificarMaterial($nMaterial){
        try{
            $query = $this->cnn->prepare("CALL modificarMaterialGuia(:idGuia,:material,:cantidad,:cen);");
            $query->execute($nMaterial);
            $query->closeCursor();
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }

    public function obtenerDatos()
    {
        return array(
            "empleado" => $this->getEmpleado(),
            "motivoTraslado"=>$this->getMotivoTraslado(),
            "bodegaSalida"=>$this->getBodegaSalida(),
            "bodegaEntrada"=>$this->getBodegaEntrada()
        );
    }

    public function getMotivoTraslado()
    {
        return $this->motivoTraslado;
    }

    public function setMotivoTraslado($motivoTraslado)
    {
        $this->motivoTraslado = $motivoTraslado;
    }

    public function getBodegaSalida()
    {
        return $this->bodegaSalida;
    }

    public function setBodegaSalida($bodegaSalida)
    {
        $this->bodegaSalida = $bodegaSalida;
    }

    public function getBodegaEntrada()
    {
        return $this->bodegaEntrada;
    }

    public function setBodegaEntrada($bodegaEntrada)
    {
        $this->bodegaEntrada = $bodegaEntrada;
    }

    public function getMateriales()
    {
        return $this->materiales;
    }

    public function setMateriales($materiales)
    {
        $this->materiales = $materiales;
    }

    public function getMateriaPrima()
    {
        return $this->materiaPrima;
    }

    public function setMateriaPrima($materiaPrima)
    {
        $this->materiaPrima = $materiaPrima;
    }

    public function getEmpleado()
    {
        return $this->empleado;
    }

    public function setEmpleado($empleado)
    {
        $this->empleado = $empleado;
    }
}

