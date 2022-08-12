<?php 
session_start();
if(!isset($_SESSION["id_admin"])){
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
                <form action="admin-mentor-update.php" method="post">
                    <div class="form-group">
                        <label for="id_mentor">ID Mentor</label>
                        <input type="text" class="form-control" id="id_mentor" name="id_mentor" value="<?= $datamentor['id_mentor']?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama_mentor">Nama Mentor</label>
                        <input type="text" class="form-control" value="<?= $datamentor['nama']?>" id="nama_mentor" name="nama_mentor" placeholder="Masukan Nama Mentor" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="jk">Jenis Kelamin</label>
                        <?php 
                        if($datamentor["jk"] == 'L')
                        {
                          ?>
                            <select class="form-control" id="jk" name="jk" required>
                              <option value="">Pilih Jenis Kelamin</option>
                              <option value="L" selected>Laki-Laki</option>
                              <option value="P">Perempuan</option>
                            </select>
                          <?php
                        } else if($datamentor["jk"] == 'P')
                        {
                          ?>
                            <select class="form-control" id="jk" name="jk" required>
                              <option value="">Pilih Jenis Kelamin</option>
                              <option value="L">Laki-Laki</option>
                              <option value="P" selected>Perempuan</option>
                            </select>
                          <?php
                        }
                        ?>
                        
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" placeholder="Masukan Alamat" required><?= $datamentor['alamat']?></textarea>  
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No. HP</label>
                        <input type="text" class="form-control" value="<?= $datamentor['no_telp']?>" id="no_hp" name="no_hp" placeholder="Masukan No. HP" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" value="<?= $datamentor['username']?>" id="username" name="username" placeholder="Masukan Username" autocomplete="off" required>
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