<?php
    include_once("functions.php");
    include_once("layout.php");
    navdaftar();
?>

<!-- title -->
<div class="container py-2 text-white text-center">
    <h2 class="text-warning">Pendaftaran Anggota</h2>
    <p>Silahkan isi form dibawah ini</p>
</div>

<!-- form -->
<div class="container p-4 mb-5 rounded-3 shadow bg-light">
    <?php
    if(isset($_GET["error"]))
    {
        $error = $_GET["error"];
        if($error == "koneksi") {
            showError("Gagal koneksi database");
        } else if($error == "proses") {
            showError("Akses dilarang, wajib login!");
        } else if($error == "username") {
            showError("Username sudah digunakan");
        }
    }
    ?>
    <form action="register.php" method="post">
            <div class="row g-4">
                <!-- form kiri -->
                <div class="col-6">
                    <div class="m-3">
                        <div class="row g-3">
                            <input type="hidden" name="idanggota" value="<?php echo kodeOtomatisAnggota() ?>">
                            <!-- nama -->
                            <div class="col-12">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                    <input type="text" name="namaanggota" class="form-control" pattern="[A-Za-z\s']+" placeholder="Nama Lengkap" required="" autocomplete="off">
                                </div>
                                <div><span class="form-text">
                                Must not contain numbers, special characters, or emoji.
                                </span></div>
                            </div>
                            <!-- jenis kelamin -->
                            <div class="col-sm-12">
                                <label class="form-label fw-semibold">Jenis Kelamin</label>
                                <table><tr>
                                <td><div class="form-check">
                                    <input id="lk" name="jkanggota" type="radio" class="form-check-input" value="L" required="">
                                    <label class="form-check-label" for="lk">Laki-laki</label>&emsp;
                                </div></td><div class="w-50">
                                <td><div class="form-check">
                                    <input id="pr" name="jkanggota" type="radio" class="form-check-input" value="P" required="">
                                    <label class="form-check-label" for="pr">Perempuan</label>
                                </div></td>
                                </tr></table>
                            </div>
                            <!-- alamat -->
                            <div class="col-12">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span>
                                    <input type="text" name="alamatanggota" class="form-control" placeholder="Alamat" required="" autocomplete="off">
                                </div>
                            </div>
                            <!-- notelp -->
                            <div class="col-12">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                                    <input type="text" name="notelpanggota" maxlength="13" class="form-control" pattern="[0-9]+" placeholder="No. Telp/Handphone" required="" autocomplete="off">
                                </div>
                                <div><span class="form-text">
                                e.g 08XXXXXXXXXX
                                </span></div>
                            </div>
                            <!-- email -->
                            <div class="col-12">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                    <input type="email" name="emailanggota" class="form-control" placeholder="Email" required="" autocomplete="off">
                                </div>
                                <div><span class="form-text">
                                    name@example.com
                                </span></div>
                            </div>
                            <!-- username -->
                            <div class="col-12">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-at"></i></span>
                                    <input type="text" name="useranggota" class="form-control" minlength="8" maxlength="20" pattern="[A-Za-z0-9]+" placeholder="Username" required="" autocomplete="off">
                                </div>
                                <div><span class="form-text">
                                Must be 8-20 characters long and must not contain spaces, special characters, or emoji.
                                </span></div>
                            </div>
                            <!-- password -->
                            <div class="col-12">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                    <input type="password" name="passanggota" class="form-control" minlength="8" maxlength="20" pattern="[A-Za-z0-9]+" placeholder="Password" required="" autocomplete="off">
                                </div>
                                <div><span class="form-text">
                                Must be 8-20 characters long and must not contain spaces, special characters, or emoji.
                                </span></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- form kanan -->
                <div class="col-6">
                    <div class="p-4 shadow-sm rounded-3 m-3 bg-secondary bg-gradient bg-opacity-25">
                        <h4 class="mb-4 text-center">Rincian Pembayaran</h4>
                        <div class="row g-3 mb-4">
                            <?php
                            if(isset($_GET["id_paket"]))
                            {
                                $db = dbConnect();
                                $id_paket = $db->escape_string($_GET["id_paket"]);
                                $data = getPaket($id_paket);
                            }
                            ?>
                            <ul class="list-group">
                                <!-- no tagihan -->
                                <li class="list-group-item d-flex justify-content-between lh-sm">
                                    <h6 class="my-0">No. Tagihan</h6>
                                    <span class="text-end"><?php echo kodeOtomatisTagihan() ?></span>
                                    <input class="text-end" type="hidden" name="noinvoice" value="<?php echo kodeOtomatisTagihan() ?>" style="border:0" readonly>
                                </li>
                                <!-- get paket yg diambil -->
                                <li class="list-group-item d-flex justify-content-between lh-sm">
                                    <h6 class="my-0">Paket Belajar</h6>
                                    <input type="hidden" name="idpaket" value="<?php echo $data["id_paket"] ?>">
                                    <input class="text-end" type="text" style="border:0;width:300px" value="<?php echo $data["nama"] ?>" disabled>
                                    
                                </li>
                                <!-- harga -->
                                <li class="list-group-item d-flex justify-content-between lh-sm">
                                    <h6 class="my-0">Harga Paket</h6>
                                    <span class="text-end">Rp<?php echo number_format($data["harga"],0,',','.') ?></span>
                                    <input class="text-end" type="hidden" style="border:0" value="Rp<?php echo $data["harga"] ?>" readonly>
                                </li>
                            </ul>
                            <!-- total bayar -->
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between lh-sm">
                                    <h6 class="my-0">Total Bayar</h6>
                                    <span class="text-end text-primary">Rp<?php echo number_format($data["harga"],0,',','.') ?></span>
                                    <input class="text-end" type="hidden" name="total" style="border:0" value="<?php echo $data["harga"] ?>" readonly>
                                </li>
                            </ul>
                        </div>
                        <!-- btn bayar -->
                        <button type="submit" class="w-100 btn btn-success btn-lg" name="btnRegister">Bayar</button>
                    </div>
                </div>
            </div>
    </form>
</div>

<!-- footer -->
<?php footermain(); ?>