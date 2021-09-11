<?php
  require_once(ROOT_PATH .'Controllers/SeaController.php');
  $seas = new SeaController();
  $params = $seas->view();


?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>OKINAWA</title>
  <link rel="stylesheet" href="../css/base.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
<body>


  <?php
    include('header.php');
  ?>


<div id="top__sign_in">

  <!-- <div class="sign__in__btn">
    <a href="#" id="sign__btn">サインイン</a>
  </div> -->

  <!-- ログイン画面 -->
  <div id="overlay" style="">
    <div id="log_in" class="log_in" style="margin-top: 0px; opacity: 1;">

      <div class="insert_tg">


      <h2>詳細</h2>

        <input type="hidden" name="id" value="<?php echo $_GET["id"];?>" >

        <?php foreach((array)$params as $sea):?>

          <div class="image_view">
            <div class="image_view_img">
              <img src=".<?php echo $sea['image']; ?>" width="550" height="400" style="margin:0 auto;margin-top:15px;margin-bottom:15px" >
            </div>
            <div class="image_view_map">
               <script>
                 var latitude  = <?= $sea['latitude'] ?>;
                 var longitude = <?= $sea['longitude'] ?>;
               </script>
               <?php include '../Views/Umi/view.html'?>
             </div>
          </div>

        <div class="select_area_view" style="display:flex;justify-content:space-between;margin:50px">

          <div class="date_view">
              <p class="date">撮影日</p>
              <p style="font-size:20px"><?php if (!empty($sea['date'])) echo(htmlspecialchars($sea['date'], ENT_QUOTES, 'UTF-8'));?></p>
          </div>

          <div class="point_view">
               <p class="point">撮影した場所(ダイブポイント)</p>
               <p style="font-size:20px"><?php if (!empty($sea['point'])) echo(htmlspecialchars($sea['point'], ENT_QUOTES, 'UTF-8'));?></p>
          </div>


          <div class="area_view" style="">
              <p class="area_id" style="">エリア</p>
              <p style="font-size:20px"><?php if (!empty($sea['name'])) echo(htmlspecialchars($sea['name'], ENT_QUOTES, 'UTF-8'));?></p>
          </div>

          <div class="temperature_view">
              <p class="temperature">水温</p>
              <p style="font-size:20px"><?php if (!empty($sea['temperature'])) echo(htmlspecialchars($sea['temperature'], ENT_QUOTES, 'UTF-8'));?>度</p>
          </div>

          <div class="transparency_view">
              <p class="transparency">透明度</p>
              <p style="font-size:20px"><?php if (!empty($sea['transparency'])) echo(htmlspecialchars($sea['transparency'], ENT_QUOTES, 'UTF-8'));?>m</p>
          </div>
        </div>

          <div class="comment_view" style="margin:0 50px">
            <p class="comment">コメント</p>
            <p style="font-size:20px"><?php if (!empty($sea['comment'])) echo nl2br(htmlspecialchars($sea['comment'], ENT_QUOTES, 'UTF-8'));?></p>
          </div>


           <dl>
         　　   <dd>
           　　     <input type="hidden" name="hidden" value="">
         　　   </dd>
       　　</dl>

       <div class="top" style="margin:0 50px 20px 50px">
         <a href="index.php" style="text-align:center">トップへ戻る</a>
       </div>

       </div>



      </div>
    </div>
  </div>
<?php endforeach; ?>


</div>


<?php
   include('footer.php'); ?>


</body>
</html>
