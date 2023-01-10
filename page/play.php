<?php
require('config.php');

$sql_db_recommend = mysqli_query($sql_con, 'SELECT * FROM db') or die();
$sql_db_error = mysqli_query($sql_con, 'SELECT * FROM db WHERE no="' . $_GET["play"] . '"') or die();
$setting = mysqli_fetch_array($sql_db_error);
if($setting["no"]==0)
{
  echo "<META HTTP-EQUIV='Refresh'  CONTENT='0;URL=index.php'>";
  echo "<script>alert('ไม่มีหน้าที่คุณเข้าชม!'); </script>";
  exit();
}
$sql_db = mysqli_query($sql_con, 'SELECT * FROM db WHERE no="' . $_GET["play"] . '"') or die();
$sql_setting = mysqli_query($sql_con, 'SELECT * FROM setting') or die();
$setting = mysqli_fetch_array($sql_setting);
$sql_db1 = mysqli_query($sql_con, 'SELECT * FROM db WHERE no='.$setting["db_hot1"].' ORDER BY no DESC') or die();
$sql_db2 = mysqli_query($sql_con, 'SELECT * FROM db WHERE no='.$setting["db_hot2"].' ORDER BY no DESC') or die();
$sql_db3 = mysqli_query($sql_con, 'SELECT * FROM db WHERE no='.$setting["db_hot3"].' ORDER BY no DESC') or die();
$sql_db4 = mysqli_query($sql_con, 'SELECT * FROM db WHERE no='.$setting["db_hot4"].' ORDER BY no DESC') or die();
$db1 = mysqli_fetch_array($sql_db1);
$db2 = mysqli_fetch_array($sql_db2);
$db3 = mysqli_fetch_array($sql_db3);
$db4 = mysqli_fetch_array($sql_db4);

$db = mysqli_fetch_array($sql_db);


?>

<head>
<link rel="stylesheet" href="css/soundtext.css">
</head>
<body>
  <div class="back">
<div class="container mt-4">
  <div class="card mb-4" style="background-color:rgba(15,15,15,0.93);">
    <div class="card-body">
      <div class="row">
        <h1 class="text-white" style="margin-left:10px ; border-left:7px solid #FF0070;">&nbsp;&nbsp<?= $db["name"] ?></h1><br><br>
      </div>
      <br>
      <div class="row">
        <div class="col-12 col-sm-12 col-md-4 col-lg-4">
        <div class="flex">
          <img src="<?= $db["pic"] ?>" width="100%" style="border-radius: 5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?= $db["pic2"] ?>" width="100%" style="border-radius: 5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?= $db["pic3"] ?>" width="100%" style="border-radius: 5px;">
        </div>
        </div>
		<br><br>
          <div class="card mb-4" style="background-color:rgba(15,15,15,0.93);">
    <div class="card-body">
      <div class="flex">
      <span class="text-white" style="font-size:20px; border-left:7px solid #0061FF;">&nbsp;&nbsp;&nbsp;คำแนะนำ</span>&nbsp;&nbsp;<button onclick="audio.play();" class="soundbutton"><i class="fas fa-volume-up"></i></button>
      <br>
      <br>
      <script type="text/javascript">
        const audio = new Audio();
        audio.src = "./sound/<?= $db["sound"] ?>"
      </script>
    </div>
    <br>
      <span class="text-white">
        <?= $db["story"] ?>
      </span>
      <br>
      <span class="text-white" style="font-size:18px; border-left:7px solid #9672ea;">&nbsp;&nbsp;&nbsp;ประวัติความเป็นมา</span>
      <span class="text-white">
        <?= $db["story1"] ?>
      </span>
    </div>
  </div>

    </div>
  </div>
  <div class="embed-responsive embed-responsive-16by9 mb-0">
    <iframe src="<?= $db["video"] ?>" width="100%" height="100%" frameborder="0" scrolling="no" allowfullscreen></iframe>
  </div>
      
    </div>
  </div>

<div class="back1">
  <span class="text-white" style="font-size:18px; border-left:4px solid #9672ea;">&nbsp;&nbsp;&nbsp;แนะนำ</span>
  <div class="row mb-4" style="margin-top:20px;">
  <?php if($setting["db_hot1"]!=0) { ?>
            <div class="col-sm-3 col-6">
              <div class="db_grid">
                <a class="db_col" href="?play=<?= $db1["no"] ?>">
                  <img class="img-thumbnail db_img mb-2" style="border:none;" src="<?= $db1["pic"] ?>"></a>
                <div class="db_title"><?= $db1["name"] ?></div>
              </div>
            </div>
        <?php } ?>
        <?php if($setting["db_hot2"]!=0) { ?>
            <div class="col-sm-3 col-6">
              <div class="db_grid">
                <a class="db_col" href="?play=<?= $db2["no"] ?>">
                  <img class="img-thumbnail db_img mb-2" style="border:none;" src="<?= $db2["pic"] ?>"></a>
                <div class="db_title"><?= $db2["name"] ?></div>
              </div>
            </div>
        <?php } ?>
        <?php if($setting["db_hot3"]!=0) { ?>
            <div class="col-sm-3 col-6">
              <div class="db_grid">
                <a class="db_col" href="?play=<?= $db3["no"] ?>">
                  <img class="img-thumbnail db_img mb-2" style="border:none;" src="<?= $db3["pic"] ?>"></a>
                <div class="db_title"><?= $db3["name"] ?></div>
              </div>
            </div>
        <?php } ?>
        <?php if($setting["db_hot4"]!=0) { ?>
            <div class="col-sm-3 col-6">
              <div class="db_grid">
                <a class="db_col" href="?play=<?= $db4["no"] ?>">
                  <img class="img-thumbnail db_img mb-2" style="border:none;" src="<?= $db4["pic"] ?>"></a>
                <div class="db_title"><?= $db4["name"] ?></div>
              </div>
            </div>
        <?php } ?>
  </div>
  </div>
  <div class="row mb-4" style="margin-top:20px;">
</div>
</div>