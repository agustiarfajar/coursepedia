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
<!-- <button onclick="window.print()">Cetak</button> -->
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
<?php 
setlocale(LC_ALL, 'IND');
$bulan = $_GET["bulan"];
$tahun = $_GET["tahun"];

?>
<center>
<h4>Laporan Pendapatan Coursepedia</h4>
<p>
    <?php 
        if($bulan == "" && $tahun == "")
        {
            echo "";
        } else {
            echo strftime('%B',mktime($bulan)); ?> - <?php echo $tahun;
        }
    ?>
</p>
</center>
<table border="0" class="table table-bordered" style="width:100%">
    <thead>
        <tr align="center">
            <th>No.Invoice</th>
            <th>Tanggal</th>
            <th>Total<small>(Rp)</small></th>
        </tr>
    </thead>
    <tbody>
    <?php
    $db = dbConnect();
        if($db->connect_errno==0)
        {
            if($bulan == "" && $tahun == "")
            {
                $sql = "SELECT * FROM tagihan ORDER BY no_invoice ASC";
            } else {
                $sql = "SELECT * FROM tagihan
                    WHERE MONTH(tgl_pembayaran)='$bulan' AND YEAR(tgl_pembayaran)='$tahun'
                    ORDER BY no_invoice ASC";
            }
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
                        <td><?php echo $row["no_invoice"] ?></td>
                        <td><?php echo date('d/m/Y', strtotime($row["tgl_pembayaran"])) ?></td>
                        <td><?php echo number_format($row["total"],0,',','.') ?></td>
                    </tr>
                    <?php
                }
            } 
        }
    ?>
    <tr>
        <td colspan="2" align="right"><b>Subtotal</b></td>
        <td align="center"><b><?php echo number_format($subtotal,0,',','.') ?></b></td>
    </tr>
    </tbody>
</table>  
<script>
    window.addEventListener("load", window.print());
</script> 
</body>
</html>