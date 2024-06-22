<?php
    include('conexxion.php');
    
    
    if(isset($_GET['id_tarea']))
    {
        
        $id_tarea = $_GET['id_tarea'];
        
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

        $sql = "SELECT * FROM tareas WHERE id_tarea=$id_tarea AND id_usuario={$_SESSION['usuario_id']}";

        
        $res = mysqli_query($conn, $sql);
        
        if($res==true)
        {
            $row = mysqli_fetch_assoc($res);
            
            $nombre_tarea = $row['nombre_tarea'];
            $descripcion_tarea = $row['descripcion_tarea'];
            $id_lista = $row['id_lista'];
            $prioridad = $row['prioridad'];
            $limite = $row['limite'];
        }
    }
    else
    {
        
        header('location:'.SITEURL);
    }
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
                 <div class="col-lg-3"></div>
                 <div class="col-lg-6">
                 <h1 class="text-center">APLICACION DE GESTION</h1>
                 <p>
                     <a class="btn-secondary" href="<?php echo SITEURL; ?>">Home</a>
                 </p>
                 <h3>ACtualiza los datos de tu tarea</h3>
                 <p>
                     <?php
                         if(isset($_SESSION['update_fail']))
                         {
                             echo $_SESSION['update_fail'];
                             unset($_SESSION['update_fail']);
                         }
                     ?>
                 </p>
                 <main class="form">
                     <div class="formularios">
                         <form method="POST" action="">
                         <div class="mb-3">
                             <label for="example" class="form-label">Nombre de la tarea:</label>
                             <input type="text" name="nombre_tarea" class="form-control" value="<?php echo $nombre_tarea; ?>" required="required" />
                         </div>
                         <div class="mb-3">
                             <label for="exampleInputPassword1" class="form-label">Descripcion de la tarea</label>
                             <textarea name="descripcion_tarea" class="form-control">
                                 <?php echo $descripcion_tarea; ?>
                                 </textarea>
                         </div>
                         <div class="mb-3">
                             <label for="ascc" class="form-label">Lista:</label>
                             <select name="id_lista" class="form-select" id="">
                         <?php
                                         $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
                                         $db_select2 = mysqli_select_db($conn2, DB_NAME) or die(mysqli_error());
                                         $sql2 = "SELECT * FROM listas";
                                         $res2 = mysqli_query($conn2, $sql2);
                                         if($res2==true)
                                         {
                                             $count_rows2 = mysqli_num_rows($res2);
                                             if($count_rows2>0)
                                             {
                                                 while($row2=mysqli_fetch_assoc($res2))
                                                 {
                                                     $id_lista_db = $row2['id_lista'];
                                                     $nombre_lista = $row2['nombre_lista'];
                                                     ?>
                                                     <option <?php if($id_lista_db==$id_lista){echo "selected='selected'";} ?> value="<?php echo $id_lista_db; ?>"><?php echo $nombre_lista; ?></option>
                                                     <?php
                                                 }
                                             }
                                             else
                                             {
                                                 ?>
                                                 <option <?php if($id_lista=0){echo "selected='selected'";} ?> value="0">None</option>p
                                                 <?php
                                             }
                                         }
                                     ?>
                         </select>
                         </div>
                         <div class="mb-3">
                             <label for="example" class="form-label">Prioridad:</label>
                             <select name="prioridad" class="form-select" id="">
                             <option <?php if($prioridad=="Baja"){echo "selected='selected'";} ?> value="Baja">Baja</option>
                                     <option <?php if($prioridad=="Media"){echo "selected='selected'";} ?> value="Media">Media</option>
                                     <option <?php if($prioridad=="Alta"){echo "selected='selected'";} ?> value="Alta">Alta</option>
                             </select>
                         </div>
                         <div class="mb-3">
                             <label for="example" class="form-label">Fecha limite:</label>
                             <input type="date" name="limite" class="form-control" value="<?php echo $limite; ?>" />
                         </div>
                         <button type="submit" class="btn btn-primary  btn-centrado" name="submit">Confirmar</button>
                         </form>
                     </div>
                 </main>
                 </div>
                 <div class="col-lg-3"></div>
             </div>
                     </div>
         </div>

    </body>
</html>


<?php 

  
    if(isset($_POST['submit']))
    {
        
        $nombre_tarea = $_POST['nombre_tarea'];
        $descripcion_tarea = $_POST['descripcion_tarea'];
        $id_lista = $_POST['id_lista'];
        $prioridad = $_POST['prioridad'];
        $limite = $_POST['limite'];
        
        $conn3 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        
        $db_select3 = mysqli_select_db($conn3, DB_NAME) or die(mysqli_error());
        
        $sql3 = "UPDATE tareas SET 
        nombre_tarea = '$nombre_tarea',
        descripcion_tarea = '$descripcion_tarea',
        id_lista = '$id_lista',
        prioridad = '$prioridad',
        limite = '$limite'
        WHERE 
        id_tarea = $id_tarea
        ";
        
        $res3 = mysqli_query($conn3, $sql3);
        
        if($res3==true)
        {
  
            $_SESSION['update'] = "Tarea actualizada.";
            
            header('location:'.SITEURL);
        }
        else
        {
            
            $_SESSION['update_fail'] = "No se pudo actualizar tu tarea";
          
            header('location:'.SITEURL.'actualizar-tarea.php?id_tarea='.$id_tarea);
        }
        
        
    }

?>









































