<?php
error_reporting();
require('config.php');
session_start();

$sql_category = mysqli_query($sql_con, 'SELECT * FROM category') or die();
$sql_setting = mysqli_query($sql_con, 'SELECT * FROM setting') or die();
$setting = mysqli_fetch_array($sql_setting);

?>

<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="description" content="<?=$setting["keywords"]?>">
  <meta name="keywords" content="<?=$setting["description"]?>">
  <link rel="shortcut icon" href="img/logo.png" />
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/mdb.css">
  <link rel="stylesheet" href="css/mdb.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/db.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <script type="text/javascript" src="js/jquery.min.js?v=1"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <title><?=$setting["title"]?></title>
  <style>
    body {
      background-color: #0a0a0a;
    }

    .navbar.navbar-dark .breadcrumb .nav-item.active>.nav-link,
    .navbar.navbar-dark .navbar-nav .nav-item.active>.nav-link {
      background-color: #0f0f0f;
    }

    .navbar.navbar-dark .breadcrumb .nav-item .nav-link,
    .navbar.navbar-dark .navbar-nav .nav-item .nav-link {
      color: rgba(255, 255, 255, 0.88);
      -webkit-transition: .35s;
      transition: .35s;
    }

    .btn-db2 {
    background-color: #00b3ff;
    color: #FFF;
    border-radius: 50px 50px;
}

.btn-db2:hover {
    background-color: #00b3ff;
    color: #FFF;
    border-radius: 50px 50px;
}

.nav-link:hover{
  letter-spacing: 0.1em;
        text-shadow: 0 0 5px #00b3ff,
        0 0 10px #00b3ff,
        0 0 11px #00b3ff,
        0 0 18px #00b3ff;
}

::-webkit-scrollbar{
    width: 12px;
}

::-webkit-scrollbar-thumb{
    background: linear-gradient(transparent,#0084ff);
    border-radius: 6px;
}

::-webkit-scrollbar-thumb:hover{
    background: linear-gradient(transparent,#00c6ff);
}
  </style>
<!-- <script async defer crossorigin="anonymous" src="https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v6.0&appId=835012130333392&autoLogAppEvents=1"></script>
</head>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v6.0"></script> -->

<body>
  <nav class="navbar navbar-expand-md navbar-dark p-0" style="background: linear-gradient(transparent,#0084ff,#00c6ff); font-size:16px; ">
  <br>
    <div class="container-fluid">
      <a class="navbar-brand" style="font-size:18px;" href="index.php"><img src="<?=$setting["logo"]?>" width="50" height="50">&nbsp;&nbsp;<?=$setting["domain"]?></a>
<br><br>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="basicExampleNav">

        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">หน้าแรก    
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <?php while ($category = mysqli_fetch_array($sql_category)) { ?>
            <li class="nav-item">
              <a class="nav-link" href="?category=<?= $category['no'] ?>"><?= $category['name'] ?></a>
            </li>
          <?php } ?>
        </ul>
        <form action="index.php?search" method="GET" class="form-inline ml-auto">
          <div class="md-form my-0">
            <input class="form-control mr-sm-2" name="search" type="text" placeholder="ค้นหาสถานที่ท่องเที่ยว" aria-label="Search">
            <button type="submit" class="btn btn-db2"><i class="fa fa-search"></i></button>
          </div>
        </form>
      </div>

    </div>

  </nav>
  


  <?php
  if (isset($_GET["play"])) {
    include('page/play.php');
  } else
    if (isset($_GET["category"])) {
    include("page/category.php");
  } else
    if (isset($_GET["search"])) {
    $_SESSION["search"] = $_GET["search"];
    include("page/search.php");
  } else {
    include('page/home.php');
  }

  ?>
  

  <script type="text/javascript" src="js/jquery.min.js"></script>
  <div align="center">
  <script>var _uox = _uox || {};(function() {var s=document.createElement("script");
s.src="https://static.usuarios-online.com/uo2.min.js";document.getElementsByTagName("head")[0].appendChild(s);})();</script>
  </div><br><br>
  <div class="copyright text-center my-auto">
            <span>Copyright &copy; 2022. BY NATCHANON SABMEECHAI.</span>
          </div>
</body>

</html>