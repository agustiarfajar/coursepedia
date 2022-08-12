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
            <h1 class="m-0">Form Laporan Pendapatan</h1>
          </div><!-- /.col -->   
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admin-dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Pendapatan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <form action="admin-anggota-cetak-laporan.php" method="get" target="_blank">

          <button type="submit" class="btn btn-primary"><i class="fas fa-print"></i> Cetak</button>
        </form>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
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