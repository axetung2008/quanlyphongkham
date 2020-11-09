<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("location: login.html");
  exit();
}
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
    $(document).ready(function () {
      $("#print").click(function () {
        var mode = 'iframe';
        var close = mode == "popup";
        var options = {mode: mode, popClose: close, popTitle: 'Don thuoc'};
        $("div.print_area").printArea(options);
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
      <form name="myForm" action="./php/thembenhnhan.php" method="post">
        <label>Họ tên:</label><br>
        <input type="text" id="hoten" name="ho_ten" autocomplete="off" required="" style="width: 80%; height: 35px;"><br><br>
        <label>Địa chỉ:</label><br>
        <input type="text" id="diachi" name="dia_chi" required="" style="width: 80%; height: 35px;"><br>
        <label style="margin-top: 30px">Giới tính</label>
        <input type="radio" id="nam" name="gioi_tinh" value="nam" checked="" style="margin-left: 50px" onclick="male()">
        <label>Nam</label>
        <input type="radio" id="nu" name="gioi_tinh" value="nu" style="margin-left: 50px" onclick="female()">
        <label>Nữ</label><br>
        <label style="margin-top: 30px">Năm sinh</label>
        <input type="" name="nam_sinh" id="namsinh" style="width: 200px" onchange="returnOlds()">
        <label style="margin-left: 50px">Tuổi</label>
        <input type="" name="tuoi" id="tuoi" required="" style="width: 80px" onchange="returnYears()"><br>
        <a href="./quanlydonthuoc.php" target="_blank">
          <button type="button" class="btn btn3" style="width: 85%;margin-top: 270px">Bệnh án cũ</button>
        </a>

        <!-- <iframe src="./timbenhnhan.html" style="height: 200px; width: 600px"></iframe> -->

    </div>
  </div>

  <!-- RIGHT -->
  <div style=" float: left;background: white; height: 800px;width: 50%;">
    <h1 style="text-align: center;">Đơn thuốc</h1>
    <div style="margin-left: 20px">
      <label>Chẩn đoán</label><br>
      <textarea id="chan_doan" name="chan_doan" required="" rows="2" style="font-size: 20px;width: 90%"></textarea><br>

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


      <button type="button" class="btn btn3" onclick="toggle(),takeData()" style="width: 85%;">Xem đơn thuốc</button>
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
  <button class="btn btn1" type="button" id="print" onclick="name()">Print</button>


  <button type="button" class="btn btn2" onclick="toggle()">Close</button>
  </form>
</div>


<script type="text/javascript">
  var d = new Date();
  var nam = 1;
  var nu = 1;

  function male() {
    return nu = 0;
  }

  function female() {
    return nam = 0;
  }

  function returnOlds() {
    var namsinh = document.getElementById("namsinh").value;
    var tuoi = document.getElementById("tuoi");
    tuoi.value = d.getFullYear() - namsinh;
  }

  function returnYears() {
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

  function takeData() {
    var diachi = document.getElementById("diachi").value;
    var name = document.getElementById("hoten").value;
    var tuoi = document.getElementById("tuoi").value;
    var chandoan = document.getElementById("chan_doan").value;

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

    var gioitinh = "nam";
    if (nam == 1 && (nu == 0)) {
      gioitinh = "nam";
    }
    if ((nam == 0) && (nu == 1)) {
      gioitinh = "nu";
    }

    document.getElementById("print_name").innerHTML = name;
    document.getElementById("print_diachi").innerHTML = diachi;
    document.getElementById("print_gioitinh").innerHTML = gioitinh;
    document.getElementById("print_tuoi").innerHTML = tuoi;
    document.getElementById("print_chandoan").innerHTML = chandoan;

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
    //document.getElementById("print_chieu").innerHTML = chandoan;
  }

  //tab====================================================
  var tabButtons = document.querySelectorAll(".tabContainer .buttonContainer button");
  var tabPanels = document.querySelectorAll(".tabContainer  .tabPanel");

  function showPanel(panelIndex, colorCode) {
    tabButtons.forEach(function (node) {
      node.style.backgroundColor = "";
      node.style.color = "";
    });
    tabButtons[panelIndex].style.backgroundColor = colorCode;
    tabButtons[panelIndex].style.color = "white";
    tabPanels.forEach(function (node) {
      node.style.display = "none";
    });
    tabPanels[panelIndex].style.display = "block";
    tabPanels[panelIndex].style.backgroundColor = colorCode;
  }

  showPanel(0, '#6e6e6e');


</script>


</body>
</html>
