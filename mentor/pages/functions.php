<?php 
define("DEVELOPMENT", TRUE);
include_once("layout.php");
function dbConnect()
{
    $db = new mysqli("localhost","root","","coursepedia");
    return $db;
}

function showSuccess($success)
{   
    ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> Informasi</h5>
        <?php echo $success ?>
    </div>
<?php
}

function showWarning($msg)
{   
    ?>
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-exclamation"></i> Peringatan</h5>
        <?php echo $msg ?>
    </div>
<?php
}


function showError($message)
{   
    ?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-ban"></i> Error!</h5>
        <?php echo $message; ?>
    </div>
<?php
// script_section();
}

//DASHBOARD
function countKategori()
{
	$db = dbConnect();
	if($db->connect_errno == 0)
    {
        $res = $db->query("SELECT COUNT(*) as jml_kategori FROM kategori_materi");
        if($res)
        {
            $data = $res->fetch_assoc();
            $res->free();
            return $data;
        }
        else
            return FALSE;   
    }
    else
        return FALSE;
}

function countMateri()
{
	$db = dbConnect();
	if($db->connect_errno == 0)
    {
        $res = $db->query("SELECT COUNT(*) as jml_materi FROM materi");
        if($res)
        {
            $data = $res->fetch_assoc();
            $res->free();
            return $data;
        }
        else
            return FALSE;   
    }
    else
        return FALSE;
}


function kodeOtomatisMateri()
{
    $db = dbConnect();
	if($db->connect_errno == 0)
    {
        $sql = "SELECT MAX(id_materi) as kodeTerbesar FROM materi";
        $res = $db->query($sql);
        if($res)
        {
            if($res->num_rows>0)
            {
                $data = $res->fetch_assoc();
                $id_materi = $data['kodeTerbesar'];
                $urutan = (int) substr($id_materi, 1, 3);
                $urutan++;

                $huruf = "M";
                $id_materi = $huruf.sprintf("%03s", $urutan);
               
            } else 
            {
                $id_materi = "M001";
            }
        }
        return $id_materi;
    }
    else
        return FALSE;   
}
function kodeOtomatisKategori()
{
    $db = dbConnect();
	if($db->connect_errno == 0)
    {
        $sql = "SELECT MAX(id_kategori) as kodeTerbesar FROM kategori_materi";
        $res = $db->query($sql);
        if($res)
        {
            if($res->num_rows>0)
            {
                $data = $res->fetch_assoc();
                $id_kategori = $data['kodeTerbesar'];
                $urutan = (int) substr($id_kategori, 2, 3);
                $urutan++;

                $huruf = "KM";
                $id_kategori = $huruf.sprintf("%03s", $urutan);
               
            } else 
            {
                $id_kategori = "KM001";
            }
        }
        return $id_kategori;
    }
    else
        return FALSE;   
}
function getDataMateri($id)
{
    $db = dbConnect();
    if($db->connect_errno==0)
    {
        $sql = "SELECT * FROM materi WHERE id_materi = '$id'";
        $res = $db->query($sql);
        if($res)
        {
            if($res->num_rows>0)
            {
                $data = $res->fetch_assoc();
                $res->free();
                return $data;
            }
            else
                return FALSE;
        }
        else
            return FALSE;
    }
    else
        return FALSE;
}
function getDataKategori($id)
{
    $db = dbConnect();
    if($db->connect_errno==0)
    {
        $sql = "SELECT * FROM kategori_materi WHERE id_kategori = '$id'";
        $res = $db->query($sql);
        if($res)
        {
            if($res->num_rows>0)
            {
                $data = $res->fetch_assoc();
                $res->free();
                return $data;
            }
            else
                return FALSE;
        }
        else
            return FALSE;
    }
    else
        return FALSE;
}
function getListKategori(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT * 
						 FROM kategori_materi
						 ORDER BY id_kategori");
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}
function getListKelas(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT * 
						 FROM kelas
						 ORDER BY id_kelas");
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}
function getListMentor(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT * 
						 FROM mentor
						 ORDER BY id_mentor");
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}
?>