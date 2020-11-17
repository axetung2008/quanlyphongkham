<?php
  require_once('./php/config.php');
  session_start();
  if(!isset($_SESSION['user'])){
    header("location: login.html");
    exit();
  }

  $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
  mysqli_set_charset($conn,"utf8");
  $query ="SELECT * FROM thuoc ORDER BY ten_thuoc DESC";  
  $result = mysqli_query($conn, $query);  
    
?>

<!DOCTYPE html>
<html>
<head>
  <title>Quản lý thuốc</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="./css/index_chung.css"> 
  <style type="text/css">

  </style>
  
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

<div class="container">
  <br />
  <form class="form-inline" action="./php/themthuoc.php" method="post">
  <div class="form-group mx-sm-3 mb-2">
    <label>Nhập tên thuốc mới: </label>
    <input type="text" class="form-control" name="ten_thuoc" autocomplete="off">
  </div>
  <button type="submit" class="btn btn-primary mb-2">Lưu</button>
</form>
</div>

<div class="container">
    
    <h3 align="center">Danh sách thuốc</h3>  

    <div class="table-responsive">  
        <table id="employee_data" class="table table-striped table-bordered">  
          <thead>  
           <tr>  
             <td>ID</td>  
             <td>Ten thuoc</td>  
           </tr>  
          </thead>  
          <?php  
            while($row = mysqli_fetch_array($result)){
              echo '  
                 <tr>  
                 <td>'.$row["ma_thuoc"].'</td>  
                 <td>'.$row["ten_thuoc"].'</td>  
                 </tr>  
                  '; 
            }  
         ?>  
       </table>  
    </div>  
</div>
</body>

</html>

 <script>  
 $(document).ready(function(){  
      $('#employee_data').DataTable();  
 });  
 </script>  