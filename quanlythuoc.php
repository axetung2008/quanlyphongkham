<?php
  require_once('./php/config.php');
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
            <th width="20%">Mã thuốc</th>
            <th width="50%">Tên thuốc</th>

          </thead>
          <tbody id="show-tenthuoc" style="font-size: 18px">

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
       var maxRows = 7
       var totalRows = $(table+' tbody tr').length
       console.log(totalRows)
       // $(table+' tbody tr:gt(0)').each(function(){
       //    trnum++
       //    if(trnum > maxRows){
       //      $(this).hide()
       //    }
       //    if(trnum <= maxRows){
       //      $(this).show()
       //    }
       // })
       // if(totalRows > maxRows){
       //    var pagenum = Math.ceil(totalRows/maxRows)
       //    for(var i=1;i<=pagenum;){
       //      $('.pagination').append('<li data-page="'+i+'">\<span>'+ i++ +'<span class="sr-only">(current)</span></span>\</li>').show()
       //    }
       // }
       // $('.pagination li:first-child').addClass('active')
       // $('.pagination li').on('click',function(){
       //    var pagenum = $(this).attr('data-page')
       //    var trindex = 0;
       //    $('.pagination li').removeClass('active')
       //    $(this).addClass('active')
       //    $(table+' tr:gt(0)').each(function(){
       //        trindex++
       //        if(trindex > (maxRows*pagenum) || trindex <= ((maxRows*pagenum)-maxRows)){
       //          $(this).hide()
       //        }else{
       //          $(this).show()
       //        }
       //    })
       // })
       // $(function(){
       //    $('table thead tr:eq(0)').prepend('<th><label>STT</label></th>')
       //    var id = 0;
       //    $('#mytable tbody tr').each(function() {
       //      id++
       //      $(this).prepend('<td style="text-align:center;padding-left: 0px;width:5%">'+id+'</td>')
       //    })
       // })


     </script>
      </div>
  </div>


</div>

</body>


</script>
</html>