<?php
session_start();
include "header.php";
?>
<style>
 content{width: 80%;min-height:77vh;padding:0 10%;display:flex} 
.wrap{width:100%;position: relative;top:0 ;left: 0;display: flex;}
h1{margin:3% 0 ;color: #333;font-size: 1.5em;}
 .col1{width: 15%;border-right:2px solid #aaa ;} 
 .csnav{border-top: 2px solid #aaa;margin-right: 30px;}
 .csnav li{border-bottom: 1px solid #ddd; height: 3em;line-height: 3em;}
 .csnav li:hover{color: darkcyan;}
 .middle{width: 60%;border-right: 2px solid #aaa;}
 .middle h1{color: darkcyan;}
 .middle input{width: 40em;height: 50px;border: 2px solid #777;padding: 0 5px;}
 .middle button{height: 54px;background: #333;color: #fff;outline: none;border: none;padding: 10px;}
 .middle button:hover{background:#ddd;color: darkcyan;}
 .middle .faq{margin-right:20% ;}
 .middle .faq li{height: 50px;line-height: 50px;border-bottom: 1px solid #ddd;}
 .middle li:hover{color: darkcyan;}
 .col2 .call{width: 100%;height: 70px;color: darkcyan;
background: rgb(222,226,213);
background: radial-gradient(circle, rgba(82, 189, 180, 0.548) 0%, rgba(210,217,226,0.7063200280112045) 100%);
        margin-top: 50px;padding: 20px 0;text-align: center;}
 .csnav{font-size:.9em}       
 .col2 .csnav li:nth-child(1)::before{content: "[공지] ";color: darkcyan;font-weight: bold;}
 .col2 .csnav li:nth-child(2)::before{content: "[채용] ";color: darkcyan;font-weight: bold;}
 .col2 .csnav li:nth-child(3)::before{content: "[이벤트] ";color: darkcyan;font-weight: bold;}
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
   <div class="col1">
    <h1>고객센터</h1>
       <ul class="csnav">
           <li><a href="">1:1 문의하기</a></li>
           <li><a href="">자주 찾는 질문</a></li>
           <li><a href="">공지사항</a></li>
       </ul>
   </div>
   <div class="middle">
    <h1>1:1 문의하기</h1>
       <input type="text" placeholder="궁금하신 내용을 남겨주세요" >
       <button><a href=""><b>문의하기</b></a></button>
       <h1>자주찾는 질문</h1>
       <div class="faq">
        <li><a href="">1. 사이즈 문의</a></li>
        <li><a href="">2. 환불 문의</a></li>
        <li><a href="">3. 배송비 규정이 어떻게 되나요?</a></li>
        <li><a href="">4. 주문 시 개인정보 입력을 잘못했는데어떻게 수정 하나요?</a></li>
        <li><a href="">5. 구매이력은 어디서 확인하나요?</a></li>
        <li><a href="">6. 대량구매 방법을 알고 싶어요</a></li>
        <li><a href="">7. 구매 마일리지 적립이 가능한가요?</a></li>
        <li><a href="">8. 현금영수증 발급은 어떻게 받나요?</a></li>
       </div>
   </div>
   <div class="col2">
       <h1>공지사항</h1>
       <ul class="csnav">
           <li><a href="">누나진스에 오신 여러분을 환영합니다!</a></li>
           <li><a href="">누나진스 신입/경력사원 모집</a></li>
           <li><a href="">누나진스 런칭 이벤트!</a></li>
       </ul>
       <div class="call">
           <b>누나진스 대표전화</b> 
           <h1><i class="fas fa-phone-alt"></i> 1577-1234</h1>
       </div>
    </div>
  </div>
     <!-- <div class="cs">
       고객센터 <br>
       <b>1577-1234 </b> <br>
       <button>1:1 문의하기</button>
     </div> -->
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
