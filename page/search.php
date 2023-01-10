<?php
require('config.php');
$var_search = $_SESSION["search"] = $_GET["search"];
$sql_db = mysqli_query($sql_con, 'SELECT * FROM `db` WHERE `name` LIKE "%' . $var_search . '%"');


?>
<div class="container mt-4">
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">


        <!-- db -->

        <span class="text-white" style="font-size:18px; border-left:4px solid #9672ea;">&nbsp;&nbsp;&nbsp;ผลการค้นหา [ <?= htmlspecialchars($_SESSION["search"]) ?> ]</span>
        <div class="row" style="margin-top:20px;">

          <?php while ($db = mysqli_fetch_array($sql_db)) { ?>
            <div class="col-sm-3 col-6">
              <div class="db_grid">
                <a class="db_col" href="?play=<?= $db["no"] ?>">
                  <img class="img-thumbnail db_img mb-2" style="border:none;" src="<?= $db["pic"] ?>"></a>
                <div class="db_title"><?= $db["name"] ?></div>
              </div>
            </div>
          <?php } ?>

        </div>
      </div>
    </div>
  </div>
  <br><br>
</div>
<?php unset($_SESSION["search"]); ?>