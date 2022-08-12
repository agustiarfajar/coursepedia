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
    $v_idpaket = trim($_POST["id_paket"]);
    $v_kelas = trim($_POST["id_kelas"]);
    $v_nama = trim($_POST["nama"]);
    $v_harga = trim($_POST["harga"]);
    
    if(strlen($v_idpaket) == 0)
    {
        $pesansalah .= "ID Paket tidak boleh kosong.<br>";
    }
    if(strlen($v_kelas) == 0)
    {
        $pesansalah .= "Kelas tidak boleh kosong.<br>";
    }
    if(strlen($v_nama) == 0)
    {
        $pesansalah .= "Nama Paket tidak boleh kosong.<br>";
    }
    if(strlen($v_harga) == 0)
    {
        $pesansalah .= "Harga tidak boleh kosong.<br>";
    }
    if(!is_numeric($v_harga)) {
        $pesansalah .= "Masukan harga harus berupa angka.<br>";
    }

    if($pesansalah == "")
    {
        $id_paket = $db->escape_string($_POST["id_paket"]);
        $nama = $db->escape_string($_POST["nama"]);
        $id_kelas = $db->escape_string($_POST["id_kelas"]);
        $harga = $db->escape_string($_POST["harga"]);

        $sql = "UPDATE paket_belajar SET 
                nama='$nama',
                id_kelas='$id_kelas',
                harga='$harga' 
                WHERE id_paket='$id_paket'";
        $res = $db->query($sql);
        if($res)
        {
            if($db->affected_rows>0)
            {
                header("Location: admin-paketbelajar.php?success=2");
            } else {
                header("Location: admin-paketbelajar.php?warning=perubahan");
            }
        }
        else
            echo "Error ".(DEVELOPMENT?":".$db->error:"");
    } 
    else 
    {
        $_SESSION["salahinputpaket"] = $pesansalah;
        header("Location: admin-paketbelajar.php?error=input");
    }
}
else
    echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
?>
