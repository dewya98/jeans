<?php  
session_start();
include "header.php";
$title=$_POST["q_title"];
$content=$_POST["quest"];
if(isset($_POST["secret"])){
      $secret='1';
}else{
      $secret='0'; 
}
$step=0;
$writeday=date("Y-m-d");
$writer=$_SESSION["id"];
include "conn.php";
$sql="select ifnull(max(q_no),0)+1 as q_no from qna";
$rs=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($rs);
$q_no=$row["q_no"];
$sql="insert into qna(title,content,secret,writeday,writer,step,q_no) 
      values('$title','$content','$secret','$writeday','$writer',$step,$q_no)";
$rs=mysqli_query($conn,$sql);

?>
<meta http-equiv="refresh" content="0;url=itemcontent.php?i_no=<?php echo $i_no ?>">
