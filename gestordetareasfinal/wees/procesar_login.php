<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $contrasena = $_POST['new-password'];
    try {
        require 'conexxion.php';
        $consulta = $conexion->prepare("SELECT * FROM usuarios WHERE email = :email");
        $consulta->bindParam(':email', $email);
        $consulta->execute();
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

        if ($usuario && ($contrasena == $usuario['contrasena'])) {
            session_start();
            $_SESSION['correo'] = $usuario['email'];
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            header("Location: actualizardatos.php");
            exit();
        } else {
            echo "Usuario o contraseña incorrectos";
        }
        $conexion = null;
    } catch (PDOException $e) {
        echo "Error en la base de datos: " . $e->getMessage();
    }
}
?>