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
                <input type="text" id="thuoc1" name="thuoc1" style="width: 50%">
                <label>Số lượng</label>
                <input type="number" id="soluong1" name="so_luong1" step="any" style="width: 15%"><br>
                <label style="margin-top: 10px;margin-left: 50px">Sáng</label>
                <input type="number" id="sang1" name="sang1" step="any" style="width: 10%">
                <label>Chiều</label>
                <input type="number" id="chieu1" name="chieu1" step="any" style="width: 10%">
                <label>Tối</label>
                <input type="number" id="toi1" name="toi1" step="any" style="width: 10%">
              </div>
              <div class="tabPanel">
                <label>Tên thuốc</label>
                <input type="text" id="thuoc2" name="thuoc2" style="width: 50%">
                <label>Số lượng</label>
                <input type="number" id="soluong2" name="so_luong2" step="any" style="width: 15%"><br>
                <label style="margin-top: 10px;margin-left: 50px">Sáng</label>
                <input type="number" id="sang2" name="sang2" step="any"style="width: 10%">
                <label>Chiều</label>
                <input type="number" id="chieu2" name="chieu2" step="any" style="width: 10%">
                <label>Tối</label>
                <input type="number" id="toi2" name="toi2" step="any" style="width: 10%">
              </div>
              <div class="tabPanel">
                <label>Tên thuốc</label>
                <input type="text" id="thuoc3" name="thuoc3" style="width: 50%">
                <label>Số lượng</label>
                <input type="number" id="soluong3" name="so_luong3" step="any" style="width: 15%"><br>
                <label style="margin-top: 10px;margin-left: 50px">Sáng</label>
                <input type="number" id="sang3" name="sang3" step="any" style="width: 10%">
                <label>Chiều</label>
                <input type="number" id="chieu3" name="chieu3" step="any" style="width: 10%">
                <label>Tối</label>
                <input type="number" id="toi3" name="toi3" step="any" style="width: 10%">
              </div>
              <div class="tabPanel">
                <label>Tên thuốc</label>
                <input type="text" id="thuoc4" name="thuoc4" style="width: 50%">
                <label>Số lượng</label>
                <input type="number" id="soluong4" name="so_luong4" step="any" style="width: 15%"><br>
                <label style="margin-top: 10px;margin-left: 50px">Sáng</label>
                <input type="number" id="sang4" name="sang4" step="any" style="width: 10%">
                <label>Chiều</label>
                <input type="number" id="chieu4" name="chieu4" step="any" style="width: 10%">
                <label>Tối</label>
                <input type="number" id="toi4" name="toi4" step="any" style="width: 10%">
              </div>
              <div class="tabPanel">
                <label>Tên thuốc</label>
                <input type="text" id="thuoc5" name="thuoc5" style="width: 50%">
                <label>Số lượng</label>
                <input type="number" id="soluong5" name="so_luong5" step="any" style="width: 15%"><br>
                <label style="margin-top: 10px;margin-left: 50px">Sáng</label>
                <input type="number" id="sang5" name="sang5" step="any" style="width: 10%">
                <label>Chiều</label>
                <input type="number" id="chieu5" name="chieu5" step="any" style="width: 10%">
                <label>Tối</label>
                <input type="number" id="toi5" name="toi5" step="any" style="width: 10%">
              </div>
              <div class="tabPanel">
                <label>Tên thuốc</label>
                <input type="text" id="thuoc6" name="thuoc6" style="width: 50%">
                <label>Số lượng</label>
                <input type="number" id="soluong6" name="so_luong6" step="any" style="width: 15%"><br>
                <label style="margin-top: 10px;margin-left: 50px">Sáng</label>
                <input type="number" id="sang6" name="sang6" step="any" style="width: 10%">
                <label>Chiều</label>
                <input type="number" id="chieu6" name="chieu6" step="any" style="width: 10%">
                <label>Tối</label>
                <input type="number" id="toi6" name="toi6" step="any" style="width: 10%">
              </div>
            </div>
            <label style="margin-top: 30px">Chi phí</label>
            <input type="" name="chi_phi">

            <br><input type="submit" value="Submit" style="margin-top: 20px">
        </form>
          <a href="#" onclick="toggle(),takeData()">Click here</a>
      </div>
  </div>
</div>

<div id="popup">
  <div class="print_area">
      <h2 style="text-align: center;"> Đơn thuốc</h2>
      <table border="1">
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
        <tr>
          <th><h4>STT</h4></th>
          <th style="padding-left: 100px"><h4>Tên thuốc</h4></th>
          <th style="padding-left: 100px"><h4>Số lượng</h4></th>
        </tr>
        <tr>
          <th><h4>1</h4></th>
          <th style="padding-left: 30px"><h4 id="print_thuoc1"></h4></th>
          <th style="padding-left: 100px; padding-right: 50px"><h4 id="print_soluong1"></h4></th>
        </tr>
        <tr>
          <th>Cách uống</th>
          <th><h4 id="print_sang1"></h4></th>
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

  }

  function takeData(){
      var diachi = document.getElementById("diachi").value;
      var name = document.getElementById("hoten").value;
      var tuoi = document.getElementById("tuoi").value;
      var chandoan = document.getElementById("chan_doan").value;

      var thuoc1 = document.getElementById("thuoc1").value;
      var soluong1 = document.getElementById("soluong1").value;
      var sang1 = document.getElementById("sang1").value;
      var chieu1 = document.getElementById("chieu1").value;
      var toi1 = document.getElementById("toi1").value;

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

      document.getElementById("print_thuoc1").innerHTML = thuoc1;
      document.getElementById("print_soluong1").innerHTML = soluong1+" "+"viên";
      if(sang1 != "" && chieu1 != "" && toi1 != ""){
        document.getElementById("print_sang1").innerHTML = "Sáng"+" "+sang1+"-"+" "+"Chiều"+" "+ chieu1+" "+"-"+"Tối"+" "+toi1;
      }else if(sang1 != "" && chieu1 != "" && toi1==""){
        document.getElementById("print_sang1").innerHTML = "Sáng"+" "+sang1+"-"+" "+"Chiều"+" "+ chieu1;
      }else if(sang1 != "" && chieu1 == "" && toi1== ""){
        document.getElementById("print_sang1").innerHTML = "Sáng"+" "+sang1;
      }else if(toi1 != "" && chieu1 == "" && sang1 == ""){
        document.getElementById("print_sang1").innerHTML = "Tối"+" "+toi1;
      }
      //document.getElementById("print_chieu").innerHTML = chandoan;


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
