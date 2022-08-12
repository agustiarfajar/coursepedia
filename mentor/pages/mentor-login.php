<?php 
include_once("functions.php");
?>
<?php 
$db = dbConnect();
if($db->connect_errno==0)
{
    if(isset($_POST["btnLogin"]))
    {
        $username = $db->escape_string($_POST["username"]);
        $password = $db->escape_string($_POST["pass"]);
        $sql = "SELECT * FROM mentor WHERE username='$username' AND pass=PASSWORD('$password')";
        $res = $db->query($sql);
        if($res)
        {
            if($res->num_rows==1)
            {
                $data=$res->fetch_assoc();
                session_start();
                $_SESSION["id_mentor"]=$data["id_mentor"];
                $_SESSION["nama"]=$data["nama"];
                $_SESSION["jk"]=$data["jk"];
                $_SESSION["alamat"]=$data["alamat"];
                $_SESSION["no_telp"]=$data["no_telp"];
                $_SESSION["username"]=$data["username"];
                $_SESSION["password"]=$data["password"];
                header("Location: mentor-dashboard.php");
            }
            else 
                header("Location: ../index.php?error=1");
        }
    }
    else 
        header("Location: ../index.php?error=2");
}
else 
    header("Location: ../index.php?error=3");
?>