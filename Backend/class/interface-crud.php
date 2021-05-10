<?php
interface CRUD {
    
    /**
     * guardar atributos de la clase instanciada en la base de datos
     * @return      jsonText    un mensaje de exito o fallo de la operacion
     * @autor       Allan Josue Alonzo 
     */
    public function guardar();
    /**
     *  obtener un registro de la clase instanciada desde la base de datos
     *  @param       Integer      $id     id del registro
     *  @param       Conexion     $cnn    instancia de la conexion de la base de datos
     *  @return      Array       arreglo unidimensioanl asociativo del registro encontrado
     *  @autor Allan Josue Alonzo
     */
    static public function obtener($id,$cnn);
    /**
     *  obtiene todos los registros de clase instanciada desde la base de datos
     *  @param      Conexion        $cnn        instancia de la conexion de base de datos
     *  @return     Array       arreglo bidimensional asociativo de todos los registros de la base de datos
     *  @autor      Allan Josue Alonzo 
     */
    static public function obtenerTodos($cnn);
    /**
     *  modifica un registro 
     *  @param      Integer     $id     id del registro que se va a modificar   
     *  @return     JsonText    Texto en formato JSON con el error y su descripcion
     *  @autor      Allan Josue Alonzo
     */
    public function modificar($id);
    /**
     * modifica el campo "estado" de la base de datos para que el registro no sea visible
     * @param       Integer     $id     id del registro a 'eliminar'
     * @param       Conexion    $cnn    instancia de la conexion de la base de datos
     * @return     JsonText    Texto en formato JSON con el error y su descripcion
     * @autor   Allan Josue Alonzo
     */
    static public function eliminar($id,$cnn);
    /**
     * busca en la base de datos un registro usando un centinela
     * @param       Mixed       $valor      centinela usado para realizar la busqueda
     * @param       Conexion    $cnn        instancia de la conexion de la base de datos
     * @return      Array       arreglo bidimensional de los diferentes registros coincidentes
     * @autor       Allan Josue Alonzo
     */
    static public function buscar($valor,$cnn);
    /**
     * crea un arreglo asociativo con los datos, segun los atributos de la clase instanciada
     * usado generalmente para guardar o modificar
     * @return      Array       arreglo asociativo de datos
     * @autor       Allan Josue Alonzo Umanzor
     */
    public function obtenerDatos();
    //public function crearConexionDB();
    //public function obtenerConexionDB();
}
?>