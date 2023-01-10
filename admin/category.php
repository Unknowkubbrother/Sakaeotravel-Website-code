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
  $sql_admin_login = mysqli_query($sql_con, 'SELECT * FROM admin WHERE user="'.$_SESSION["admin_user"].'"');
  $admin_login = mysqli_fetch_array($sql_admin_login);
  $sql_db = mysqli_query($sql_con, 'SELECT * FROM category ORDER BY no DESC');
  $sql2 = mysqli_query($sql_con, "SELECT * FROM db");
  $sql_category = mysqli_query($sql_con, "SELECT MAX(`no`) As `no` FROM `category`");
  $category = mysqli_fetch_array($sql_category);
  $category_no = $category["no"] + 1;
	
	if(isset($_POST["db_add_ok"]))
	{
		mysqli_query($sql_con, "INSERT INTO `category` (
      `no`, 
      `name`, 
      `enabled`) VALUES (
        '".$_POST["no"]."', 
        '".$_POST["name"]."', 
        '".$_POST["enabled"]."');");
		echo "<META HTTP-EQUIV='Refresh'  CONTENT='0;URL=category.php'>";
		echo "<script>alert('เพิ่ม หมวดหมู่ เสร็จเรียบร้อย'); </script>";
		exit();
	}
	if(isset($_GET["edit"]))
	{
    $sql_db_category = mysqli_query($sql_con, 'SELECT * FROM category  WHERE no="'.$_GET["edit"].'" ORDER BY no ASC');
		$sql_edit = mysqli_query($sql_con, "SELECT * FROM category WHERE no = '".$_GET["edit"]."'");
		$db_edit = mysqli_fetch_array($sql_edit);
		/*if($_SESSION["admin_user"]!=$db_edit["upload_by"])
		{
			echo "<META HTTP-EQUIV='Refresh'  CONTENT='0;URL=index.php'>";
			echo "<script>alert('คุณไม่มีสิทธิ์ในเมนูนี้!'); </script>";
			exit();
		}*/
	}
	if(isset($_POST["category_edit_ok"]))
	{
		mysqli_query($sql_con, "UPDATE `category` SET 
		`name` = '".$_POST["name"]."', 
		`enabled` = '".$_POST["enabled"]."' WHERE `no`='".$_POST["no"]."';");
		echo "<META HTTP-EQUIV='Refresh'  CONTENT='0;URL=category.php'>";
    echo "<script>alert('แก้ไข หมวดหมู่ เสร็จเรียบร้อย'); </script>";
    exit();
	}
	if(isset($_GET["del"]))
	{
		mysqli_query($sql_con, "DELETE FROM category WHERE no = '".$_GET["del"]."'");
		echo "<META HTTP-EQUIV='Refresh'  CONTENT='0;URL=category.php'>";
    echo "<script>alert('ลบ หมวดหมู่ เสร็จเรียบร้อย'); </script>";
    exit();
	}
  //} else

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

    <!-- Navbar Search -->
    <!-- <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="ค้นหาหนัง..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <?php require('menu.php'); ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">หมวดหมู่</a>
          </li>
          <li class="breadcrumb-item active">หมวดหมู่</li>
        </ol>

        <!-- Icon Cards-->
        <?php if(!isset($_GET["add_db"])) { ?>
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3" id="db_add">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-plus-square"></i>
                </div>
                <div class="mr-5">เพิ่มหมวด</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="?add_db">
                <span class="float-left">คลิก</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
        </div>
        <?php } ?>

        <!-- DataTables Example -->
		<?php
		if(!isset($_GET["edit"]) && !isset($_GET["add_db"]))
		{
		?>
        <div class="card mb-3" id="db_list">
          <div class="card-header">
            <i class="fas fa-table"></i>
            รายชื่อหมวด</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr align="center">
                    <th>ลำดับที่</th>
                    <th>ชื่อหมวดหมู่</th>
                    <th>เปิดใช้งาน</th>
                    <th>การจัดการ</th>
                  </tr>
                </thead>
                <tbody>

                <?php while($row = mysqli_fetch_array($sql_db)){ ?>
                  <tr>
                    <td align="center"><?=$row["no"]?></td>
                    <td align="center"><?=$row["name"]?></td>
                    <td align="center"><?=$row["enabled"]?></td>
                    <td align="center">
                        <a href="../index.php?db=<?=$row["mid"]?>" target="_blank" title="ดูหน้าลิงค์"><i class="fa fa-eye"> </i></a>&nbsp;&nbsp;
                         <?php //if($_SESSION["admin_user"] ==  "Admin") { ?>
						<a href="?edit=<?=$row["no"]?>" title="แก้ไข"><i class="fa fa-edit"> </i></a>&nbsp;&nbsp;
                        <a href="?del=<?=$row["no"]?>"  data-toggle="modal" data-target="#delModal<?=$row["no"]?>" style="color: red;" title="ลบ"><i class="fa fa-trash"></i></a>
						<?php //} ?>
                    </td>
                      <!-- Logout Modal-->
                            <div class="modal fade" id="delModal<?=$row["no"]?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">คุณกำลังจะลบ?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                    </button>
                                  </div>
                                <div class="modal-body">คุณต้องการลบ <b style="color: red;"><?=$row["name"]?></b> ใช่หรือไม่?</div>
                                  <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
                                    <a class="btn btn-primary" href="?del=<?=$row["no"]?>">ใช่ ฉันยืนยัน</a>
                                  </div>
                                </div>
                                </div>
                            </div>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted"></div>
        </div>
		<?php } ?>
		
		<!-- db Add Table Code Start-->
		<?php
		if(isset($_GET["add_db"]))
		{
      $sql_db_category = mysqli_query($sql_con, 'SELECT * FROM category ORDER BY no ASC');
		?>
        <div class="card mb-3" id="db_add_tb">
          <div class="card-header">
            <i class="fas fa-sitemap"></i>
            <strong>เพิ่ม หมวดหมู่</strong></div>
          <div class="card-body col-6">
		  <form action="category.php" method="POST">
			<input type="hidden" name="db_add_ok" class="form-control">
			<br>
            <strong>ชื่อหมวดหมู่</strong> <input type="text" name="name" class="form-control"><br>

          </div>
          <div class="card-footer">
          <input type="hidden" name="no" value="<?=$category_no?>">
          <input type="hidden" name="enabled" value="1">
			<button type="submit" class="btn btn-primary"> <i class="fa fa-plus-square"></i> เพิ่มข้อมูล</button>
			<button type="reset" class="btn btn-danger" id="db_add_cancle" onclick="javascript:window.location='';">ยกเลิก</button>
		  
		  </div>
		  </form>
        </div>
		<?php } ?>
		<!-- db Add Table Code End -->
		
		<?php
		if(isset($_GET["edit"]))
		{
		?>
		
		<!-- db Edit Table Code Start-->
        <div class="card mb-3" id="db_edit">
          <div class="card-header">
            <i class="fas fa-table"></i>
            <strong>แก้ไข หมวดหมู่</strong></div>
          <div class="card-body col-6">
		  <form action="category.php" method="POST">
			<input type="hidden" name="category_edit_ok" value="<?=$db_no?>" class="form-control" >
			<input type="hidden" name="no" value="<?=$db_edit["no"]?>" class="form-control" >
			<div class="form-inline">
			    <strong>ID</strong>&nbsp;<input type="text" name="mid" value="<?=$db_edit["no"]?>" class="form-control" readonly>&nbsp;&nbsp;&nbsp;
          <input type="radio" name="enabled" value="0" <?php if($db_edit["enabled"]==0) { echo "checked"; }?>>&nbsp;
          <label for="male">ปิดใช้งาน</label>&nbsp;&nbsp;&nbsp;
          <input type="radio" name="enabled" value="1" <?php if($db_edit["enabled"]==1) { echo "checked"; }?>>&nbsp;
          <label for="female">เปิดใช้งาน</label>
				</div>
			<br>
            <strong>ชื่อ หมวดหมู่</strong> <input type="text" name="name" value="<?=$db_edit["name"]?>" class="form-control"><br>
			
          <div class="card-footer">
			<button type="submit" class="btn btn-primary"> <i class="fa fa-plus-square"></i> บันทึก</button>
			<button type="reset" class="btn btn-danger"  onclick="javascript:window.location='index.php';">ยกเลิก</button>
		  
		  </div>
		  </form>
        </div>
		<!-- db Edit Table Code End -->
		
		<?php } ?>
		
		
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
