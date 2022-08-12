<?php
include_once("functions.php");
session_start();
if(!isset($_SESSION["id_anggota"])) {
    header("Location: login.php?error=proses");
}
if(isset($_POST["btnBuka"])){
    $db = dbConnect();
    if($db->connect_errno==0)
    {
        // var_dump($_POST);
        // exit;
        $id = kodeOtomatisPembelajaran();
        $idmateri = $db->escape_string($_POST["id_materi"]);
        $idmentor = $db->escape_string($_POST["id_mentor"]);
        $idanggota = $_SESSION["id_anggota"];
        $sql1 = "SELECT COUNT(*) AS akses FROM pembelajaran WHERE id_anggota='$idanggota' AND id_materi='$idmateri'";
        $res1=$db->query($sql1);
        if($res1){
            $data = $res1->fetch_assoc();
            if($data["akses"]>0){
                header("Location: view-materi.php?id_materi=$idmateri");
            } else {
                $sql2 = "INSERT INTO pembelajaran (id_pembelajaran,id_anggota,id_mentor,id_materi,status,tgl_akses) 
                        VALUES('$id','$idanggota','$idmentor','$idmateri','Sudah Mengakses',NOW())";
                $res = $db->query($sql2);
                if($res)
                {
                    if($db->affected_rows>0)
                    {
                        header("Location: view-materi.php?id_materi=$idmateri");
                    }
                }
                else
                    echo "Error: ".(DEVELOPMENT?":".$db->error:"");
            }
        }
        
    }
    else 
        header("Location: index-anggota.php?error=koneksi");
}
?>