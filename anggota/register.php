<?php
    include_once("functions.php");
    include_once("layout.php");
    if(isset($_POST["btnRegister"])){
        // var_dump($_POST);
        // exit;
        $db=dbConnect();
        if($db->connect_errno==0){
            $idanggota=$db->escape_string($_POST["idanggota"]);
            $namaanggota=$db->escape_string($_POST["namaanggota"]);
            $jkanggota=$db->escape_string($_POST["jkanggota"]);
            $alamatanggota=$db->escape_string($_POST["alamatanggota"]);
            $notelpanggota=$db->escape_string($_POST["notelpanggota"]);
            $emailanggota=$db->escape_string($_POST["emailanggota"]);
            $useranggota=$db->escape_string($_POST["useranggota"]);
            $passanggota=$db->escape_string($_POST["passanggota"]);
            $idpaket=$db->escape_string($_POST["idpaket"]);
            $noinvoice=$db->escape_string($_POST["noinvoice"]);
            $total=$db->escape_string($_POST["total"]);
            $res1 = $db->query("SELECT COUNT(*) AS dupeuser FROM anggota WHERE username='$useranggota'");
            if($res1){
                $data = $res1->fetch_assoc();
                if($data["dupeuser"]>0){
                    header("Location: daftar.php?id_paket=$idpaket&error=username");
                } else {
                    $res2 = $db->query("INSERT INTO anggota (id_anggota,nama,jk,alamat,no_telp,id_paket,email,username,pass)
                                        VALUES ('$idanggota','$namaanggota','$jkanggota','$alamatanggota','$notelpanggota','$idpaket','$emailanggota','$useranggota',PASSWORD('$passanggota'))");
                    if($res2){
                        if($db->affected_rows>0){
                            $res3=$db->query("INSERT INTO tagihan (no_invoice,id_paket,id_anggota,tgl_pembayaran,total)
                                    VALUES ('$noinvoice','$idpaket','$idanggota',NOW(),'$total')");
                            if($res3)
                            {
                                if($db->affected_rows>0){
                                    header("Location: login.php");
                                }
                            } else
                                echo "Gagal ".(DEVELOPMENT?" : ".$db->error:"")."<br>";
                        }
                    } else
                        echo "Gagal ".(DEVELOPMENT?" : ".$db->error:"")."<br>";
                }
			} else
				echo "Gagal ".(DEVELOPMENT?" : ".$db->error:"")."<br>";
        } else
        header("Location: daftar.php?error=koneksi");
    } else
        header("Location: daftar.php?error=proses");
?>