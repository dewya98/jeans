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
      content{width: 60%;min-height: 41vh;padding:0 20%;display:flex} 
     .left{width:30%}
     .slider>li>img{width:100%;height:200px}
     .slider{width:100%;margin-top:20px}
     .slider>li{padding:20px 10px}
     .right{width:70%}
     .title{margin-left:5%;height: 50px;font-size: 1.1em;line-height:50px;font-weight: bold;  }
        table{width: 90%;margin:0 auto;}
        table th,td{font-family: sans-serif;font-size: 1em;border-top: 1px solid #999;padding:10px;}      
        input[type=text], textarea, select
        {border:none;outline:none;font-size:.9em;padding:5px}
        .button{margin: 0px 0.6em;padding: 0.5em 0.8em;font-weight: bold;border-radius: 0.8em;background-color: rgb(36,100,171);color: azure;border: none;}          
        .button:hover{color: goldenrod;cursor: pointer;}
        section{width:60%;padding:0 20%;height:35vh;}
        .review{height: 50px;font-size:.9em}
        .review>a{color:royalblue;padding-right:10px}
      .detail{display:flex;justify-content:space-around;}
</style>
<content>
  <div class="left">
    <ul class="slider">
        <li>
        <?php $fname="../fileServer/".$row["img"];?>
          <img src="<?php echo $fname ?>">
        </li>
    </ul>
  </div>
  <div class="right">
    <form name="frm1" method="post">
    <div class="title">
      <input type="hidden" name="i_no" value="<?php echo $row["i_no"] ?>">
      <input type="text" name="name" readonly value="<?php echo $row["name"] ?>"></div>
    <table>
    <tr>
        <th>가격</th>
        <td><input type="text" name="price" readonly value="<?php echo $row["price"] ?>"></td>
    </tr>
    <tr>
        <th>사이즈</th>
        <td>
          <select name="size" required>
            <option label="사이즈">사이즈</option>
            <option value="<?php echo $sizeopt[0]; ?>"><?php echo $sizeopt[0]; ?></option>
            <option value="<?php echo $sizeopt[1]; ?>"><?php echo $sizeopt[1]; ?></option>
            <option value="<?php echo $sizeopt[2]; ?>"><?php echo $sizeopt[2]; ?></option>
          </select>
      </td>
    </tr>
    <tr>
        <th>색상</th>
        <td>
          <select name="color" required >
            <option label="색상">색상</option>
            <option value="<?php echo $coloropt[0]; ?>"><?php echo $coloropt[0]; ?></option>
            <option value="<?php echo $coloropt[1]; ?>"><?php echo $coloropt[1]; ?></option>
            <option value="<?php echo $coloropt[2]; ?>"><?php echo $coloropt[2]; ?></option>
          </select>
        </td>
    </tr>
    <tr>
        <th>수량</th>
        <td><input type="number" name="qty" min="1" max="20" step="1" placeholder="수량" required>
        </td>
    </tr>
    <tr>
        <th>제조사</th>
        <td><?php echo $row["prod"] ?></td>
    </tr>
    <?php if(isset($_SESSION["id"])){ ?>
    <tr>
        <td colspan="2" align="center">
            <input type="button" value="장바구니" class="button" onclick="cart()">
            <input type="button" value="구매하기" class="button" onclick="order()">
        </td>
    </tr>
  <?php }else{ ?>
    <tr>
        <td colspan="2" align="center">
            <input type="button" value="장바구니" class="button" onclick="location.href='login.php'">
            <input type="button" value="구매하기" class="button" onclick="location.href='login.php'">
        </td>
    </tr>
   <?php } ?>
  </table>
</form>
  </div>
 </content>
 <section>
   <div class="review">
     <a href="review.php?i_no=<?php echo $i_no?>">상품리뷰</a>
     <a href="qna.php?i_no=<?php echo $i_no?>">상품문의</a>
   </div>
   <h3>상세보기</h3><br>
   <div class="detail">
   <?php $fname="../fileServer/".$row["img"];?>
          <img src="<?php echo $fname ?>">

     <?php echo nl2br($row["detail"]) ?>
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