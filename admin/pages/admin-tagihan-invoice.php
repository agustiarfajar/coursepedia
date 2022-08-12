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
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Invoice</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              Tekan tombol Cetak di bawah.
            </div>

            <!-- AMBIL DATA -->
            <?php 
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
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> Coursepedia, Inc.
                    <small class="float-right">Tanggal: <?php echo date('d/m/Y', strtotime($data["tgl_pembayaran"])) ?></small>
                  </h4>
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

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="admin-tagihan-invoice-cetak.php?no_invoice=<?php echo $data["no_invoice"] ?>" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Cetak</a>
                 
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<?php bottom_section() ?>
<?php script_section() ?>