<?php
session_start();
$id=$_SESSION["id"];
$c_no=$_POST["c_no"];
include "conn.php";
for($i = 0; $i < count($c_no); $i++){
$sqldel="delete from cart where c_no=$c_no[$i] and id='$id'";
mysqli_query($conn,$sqldel);
}
$sqlemp="delete from checkout where id='$id'";
mysqli_query($conn,$sqlemp);
?>
<meta http-equiv="refresh" content="0;url=ordered.php">

