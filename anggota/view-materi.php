<?php 
include_once("functions.php");
include_once("layout.php");
session_start();
if(!isset($_SESSION["id_anggota"])){
    header("Location: login.php?error=proses");
}
?>

<?php
navanggota();
if(isset($_GET["id_materi"]))
{
    $db = dbConnect();
    $id_materi = $_GET["id_materi"];
    $data = getMateri($id_materi);
}
?>
<div class="bg-light my-4 mx-5 p-4 rounded-3 shadow-sm text-center">
    <div class="bg-warning bg-gradient rounded-3 p-2"><h3>Materi Pembelajaran</h3></div>
    <div class="row g-4 mt-2 mb-3">
        <div class="col-8 text-center"><div style="height:400px">
        <iframe width="100%" height="100%" src="<?php echo $data["link"] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div></div>
        <div class="col">
            <div class="border border-secondary border-3 rounded-3 p-3 text-start" style="height:400px">
                <h5 class="text-muted"><span class="fw-bold text-dark"><?php echo $data["namaKategori"] ?></span> - <?php echo $data["id_materi"] ?></h5>
                <h4 class="text-primary"><?php echo $data["namaMateri"] ?></h4>
                <h6 class="text-danger">Disampaikan oleh : <?php echo $data["namaMentor"] ?></h6>
                <hr>
                <div class="overflow-auto" style="height:250px">
                    <strong>Deskripsi :</strong>
                    <p><?php echo nl2br($data["deskripsi"]) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php footer() ?>