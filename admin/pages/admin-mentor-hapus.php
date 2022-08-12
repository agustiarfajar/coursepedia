<?php 
    session_start();
    if(!isset($_SESSION["id_admin"])){
        header("Location: ../index.php?error=4");
    }

    include_once("functions.php");
    include_once("layout.php");
    
    $id = $_POST['id_mentor'];
    $db = dbConnect();
    
    if ($id) {
        $sql = "SELECT * FROM mentor WHERE id_mentor = '$id'";
        $conn = $db->query($sql);
        if (!mysqli_num_rows($conn) > 0) {
            header("Location: admin-mentor.php");    
        }
        
        $delete = "DELETE FROM mentor WHERE id_mentor = '$id'";
        $sqlDelete = $db->query($delete);

        if ($sqlDelete) {
            header("Location: admin-mentor.php?success=3");
        }else{
            header("Location: admin-mentor.php?error=proses");
        }
        
    }else{
        header("Location: admin-mentor.php?error=proses");
    }

?>