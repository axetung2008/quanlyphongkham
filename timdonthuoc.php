<?php
	session_start();
  	if(!isset($_SESSION['user'])){
    header("location: login.html");
    exit();
  	}

	$id = $_POST['idbn'];

	$hoten;
	$diachi;
	$gioitinh;
	$tuoi;

	require_once('./php/config.php');

	$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);

	$sql = "SELECT * FROM benh_nhan WHERE ma_benh_nhan='$id'";
	$result = $conn->query($sql);
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$hoten = $row['ho_ten'];
			$diachi = $row['dia_chi'];
			$gioitinh = $row['gioi_tinh'];
			$tuoi = $row['tuoi'];
		}
	}

	if(isset($_GET['page'])) {
        $page = $_GET['page'];
    }
    else{
        $page = 1;
    }

    $num_per_page = 05;
    $start_from = ($page-1)*05;
    
    $query = "SELECT * FROM don_thuoc WHERE ma_benh_nhan='$id' limit $start_from,$num_per_page";
    $result_dt = mysqli_query($conn,$query);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Đơn thuốc</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <link rel="stylesheet" type="text/css" href="./css/index_chung.css">
  <link rel="stylesheet" type="text/css" href="./css/popup.css">
  <link rel="stylesheet" type="text/css" href="./css/tab.css">
  <link rel="stylesheet" type="text/css" href="./css/button.css">
  <script src="./js/jquery.js"></script>
  <script src="./js/jqueryPrint.js"></script>


  <style type="text/css">
    body{
      background: #1abc9c;
    }
    label{
      font-size: 25px;
    }
    input{
      font-size: 25px;

    }
  </style>

  <script>
    $(document).ready(function(){
      $("#print").click(function(){
        var mode='iframe';
        var close=mode=="popup";
        var options={mode:mode,popClose:close,popTitle:'Don thuoc'};
        $("div.print_area").printArea(options);  
      });
    });
  </script>

  <script src="./js/suggest.js"></script>
</head>
<body>

<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="#" style="font: consolas; font-weight: 500; font-size: 25px">Phòng khám Lê Văn Minh</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="./quanlydonthuoc.php">Quay lại</a></li>
      </ul>
    </div>
  </div>
</nav>

<div style="margin-left: 100px; margin-right: 100px;" id="blur">

  <!-- LEFT -->
  	<div style="float: left; background: white; height: 800px; width: 50%;">
      <h1 style="text-align: center;">Thông tin bệnh nhân</h1>
      <div style="margin-left: 20px; padding-top: 40px">
			<table>
				<tr>
					<th><label>Họ tên:</label></th>
					<th style="font-size: 20px; padding-left: 20px"><?php echo $hoten?></th>
				</tr>
				<tr>
					<th><label>Địa chỉ:</label></th>
					<th style="font-size: 20px; padding-left: 20px"><?php echo $diachi?></th>
				</tr>
				<tr>
					<th><label>Tuổi</label></th>
					<th style="font-size: 20px"><?php echo $tuoi?></th>
				</tr>
			</table>  
     </div>

     <h1 style="text-align: center;">Đơn thuốc</h1>
     <div style="margin-left: 20px">
     	<table style="width: 100%">
     		<tr>
     			<th><label>Ngày khám</label></th>
     			<th><label>Chi phí</label></th>
     			<th><label>Chi tiết</label></th>
     		</tr>

     		<tr>
                <?php 
                	$chandoan;
                    while($row=mysqli_fetch_assoc($result_dt))
                  	{
                  		$chandoan = $row['chan_doan'];
                  		$madt = $row['ma_don_thuoc'];

                ?>
                    <td> <?php echo $row['ngay_lap'] ?> </td>
                    <td> <?php echo $row['chi_phi'] ?> </td>
                    <td><button onclick="toggle()">Xem</button></td>
            </tr>
         		<?php 
                	}
                ?>

     	</table>
     	<?php 
        
                $pr_query = "SELECT * FROM don_thuoc WHERE ma_benh_nhan='$id'";
                $pr_result = mysqli_query($conn,$pr_query);
                $total_record = mysqli_num_rows($pr_result);
                
                $total_page = ceil($total_record/$num_per_page);
                
                if($page>1){
                    echo "<a href='index.php?page=".($page-1)."' class='btn btn-danger'>Previous</a>";
                }

                
                for($i=1;$i<$total_page;$i++){
                    echo "<a href='index.php?page=".$i."' class='btn btn-primary'>$i</a>";
                }

                if($i>$page){
                    echo "<a href='index.php?page=".($page+1)."' class='btn btn-danger'>Next</a>";
                }
        
        ?>
     </div>
</div>



  <!-- RIGHT -->
  <div style=" float: left;background: white; height: 800px;width: 50%;">
      <h1 style="text-align: center;">Chi tiết đơn thuốc</h1>
      <div style="margin-left: 20px">
            <label>Chẩn đoán</label><br>
            <textarea id="chan_doan" name="chan_doan" required="" rows="2"  style="font-size: 20px;width: 90%"></textarea><br>

            <label>Điều trị</label>
            <div class="tabContainer">
              <div class="buttonContainer">
                <?php
          			for($i = 1; $i<= 6; $i++){
          		?>
          			<button class="tab-current" type="button" id="type<?php echo $i ?>" onclick="showPanel(<?php echo $i-1 ?>,'#6e6e6e')">Loại <?php echo $i ?></button>
            	<?php
          			}
          		?>
              </div>

              <?php
		            for($i = 1; $i<= 6; $i++){
		        ?>
		        <div class="tabPanel" id="tab<?php echo $i ?>">
		          <label>Tên thuốc</label>
		          <input type="text" id="thuoc<?php echo $i ?>" name="thuoc<?php echo $i ?>" style="width: 50%" autocomplete="off">
		          <label>Số lượng</label>
		          <input type="number" id="soluong<?php echo $i ?>" name="so_luong<?php echo $i ?>" step="any" style="width: 15%"><br>
		          <label style="margin-top: 10px;margin-left: 60px">Sáng</label>
		          <input type="number" id="sang<?php echo $i ?>" name="sang<?php echo $i ?>" step="any" style="width: 10%">
		          <label>Chiều</label>
		          <input type="number" id="chieu<?php echo $i ?>" name="chieu<?php echo $i ?>" step="any" style="width: 10%">
		          <label>Tối</label>
		          <input type="number" id="toi<?php echo $i ?>" name="toi<?php echo $i ?>" step="any" style="width: 10%">
		        </div>
		      <?php
		          	}
		        ?>

              <div class="suggest">
                <div id="show-list">
                  <!-- Gợi ý đơn thuốc -->
                </div>
              </div>
            </div>
            <label style="margin-top: 0px">Chi phí</label>
            <input id="chiphi" type="" required="" name="chi_phi"><br><br>


          <button type="button" class="btn btn3" onclick="toggle1()" style="width: 85%;">Xem đơn thuốc</button>
      </div>
  </div>
</div>

<div id="popup">
	<div class="print_area">
		<h2 style="text-align: center;">Đơn thuốc</h2>
      	<table>
        <tr>
          <th><h4>Họ tên: </h4></th>
          <th style="padding-left: 30px"><h4><?php echo $hoten?></h4></th>
        </tr>
        <tr>
          <th><h4>Địa chỉ: </h4></th>
          <th style="padding-left: 30px"><h4><?php echo $diachi?></h4></th>
        </tr>
        <tr>
          <th><h4>Giới tính: </h4></th>
          <th style="padding-left: 30px"><h4><?php echo $gioitinh?></h4></th>
        </tr>
        <tr>
          <th><h4>Tuổi: </h4></th>
          <th style="padding-left: 30px"><h4><?php echo $tuoi?></h4></th>
        </tr>
        <tr>
          <th><h4>Chẩn đoán: </h4></th>
          <th style="padding-left: 30px"><h4 id="chandoan"><?php echo $chandoan?></h4></th>
        </tr>
        <tr>
          <th><h4>STT</h4></th>
          <th style="padding-left: 80px"><h4>Tên thuốc</h4></th>
          <th style="padding-left: 100px"><h4>Số lượng</h4></th>
        </tr>
        <tr>
        <?php 
        	$chitiet = "SELECT * FROM chi_tiet_don_thuoc WHERE ma_don_thuoc='$madt'";
        	$result_chitiet = mysqli_query($conn,$chitiet);
        	$i = 1;

        	while($row=mysqli_fetch_assoc($result_chitiet))
        	{
        ?>
        	<th><?php echo $i?></th>
        	<th style="padding-left: 30px" id="tenthuoc<?php echo $i?>"><?php echo $row['ten_thuoc']?></th>
        	<th style="padding-left: 100px" id="solg<?php echo $i?>"><?php echo $row['so_luong']?></th>
        <tr>
        	<th>Cách uống</th>
        	<th style="padding-left: 30px">
        		<?php
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
        			echo '<p hidden id="s' . $i . '">' . $re[0] . '</p>';
        			echo '<p hidden id="c' . $i . '">' . $re[1] . '</p>';
        			echo '<p hidden id="t' . $i . '">' . $re[2] . '</p>';

        		?>
        	</th>
        </tr>
        <?php
        	$i++;
        ?>
        </tr>
        <?php
        	}
        	echo '<p hidden id="count">' . $i . '</p>';
        ?>


      </table>
	</div>
	
	<button onclick="copy()">Sao chép</button>
	<button onclick="toggle()">Close</button>
</div>


<script type="text/javascript">
	function toggle() {
	    var blur = document.getElementById("blur");
	    blur.classList.toggle("active");
	    var popup = document.getElementById("popup");
	    popup.classList.toggle("active");
	}
	function copy(){
		var chandoan = document.getElementById("chandoan").innerHTML;
		document.getElementById("chan_doan").value = chandoan;
		var count = document.getElementById("count").innerHTML;
		for(let i = 1; i<count ; i++){
			document.getElementById("thuoc" + i).value = document.getElementById("tenthuoc" + i).innerHTML;
			document.getElementById("soluong" + i).value = document.getElementById("solg" + i).innerHTML;
			document.getElementById("sang" + i).value = document.getElementById("s" + i).innerHTML;
			document.getElementById("chieu" + i).value = document.getElementById("c" + i).innerHTML;
			document.getElementById("toi" + i).value = document.getElementById("t" + i).innerHTML;

		}

		//console.log(count);
		toggle();
	}
	//==============Tab================
	var tabButtons=document.querySelectorAll(".tabContainer .buttonContainer button");
  	var tabPanels=document.querySelectorAll(".tabContainer  .tabPanel");

  	function showPanel(panelIndex,colorCode) {
    tabButtons.forEach(function(node){
        node.style.backgroundColor="";
        node.style.color="";
    });
	    tabButtons[panelIndex].style.backgroundColor=colorCode;
	    tabButtons[panelIndex].style.color="white";
	    tabPanels.forEach(function(node){
        node.style.display="none";
    });
    tabPanels[panelIndex].style.display="block";
    tabPanels[panelIndex].style.backgroundColor=colorCode;
  	}
  showPanel(0,'#6E6E6E');
</script>

</body>
</html>