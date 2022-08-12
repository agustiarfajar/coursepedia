<?php 
include_once("functions.php");
session_start();
$db = dbConnect();
if($db->connect_errno==0)
{
    $id_kategori = $db->escape_string($_POST["id_kategori"]);

    $sql = "DELETE FROM kategori_materi WHERE id_kategori='$id_kategori'";
    $res = $db->query($sql);
    if($res)
    {
        if($db->affected_rows>0)
        {
            header("Location: mentor-kategori.php?success=3");
        }
    }
    else
    {
        $_SESSION["fk"] = "kategori ini sedang dipakai di tabel lain.";
        header("Location: mentor-kategori.php?error=fk");
    }
}
else
    echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
?>
