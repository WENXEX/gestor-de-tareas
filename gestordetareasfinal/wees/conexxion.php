<?php 
// PARA CONECTAR LA BASE DE DATOS
session_start();


define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'gestion_tareas');

define('SITEURL', '');
$conexion = new PDO("mysql:host=" . LOCALHOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>