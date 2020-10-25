<?php 
	include('config.php');

	$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
	
	$thuoc = $_POST['query'];
  	if (isset($contry)) {

    	$sql = "SELECT ten_thuoc FROM thuoc WHERE ten_thuoc LIKE '$thuoc%'";

	    $result = $conn->query($sql);
	    if($result->num_rows > 0) {
	    	while ($row = $result->fetch_assoc()){
	    		echo '<a href="#" class="list-group-item list-group-item-action border-1">' . $row['country_name'] . '</a>';
	    	}
	    }
	    else{
	    	echo '<p class="list-group-item border-1">No Record</p>';
	    }

  	}


 ?>