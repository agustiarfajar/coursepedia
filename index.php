<?php include_once("anggota/functions.php"); ?>
<?php include_once("anggota/layout.php"); ?>
<?php navmainindex(); ?>

<!-- desc -->
<div class="p-5 bg-gradient" style="background:#990033">
    <div class="row flex-lg-row-reverse align-items-center g-5">
        <div class="col-10 col-sm-8 col-lg-5">
            <img src="komponen/assets/main-bg.png" class="d-block mx-lg-auto img-fluid" loading="lazy">
        </div>
        <div class="col-lg-7">
            <h1 class="display-5 fw-bold text-white">Dear, Coursepedian !</h1>
            <p class="col-md-10 fs-4 text-white">Raih impianmu dengan belajar lebih menyenangkan dan interaktif bersama Coursepedia</p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <h4 class="fw-bold" style="color:#F0E68C">Ayo daftar sekarang !</h4>
            </div>
        </div>
    </div>
</div>
<div class="bg-light p-3"></div>

<!-- paket belajar -->
<div class="pricing-header px-5 py-4 mx-auto text-center">
    <h1 class="display-6 fw-normal text-white">Paket Belajar</h1>
    <p class="fs-5 mb-4 text-white">Silahkan pilih paket belajar yang kamu mau</p>
    <div class="row row-cols-1 row-cols-md-3 py-4 px-3 rounded-3 mb-4 text-center bg-light">
    <?php 
        $db = dbConnect();
        if($db->connect_errno==0) {
            $sql = "SELECT * FROM paket_belajar";
            $res = $db->query($sql);
            if($res) {
                $data_paket = $res->fetch_all(MYSQLI_ASSOC);
                foreach($data_paket as $row) {
                    ?>
                    <div class="col mb-4">
                        <div class="card rounded-3 shadow">
                            <!-- <form action="daftar.php" method="post"> -->
                                <div class="card-header py-3 bg-gradient" style="background:#D2691E;color:white">
                                    <input type="text" name="nama" value="<?php echo $row["nama"] ?>" style="border:0;background:transparent;color:white;font-size:larger;width:320px" disabled>
                                    <!-- <h5 class="my-0 fw-normal" name="nama"></h5> -->
                                </div>
                                <div class="card-body">
                                    <input type="text" name="harga" value="Rp. <?php echo number_format($row["harga"],0,',','.') ?>" style="border:0;background:transparent;color:#D2691E;font-size:x-large;width:130px" disabled>
                                    <span class="fw-light" style="color:#D2691E;font-size:x-large">/tahun</span>
                                    <!-- <h3 class="card-title pricing-card-title" style="color:#D2691E" name="harga">Rp. <small class="fw-light">/tahun</small></h3> -->
                                    <ul class="list-unstyled mt-3 mb-4">
                                        <li>Akses semua materi</li>
                                        <li>Free video pembelajaran</li>
                                    </ul>
                                    <a href="anggota/daftar.php?id_paket=<?php echo $row["id_paket"] ?>" type="submit" class="w-100 btn btn-lg btn-outline-primary" name="pilihpaket">Pilih Paket</a>
                                </div>
                            <!-- </form> -->
                        </div>
                    </div>
                    <?php
                } $res->free();
            }
        }
        ?>
    </div>
</div>

<?php footermain(); ?>