<?php
  require_once 'config.php';

	$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);

	$thuoc = $_POST['query'];
  	if (isset($thuoc)) {
      $sql = "SELECT ten_thuoc FROM thuoc WHERE ten_thuoc LIKE '$thuoc%'";

      $result = $conn->query($sql);
      if($result->num_rows > 0) {
      	while ($row = $result->fetch_assoc()){
      		echo '<a href="javascript:void(0)" class="list-group-item list-group-item-action border-1">' . $row['ten_thuoc'] . '</a>';
      	}
      }

    }

?>