<?php
  require_once ('./php/config.php');
  session_start();
  if(!isset($_SESSION['user'])){
    header("location: login.html");
    exit();
  }
  $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
  mysqli_set_charset($conn,"utf8");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Quản lý đơn thuốc</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="./css/index_chung.css">
  <link rel="stylesheet" type="text/css" href="./css/button.css">
  <script src="./js/jquery.js"></script>
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
    tr:nth-child(even) {
      background-color: #dddddd;
    }
  </style>
  <script src="./js/findname.js" type="text/javascript"></script>
  
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="#" style="font: consolas; font-weight: 500; font-size: 25px">Phòng khám Lê Văn Minh</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="./chucnang.php">Quản lý</a></li>
      </ul>
    </div>
  </div>
</nav>

<div style="margin-left: 100px; margin-right: 100px;" id="blur">

  <!-- LEFT -->
  <div style="float: left; background: white; height: 800px; width: 100%;">
      <h1 style="text-align: center;">Tìm bệnh nhân</h1>
      <form method="post" action="./php/timbenhnhan.php">
        <label style="padding-top: 50px; padding-left: 50px">Tìm theo họ tên: </label>
        <input type="text" id="tenbenhnhan">
      </form>
      <div style="width: 100%;padding-left: 35%; padding-top: 20px">
        <table style="width: 50%">
          <thead style="font-size: 20px">
            <th width="40%" >Họ tên</th>
            <th width="20%">Địa chỉ</th>
            <th width="20%">Tuổi</th>
            <th width="30%">Đơn thuốc</th>
          </thead>
          <tbody id="show-ten" style="font-size: 18px">
            
          </tbody>
        </table>
      </div>
  </div>


</div>

</body>
</html>