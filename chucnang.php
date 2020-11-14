<?php
	session_start();
	if(!isset($_SESSION['user'])){
		header("location: index.html");
		exit();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Quản lý phòng khám</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="./css/chucnang.css">
  
</head>
<body>

	<div class="container">
		<a href="./khambenh.php">
			<div class="card">
				<div class="face face1">
						<div class="content">
							<img src="./img/doctor.png">
							<h3>Khám bệnh</h3>
						</div>					
				</div>
				<div class="face face2">
				</div>
			</div>		
		</a>
		<a href="">
			<div class="card">
				<div class="face face1">
						<div class="content">
							<img src="./img/document.png">
							<h3>Bệnh án</h3>
						</div>					
				</div>
				<div class="face face2">
				</div>
			</div>	
		</a>
		<a href="./php/logout.php">
			<div class="card">
				<div class="face face1">
						<div class="content">
							<img src="./img/log-out.png">
							<h3>Đăng xuất</h3>
						</div>					
				</div>
				<div class="face face2">
				</div>
			</div>		
		</a>
	</div>


</body>
</html>