<?php
//gan gia tri id cho bien
$sid = $_GET['sid'];

//ket noi toi csdl
require_once 'connect.php';

//viet cau lenh sql
$xoasql = "DELETE FROM hoa WHERE id='$sid'";

IF (mysqli_query($conn,$xoasql)){
    //in ra thon bao    
    header("location: list_hoa.php");
}
