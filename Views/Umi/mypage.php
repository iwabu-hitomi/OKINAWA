<?php
session_start();
// var_dump($_SESSION['id']);

      try {
        // データベースに接続
        $dsn = 'mysql:dbname=okinawa;host=localhost';
        $user = 'root';
        $password = 'root';
        $pdo = new PDO($dsn, $user, $password);
        $pdo->query('SET NAMES utf8');

        // $stmt = $pdo->prepare('SELECT * FROM user WHERE id = :id');
        $stmt = $pdo->prepare('SELECT * FROM users LEFT JOIN seas ON seas.user_id = users.id WHERE users.id = :id');

        $stmt->execute(array(':id' => $_GET["id"]));
        $result = 0;
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

      } catch (Exception $e) {
        echo 'エラーが発生しました。:' . $e->getMessage();
      }

      $_GET['id'] = $result['user_id'];
      // var_dump($result['user_id']);


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

  <div class="main_header">
    <div class="main__header__2">
      <a href="#" class="top__message">ーOKINAWAへ行こうー</a>
    </div>
  </div>

  <main>
    <div class="main_comment">
        <h2>はいさ〜い</h2>
    </div>

    <div class="mypage_heater">

       <p class="my_page" style="text-align:right;margin-right:50px"><?= $_SESSION['name']?>さんの投稿一覧</h2>
       <a href="index.php" class="my_page" style="font-size:normal">トップページへ</a>

    </div>

    <section class="section_1">

      <?php
      require_once(ROOT_PATH .'Controllers/SeaController.php');
      $seas = new SeaController();
      $params = $seas->mypage_view();

      // var_dump($params);

      ?>



       <div class="main_images">

         <?php foreach ($params['seas'] as $seas): ?>

           <div class="box_1">

              <img src=".<?=$seas['image']?>" alt="" width="300" height="200" style="margin:15px;">
              <div class="text_seas" style="display:flex">
                <?php echo  '<div class="text_sea" style="margin-left:15px;">'.$seas['name'].'</div>'?>
                <?php echo  '<div class="text_sea" style="margin-left:5px;">'.$seas['date'].'</div>'?>

                <a href="view.php?id=<?=$seas["id"]?>" style="margin-left:5px;" id="view_id">詳細</a>

                   <a href="edit.php?id=<?=$seas['id']?>" style="margin-left:5px;">編集</a>
                   <a href="delete.php?id=<?=$seas['id']?>" style="margin-left:5px;" onclick='return confirm("削除しますか？");'>削除</a>
              </div>

          </div>

<!--

             <div class="box_1">

                <img src=".<?=$seas['image']?>" alt="" width="300" height="200">
                  <?=$seas['point']?>
                  <?=$seas['date']?>
                  <a href="#">詳細</a>

                     <a href="edit.php?id=<?=$seas['id']?>">編集</a>
                     <a href="delete.php?id=<?=$seas['id']?>" onclick='return confirm("削除しますか？");'>削除</a>

            </div> -->

          <?php endforeach; ?>

      </div>
    </section>


  </main>



<div id="page_top" class="jump">
  <!-- <a href="index.php"> -->
    Jump To Top
  <!-- </a> -->
</div>
<script>
  jQuery(function() {
    var appear = false;
    var pagetop = $('#page_top');
    $(window).scroll(function () {
      if ($(this).scrollTop() > 100) {  //100pxスクロールしたら
        if (appear == false) {
          appear = true;
          pagetop.stop().animate({
            'bottom': '0px' //下から50pxの位置に
          }, 300); //0.3秒かけて現れる
        }
      } else {
        if (appear) {
          appear = false;
          pagetop.stop().animate({
            'bottom': '-50px' //下から-50pxの位置に
          }, 300); //0.3秒かけて隠れる
        }
      }
    });
    pagetop.click(function () {
      $('body, html').animate({ scrollTop: 0 }, 500); //0.5秒かけてトップへ戻る
      return false;
    });
  });
</script>

<?php
   include('footer.php'); ?>


</body>
</html>
