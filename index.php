<?php
session_start();
include('C:/xampp/htdocs/mvc_calis/modelo/enlaces.php');
include("C:/xampp/htdocs/mvc_calis/modelo/conexion.php");
include("C:/xampp/htdocs/mvc_calis/modelo/modelo.php");
include ('C:/xampp/htdocs/mvc_calis/controlador/controlador.php');

Conexion::conectar();
$var = new Controlador(); //clase controlador
$var -> pagina(); //manda llamar llamar a pagina     
?>




