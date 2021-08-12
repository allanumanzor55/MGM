<?php
    include_once('class-fotografia.php');
    include_once('class-conexion.php');
    include_once('interface-crud.php');
    include_once('trait-acciones.php');
    class Catalogo extends Conexion implements CRUD{
        use Acciones;
        private $fotos = array();
        private $nombreProducto;
        private $descripcionProducto;
        private $precio;
        private $exentoImpuesto;
        private $db;
        private $cnn;

        public function __construct($fotos,$nombreProducto,$descripcionProducto,$precio,$exentoImpuesto)
        {
            foreach ($fotos['tmp_name'] as $key => $value) {
                $this->fotos[] = new Fotografia($fotos['name'][$key],$fotos['size'][$key],$fotos['type'][$key],$fotos['tmp_name'][$key]);
            }
            $this->setNombreProducto($nombreProducto);
            $this->setDescripcionProducto($descripcionProducto);
            $this->setPrecio($precio);
            $this->setExentoImpuesto($exentoImpuesto);
            $this->db = new Conexion();
            $this->cnn = $this->db->getConexion();
        }
        public function guardar(){
            try{
                $query = $this->cnn->prepare("CALL guardarCatalogo(:nombreProducto,:descripcionProducto,:precio,:exentoImpuesto,@idCatalogo);");
                $query->execute($this->obtenerDatos());
                $result = $this->cnn->query("SELECT @idCatalogo as 'idCatalogo' ")->fetch(PDO::FETCH_ASSOC);
                $idCatalogo = $result['idCatalogo'];
                foreach ($this->fotos as $key => $value) {
                    $value->guardarFotoProducto($idCatalogo);
                }
                return Acciones::error_message("agregado",true);
            }catch(Exception $e){
                return Acciones::error_message($e,false);
            }
        }
        static public function obtener($id,$cnn){
            try{
                $query = $cnn->prepare("CALL obtenerCatalogo(:id)");
                $query->execute(array("id"=>$id));
                $result = $query->fetch(PDO::FETCH_ASSOC);
                return $result;
            }catch(Exception $e){
                return Acciones::error_message($e,false);
            }
        }
        static public function obtenerTodos($cnn){
            try{
                $query = $cnn->prepare("CALL obtenerCatalogos()");
                $query->execute();
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $key => $value) {
                    $result[$key]['foto'] = Fotografia::obtenerFotosProducto($value['idCatalogo']);
                }
                return $result;
            }catch(Exception $e){
                return Acciones::error_message($e,false);
            }
        }
        public function modificar($id){
            try{
                $query = $this->cnn->prepare("CALL modificarCatalogo(:nombreProducto,:descripcionProducto,:precio,:exentoImpuesto,:id)");
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
                $query = $cnn->prepare("CALL eliminarCatalogo(:id)");
                $query->execute(array("id"=>$id));
                return Acciones::error_message("eliminado",true);
            }catch(Exception $e){
                return Acciones::error_message($e,false);
            }
        }
        static public function buscar($valor,$cnn){
            try {
                $query = $cnn->prepare("CALL buscarCatalogo(:valor,:tipo)");
                $query->execute(array("valor"=>$valor,"tipo"=>$_GET['tipo']));
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }catch(Exception $e){
                return Acciones::error_message($e,false);
            }
        }
        public function obtenerDatos(){
            return Array(
                "nombreProducto"=>$this->getNombreProducto(),
                "descripcionProducto"=>$this->getDescripcionProducto(),
                "precio"=>$this->getPrecio(),
                "exentoImpuesto"=>$this->getExentoImpuesto()
            );
        }

        public function getNombreProducto(){
            return $this->nombreProducto;
        }

        public function setNombreProducto($nombreProducto){
            $this->nombreProducto = $nombreProducto;
        }

        public function getDescripcionProducto(){
            return $this->descripcionProducto;
        }

        public function setDescripcionProducto($descripcionProducto){
            $this->descripcionProducto = $descripcionProducto;
        }
        public function getPrecio(){
            return $this->precio;
        }

        public function setPrecio($precio){
            $this->precio = $precio;
        }

        public function getExentoImpuesto(){
            return $this->exentoImpuesto;
        }

        public function setExentoImpuesto($exentoImpuesto){
            $this->exentoImpuesto = $exentoImpuesto;
        }

        public function getFotos(){
            return $this->fotos;
        }

    }
?>