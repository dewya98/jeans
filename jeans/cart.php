<?php
session_start();
include "header.php";
?>
<style>
 content{width: 80%;min-height:75vh;padding:0 10%;display:flex} 
.wrap{width:100%;position: relative;top:0 ;left: 0;display: flex;}
.col, .content{padding:5px 10px}
button{padding: 3px 10px;}
.col{width: 15%;text-align: center;color: darkcyan;font-size:1.1em;border-right:1px solid #eee}
.my{height: 50px;font-size: 1.3em;line-height: 30px;color: #333;padding:0 20px;
  background: rgba(255,255,255,0.4);font-weight: bold;margin-bottom: 20px;}
.myinfo{text-align: left;margin-left: 10px;margin-top: 40px;font-size: 0.8em;}
.myinfo li{padding:10px 0;font-weight:700;color: #333;}
.myinfo li:nth-child(1)::after{content: " owner";color: darkgreen;font-size: 1.3em;}
.myinfo li:nth-child(2)::after{content: " 10,000";color: darkgreen;font-size: 1.3em;}
.myinfo li:nth-child(3)::after{content: " 0개";color: darkgreen;}
.content{width: 84%;}
.mynav{display:flex;height: 50px;line-height: 50px;font-size: 1.3em;font-weight: bold;color:darkcyan;}
.mynav>a{padding:0 20px;}
.content a{color:darkcyan}    
.itemlist{margin:20px;}
h2{line-height:2.5em}
table{margin:20px 0;width:100%}
input[type=text], textarea, select{border:none;outline:none;width:4em;text-align:center}
#name{width:auto}
table tr{height: 2.2em;}
  table th,td{border-top: 1px solid #999;text-align: center;padding: 5px 10px;font-size:.9em;}      
  table th{border-top: 2px solid darkcyan;background-color: #eee;}
table tr td>a:hover{color: orange;cursor: pointer;}
table tr td>img{width: 100px;height: 80px;}
.cs{background:#fff;height: 14vh;line-height: 4vh;padding: 20px 30px;font-weight: bold;
   position: fixed;right: 20px;top:50px;box-shadow: 0 10px 20px #999;}
.cs button{border-color: darkcyan;border-radius: 10px;font-weight: bold;}
.cs b{color: darkcyan;font-size: larger;}
@media (max-width:1200px){
  content{width:90%}
  .cs{right:80%;top: 450px; }
}
</style>
<content>
<div class="wrap"> 
  <div class="col">
     <div class="my">
      <a href="mypage.php"><i class="fas fa-bars"></i> my menu</a>
     </div>
     <?php if(isset($_SESSION["id"])){ ?>
      <b><?php echo $_SESSION["id"] ?>님</b>
     <?php }else{ ?>
       <b>방문자님</b>
       <?php }  ?> <br>
     <button>개인정보설정</button> <br>
        <ul class="myinfo">
          <li>등급:</li>  
          <li>마일리지:</li>  
          <li>쿠폰:</li> 
        </ul>
  </div>
      <div class="content">
        <div class="mynav">
          <a href="mypage.php">구매내역</a>
          <a href="cs.php">문의내역</a>
          <a href="mypage.php">이벤트 / 마일리지</a>
        </div>
        <div class="itemlist">
          <h2>장바구니</h2>
          <small>2022년</small>&emsp;<a href="mypage.php"><small>지난 주문내역 보기</small></a>
          <br>
          <form name="cart" method="post">
          <table>
            <tr>
              <th></th><th>이미지</th>
              <th>상품명</th><th>사이즈</th><th>색상</th>
              <th>수량</th><th>금액</th><th>결제금액</th><th></th>
            </tr>
            <?php 
            $id=$_SESSION["id"]; 
            include "conn.php";
            $sql2="select count(*) as cnt from cart where id='$id'";
            $rs2=mysqli_query($conn,$sql2);
            $row2=mysqli_fetch_array($rs2);
            $cnt=$row2["cnt"]; 
            $i=0;
            $sql="select item.img,cart.c_no, cart.i_no, cart.name, cart.qty, cart.price, cart.size, cart.color
            from cart 
            INNER JOIN item 
            on cart.i_no=item.i_no 
            where cart.id='$id'";
            $rs=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_array($rs)){ $i++; ?>
            <tr>
               <td><input type="checkbox" name="select">
               <input type="hidden" name="i_no[]" value="<?php echo $row["i_no"] ?>">
               <input type="hidden" name="c_no[]" value="<?php echo $row["c_no"] ?>">
              </td>
               <td><?php $fname="../fileServer/".$row["img"];?>
                   <img src="<?php echo $fname ?>"></td>
               <td>
                 <a href="itemcontent.php?i_no=<?php echo $row["i_no"] ?>">
                 <input type="text" name="name[]" value="<?php echo $row["name"] ?>" id="name" readonly></a></td>
               <td><input type="text" name="size[]" value="<?php echo $row["size"] ?>" readonly></td>
               <td><input type="text" name="color[]" value="<?php echo $row["color"] ?>" readonly></td>
               <td><input type="text" name="qty[]" value="<?php echo $row["qty"] ?>" readonly></td>
               <td>
                 <input type="text" value="<?php echo number_format($row["price"]) ?>" readonly>
                 <input type="hidden" name="price[]" value="<?php echo $row["price"] ?>">
                </td>
               <?php  
               $cost=$row["qty"]*$row["price"]; ?>
               <td><?php echo number_format($cost) ?></td>
               <td>
                <input type="button" value="구매하기" onclick="order(<?php echo $row["c_no"] ?>)">
                <input type="button" value="삭제" onclick="del(<?php echo $row["c_no"] ?>)">                
              </td>
            </tr>
               <?php } ?>
               <tr>
                   <td colspan="9" align="center">
                       수량:<?php
                    $sqlqty="select sum(qty) as tot, qty from cart where id='$id'";
                    $rsq=mysqli_query($conn,$sqlqty);
                    $rowq=mysqli_fetch_array($rsq); ?>
                    <input type="text" name="tot" value="<?php echo $rowq["tot"] ?>">
                   
                    총금액:
                    <?php
                    $sqlnet="select sum(qty*price) as net from cart where id='$id'"; 
                    $rsnet=mysqli_query($conn,$sqlnet);
                    $rown=mysqli_fetch_array($rsnet); ?>
                    <input type="text" value="<?php echo number_format($rown["net"]) ?>">
                    <input type="hidden" name="sum" value="<?php echo $rown["net"] ?>">
                  </td>
                <tr>
                <td colspan="9" align="center">
                      <input type="button" value="모두구매하기" onclick="orderall()"> 
                      <input type="reset" value="비우기" onclick="empty()">                
                      <input type="button" value="쇼핑계속하기" onclick="location.href='index.php'">               
                  </td>
                </tr>
            </tr>
         </table>
       </form>
      </div>
     </div>
     
     <div class="cs">
       고객센터 <br>
       <b>1577-1234 </b> <br>
       <button>1:1 문의하기</button>
     </div>
    </div>   
 </content>
<?php include "footer.php"; ?>
<script>
    function del(c_no){
        if(confirm("삭제하시겠습니까?")){
            location.href="cart_del.php?c_no="+c_no;
        }
    }
    function empty(){
        if(confirm("장바구니를 비울까요?")){
            location.href="cartemp.php";
        }
    }
    function orderall(){
        document.cart.action="orderall.php";
        document.cart.submit();
  }

</script>
