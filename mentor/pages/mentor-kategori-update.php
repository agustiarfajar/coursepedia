<?php 
include_once("functions.php");
session_start();
$db = dbConnect();
if($db->connect_errno==0)
{
    $id_kategori = $db->escape_string($_POST["id_kategori"]);
    $nama = $db->escape_string($_POST["nama"]);

    $sql = "UPDATE kategori_materi SET id_kategori='$id_kategori',nama='$nama' WHERE id_kategori='$id_kategori'";
    $res = $db->query($sql);
    if($res)
    {
        if($db->affected_rows>0)
        {
            header("Location: mentor-kategori.php?success=2");
        } else {
            header("Location: mentor-kategori.php?warning=perubahan");
        }
    }
    else
        return FALSE;
}
else
    echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
?>
