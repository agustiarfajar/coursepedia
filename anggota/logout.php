<?php 
session_start();
if(!isset($_SESSION["id_anggota"])){
    header("Location: login.php?error=proses");
}
session_destroy();
header("Location: ../index.php");
?>