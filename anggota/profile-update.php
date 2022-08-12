<?php
include_once("functions.php");
session_start();
if(!isset($_SESSION["id_anggota"]))
{
    header("Location: login.php?error=proses");
}
if(isset($_POST["btnUpdate"]))
{
    // var_dump($_POST);
    //     exit;
    $db = dbConnect();
    if($db->connect_errno==0)
    {
        $idanggota=$db->escape_string($_POST["idanggota"]);
        $namaanggota=$db->escape_string($_POST["namaanggota"]);
        $jkanggota=$db->escape_string($_POST["jkanggota"]);
        $alamatanggota=$db->escape_string($_POST["alamatanggota"]);
        $notelpanggota=$db->escape_string($_POST["notelpanggota"]);
        $emailanggota=$db->escape_string($_POST["emailanggota"]);
        $useranggota=$db->escape_string($_POST["useranggota"]);
        $passanggota=$db->escape_string($_POST["passanggota"]);
        $idpaket=$db->escape_string($_POST["idpaket"]);
        $res = $db->query("UPDATE anggota SET id_anggota='$idanggota',nama='$namaanggota',jk='$jkanggota',
                            alamat='$alamatanggota',no_telp='$notelpanggota',id_paket='$idpaket',email='$emailanggota',
                            username='$useranggota',pass='$passanggota' WHERE id_anggota='$idanggota'");
        if($res){
            if($db->affected_rows>0){
                $_SESSION["nama"] = $namaanggota;
                header("Location: profile.php?success=2");
            } else
                header("Location: profile.php?warning=perubahan");
        } else 
            echo "error";
    } else
		echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
} else
    header("Location: login.php?error=proses");
?>