

<?php 
       
        include('conexxion.php');
   
    
    if(isset($_GET['id_lista']))
    {
        
        $id_lista = $_GET['id_lista'];
        
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
        
        $sql = "DELETE FROM listas WHERE id_lista=$id_lista AND id_usuario = {$_SESSION['usuario_id']}";

        
        $res = mysqli_query($conn, $sql);
        
        if($res==true)
        {
            $_SESSION['delete'] = "Lista eliminada";
            
            header('location:'.SITEURL.'gestor-listas.php');
        }
        else
        {
           
            $_SESSION['delete_fail'] = "No se pudo eliminar la lista.";
            header('location:'.SITEURL.'gestor-listas.php');
        }
    }
    else
    {
        
        header('location:'.SITEURL.'gestor-listas.php');
    }
    

    
    
    
?>