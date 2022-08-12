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
            <h1 class="m-0">Form Edit</h1>
          </div><!-- /.col -->   
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admin-dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Kelas</li>
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
                <h3 class="card-title">Kelas</h3>
              </div>
              <!-- /.card-header -->
              <?php 
                if(isset($_GET["id_kelas"]))
                {
                    $id_kelas = $_GET["id_kelas"];
                    $datakelas = getDataKelas($id_kelas);
                }
              ?>
              <div class="card-body">
                <form action="admin-kelas-update.php" method="post">
                    <div class="form-group">
                        <label for="id_kelas">Kode Kelas</label>
                        <input type="text" class="form-control" id="id_kelas" maxlength="8" name="id_kelas" value="<?php echo $datakelas["id_kelas"] ?>" autocomplete="off" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Kelas</label>
                        <input type="text" class="form-control" id="nama" maxlength="50" name="nama" placeholder="Masukan Nama Kelas" value="<?php echo $datakelas["nama"] ?>" autocomplete="off">
                    </div>
                    <button type="button" onclick="konfirmasiUbah()" class="btn btn-info" name="btnUpdate" onclick="return confirm('Apakah anda yakin ingin mengubah data?')"><i class="fas fa-edit"></i> Update</button>
                    <input type="reset" class="btn btn-outline-primary">
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
function konfirmasiUbah()
{
    event.preventDefault();
    var form = event.target.form;
    Swal.fire({
        icon: "question",
        title: "Konfirmasi",
        text: "Apakah anda yakin ingin mengubah data?",
        showCancelButton: true,
        confirmButtonText: "Ubah",
        cancelButtonText: "Batal"
    }).then((result) => {
        if(result.value) {
            form.submit();
        } else {
            Swal.fire("Informasi","Data batal diubah.","error");
        }
    });
}
</script>