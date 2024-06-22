<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['first-name'];
    $email = $_POST['email'];
    $contrasena = $_POST['new-password'];
    try {
        require 'conexxion.php';
        $consulta = $conexion->prepare("INSERT INTO usuarios (nombre, email, contrasena) 
                                        VALUES (:nombre, :email, :contrasena)");
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':email', $email);
        $consulta->bindParam(':contrasena', $contrasena);
        $consulta->execute();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conexion = null;
        header("Location: login.php");
        exit();
    } catch (PDOException $e) {
        echo "Error en la base de datos: " . $e->getMessage();
    }
}
?>