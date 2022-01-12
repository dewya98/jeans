    <?php
    session_start();
    include "header.php"; ?>
    <style>
    content{width: 70%;min-height: 76vh;padding:0 15%;display:flex} 
    .col{width: 18%;padding:0 1%;text-align: center;color: darkcyan;font-size:1.1em;border-right:1px solid #eee}
    .my{height: 50px;font-size: 1.3em;line-height: 30px;color: #333;padding:0 20px;
    background: rgba(255,255,255,0.4);font-weight: bold;margin-bottom: 20px;}
    .myinfo{text-align: left;margin-left: 10px;margin-top: 40px;font-size: 0.8em;}
    .myinfo li{padding:10px 0;font-weight:700;color: #333;}
    input[type=search]{width:100%;font-size:.8em}
    .on{text-decoration:underline; color:darkcyan}      
    .right{width:80%}
    h2{color:dodgerblue}
    table{width: 90%;margin:0 auto;}
    table th,td{font-family: sans-serif;font-size: 1em;border-top: 1px solid #999;padding:10px;}      
    table th:not(:last-child){background-color: rgb(36,100,171);color: #fff;}
    input[type=text], textarea, select
    {border:none;outline:none;font-size:.9em;background-color:#eee;padding:5px}
    .button{margin: 0px 0.6em;padding: 0.5em 0.8em;font-weight: bold;border-radius: 0.8em;background-color: rgb(36,100,171);color: azure;border: none;}          
    .button:hover{color: goldenrod;cursor: pointer;}
    @media(max-width:767px){
        content{width: 100%;height: 50em;}
        .title{font-size:2em}       
        .title, .title-nav{margin-left:5%;width:100%} 
        table{width:88%} 
        table td{font-size:.9em}
        textarea,input[type=text]{width:23em;position:none;}
        .btn{display:block;width:6em}
    }

    </style>
    <content>
    <div class="col">
     <div class="my">
      <a href="mypage.php"><i class="fas fa-bars"></i> my menu</a>
     </div>
     <?php if(isset($_SESSION["id"])){ ?>
      <b><?php echo $_SESSION["id"] ?>님</b>
     <?php }else{ ?>
       <b>관리자님</b>
       <?php }  ?> <br>
     <button>개인정보설정</button> <br>
        <ul class="myinfo">
        <li><a href="item-add.php" class="on">상품등록</a></li>
        <li><a href="search.php">상품조회</a>
        <div class="searchbar">
         <form name="frm1">
          <input type="search" name="keyword" placeholder="검색어 입력 후 엔터" onsearch="javascript:search()">
         </form>
        </div>
        </li>
        <li><a href="status.php">주문현황</a></li>
        <li><a href="rank.php">각종통계</a></li>
        </ul>
  </div>
    <div class="right">
    <h2>&ensp;상품등록</h2><br>
    <form enctype="multipart/form-data" name="frm1" method="post" action="item-add.ok.php">
    <table>
    <tr>
        <th>상품명</th>
        <td><input type="text" name="name" size="50" required></td>
    </tr>
    <tr>
        <th>성별</th>
        <td>
        <input type="radio" name="gender" value="male">남성 &ensp;
        <input type="radio" name="gender" value="female">여성 </td>
    </tr>
    <tr>
        <th>가격</th>
        <td><input type="text" name="price" required></td>
    </tr>
    <tr>
        <th>사진</th>
        <td><input type="file" name="img"></td>
    </tr>
    <tr>
         <th>상세보기</th>
         <td><textarea name="detail" rows="5" cols="60"></textarea></td>
    </tr>
    <tr>
        <th>사이즈</th>
        <td><input type="text" name="size" required></td>
    </tr>
    <tr>
        <th>색상</th>
        <td><input type="text" name="color" required></td>
    </tr>
    <tr>
        <th>제조사</th>
        <td><input type="text" name="prod" required></td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            <input type="button" value="완료" class="button" onclick="send()">
            <input type="reset" value="새로작성" class="button">
            <input type="button" value="메인화면" class="button" onclick="location.href='index.php'">
        </td>
    </tr>
  </table>
  </form>
  </div>
 </content>
<?php include "footer.php"; ?>
<script>
    function send(){
       if(frm1.detail.value==""){
           alert("내용을 입력하세요");
           frm1.detail.focus();
           return false;
        }

        document.frm1.submit();
    }
</script>