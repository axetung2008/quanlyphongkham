<?
require_once ('config.php');

/*
	Insert, update, delete ->
*/
function execute($sql){
	$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);

	mysqli_query($conn, $sql);

	mysql_close($conn);
}

function executeResult($sql){
	$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);

	$resultset = mysqli_query($conn, $sql);
	$list 	   = [];
	while ($row = mysqli_fetch_array($resultset, 1)) {
		$list = $row;
	}

	mysql_close($conn);

	return $list;

}

?>