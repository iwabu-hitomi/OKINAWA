

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
    // $image = uniqid(mt_rand(), true);//ファイル名をユニーク化
// var_dump($image);
  ?>



<section>

  <div class="insert_tg">
     <h2>写真を投稿</h2>

     <form action="insert_com.php" method="post" id="form1" enctype="multipart/form-data">
       <h3>下記の項目をご記入の上送信ボタンを押してください</h3>

       <dl>

       <div class="select_area">
         <div class="area_1">
           <dt>
               <label for="area_id">エリア</label>
               <span class="required">*</span>
           </dt>
           <dd>
             <select name= "area_id" class="area_okinawa">
                  <option value = "1">沖縄本島</option>
                  <option value = "2">慶良間諸島</option>
                  <option value = "3">宮古島</option>
                  <option value = "4">久米島</option>
                  <option value = "5">石垣島</option>
                  <option value = "6">西表島</option>
                  <option value = "7">離島</option>
                  <option value = "8">その他</option>
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
                  <option value = "15">15度以下</option>
                  <option value = "16">16度</option>
                  <option value = "17">17度</option>
                  <option value = "18">18度</option>
                  <option value = "19">19度</option>
                  <option value = "20">20度</option>
                  <option value = "21">21度</option>
                  <option value = "22">22度</option>
                  <option value = "23">23度</option>
                  <option value = "24">24度</option>
                  <option value = "25">25度</option>
                  <option value = "26">26度</option>
                  <option value = "27">27度</option>
                  <option value = "28">28度</option>
                  <option value = "29">29度</option>
                  <option value = "30">30度以上</option>
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
                  <option value = "1">1-3m</option>
                  <option value = "5">3-5m</option>
                  <option value = "8">5-8m</option>
                  <option value = "10">8-10m</option>
                  <option value = "12">10-12m</option>
                  <option value = "15">12-15m</option>
                  <option value = "18">15-18m</option>
                  <option value = "20">18-20m</option>
                  <option value = "25">20-25m</option>
                  <option value = "30">25-30m</option>
                  <option value = "35">30-35m</option>
                  <option value = "40">35-40m</option>
                  <option value = "41">40m以上</option>
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
             <input type="text" name="date" id="date" placeholder="撮影日" value="">
           </dd>
         </div>

         <div class="point_1">
           <dt>
               <label for="point">撮影した場所(ダイブポイント)</label>
           </dt>
           <dd>
              <input type="text" name="point" id="point" placeholder="ダイブポイント" value="">
           </dd>
         </div>


         <div class="image_1">
           <dt>
               <label for="image">写真</label>
           </dt>
           <dd>
             <input type="file" name="image" id="image"　accept="image/*">


           </dd>
         </div>


           <div class="latitude_1">
             <dt>
                 <label for="latitude">緯度</label>
                 <span class="required">*</span>
             </dt>
             <dd>
               <input type="text" name="latitude" id="input_lat" placeholder="緯度" value="">
             </dd>
           </div>

           <div class="longitude_1">
             <dt>
                 <label for="longitude">経度</label>
                 <span class="required">*</span>
             </dt>
             <dd>
               <input type="text" name="longitude" id="input_lng" placeholder="経度" value="">
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
             <textarea name="comment" id="comment" class="comment_text"></textarea>
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
          　　     <button type="submit" id="button">投　稿</button>
        　　   </dd>
      　　</dl>
      </div>

  </form>

</div>



</section>

<?php include('footer.php'); ?>



</body>
</html>
