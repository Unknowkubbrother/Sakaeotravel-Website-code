<?php
  include("../config.php");
	session_start();
	if(!isset($_SESSION["admin_login"]))
	{
		header( "location: login.php" );
	}
	if(isset($_GET["logout"]))
	{
		unset($_SESSION["admin_login"]);
		unset($_SESSION["admin_user"]);
		unset($_SESSION["admin_permision"]);
		header( "location: login.php" );
  }
  $sql_admin_login = mysqli_query($sql_con, 'SELECT * FROM admin WHERE user="'.$_SESSION["admin_user"].'"') or die();
  $admin_login = mysqli_fetch_array($sql_admin_login);
  $sql_db1 = mysqli_query($sql_con, 'SELECT * FROM db ORDER BY no DESC') or die();
  $sql_db2 = mysqli_query($sql_con, 'SELECT * FROM db ORDER BY no DESC') or die();
  $sql_db3 = mysqli_query($sql_con, 'SELECT * FROM db ORDER BY no DESC') or die();
  $sql_db4 = mysqli_query($sql_con, 'SELECT * FROM db ORDER BY no DESC') or die();
  $sql_setting = mysqli_query($sql_con, 'SELECT * FROM setting') or die();
  $setting = mysqli_fetch_array($sql_setting);

	if(isset($_POST["setting_save"]))
	{
		mysqli_query($sql_con, "UPDATE `setting` SET 
		`title` = '".$_POST["title"]."', 
		`domain` = '".$_POST["domain"]."', 
		`logo` = '".$_POST["logo"]."', 
		`keywords` = '".$_POST["keywords"]."', 
		`description` = '".$_POST["description"]."', 
		`slide1_img` = '".$_POST["slide1_img"]."', 
    `slide2_img` = '".$_POST["slide2_img"]."', 
    `slide3_img` = '".$_POST["slide3_img"]."', 
		`db_hot1` = '".$_POST["db_hot1"]."', 
    `db_hot2` = '".$_POST["db_hot2"]."', 
    `db_hot3` = '".$_POST["db_hot3"]."', 
		`db_hot4` = '".$_POST["db_hot4"]."'");
		echo "<META HTTP-EQUIV='Refresh'  CONTENT='0;URL=setting.php'>";
    echo "<script>alert('แก้ไขการตั้งค่า เสร็จเรียบร้อย'); </script>";
    exit();
	}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="../img/ico.png" />

  <title>Admin</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  
  <!-- Tyint MCE Text Editor -->
	<!--<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>-->
	<script src="https://cdn.tiny.cloud/1/4rrromyrz2x6qf69qzgg5ck6x9975sbdv4j9dhd1sw0nao1w/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	<!-- <script>tinymce.init({selector:'textarea'});</script> -->
	
  


</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php">แผงควบคุม</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>


  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <?php require('menu.php'); ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">ตั้งค่า</a>
          </li>
          <li class="breadcrumb-item active">ตั้งค่า เว็บ</li>
        </ol>

        <!-- Setting -->
        <form action="setting.php" method="POST">
        <h4><i class="far fa-sun"></i> ตั้งค่าทั่วไป</h4>
        <div class="col-12 col-md-6 col-lg-6">
          <label style="font-weight: bold">ภาพโลโก้เว็บ</label>
		        <input name="logo" value="<?=$setting["logo"]?>" placeholder="http://www.mysite.com/logo.png" class="form-control"><br>
          <label style="font-weight: bold">ชื่อ Title หัวเว็บ</label>
		        <input name="title" value="<?=$setting["title"]?>" placeholder="ชื่อ Title หัวเว็บ" class="form-control"><br>
          <label style="font-weight: bold">ชื่อ Domain เว็บ</label>
		        <input name="domain" value="<?=$setting["domain"]?>" placeholder="MyVideoSite.com" class="form-control"><br>
        </div>
        <hr>
        <h4><i class="fas fa-search-dollar"></i> ตั้งค่า SEO</h4>
        <div class="col-12 col-md-6 col-lg-6">
          <label style="font-weight: bold">Keywords</label>
		        <input name="keywords" value="<?=$setting["keywords"]?>" placeholder="MyVideoSite.com" class="form-control"><br>
          <label style="font-weight: bold">Description</label>
		        <input name="description" value="<?=$setting["description"]?>" placeholder="MyVideoSite.com" class="form-control"><br>
        </div>
        <hr>
        <h4><i class="far fa-images"></i> ตั้งค่า ภาพสไลด์</h4>
        <div class="col-12 col-md-6 col-lg-6">
          <label style="font-weight: bold">ภาพสไลด์ที่ 1</label>
            <input name="slide1_img" value="<?=$setting["slide1_img"]?>" placeholder="MyVideoSite.com" class="form-control"><br>
          <label style="font-weight: bold">ภาพสไลด์ที่ 2</label>
            <input name="slide2_img" value="<?=$setting["slide2_img"]?>" placeholder="MyVideoSite.com" class="form-control"><br>
          <label style="font-weight: bold">ภาพสไลด์ที่ 3</label>
		        <input name="slide3_img" value="<?=$setting["slide3_img"]?>" placeholder="MyVideoSite.com" class="form-control"><br>
        </div>
        <hr>
        <h4><i class="fas fa-video"></i> ตั้งค่า แนะนำ</h4>
        <div class="col-12 col-md-12 col-lg-12">
          <div class="form-inline">
          <label style="font-weight: bold">เรื่องที่ 1</label>&nbsp;&nbsp;&nbsp;&nbsp;
            <select name="db_hot1" class="form-control">
              <?php if($setting["db_hot1"]==0) {?><option value="0" selected>=== กรุณาเลือก ===</option><?php }?>
              <option value="0">------ ปิดการใช้งาน ------</option>
              <?php while($db_hot1 = mysqli_fetch_array($sql_db1)) { ?>
                <option value="<?=$db_hot1["no"]?>" <?php if($setting["db_hot1"]==$db_hot1["no"]) { echo "selected"; }?>><?=$db_hot1["name"]?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-inline">
          <label style="font-weight: bold">เรื่องที่ 2</label>&nbsp;&nbsp;&nbsp;&nbsp;
            <select name="db_hot2" class="form-control">
              <?php if($setting["db_hot2"]==0) {?><option value="0" selected>=== กรุณาเลือก ===</option><?php } ?>
              <option value="0">------ ปิดการใช้งาน ------</option>
              <?php while($db_hot2 = mysqli_fetch_array($sql_db2)) { ?>
                <option value="<?=$db_hot2["no"]?>"  <?php if($setting["db_hot2"]==$db_hot2["no"]) { echo "selected"; }?>><?=$db_hot2["name"]?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-inline">
          <label style="font-weight: bold">เรื่องที่ 3</label>&nbsp;&nbsp;&nbsp;&nbsp;
            <select name="db_hot3" class="form-control">
              <?php if($setting["db_hot3"]==0) {?><option value="0" selected>=== กรุณาเลือก ===</option><?php } ?>
              <option value="0">------ ปิดการใช้งาน ------</option>
              <?php while($db_hot3 = mysqli_fetch_array($sql_db3)) { ?>
                <option value="<?=$db_hot3["no"]?>"  <?php if($setting["db_hot3"]==$db_hot3["no"]) { echo "selected"; }?>><?=$db_hot3["name"]?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-inline">
          <label style="font-weight: bold">เรื่องที่ 4</label>&nbsp;&nbsp;&nbsp;&nbsp;
            <select name="db_hot4" class="form-control">
              <?php if($setting["db_hot4"]==0) {?><option value="0" selected>=== กรุณาเลือก ===</option><?php } ?>
              <option value="0">------ ปิดการใช้งาน ------</option>
              <?php while($db_hot4 = mysqli_fetch_array($sql_db4)) { ?>
                <option value="<?=$db_hot4["no"]?>"  <?php if($setting["db_hot4"]==$db_hot4["no"]) { echo "selected"; }?>><?=$db_hot4["name"]?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <hr>
        <input type="hidden" name="setting_save">
        <button type="submit" class="btn btn-primary"><i class="fa fa-plus-square"></i> บันทึก</button>
        <hr>
              </form>
		
		
      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; 2022. All rights reserved.</span>
          </div>
        </div>
      </footer>

    </div>
	
	
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>

</body>

</html>
