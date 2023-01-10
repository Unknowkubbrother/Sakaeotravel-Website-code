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
  $sql_db = mysqli_query($sql_con, 'SELECT * FROM db ORDER BY no DESC');
  $sql2 = mysqli_query($sql_con, "SELECT * FROM db");
  $sql3 = mysqli_query($sql_con, "SELECT MAX(`no`) As `no` FROM `db`");
  $sql3_query = mysqli_fetch_array($sql3);
  $db_no = $sql3_query["no"] + 1;
	
	if(isset($_POST["db_add_ok"]))
	{
		mysqli_query($sql_con, "INSERT INTO `db` (
      `no`, 
      `date`, 
      `time`, 
      `category`, 
      `name`, 
      `pic`, 
      `pic2`, 
      `pic3`, 
      `story`, 
      `story1`, 
      `sound`, 
      `video`) VALUES (
        '".$_POST["no"]."', 
        '".$_POST["date"]."', 
        '".$_POST["time"]."', 
        '".$_POST["category"]."', 
        '".$_POST["name"]."', 
        '".$_POST["pic"]."', 
        '".$_POST["pic2"]."', 
        '".$_POST["pic3"]."',
        '".$_POST["story"]."',  
        '".$_POST["story1"]."',  
        '".$_POST["sound"]."',  
        '".$_POST["video"]."');");
		echo "<META HTTP-EQUIV='Refresh'  CONTENT='0;URL=index.php'>";
		echo "<script>alert('เพิ่มข้อมูลเสร็จเรียบร้อย'); </script>";
		exit();
	}
	if(isset($_GET["edit"]))
	{
    $sql_db_category = mysqli_query($sql_con, 'SELECT * FROM category  WHERE no="'.$_GET["edit"].'" ORDER BY no ASC');
		$sql_edit = mysqli_query($sql_con, "SELECT * FROM db WHERE no = '".$_GET["edit"]."'");
		$db_edit = mysqli_fetch_array($sql_edit);
		/*if($_SESSION["admin_user"]!=$db_edit["upload_by"])
		{
			echo "<META HTTP-EQUIV='Refresh'  CONTENT='0;URL=index.php'>";
			echo "<script>alert('คุณไม่มีสิทธิ์ในเมนูนี้!'); </script>";
			exit();
		}*/
	}
	if(isset($_POST["db_edit_ok"]))
	{
		mysqli_query($sql_con, "UPDATE `db` SET 
		`category` = '".$_POST["category"]."', 
		`name` = '".$_POST["name"]."', 
		`pic` = '".$_POST["pic"]."', 
    `pic2` = '".$_POST["pic2"]."', 
    `pic3` = '".$_POST["pic3"]."', 
		`story` = '".$_POST["story"]."', 
    `story1` = '".$_POST["story1"]."', 
		`video` = '".$_POST["video"]."',
    `sound` = '".$_POST["sound"]."' WHERE `no`='".$_POST["no"]."';");
		echo "<META HTTP-EQUIV='Refresh'  CONTENT='0;URL=index.php'>";
    echo "<script>alert('แก้ไขข้อมูลเสร็จเรียบร้อย'); </script>";
    exit();
	}
	if(isset($_GET["del"]))
	{
		mysqli_query($sql_con, "DELETE FROM db WHERE no = '".$_GET["del"]."'");
		echo "<META HTTP-EQUIV='Refresh'  CONTENT='0;URL=index.php'>";
    echo "<script>alert('ลบเสร็จเรียบร้อย'); </script>";
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
            <a href="#">ภาพรวม</a>
          </li>
          <li class="breadcrumb-item active">รายการ สถานที่ท่องเที่ยว</li>
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
                <div class="mr-5">เพิ่มสถานที่</div>
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
            รายชื่อสถานที่</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr align="center">
                    <th>วันที่เพิ่ม</th>
                    <th>หมวดหมู่</th>
                    <th>ชื่อสถานที่</th>
                    <th>จัดการ</th>
                    
                  </tr>
                </thead>
                <tbody>

                <?php
                    while($row = mysqli_fetch_array($sql_db))
                    {
                      $sql_category = mysqli_query($sql_con, 'SELECT * FROM category WHERE no="'.$row["category"].'"');
                      $category = mysqli_fetch_array($sql_category);

                ?>
                  <tr>
                    
                    <td align="center" data-sort-order="desc"><?=$row["date"]?> - <?=$row["time"]?></td>
                    <td align="center"><?=$category["name"]?></td>
                    <td> <?=$row["name"]?></td>
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
            <i class="fas fa-table"></i>
            <strong>เพิ่มข้อมูล</strong></div>
          <div class="card-body col-6">
		  <form action="index.php" method="POST">
			<input type="hidden" name="db_add_ok" class="form-control">
			<input type="hidden" name="date" value="<?=date('Y-m-d')?>">
      <input type="hidden" name="time" value="<?=date('H:i')?> น.">
			<input type="hidden" name="no" value="<?=$db_no?>">
			<div class="form-inline">
      <strong>ID</strong>&nbsp;
			<input type="hidden" name="upload" value="<?=$_SESSION["admin_user"]?>" class="form-control" readonly>
      <input type="text" name="no_show" value="<?=$db_no?>" class="form-control" readonly>&nbsp;&nbsp;
      <strong>หมวดหมู่</strong>&nbsp;
				<select name="category" class="form-control">
          <?php while($db_category = mysqli_fetch_array($sql_db_category)) { ?>
					  <option value="<?=$db_category["no"]?>"><?=$db_category["name"]?></option>
          <?php } ?>
				</select>
				</div>
			<br>
            <strong>ชื่อสถานที่</strong> <input type="text" name="name" class="form-control"><br>
			<div class="form-inline">
				</div>
			<br>
			<div class="form-inline">
				</select>
				</div>
			<br>
            <strong>รูปภาพ1</strong><input type="text" name="pic" placeholder="http://www.uppic.com/img6509611.jpg" class="form-control"><br>
            <strong>รูปภาพ2</strong><input type="text" name="pic2" placeholder="http://www.uppic.com/img6509611.jpg" class="form-control"><br>
            <strong>รูปภาพ3</strong><input type="text" name="pic3" placeholder="http://www.uppic.com/img6509611.jpg" class="form-control"><br>
            <strong>คำแนะนำ</strong> <textarea name="story" id="mini_content" rows="10" cols="30" class="form-control"></textarea><br>
            <strong>ประวัติความเป็นมา</strong> <textarea name="story1" id="mini_content" rows="10" cols="30" class="form-control"></textarea><br>
              
			<script>
    tinymce.init({
	  selector: 'textarea',
	  height : "300",
      plugins: 'lists media table tinydrive ',
      toolbar: 'addcomment showcomments casechange checklist code formatpainter insertfile pageembed permanentpen table',
      //plugins: 'a11ychecker advcode casechange formatpainter linkchecker lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinydrive tinymcespellchecker',
      //toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter insertfile pageembed permanentpen table',
      toolbar_drawer: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
    });
  </script>
			
            <strong>แผนที่</strong><input type="text" name="video"  placeholder="https://www.google.com/maps" class="form-control"><br>
            <strong>เสียง</strong><input type="text" name="sound"  placeholder="audio.mp3" class="form-control"><br>
			
          </div>
          <div class="card-footer">
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
            <strong>แก้ไขข้อมูล</strong></div>
          <div class="card-body col-6">
		  <form action="index.php" method="POST">
			<input type="hidden" name="db_edit_ok" value="<?=$db_no?>" class="form-control" >
			<input type="hidden" name="no" value="<?=$db_edit["no"]?>" class="form-control" >
			<p><img src="<?=$db_edit["pic"]?>" width="250" height="auto" style="border-radius: 5px;"></p>
      <p><img src="<?=$db_edit["pic2"]?>" width="250" height="auto" style="border-radius: 5px;"></p>
      <p><img src="<?=$db_edit["pic3"]?>" width="250" height="auto" style="border-radius: 5px;"></p>
			<div class="form-inline">
			<strong>ID</strong>&nbsp;<input type="text" name="mid" value="<?=$db_edit["no"]?>" class="form-control" readonly>&nbsp;&nbsp;&nbsp;
            <strong>หมวดหมู่</strong>&nbsp;
				<select name="category" class="form-control">
        <?php
          $sql_category2 = mysqli_query($sql_con, 'SELECT * FROM category');
          while($db_category = mysqli_fetch_array($sql_category2)) {
        ?>
					<option value="<?=$db_category["no"]?>" <?php if($db_edit["category"]==$db_category["no"]) { echo "selected"; } ?>><?=$db_category["name"]?></option>
        <?php } ?>
				</select>
				</div>
			<br>
            <strong>ชื่อสถานที่</strong> <input type="text" name="name" value="<?=$db_edit["name"]?>" class="form-control"><br>
			<div class="form-inline">&nbsp;&nbsp;&nbsp;
				</div>
			<br>
				</select>
				</div>
			<br>
            <strong>รูปภาพ1</strong><input type="text" name="pic" placeholder="http://www.uppic.com/img6509611.jpg" value="<?=$db_edit["pic"]?>" class="form-control"><br>
            <strong>รูปภาพ2</strong><input type="text" name="pic2" placeholder="http://www.uppic.com/img6509611.jpg" value="<?=$db_edit["pic2"]?>" class="form-control"><br>
            <strong>รูปภาพ3</strong><input type="text" name="pic3" placeholder="http://www.uppic.com/img6509611.jpg" value="<?=$db_edit["pic3"]?>" class="form-control"><br>
            <strong>คำแนะนำ</strong> <textarea name="story" rows="10" cols="30" class="form-control"><?=$db_edit["story"]?></textarea><br>
            <strong>ประวัติความเป็นมา</strong> <textarea name="story1" rows="10" cols="30" class="form-control"><?=$db_edit["story1"]?></textarea><br>
			
			<script>
    tinymce.init({
	  selector: 'textarea',
	  height : "300",
      plugins: 'lists media table tinydrive ',
      toolbar: 'addcomment showcomments casechange checklist code formatpainter insertfile pageembed permanentpen table',
      plugins: 'a11ychecker advcode casechange formatpainter linkchecker lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinydrive tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter insertfile pageembed permanentpen table',
      default_link_target: "_blank", 
      toolbar_drawer: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
    });
  </script>
			
            <strong>แผนที่</strong><input type="text" name="video" placeholder="https://www.google.com/maps" value="<?=$db_edit["video"]?>" class="form-control"><br>
            <strong>เสียง</strong><input type="text" name="sound" placeholder="audio.mp3" value="<?=$db_edit["sound"]?>" class="form-control"><br>
			
			
          </div>
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
            <span></span>
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
