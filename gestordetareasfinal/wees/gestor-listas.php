<?php 

include('conexxion.php');

?>

<html>
    <head>
        <title>GESTOR DE TAREAS</title>
        <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style5.css" />
    </head>
    
    <body>
        
        <div class="wrapper">
        
        <h1 class="text-center">APLICACION DE GESTION</h1>
        
        
        <!-- Menu  -->
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


    <nav class="conNav">
        <div class="navega">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a href="<?php echo SITEURL; ?>" style="text-decoration: none;"><button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><b>INICIO</b></button></a>
            
                <?php
            
            
                    $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
                    $db_select2 = mysqli_select_db($conn2, DB_NAME) or die(mysqli_error());
                    $id_usuario_activo = $_SESSION['usuario_id'];
                    $sql2 = "SELECT * FROM listas WHERE id_usuario = $id_usuario_activo";
            
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
        
        <p>
            <?php 
            
             
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                
                
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }

                if(isset($_SESSION['delete_fail']))
                {
                    echo $_SESSION['delete_fail'];
                    unset($_SESSION['delete_fail']);
                }
            
            ?>
        </p>
        
        <!-- Tabla de listas -->
        <div class="listas">
            <div class="all-lists">
            
                <a href="<?php echo SITEURL; ?>anadir-lista.php"> <button class="btn btn-dark">Añadir lista</button></a>
            
                <table class="tbl-half table table-condensed table-hover">
                    <tr>
                        <th>Indice</th>
                        <th>Nombre de la lista</th>
                        <th>A/E</th>
                    </tr>
            
            
                    <?php
            
                        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
            
                        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
                        $id_usuario = $_SESSION['usuario_id'];//chato
                        $sql = "SELECT * FROM listas WHERE id_usuario = $id_usuario";//chato
            
            
            
                        $res = mysqli_query($conn, $sql);
            
                        if($res==true)
                        {
            
                            $count_rows = mysqli_num_rows($res);
            
                            $sn = 1;
            
                            if($count_rows>0)
                            {
            
            
                                while($row=mysqli_fetch_assoc($res))
                                {
            
                                    $id_lista = $row['id_lista'];
                                    $nombre_lista = $row['nombre_lista'];
                                    ?>
            
                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td><?php echo $nombre_lista; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>actualizar-lista.php?id_lista=<?php echo $id_lista; ?>"><button class="btn btn-success btn-sm">Actualizar</button></a>
                                            <a href="<?php echo SITEURL; ?>borrar-lista.php?id_lista=<?php echo $id_lista; ?>"><button class="btn btn-danger btn-sm">Eliminar</button></a>
                                        </td>
                                    </tr>
            
                                    <?php
            
                                }
            
            
                            }
                            else
                            {
            
                                ?>
            
                                <tr>
                                    <td colspan="3">Sin listas.</td>
                                </tr>
            
                                <?php
                            }
                        }
            
                    ?>
            
            
                </table>
            </div>
        </div>
        <!-- Tabla de listas-->
        </div>
    </body>
</html>