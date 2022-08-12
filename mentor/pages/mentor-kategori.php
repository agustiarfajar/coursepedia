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
            <h1 class="m-0">Kategori</h1>
          </div><!-- /.col -->   
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="mentor-dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Kategori</li>
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
            if($success == 1)
              showSuccess("Data berhasil disimpan.");
            else if($success == 2)
              showSuccess("Data berhasil diubah.");
            else if($success == 3)
              showSuccess("Data berhasil dihapus.");
        }

        if(isset($_GET["warning"]))
        {
          $warning = $_GET["warning"];
          if($warning = "perubahan")
            showWarning("Tidak ada perubahan data.");
        }

        if(isset($_GET["error"]))
        {
            $Error = $_GET["error"];
            if($Error == "id")
              showError("ID Kategori sudah ada.");
            else if($Error == "input")
              showError("Kesalahan format masukan : \n".$_SESSION["salahinputkelas"]);
            else if($Error == "proses")
              showError("Terjadi kesalahan, silahkan melakukan proses dengan benar");
            else if($Error == "fk")
              showError("Terjadi kesalahan: ".$_SESSION["fk"]);
        }

      ?>
          <button type="button" class="btn btn-app" data-toggle="modal" data-target="#modal-lg">
        <i class="fas fa-plus"></i> Tambah
      </button>
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
      <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
        <form action="mentor-kategori-tambah.PHP" name="frm" method="post" onsubmit="return validasidatakategori()">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Data Kategori Materi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">  
                <div class="card-body">
                  <div class="form-group">
                    <label for="id_kategori">ID Kategori</label>
                    <input type="text" class="form-control" id="id_kategori" maxlength="8" name="id_kategori" value="<?php echo kodeOtomatisKategori()?>" autocomplete="off" readonly>
                  </div>
                  <div class="form-group">
                    <label for="nama">Nama Kategori</label>
                    <input type="text" class="form-control" id="nama" maxlength="50" name="nama" placeholder="Masukan Nama Kategori" autocomplete="off">
                  </div>    
                </div>
                <!-- /.card-body -->
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <button type="button" onclick="konfirmasiSimpan()" name="btnSimpan" class="btn btn-primary">Simpan</button>
            </div>
          </div>
          </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Kategori</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                  <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                    <thead>
                    <tr>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">ID Kategori</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Nama</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>  
                      <?php 
                      $db = dbConnect();
                      if($db->connect_errno==0)
                      {
                          $sql = "SELECT * FROM kategori_materi";
                          $res = $db->query($sql);
                          if($res)
                          {
                              $data_kategori = $res->fetch_all(MYSQLI_ASSOC);
                              foreach($data_kategori as $row)
                              {
                                echo "<tr>
                                  <td class='dtr-control sorting_1' tabindex='0'>".$row['id_kategori']."</td>
                                  <td>".$row['nama']."</td>
                                  <td>
                                      <a href='mentor-kategori-edit.php?id_kategori=".$row['id_kategori']."' class='btn btn-sm btn-info'><i class='fas fa-edit'></i></a> | 
                                      <a href='mentor-kategori-hapus.php?id_kategori=".$row['id_kategori']."' class='btn btn-sm btn-danger'><i class='fas fa-trash'></i></a>
                                  </td>
                              </tr>";
                              }
                              $res->free();
                          }
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
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
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

  // Sweetalert
  function konfirmasiSimpan()
    {
        event.preventDefault();
        var form = event.target.form;
        Swal.fire({
            icon: "question",
            title: "Konfirmasi",
            text: "Apakah anda yakin ingin menyimpan data?",
            showCancelButton: true,
            confirmButtonText: "Simpan",
            cancelButtonText: "Batal"
        }).then((result) => {
            if(result.value) {
                form.submit();
            } else {
                Swal.fire("Informasi","Data batal disimpan.","error");
            }
        });
    }
</script>