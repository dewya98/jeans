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
.content{width: 84%;}
.mynav{display:flex;height: 50px;line-height: 50px;font-size: 1.3em;font-weight: bold;color:darkcyan;}
.mynav>a{padding:0 20px;}
.searchbar{width:100%;height:30px;padding-top:10px;background-color:rgba(255,255,255,0.5);}
.on{text-decoration:underline; color:darkcyan}   
input[type=search]{width:100%;font-size:.8em}   
.content a{color:darkcyan}    
.itemlist{margin:20px;}
h2{line-height:2.5em}
table{margin:20px 0;width:100%}
input[type=text], textarea{border:none;outline:none;width:4em;text-align:center}
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
       <b>관리자님</b>
       <?php }  ?> <br>
     <button>개인정보설정</button> <br>
        <ul class="myinfo">
        <li><a href="item-add.php">상품등록</a></li>
        <li><a href="#">상품조회</a>
        <div class="searchbar">
         <form name="frm1">
          <input type="search" name="keyword" placeholder="검색어 입력 후 엔터" onsearch="javascript:search()">
         </form>
        </div>
        </li>
        <li><a href="status.php" class="on">주문현황</a></li>
        <li><a href="rank.php">각종통계</a></li>
        </ul>
  </div>
      <div class="content">
        <div class="mynav">
          <a href="mypage.php">구매내역</a>
          <a href="cs.php">문의내역</a>
          <a href="mypage.php">이벤트 / 마일리지</a>
        </div>
        <div class="itemlist">
          <h2>주문현황</h2>
          <br>
          <table>
            <tr>
            <th>주문일자</th><th>주문번호</th>
              <th>주문상품</th><th>수량</th>
              <th>결제금액</th><th>주문처리</th>
            </tr>
            <?php 
            $id=$_SESSION["id"]; 
            include "conn.php";
            $sql="select * from orderdtl group by o_no";
            $rs=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_array($rs)){ ?>
              <tr>
               <td><?php echo $row["o_date"] ?></td>
               <td><?php echo $row["o_no"] ?></td>
               <td><a href="orderdtl.php?o_no=<?php echo $row["o_no"] ?>"><?php echo $row["name"] ?>..</a></td>
               <td><?php echo $row["tot"] ?></td>
               <td><?php echo number_format($row["sum"]) ?></td>
               <td>
                <input type="button" value="입금확인" onclick="order(<?php echo $row["c_no"] ?>)">
                <input type="button" value="취소" onclick="del(<?php echo $row["c_no"] ?>)">                
              </td>
            </tr> 
               <?php } ?>
               <tr>
                   <td colspan="6" align="center">
                       수량:<?php
                    $sqlqty="select sum(qty)as tot from orderdtl";
                    $rsq=mysqli_query($conn,$sqlqty);
                    $rowq=mysqli_fetch_array($rsq); ?>
                    <?php echo $rowq["tot"] ?>
                   &emsp;
                    총금액:
                    <?php
                    $sqlnet="select sum(price*qty) as net from orderdtl"; 
                    $rsnet=mysqli_query($conn,$sqlnet);
                    $rown=mysqli_fetch_array($rsnet); ?>
                    <?php echo number_format($rown["net"]) ?>
                  </td>
              </tr>
         </table>
      </div>
     </div>
   </div>   
 </content>
<?php include "footer.php"; ?>
<script>
  function search(){
  location.href="search.php?keyword="+frm1.keyword.value;
        }
</script>