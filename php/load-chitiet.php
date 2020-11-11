<?php
	require_once('config.php');

	$conn = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);

	$madt = $_POST['newid'];

  $chitiet = "SELECT * FROM chi_tiet_don_thuoc WHERE ma_don_thuoc='$madt'";
  $result_chitiet = mysqli_query($conn,$chitiet);
  $i = 1;

    while($row=mysqli_fetch_assoc($result_chitiet)){
      echo '<tr>';
    	echo '<th>' . $i . '</th>';
    	echo '<th style="padding-left: 30px">';
    	echo '<h4 id="tenthuoc'.$i.'">'.$row['ten_thuoc'].'</h4>';
    	echo '</th>';
    	echo '<th style="padding-left: 100px" id="solg'.$i.'">' . $row['so_luong'] . '</th>';
    	echo '</tr>';
    	echo '<tr>';
    	echo '<th>' . "Cách uống" . '</th>';
    	echo '<th style="padding-left: 30px">';
    	$string = $row['cach_uong'];
        $pattern = "/[\/]/";
    	$re = preg_split($pattern, $string);
        $cach = "";
        $count = 1;
        if($re[0] != ""){
        	$cach = "Sáng"." ".$re[0];
       		$count++;
 		    }
        if($re[1] != ""){
        	if($count > 1){
        	$cach = $cach . " - ";
        }
        $cach = $cach."Chiều"." ".$re[1];
        $count++;
        }
        if($re[2] != ""){
        	if($count > 1){
       			$cach = $cach . " - ";
      		}
        	$cach = $cach."Tối"." ".$re[2];
        	$count++;
        }
    	echo $cach;
      echo '</th>';
      echo '<tr>';
    	echo '<th hidden id="s' . $i . '">' . $re[0] . '</th>' .
         	 '<th hidden id="c' . $i . '">' . $re[1] . '</th>' .
			     '<th hidden id="t' . $i . '">' . $re[2] . '</th>';
			echo '<tr>';

    	echo '</tr>';
      echo '<tr>';
    	$i++;
    }	
  echo '<tr hidden">';
  echo '<th hidden id="count">' . $i . '</th>';
  echo '</tr>';

?>