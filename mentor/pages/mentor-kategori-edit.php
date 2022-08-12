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
            <h1 class="m-0">Form Edit</h1>
          </div><!-- /.col -->   
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="mentor-dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Kategori Materi</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <script type="text/javascript" language="javascript">
        function validasidatakategori() {
          var id_kategori=document.frm.id_kategori.value.trim();
          if(id_kategori.length==0){
            alert("ID Kategori tidak boleh kosong.");
            document.frm.id_kategori.focus();
            return false;
          }
          var nama=document.frm.nama.value.trim();
          if(nama.length==0){
            alert("Nama Kategori Materi tidak boleh kosong.");
            document.frm.nama.focus();
            return false;
          }
        return true;
        }
        </script>
    <!-- Main content -->
    <section class="content">
      <?php 
        if(isset($_GET["success"]))
        {
            $success = $_GET["success"];
            if($success == 1)
              showSuccess("Data berhasil disimpan.");
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
                if(isset($_GET["id_kategori"]))
                {
                    $id_kategori = $_GET["id_kategori"];
                    $datakategori = getDataKategori($id_kategori);
                }
              ?>
              <div class="card-body">
                <form action="mentor-kategori-update.php" name="frm" method="post" onsubmit="return validasidatakategori()">
                    <div class="form-group">
                        <label for="id_kategori">ID Kategori</label>
                        <input type="text" class="form-control" id="id_kategori" maxlength="8" name="id_kategori" value="<?php echo $datakategori["id_kategori"] ?>" autocomplete="off" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Kategori Materi</label>
                        <input type="text" class="form-control" id="nama" maxlength="50" name="nama" value="<?php echo $datakategori["nama"] ?>">
                    </div>
                    <button type="button" onclick="konfirmasiUbah()" class="btn btn-info" name="btnUpdate" onclick="return confirm('Apakah anda yakin ingin mengubah data?')"><i class="fas fa-edit"></i> Update</button>
                    <input type="reset" class="btn btn-warning">
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