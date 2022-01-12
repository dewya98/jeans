<?php
session_start();
include "header.php";
$name=$_POST["name"];
$id=$_POST["id"];
$pw=$_POST["pw"];
$tel=$_POST["tel"];
$addr=$_POST["addr"];
$email1=$_POST["email1"];
$email2=$_POST["email2"];
$email=$email1."@".$email2;
$gender=$_POST["gender"];
$j_date=date("Y-m-d");
include "conn.php";
$sql="insert into customer(name,id,pw,tel,addr,email,gender,j_date) 
    values('$name','$id','$pw','$tel','$addr','$email','$gender','$j_date')";
mysqli_query($conn,$sql);
?>
 <meta http-equiv="refresh" content="0;url=login.php">

