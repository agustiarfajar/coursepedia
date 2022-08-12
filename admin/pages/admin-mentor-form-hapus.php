<?php 
session_start();
if(!isset($_SESSION["id_admin"]))
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
            <h1 class="m-0">Form Hapus Mentor</h1>
          </div><!-- /.col -->   
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admin-dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Mentor</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Mentor</h3>
              </div>
              <!-- /.card-header -->
              <?php 
                if(isset($_GET["id_mentor"]))
                {
                    $id_mentor = $_GET["id_mentor"];
                    $datamentor = getDataMentor($id_mentor);
                }
              ?>
              <div class="card-body">
                <form action="admin-mentor-hapus.php" method="post">
                    <div class="form-group">
                        <label for="id_kelas">Kode Mentor</label>
                        <input type="text" class="form-control" id="id_mentor" maxlength="8" name="id_mentor" value="<?php echo $datamentor["id_mentor"] ?>" autocomplete="off" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" maxlength="50" name="nama" placeholder="Masukan Nama Kelas" value="<?php echo $datamentor["nama"] ?>" autocomplete="off" readonly>
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