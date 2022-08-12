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
	if(!is_numeric($v_nama))
	{
		$pesansalah .= "Masukan nama kelas harus berupa angka.<br>";
	}
	
	if($pesansalah == "")
	{
		$id_kelas  	=$db->escape_string($_POST["id_kelas"]);
		$nama	=$db->escape_string($_POST["nama"]);
		// Susun query insert
		$sql="INSERT INTO kelas
			VALUES('$id_kelas','$nama')";
		// Eksekusi query insert
		$res=$db->query($sql);
		if($res){
			if($db->affected_rows>0){ // jika ada penambahan data
				header("Location: admin-kelas.php?success=1");
			}
		}
		else
			header("Location: admin-kelas.php?error=id");
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