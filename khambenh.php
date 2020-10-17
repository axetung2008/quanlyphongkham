<?php
  session_start();
  if(!isset($_SESSION['user'])){
    header("location: login.html");
    exit();
  }
?>
<!DOCTYPE html>
<html lang = "en">
<head>
  <title>Khám bệnh</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="./css/index_chung.css">
  <link rel="stylesheet" type="text/css" href="./css/popup.css">
  <link rel="stylesheet" type="text/css" href="./css/tab.css">
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

<!-- Navbar -->
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="#" style="font: consolas; font-weight: 500; font-size: 25px">Phòng khám Lê Văn Minh</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="chucnang.php">Quản lý</a></li>
      </ul>
    </div>
  </div>
</nav>

<div style="margin-left: 100px; margin-right: 100px;" id="blur">

  <!-- LEFT -->
  <div style="float: left; background: white; height: 800px; width: 50%;">
      <h1 style="text-align: center;">Thông tin bệnh nhân</h1>
      <div style="margin-left: 20px">
        <form action="./php/thembenhnhan.php" method="post">
            <label>Họ tên:</label><br>
            <input type="text" id="hoten" name="ho_ten" value="" style="width: 80%; height: 35px;"><br><br>
            <label>Địa chỉ:</label><br>
            <input type="text" id="diachi" name="dia_chi" value="" style="width: 80%; height: 35px;"><br>
            <label style="margin-top: 30px">Giới tính</label>
            <input type="radio" id="nam" name="gioi_tinh" value="nam" checked="" style="margin-left: 50px" onclick="male()">
            <label>Nam</label>
            <input type="radio" id="nu" name="gioi_tinh" value="nu" style="margin-left: 50px" onclick="female()">
            <label>Nữ</label><br>
            <label style="margin-top: 30px">Năm sinh</label>
            <input type="" name="nam_sinh" id="namsinh" style="width: 200px" onchange="returnOlds()">
            <label style="margin-left: 50px">Tuổi</label>
            <input type="" name="tuoi" id="tuoi" style="width: 80px" onchange="returnYears()"><br>

      <!-- <iframe src="./timbenhnhan.html" style="height: 200px; width: 600px"></iframe> -->
        
      </div>
  </div>

  <!-- RIGHT -->
  <div style=" float: left;background: white; height: 800px;width: 50%;">
      <h1 style="text-align: center;">Đơn thuốc</h1>
      <div style="margin-left: 20px">
            <label>Chẩn đoán</label><br>
            <textarea id="chan_doan" name="chan_doan" rows="2" cols="75" style="font-size: 20px"></textarea><br>

<!-- 
            <label>1</label>
            <input type="text" name="thuoc1" style="width: 60%">
            <label>Số lượng</label>
            <input type="" name="so_luong" style="width: 15%">
            <label style="margin-top: 10px;margin-left: 50px">Sáng</label>
            <input type="number" name="sang1" style="width: 10%">
            <label>Chiều</label>
            <input type="number" name="chieu1" style="width: 10%">
            <label>Tối</label>
            <input type="number" name="toi1" style="width: 10%"><br>

            <label>2</label>
            <input type="text" name="thuoc2" style="width: 60%;margin-top: 10px">
            <label>Số lượng</label>
            <input type="" name="so_luong" style="width: 15%">
            <label style="margin-top: 10px; margin-left: 50px">Sáng</label>
            <input type="number" name="sang2" style="width: 10%">
            <label>Chiều</label>
            <input type="number" name="chieu2" style="width: 10%">
            <label>Tối</label>
            <input type="number" name="toi2" style="width: 10%"><br>

            <label>3</label>
            <input type="text" name="thuoc3" style="width: 60%;margin-top: 10px">
            <label>Số lượng</label>
            <input type="" name="so_luong" style="width: 15%">
            <label style="margin-top: 10px;margin-left: 50px">Sáng</label>
            <input type="number" name="sang3" style="width: 10%">
            <label>Chiều</label>
            <input type="number" name="chieu3" style="width: 10%">
            <label>Tối</label>
            <input type="number" name="toi3" style="width: 10%"><br>

            <label>4</label>
            <input type="text" name="thuoc3" style="width: 60%;margin-top: 10px">
            <label>Số lượng</label>
            <input type="" name="so_luong" style="width: 15%">
            <label style="margin-top: 10px;margin-left: 50px">Sáng</label>
            <input type="number" name="sang3" style="width: 10%">
            <label>Chiều</label>
            <input type="number" name="chieu3" style="width: 10%">
            <label>Tối</label>
            <input type="number" name="toi3" style="width: 10%"><br> -->
            <label>Điều trị</label>
            <div class="tabContainer">
              <div class="buttonContainer">
                <button type="button" onclick="showPanel(0,'#6E6E6E')">Loại 1</button>
                <button type="button" onclick="showPanel(1,'#6E6E6E')">Loại 2</button>
                <button type="button" onclick="showPanel(2,'#6E6E6E')">Loại 3</button>
                <button type="button" onclick="showPanel(3,'#6E6E6E')">Loại 4</button>
                <button type="button" onclick="showPanel(4,'#6E6E6E')">Loại 5</button>
                <button type="button" onclick="showPanel(5,'#6E6E6E')">Loại 6</button>
              </div>
              <div class="tabPanel">
                <label>Tên thuốc</label>
                <input type="text" name="thuoc1" style="width: 50%">
                <label>Số lượng</label>
                <input type="number" name="so_luong1" style="width: 15%"><br>
                <label style="margin-top: 10px;margin-left: 50px">Sáng</label>
                <input type="number" name="sang1" style="width: 10%">
                <label>Chiều</label>
                <input type="number" name="chieu1" style="width: 10%">
                <label>Tối</label>
                <input type="number" name="toi1" style="width: 10%">
              </div>
              <div class="tabPanel">
                <label>Tên thuốc</label>
                <input type="text" name="thuoc2" style="width: 50%">
                <label>Số lượng</label>
                <input type="number" name="so_luong2" style="width: 15%"><br>
                <label style="margin-top: 10px;margin-left: 50px">Sáng</label>
                <input type="number" name="sang2" style="width: 10%">
                <label>Chiều</label>
                <input type="number" name="chieu2" style="width: 10%">
                <label>Tối</label>
                <input type="number" name="toi2" style="width: 10%">
              </div>
              <div class="tabPanel">
                <label>Tên thuốc</label>
                <input type="text" name="thuoc3" style="width: 50%">
                <label>Số lượng</label>
                <input type="number" name="so_luong3" style="width: 15%"><br>
                <label style="margin-top: 10px;margin-left: 50px">Sáng</label>
                <input type="number" name="sang3" style="width: 10%">
                <label>Chiều</label>
                <input type="number" name="chieu3" style="width: 10%">
                <label>Tối</label>
                <input type="number" name="toi3" style="width: 10%">
              </div>
              <div class="tabPanel">
                <label>Tên thuốc</label>
                <input type="text" name="thuoc4" style="width: 50%">
                <label>Số lượng</label>
                <input type="number" name="so_luong4" style="width: 15%"><br>
                <label style="margin-top: 10px;margin-left: 50px">Sáng</label>
                <input type="number" name="sang4" style="width: 10%">
                <label>Chiều</label>
                <input type="number" name="chieu4" style="width: 10%">
                <label>Tối</label>
                <input type="number" name="toi4" style="width: 10%">
              </div>
              <div class="tabPanel">
                <label>Tên thuốc</label>
                <input type="text" name="thuoc5" style="width: 50%">
                <label>Số lượng</label>
                <input type="number" name="so_luong5" style="width: 15%"><br>
                <label style="margin-top: 10px;margin-left: 50px">Sáng</label>
                <input type="number" name="sang5" style="width: 10%">
                <label>Chiều</label>
                <input type="number" name="chieu5" style="width: 10%">
                <label>Tối</label>
                <input type="number" name="toi5" style="width: 10%">
              </div>
              <div class="tabPanel">
                <label>Tên thuốc</label>
                <input type="text" name="thuoc6" style="width: 50%">
                <label>Số lượng</label>
                <input type="number" name="so_luong6" style="width: 15%"><br>
                <label style="margin-top: 10px;margin-left: 50px">Sáng</label>
                <input type="number" name="sang6" style="width: 10%">
                <label>Chiều</label>
                <input type="number" name="chieu6" style="width: 10%">
                <label>Tối</label>
                <input type="number" name="toi6" style="width: 10%">
              </div>
            </div>
            <label style="margin-top: 30px">Chi phí</label>
            <input type="" name="chi_phi">

            <br><input type="submit" value="Submit" style="margin-top: 20px">
        </form>
          <a href="#" onclick="toggle()">Click here</a>
      </div>
  </div>
</div>

<div id="popup">
  <div class="print_area">
      <h2 style="text-align: center;"> Đơn thuốc</h2>
      <table>
        <tr>
          <th><h4>Họ tên: </h4></th>
          <th style="padding-left: 30px"><h4 id="print_name"></h4></th>
        </tr>
        <tr>
          <th><h4>Địa chỉ: </h4></th>
          <th style="padding-left: 30px"><h4 id="print_diachi"></h4></th>
        </tr>
        <tr>
          <th><h4>Giới tính: </h4></th>
          <th style="padding-left: 30px"><h4 id="print_gioitinh"></h4></th>
        </tr>
        <tr>
          <th><h4>Tuổi: </h4></th>
          <th style="padding-left: 30px"><h4 id="print_tuoi"></h4></th>
        </tr>
        <tr>
          <th><h4>Chẩn đoán: </h4></th>
          <th style="padding-left: 30px"><h4 id="print_chandoan"></h4></th>
        </tr>
      </table>

  </div>
  <button id="print" onclick="name()">Print</button>
  <a href="#" onclick="toggle()">Close</a>
</div>

<script type="text/javascript">
  var d = new Date();
  var nam = 1;
  var nu = 1;
  function male(){
      return nu = 0;
  }
  function female(){
      return nam = 0;
  }
  
  function returnOlds() {
      var namsinh = document.getElementById("namsinh").value;
      var tuoi = document.getElementById("tuoi");
      tuoi.value = d.getFullYear() - namsinh;
  }
  function returnYears(){
      var tuoi = document.getElementById("tuoi").value;
      var namsinh = document.getElementById("namsinh");
      namsinh.value = d.getFullYear() - tuoi;
  }
  function toggle() {
      var blur = document.getElementById("blur");
      blur.classList.toggle("active");
      var popup = document.getElementById("popup");
      popup.classList.toggle("active");

      var diachi = document.getElementById("diachi").value;
      var name = document.getElementById("hoten").value;
      var tuoi = document.getElementById("tuoi").value;
      var chandoan = document.getElementById("chan_doan").value;

      var gioitinh = "nam";
      if(nam == 1 && (nu == 0)){
        gioitinh = "nam";
      }
      if((nam == 0) && (nu ==1)){
        gioitinh = "nu";
      }


      document.getElementById("print_name").innerHTML = name;
      document.getElementById("print_diachi").innerHTML = diachi;
      document.getElementById("print_gioitinh").innerHTML = gioitinh;
      document.getElementById("print_tuoi").innerHTML = tuoi;
      document.getElementById("print_chandoan").innerHTML = chandoan;

  }

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
