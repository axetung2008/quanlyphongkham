<?php
	require_once('./php/config.php');
// Create connection
	$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);

	$id_bn = $_POST['ma_bn'];
	$hoten = $_POST['hoten'];
	$diachi = $_POST['diachi'];
	$chandoan = $_POST['chandoan'];

	$id_dt = $_POST['ma_dt'];
	$thuoc[0] = $_POST['thuoc1'];
	$thuoc[1] = $_POST['thuoc2'];
	$thuoc[2] = $_POST['thuoc3'];
	$thuoc[3] = $_POST['thuoc4'];

	$count = 0;
	for ($i=0; $i < 4; $i++) { 
		if($thuoc[$i] != "") $count++;
	}

	$sang[1] = $_POST['sang1'];
	$chieu[1] = $_POST['chieu1'];
	$toi[1] = $_POST['toi1'];

	$sang[2] = $_POST['sang2'];
	$chieu[2] = $_POST['chieu2'];
	$toi[2] = $_POST['toi2'];

	$sang[3] = $_POST['sang3'];
	$chieu[3] = $_POST['chieu3'];
	$toi[3] = $_POST['toi3'];

	$sang[4] = $_POST['sang4'];
	$chieu[4] = $_POST['chieu4'];
	$toi[4] = $_POST['toi4'];

	$du_lieu = array(
		array($sang[1],$chieu[1],$toi[1]),
		array($sang[2],$chieu[2],$toi[2]),
		array($sang[3],$chieu[3],$toi[3]),
		array($sang[4],$chieu[4],$toi[4])

	);
//đánh số cho những loại thuốc nhập vào
	$flag[0]= 0;
	$flag[1]= 0;
	$flag[2]= 0;
	$flag[3]= 0;

	$c = 1;
	for ($i=0; $i < 4; $i++) { 
		if($thuoc[$i]!= ""){
			$flag[$i] = $c;
		}
		$c++;
	}

//những loại thuốc cùng cách uống sẽ có chung điểm flag
	for ($i=0; $i < 4 ; $i++) {
		for ($j=$i+1; $j <= 3; $j++) { 
			if($du_lieu[$i]==$du_lieu[$j]){
				$flag[$i] = $flag[$j];
			}
		}
	}
	// for ($i=0; $i < 4; $i++) { 
	// 	echo $flag[$i];
	// }
	
//những loại thuốc chung điểm flag thì sẽ được gom lại
	$tenthuoc = array();
	$cach_uong = array();
	for ($i=0; $i < 4 ; $i++) { 
		if($flag[$i] == 0){
			continue;
		}
		$temp = $thuoc[$i];
		for ($j=$i+1; $j <= 3; $j++) { 
			if(($flag[$i] == $flag[$j]) && ($flag[$j] != 0)){
				$temp = $temp . "/" . $thuoc[$j];
				$flag[$j] = 0;
			}
		}
		$flag[$i] = 0;
		array_push($tenthuoc, $temp);
		array_push($cach_uong, array($sang[$i+1],$chieu[$i+1],$toi[$i+1]));
	}


//Debug
	// if(check(1,2)){
	// 	echo "True";
	// }
	echo "test";
//Lưu lên cơ sở dữ liệu
	//lưu thông tin bệnh nhân
	// $benhnhan = "INSERT INTO benhnhan(ma_benh_nhan,ho_ten,dia_chi,chan_doan) VALUES ('$id_bn','$hoten','$diachi','$chandoan')";

	// $thuoc = array("$thuoc1","$thuoc2","$thuoc3","$thuoc4");
	// $str = $thuoc[0] . "/" . $thuoc[1] . "/" . $thuoc[2] . "/" . $thuoc[3];

	// $sql = "INSERT INTO test(ten_thuoc,cach_uong) VALUES ('$str','$uong1')";
	// if (mysqli_query($conn, $sql)) {
 //    	echo "New record created successfully";
	// } else {
 //    	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	// }
	mysqli_close($conn);
?>
