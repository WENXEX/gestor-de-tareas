<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
echo "<h1 class='tit'>Página de registro</h1>";
include('conexxion.php');
?>
<html>
<head>
    <title>GESTOR DE TAREAS</title>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style7.css" />
</head>
<body>
    <div class="bar">
        <?php if (isset($_SESSION['correo'])) { ?>
            <a href="index.php">Inicio</a>
            <img src="avatar.png" alt="Avatar" style="height:23px;width:23px;">
            <a href="cerrar_sesion.php">Cerrar Sesion </a>
        <?php } else { ?>
            <a href="registrarse.php">Registrarse</a></li>
            <a href="login.php">Iniciar Sesion</a></li>
            <a class="btn-secondary" href="<?php echo SITEURL; ?>">INICIO</a>
        <?php } ?>
    </div>
    </div>
    <ul>
        <div class="formulario">
            <form method="post" action="procesar_registro.php">
                <fieldset>
                    <h2 style="text-align: center;">REGISTRESE PARA USAR SU GESTOR DE TAREAS</h2>
                </fieldset>
                <fieldset>
                    <label for="first-name">Nombre: <input id="first-name" name="first-name" type="text" required /></label>
                    <label for="email">Correo: <input id="email" name="email" type="email" required /></label>
                    <label for="new-password">Contraseña: <input id="new-password" name="new-password" type="password" required /></label>
                </fieldset>
                <fieldset>
                    <button>Registrarse</button>
                </fieldset>
            </form>
        </div>
    </ul>
</body>
</html>

