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
    $id_paket = $db->escape_string($_POST["id_paket"]);

    $sql = "DELETE FROM paket_belajar WHERE id_paket='$id_paket'";
    $res = $db->query($sql);
    if($res)
    {
        if($db->affected_rows>0)
        {
            header("Location: admin-paketbelajar.php?success=3");
        }
    }
    else
    {
        $_SESSION["fk"] = "paket belajar ini sedang digunakan di tabel lain.";
        header("Location: admin-paketbelajar.php?error=fk");
    }
}
else
    echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
?>
