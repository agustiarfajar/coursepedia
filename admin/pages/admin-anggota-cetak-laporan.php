<?php 
session_start();
if(!isset($_SESSION["id_admin"]))
{
    header("Location: ../index.php?error=4");
}
include_once("functions.php");
include_once("../layout.php");
?>
<?php style_section() ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body style="width:100%;margin:auto">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
          <i class="fas fa-globe"></i> Coursepedia, Inc.
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    </section>
</div>
<center>
<h4>Laporan Anggota Coursepedia</h4>

</center>
<table border="0" class="table table-bordered" style="width:100%">
    <thead>
        <tr align="center">
            <th>ID Anggota</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>No.Telp</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $db = dbConnect();
        if($db->connect_errno==0)
        {

            $sql = "SELECT * FROM anggota ORDER BY id_anggota ASC";
            $res = $db->query($sql);
            if($res)
            {
                $data = $res->fetch_all(MYSQLI_ASSOC);
                $subtotal = 0;
                foreach($data as $row)
                {
                    $subtotal += $row["total"];
                    ?>
                    <tr align="center">
                        <td><?php echo $row["id_anggota"] ?></td>
                        <td><?php echo $row["nama"] ?></td>
                        <td><?php echo $row["jk"] ?></td>
                        <td><?php echo $row["alamat"] ?></td>
                        <td><?php echo $row["no_telp"] ?></td>
                        <td><?php echo $row["email"] ?></td>
                    </tr>
                    <?php
                }
            } 
        }
    ?>
    </tbody>
</table>  
<script>
    window.addEventListener("load", window.print());
</script> 
</body>
</html>