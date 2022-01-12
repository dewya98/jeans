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
.logo>a{color:darkcyan}
</style>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
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
      <div class="logo">
          <a href="index.php">Nuna Jeans</a>
     </div>
  </header>
