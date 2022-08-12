<?php include_once("functions.php");?>
<?php
session_start();
if(!isset($_SESSION["idAdmin"]))
{
	header("Location: ../login.php?error=4");
}
$db=dbConnect();
if($db->connect_errno==0){
	// Bersihkan data
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
		$id_paket  	=$db->escape_string($_POST["id_paket"]);
		$kelas		=$db->escape_string($_POST["id_kelas"]);
		$nama		=$db->escape_string($_POST["nama"]);
		$harga	   	=$db->escape_string($_POST["harga"]);
		// Susun query insert
		$sql="INSERT INTO paket_belajar
			VALUES('$id_paket','$kelas','$nama','$harga')";
		// Eksekusi query insert
		$res=$db->query($sql);
		if($res){
			if($db->affected_rows>0){ // jika ada penambahan data
				header("Location: admin-paketbelajar.php?success=1");
			}
		}
		else
			echo "Terjadi Kesalahan".(DEVELOPMENT?" : ".$db->error:"")."<br>";
			// header("Location: admin-paketbelajar.php?error=id");
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