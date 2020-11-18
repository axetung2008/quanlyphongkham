<?php
	require_once('config.php');

	$conn = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
	mysqli_set_charset($conn,"utf8");
	$madt = $_POST['newid'];

  	$sql = "SELECT * FROM don_thuoc WHERE ma_don_thuoc='$madt'";
  	$res = mysqli_query($conn,$sql);
  	$mabn;
  	$chiphi;
	if($res->num_rows > 0){
		while ($row = $res->fetch_assoc()) {
			$mabn = $row["ma_benh_nhan"];
			$chiphi = $row["chi_phi"];
		}
	}

	$sql1 = "SELECT * FROM benh_nhan WHERE ma_benh_nhan='$mabn'";
	$res = mysqli_query($conn,$sql1);
	$hoten;
	if($res->num_rows > 0){
		while ($row = $res->fetch_assoc()){
			$hoten = $row["ho_ten"];
		}
	}

	echo '<tr>' . '<th><h4>Họ tên: ' . $hoten . '</h4></th>' . '</tr>';
	echo '<tr>' . '<th><h4>Chi phí: ' . $chiphi . '</h4></th>' . '</tr>';




  	




?>