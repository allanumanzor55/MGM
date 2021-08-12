<?php
    include_once('class-conexion.php');
    include_once('interface-crud.php');
    include_once('trait-acciones.php');
    class Ordenes extends Conexion implements CRUD {
        use Acciones;
        private $idCotizacion;
        private $db;
        private $cnn;
        public function __construct($idCotizacion)
        {
            $this->idCotizacion = $idCotizacion;
            $this->db = new Conexion();
            $this->cnn = $this->db->getConexion();
        }
        
        public function guardar(){
            try{
                $query = $this->cnn->prepare("CALL agregarOrden()");
                $query->execute($this->obtenerDatos());
                return Acciones::error_message("agregado",true);
            }catch(Exception $e){
                return Acciones::error_message($e,false);
            }
        }
        static public function obtener($id,$cnn){
            try{
                $query = $cnn->prepare("CALL obtenerOrden(:id)");
                $query->execute(array("id"=>$id));
                $result = $query->fetch(PDO::FETCH_ASSOC);
                return $result;
            }catch(Exception $e){
                return Acciones::error_message($e,false);
            }
        }
        static public function obtenerTodos($cnn){
            try{
                $query = $cnn->prepare("CALL obtenerOrdenes()");
                $query->execute();
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }catch(Exception $e){
                return Acciones::error_message($e,false);
            }
        }
        public function modificar($id){
            try{
                $query = $this->cnn->prepare("CALL modificarOrden(:descripcion,:material,:id)");
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
                $query = $cnn->prepare("CALL eliminarOrden(:id)");
                $query->execute(array("id"=>$id));
                return Acciones::error_message("eliminado",true);
            }catch(Exception $e){
                return Acciones::error_message($e,false);
            }
        }
        static public function buscar($valor,$cnn){
            try {
                $query = $cnn->prepare("CALL buscarOrden(:valor)");
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
                "idCotizacion"=>$this->idCotizacion
            );
        }
    }
?>