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
                    while($row=mysqli_fetch_assoc($result_dt))
                    {
                ?>
                    <td> <?php echo $row['ngay_lap'] ?> </td>
                    <td> <?php echo $row['chi_phi'] ?> </td>
                    <td><button>Xem</button></td>
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
                <button type="button" id="type1" onclick="showPanel(0,'#6E6E6E')">Loại 1</button>
                <button type="button" id="type2" onclick="showPanel(1,'#6E6E6E')">Loại 2</button>
                <button type="button" id="type3" onclick="showPanel(2,'#6E6E6E')">Loại 3</button>
                <button type="button" id="type4" onclick="showPanel(3,'#6E6E6E')">Loại 4</button>
                <button type="button" id="type5" onclick="showPanel(4,'#6E6E6E')">Loại 5</button>
                <button type="button" id="type6" onclick="showPanel(5,'#6E6E6E')">Loại 6</button>
              </div>
              <div class="tabPanel" id="tab1">
                <label>Tên thuốc</label>
                <input type="text" id="thuoc1" name="thuoc1" required="" style="width: 50%" autocomplete="off">
                <label>Số lượng</label>
                <input type="number" id="soluong1" required="" name="so_luong1" step="any" style="width: 15%"><br>
                <label style="margin-top: 10px;margin-left: 60px">Sáng</label>
                <input type="number" id="sang1" name="sang1" step="any" style="width: 10%">
                <label>Chiều</label>
                <input type="number" id="chieu1" name="chieu1" step="any" style="width: 10%">
                <label>Tối</label>
                <input type="number" id="toi1" name="toi1" step="any" style="width: 10%">
              </div>
              <div class="tabPanel" id="tab2">
                <label>Tên thuốc</label>
                <input type="text" id="thuoc2" name="thuoc2" style="width: 50%" autocomplete="off">
                <label>Số lượng</label>
                <input type="number" id="soluong2" name="so_luong2" step="any" style="width: 15%"><br>
                <label style="margin-top: 10px;margin-left: 60px">Sáng</label>
                <input type="number" id="sang2" name="sang2" step="any"style="width: 10%">
                <label>Chiều</label>
                <input type="number" id="chieu2" name="chieu2" step="any" style="width: 10%">
                <label>Tối</label>
                <input type="number" id="toi2" name="toi2" step="any" style="width: 10%">
              </div>
              <div class="tabPanel" id="tab3">
                <label>Tên thuốc</label>
                <input type="text" id="thuoc3" name="thuoc3" style="width: 50%" autocomplete="off">
                <label>Số lượng</label>
                <input type="number" id="soluong3" name="so_luong3" step="any" style="width: 15%"><br>
                <label style="margin-top: 10px;margin-left: 60px">Sáng</label>
                <input type="number" id="sang3" name="sang3" step="any" style="width: 10%">
                <label>Chiều</label>
                <input type="number" id="chieu3" name="chieu3" step="any" style="width: 10%">
                <label>Tối</label>
                <input type="number" id="toi3" name="toi3" step="any" style="width: 10%">
              </div>
              <div class="tabPanel" id="tab4">
                <label>Tên thuốc</label>
                <input type="text" id="thuoc4" name="thuoc4" style="width: 50%" autocomplete="off">
                <label>Số lượng</label>
                <input type="number" id="soluong4" name="so_luong4" step="any" style="width: 15%"><br>
                <label style="margin-top: 10px;margin-left: 60px">Sáng</label>
                <input type="number" id="sang4" name="sang4" step="any" style="width: 10%">
                <label>Chiều</label>
                <input type="number" id="chieu4" name="chieu4" step="any" style="width: 10%">
                <label>Tối</label>
                <input type="number" id="toi4" name="toi4" step="any" style="width: 10%">
              </div>
              <div class="tabPanel" id="tab5">
                <label>Tên thuốc</label>
                <input type="text" id="thuoc5" name="thuoc5" style="width: 50%" autocomplete="off">
                <label>Số lượng</label>
                <input type="number" id="soluong5" name="so_luong5" step="any" style="width: 15%"><br>
                <label style="margin-top: 10px;margin-left: 60px">Sáng</label>
                <input type="number" id="sang5" name="sang5" step="any" style="width: 10%">
                <label>Chiều</label>
                <input type="number" id="chieu5" name="chieu5" step="any" style="width: 10%">
                <label>Tối</label>
                <input type="number" id="toi5" name="toi5" step="any" style="width: 10%">
              </div>
              <div class="tabPanel" id="tab6">
                <label>Tên thuốc</label>
                <input type="text" id="thuoc6" name="thuoc6" style="width: 50%" autocomplete="off">
                <label>Số lượng</label>
                <input type="number" id="soluong6" name="so_luong6" step="any" style="width: 15%"><br>
                <label style="margin-top: 10px;margin-left: 60px">Sáng</label>
                <input type="number" id="sang6" name="sang6" step="any" style="width: 10%">
                <label>Chiều</label>
                <input type="number" id="chieu6" name="chieu6" step="any" style="width: 10%">
                <label>Tối</label>
                <input type="number" id="toi6" name="toi6" step="any" style="width: 10%">
              </div>
              <div class="suggest">
                <div id="show-list">
                  <!-- Gợi ý đơn thuốc -->
                </div>
              </div>
            </div>
            <label style="margin-top: 0px">Chi phí</label>
            <input id="chiphi" type="" required="" name="chi_phi"><br><br>


          <button type="button" class="btn btn3" onclick="toggle(),takeData()" style="width: 85%;">Xem đơn thuốc</button>
      </div>
  </div>
</div>



</body>
</html>