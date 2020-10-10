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

<div style="margin-left: 100px; margin-right: 100px;">
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
            <input type="radio" id="nu" name="gioi_tinh" value="nam" style="margin-left: 50px">
            <label>Nữ</label><br>
            <label>Tuổi</label>
            <input type="text" name="tuoi">
            <label style="padding-left: 100px">Năm sinh</label>
            <input type="text" name="nam_sinh"><br>

            <input type="submit" value="Submit">
        </form>
        
      </div>
  </div>

  <div style=" float: left;background: white; height: 800px;width: 50%;">
      <h1>RIGHT</h1>
      <h1>RIGHT</h1>
  </div>
</div>




</body>
</html>
