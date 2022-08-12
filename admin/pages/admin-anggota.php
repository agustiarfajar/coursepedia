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
            <h1 class="m-0">Anggota</h1>
          </div><!-- /.col -->   
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admin-dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Anggota</li>
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
            showError("ID Kelas sudah ada.");
          else if($Error == "input")
            showError("Kesalahan format masukan : \n".$_SESSION["salahinputkelas"]);
          else if($Error == "proses")
            showError("Terjadi kesalahan, silahkan melakukan proses dengan benar");
          else if($Error == "fk")
            showError("Terjadi kesalahan: ".$_SESSION["fk"]);
      }
    ?>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Anggota</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                  <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                    <thead>
                    <tr>
                      <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending">ID Anggota</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Email</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Username</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Nama</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">JK</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Alamat</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">No.Telepon</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Paket Belajar</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>  
                      <?php 
                      $db = dbConnect();
                      if($db->connect_errno==0)
                      {
                          $sql = "SELECT * FROM anggota";
                          $res = $db->query($sql);
                          if($res)
                          {
                              $data_anggota = $res->fetch_all(MYSQLI_ASSOC);
                              foreach($data_anggota as $row)
                              {
                                echo "<tr>
                                  <td class='dtr-control sorting_1' tabindex='0'>".$row['id_anggota']."</td>
                                  <td>".$row['email']."</td>
                                  <td>".$row['username']."</td>
                                  <td>".$row['nama']."</td>
                                  <td>".$row['jk']."</td>
                                  <td>".$row['alamat']."</td>
                                  <td>".$row['no_telp']."</td>
                                  <td>".$row['id_paket']."</td>
                                  <td>                                    
                                      <a href='admin-anggota-form-hapus.php?id_anggota=".$row['id_anggota']."' class='btn btn-sm btn-danger'><i class='fas fa-trash'></i></a>
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
</script>