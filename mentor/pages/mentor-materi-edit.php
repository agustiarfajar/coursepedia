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
              <li class="breadcrumb-item active">Materi</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <script type="text/javascript" language="javascript">
      function validasidatamateri() {
        var id_materi=document.frm.id_materi.value.trim();
        if(id_materi.length==0){
          alert("ID Materi tidak boleh kosong.");
          document.frm.id_materi.focus();
          return false;
        }
        if(document.frm.id_kategori.selectedIndex==0){
          alert("ID Kategori wajib dipilih.");
          document.frm.id_kategori.focus();
          return false;
        }
        if(document.frm.id_mentor.selectedIndex==0){
          alert("ID Mentor wajib dipilih.");
          document.frm.id_mentor.focus();
          return false;
        }
        if(document.frm.id_kelas.selectedIndex==0){
          alert("ID Kelas wajib dipilih.");
          document.frm.id_kelas.focus();
          return false;
        }
        var nama=document.frm.nama.value.trim();
        if(nama.length==0){
          alert("Nama Materi tidak boleh kosong.");
          document.frm.nama.focus();
          return false;
        }
        var deskripsi=document.frm.deskripsi.value.trim();
        if(deskripsi.length==0){
          alert("deskripsi Materi tidak boleh kosong.");
          document.frm.deskripsi.focus();
          return false;
        }
        var link=document.frm.link.value.trim();
        if(link.length==0){
          alert("Link Materi tidak boleh kosong.");
          document.frm.link.focus();
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
                if(isset($_GET["id_materi"]))
                {
                    $id_materi = $_GET["id_materi"];
                    $datamateri = getDataMateri($id_materi);
                }
              ?>
              <div class="card-body">
                <form action="mentor-materi-update.php" name="frm" method="post" onsubmit="return validasidatamateri()">
                    <div class="form-group">
                        <label for="id_materi">ID Materi</label>
                        <input type="text" class="form-control" id="id_materi" maxlength="8" name="id_materi" value="<?php echo $datamateri["id_materi"] ?>" autocomplete="off" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama">ID Kategori</label>
                        <select class="form-control" name="id_kategori">
                          <option>Pilih Katergori</option>
                          <?php
                            $datakategori=getListKategori();
                            foreach($datakategori as $data){
                              echo "<option value=\"".$data["id_kategori"]."\"";
                              if($data["id_kategori"]==$datamateri["id_kategori"])
                                echo " selected"; // default sesuai kategori sebelumnya
                              echo ">".$data["id_kategori"]."</option>";
                            }
                          ?>
                          </select>
                    </div>
                    <div class="form-group">
                        <label for="nama">ID Mentor</label>
                        <select class="form-control" name="id_mentor">
                          <option>Pilih Mentor</option>
                          <?php
                            $datamentor=getListMentor();
                            foreach($datamentor as $data){
                              echo "<option value=\"".$data["id_mentor"]."\"";
                              if($data["id_mentor"]==$datamateri["id_mentor"])
                                echo " selected"; // default sesuai kategori sebelumnya
                              echo ">".$data["id_mentor"]."</option>";
                            }
                          ?>
                          </select>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Materi</label>
                        <input type="text" class="form-control" id="nama" maxlength="50" name="nama" value="<?php echo $datamateri["nama"] ?>">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi Materi</label>
                        <input type="text" class="form-control" id="deskripsi" maxlength="50" name="deskripsi" value="<?php echo $datamateri["deskripsi"] ?>">
                    </div>
                    <div class="form-group">
                        <label for="link">Link Materi</label>
                        <input type="text" class="form-control" id="link" maxlength="50" name="link" value="<?php echo $datamateri["link"] ?>">
                    </div>
                    <div class="form-group">
                        <label for="id_kelas">ID Kelas</label>
                        <select class="form-control" name="id_kelas">
                          <option>Pilih Kelas</option>
                          <?php
                            $datakelas=getListKelas();
                            foreach($datakelas as $data){
                              echo "<option value=\"".$data["id_kelas"]."\"";
                              if($data["id_kelas"]==$datamateri["id_kelas"])
                                echo " selected"; // default sesuai kategori sebelumnya
                              echo ">".$data["id_kelas"]."</option>";
                            }
                          ?>
                          </select>
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