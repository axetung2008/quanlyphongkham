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
  mysqli_set_charset($conn,"utf8");
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

    $num_per_page = 07;
    $start_from = ($page-1)*07;
    
    $query = "SELECT * FROM don_thuoc WHERE ma_benh_nhan='$id' ORDER BY ngay_lap DESC limit $start_from,$num_per_page";
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
    #mytable tr:nth-child(even){
      background-color: #dddddd
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
      $("#print_button").click(function(){
        var mode='iframe';
        var close=mode=="popup";
        var options={mode:mode,popClose:close,popTitle:'Don thuoc'};
        $("div.print_area").printArea(options);  
      });

      var madonthuoc;
      $(".dt").on("click",function(){
        madonthuoc = this.id;
        $("#data").load("./php/load-chitiet.php", {
            newid : madonthuoc
        });
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
					<th><label>Giới tính:</label></th>
					<th style="font-size: 20px; padding-left: 20px"><?php echo $gioitinh?></th>
				</tr>
				<tr>
					<th><label>Tuổi:</label></th>
					<th style="font-size: 20px; padding-left: 20px"><?php echo $tuoi?></th>
				</tr>
			</table>  
     </div>

     <h1 style="text-align: center;">Đơn thuốc</h1>
     <div style="margin-left: 10px">
     	<table style="width: 100%" id="mytable">
        <thead>
       		<tr>
       			<th style="padding-left: 20px"><label>Ngày khám</label></th>
       			<th><label>Chi phí</label></th>
       			<th><label>Chi tiết</label></th>
       		</tr>
        </thead>

        <tbody>
                <?php 
                	$chandoan;
                    while($row=mysqli_fetch_assoc($result_dt))
                  	{

                  		$chandoan = $row['chan_doan'];
                  		$madt = $row['ma_don_thuoc'];

                ?>
                    <tr>
                    <td style="padding: 5px;padding-left: 20px"> <?php echo $row['ngay_lap'] ?> </td>
                    <td style="padding: 5px"> <?php echo $row['chi_phi'] ?> </td>
                    <td style="padding: 5px"><button onclick="toggle()" id="<?php echo $madt?>" class="dt">Xem</button></td>
                    </tr>
         		    <?php 
                	  }
                ?>
          
        </tbody>
     	</table>
     <div class="pagination-container">
        <nav>
          <ul class="pagination"></ul>
        </nav>     
     </div>

     <script type="text/javascript">
       var table = '#mytable'
       var trnum = 0
       var maxRows = 5
       var totalRows = $(table+' tbody tr').length
       //console.log(totalRows)
       $(table+' tbody tr:gt(0)').each(function(){
          trnum++
          if(trnum > maxRows){
            $(this).hide()
          }
          if(trnum <= maxRows){
            $(this).show()
          }
       })
       if(totalRows > maxRows){
          var pagenum = Math.ceil(totalRows/maxRows)
          for(var i=1;i<=pagenum;){
            $('.pagination').append('<li data-page="'+i+'">\<span>'+ i++ +'<span class="sr-only">(current)</span></span>\</li>').show()
          }
       }
       $('.pagination li:first-child').addClass('active')
       $('.pagination li').on('click',function(){
          var pagenum = $(this).attr('data-page')
          var trindex = 0;
          $('.pagination li').removeClass('active')
          $(this).addClass('active')
          $(table+' tr:gt(0)').each(function(){
              trindex++
              if(trindex > (maxRows*pagenum) || trindex <= ((maxRows*pagenum)-maxRows)){
                $(this).hide()
              }else{
                $(this).show()
              }
          })
       })
       $(function(){
          $('table thead tr:eq(0)').prepend('<th><label>STT</label></th>')
          var id = 0;
          $('#mytable tbody tr').each(function() {
            id++
            $(this).prepend('<td style="text-align:center;padding-left: 0px;width:5%">'+id+'</td>')
          })
       })


     </script>

     </div>
</div>



  <!-- RIGHT -->
  <div style=" float: left;background: white; height: 800px;width: 50%;">
      <h1 style="text-align: center;">Chi tiết đơn thuốc</h1>
      <div style="margin-left: 20px">
      		
      		<form name="donthuoc" action="./php/themdonthuoc.php" method="post">
      			
      			<input type="" name="id" hidden value="<?php echo $id?>">
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


	          <button type="button" class="btn btn3" onclick="toggle1(),dataToPrint()" style="width: 85%;">Xem đơn thuốc</button>
      </div>
  </div>
</div>



<div id="preview">
  <div class="print_area" id="xemdonthuoc">
    <h2 style="text-align: center;"> Đơn thuốc</h2>
    <table>
      <tr>
        <th><h4>Họ tên: </h4></th>
        <th style="padding-left: 30px"><h4 id="print_name"><?php echo $hoten?></h4></th>
      </tr>
      <tr>
        <th><h4>Địa chỉ: </h4></th>
        <th style="padding-left: 30px"><h4 id="print_diachi"><?php echo $diachi?></h4></th>
      </tr>
      <tr>
        <th><h4>Giới tính: </h4></th>
        <th style="padding-left: 30px"><h4 id="print_gioitinh"><?php echo $gioitinh?></h4></th>
      </tr>
      <tr>
        <th><h4>Tuổi: </h4></th>
        <th style="padding-left: 30px"><h4 id="print_tuoi"><?php echo $tuoi?></h4></th>
      </tr>
      <tr>
        <th><h4>Chẩn đoán: </h4></th>
        <th style="padding-left: 30px"><h4 id="print_chandoan"><?echo $chandoan?></h4></th>
      </tr>
      <tr>
        <th><h4>STT</h4></th>
        <th style="padding-left: 80px"><h4>Tên thuốc</h4></th>
        <th style="padding-left: 100px"><h4>Số lượng</h4></th>
      </tr>
      <?php
        for($i = 1; $i<=6 ; $i++){
      ?>
      <tr id="dong<?php echo $i?>"></tr>
      <tr id="cach<?php echo $i?>"></tr>
      <?php
        }
      ?>

    </table>

  </div>


  <input class="btn btn1" type="submit" name="submit" value="Lưu">
  <button class="btn btn1" type="button" id="print_button">Print</button>


  <button type="button" class="btn btn2" onclick="toggle1()">Close</button>
        </form>
</div>

<div id="popup">
	<div class="print_area" id="chitietdonthuoc">
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
        <tbody id="data">
          
        </tbody>
          
      </table>
	</div>
	
	<button class="btn btn1" type="button" onclick="copy()">Sao chép</button>
	<button class="btn btn1" type="button" id="print">Print</button>

	<button class="btn btn2" type="button" onclick="toggle()">Close</button>
</div>

<script type="text/javascript">
	function toggle() {
	    var blur = document.getElementById("blur");
	    blur.classList.toggle("active");
	    var popup = document.getElementById("popup");
	    popup.classList.toggle("active");
	    var hide = document.getElementById("xemdonthuoc");
	    hide.classList.toggle("print_area");
	}
  // function takeID(madt){
  //     var id = madt;
  //     document.getElementById("iddonthuoc").innerHTML = id;
  // }
	function toggle1() {
	    var blur = document.getElementById("blur");
	    blur.classList.toggle("active");
	    var popup = document.getElementById("preview");
	    popup.classList.toggle("active");
	    var hide = document.getElementById("chitietdonthuoc");
	    hide.classList.toggle("print_area");
	}
	function copy(){
		var chandoan = document.getElementById("chandoan").innerHTML;
		document.getElementById("chan_doan").value = chandoan;
		var count = document.getElementById("count").innerHTML;
    //console.log(count);
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
	function dataToPrint(){
		var thuoc = [];
	    var soluong = [];
	    var sang = [];
	    var chieu = [];
	    var toi = [];

	    for(let i = 1; i<=6; i++){
	      thuoc.push(document.getElementById("thuoc" + i).value);
	      soluong.push(document.getElementById("soluong" + i).value);
	      sang.push(document.getElementById("sang" + i).value);
	      chieu.push(document.getElementById("chieu" + i).value);
	      toi.push(document.getElementById("toi" + i).value);
	    }
	    var dong = ["dong1", "dong2", "dong3", "dong4", "dong5", "dong6"];
    	var cachuong = ["cach1", "cach2", "cach3", "cach4", "cach5", "cach6"];
    	for (var i = 0; i < thuoc.length; i++) {
      	if (thuoc[i] != "") {
        var print = "<tr>";
        print += "<th>" + "<h4>" + (i + 1) + "</h4>" + "</th>";
        print += '<th style="padding-left: 30px">' + "<h4>" + thuoc[i] + "</h4>" + "</th>";
        print += '<th style="padding-left: 100px">' + "<h4>" + soluong[i] + " " + "viên" + "</h4>" + "</th>";
        print += "</tr>";
        document.getElementById(dong[i]).innerHTML = print;
        var print_cach = "<tr>";
        let count = 1;
        print_cach += "<th>" + "Cách uống" + "</th>";
        print_cach += '<th style="padding-left: 30px">';

        if(sang[i] != ""){
          print_cach += "Sáng" + " " + sang[i];
          count++;
        }

        if(chieu[i] != ""){
          if(count > 1){
            print_cach += " - ";
          }
          print_cach += "Chiều" + " " + chieu[i];
          count++;
        }

        if(toi[i] != ""){
          if(count > 1){
            print_cach += " - ";
          }
          print_cach += "Tối" + " " + toi[i];
          count++;
        }

        print_cach += "</th>";
        print_cach += "</tr>";
        document.getElementById(cachuong[i]).innerHTML = print_cach;
      }
    }	
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