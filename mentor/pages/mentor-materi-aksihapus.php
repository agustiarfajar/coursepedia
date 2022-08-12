<?php 
include_once("functions.php");
session_start();
$db = dbConnect();
if($db->connect_errno==0)
{
    $id_materi = $db->escape_string($_POST["id_materi"]);

    $sql = "DELETE FROM materi WHERE id_materi='$id_materi'";
    $res = $db->query($sql);
    if($res)
    {
        if($db->affected_rows>0)
        {
            header("Location: mentor-materi.php?success=3");
        }
    }
    else
    {
        $_SESSION["fk"] = "materi ini sedang dipakai di tabel lain.";
        header("Location: mentor-materi.php?error=fk");
    }
}
else
    echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
?>
