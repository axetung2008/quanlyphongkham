<?php
	include('config.php');

	session_start();

	$user = $_POST['username'];
	$pass = $_POST['password'];

	$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);

	$sql = "SELECT * FROM member where user='$user' and password='$pass'";

	$result = mysqli_query($conn,$sql);


	if(mysqli_num_rows($result) > 0){
		$member = mysqli_fetch_assoc($result);
		$_SESSION['user'] = $member['user'];
		header("location: ../chucnang.php");
		exit();
	}else{
		header("location: login.html");
		exit();
		
	}
?>