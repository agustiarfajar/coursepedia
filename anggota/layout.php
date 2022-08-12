<?php

function head(){
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Coursepedia</title>
        <link rel="icon" href="../komponen/dist/img/logo-cp.png">  
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    </head>
    <style>
        /* PAGINATION */
        .pagination_section {
            position: relative;
            padding: 40px;
            list-style-type: none;
        }
        .pagination_section li 
        {
            display: inline;
        }
        .pagination_section a {
            padding: 10px 14px;
            text-decoration: none;
            border: 1px solid blue;
            color: blue;
        }
        .pagination_section a.active {
            background: blue;
            color: white;
        }
    </style>
    <?php
}

function nav() {
    ?>
    <body style="background:#F5F5F5">
    <nav class="navbar navbar-expand-lg bg-secondary px-4 py-2">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="">
                <img class="bi me-2" width="32" height="32" role="img" src="../komponen/dist/img/logo-cp.png"></img>
                Coursepedia
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="nav navbar-nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 fw-semibold">
                    <li class="nav-item"><a href="index-anggota.php" class="nav-link px-2 text-white">Home</a></li>
                </ul>
                <div class="dropdown d-flex lh-sm">
                    <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="border:0">
                        <span class="fw-semibold text-white"><?php echo $_SESSION["nama"]; ?>&emsp;
                        <img src="../komponen/dist/img/avatar.png" width="32" height="32" class="rounded-circle me-2">
                        </span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                        <li><a class="dropdown-item" href="view-pembelajaran.php">Pembelajaran</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <?php
}

function navanggota(){
    head();
    nav();
}

function navprofile(){
    head();
    ?>
    <style>
        input[type="text"]:disabled{background:white;}
        span.input-group-text {
            width:150px; background:gray; color:white;
        }
    </style>
    <?php
    nav();
}

function navprofileedit(){
    head();
    ?>
    <style>
        span.input-group-text {
            width:130px; background:gray; color:white;
        }
    </style>
    <?php
    nav();    
}

function footer(){
    ?>
    <footer class="footer mt-auto py-3 bg-dark">
        <div class="container">
            <span class="text-muted">&copy; 2022 Coursepedia. All Rights Reserved Kelompok 2 RPL</span>
        </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <!-- <script>
        $(document).ready(function($){

            $('#cari').on('keyup', function(){
                var input = $(this).val().toLowerCase();
                if(input == ""){
                    $.ajax({
                        url:"cari-materi.php",
                        method:"POST",
                        data:{input:input},
                        success:function(data){
                            $('#listmateri').html(data);
                        }
                    });
                } else {
                    $('#listmateri').css("display","none");
                }
            });

        });
    </script> -->
    </body>
    </html>
    <?php
}

function navmainindex(){
    head();
    ?>
    <body class="bg-dark bg-gradient">
    <nav class="navbar navbar-expand-lg bg-light px-4 py-2">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
            <img class="bi me-2" width="29" height="32" role="img" src="komponen/assets/logo-cp-black2.png"></img>
            <strong>Coursepedia</strong></a>
            <div class="text-end">
                    <a href="anggota/login.php" class="btn btn-warning" style="width:80px"><b>Login</b></a>
            </div>
        </div>
    </nav>
    <?php
}

function navdaftar(){
    head();
    ?>
    <body class="bg-dark bg-gradient">
    <nav class="navbar navbar-expand-lg bg-light px-4 py-2 mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">
            <img class="bi me-2" width="29" height="32" role="img" src="../komponen/assets/logo-cp-black2.png"></img>
            <strong>Coursepedia</strong></a>
        </div>
    </nav>
    <?php
}

function footermain(){
    ?>
    <footer class="footer mt-auto py-3 bg-light">
      <div class="container">
          <span class="text-muted">&copy; 2022 Coursepedia. All Rights Reserved To Kelompok 2 RPL</span>
      </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    </body>
    </html>
    <?php
  }

?>