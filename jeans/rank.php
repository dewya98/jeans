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
.searchbar{width:100%;height:30px;padding-top:10px;background-color:rgba(255,255,255,0.5);}
input[type=search]{width:100%;font-size:.8em}   
.content{width: 84%;}
.mynav{display:flex;height: 50px;line-height: 50px;font-size: 1.3em;font-weight: bold;color:darkcyan;}
.mynav>a{padding:0 20px;}
.on{text-decoration:underline; color:darkcyan}   
.content a{color:darkcyan}    
.itemlist{margin:20px;}
h2{line-height:1.5em;}
table{margin:0 0 20px;width:100%}
input[type=text]{border:none;outline:none;width:4em;text-align:center}
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
        <li><a href="status.php">주문현황</a></li>
        <li><a href="rank.php" class="on">각종통계</a></li>
        </ul>
  </div>
      <div class="content">
        <div class="mynav">
          <a href="mypage.php">구매내역</a>
          <a href="cs.php">문의내역</a>
          <a href="mypage.php">이벤트 / 마일리지</a>
        </div>
        <div class="itemlist">
        <h3>누적집계</h3>   
        <table>
               <tr>
                   <th>수량:</th>
                      <td><?php
                    $date=date("Y-m-d");
                    include "conn.php";
                    $sqlqty="select sum(qty)as tot from orderdtl";
                    $rsq=mysqli_query($conn,$sqlqty);
                    $rowq=mysqli_fetch_array($rsq); ?>
                    <?php echo $rowq["tot"] ?>
                    </td>
                   <th>총금액:</th>
                    <td><?php
                    $sqlnet="select sum(price*qty) as net from orderdtl"; 
                    $rsnet=mysqli_query($conn,$sqlnet);
                    $rown=mysqli_fetch_array($rsnet); ?>
                    <?php echo number_format($rown["net"]) ?>
                    </td>
              </tr>
            </table>
          <h3>일별집계</h3>
          <br>
          <table>
            <tr>
            <th>주문일자</th><th>판매량</th>
              <th>결제금액</th>
            </tr>
            <?php 
            $sql="select orderdtl.*, sum(qty)as sum, sum(price*qty) as net from orderdtl 
            GROUP by o_date order by sum desc limit 7";
            $rs=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_array($rs)){ ?>
              <tr>
               <td><a href="orderdtl.php?o_no=<?php echo $row["o_no"] ?>"><?php echo $row["o_date"] ?></a></td>
               <td><?php echo number_format($row["sum"]) ?></td>
               <td><?php echo number_format($row["net"]) ?></td>
            </tr> 
               <?php } ?>
         </table>
          <h3>월별집계</h3>
          <br>
          <table>
            <tr>
            <th>주문 월</th><th>판매량</th>
              <th>결제금액</th>
            </tr>
            <?php 
            $sql="select month(o_date)as month,year(o_date) as year,sum(qty) as sum, sum(qty*price) as net 
            from orderdtl group by year(o_date),month(o_date) order by year(o_date),month(o_date)";
            $rs=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_array($rs)){ ?>
              <tr>
               <td><a href="orderdtl.php?o_no=<?php echo $row["o_no"] ?>">
               <?php echo $row["year"] ?>-<?php echo $row["month"] ?></a></td>
               <td><?php echo number_format($row["sum"]) ?></td>
               <td><?php echo number_format($row["net"]) ?></td>
            </tr> 
               <?php } ?>
         </table>
          <h3>연간집계</h3>
          <br>
          <table>
            <tr>
            <th>주문연도</th><th>판매량</th>
              <th>결제금액</th>
            </tr>
            <?php 
            $sql="select date_format(o_date,'%Y')as year,sum(qty) as sum,sum(qty*price) as net 
            from orderdtl group by year(o_date) order by year(o_date)";
            $rs=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_array($rs)){ ?>
              <tr>
               <td><a href="orderdtl.php?o_no=<?php echo $row["o_no"] ?>">
               <?php echo $row["year"] ?></a></td>
               <td><?php echo number_format($row["sum"]) ?></td>
               <td><?php echo number_format($row["net"]) ?></td>
            </tr> 
               <?php } ?>
         </table>
          <h3>제품별 집계</h3>
          <br>
          <table>
            <tr>
              <th>상품번호</th>
              <th>상품명</th>
              <th>판매량</th>
              <th>결제금액</th>
            </tr>
            <?php 
            $sql="select item.i_no as item,item.price,item.name,orderdtl.i_no, sum(qty) as tot 
            From orderdtl RIGHT Outer Join item on orderdtl.i_no = item.i_no group by item.i_no order by tot desc, i_no asc";
            $rs=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_array($rs)){ ?>
              <tr>
               <td><?php echo $row["item"] ?></td>
               <td><?php echo $row["name"] ?></td>
               <td><?php echo number_format($row["tot"]) ?></td>
               <td><?php echo number_format($row["tot"]*$row["price"]) ?></td>
            </tr> 
               <?php } ?>
         </table>
      </div>
     </div>
   </div>   
 </content>
<?php include "footer.php"; ?>
