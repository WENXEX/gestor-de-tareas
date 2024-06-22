<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
if (!isset($_SESSION['correo'])) {
    header('Location: login.php');
} else {
    $id_usuario = $_SESSION['usuario_id'];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {


        try {
            require 'conexxion.php';
            $actualizaciones = [];
            if (!empty($_POST['first-name'])) {
                $actualizaciones[] = "nombre = :nombre";
            }
            if (!empty($_POST['email'])) {
                $actualizaciones[] = "email = :email";
            }
            if (!empty($_POST['new-password'])) {
                $actualizaciones[] = "contrasena = :contrasena";
            }
            if ($_FILES['new-pic']['error'] == 0) {
                $ruta_destino = "foto_usuario/" . basename($_FILES['new-pic']['name']);
                move_uploaded_file($_FILES['new-pic']['tmp_name'], $ruta_destino);
                $actualizaciones[] = "foto_perfil = :ruta_foto";
            }

            if (move_uploaded_file($_FILES['new-pic']['tmp_name'], $ruta_destino)) {
                echo "¡Archivo cargado con éxito!";
            } else {
                echo "Error al cargar el archivo: " . $_FILES['new-pic']['error'];
            }

            if (!empty($actualizaciones)) {
                $consulta_sql = "UPDATE usuarios SET " . implode(', ', $actualizaciones) . " WHERE id = :id_usuario";
                $consulta = $conexion->prepare($consulta_sql);

                if (!empty($_POST['first-name'])) {
                    $consulta->bindParam(':nombre', $_POST['first-name']);
                }
                if (!empty($_POST['email'])) {
                    $consulta->bindParam(':email', $_POST['email']);
                }
                if (!empty($_POST['new-password'])) {
                    $consulta->bindParam(':contrasena', $_POST['new-password']);
                }
                if (!empty($ruta_destino)) {
                    $consulta->bindParam(':ruta_foto', $ruta_destino);
                }
                $consulta->bindParam(':id_usuario', $id_usuario);
                $consulta->execute();
            }
            $conexion = null;
            header("Location: index.php");
            exit();
        } catch (PDOException $e) {
            echo "Error en la base de datos: " . $e->getMessage();
        }
    }
}
?>