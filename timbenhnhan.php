<?php
	require_once('./php/config.php');
	//header("Content-type: text/html; charset=utf-8");
// Create connection
	$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
	//mysqli_set_charset($conn, 'UTF8');

	$ten = $_POST['hoten'];

	$benhnhan = "SELECT * FROM benh_nhan WHERE ho_ten='$ten'";
	$result = $conn->query($benhnhan);

	if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["ma_benh_nhan"]. " - Name: " . $row["ho_ten"]. " " . $row["dia_chi"]. " " . $row["chan_doan"]. "<br>";
  }
} else {
  echo "0 results";
}	


	mysqli_close($conn);

?>