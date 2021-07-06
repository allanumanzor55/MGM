<?php
include_once('abstract-inventario.php');
class FichaProducto extends Inventario{
    private $materiaPrima;
    private $materiales;
    public function __construct($descripcion,$materiaPrima,$precio,$materiales)
    {
        parent::__construct($descripcion,$precio,0);
        $this->setMateriaPrima($materiaPrima);
        $this->materiales = $materiales;
        $this->db = new Conexion();
        $this->cnn = $this->db->getConexion();
    }
    //guardar
    public function guardar(){
        try{
            $query = $this->cnn->prepare("CALL agregarFichaProducto(:descripcion,:materiaPrima,:precio,@idFichaProducto);");
            $query->execute($this->obtenerDatos());
            $result = $this->cnn->query("SELECT @idFichaProducto as idFichaProducto ")->fetch(PDO::FETCH_ASSOC);
            try{
                foreach($this->materiales as $material){
                    $nProducto=array_merge($result,$material);
                    $this->agregarMaterial($nProducto);
                }
                return Acciones::error_message("agregados",true);
            }catch(PDOException $e){
                return Acciones::error_message($e,false);
            }
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    //terminado
    static public function obtener($id,$cnn){
        try{
            $array = Array("id"=>$id);
            $result = Acciones::query_get($cnn,"CALL obtenerFichaProducto(:id)",$array,false);
            $result['materiales'] = Acciones::query_get($cnn,"CALL obtenerMaterialesFichaProducto(:id)",$array,true);
            return $result;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }

    static public function obtenerTodos($cnn){
        try{
            $result = Acciones::query_get($cnn,"CALL obtenerFichasProductos()",null,true);
            $nResult = array();
            foreach ($result as $value) {
                $array = Array("id"=>$value["idFichaProducto"]);
                $resultMateriales = Acciones::query_get($cnn,"CALL obtenerMaterialesFichaProducto(:id)",$array,true);
                $value['materiales'] = $resultMateriales;
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
            $query = $this->cnn->prepare("CALL modificarFichaProducto(:descripcion,:materiaPrima,:precio,:id);");
            $datos = $this->obtenerDatos();
            $datos["id"]=$id;
            $query->execute($datos);
            $query->closeCursor();
            $result['idFichaProducto']=$id;
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
            }
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    
    //terminado
    static public function eliminar($id,$cnn){
        try{
            $query = $cnn->prepare("CALL eliminarFichaProducto(:id)");
            $query->execute(array("id"=>$id));
            return Acciones::error_message("eliminado",true);
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }

    static public function buscar($valor,$cnn){

    }
    
    //terminado
    public function agregarMaterial($nMaterial)
    {
        try{
            $query = $this->cnn
            ->prepare("CALL agregarMaterialesFichaProducto(:idFichaProducto,:material,:cantidad);");
            $query->execute($nMaterial);
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }

    public function modificarMaterial($nMaterial){
        try{
            $query = $this->cnn->prepare("CALL modificarMaterialFichaProducto(:idFichaProducto,:material,:cantidad,:cen);");
            $query->execute($nMaterial);
            $query->closeCursor();
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }

    public function obtenerDatos()
    {
        return array(
            "descripcion"=>$this->getDescripcion(),
            "materiaPrima"=>$this->getMateriaPrima(),
            "precio"=>$this->getPrecio()
        );
    }

    public function getMateriaPrima(){
        return $this->materiaPrima;
    }
    public function setMateriaPrima($materiaPrima){
        $this->materiaPrima = $materiaPrima;
    }
}
?>