<?php
  require_once 'config.php';
  session_start();
  if(!isset($_SESSION['user'])){
    header("location: login.html");
    exit();
  }
  $tenthuoc = $_POST['ten_thuoc'];

  $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
  mysqli_set_charset($conn,"utf8");
  $query ="INSERT INTO thuoc(ten_thuoc) VALUES ('$tenthuoc')";  
  $conn->query($query); 

  $conn->close();
  header("location: ../quanlythuoc.php");

    
?>