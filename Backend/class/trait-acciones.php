<?php
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
}

?>