<?php  
session_start();
$o_no=$_GET["o_no"];
include "conn.php";
$sql="delete from orderdtl where o_no='$o_no'"; 
$rs=mysqli_query($conn,$sql);
?>
<meta http-equiv="refresh" content="0;url=index.php">
