<?php
session_start();
include "header.php";
$i_no=$_GET["i_no"];
include "conn.php";
$sql="select * from item where i_no=$i_no";
$rs=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($rs);
$sizeopt=explode('/',$row["size"],3);
$coloropt=explode('/',$row["color"],3);
?>
<style>
      content{width: 60%;min-height: 20vh;padding:0 20%;display:flex} 
     .left{width:30%}
     .slider{width:100%;margin-top:20px}
     .slider>li{padding:20px 10px}
     .slider>li>img{width:100%;height:100px;vertical-align:middle}
     .right{width:70%;}
     .title{margin:10% 20px;font-size: 1.1em;line-height:50px;font-weight: bold;}
     .title>a{color:darkcyan}
     section{width:60%;padding:0 20%;min-height:52vh;}
    .typing{width:100%}
    .text{border:1px solid #ccc;padding:10px 0}
     input[type=text]
        {border:none;outline:none;font-size:.9em;padding:5px}
     textarea{width:100%;height: 100px;border:1px solid #ccc;}
     h4{margin: 20px 0;}
    .btn{margin: 0px 0.6em;padding: 0.5em 0.8em;font-weight: bold;border-radius: 0.8em;background-color: rgb(36,100,171);color: azure;border: none;}          
    .btn:hover{color: goldenrod;cursor: pointer;}
    .review{height: 50px;font-size:.9em}
    .review>a{color:royalblue;padding-right:10px}
    .detail{display:flex;justify-content:space-around;}
</style>
<content>
    <div class="left">
      <h2>문의하기</h2>
    <ul class="slider">
        <li>
        <?php $fname="../fileServer/".$row["img"];?>
          <img src="<?php echo $fname ?>">
        </li>
    </ul>
  </div>
  <div class="right">
    <div class="title">
      상품명: <br>
      <a href="itemcontent.php?i_no='<?php echo $row["i_no"] ?>'">
      <?php echo $row["name"] ?></a></div>
  </div>
 </content>
 <section>
 <div class="typing">
    <form name="ask" method="post" action="qna_ok.php">
    <h4>제목:</h4>
      <div class="text">
         <input type="text" name="q_title"> 
      </div> 
      <label for="secret"> 비밀글: <input type="checkbox" name="secret" value="1" id="secret"></label><br>
      <h4>문의사항</h4>
      <textarea placeholder="문의사항 남기기" name="quest"></textarea>
    <input type="button" value="취소" class="btn" onclick="location.href='itemcontent.php?i_no=<?php echo $i_no ?>'">
    <input type="button" value="문의하기" class="btn" onclick="inquiry()">
    </form>
        </div>
 </section>
<?php include "footer.php"; ?>
<script>
  function cart(){
    if(frm1.size.value==''){
        alert("사이즈를 선택하세요");
        frm1.size.focus();return false();
        }
    if(frm1.color.value==''){
        alert("색상을 선택하세요");
        frm1.color.focus();return false();
        }
      document.frm1.action="cart_add.php";
      document.frm1.submit();
  }
  function order(){
    if(frm1.size.value==''){
        alert("사이즈를 선택하세요");
        frm1.size.focus();return false();
        }
    if(frm1.color.value==''){
        alert("색상을 선택하세요");
        frm1.color.focus();return false();
        }
        document.frm1.action="order_add.php";
        document.frm1.submit();
  }
</script>