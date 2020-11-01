<?php
  require_once 'config.php';

	$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);

	$tenbenhnhan = $_POST['query'];
  	if (isset($tenbenhnhan)) {
      $sql = "SELECT * FROM benh_nhan WHERE ho_ten LIKE '$tenbenhnhan%'";

      $result = $conn->query($sql);
      if($result->num_rows > 0) {
      	while ($row = $result->fetch_assoc()){
      		echo '<tr>'. 
      				'<td style="padding: 8px;width: 100px">' . $row['ho_ten'] . '</td>' .
      				'<td style="padding: 8px;width: 150px;padding-left: 50px">' . $row['dia_chi'] . '</td>' .
      				'<td style="padding: 8px;padding-left: 80px">' . $row['tuoi'] . '</td>' .
      				'<td>' . '<form method="post" action="./php/timdonthuoc.php">' . '<input type="hidden" name="idbn" value="' . $row['ma_benh_nhan'] .'">' . '<button>Xem chi tiet</button></form>' . '</td>' .
      			 '</tr>';
      	}
      }
      else{
      	echo '<p class="list-group-item border-1">No Record</p>';
      }
  	}
  
?>