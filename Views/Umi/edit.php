
<?php
  require_once(ROOT_PATH .'Controllers/SeaController.php');
  $seas = new SeaController();
  $params = $seas->edit();


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


<section>

  <div class="insert_tg">
     <h2>投稿情報の編集</h2>
     <form action="edit_com.php" method="post" id="form1" enctype="multipart/form-data">
       <h3>下記の項目をご記入の上送信ボタンを押してください</h3>

       <input type="hidden" name="id" value="<?php echo $_GET["id"];?>" >

       <?php foreach((array)$params as $sea):?>


       <dl>

       <div class="select_area">
         <div class="area_1">
           <dt>
               <label for="area_id">エリア</label>
               <span class="required">*</span>
           </dt>
           <dd>
             <select name= "area_id" class="area_okinawa">
                  <option value = "1"<?php if($sea['area_id']=="1"){echo "selected";}?>>沖縄本島</option>
                  <option value = "2"<?php if($sea['area_id']=="2"){echo "selected";}?>>慶良間諸島</option>
                  <option value = "3"<?php if($sea['area_id']=="3"){echo "selected";}?>>宮古島</option>
                  <option value = "4"<?php if($sea['area_id']=="4"){echo "selected";}?>>久米島</option>
                  <option value = "5"<?php if($sea['area_id']=="5"){echo "selected";}?>>石垣島</option>
                  <option value = "6"<?php if($sea['area_id']=="6"){echo "selected";}?>>西表島</option>
                  <option value = "7"<?php if($sea['area_id']=="7"){echo "selected";}?>>離島</option>
                  <option value = "8"<?php if($sea['area_id']=="8"){echo "selected";}?>>その他</option>
            </select>
           </dd>
         </div>

         <div class="temperature_1">
           <dt>
               <label for="temperature">水温</label>
               <span class="required">*</span>
           </dt>
           <dd>
             <select name= "temperature" class="temperature_okinawa">
                  <option value = "15"<?php if($sea['temperature']=="15"){echo "selected";}?>>15度以下</option>
                  <option value = "16"<?php if($sea['temperature']=="16"){echo "selected";}?>>16度</option>
                  <option value = "17"<?php if($sea['temperature']=="17"){echo "selected";}?>>17度</option>
                  <option value = "18"<?php if($sea['temperature']=="18"){echo "selected";}?>>18度</option>
                  <option value = "19"<?php if($sea['temperature']=="19"){echo "selected";}?>>19度</option>
                  <option value = "20"<?php if($sea['temperature']=="20"){echo "selected";}?>>20度</option>
                  <option value = "21"<?php if($sea['temperature']=="21"){echo "selected";}?>>21度</option>
                  <option value = "22"<?php if($sea['temperature']=="22"){echo "selected";}?>>22度</option>
                  <option value = "23"<?php if($sea['temperature']=="23"){echo "selected";}?>>23度</option>
                  <option value = "24"<?php if($sea['temperature']=="24"){echo "selected";}?>>24度</option>
                  <option value = "25"<?php if($sea['temperature']=="25"){echo "selected";}?>>25度</option>
                  <option value = "26"<?php if($sea['temperature']=="26"){echo "selected";}?>>26度</option>
                  <option value = "27"<?php if($sea['temperature']=="27"){echo "selected";}?>>27度</option>
                  <option value = "28"<?php if($sea['temperature']=="28"){echo "selected";}?>>28度</option>
                  <option value = "29"<?php if($sea['temperature']=="29"){echo "selected";}?>>29度</option>
                  <option value = "30"<?php if($sea['temperature']=="30"){echo "selected";}?>>30度以上</option>
            </select>

           </dd>
         </div>

         <div class="transparency_1">
           <dt>
               <label for="transparency">透明度</label>
               <span class="required">*</span>
           </dt>
           <dd>
             <select name= "transparency" class="temperature_okinawa">
                  <option value = "1"<?php if($sea['transparency']=="1"){echo "selected";}?>>1-3m</option>
                  <option value = "5"<?php if($sea['transparency']=="5"){echo "selected";}?>>3-5m</option>
                  <option value = "8"<?php if($sea['transparency']=="8"){echo "selected";}?>>5-8m</option>
                  <option value = "10"<?php if($sea['transparency']=="10"){echo "selected";}?>>8-10m</option>
                  <option value = "12"<?php if($sea['transparency']=="12"){echo "selected";}?>>10-12m</option>
                  <option value = "15"<?php if($sea['transparency']=="15"){echo "selected";}?>>12-15m</option>
                  <option value = "18"<?php if($sea['transparency']=="18"){echo "selected";}?>>15-18m</option>
                  <option value = "20"<?php if($sea['transparency']=="20"){echo "selected";}?>>18-20m</option>
                  <option value = "25"<?php if($sea['transparency']=="25"){echo "selected";}?>>20-25m</option>
                  <option value = "30"<?php if($sea['transparency']=="30"){echo "selected";}?>>25-30m</option>
                  <option value = "35"<?php if($sea['transparency']=="25"){echo "selected";}?>>30-35m</option>
                  <option value = "40"<?php if($sea['transparency']=="40"){echo "selected";}?>>35-40m</option>
                  <option value = "41"<?php if($sea['transparency']=="41"){echo "selected";}?>>40m以上</option>
            </select>

           </dd>
         </div>
       </div>

         <div class="date_1">
           <dt>
               <label for="date">撮影日</label>
               <span class="required">*</span>
           </dt>
           <dd>
             <input type="text" name="date" id="date" placeholder="撮影日" value="<?php if (!empty($sea['date'])) echo(htmlspecialchars($sea['date'], ENT_QUOTES, 'UTF-8'));?>">
           </dd>
         </div>

         <div class="point_1">
           <dt>
               <label for="point">撮影した場所(ダイブポイント)</label>
           </dt>
           <dd>
              <input type="text" name="point" id="point" placeholder="ダイブポイント" value="<?php if (!empty($sea['point'])) echo(htmlspecialchars($sea['point'], ENT_QUOTES, 'UTF-8'));?>">
           </dd>
         </div>


         <div class="image_1">
           <dt>
               <label for="image">写真</label>
           </dt>
           <dd>
             <input type="file" name="image">
             <input type="hidden" name="d_file" value="<?php echo $sea['image']; ?>">
                <img src=".<?php echo $sea['image']; ?>" width="300" height="200" >
             <!-- <div id="preview"></div> -->
             <!-- <img id="preview" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" style="max-width:200px;"> -->

           </dd>
         </div>


           <div class="latitude_1">
             <dt>
                 <label for="latitude">緯度</label>
                 <span class="required">*</span>
             </dt>
             <dd>
               <input type="text" name="latitude" id="input_lat" placeholder="緯度" value="<?php if (!empty($sea['latitude'])) echo(htmlspecialchars($sea['latitude'], ENT_QUOTES, 'UTF-8'));?>">
             </dd>
           </div>

           <div class="longitude_1">
             <dt>
                 <label for="longitude">経度</label>
                 <span class="required">*</span>
             </dt>
             <dd>
               <input type="text" name="longitude" id="input_lng" placeholder="経度" value="<?php if (!empty($sea['longitude'])) echo(htmlspecialchars($sea['longitude'], ENT_QUOTES, 'UTF-8'));?>">
             </dd>
           </div>
           <input type="button" value="｢緯度｣｢緯度｣の取得はここクリック(グーグルマップの中心です)" onclick="getCode()"><br>

           <?php include '../Views/Umi/map.html'?>

         <div class="comment_1">
           <dt>
               <label for="comment">コメント</label>
               <span class="required">*</span>
           </dt>
           <dd>
             <textarea name="comment" id="comment" class="comment_text"><?php if (!empty($sea['comment'])) echo (htmlspecialchars($sea['comment'], ENT_QUOTES, 'UTF-8'));?></textarea>
           </dd>
         </div>

       </dl>

       <div class="comment_1">

            <!-- <h3><label for="comment">"フリーコメント"<span class="required">*</span></label></h3> -->
          <dl>
          　　 <!-- <dd>
            　　   <textarea name="comment" id="comment"></textarea>
        　　   </dd> -->

        　　   <dd>
          　　     <input type="hidden" name="hidden" value="">
                  <button type="submit" onClick='return confirm("上書きしますか？");'>投　稿</button>

          　　     <!-- <button type="submit" id="button">投　稿</button> -->
        　　   </dd>
      　　</dl>
      </div>

  </form>

</div>
<?php endforeach; ?>



</section>

<?php
   include('footer.php'); ?>

</body>
</html>
