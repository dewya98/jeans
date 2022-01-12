<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuna Jeans</title>
    <style>
*{margin:0; padding:0;list-style: none;}
a{text-decoration: none;color: inherit;}
header{width:80%;padding:0 10% 20px;height:100px}
.topmenu{width:100%;height:30px;text-align: right;}
.topmenu>a{color: rosybrown;line-height: 30px;font-size: .9em;}
.logo{width: 100%;height: 70px;text-align: center;font-size: 3em;}
.slider{width:80%;height:380px;position: relative;margin:0 auto}
.slider>li{width:100%;height:100%;position: absolute;}
.slider>li>img{width: 100%;height: 100%;}
nav{width: 80%;margin: 0 auto;height: 50px;line-height: 50px;background-color: #222;color: #fff;
  display: flex;justify-content: space-around;font-weight: 900;}
section{width: 70%;padding: 3% 15%;}  
.wrap{width: 100%;padding:30px 0;display: flex;flex-wrap: wrap;justify-content: space-between;}
.box{width: 23%;height: 200px;text-align: center;}
.box>a>img{width: 100%;height: 150px;}
caption{width: 100%;height: 50px;}
footer{width: 70%;padding: 30px 15%;background-color: #eee;}
    </style>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
</head>
<body>
  <header>
      <div class="topmenu">
      <?php if(!isset($_SESSION["id"])){ ?>
          <a href="login.php">로그인</a>
          <a href="signup.php">회원가입</a>
          <a href="status.php">관리자</a>
          <?php }else{ ?> 
          <a href="logout.php">로그아웃</a>
          <a href="cart.php">장바구니</a>
          <a href="mypage.php">마이페이지</a>
          <a href="status.php">관리자</a>
         <?php } ?>
       </div>
      <div class="logo">Nuna Jeans</div>
  </header>
  <ul class="slider">
    <li><img src="images/OIP (1).jpg" alt=""></li>
    <li><img src="images/OIP (2).jpg" alt=""></li>
    <li><img src="images/OIP.jpg" alt=""></li>
  </ul>
  <nav>
      <a href="index.php">전체</a>
      <a href="male.php">남성</a>
      <a href="female.php">여성</a>
  </nav>
  <section>
    <h2>BEST</h2>
    <div class="wrap">
      <?php 
      include "conn.php";
      $sql="select item.i_no,item.img,item.name,item.price,
      orderdtl.i_no
      from item
      left join (
        SELECT i_no,COUNT(i_no) from orderdtl GROUP by i_no ORDER by count(i_no) desc )
        orderdtl
      on orderdtl.i_no=item.i_no limit 4
      ";
      $rs=mysqli_query($conn,$sql);
      while($row=mysqli_fetch_array($rs)){ ?>
        <div class="box"> 
        <a href="itemcontent.php?i_no=<?php echo $row["i_no"]?>">          
        <?php $fname="../fileServer/".$row["img"];?>
          <img src="<?php echo $fname ?>">
         <caption>
           <?php echo $row["name"] ?><br>
          <b>￦<?php echo number_format($row["price"]) ?></b>
         </caption></a>
       </div>
      <?php } ?>

    </div>
    <h2>신상</h2>
    <div class="wrap">
      <?php 
      $sql="select * from item order by i_no desc limit 4 ";
      $rs=mysqli_query($conn,$sql);
      while($row=mysqli_fetch_array($rs)){ ?>
        <div class="box"> 
        <a href="itemcontent.php?i_no=<?php echo $row["i_no"]?>">          
        <?php $fname="../fileServer/".$row["img"];?>
          <img src="<?php echo $fname ?>">
         <caption>
           <?php echo $row["name"] ?><br>
          <b>￦<?php echo number_format($row["price"]) ?></b>
         </caption></a>
       </div>
      <?php } ?>
    </div>
  </section>
  <footer>
      바닥글
  </footer>
</body>
</html>
<script>
  $(function(){
  var image=$(".slider>li");
  var images=image.length;
  var now=0;
  var play;
    $(".slider>li").eq(now).css("display","block");
    $(".slider>li").eq(0).siblings().css("display","none");
    play=setInterval(function(){slide()},3500);

  function slide(){
    var next=(now+1)%images;
    $(".slider>li").eq(now).fadeOut(500);
    $(".slider>li").eq(next).fadeIn(500);
    now=next;
  }

  })
</script>