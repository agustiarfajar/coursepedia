<?php 
define("DEVELOPMENT", TRUE);

function dbConnect(){
  $db = new mysqli("localhost","root","","coursepedia");
  return $db;
}

function showSuccess($success)
{   
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <h6><i class="icon fas fa-check-circle"></i><?php echo $success ?></h6>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}

function showWarning($warning)
{   
    ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <h6><i class="icon fas fa-info-circle"></i><?php echo $warning ?></h6>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}

function showError($message)
{   
    ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h6><i class="icon fas fa-ban"></i><?php echo $message ?></h6>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
// script_section();
}

function countMateri()
{
  $db = dbConnect();
  if($db->connect_errno == 0){
    $sql = "SELECT COUNT(*) AS jml_materi FROM materi";
    $res = $db->query($sql);
    if($res){
      $data = $res->fetch_assoc();
      $res->free_result();
      return $data;
    } else {
      return false;
    }
  }  else {
    return false;
  }

}

function kodeOtomatisTagihan()
{
    $db = dbConnect();
  if($db->connect_errno == 0)
    {
        $sql = "SELECT MAX(no_invoice) as kodeTerbesar FROM tagihan";
        $res = $db->query($sql);
        if($res)
        {
            if($res->num_rows>0)
            {
                $data = $res->fetch_assoc();
                $no_invoice = $data['kodeTerbesar'];
                $urutan = (int) substr($no_invoice, 7, 4);
                $urutan++;

                $huruf = "INV/PB/";
                $no_invoice = $huruf.sprintf("%04s", $urutan);
              
            } else 
            {
                $no_invoice = "INV/PB/0001";
            }
        }
        return $no_invoice;
    }
    else
        return FALSE;   
}

function kodeOtomatisAnggota()
{
    $db = dbConnect();
  if($db->connect_errno == 0)
    {
        $sql = "SELECT MAX(id_anggota) as kodeTerbesar FROM anggota";
        $res = $db->query($sql);
        if($res)
        {
            if($res->num_rows>0)
            {
                $data = $res->fetch_assoc();
                $id_anggota = $data['kodeTerbesar'];
                $urutan = (int) substr($id_anggota, 2, 3);
                $urutan++;

                $huruf = "AG";
                $id_anggota = $huruf.sprintf("%03s", $urutan);
              
            } else 
            {
                $id_anggota = "AG001";
            }
        }
        return $id_anggota;
    }
    else
        return FALSE;   
}

function kodeOtomatisPembelajaran()
{
    $db = dbConnect();
  if($db->connect_errno == 0)
    {
        $sql = "SELECT MAX(id_pembelajaran) as kodeTerbesar FROM pembelajaran";
        $res = $db->query($sql);
        if($res)
        {
            if($res->num_rows>0)
            {
                $data = $res->fetch_assoc();
                $id_pembelajaran = $data['kodeTerbesar'];
                $urutan = (int) substr($id_pembelajaran, 3, 3);
                $urutan++;

                $huruf = "BJR";
                $id_pembelajaran = $huruf.sprintf("%03s", $urutan);
              
            } else 
            {
                $id_pembelajaran = "BJR001";
            }
        }
        return $id_pembelajaran;
    }
    else
        return FALSE;   
}

function getPaket($id_paket)
{
    $db = dbConnect();
    if($db->connect_errno==0)
    {
        $sql = "SELECT *,nama AS namaPaket FROM paket_belajar WHERE id_paket='$id_paket'";
        $res = $db->query($sql);
        if($res)
        {
            if($res->num_rows==1)
            {
                $data = $res->fetch_assoc();
                return $data;
                
            }
            else
                return FALSE;
            $res->free();
        }
        else 
            echo "Error ".(DEVELOPMENT?":".$db->error:"");
    }
    else
        header("Location: index.php?error=koneksi");
}

function getProfile($id_anggota)
{
    $db = dbConnect();
    if($db->connect_errno==0)
    {
        $sql = "SELECT a.*,k.nama AS namaKelas, p.nama AS namaPaket FROM anggota a 
                INNER JOIN paket_belajar p ON p.id_paket=a.id_paket 
                INNER JOIN kelas k ON k.id_kelas=p.id_kelas
                WHERE a.id_anggota='$id_anggota'";
        $res = $db->query($sql);
        if($res)
        {
            if($res->num_rows==1)
            {
                $data = $res->fetch_assoc();
                return $data;
                
            }
            else
                return FALSE;
            $res->free();
        }
        else 
            echo "Error ".(DEVELOPMENT?":".$db->error:"");
    }
    else
        header("Location: index.php?error=koneksi");
}

function getMateri($id_materi)
{
    $db = dbConnect();
    if($db->connect_errno==0)
    {
        $sql = "SELECT m.*,m.nama AS namaMateri,k.nama AS namaKategori,mt.nama AS namaMentor FROM materi m 
                    INNER JOIN kategori_materi k ON m.id_kategori=k.id_kategori
                    INNER JOIN mentor mt ON m.id_mentor=mt.id_mentor
                    WHERE m.id_materi='$id_materi'";
        // $sql = "SELECT m.*, m.nama AS namaMateri,p.id_paket,a.id_anggota,k.id_kelas, kt.nama AS namaKategori, mt.nama AS namaMentor,pb.* FROM materi m
        //         INNER JOIN kategori_materi kt ON m.id_kategori=kt.id_kategori
        //         INNER JOIN mentor mt ON m.id_mentor=mt.id_mentor
        //         INNER JOIN pembelajaran pb ON m.id_materi=pb.id_materi
        //         INNER JOIN paket_belajar p ON p.id_kelas=m.id_kelas
        //         INNER JOIN kelas k ON k.id_kelas=m.id_kelas
        //         INNER JOIN anggota a ON a.id_paket=p.id_paket
        //         WHERE a.id_anggota='$idanggota'
        //         ORDER BY m.id_materi ASC
        // ";
        $res = $db->query($sql);
        if($res)
        {
            if($res->num_rows==1)
            {
                $data = $res->fetch_assoc();
                return $data;
                
            }
            else
                return FALSE;
            $res->free();
        }
        else 
            echo "Error ".(DEVELOPMENT?":".$db->error:"");
    }
    else
        header("Location: index.php?error=koneksi");
}

function getPembelajaran()
{
    $db=dbConnect();
            if($db->connect_errno==0){
                $res=$db->query("SELECT * FROM pembelajaran ORDER BY id_pembelajaran");
                if($res){
                    $data=$res->fetch_all(MYSQLI_ASSOC);
                    return $data;
                    $res->free();
                }
                else
                    return FALSE; 
            }
            else
                return FALSE;
}

function getCariMateri($anggota, $materi)
{
    $db = dbConnect();
    if($db->connect_errno==0)
    {
        $res = $db->query("SELECT m.*, m.nama AS namaMateri,p.id_paket,a.id_anggota,k.id_kelas, kt.nama AS namaKategori, mt.nama AS namaMentor FROM materi m
        INNER JOIN kategori_materi kt ON m.id_kategori=kt.id_kategori
        INNER JOIN mentor mt ON m.id_mentor=mt.id_mentor
        INNER JOIN paket_belajar p ON p.id_kelas=m.id_kelas
        INNER JOIN kelas k ON k.id_kelas=m.id_kelas
        INNER JOIN anggota a ON a.id_paket=p.id_paket
        WHERE a.id_anggota='$idanggota'
        AND m.namaMateri LIKE '%$materi%'");
        if($res)
        {
            if($res->num_rows>0)
            {
                $data = $res->fetch_all(MYSQLI_ASSOC);
                return $data;
                header("Location:");
                $res->free();
            }
        }
        else 
            return FALSE;
    }
    else
        return FALSE;
}

?>