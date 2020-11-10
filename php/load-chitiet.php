<?php
	require_once('config.php');

	$conn = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);

	$madt = $_POST['madonthuoc'];

    $chitiet = "SELECT * FROM chi_tiet_don_thuoc WHERE ma_don_thuoc='$madt'";
    $result_chitiet = mysqli_query($conn,$chitiet);
    $i = 1;

    while($row=mysqli_fetch_assoc($result_chitiet)){
    	echo '<th>' . $i . '</th>' .
    		 '<th style="padding-left: 30px" id="tenthuoc'. $i . '">' .
    		 $row['ten_thuoc'] .
    		 '</th>' .
    		 '<th style="padding-left: 100px" id="solg' . $i . '">' .
    		 $row['so_luong'] .
    		 '</th>' .
    		 '<tr>' .
	    		 '<th>' . "Cách uống" . '</th>' .
	    		 '<th style="padding-left: 30px">';
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
    	echo '<p hidden id="s' . $i . '">' . $re[0] . '</p>' .
         	 '<p hidden id="c' . $i . '">' . $re[1] . '</p>' .
			 '<p hidden id="t' . $i . '">' . $re[2] . '</p>' .
			 	'</th>' .
			 '</tr>';
        $i++;

        echo '</tr>';
    }
    echo '<p hidden id="count">' . $i . '</p>';

?>