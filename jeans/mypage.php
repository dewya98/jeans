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
input[type=text], textarea, select{border:none;outline:none;text-align:center}
table tr{height: 2.2em;}
  table th,td{border-top: 1px solid #999;text-align: center;padding: 5px 20px;font-size:.9em}      
  table th{border-top: 2px solid darkcyan;background-color: #eee;}
table tr a:hover{color: orange;}
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
          <h2>My Page</h2>
          <!-- <a href="mypage.php"><small>지난 주문내역 보기</small></a> -->
          <form name="cart" method="post"></form>
          <table>
          <tr>
              <th>주문일자</th><th>주문번호</th><th>이미지</th>
              <th>주문상품</th><th>사이즈</th><th>색상</th>
              <th>수량</th><th>결제금액</th><th>주문상태</th>
            </tr>
            <?php 
            $id=$_SESSION["id"]; 
            include "conn.php";
            $sql="select item.img,customer.name as customer, customer.tel, customer.addr,
            orderdtl.o_no, orderdtl.i_no, orderdtl.name, orderdtl.tot, orderdtl.o_date,
            orderdtl.size, orderdtl.color,orderdtl.sum,orderdtl.status
            from orderdtl 
            INNER JOIN item 
            on orderdtl.i_no=item.i_no 
            INNER JOIN customer 
            on orderdtl.id=customer.id 
            where orderdtl.id='$id' group by o_no desc";
            $rs=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_array($rs)){ ?>
              <tr>
               <td><?php echo $row["o_date"] ?></td>
               <td><?php echo $row["o_no"] ?></td>
               <td> <?php $fname="../fileServer/".$row["img"];?>
          <img src="<?php echo $fname ?>"></td>
               <td><a href="orderdtl.php?o_no=<?php echo $row["o_no"] ?>"><?php echo $row["name"] ?>..</a></td>
               <td><?php echo $row["size"] ?></td>
               <td><?php echo $row["color"] ?></td>
               <td><?php echo $row["tot"] ?></td>
               <td><?php echo number_format($row["sum"]) ?></td>
               <td>
                <input type="button" value="<?php echo $row["status"] ?>">
                <input type="button" value="반품하기" onclick="cancel(<?php echo $row["o_no"] ?>)">                
                <input type="button" value="리뷰작성" onclick="review(<?php echo $row["i_no"] ?>)">                
               </td>
            </tr> 
            <?php } ?>
            </table>
            고객 정보
            <table>
            <?php
            $sqlcus="select customer.name as customer, customer.tel, customer.addr from customer where id='$id'";
            $rs=mysqli_query($conn,$sqlcus);
            $rowcus=mysqli_fetch_array($rs); ?>
            <tr>
                <th>이름</th>
                <td><?php echo $rowcus["customer"] ?></td>
            </tr>
            <tr>
                <th>주소</th>
                <td><?php echo $rowcus["addr"] ?></td>
            </tr>
            <tr>
                <th>연락처</th>
                <td><?php echo $rowcus["tel"] ?></td>
            </tr>
            <tr>
              <td colspan="8" align="center">
                  <input type="button" value="정보수정" onclick="location.href='order_ok.php'"> 
                  <input type="button" value="쇼핑계속하기" onclick="location.href='index.php'">               
              </td>
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
    function cancel(o_no){
        if(confirm("반품 하시겠습니까?")){
            location.href="return.php?o_no="+o_no;
        }
    }
    function review(i_no){
      location.href="review-add.php?i_no="+i_no;
    }
</script>
