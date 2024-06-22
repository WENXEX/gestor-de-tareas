<?php 
    include('conexxion.php');
    if (!isset($_SESSION['correo'])) {
        header('location: ' . SITEURL . 'login.php');
        exit();
    }
    $id_lista_url = $_GET['id_lista'];
?>

<html>
    <head>
        <title>GESTOR DE TAREAS</title>
        <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style2.css" />
    </head>
    
    <body>
        <div>
        <nav class="menuLateral">
            <ul>
                <?php if (isset($_SESSION['correo'])) { ?>
                    <a href="index.php">Inicio</a>
                    <a href="actualizardatos.php">Perfil</a>
                    <a href="cerrar_sesion.php">Cerrar Sesion </a>
                <?php } else { ?>
                    <li> <a href="index.php">Foro</a></li>
            
                    <a href="registrarse.php">Registrarse</a></li>
                    <a href="login.php">Iniciar Sesion</a></li>
                <?php } ?>
            </ul>
            </nav>
            <div class="wrapper">
            
            <h1 class="text-center">APLICACION DE GESTION</h1>
            
            <!-- Menu  -->
            
            
            
            
            
            
                
                    <nav class="conNav">
                                <div class="navega">
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                        <a href="<?php echo SITEURL; ?>" style="text-decoration: none;"><button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><b>INICIO</b></button></a>
                                                        <?php
                                                            $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
                                                            $db_select2 = mysqli_select_db($conn2, DB_NAME) or die(mysqli_error());
                                                            $id_usuario_actual = $_SESSION['usuario_id'];
                                                            $sql2 = "SELECT * FROM listas WHERE id_usuario = $id_usuario_actual";
                                                            $res2 = mysqli_query($conn2, $sql2);
                                                            if($res2==true)
                                                            {
                                                                while($row2=mysqli_fetch_assoc($res2))
                                                                {
                                    $id_lista = $row2['id_lista'];
                                    $nombre_lista = $row2['nombre_lista'];
                                    ?>
                                    <a href="<?php echo SITEURL; ?>lista-tareas.php?id_lista=<?php echo $id_lista; ?>" style="text-decoration: none;"><button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><b><?php echo $nombre_lista; ?></b></button></a>
                                    <?php
                                                                }
                                                            }
                                                        ?>
                                                        <a href="<?php echo SITEURL; ?>gestor-listas.php" style="text-decoration: none;"><button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><b>Gestionar Listas</b></button></a>
                                    </div>
                                </div>
                    </nav>
                
                <!-- Menu  -->
            
            
            <div class="all-task">
            
                <div class="ana"><a href="<?php echo SITEURL; ?>anadir-tarea.php"><button class="btn btn-dark">Añadir tarea</button></a></div>
            
            
                <table class="tbl-full table table-condensed table-hover">
            
                    <tr>
                        <th>Indice</th>
                        <th>Tarea <a href="?id_lista=<?php echo $id_lista_url; ?>&order_by=nombre_tarea">(↑)</a></th>
                        <th>Prioridad <a href="?id_lista=<?php echo $id_lista_url; ?>&order_by=prioridad_valor">(↑)</a></th>
                        <th>Fecha límite <a href="?id_lista=<?php echo $id_lista_url; ?>&order_by=limite">(↑)</a></th>
                        <th>A/E</th>
                    </tr>
            
                    <?php
            
                        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
            
                        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
                        $sql = "SELECT * FROM tareas WHERE id_lista=$id_lista_url AND id_usuario={$_SESSION['usuario_id']}";
                        $id_usuario_actual = $_SESSION['usuario_id'];
            
                        $order_by = isset($_GET['order_by']) ? $_GET['order_by'] : 'id_tarea';
                        echo "Orden actual: " . $order_by;
            
                        $sql = "SELECT * FROM tareas WHERE id_lista=$id_lista_url AND id_usuario={$_SESSION['usuario_id']} ORDER BY $order_by";
            
            
                        $res = mysqli_query($conn, $sql);
            
                        if($res==true)
                        {
            
                            $count_rows = mysqli_num_rows($res);
                            $sn=1;
                            if($count_rows>0)
                            {
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $id_tarea = $row['id_tarea'];
                                    $nombre_tarea = $row['nombre_tarea'];
                                    $prioridad = $row['prioridad'];
                                    $limite = $row['limite'];
                                    ?>
            
                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td><?php echo $nombre_tarea; ?></td>
                                        <td><?php echo $prioridad; ?></td>
                                        <td><?php echo $limite; ?></td>
                                        <td>
                                        <a href="<?php echo SITEURL; ?>actualizar-tarea.php?id_tarea=<?php echo $id_tarea; ?>"><button class="btn btn-success btn-sm">Actializar</button></a>
                                        <a href="<?php echo SITEURL; ?>borrar-tarea.php?id_tarea=<?php echo $id_tarea; ?>"><button class="btn btn-danger btn-sm">Eliminar</button></a>
                                        </td>
                                    </tr>
            
                                    <?php
                                }
                            }
                            else
                            {
            
                                ?>
            
                                <tr>
                                    <td colspan="5">SIN TAREAS AÑADIDAS.</td>
                                </tr>
            
                                <?php
                            }
                        }
                    ?>
            
            
            
                </table>
            
            </div>
            
            </div>
        </div>
    </body>
    
</html>































