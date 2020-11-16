<?php 
	include('config.php');

	$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
	
	$thuoc = $_POST['query'];
  	if (isset($thuoc)) {

    	$sql = "SELECT * FROM thuoc WHERE ten_thuoc LIKE '$thuoc%'";

	    $result = $conn->query($sql);
	    if($result->num_rows > 0) {
	    	while ($row = $result->fetch_assoc()){
	    		echo '<tr>' .
					 '<th>'	.
					 	$row['ma_thuoc'] .
					 '</th>' . 
					 '<th>' .
					 	$row['ten_thuoc'] .
					 '</th>' .
					 '</tr>';
	    	}
	    }

  	}else{
  		$sql = "SELECT * FROM thuoc";

  		$result = $conn->query($sql);
	    if($result->num_rows > 0) {
	    	while ($row = $result->fetch_assoc()){
	    		echo '<tr>' .
					 '<th>'	.
					 	$row['ma_thuoc'] .
					 '</th>' . 
					 '<th>' .
					 	$row['ten_thuoc'] .
					 '</th>' .
					 '</tr>';
	    	}
	    }
  	}


 ?>