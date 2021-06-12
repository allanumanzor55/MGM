<?php
include_once('class-conexion.php');
include_once('trait-acciones.php');
class Login extends Conexion{
    use Acciones;
    private $usuario;
    private $password;
    private $valido;
    private $cnn;
    private $db;
    public function __construct($usuario,$password)
    {
        $this->usuario = $usuario;
        $this->password = $password;
        $this->valido = false;
        $this->db = new Conexion();
        $this->cnn = $this->getConexion();
    }

    public function login(){
        try{
            $datosLogin = array();
            $datosLogin['validado']=false;
            $query = $this->cnn->prepare("CALL comprobarUser(?,@idUser);");
            $query->execute(array($this->usuario));
            $query->closeCursor();
            $result = $this->cnn->query("SELECT @idUser as 'idUser'")->fetch(PDO::FETCH_ASSOC);
            $datosLogin['idUser'] = $result['idUser'];
            if($datosLogin['idUser']!=0){
                $query = $this->cnn->prepare("CALL comprobarPassword(?,?,@validado)");
                $query->execute(array($datosLogin['idUser'],$this->password));
                $query->closeCursor();
                $result = $this->cnn->query("SELECT @validado as 'validado'")->fetch(PDO::FETCH_ASSOC);
                $datosLogin['validado'] = boolval($result['validado']);
                if($datosLogin['validado']){
                    $token = bin2hex(openssl_random_pseudo_bytes(16));
                    $query = $this->cnn->prepare("CALL login(?,?);");
                    $query->execute(array($datosLogin['idUser'],$token));
                    $query->closeCursor();
                    setcookie('idUser',$datosLogin['idUser'],time() + (86400 * 1), "/");
                    setcookie('token',$token,time() + (86400 * 1), "/");
                    $datosLogin['mensaje'] = "Bienvenido";
                }else{
                    $datosLogin['mensaje'] = "Contraseña incorrecta";
                }
            }else{
                $datosLogin['mensaje'] = "Usuario o contraseña incorrectos";
            }
            return $datosLogin;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    public static function validarLogin($cnn){
        $query = $cnn->prepare("CALL comprobarLogin(?,@validado);");
        $query->execute(array($_COOKIE['token']));
        $result = $cnn->query("SELECT @validado as 'validado';")->fetch(PDO::FETCH_ASSOC);
        return boolval($result['validado']);
    }

    public static function logout($cnn){
        $query = $cnn->prepare("CALL logout(?);");
        $query->execute(array($_COOKIE['idUser']));
        setcookie('idUser',"",3600, "/");
        setcookie('token',"",3600, "/");
    }
}
?>