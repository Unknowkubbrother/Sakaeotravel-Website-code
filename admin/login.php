<?php
	include("../config.php");
	session_start();
	if(isset($_SESSION["admin_login"]))
	{
		header( "location: index.php" );
	}
	$nowdatetime = date('Y-m-d H:i:s');
	//$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	
		if(isset($_POST["Form-Login"]))
		{
        $md5_pass = md5($_POST["inputPassword"]);
				$sql1 = mysqli_query($sql_con, "SELECT * FROM admin WHERE user='".$_POST["inputUser"]."' and pass='".$md5_pass."'") or trigger_error();
				$sql1_query = mysqli_fetch_array($sql1);
				if( $md5_pass==$sql1_query["pass"] )
				{
					$login_permision = [99, 0];
					if(($sql1_query["permision"]==$login_permision[0]) || ($sql1_query["permision"]==$login_permision[1]))
					{
						$_SESSION["admin_login"] = "admin_db-free2u_login-success";
						$_SESSION["admin_user"] = "".$_POST["inputUser"]."";
						$_SESSION["admin_permision"] = $sql1_query["permision"];
						$sql_log = mysqli_query($sql_con, "INSERT INTO log_admin (`user`, `date`, `action`, `ip`) VALUES ('".$_SESSION["admin_user"]."', '$nowdatetime', 'Login to Admin', '$ipaddress');");
						header( "location: index.php" );
					}else
					{
						echo "<META HTTP-EQUIV='Refresh'  CONTENT='1;URL=login.php'>";
						echo "<script>alert('คุณกรอกข้อมูลไม่ถูกต้อง หรือข้อมูลนี้ไม่มีอยู่ กรุณาลองใหม่อีกครัง หรือติดต่อ Admin!'); </script>";
						exit();
					}
				} else
				{
					echo "<META HTTP-EQUIV='Refresh'  CONTENT='1;URL=login.php'>";
					echo "<script>alert('คุณกรอกข้อมูลไม่ถูกต้อง หรือข้อมูลนี้ไม่มีอยู่ กรุณาลองใหม่อีกครัง หรือติดต่อ Admin!'); </script>";
					exit();
				}
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

  <title>Admin Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Admin เข้าสู่ระบบ</div>
      <div class="card-body">
        <form action="login.php" method="POST">
		<!-- 
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="required" autofocus="autofocus">
              <label for="inputEmail">Email address</label>
            </div>
          </div>
		  -->
          <div class="form-group">
			<div class="form-label-group">
			  <input type="hidden" name="Form-Login">
              <input type="text" name="inputUser"  id="inputUser" class="form-control" placeholder="กรุณากรอกชื่อผู้ใช้" value="" required="required">
              <label for="inputPassword">ชื่อผู้ใช้</label>
            </div>
            <div class="form-label-group">
			  <input type="hidden" name="Form-Login">
              <input type="password" name="inputPassword"  id="inputPassword" class="form-control" placeholder="กรุณากรอกรหัสผ่าน" value="" required="required">
              <label for="inputPassword">รหัสผ่าน</label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block" href="index.php"><i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ</button>
          <a class="btn btn-danger btn-block" href="../"><i class="fa fa-home"></i> กลับหน้าแรก</a>
        </form>
        <div class="text-center">
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
