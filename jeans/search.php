<?php
session_start();
include "header.php";
?>
<style>
  .content{width: 60%;min-height: 75vh;margin:0 20%;} 
  .searchbar{width:300px;height:30px;display:flex}
  table{margin:20px 0;width:100%}
  table tr{height: 2.2em;}
  table th,td{border-top: 1px solid #999;text-align: center;padding: 5px 10px;font-size:.9em;}      
  table th{border-top: 2px solid darkcyan;background-color: #eee;}
  table tr td>a:hover{color: orange;cursor: pointer;}
  table tr td>img{width: 100px;height: 80px;}
  input[type=text], textarea, select
     {border:none;outline:none;font-size:.9em;padding:5px}
  .button{margin: 0px 0.6em;padding: 0.5em 0.8em;font-weight: bold;border-radius: 0.8em;background-color: rgb(36,100,171);color: azure;border: none;}          
  .button:hover{color: goldenrod;cursor: pointer;}
</style>
<div class="content">
  <h2>검색결과</h2><br>
  <div class="searchbar">
    <form name="frm1">
      <input type="search" name="keyword" placeholder="검색어를 입력하세요">
      <button onclick="search()"><i class="xi-search"></i></button>
      </form>
  </div>
  <table>
    <tr>
        <th>이미지</th>
        <th>상품명</th><th>금액</th>
    </tr>
    <?php
    $keyword=$_GET["keyword"];
    include "conn.php";
    $sql="select * from item where name like '%$keyword%'";
    $rs=mysqli_query($conn,$sql);
    $total=mysqli_num_rows($rs);
    while($row=mysqli_fetch_array($rs)){ ?>
      <tr>
        </td>
          <td><?php $fname="../fileServer/".$row["img"];?>
              <img src="<?php echo $fname ?>"></td>
          <td>
            <a href="itemcontent.php?i_no=<?php echo $row["i_no"] ?>">
            <?php echo $row["name"] ?></a></td>
          <td><?php echo number_format($row["price"]) ?></td>
          </tr>
          <tr>
          <td colspan="6" align="center"><?php echo $total ?>건의 데이타가 검색되었습니다.</td>
      </tr>
    <?php } ?>
  </table>
</div>
<?php include "footer.php"; ?>
<script>
  function search(){
  location.href="search.php?keyword="+frm1.keyword.value;
        }
</script>