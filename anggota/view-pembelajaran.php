<?php
include_once("functions.php");
include_once("layout.php");
session_start();
if(!isset($_SESSION["id_anggota"])){
    header("Location: login?error=proses");
}
?>
<?php 
navanggota();
?>
<div class="container w-75 py-2 bg-danger bg-gradient rounded-3 my-4 text-center text-light">
    <h2>View Pembelajaran</h2>
</div>
<div class="container w-75 bg-secondary bg-opacity-10 rounded-3 shadow-sm p-4 mb-5">
    <?php
    if(isset($_GET["error"])) {
        $error = $_GET["error"];
        if($error == "proses") {
            showError("Akses dilarang, wajib login!");
        }
    }
    ?>
    <table class="table bg-light">
        <thead>
            <tr>
            <th scope="col">ID Pembelajaran</th>
            <th scope="col">Nama Materi</th>
            <th scope="col">Nama Mentor</th>
            <th scope="col">Status</th>
            <th scope="col">Akses</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
        <?php
        $db = dbConnect();
        // $id = $_SESSION["id_anggota"];
        if($db->connect_errno==0){
            $anggota = $_SESSION["id_anggota"];
            $res=$db->query("SELECT pb.*,a.id_anggota,m.nama AS namaMateri FROM pembelajaran pb 
                    INNER JOIN anggota a ON pb.id_anggota=a.id_anggota
                    INNER JOIN materi m ON pb.id_materi=m.id_materi
                    WHERE a.id_anggota='$anggota' 
                    ORDER BY pb.id_pembelajaran ASC");
            if($res){
                $data = $res->fetch_all(MYSQLI_ASSOC);
                foreach($data as $row){
                    echo "<tr>
                    <td>".$row["id_pembelajaran"]."</td>
                    <td>".$row["id_mentor"]."</td>
                    <td>".$row["namaMateri"]."</td>
                    <td>".$row["status"]."</td>
                    <td>".$row["tgl_akses"]."</td>
                    </tr>";
                }
            } else echo "Error ".(DEVELOPMENT?":".$db->error:"");
        } else echo "Error ".(DEVELOPMENT?":".$db->error:"");
        ?>
        </tbody>
    </table>
</div>
<?php footer(); ?>