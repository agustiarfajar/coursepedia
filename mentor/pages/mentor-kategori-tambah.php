<?php 
include_once("functions.php");
session_start();
$db = dbConnect();
if($db->connect_errno==0)
{
    $id_kategori = $db->escape_string($_POST["id_kategori"]);
    $nama = $db->escape_string($_POST["nama"]);

    $sql = "INSERT INTO kategori_materi(id_kategori,nama)
    VALUES('$id_kategori','$nama')";
    $res = $db->query($sql);
    if($res)
    {
        if($db->affected_rows>0)
        {
            header("Location: mentor-kategori.php?success=1");
        }
    }
    else
        return FALSE;
}
else
    echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
?>
