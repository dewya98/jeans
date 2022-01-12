<?php
session_start();
$i_no=$_POST["i_no"];
$id=$_SESSION["id"];
$name=$_POST["name"];
$date=date("Y-m-d");
$price=$_POST["price"];
$qty=$_POST["qty"];
$size=$_POST["size"];
$color=$_POST["color"];
include "conn.php";
$sql="insert into cart(i_no,id,name,date,price,qty,size,color) 
values($i_no,'$id','$name','$date',$price,$qty,'$size','$color')";
mysqli_query($conn,$sql);
?>
<meta http-equiv="refresh" content="0;url=cart.php">
