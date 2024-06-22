<?php 
    include('conexxion.php');
?>

<html>
    <head>
        <title>GESTOR DE TAREAS</title>
        <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style6.css" />
    </head>
    
    <body>
        
        <div class="container">
            
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
            
            <div class="row">
                <div class="col-lg-3"></div>

                <div class="col-lg-6">
                <h1 class="text-center">APLICACION DE GESTION</h1>
        
                    <a class="btn-secondary" href="<?php echo SITEURL; ?>">INICIO</a>
                    <a class="btn-secondary" href="<?php echo SITEURL; ?>gestor-listas.php">Gestionar listas</a>
                    
                    
                    <h3>Añade una nueva lista</h3>
                    
                    <p>
                    
                    <?php 
                    
                        
                        if(isset($_SESSION['add_fail']))
                        {
                            echo $_SESSION['add_fail'];   
                            unset($_SESSION['add_fail']);
                        }
                    
                    ?>
                    
                    </p>

                    <form method="POST">
                        <div class="mb-3">
                          <label for="example" class="form-label">Nombre de la lista:</label>
                          <input type="text" name="nombre_lista" class="form-control" placeholder="Ejemplo:inlges" required="required" />
                        </div>

                        <div class="mb-3">
                          <label for="example" class="form-label">Descripcion de la lista:</label>
                          <textarea name="descripcion_lista" class="form-control" placeholder="Ejemplo: Ingles intermedio, tareas de la unidad 2"></textarea>
                        </div>
                        
                        <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['usuario_id'];//chato ?>">

                        <button type="submit" class="btn btn-primary btn-centrado" name="submit">Añadir</button>
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
        
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        
       
        $db_select = mysqli_select_db($conn, DB_NAME);
        //chato
        $id_usuario = $_SESSION['usuario_id'];

        $sql = "INSERT INTO listas SET 
            nombre_lista = '$nombre_lista',
            descripcion_lista = '$descripcion_lista',
            id_usuario = $id_usuario
        ";
 
        $res = mysqli_query($conn, $sql);
        
        if($res==true)
        {
            
            $_SESSION['add'] = "Lista agregada";
           
            header('location:'.SITEURL.'gestor-listas.php');
            
            
        }
        else
        {
            
            $_SESSION['add_fail'] = "No se pudo agregar la lista";
            
            header('location:'.SITEURL.'anadir-lista.php');
        }
        
    }

?>
