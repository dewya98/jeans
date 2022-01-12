<?php  
session_start();
$name=$_POST["name"];
$price=$_POST["price"];
$gender=$_POST["gender"];
$o_date=date("Y-m-d");
$uploaddir=$_SERVER["DOCUMENT_ROOT"]."/fileServer/";  
$img=basename($_FILES["img"]["name"]);  
$uploadfile=$uploaddir.$img;   
move_uploaded_file($_FILES["img"]["tmp_name"],$uploadfile); 
$detail=$_POST["detail"];
$prod=$_POST["prod"];
$size=$_POST["size"];
$color=$_POST["color"];
include "conn.php";
$sql="insert into item(name,price,gender,o_date,img,detail,prod,size,color) 
values('$name',$price,'$gender','$o_date','$img','$detail','$prod','$size','$color')";
mysqli_query($conn,$sql);
?>
<meta http-equiv="refresh" content="0;url=index.php">
