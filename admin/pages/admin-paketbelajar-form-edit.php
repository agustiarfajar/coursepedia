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
              <li class="breadcrumb-item active">Paket Belajar</li>
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
                <h3 class="card-title">Paket</h3>
              </div>
              <!-- /.card-header -->
              <?php 
                if(isset($_GET["id_paket"]))
                {
                    $id_paket = $_GET["id_paket"];
                    $datapaket = getDataPaket($id_paket);
                }
              ?>
              <div class="card-body">
                <form action="admin-paketbelajar-update.php" method="post">
                    <div class="form-group">
                        <label for="id_paket">Kode Paket</label>
                        <input type="text" class="form-control" id="id_paket" maxlength="8" name="id_paket" value="<?php echo $datapaket["id_paket"] ?>" autocomplete="off" readonly>
                    </div>
                    <div class="form-group">
                    <label for="id_paket">Kelas</label>
                      <select class="form-control" name="id_kelas" id="id_kelas">
                        <option value="">Pilih Kelas</option>
                        <?php 
                          $db = dbConnect();
                          if($db->connect_errno==0)
                          {
                              $sql = "SELECT * FROM kelas";
                              $res = $db->query($sql);
                              if($res)
                              {
                                  $data = $res->fetch_all(MYSQLI_ASSOC);
                                  foreach($data as $row)
                                  {
                                    ?>
                                    <option value=<?php echo $row["id_kelas"] ?> <?php echo ($row["id_kelas"] == $datapaket["id_kelas"] ? 'selected' : "") ?>><?php echo $row["nama"] ?></option>;
                                    <?php
                                  }
                                  
                                  $res->free();
                              }
                          }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Paket</label>
                        <input type="text" class="form-control" id="nama" maxlength="50" name="nama" placeholder="Masukan Nama Paket" value="<?php echo $datapaket["nama"] ?>" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga Paket</label>
                        <input type="text" class="form-control" id="harga" maxlength="50" name="harga" placeholder="Masukan Harga Paket" value="<?php echo $datapaket["harga"] ?>" autocomplete="off">
                    </div>
                    <button type="button" onclick="konfirmasiUbah()" class="btn btn-info" name="btnUpdate"><i class="fas fa-edit"></i> Update</button>
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