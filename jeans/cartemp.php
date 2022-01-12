<?php  
session_start();
$id=$_SESSION["id"];
include "conn.php";
$sql="delete from cart where id='$id'"; 
$rs=mysqli_query($conn,$sql);
?>
<meta http-equiv="refresh" content="0;url=cart.php">
