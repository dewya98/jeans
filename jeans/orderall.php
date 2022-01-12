<?php
session_start();
$id=$_SESSION["id"];
$i_no=$_POST["i_no"];
$c_no=$_POST["c_no"];
$name=$_POST["name"];
$o_date=date("Y-m-d");
$tot=$_POST["tot"];
$sum=$_POST["sum"];
$price=$_POST["price"];
$qty=$_POST["qty"];
$size=$_POST["size"];
$color=$_POST["color"];
$payment="송금";
$status="입금대기";
include "conn.php";
$sql="insert into checkout(id,o_date,tot,sum,payment,status) 
values('$id','$o_date',$tot,$sum,'$payment','$status')";
$rs=mysqli_query($conn,$sql); 
$sql2="select max(o_no) as o_no from checkout";
$rs2=mysqli_query($conn,$sql2);
$row2=mysqli_fetch_array($rs2);
$o_no=$row2["o_no"];
for($i = 0; $i < count($name); $i++)
{
    $sql1="insert into orderdtl (o_no,c_no,i_no,id,o_date,name,price,qty,sum,size,color,tot,payment,status) 
    values ($o_no,$c_no[$i],$i_no[$i],'$id','$o_date','$name[$i]',$price[$i],$qty[$i],$sum,'$size[$i]','$color[$i]',$tot,'$payment','$status')";
    $rs1=mysqli_query($conn,$sql1);
}
?>
<meta http-equiv="refresh" content="0;url=checkout.php">
