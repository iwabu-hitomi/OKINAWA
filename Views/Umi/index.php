<?php
  function h($s){
    return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
  }

  session_start();

  //ログイン済みの場合
  if (isset($_SESSION['EMAIL'])) {

    try {
      // データベースに接続
      $dsn = 'mysql:dbname=okinawa;host=localhost';
      $user = 'root';
      $pass = 'root';
      $pdo = new PDO($dsn, $user, $pass);
      if ($pdo == null){
        print('接続に失敗しました。<br>');
      }else{
        // print('接続に成功しました。<br>');
      }
        $pdo->query('SET NAMES utf8');
    } catch (Exception $e) {
        echo 'エラーが発生しました。:' . $e->getMessage();
    }

    // echo $_SESSION['EMAIL'];

    $stmt = $pdo->prepare('SELECT users.id, users.name, users.email, users.role FROM users WHERE email = :email');
    $stmt->execute(array(':email' => $_SESSION['EMAIL']));
    // $result = 0;
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // echo $result['role'];
    if($result['role'] == 0){
      echo '<div class="user_role">管理者ユーザー</div>';
      echo '<br>';
      // echo "<a href='logout.php'>ログアウトはこちら。</a>";
      // exit;
    }else{
      echo '<div class="user_role">一般ユーザー</div>';
      echo '<br>';
      // echo "<a href='logout.php'>ログアウトはこちら。</a>";
    }

  } else {//ログインしていない時
    echo '<div class="login_text" style="text-align:center;margin-top:30px">ログインしてください。アカウントのない方はアカウントを作成してください。</div>';
    echo '<br>';
    echo '<div class="login_text" style="text-align:center"><a href="login.php">ログイン</a></div>';
    // echo '<br>';
    echo '<div class="login_text" style="text-align:center"><a href="signup.php" class="login_text">新規会員登録</a></div>';
    exit;
}

$_SESSION['role'] = $result['role'];
$_SESSION['id'] = $result['id'];

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

  <?php
  require_once(ROOT_PATH .'Controllers/SeaController.php');
  $sea = new SeaController();
  $params = $sea->index();
  // $player->logout();
  // session_start();
  ?>



  <main>
    <div class="main_comment">
        <h2>はいさ〜い</h2>
    </div>

    <section class="section_1">

       <div class="main_images">

         <?php foreach ($params['seas'] as $sea): ?>

           <?php if($sea['del_flg']==0){ ?>

             <div class="box_1">

                <img src=".<?=$sea['image']?>" alt="" width="300" height="200" style="margin:15px;">
                <div class="text_seas" style="display:flex">
                  <?php echo  '<div class="text_sea" style="margin-left:15px;">'.$sea['area_name'].'</div>'?>
                  <?php echo  '<div class="text_sea" style="margin-left:5px;">'.$sea['date'].'</div>'?>

                  <a href="view.php?id=<?=$sea["id"]?>" style="margin-left:5px;" id="view_id">詳細</a>

                 <?php if($result['role'] == 0){?>
                     <a href="edit.php?id=<?=$sea['id']?>" style="margin-left:5px;">編集</a>
                     <a href="delete.php?id=<?=$sea['id']?>" style="margin-left:5px;" onclick='return confirm("削除しますか？");'>削除</a>
                <?php } ?>
                </div>

            <?php } ?>
            </div>

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

<!-- <script src="../js/index.js"></script> -->


<?php
   include('footer.php'); ?>


</body>
</html>
