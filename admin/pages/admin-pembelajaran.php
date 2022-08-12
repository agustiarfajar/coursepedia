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
        <h1 class="m-0">Pembelajaran</h1>
      </div><!-- /.col -->   
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="admin-dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Pembelajaran</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<!-- Main Content -->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Pembelajaran</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                  <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                    <thead>
                    <tr>
                      <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending">ID Pembelajaran</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Nama Anggota</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Nama Mentor</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Nama Materi</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Status</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Tgl.Akses</th>
                    </tr>
                    </thead>
                    <tbody>  
                      <?php 
                      $db = dbConnect();
                      if($db->connect_errno==0)
                      {
                          $sql = "SELECT pembelajaran.id_pembelajaran, pembelajaran.tgl_akses, anggota.nama NamaAnggota, mentor.nama NamaMentor, materi.nama NamaMateri, pembelajaran.status 
                                  FROM pembelajaran 
                                  INNER JOIN anggota ON pembelajaran.id_anggota=anggota.id_anggota 
                                  INNER JOIN mentor on pembelajaran.id_mentor=mentor.id_mentor 
                                  INNER JOIN materi on pembelajaran.id_materi=materi.id_materi";
                          $res = $db->query($sql);
                          if($res)
                          {
                              $data_pembelajaran = $res->fetch_all(MYSQLI_ASSOC);
                              foreach($data_pembelajaran as $row)
                              {
                                echo "<tr>
                                  <td class='dtr-control sorting_1' tabindex='0'>".$row['id_pembelajaran']."</td>
                                  <td>".$row['NamaAnggota']."</td>
                                  <td>".$row['NamaMentor']."</td>
                                  <td>".$row['NamaMateri']."</td>
                                  <td>".$row['status']."</td>
                                  <td>".$row['tgl_akses']."</td>
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