<?php
session_start();
if(!isset($_SESSION["id_anggota"]))
{
    header("Location: login.php?error=proses");
}
include_once("functions.php");
include_once("layout.php");
navanggota();
?>
<div class="album">
    <div class="py-2 my-4 mx-5 rounded-3 bg-danger bg-gradient shadow-sm">
            <h2 class="text-white text-center">DAFTAR MATERI</h2>
        </div>
        <form action="cari-materi.php" method="get">
            <div class="input-group my-4 mx-5 w-50">
                <input type="text" class="form-control" name="dicari"  placeholder="Search ..." aria-label="Search" autocomplete="off">
                <button type="submit" id="btncari" class="btn btn-primary">CARI</button>
                <!-- <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span> -->
            </div>
        </form>
    <div class="row row-cols-md-4 g-3 mb-5 mx-5">
<?php
if(isset($_GET["dicari"]))
{
    // var_dump($_POST);
    //     exit;
    
    $db = dbConnect();
    if($db->connect_errno==0)
    {
        $id_anggota = $_SESSION["id_anggota"];
        $dicari=$_GET["dicari"];
        $sql="SELECT m.*, m.nama AS namaMateri,p.id_paket,a.id_anggota,k.id_kelas,kt.nama AS namaKategori, mt.nama AS namaMentor FROM materi m 
                INNER JOIN kategori_materi kt ON m.id_kategori=kt.id_kategori
                INNER JOIN mentor mt ON m.id_mentor=mt.id_mentor
                INNER JOIN paket_belajar p ON p.id_kelas=m.id_kelas
                INNER JOIN kelas k ON k.id_kelas=m.id_kelas
                INNER JOIN anggota a ON a.id_paket=p.id_paket
                WHERE a.id_anggota = '$id_anggota' 
                AND m.nama LIKE '%$dicari%'";
        $res = $db->query($sql);
        if($res){
            if($res->num_rows>0){
                $data = $res->fetch_all(MYSQLI_ASSOC);
                foreach($data as $row)
                {
                    ?>
                    <div class="col" >
                        <div class="card shadow" style="width:270px">
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="0" role="img" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false">
                            <?php 
                            if($row["id_kategori"] == "KM001" || $row["id_kategori"] == "KM005") {
                                echo "<img width='100%' height='100%' src='../komponen/dist/img/bg1.jpg'></img>";
                            } else if($row["id_kategori"] == "KM002" || $row["id_kategori"] == "KM006") {
                                echo "<img width='100%' height='100%' src='../komponen/dist/img/bg2.jpg'></img>";
                            } else if($row["id_kategori"] == "KM003" || $row["id_kategori"] == "KM007") {
                                echo "<img width='100%' height='100%' src='../komponen/dist/img/bg3.jpg'></img>";
                            } else if($row["id_kategori"] == "KM004" || $row["id_kategori"] == "KM008") {
                                echo "<img width='100%' height='100%' src='../komponen/dist/img/bg4.jpg'></img>";
                            } else echo "<img width='100%' height='100%' src='../komponen/dist/img/bg5.jpg'></img>";
                            ?>
                            </svg>
                            <div class="card-body">
                                <form action="pembelajaran.php" method="post">
                                <!-- <p class="card-text text-muted mb-1"><?php echo $row["id_paket"] ?></p> -->
                                <p class="card-text text-muted mb-1">Kode Materi : <?php echo $row["id_materi"] ?></p>
                                <input type="hidden" class="card-text text-muted mb-1" name="id_materi" value="<?php echo $row["id_materi"] ?>" style="border:0;background:transparent" readonly>
                                <input type="text" class="card-title text-danger fw-bold fs-5" nama="namaMateri" value="<?php echo $row["namaMateri"] ?>" style="border:0;background:transparent" disabled>
                                <input type="text" class="card-text text-secondary fs-6" name="namaKategori" value="<?php echo $row["namaKategori"] ?> - <?php echo $row["namaMentor"] ?>" style="border:0;background:transparent" disabled>
                                <input type="hidden" class="card-text text-muted mb-1" name="id_mentor" value="<?php echo $row["id_mentor"] ?>" style="border:0;background:transparent">
                                <div class="mt-4 text-end">
                                    <button type="submit" name="btnBuka" class="btn btn-warning">Buka</button><!-- <a href="view-materi?id_materi=<?php echo $row["id_materi"] ?>" name="btnBuka" class="btn btn-warning">Buka</a> -->
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else
                echo "<h5>Data Tidak Ditemukan</h5>";
        } else 
            echo "error ".(DEVELOPMENT?":".$db->error:"");
    } else
		echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
} else
    header("Location: login.php?error=proses");
?>
    </div>
</div>
<?php footer(); ?>