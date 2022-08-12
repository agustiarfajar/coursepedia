<?php 
include_once("functions.php");
session_start();
if(!isset($_SESSION["id_admin"]))
{
    header("Location: ../index.php?error=4");
}
$id = $_POST['id_mentor'];
$db = dbConnect();

if ($id) {
    $sql = "SELECT * FROM mentor WHERE id_mentor = '$id'";
    $conn = $db->query($sql);
    if (!mysqli_num_rows($conn) > 0) {
        header("Location: admin-mentor.php");    
    }
}else{
    header("Location: admin-mentor.php");
}
$assoc = $conn->fetch_assoc();

$nama = $db->escape_string($_POST['nama_mentor']);
    $jk = $db->escape_string($_POST['jk']);
    $alamat = $db->escape_string($_POST['alamat']);
    $no_telp = $db->escape_string($_POST['no_hp']);
    $username = $db->escape_string($_POST['username']);
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";
    // exit();


    $sqlUpdate = "UPDATE mentor SET
                    nama = '$nama',
                    jk = '$jk',
                    alamat = '$alamat',
                    no_telp = '$no_telp',
                    username = '$username'
                WHERE id_mentor = '$id'";
    $dbUpdate = $db->query($sqlUpdate);

    if($dbUpdate){
        if($db->affected_rows>0)
        {
            header("Location: admin-mentor.php?success=1");
        } else 
        {
            header("Location: admin-mentor.php?warning=perubahan");
        }
    }else{
        header("Location: admin-mentor.php?error=proses");
    }
?>
