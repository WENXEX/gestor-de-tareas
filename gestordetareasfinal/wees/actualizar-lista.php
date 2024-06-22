<?php 
include('conexxion.php');

 if (isset($_SESSION['correo'])) {  
    if(isset($_GET['id_lista']))
    {
        $id_lista = $_GET['id_lista'];
        
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
        
        $sql = "SELECT * FROM listas WHERE id_lista=$id_lista AND id_usuario = {$_SESSION['usuario_id']}";

        
        $res = mysqli_query($conn, $sql);
        
        if($res==true)
        {
        
            $row = mysqli_fetch_assoc($res); 
            
           
            $nombre_lista = $row['nombre_lista'];
            $descripcion_lista = $row['descripcion_lista'];
        }
        else
        {
           
            header('location:'.SITEURL.'gestor-listas.php');
        }
    }
} else {
    header('location:' . SITEURL . 'gestor-listas.php');
}
?>


<html>

    <head>
        <title>GESTOR DE TAREAS</title>
        <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style2.css" />
    </head>
    
    <body>
        
        <div class="container">

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
    
            <div class="row">

                <div class="col-lg-3"></div>


                <div class="col-lg-6">

                <h1 class="text-center">APLICACION DE GESTION</h1>

                <a class="btn-secondary" href="<?php echo SITEURL; ?>">INICIO</a>
                <a class="btn-secondary" href="<?php echo SITEURL; ?>gestor-listas.php">Gestion de listas</a>

                <h3>Actualizar listas</h3>

                <p>
                <?php 
                    
                    if(isset($_SESSION['update_fail']))
                    {
                        echo $_SESSION['update_fail'];
                        unset($_SESSION['update_fail']);
                    }
                ?>
            </p>

                <form method="POST" action="">
                <div class="mb-3">
                    <label for="exampleLabel" class="form-label">Nombre de la lista</label>
                    <input type="text" name="nombre_lista" class="form-control" value="<?php echo $nombre_lista; ?>" required="required" />
                   
                </div>

                <div class="mb-3">
                    <label for="exampleDesc" class="form-label">Descripcion de la lista</label>
                    <textarea name="descripcion_lista" class="form-control">
                            <?php echo $descripcion_lista; ?>
                        </textarea>
                </div>

                

                <button type="submit" name="submit" class="btn btn-primary">Aceptar</button>
                </form>

                </div>


                <div class="col-lg-3"></div>

            </div>

        </div>
        
        
    
    </body>

</html>


<?php 

    if(isset($_POST['submit']))
    {
       
        $nombre_lista = $_POST['nombre_lista'];
        $descripcion_lista = $_POST['descripcion_lista'];
        
        $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        
        $db_select2 = mysqli_select_db($conn2, DB_NAME);
        
        $sql2 = "UPDATE listas SET 
            nombre_lista = '$nombre_lista',
            descripcion_lista = '$descripcion_lista' 
            WHERE id_lista=$id_lista AND id_usuario = {$_SESSION['usuario_id']}
        ";
        
        $res2 = mysqli_query($conn2, $sql2);
        
        if($res2==true)
        {
            $_SESSION['update'] = "Lista actualizada";
            
            header('location:'.SITEURL.'gestor-listas.php');
        }
        else
        {
            
            $_SESSION['update_fail'] = "No se pudo añadir la lista";
         
            header('location:'.SITEURL.'gestor-listas.php?id_lista='.$id_lista);
        }
        
    }
?>

