<?php include_once("functions.php");
include_once("layout.php");
session_start();
if(!isset($_SESSION["id_anggota"])){
    header("Location: login.php?error=proses");
}
navprofileedit();
?>

<div class="container py-2 bg-success bg-gradient rounded-3 my-4 text-center text-light">
    <h2>Edit Profile</h2>
</div>
<div class="container bg-secondary bg-opacity-10 rounded-3 shadow-sm p-4 mb-5">
    <form action="profile-update.php" method="post">
        <?php
        $db = dbConnect();
        $id_anggota = $_SESSION["id_anggota"];
        $data = getProfile($id_anggota);
        ?>
        <div class="row g-5">
            <!-- form kiri -->
            <div class="col">
                <!-- id anggota -->
                <div class="input-group mb-3">
                    <span class="input-group-text">ID Anggota</span>
                    <span class="form-control"><?php echo $data["id_anggota"] ?></span>
                    <input type="hidden" name="idanggota" class="form-control" value="<?php echo $data["id_anggota"] ?>">
                </div>
                <!-- id kelas -->
                <div class="input-group mb-3">
                    <span class="input-group-text">Kelas</span>
                    <span class="form-control"><?php echo $data["namaKelas"] ?></span>
                    <input type="hidden" name="idkelas" class="form-control" value="<?php echo $data["id_kelas"] ?>">
                </div>
                <!-- id paket -->
                <div class="input-group mb-3">
                    <span class="input-group-text">Paket Belajar</span>
                    <span class="form-control"><?php echo $data["namaPaket"] ?></span>
                    <input type="hidden" name="idpaket" class="form-control flex-fill" value="<?php echo $data["id_paket"] ?>">
                </div>
                <!-- email -->
                <div class="input-group mb-3">
                    <span class="input-group-text">Email</span>
                    <span class="form-control"><?php echo $data["email"] ?></span>
                    <input type="hidden" name="emailanggota" class="form-control" value="<?php echo $data["email"] ?>">
                </div>
                <!-- username -->
                <div class="input-group mb-3">
                    <span class="input-group-text">Username</span>
                    <span class="form-control"><?php echo $data["username"] ?></span>
                    <input type="hidden" name="useranggota" class="form-control" value="<?php echo $data["username"] ?>">
                </div>
                <!-- password -->
                <div class="input-group mb-3">
                    <span class="input-group-text">Password</span>
                    <span class="form-control"><?php echo $data["pass"] ?></span>
                    <input type="hidden" name="passanggota" class="form-control" value="<?php echo $data["pass"] ?>">
                </div>
            </div>
            <!-- end form kiri -->
            <!-- form kanan -->
            <div class="col">
                <!-- nama -->
                <div>
                    <div class="input-group">
                        <span class="input-group-text">Nama Lengkap</span>
                        <input type="text" name="namaanggota" class="form-control" pattern="[A-Za-z\s']+" maxlength="30" placeholder="Nama Lengkap" value="<?php echo $data["nama"] ?>">
                    </div>
                    <div><span class="form-text">
                    Must not contain numbers, special characters, or emoji.
                    </span></div>
                </div>
                <!-- jenis kelamin -->
                <div class="input-group mb-3 mt-3">
                    <span><strong>Jenis Kelamin :&emsp;</strong></span>
                    <?php
                        if($data["jk"] == "L"){
                            ?>
                            <div class="form-check">
                                <input id="lk" name="jkanggota" type="radio" class="form-check-input" value="<?php echo $data["jk"] ?>" required checked>
                                <label class="form-check-label" for="lk">Laki-laki</label>&emsp;
                            </div>
                            <div class="form-check">
                                <input id="pr" name="jkanggota" type="radio" class="form-check-input" required="">
                                <label class="form-check-label" for="pr">Perempuan</label>
                            </div>
                            <?php
                        }
                        if($data["jk"] == "P"){
                            ?>
                            <div class="form-check">
                                <input id="lk" name="jkanggota" type="radio" class="form-check-input" required>
                                <label class="form-check-label" for="lk">Laki-laki</label>&emsp;
                            </div>
                            <div class="form-check">
                                <input id="pr" name="jkanggota" type="radio" class="form-check-input" value="<?php echo $data["jk"] ?>" required checked>
                                <label class="form-check-label" for="pr">Perempuan</label>
                            </div>
                            <?php
                        }
                    ?>
                </div>
                <!-- alamat -->
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text">Alamat</span>
                        <input type="text" name="alamatanggota" class="form-control" placeholder="Alamat" value="<?php echo $data["alamat"] ?>" required>
                    </div>
                </div>
                <!-- no telp -->
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text">No. Telp</span>
                        <input type="text" name="notelpanggota" class="form-control" pattern="[0-9]+" minlength="11" maxlength="13" placeholder="No. Telp/Handphone" value="<?php echo $data["no_telp"] ?>" required>
                    </div>
                    <div><span class="form-text">
                    e.g 08XXXXXXXXXX with length 11-13 characters
                    </span></div>
                </div>
            </div>
            <!-- end form kanan -->
        </div>
        <div class="text-center mt-4 justify-content-between">
            <button type="submit" class="btn btn-lg btn-primary" name="btnUpdate" tyle="width:100px">Simpan</button>&emsp;
            <input type="reset" class="btn btn-lg btn-warning" style="width:100px">&emsp;
            <a href="profile.php" class="btn btn-lg btn-danger" style="width:100px">Batal</a>
        </div>
    </form>
</div>

<?php footer(); ?>