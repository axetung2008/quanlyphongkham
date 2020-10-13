<?php 
	require_once('config.php');

	$conn = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);

	$hoten = $_POST['ho_ten'];
	$diachi = $_POST['dia_chi'];
	$gioitinh = $_POST['gioi_tinh'];
	$tuoi = $_POST['tuoi'];

	$chandoan = $_POST['chan_doan'];

	$thuoc[0] = $_POST['thuoc1'];
	$thuoc[1] = $_POST['thuoc2'];
	$thuoc[2] = $_POST['thuoc3'];

	$sang[1] = $_POST['sang1'];
	$chieu[1] = $_POST['chieu1'];
	$toi[1] = $_POST['toi1'];

	$sang[2] = $_POST['sang2'];
	$chieu[2] = $_POST['chieu2'];
	$toi[2] = $_POST['toi2'];

	$sang[3] = $_POST['sang3'];
	$chieu[3] = $_POST['chieu3'];
	$toi[3] = $_POST['toi3'];

	$chiphi = $_POST['chi_phi'];

	$dulieu = array(
		array($sang[1],$chieu[1],$toi[1]),
		array($sang[2],$chieu[2],$toi[2]),
		array($sang[3],$chieu[3],$toi[3])
	);

	$flag[0]= 0;
	$flag[1]= 0;
	$flag[2]= 0;
	//$flag[3]= 0;




//Them thong tin benh nhan 
	$sql = "INSERT INTO benh_nhan(ho_ten,dia_chi,gioi_tinh,tuoi) VALUES ('$hoten','$diachi','$gioitinh','$tuoi')";

	$conn->query($sql);

//Lay id benh nhan hien tai
	$id_bn = "SELECT * FROM benh_nhan WHERE ho_ten='$hoten' and dia_chi='$diachi' and tuoi='$tuoi'";
	$ma_bn;
	$result = $conn->query($id_bn);
	if ($result->num_rows > 0) {
	  	while($row = $result->fetch_assoc()) {
	    	$ma_bn = $row["ma_benh_nhan"];
	    }
    }

//Luu don thuoc
	$donthuoc = "INSERT INTO don_thuoc(chan_doan,chi_phi,ma_benh_nhan) VALUES ('$chandoan','$chiphi','$ma_bn')";

	$conn->query($donthuoc);

//Lay id đơn thuốc của bệnh nhân đang khám
	$id_dt = "SELECT * FROM don_thuoc WHERE ma_benh_nhan='$ma_bn' ORDER BY ngay_lap DESC LIMIT 1 ";
	$ma_dt;
	$res = $conn->query($id_dt);
	if($res->num_rows > 0){
		while ($row = $res->fetch_assoc()) {
			$ma_dt = $row["ma_don_thuoc"];
		}
	}

//Lưu chi tiết đơn thuốc

//đánh số thứ tự cho những loại thuốc nhập vào
	$c = 1;
	for ($i=0; $i < 3; $i++) { 
		if($thuoc[$i]!= ""){
			$flag[$i] = $c;
		}
		$c++;
	}
//những loại thuốc cùng cách uống sẽ có chung điểm flag
	for ($i=0; $i < 3 ; $i++) {
		for ($j=$i+1; $j <= 2; $j++) { 
			if($dulieu[$i]==$dulieu[$j]){
				$flag[$i] = $flag[$j];
			}
		}
	}
	
// //những loại thuốc chung điểm flag thì sẽ được gom lại
	$tenthuoc = array();
	$cach_uong = array();
	for ($i=0; $i < 3 ; $i++) { 
		if($flag[$i] == 0){
			continue;
		}
		$temp = $thuoc[$i];
		for ($j=$i+1; $j <= 2; $j++) { 
			if(($flag[$i] == $flag[$j]) && ($flag[$j] != 0)){
				$temp = $temp . "/" . $thuoc[$j];
				$flag[$j] = 0;
			}
		}
		$flag[$i] = 0;
		$u = $sang[$i+1] . "/" . $chieu[$i+1] . "/" . $toi[$i+1];
		array_push($tenthuoc, $temp);
		array_push($cach_uong, $u);
	}

	$sum_thuoc = count($tenthuoc);
	$sum_cach = count($cach_uong);

	$t = 0;
	while($sum_thuoc != 0){	
		$thuoc = $tenthuoc[$t];
		$cach = $cach_uong[$t];
		$chitiet = "INSERT INTO chi_tiet_don_thuoc(ten_thuoc,ma_don_thuoc,cach_uong) VALUES ('$thuoc','$ma_dt','$cach')";
		$conn->query($chitiet);
		$t++;
		$sum_thuoc--;

	}

	$conn->close();



 ?>