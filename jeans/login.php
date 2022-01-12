<?php
session_start();
include "header.php";
?>
<style>
.wrap{width: 80vw;height: 69vh;margin:0 auto 50px;filter: blur(50px);position: relative;top:75px;
background: url(images/loginbg.png)no-repeat center;background-size: contain;
}
table{margin: 0 auto;position: absolute;left: 50%;transform: translateX(-50%);top:30%;width: 400px;height: 350px;
  background: rgba(255,255,255,0.1);border-radius: 15px;
      border-top: 1px solid #fff;border-left: 1px solid #fff;box-shadow: 0 25px 45px rgba(0,0,0,0.1);
    backdrop-filter: blur(5px);}
h1{font-size:2.4em;}
table tr{height: 50px;color:darkcyan;}
table td,th{padding: 5px 10px;}
table input[type=text],table input[type=password]
    {width: 20em;border: none;line-height: 30px;border-radius: 15px; padding: 2px 10px;
      background: rgba(255,255,255,0.4);outline: none;}
table tr:nth-child(5){font-size:0.8em;color:#fff}      
table tr:nth-child(5) a{font-size:1em;color:cyan;display: inline; }      
table input[type=button]{padding: 5px 25px;border-radius: 15px;font-weight: 700;color: darkcyan;}
table tr:nth-child(6){font-size:0.8em;color:#fff}      
table tr:nth-child(6) a:hover{color:orange}      
</style>
<div class="wrap"> </div>
      <form name="frm1" method="POST" action="login_ok.php">
        <table border="0" cellspacing="8">
        <tr>
            <td colspan="2" align="center"><h1>Login </h1></td>
        </tr>
        <tr>
            <th>ID</th>
            <td><input type="text" name="id" placeholder="아이디를 입력하세요"></td>
        </tr>
        <tr>
            <th>PW</th>
            <td><input type="password" name="pw" placeholder="비밀번호를 입력하세요"></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="button" value="로그인" onclick="send()">
        </tr>
        <tr>
          <td colspan="2" align="center">
            아이디가 생각나지 않으세요? <a href="idfinder.php" target="_blank">&ensp; 아이디 찾기</a><br>
            비밀번호가 생각나지 않으세요? <a href="idfinder.php" target="_blank">&ensp; 비밀번호 찾기</a>
       </tr>
       </table>
    </form>
    <?php include "footer.php"; ?>
    <script>
    function send(){
        if(frm1.id.value==""){
            alert("아이디를 입력하세요");
            frm1.id.focus();
            return false;
        }
       if(frm1.pw.value==""){
           alert("비밀번호를 입력하세요");
           frm1.pw.focus();
           return false;
        }

        document.frm1.submit();
    }
</script>