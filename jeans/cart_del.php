<?php  
session_start();
$c_no=$_GET["c_no"];
include "conn.php";
$sql="delete from cart where c_no='$c_no'"; 
$rs=mysqli_query($conn,$sql);
?>
<meta http-equiv="refresh" content="0;url=cart.php">
