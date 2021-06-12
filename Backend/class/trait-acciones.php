<?php
/**
 * Trazo de acciones que se heredan a todas las clases
 * Entre ellas 
 * * error_message
 * * query_get
 */
trait Acciones {
    static public function error_message($e,$centinela)
    {
        if($centinela==true){
            return '{"mensaje":"registro '.$e.' exitosamente","centinela":"true"}';
        }else{
            return '{"mensaje":"'.$e->getMessage().'"
                    ,"trazo:":'.json_encode($e->getTrace(),true).'
                    ,"centinela":"false"}';
        } 
    }
    /**
     * Funcion que devuelve un array de los valores de un query (select) o procedimiento que use SELECT
     * @param   Conexion    $cnn        Conexion variable del tipo Conexion para realizar el query
     * @param   String      $query      setencia que se desea ejecutar
     * @param   Array       $param      Array Parametros del query en caso de que los necesite
     * @param   Boolean     $fetchAll   variable de configuracion para saber si usaremos fetchAll o no
     * @return  Array       Arreglo de resultado del query
     */
    static function query_get($cnn,$query,$param,$fetchAll){
        $result=null;
        $qry = $cnn->prepare($query);
        $qry->execute($param);
        if($fetchAll==true){
            $result = $qry->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $result = $qry->fetch(PDO::FETCH_ASSOC);
        }
        $qry->closeCursor();
        return $result;
    }
}

?>