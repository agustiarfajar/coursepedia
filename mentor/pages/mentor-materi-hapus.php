<?php 
session_start();
if(!isset($_SESSION["id_mentor"]))
{
    header("Location: ../index.php?error=4");
}
include_once("functions.php");
include_once("layout.php");
?>
<?php style_section() ?>
<?php top_section() ?>
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Form Hapus</h1>
          </div><!-- /.col -->   
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="mentor-dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Materi</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <?php 
        if(isset($_GET["success"]))
        {
            $success = $_GET["success"];
            if($success == 3)
              showSuccess("Data berhasil dihapus.");
        }
      ?>
      

      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Kelas</h3>
              </div>
              <!-- /.card-header -->
              <?php 
                if(isset($_GET["id_materi"]))
                {
                    $id_materi = $_GET["id_materi"];
                    $datamateri = getDataMateri($id_materi);
                }
              ?>
              <div class="card-body">
                <form action="mentor-materi-aksihapus.php" method="post">
                    <div class="form-group">
                        <label for="id_materi">ID Materi</label>
                        <input type="text" class="form-control" id="id_materi" maxlength="8" name="id_materi" value="<?php echo $datamateri["id_materi"] ?>" autocomplete="off" readonly>
                    </div>
                    <div class="form-group">
                        <label for="id_kategori">ID Kategori</label>
                        <input type="text" class="form-control" id="id_kategori" maxlength="8" name="id_kategori" value="<?php echo $datamateri["id_kategori"] ?>" autocomplete="off" readonly>
                    </div>
                    <div class="form-group">
                        <label for="id_mentor">ID Mentor</label>
                        <input type="text" class="form-control" id="id_mentor" maxlength="8" name="id_mentor" value="<?php echo $datamateri["id_mentor"] ?>" autocomplete="off" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Materi</label>
                        <input type="text" class="form-control" id="nama" maxlength="50" name="nama" value="<?php echo $datamateri["nama"] ?>"autocomplete="off" readonly>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi Materi</label>
                        <input type="text" class="form-control" id="deskripsi" maxlength="50" name="deskripsi" value="<?php echo $datamateri["deskripsi"] ?>"autocomplete="off" readonly>
                    </div>
                    <div class="form-group">
                        <label for="link">Link Materi</label>
                        <input type="text" class="form-control" id="link" maxlength="50" name="link" value="<?php echo $datamateri["link"] ?>"autocomplete="off" readonly>
                    </div>
                    <div class="form-group">
                        <label for="id_kelas">ID Kelas</label>
                        <input type="text" class="form-control" id="id_kelas" maxlength="50" name="id_kelas" value="<?php echo $datamateri["id_kelas"] ?>"autocomplete="off" readonly>
                    </div>
                    <button type="button" onclick="konfirmasiHapus()" class="btn btn-danger" name="btnHapus" onclick="return confirm('Apakah anda yakin ingin menghapus data?')"><i class="fas fa-trash"></i> Hapus</button>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<?php bottom_section() ?>
<?php script_section() ?>
<script>
// Sweetalert
function konfirmasiHapus()
{
  event.preventDefault();
  var form = event.target.form;
  Swal.fire({
      icon: "question",
      title: "Konfirmasi",
      text: "Apakah anda yakin ingin menghapus data?",
      showCancelButton: true,
      confirmButtonText: "Hapus",
      cancelButtonText: "Batal"
  }).then((result) => {
      if(result.value) {
          form.submit();
      } else {
          Swal.fire("Informasi","Data batal dihapus.","error");
      }
  });
}
</script>