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
      				'<td style="width: 150px;">' . $row['dia_chi'] . '</td>' .
      				'<td style="padding-left: 10px">' . $row['tuoi'] . '</td>' .
      				'<td>' . '<form method="post" action="./timdonthuoc.php">' . '<input type="hidden" name="idbn" value="' . $row['ma_benh_nhan'] .'">' . '<button style="background: #1abc9c;color: white">Chi tiet</button></form>' . '</td>' .
      			 '</tr>';
      	}
      }
      else{
      	echo '<tr style="font-size: 25px"><td colspan="4" style="padding: 28px;width: 300px">Không tìm được kết quả</td></tr>';
      }
  	}
  
?>