<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Coursepedia</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../komponen/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../komponen/dist/css/adminlte.min.css">
</head>
<body>
  <!-- AMBIL DATA -->
<?php 
    include_once("functions.php");
    $no_invoice = $_GET["no_invoice"];
    $db = dbConnect();
    if($db->connect_errno==0)
    {
        $sql = "SELECT a.*,b.nama as paket,c.nama as nama_anggota,c.alamat,c.no_telp,c.email FROM 
        tagihan as a 
        INNER JOIN paket_belajar as b ON a.id_paket=b.id_paket
        INNER JOIN anggota as c ON a.id_anggota=c.id_anggota
        WHERE a.no_invoice='$no_invoice'";
        $res = $db->query($sql);
        if($res)
        {
          $data = $res->fetch_assoc();
          $res->free();
        }
    } 
    else 
    {
        echo "Gagal koneksi";
    }
  ?>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
          <i class="fas fa-globe"></i> Coursepedia, Inc.
          <small class="float-right">Tanggal: <?php echo date('d/m/Y', strtotime($data["tgl_pembayaran"])) ?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
      Dari
        <address>
          <strong>Admin, Inc.</strong><br>
          Admin Coursepedia, Kelompok 2<br>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        Kepada
        <address>
          <strong><?php echo $data["nama_anggota"] ?></strong><br>
          <?php echo $data["alamat"] ?><br>
          Phone: <?php echo $data["no_telp"] ?><br>
          Email: <?php echo $data["email"] ?>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>No.Tagihan: <?php echo $data["no_invoice"] ?></b>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
      <table class="table table-striped">
        <thead>
        <tr>
          <th>Qty</th>
          <th>Paket Belajar</th>
          <th>Kode</th>
          <th>Harga</th>
          <th>Subtotal</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>1</td>
          <td><?php echo $data["paket"] ?></td>
          <td><?php echo $data["id_paket"] ?></td>
          <td>Rp.<?php echo number_format($data["total"],0,',','.') ?></td>
          <td>Rp.<?php echo number_format($data["total"],0,',','.') ?></td>
        </tr>                   
        </tbody>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <div class="row">
    <!-- accepted payments column -->
    <div class="col-6">
      
    </div>
    <!-- /.col -->
    <div class="col-6">
      <p class="lead">Detail</p>

      <div class="table-responsive">
        <table class="table">
          <tr>
            <th>Diskon</th>
            <td>0</td>
          </tr>
          <tr>
            <th style="width:50%">Subtotal:</th>
            <td><?php echo number_format($data["total"],0,',','.') ?></td>
          </tr>
        </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<!-- Page specific script -->
<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>