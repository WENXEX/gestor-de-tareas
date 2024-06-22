<?php 

    include('conexxion.php');
    
  
    if(isset($_GET['id_tarea']))
    {
        
        $id_tarea = $_GET['id_tarea'];
        
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

        $sql = "DELETE FROM tareas WHERE id_tarea=$id_tarea AND id_usuario={$_SESSION['usuario_id']}";
        
        $res = mysqli_query($conn, $sql);
        
        if($res==true)
        {
       
            $_SESSION['delete'] = "Tarea eliminada.";

            header('location:'.SITEURL);
        }
        else
        {
       
            $_SESSION['delete_fail'] = "No se pudo eliminar la tarea";
            
            header('location:'.SITEURL);
        }
        
    }
    else
    {
        header('location:'.SITEURL);
    }

?>