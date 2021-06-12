<?php
    include_once('../Backend/class/class-login.php');
    include_once('../Backend/class/class-conexion.php');
    $bd = new Conexion();
    $cnn = $bd->getConexion();
    if(!Login::validarLogin($cnn)){
        header('location: login.php');
    }
?>