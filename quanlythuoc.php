<?php
  session_start();
  if(!isset($_SESSION['user'])){
    header("location: login.html");
    exit();
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Quản lý thuốc</title>
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
  <script src="./js/find_medical.js" type="text/javascript"></script>
  
</head>
<body>
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
  <div style="float: left; background: white; height: 800px; width: 100%;">
      <h1 style="text-align: center;">Cập nhật tủ thuốc</h1>
      <form method="post" action="">
        <label style="padding-top: 50px; padding-left: 50px">Nhập tên thuốc mới: </label>
        <input type="text" id="tenbenhnhan">
        <input class="btn btn3" type="submit" name="" value="Lưu">
      </form>
      <form>
        <label style="padding-top: 50px; padding-left: 50px">Tìm tên thuốc: </label>
        <input type="text" id="timkiem">
      </form>
      <div style="width: 100%;padding-left: 35%; padding-top: 50px">
        <table style="width: 50%" id="mytable">
          <thead style="font-size: 20px">
            <th width="50%">Tên thuốc</th>

          </thead>
          <tbody id="show-tenthuoc" style="font-size: 18px">
          </tbody>
        </table>

      </div>
  </div>


</div>

</body>


</script>
</html>