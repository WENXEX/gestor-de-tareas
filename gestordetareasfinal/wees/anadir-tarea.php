<?php 
    include('conexxion.php');
?>

<html>
    <head>
        <title>GESTOR DE TAREAS</title>
        <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style3.css" />
    </head>
    
    <body>
    
        <div class="wrapper">

        <div class="navcal">
            <nav>
            <ul>
                <?php if (isset($_SESSION['correo'])) { ?>
                    <a href="index.php">Inicio</a>
                    <a href="actualizardatos.php">Perfil</a>
                    <a href="cerrar_sesion.php">Cerrar Sesion </a>
                <?php } else { ?>
                    <a href="index.php">Inicio</a>
                    <a href="registrarse.php">Registrarse</a>
                    <a href="login.php">Iniciar Sesion</a>
                <?php } ?>
            </ul>
                </nav>
        </div>
        
        <div class="container">
            <div class="row">
            
                <div class="col-lg-2"></div>


            <div class="col-lg-8">

            <h1 class="text-center">APLICACION DE GESTION</h1>

                <a class="btn-secondary" href="<?php echo SITEURL; ?>">INICIO</a>

                <h3>AÑADE TU NUEVA TAREA</h3>

                <p>
                    <?php 
                    
                        if(isset($_SESSION['add_fail']))
                        {
                            echo $_SESSION['add_fail'];
                            unset($_SESSION['add_fail']);
                        }
                    
                    ?>
                </p>
               
                <main class="form">
                    <div class="formularios">
                        <form method="POST" action="">
                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label">Nombre de la tarea:</label>
                              <input type="text" name="nombre_tarea" class="form-control" placeholder="Ejemplo : Mañana entrega electronica" required="required" /></td>
                            </div>
                            <div class="mb-3">
                              <label for="exampleInputPassword1" class="form-label">Descripcion de la tarea:</label>
                              <textarea name="descripcion_tarea" class="form-control" placeholder="Ejemplo: llevar todas las practicas de la semana"></textarea>
                            </div>
                        
                            <div class="mb-3">
                                <label for="disabledSelect" class="form-label">Lista:</label>
                              <select name="id_lista" class="form-select" id="">
                                <?php
                        
                                $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
                        
                                $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
                                $id_usuario_actual = $_SESSION['usuario_id'];
                                $sql = "SELECT * FROM listas WHERE id_usuario = $id_usuario_actual";
                        
                                $res = mysqli_query($conn, $sql);
                        
                                if($res==true)
                                {
                        
                                    $count_rows = mysqli_num_rows($res);
                        
                                    if($count_rows>0)
                                    {
                        
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            $id_lista = $row['id_lista'];
                                            $nombre_lista = $row['nombre_lista'];
                                            ?>
                                            <option value="<?php echo $id_lista ?>"><?php echo $nombre_lista; ?></option>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        //Display None as option
                                        ?>
                                        <option value="0">Ninguna</option>p
                                        <?php
                                    }
                        
                                }
                            ?>
                              </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Prioridad:</label>
                                <select name="prioridad" class="form-select" id="">
                                    <option value="Baja">Baja</option>
                                    <option value="Media">Media</option>
                                    <option value="Alta">Alta</option>
                                </select>
                              </div>
                              <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Fecha limite:</label>
                                <input type="date" class="form-control" name="limite" />
                              </div>
                            <button type="submit" class="btn btn-secondary btn-centrado" name="submit">Agregar</button>
                        </form>
                    </div>
                </main>

            </div>

                <div class="col-lg-2"></div>
            
            
            </div>
        
        </div>
        
        </div>
    </body>
    
</html>


<?php 
if (isset($_SESSION['correo'])) {
    if (isset($_POST['submit'])) {
        // Procesar el formulario solo si se ha enviado
        $nombre_tarea = $_POST['nombre_tarea'];
        $descripcion_tarea = $_POST['descripcion_tarea'];
        $id_lista = $_POST['id_lista'];
        $prioridad = $_POST['prioridad'];
        $limite = $_POST['limite'];
        $id_usuario = $_SESSION['usuario_id'];

        $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        $db_select2 = mysqli_select_db($conn2, DB_NAME) or die(mysqli_error());

        $sql2 = "INSERT INTO tareas SET 
            nombre_tarea = '$nombre_tarea',
            descripcion_tarea = '$descripcion_tarea',
            id_lista = $id_lista,
            prioridad = '$prioridad',
            limite = '$limite',
            id_usuario = $id_usuario
        ";

        $res2 = mysqli_query($conn2, $sql2);

        if ($res2 == true) {
            $_SESSION['add'] = "Tarea agregada.";
            header('location:' . SITEURL);
            exit(); // para evitar redirecciónes cuando no te logeas
        } else {
            $_SESSION['add_fail'] = "No se pudo agregar la tarea";
            header('location:' . SITEURL . 'anadir-tarea.php');
            exit(); // lo mismo xd
        }
    }
    // Si no se ha enviado el formulario me manda al inicio
} else {
    header('location:' . SITEURL . 'index.php');
    exit(); // 
}
?>




































