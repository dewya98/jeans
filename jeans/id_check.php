<?php
session_start(); 
$id=$_GET["id"];
include "conn.php";
$sql="select count(*) as cnt from customer where id='$id'";
$rs=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($rs);
?>
<html>
    <head>
        <title>아이디중복확인</title>
    </head>
    <body>
        <br>
        <div>
            <?php 
            if($row["cnt"]){?>
            사용중인 아이디입니다
            <a href="javascript:send1()"><font color="orange">새로작성</a>

           <?php }else{ ?>
            사용가능한 아이디입니다
            <a href="javascript:send2()"><font color="orange">사용하기</a>
            <?php } ?>
        </div>
    </body>
</html>
<script>
    function send1(){
        opener.document.frm1.id.value="";
        opener.document.frm1.id.focus();
        self.close();
    }
    function send2(){
        opener.document.frm1.idok.value="ok";
        opener.document.frm1.pw.focus();
        self.close();

    }
</script>