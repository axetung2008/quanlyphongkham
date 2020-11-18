<?php
  session_start();
  if (!isset($_SESSION['user'])) {
    header("location: login.html");
    exit();
  }
  require_once('./php/config.php');

  $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
  mysqli_set_charset($conn,"utf8");

  $query = "SELECT benh_nhan.ho_ten, don_thuoc.chi_phi, xu_ly_don_thuoc.trang_thai, xu_ly_don_thuoc.ma_don_thuoc FROM ((don_thuoc INNER JOIN benh_nhan ON benh_nhan.ma_benh_nhan = don_thuoc.ma_benh_nhan) INNER JOIN xu_ly_don_thuoc ON xu_ly_don_thuoc.ma_don_thuoc =don_thuoc.ma_don_thuoc) WHERE xu_ly_don_thuoc.trang_thai = '1'";
  $result_xuly = mysqli_query($conn,$query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Khám bệnh</title>
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
    body {
      background: #1abc9c;
    }
    label {
      font-size: 25px;
    }
    input {
      font-size: 25px;

    }
  </style>

  <script>
    $(document).ready(function(){
      var madonthuoc;
      $(".dt").on("click",function(){
        console.log(this.id);
        madonthuoc = this.id;
        $("#data").load("./php/load-chitiet.php", {
            newid : madonthuoc
        });
        $("#benhnhan").load("./php/load-benhnhan.php", {
            newid : madonthuoc
        });
      });
    });
  </script>

  <script src="./js/suggest.js"></script>

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
        <li><a href="./chucnang.php">Quản lý</a></li>
      </ul>
    </div>
  </div>
</nav>

<div style="margin-left: 100px; margin-right: 100px;" id="blur">

  <!-- LEFT -->
  <div style="float: left; background: white; height: 800px; width: 50%;">
    <h1 style="text-align: center;">Danh sách đơn thuốc</h1> 
    <div style="padding-top: 20px; padding-left: 20px">
        <table style="width: 80%">
          <thead style="font-size: 20px">
            <th width="40%" >Họ tên</th>
            <th width="20%">Chi phí</th>
            <th width="20%">Chi tiết</th>

          </thead>
          <tbody style="font-size: 18px">
                <?php 
                    while($row=mysqli_fetch_assoc($result_xuly)){
                    $madt = $row['ma_don_thuoc'];
                ?>
                    <tr>
                    <td style="padding: 5px;padding-left: 20px"> <?php echo $row['ho_ten'] ?> </td>
                    <td style="padding: 5px"> <?php echo $row['chi_phi'] ?> </td>
                    <td style="padding: 5px"><button id="<?php echo $madt?>" class="dt">Xem</button></td>
                    </tr>
                <?php 
                    }
                ?>
          </tbody>
        </table>
      </div>
  </div>

  <!-- RIGHT -->
  <div style=" float: left;background: white; height: 800px;width: 50%;">
    <h1 style="text-align: center;">Chi tiết đơn thuốc</h1>
    <table>
      <thead id="benhnhan">
        
      </thead>
      <tr>
        <th><h4>STT</h4></th>
        <th style="padding-left: 80px"><h4>Tên thuốc</h4></th>
        <th style="padding-left: 100px"><h4>Số lượng</h4></th>
      </tr>
      <tbody id="data">
          
      </tbody>
    </table>
  </div>
</div>





</body>
</html>
