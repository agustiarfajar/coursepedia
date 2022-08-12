<?php 
    include_once("functions.php"); 
    include_once("layout.php");
    session_start();
    if(!isset($_SESSION["id_anggota"])){
		header("Location: login.php?error=proses");
    }
    navanggota();
?>

<?php
if(isset($_GET["error"]))
{
    $error = $_GET["error"];
    if($error == "koneksi") {
        showError("Gagal Koneksi Database");
    } else if($error == "proses") {
        showError("Akses dilarang, wajib login!");
    }
}
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
    <div class="row row-cols-md-4 g-3 mb-5 mx-5" id="listmateri">
    <?php
        // KEBUTUHAN PAGINATION
        $batas = 16;
        $hal = isset($_GET["hal"])?(int)$_GET["hal"] : 1;
        $hal_awal = ($hal>1) ? ($hal * $batas) - $batas : 0;

        $previous = $hal - 1;
        $next = $hal + 1;
        // 
        $db = dbConnect();
        if($db->connect_errno==0) {
            $idanggota = $_SESSION["id_anggota"];
            // KEBUTUHAN PAGINATION
            $data = mysqli_query($db, "SELECT m.*, m.nama AS namaMateri,p.id_paket,a.id_anggota,k.id_kelas, kt.nama AS namaKategori, mt.nama AS namaMentor FROM materi m
            INNER JOIN kategori_materi kt ON m.id_kategori=kt.id_kategori
            INNER JOIN mentor mt ON m.id_mentor=mt.id_mentor
            INNER JOIN paket_belajar p ON p.id_kelas=m.id_kelas
            INNER JOIN kelas k ON k.id_kelas=m.id_kelas
            INNER JOIN anggota a ON a.id_paket=p.id_paket
            WHERE a.id_anggota='$idanggota'");
            $jumlah_data = mysqli_num_rows($data);
            $total_hal = ceil($jumlah_data / $batas);
            // 
            
            // if(!isset($_GET["cari"])){
                $sql = "SELECT m.*, m.nama AS namaMateri,p.id_paket,a.id_anggota,k.id_kelas, kt.nama AS namaKategori, mt.nama AS namaMentor FROM materi m
                        INNER JOIN kategori_materi kt ON m.id_kategori=kt.id_kategori
                        INNER JOIN mentor mt ON m.id_mentor=mt.id_mentor
                        INNER JOIN paket_belajar p ON p.id_kelas=m.id_kelas
                        INNER JOIN kelas k ON k.id_kelas=m.id_kelas
                        INNER JOIN anggota a ON a.id_paket=p.id_paket
                        WHERE a.id_anggota='$idanggota'
                        ORDER BY kt.id_kategori ASC
                        LIMIT $hal_awal, $batas";
            // } else {
            //     $cari = $_GET["cari"];
            //     $sql="SELECT m.*, m.nama AS namaMateri,p.id_paket,a.id_anggota,k.id_kelas,kt.nama AS namaKategori, mt.nama AS namaMentor FROM materi m 
            //             INNER JOIN kategori_materi kt ON m.id_kategori=k.id_kategori
            //             INNER JOIN mentor mt ON m.id_mentor=mt.id_mentor
            //             INNER JOIN paket_belajar p ON p.id_kelas=m.id_kelas
            //             INNER JOIN kelas k ON k.id_kelas=m.id_kelas
            //             INNER JOIN anggota a ON a.id_paket=p.id_paket
            //             WHERE  m.id_materi LIKE '%$cari%' OR m.nama LIKE '%$cari%' 
            //             OR kt.id_kategori LIKE '%$cari%' OR kt.nama like '%$cari%'
            //             OR mt.id_mentor LIKE '%$cari%' OR mt.nama like '%$cari%'";
            // }
            $res = $db->query($sql);
            if($res) {                       
                $data = $res->fetch_all(MYSQLI_ASSOC);
                $no = $hal_awal+1;
                foreach($data as $row) {
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
                } $res->free();
            }
        }
    ?>
    </div>
</div>
<center>
    <nav>
        <ul class="pagination_section">
            <li>
                <a <?php if($hal > 1){ echo "href='?hal=$previous'"; } ?>>Previous</a>
            </li>
            <?php 
            for($x=1;$x<=$total_hal;$x++)
            {
                $active = $x == $hal ? 'class="active"' : '';
                echo "<li><a {$active} href='?hal=$x'>".$x."</a> </li>"; 
            }
            ?>
            <li>
                <a <?php if($hal<$total_hal){ echo "href='?hal=$next'";} ?>>Next</a>
            </li>
        </ul>
    </nav>
</center>
<!-- footer -->
<?php footer(); ?>