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
            <input type="radio" id="nam" name="gioi_tinh" value="nam" checked="" style="margin-left: 50px">
            <label>Nam</label>
            <input type="radio" id="nu" name="gioi_tinh" value="nu" style="margin-left: 50px">
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

            <label style="margin-top: 20px">Thuốc điều trị</label><br>
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
            <label>Chi phí</label>
            <input type="" name="chi_phi">

<!--             <br><input type="submit" value="Submit" style="margin-top: 20px"> -->
        </form>
          <a href="#" onclick="toggle()">Click here</a>
      </div>
  </div>
</div>

<div id="popup">
  <form>
    <label>Họ tên</label>
    <input type=""  id="pop_hoten" name="pop_hoten" value="">
  </form>
  <a href="#" onclick="toggle()">Close</a>
</div>

<script type="text/javascript">
  var d = new Date();
  
  
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

      var name = document.getElementById("hoten").value;
      document.getElementById("pop_hoten").value = name;

  }
</script>


</body>
</html>
