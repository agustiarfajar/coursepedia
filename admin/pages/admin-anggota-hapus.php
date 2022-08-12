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
    $id_anggota = $db->escape_string($_POST["id_anggota"]);

    $cek_pembelajaran = $db->query("SELECT COUNT(*) as jml_pbl FROM pembelajaran WHERE id_anggota = '$id_anggota'");
    $data = $cek_pembelajaran->fetch_assoc();
    if($data["jml_pbl"] == 0)
    {
        $restagihan = $db->query("DELETE FROM tagihan WHERE id_anggota='$id_anggota'");
        if($restagihan)
        {
            if($db->affected_rows>0)
            {
                $res = $db->query("DELETE FROM anggota WHERE id_anggota='$id_anggota'");
                if($res)
                {
                    if($db->affected_rows>0)
                    {
                        header("Location: admin-anggota.php?success=3");
                    }
                }
                else
                {
                    $_SESSION["fk"] = "anggota ini sedang dipakai di tabel lain.";
                    header("Location:  admin-anggota.php?error=fk");
                }   
            }
        }
    } else {
        $restagihan = $db->query("DELETE FROM tagihan WHERE id_anggota='$id_anggota'");
        if($restagihan)
        {
            if($db->affected_rows>0)
            {
                $resbelajar = $db->query("DELETE FROM pembelajaran WHERE id_anggota='$id_anggota'");
                if($resbelajar)
                {
                    if($db->affected_rows>0)
                    {
                        $res = $db->query("DELETE FROM anggota WHERE id_anggota='$id_anggota'");
                        if($res)
                        {
                            if($db->affected_rows>0)
                            {
                                header("Location: admin-anggota.php?success=3");
                            }
                        }
                        else
                        {
                            $_SESSION["fk"] = "anggota ini sedang dipakai di tabel lain.";
                            header("Location:  admin-anggota.php?error=fk");
                        }
                    }
                }
            }
        }
    }
}
else
    echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
?>