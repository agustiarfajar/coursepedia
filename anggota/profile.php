<?php include_once("functions.php");
include_once("layout.php");
session_start();
if(!isset($_SESSION["id_anggota"])){
    header("Location: login.php?error=proses");
}
navprofile();
?>


<div class="container w-50 py-2 bg-danger bg-gradient rounded-3 my-4 text-center text-light">
    <h2>View Profile</h2>
</div>
<div class="container w-50 bg-secondary bg-opacity-10 rounded-3 shadow-sm p-4 mb-5">
    <?php
    if(isset($_GET["error"])) {
        $error = $_GET["error"];
        if($error == "proses") {
            showError("Akses dilarang, wajib login!");
        }
    }
    if(isset($_GET["warning"])) {
        $warning = $_GET["warning"];
        if($warning == "perubahan") {
            showWarning("Tidak ada perubahan data");
        }
    }
    if(isset($_GET["success"])) {
        $success = $_GET["success"];
        if($success == 1)
            showSuccess("Data berhasil disimpan.");
        else if($success == 2)
            showSuccess("Data berhasil diubah.");
        else if($success == 3)
            showSuccess("Data berhasil dihapus.");
    }
    ?>

    <?php
    $db = dbConnect();
    $id_anggota = $_SESSION["id_anggota"];
    $data = getProfile($id_anggota);
    ?>
    <div class="input-group mb-2">
        <span class="input-group-text">ID Anggota</span>
        <input type="text" name="idanggota" class="form-control" value="<?php echo $data["id_anggota"] ?>" disabled>
    </div>
    <div class="input-group mb-2">
        <span class="input-group-text">Nama Lengkap</span>
        <input type="text" name="namaanggota" class="form-control" value="<?php echo $data["nama"] ?>" disabled>
    </div>
    <?php
    if($data["jk"] == "L"){
        $jk = "Laki-laki";
    } else $jk = "Perempuan";
    ?>
    <div class="input-group mb-2">
        <span class="input-group-text">Jenis Kelamin</span>
        <input type="text" name="jkanggota" class="form-control" value="<?php echo $jk ?>" disabled>
    </div>
    <div class="input-group mb-2">
        <span class="input-group-text">Alamat</span>
        <input type="text" name="alamatanggota" class="form-control" value="<?php echo $data["alamat"] ?>" disabled>
    </div>
    <div class="input-group mb-2">
        <span class="input-group-text">No. Telp</span>
        <input type="text" name="notelpanggota" class="form-control" value="<?php echo $data["no_telp"] ?>" disabled>
    </div>
    <div class="input-group mb-2">
        <span class="input-group-text">Email</span>
        <input type="text" name="emailanggota" class="form-control" value="<?php echo $data["email"] ?>" disabled>
    </div>
    <div class="input-group mb-2">
        <span class="input-group-text">Username</span>
        <input type="text" name="useranggota" class="form-control" value="<?php echo $data["username"] ?>" disabled>
    </div>
    <div class="input-group mb-2">
        <span class="input-group-text">Password</span>
        <input type="password" name="passanggota" class="form-control" value="<?php echo $data["pass"] ?>" disabled>
    </div>
    <div class="input-group mb-2">
        <span class="input-group-text">Kelas</span>
        <input type="text" name="namakelas" class="form-control" value="<?php echo $data["namaKelas"] ?>" disabled>
    </div>
    <div class="input-group mb-2">
        <span class="input-group-text">Paket Belajar</span>
        <input type="text" name="namapaket" class="form-control flex-fill" value="<?php echo $data["namaPaket"] ?>" disabled>
    </div>
    <div class="text-center mt-4">
        <a href="profile-edit.php?id_anggota=<?php echo $data["id_anggota"] ?>" class="btn btn-lg btn-primary">Edit Profile</a>
    </div>
</div>

<?php footer(); ?>