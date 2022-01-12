<?php 
session_start();
$i_no=$_POST["i_no"]; 
$title=$_POST["title"];
$id=$_SESSION["id"];
$w_date=date("Y-m-d");
$content=$_POST["content"];
$uploaddir=$_SERVER["DOCUMENT_ROOT"]."/fileServer/";  
$img=basename($_FILES["img"]["name"]);  
$uploadfile=$uploaddir.$img;   
move_uploaded_file($_FILES["img"]["tmp_name"],$uploadfile); 
include "conn.php";
$sql="insert into review(i_no,title,id,w_date,content,img) values ($i_no,'$title','$id','$w_date','$content','$img')";
mysqli_query($conn,$sql);
?>
<meta http-equiv="refresh" content="0;url=itemcontent.php?i_no=<?php echo $i_no ?>">

