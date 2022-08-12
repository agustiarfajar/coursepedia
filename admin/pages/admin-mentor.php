<?php 
session_start();
if(!isset($_SESSION["id_admin"]))
{
    header("Location: ../index.php?error=4");
}
  include_once("functions.php");
  include_once("layout.php");


  $db = dbConnect();

  if(isset($_POST['btnSimpan'])){
    $id = $db->escape_string($_POST['id_mentor']);
    $nama = $db->escape_string($_POST['nama_mentor']);
    $jk = $db->escape_string($_POST['jk']);
    $alamat = $db->escape_string($_POST['alamat']);
    $no_telp = $db->escape_string($_POST['no_hp']);
    $username = $db->escape_string($_POST['username']);
    $password = $db->escape_string($_POST['password']);

    $sql = "INSERT INTO mentor VALUES ('$id', '$nama', '$jk', '$alamat', '$no_telp', '$username', PASSWORD('$password'))";
    $res = $db->query($sql);

    if($res){
      header("Location: admin-mentor.php?success=1");
    }else{
      header("Location: admin-mentor.php?error=proses");
    }
  }
?>
<?php style_section() ?>
<?php top_section() ?>
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Mentor</h1>
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
              showError("ID mentor sudah ada.");
            else if($Error == "input")
              showError("Kesalahan format masukan : \n".$_SESSION["salahinputmentor"]);
            else if($Error == "proses")
              showError("Terjadi kesalahan, silahkan melakukan proses dengan benar");
            else if($Error == "fk")
              showError("Terjadi kesalahan: ".$_SESSION["fk"]);
        }
      ?>
      <button type="button" class="btn btn-app" data-toggle="modal" data-target="#modal-lg">
        <i class="fas fa-plus"></i> Tambah
      </button>

      <!-- Modal tambah mentor -->
      <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <form action="" method="post">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Tambah Data Mentor</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="id_mentor">ID Mentor</label>
                  <input type="text" class="form-control" id="id_mentor" name="id_mentor" value="<?php echo kodeOtomatisMentor()?>" readonly>
                </div>
                <div class="form-group">
                  <label for="nama_mentor">Nama Mentor</label>
                  <input type="text" class="form-control" id="nama_mentor" name="nama_mentor" placeholder="Masukan Nama Mentor" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label for="jk">Jenis Kelamin</label>
                  <select class="form-control" id="jk" name="jk" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="L">Laki-Laki</option>
                    <option value="P">Perempuan</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <textarea class="form-control" id="alamat" name="alamat" placeholder="Masukan Alamat" required></textarea>  
                </div>
                <div class="form-group">
                  <label for="no_hp">No. HP</label>
                  <input type="text" class="form-control" maxlength="13" id="no_hp" name="no_hp" placeholder="Masukan No. HP" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="Masukan Username" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password" autocomplete="off" required>
                </div>  
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" id="btnSimpan" name="btnSimpan">Simpan</button>
              </div>              
            </div>
          </form>
        </div>
      </div>

      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Mentor</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                  <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                    <thead>
                    <tr>
                      <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending">ID Mentor</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Nama</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">JK</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Alamat</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">No.Telepon</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Username</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Password</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>  
                      <?php 
                      $db = dbConnect();
                      if($db->connect_errno==0)
                      {
                          $sql = "SELECT * FROM mentor";
                          $res = $db->query($sql);
                          if($res)
                          {
                              $data_mentor = $res->fetch_all(MYSQLI_ASSOC);
                              foreach($data_mentor as $row)
                              {
                                echo "<tr>
                                  <td class='dtr-control sorting_1' tabindex='0'>".$row['id_mentor']."</td>
                                  <td>".$row['nama']."</td>
                                  <td>".$row['jk']."</td>
                                  <td>".$row['alamat']."</td>
                                  <td>".$row['no_telp']."</td>
                                  <td>".$row['username']."</td>
                                  <td>".substr($row['pass'],0, 10)."</td>
                                  <td>
                                      <a href='admin-mentor-form-edit.php?id_mentor=".$row['id_mentor']."' class='btn btn-sm btn-info'><i class='fas fa-edit'></i></a> | 
                                      <a href='admin-mentor-form-hapus.php?id_mentor=".$row['id_mentor']."' class='btn btn-sm btn-danger'><i class='fas fa-trash'></i></a>
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

  // iNSERT DATA
  $('#btnSimpan').on('click', function(){
    let id = $('#id_mentor').val();
    let nama = $('#nama_mentor').val();
    let jenis_kelamin = $('#jk').val();
    let alamat = $('#alamat').val();
    let no_telp = $('#no_telp').val();
    let username = $('#username').val();
    let password = $('#password').val();
    
    if(id == '' || nama == '' || jenis_kelamin == '' || alamat == '' || no_telp == '' || username == '' || password == ''){
      Swal.fire('Warning!',
                'Pastikan Semua data sudah terisi',
                'warning');
    }
  })
</script>