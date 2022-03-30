<?php
class dB{
    function __construct() {

    }
    // public static function getConnect()
    // {
    //     $conexion = new PDO("mysql:host=localhost;dbname=hitogrupal", 'root', '');
    //     //$conexion=new PDO('pgsql:host=localhost;port=5432;dbname=mvc','postgres','curso');
    //     return $conexion;
    // }
    public static function getConnect()
    {
        $conexion = new PDO("sqlite:hitogrupal.db");
        //$conexion=new PDO('pgsql:host=localhost;port=5432;dbname=mvc','postgres','curso');
        return $conexion;
    }
}