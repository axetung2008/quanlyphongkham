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

	$sql = "INSERT INTO benh_nhan(ho_ten,dia_chi,gioi_tinh,tuoi) VALUES ('$hoten','$diachi','$gioitinh','$tuoi')";

	$conn->query($sql);
	// if($conn->query($sql) == TRUE){
	// 	header("location: ../khambenh.php");

	// }else{
	// 	echo "Error: " . $sql . "<br>" . $conn->error;
	// }

	$id_bn = "SELECT * FROM benh_nhan WHERE ho_ten='$hoten' and dia_chi='$diachi' and tuoi='$tuoi'";
	$ma_bn;
	$result = $conn->query($id_bn);
	if ($result->num_rows > 0) {
  	// output data of each row
	  	while($row = $result->fetch_assoc()) {
	    	$ma_bn = $row["ma_benh_nhan"];
	    }
    }



	$donthuoc = "INSERT INTO don_thuoc(chan_doan,chi_phi,ma_benh_nhan) VALUES ('$chandoan','$chiphi','$ma_bn')";

	$conn->query($donthuoc);
	if($conn->query($donthuoc) == TRUE){
		header("location: ../khambenh.php");
	}else{
		echo "Error:" .$donthuoc . "<br>" . $conn->error;
	}
	$conn->close();



 ?>