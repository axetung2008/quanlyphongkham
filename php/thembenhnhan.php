<?php 
	require_once('config.php');

	$conn = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);

	$name = $_POST['fname'];
	$sql = "INSERT INTO nhan_vien (ho_ten) VALUES ('abc')";

	if($conn->query($sql) == TRUE){
		echo "Them thanh cong";

	}else{
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();



 ?>