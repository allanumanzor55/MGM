<?php
//
class Conexion {
    private $conexion = null;
    private $db;
    public function getConexion()
    {
        $archivo = __DIR__ ."/config.ini";
        $this->db = parse_ini_file($archivo, true);
        try {
            $this->conexion  = new PDO( 'mysql: host='.$this->db['DATABASE']['host'].'; 
                                                dbname='.$this->db['DATABASE']['dbname'],
                                                $this->db['DATABASE']['user'],
                                                $this->db['DATABASE']['password'],
                                                array('charset'=>'utf8'));
            $this->conexion->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
            $this->conexion->exec("SET CHARACTER SET utf8");
            return $this->conexion;
        } catch (Exception $e) {
            echo "Error".$e->getMessage();
        } finally {
            $this->conexion=null;
        }
    }
}
?>