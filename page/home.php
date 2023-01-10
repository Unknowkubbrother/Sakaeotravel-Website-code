<?php
require('config.php');

$sql_db = mysqli_query($sql_con, 'SELECT * FROM db ORDER BY story DESC') or die();
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


?>
<head>
<link rel="stylesheet" href="css/edit.css">
</head>
<body>
<div class="container mt-4">
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <div id="carousel-example-1z" class="carousel slide carousel-fade mb-5" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-1z" data-slide-to="1"></li>
            <li data-target="#carousel-example-1z" data-slide-to="2"></li>
          </ol>
          <div class="titlecenter">
            <div class="box">
              <div class="lightbar"></div>
              <div class="topLayer"></div>
              <h1>สถานที่ท่องเที่ยวในจังหวัดสระแก้ว</h1>
          </div>
        </div>
        <br>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block w-100" src="<?=$setting["slide1_img"]?>" width="1200" height="auto" alt="First slide" style="border-radius:10px;">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?=$setting["slide2_img"]?>" width="1200" height="auto" alt="Second slide" style="border-radius:10px;">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?=$setting["slide3_img"]?>" width="1200" height="auto" alt="Third slide" style="border-radius:10px;">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        <span class="text-white" style="font-size:18px; border-left:4px solid #d4252c;">&nbsp;&nbsp;&nbsp;แนะนำ</span>
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
        <span class="text-white" style="font-size:18px; border-left:4px solid #d4252c;">&nbsp;&nbsp;&nbsp;สถานที่ท่องเที่ยวในจังหวัดสระแก้ว</span>
        <div class="row mb-4" style="margin-top:20px;">

          <?php while ($db_show = mysqli_fetch_array($sql_db)) { ?>
            <div class="col-sm-3 col-6">
              <div class="db_grid">
                <a class="db_col" href="?play=<?= $db_show["no"] ?>">
                  <img class="img-thumbnail db_img mb-2" style="border:none;" src="<?= $db_show["pic"] ?>"></a>>
                <div class="db_title"><?= $db_show["name"] ?></div>
              </div>
            </div>
          <?php } ?>

        </div>

        <!-- สถานที่ท่องเที่ยวในจังหวัดสระแก้ว -->

      </div>
    </div>
  </div>
  <br><br>
</div>
<body>