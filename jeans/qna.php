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
        section{width:60%;padding:0 20%;min-height:35vh;}
        .cs{height: 50px;font-size:.9em}
        .cs>a{color:royalblue;padding-right:10px}
        .cs>a:nth-child(2){text-decoration:underline;font-weight:700 }
        .reply{margin:20px;width: 90%;height:3.5em;padding: 5px;overflow:auto;}
        #btn{width:7em;height:3em;font-weight:bold;border-radius:1.4em;background-color:rgb(36,100,171);color:#fff;border: none;         
             position:absolute;top: 15px;}          
        #btn:hover{color: goldenrod;cursor: pointer;}
        .pager{width:80%;text-align: center;color: #b99c45;padding: 1em;}
        .pager>a>i{color: brown;}
        .replybox{position:absolute;top: 10px;right:10px;}
        span{float:right;margin-right: 10px;font-size:.9em}
        .message{width:100%;border-bottom: 2px solid #ddd;padding:1% 0;position: relative;}
        .blue{color: rgb(36,100,171);}
        .red{color:crimson}
          h6{padding:0 2% 2%;font-family: sans-serif;font-size: large;}
          @media(max-width:767px){
            content{width: 100%;height: 50em;}
            .title{font-size:2.4em}       
            .title, .title-nav, .reply{margin-left:5%;width:100%} 
            .title-nav{padding-bottom:20px}
            .typing, .message, .reply{width:90%;padding:0 5%}
            .typing{position:static;}
            .typing>img{display:none}
            textarea{width:20em;}
            #btn{display:block;width:6em;position:static;margin-top:0}
            span, small{font-size:.7em}
           .message, .reply{font-size:.9em;padding:2% 0}
        }
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
   <div class="cs">
     <a href="review.php?i_no=<?php echo $i_no?>">상품리뷰</a>
     <a href="qna.php?i_no=<?php echo $i_no?>">상품문의</a>
     <a href="qna-add.php?i_no=<?php echo $i_no?>"><span>상품문의하기</span></a>
   </div>
   <?php 
         if(isset($_GET["page"])){
             $page=$_GET["page"];
             $group=ceil($page/5);
            }else{
                $page=1;
                $group=1;
            } 
            $startRow=($page-1)*5;
            include "conn.php";
            $sql2="select count(*) as cnt from guest";
            $rs2=mysqli_query($conn,$sql2);
            $row2=mysqli_fetch_array($rs2);
            $cnt=$row2["cnt"];
            $pageCount=ceil($cnt/5);
            $groupCount=ceil($pageCount/5); 
            $sql="select * from guest order by no desc limit $startRow,5";
            $rs=mysqli_query($conn,$sql);
            $e=0;
            while($row=mysqli_fetch_array($rs)){ $e++; ?>
            <div class="message">
             <p><b><?php echo $row["writer"] ?></b> | <small><?php echo $row["writeday"] ?></small></p>
             <p><?php echo nl2br($row["content"]) ?></p>
             <?php 
             $no=$row["no"];
             $sqltot="select * from guest_re where g_no='$no'";
             $rstot=mysqli_query($conn,$sqltot);
             $tot=mysqli_num_rows($rstot);
             if($tot){
             $sqlre="select * from guest_re where g_no='$no'";
             $rsre=mysqli_query($conn,$sqlre); ?>
             <div class="reply">
            <?php     
            while($rowre=mysqli_fetch_array($rsre)){ ?>
            <p><b><?php echo $rowre["writer"] ?></b>(<?php echo $rowre["writeday"] ?>)&emsp; 
            <?php echo $rowre["content"]?>
            <?php 
            if(isset($_SESSION["id"])){
              if($_SESSION["id"]==$rowre["writer"] or $_SESSION["id"]=='admin'){ ?>
            <span>
              <a href="#" onclick="redel(<?php echo $rowre["no"] ?>,<?php echo $page ?>)"><small class="red">댓글삭제</small></a>
             </span> <?php }} ?>
            </p>
            <?php } ?>
             </div>
             <?php } ?>
             <?php if(isset($_SESSION["id"])){ ?> 
              <div class="replybox">
              <a href="#" onclick="send('redata<?php echo $e ?>',<?php echo $row['no'] ?>,<?php echo $page ?>)">
              <small class="blue">댓글쓰기</small></a>
              <?php if($_SESSION["id"]==$row["writer"] or $_SESSION["id"]=='admin'){ ?>
              <a href="#" onclick="del(<?php echo $row["no"] ?>,<?php echo $page ?>)"><small class="red">삭제</small></a>
              <? } ?>
              <a href="#" onclick="reclose()"><small>닫기</small></a>
             <div id="redata<?php echo $e ?>"></div>
             </div>
             <?php } ?>         
          </div>
          <?php } ?>
          <div class="pager">
         <?php 
            $startPage=($group-1)*5+1;
            $endPage=$startPage+4;
            if($group>1){
                $first=1;
                echo "<a href='cs.php?page=$first'> [〈〈 ] </a>";
                $prevPage=($group-2)*5+1;
                echo "<a href='cs.php?page=$prevPage'> [〈 ] </a>";
            }
            for($i=$startPage;$i<=$endPage;$i++){ 
                if($i>$pageCount){break;}  
                if($i==$page){
                    echo "<a href='cs.php?page=$i'><font color='firebrick'>[$i]</font></a>";
                }else{
                    echo "<a href='cs.php?page=$i'>[$i]</a>";
                }
            }
                if($group<$groupCount){ 
                    $nextPage=$group*5+1;
                echo "<a href='cs.php?page=$nextPage'>  [ 〉] </a>";
                $endPage=$pageCount;
                echo "<a href='cs.php?page=$endPage'> [ 〉〉] </a>";
            }
        ?>
    </div>
  </form>
        </section>
<br><br>
<?php  include "footer.php"; ?>
