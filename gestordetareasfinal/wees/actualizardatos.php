<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('conexxion.php');
$idSesion = $_SESSION['usuario_id'];
?>
<html >
<head>
    <title>GESTOR DE TAREAS</title>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style4.css" />
</head>
<body>
    <!-- Navbar -->
    <div class="conNav">
        <div class="navega">
            <?php if (isset($_SESSION['correo'])) { ?>
                <a href="index.php">Inicio</a>
                <a href="actualizardatos.php">Perfil</a>
                <a href="cerrar_sesion.php">Cerrar Sesion </a>
            <?php } else { ?>
                <a href="registrarse.php">Registrarse</a></li>
                <a href="login.php">Iniciar Sesion</a></li>
            <?php } ?>
        </div>
    </div>
    </div>

<!-- Profile Section -->
<div class="center-container">
    <div class="profile-info">
    <?php
    
            $sql = "SELECT * FROM usuarios WHERE id = :id";
            $query = $conexion->prepare($sql);
            $query->bindParam(':id', $idSesion, PDO::PARAM_INT);
    
            //echo "ID de usuario: " . $idSesion;
            $query->execute();
            $results = $query->fetchAll(PDO:: FETCH_ASSOC);
            //print_r($results);
            if($query->rowCount() > 0) {
                echo '<table>';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Foto</th>';
                echo '<th>Nombre</th>';
                echo '<th>Correo Electronico</th>';
                echo '</tr>';
                echo '</thead>';
                echo "<tbody>";
                foreach($results as $result) {
                    echo "<tr>";
                    echo '<td><img src="' . $result["foto_perfil"] . '" class="profile-img" alt="Foto de perfil"></td>';
                    echo "<td>".$result['nombre']."</td>";
                    echo "<td>".$result['email']."</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo '</table>';
            } else {
                echo "...";
            }
            ?>
    </div>
</div>


    <main class="form">
    <div class="formularios">
        <form method="post" action="procesar_actualizacion.php" enctype="multipart/form-data">
            <fieldset>
                <h2 style="text-align: center;">PUEDE ACTUALIZAR SUS DATOS SI ASI LO DESEA</h2>
            </fieldset>
            <fieldset>
                <label for="new-pic">Foto de perfil<input name="new-pic" type="file"
                        accept=".png, .jpg, .jpeg" /></label>
            </fieldset>
            <fieldset>
                 <li><label for="first-name">Nombre: <input id="first-name" name="first-name" type="text" required /></label></li>

                <li><label for="email">Correo Electronico: <input id="email" name="email" type="email" required /></label></li>
                <li><label for="new-password">Contraseña: <input id="new-password" name="new-password" type="password"required /></label></li>
            </fieldset>
            <fieldset>
                <button>Actulizar</button>
            </fieldset>
        </form>
    </div>
    </main>



</body>
</html>

