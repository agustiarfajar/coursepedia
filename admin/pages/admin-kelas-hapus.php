<?php 
include_once("functions.php");
session_start();
if(!isset($_SESSION["id_admin"]))
{
    header("Location: ../index.php?error=4");
}
$db = dbConnect();
if($db->connect_errno==0)
{
    $id_kelas = $db->escape_string($_POST["id_kelas"]);

    $sql = "DELETE FROM kelas WHERE id_kelas='$id_kelas'";
    $res = $db->query($sql);
    if($res)
    {
        if($db->affected_rows>0)
        {
            header("Location: admin-kelas.php?success=3");
        }
    }
    else
    {
        $_SESSION["fk"] = "kelas ini sedang dipakai di tabel lain.";
        header("Location:  admin-kelas.php?error=fk");
    }
}
else
    echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
?>
