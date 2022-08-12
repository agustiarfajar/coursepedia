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
    $pesansalah = "";
    $v_id = trim($_POST["id_kelas"]);
    $v_nama = trim($_POST["nama"]);
    
    if(strlen($v_id) == 0)
    {
        $pesansalah .= "ID Kelas tidak boleh kosong.<br>";
    }
    if(strlen($v_nama) == 0)
    {
        $pesansalah .= "Nama Kelas tidak boleh kosong.<br>";
    }

    if($pesansalah == "")
    {
        $id_kelas = $db->escape_string($_POST["id_kelas"]);
        $nama = $db->escape_string($_POST["nama"]);

        $sql = "UPDATE kelas SET nama='$nama' WHERE id_kelas='$id_kelas'";
        $res = $db->query($sql);
        if($res)
        {
            if($db->affected_rows>0)
            {
                header("Location: admin-kelas.php?success=2");
            } else {
                header("Location: admin-kelas.php?warning=perubahan");
            }
        }
        else
            return FALSE;
    }
    else 
    {
        $_SESSION["salahinputkelas"] = $pesansalah;
        header("Location: admin-kelas.php?error=input");
    }           
}
else
    echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
?>
