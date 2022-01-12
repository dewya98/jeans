<?php 
session_start();
include "header.php";
include "conn.php";
?>
        <style>
        fieldset{width:60%;border:2px solid #ddd;padding:30px 0px;margin:30px auto}
        
        .title { padding: 0 7px;
            font-size: 3rem;
            font-weight: bold;
            margin-top: 2rem;
            background: -webkit-linear-gradient(#eee, rgb(6, 70, 143));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        table, th, td, input, select {
             border: 1px solid white;padding: 3px 5px;
        }
        span{color: crimson;font-size: 1.3em;}
        table th {background-color: rgb(36, 100, 171);border-radius: 20px;color: honeydew;}
        input,select {
            height: 1.9em;
            font-size: 0.9em;
            border-radius: 10px;
            border: 1px solid rgb(42, 165, 160);
        }
        p1{color: crimson;font-family: sans-serif;font-size: 1rem;float: right;}
        .btn{width: 220px;margin:20px auto}
        .button {
            display: inline-block;margin-bottom: 5%;
            padding: 1em 1.1em;
            font-weight: bold;
            border-radius: 0.8em;
            background-color: rgb(36, 100, 171);
            color: azure;
            border: none;
            line-height: 0.4em;
        }

        .button:hover {
            color: goldenrod;
            cursor: pointer;
        }
        @media(max-width:767px){
            content{width: 100%;height: 50em;}
            fieldset{width:90%;margin:20px auto;}
            .title{font-size:2.4em}       
            table{width:100%;font-size:.9em} 
            table th{padding:0 3px}
            table td,th{font-size:.9em}
            .typing{width:84%;padding:0 8%}
            .typing>img{display:none}
            textarea{width:20em;position:none;}
            p1{font-size:.8em}
        }

    </style>
    <content>
        <form name=frm1 method="POST" action="signup-ok.php">
            <fieldset>
            <legend class="title">회원가입</legend>
            <table class="form">
                <tr>
                <th>이름 </th>
                <td><input type="text" name="name" autofocus><span>*</span></td>
                </tr>
                <tr>
                <th>ID</th>
                <td><input type="text" name="id"> &nbsp;<input type="hidden" name="idok"><input type="button" value="ID중복확인" onclick="idcheck()"><span>*</span>
                </td>
                </tr>
                <tr>
                <th>PW</th>
                <td><input type="password" name="pw"><span>*</span></td>
                </tr>
                <tr>
                <th>비밀번호확인</th>
                <td><input type="password" name="pwcheck"></td>
                </tr>
                <tr>
                  <th>연락처</th> 
                  <td><input type="text" name="tel"></td>
                </tr>
                <tr>
                  <th>주소</th> 
                  <td><input type="text" name="addr"></td>
                </tr>
                <tr>
                <th>이메일</th>
                <td><input type="text" name="email1" required>@
                <select name="email2">
                    <option value="naver.com">naver.com</option>
                    <option value="gmail.com">gmail.com</option>
                    <option value="paran.com">paran.com</option>
                    <option value="nate.com">nate.com</option>
                    <option value="hotmail.com">hotmail.com</option>
                    <option value="hanmail.net">hanmail.net</option>
                    <option value="daum.net">daum.net</option>
                </select><span>*</span></td>
                </tr>
                <tr>
                  <th>성별</th>
                  <td>
                  <input type="radio" name="gender" value="남성">남성&nbsp;&nbsp;&nbsp; <input type="radio" name="gender" value="여성">여성
                  </td>
                </tr>
            </table>
            <p1>* 는 필수입력란입니다.&nbsp;&nbsp;&nbsp;</p1>
        </fieldset>
        <div class="btn">
        <input type="reset" value="새로작성" class="button"> &nbsp;&nbsp;
        <input type="button" value="회원가입" class="button" onclick="send()">
        </div>
     </form>
   </content>

   <?php  include "footer.php"; ?>
<script>
    function send() {
        if (frm1.name.value == "") {
            alert("이름을 입력하세요");
            frm1.name.focus();
            return false;
        }
        if (frm1.id.value == "") {
            alert("아이디를 입력하세요");
            frm1.id.focus();
            return false;
        }
        if (frm1.idok.value == "") {
            alert("아이디 중복확인을 해주세요");
            frm1.id.focus();
            return false;
        }
        if (frm1.pw.value == "") {
            alert("비밀번호를 입력하세요");
            frm1.pw.focus();
            return false;
        }
        if (frm1.pw.value !== frm1.pwcheck.value) {
            alert("비밀번호가 다릅니다");
              frm1.pw.value="";
            frm1.pwcheck.value="";
            frm1.pw.focus();
            return false;
        }
        document.frm1.submit();
    }

    function idcheck()
    {if(frm1.id.value=="0"){
    alert("체크할 아이디를 입력하세요");
    frm1.id.focus();return false;}
    window.open("id_check.php?id="+frm1.id.value,"pop","width=400 height=150");
    }
</script>