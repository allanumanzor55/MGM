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
            $query = $this->cnn->prepare('SELECT idUsuario,id,TipoUsuario FROM vw_usuarios WHERE usuario = ?');
            $query->execute(array($this->usuario));
            $result = $query->fetch(PDO::FETCH_ASSOC);
            $query->closeCursor();
            $datosLogin['idUser'] = $result['idUsuario'];
            $datosLogin['id'] = $result['id'];
            $datosLogin['tipoUsuario'] = $result['TipoUsuario'];
            if($datosLogin['idUser']!=0){
                $query = $this->cnn->prepare("CALL comprobarPassword(?,?,@validado)");
                $query->execute(array($datosLogin['idUser'],$this->password));
                $result = $this->cnn->query("SELECT @validado as 'validado' ")->fetch(PDO::FETCH_ASSOC);
                $datosLogin['validado'] = boolval($result['validado']);
                if($datosLogin['validado']){
                    $token = bin2hex(openssl_random_pseudo_bytes(16));
                    $datosLogin['token'] = $token;
                    $query = $this->cnn->prepare("CALL Login(?,?)");
                    $query->execute(array($datosLogin['idUser'],$token));
                    setcookie('id',$datosLogin['id'],time() + (86400 * 1), "/");
                    setcookie('tipoUsuario',$datosLogin['tipoUsuario'],time() + (86400 * 1), "/");
                    setcookie('idUser',$datosLogin['idUser'],time() + (86400 * 1), "/");
                    setcookie('token',$token,time() + (86400 * 1), "/");
                    $datosLogin['mensaje'] = "Bienvenido ";
                }else{
                    $datosLogin['mensaje'] = "Contraseña incorrecta ";
                }
            }else{
                $datosLogin['mensaje'] = "Usuario o contraseña incorrectos ";
            }
            return $datosLogin;
        }catch(Exception $e){
            return Acciones::error_message($e,false);
        }
    }
    
    public static function verificarPM($cnn,$password){
        $query = $cnn->prepare("CALL comprobarMasterPassword(?,@validado)");
        $query->execute(array($password));
        $result = $cnn->query("SELECT @validado as 'validado' ")->fetch(PDO::FETCH_ASSOC);
        $validado = boolval($result['validado']);
        return $validado;
    }

    public static function validarLogin($cnn){
        $query = $cnn->prepare("CALL comprobarLogin(?,@validado);");
        $query->execute(array($_COOKIE['token']));
        $result = $cnn->query("SELECT @validado as validado ")->fetch(PDO::FETCH_ASSOC);
        return boolval($result['validado']);
    }

    public static function logout($cnn){
        $query = $cnn->prepare(" CALL logout(?); ");
        $query->execute(array($_COOKIE['idUser']));
        setcookie('idUser',"",3600, "/");
        setcookie('id',"",3600, "/");
        setcookie('token',"",3600, "/");
        setcookie('tipoUsuario',"",time() + (86400 * 1), "/");
    }

    public static function obtenerPermisos($cnn)
    {
        $query = $cnn->prepare("CALL obtenerPermisos(?);");
        $query->execute(array($_COOKIE['idUser']));
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public static function obtenerPermiso($cnn,$permiso){
        $p = self::obtenerPermisos($cnn);
        foreach ($p as $key => $value) {
            if($key==$permiso){
                return $value;
            }
        }
    }

    public static function habilitarModulo($permiso,$modulo){
        if($permiso==0){
            return "";
        }elseif($permiso>=1 and $permiso<=4){
            return $modulo;
        }
    }

    public static function generarMenu($permisos){
        if($permisos['inventario']>0){
            echo self::habilitarModulo($permisos['inventario'],
            '<li class="nav-item"><a title="Inventario" class="nav-link btn-mg-1" href="inventario.php">Inventario</a></li>');
        }
        if($permisos['bodegas']>0){
            echo self::habilitarModulo($permisos['bodegas'],
            '<li class="nav-item"><a title="Bodegas" class="nav-link btn-mg-1" href="bodegas.php">Bodegas</a></li>');
        }
        echo self::habilitarModulo($permisos['catalogo'],
        '<li class="nav-item"><a title="Catalogo" class="nav-link btn-mg-1" href="catalogo.php">Catalogo</a></li>');
        echo self::habilitarModulo($permisos['cotizacion'],
        '<li class="nav-item"><a title="Cotizacion" class="nav-link btn-mg-1" href="cotizaciones.php">Cotizacion</a></li>');
        echo self::habilitarModulo($permisos['pedido'],
        '<li class="nav-item"><a title="Ordenes" class="nav-link btn-mg-1" href="ordenes.php">Ordenes</a></li>');
        if($permisos['clientes']>0 and $permisos['empleados']>0){
            $emp = self::habilitarModulo($permisos['empleados'],
            '<li class="nav-item"><a title="Empleados" class="nav-link btn-mg-1" href="empleados.php">Empleados</a></li>');
            $cli = self::habilitarModulo($permisos['clientes'],
            '<li class="nav-item"><a title="Clientes" class="nav-link btn-mg-1" href="clientes.php">Clientes</a></li>');
            $li =
            '<li class="nav-item dropdown">
                <a class="nav-link btn-mg-1 dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Usuarios
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                    '.$emp.'
                    '.$cli.'
                </ul>
            </li>';
            echo $li;
        }else{
            echo self::habilitarModulo($permisos['empleados'],
            '<li class="nav-item"><a title="Empleados" class="nav-link btn-mg-1" href="empleados.php">Cliente</a></li>');
            echo self::habilitarModulo($permisos['clientes'],
            '<li class="nav-item"><a title="Clientes" class="nav-link btn-mg-1" href="clientes.php">Empleados</a></li>');
        }
    }

    static function verf_perm($nivel,$permiso){
        if($nivel=="l"){
            return $permiso==1 ?true:false;
        }elseif ($nivel=="e") {
            return $permiso==2 ?true:false;
        }elseif ($nivel=="g") {
            return $permiso==3?true:false;
        }elseif($nivel=="adm"){
            return $permiso==4?true:false;
        }elseif($nivel=="an"){//anyway
            return ($permiso>=1 && $permiso<=4)?true:false;
        }else{
            return false;
        }
    }
}
?>