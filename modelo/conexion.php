<?php

class Conexion
{
    static public function conectar()
    {
        try {
            $link = new PDO("mysql:host=localhost;dbname=mvc2;charset=utf8", "root", "");
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $link;
        } catch (PDOException $e) {
            die("Error al conectar: " . $e->getMessage());
        }
    }
}
?>
