<?php
require_once(ROOT_PATH .'Controllers/PlayerController.php');
$player = new PlayerController();
$params = $player->index();
// $player->logout();
// session_start();
?>


<!DOCTYPE himl>
<himl>
<head>
    <meta charset="UTF-8">
    <title>オブジェクト指向 - 選手一覧</title>
    <link rel="stylesheet" type="text/css" href="/css/base.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <script type="text/javascript" src="/js/base.js"></script>
</head>

<?php
  function h($s){
    return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
  }

  session_start();
  //ログイン済みの場合
  if (isset($_SESSION['EMAIL'])) {

    try {
      // データベースに接続
      $dsn = 'mysql:dbname=worldcup;host=localhost';
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

    $stmt = $pdo->prepare('SELECT users.email, users.role FROM users WHERE email = :email');
    $stmt->execute(array(':email' => $_SESSION['EMAIL']));
    // $result = 0;
    $result = $stmt->fetch(PDO::FETCH_ASSOC);


    // echo $result['role'];
    if($result['role'] == 0){
      echo '管理者ユーザー';
      echo '<br>';
      echo "<a href='logout.php'>ログアウトはこちら。</a>";
      // exit;
    }else{
      echo '一般ユーザー';
      echo '<br>';
      echo "<a href='logout.php'>ログアウトはこちら。</a>";
    }

  } else {//ログインしていない時
    echo 'ログインしてください。アカウントのない方はアカウントを作成してください。<br>';
    echo '<a href="login.php">ログイン</a>';
    echo '<br><a href="user.php">新規会員登録</a>';
    exit;
}

$_SESSION['role'] = $result['role'];
?>




<body>
  <header class="header">


      <!-- <button class="button_1"><a class="link_1" href="login.php">ログイン</a></button>
      <button class="button_1"><a class="link_1" href="user.php">新規登録</a></button> -->


<!--
          <form class="form_1" action="index.php" method="post">
              <input class="input_1" type="submit" name="logout" value="ログアウト">
          </form> -->

 </header>

<h2>選手一覧</h2>

<table>
  <tr>
       <th>No</th>
       <th>背番号</th>
       <th>ポジション</th>
       <th>名前</th>
       <th>所属</th>
       <th>誕生日</th>
       <th>身長</th>
       <th>体重</th>
       <th>国名</th>
  </tr>
  <?php foreach ($params['players'] as $player): ?>

    <?php if($player['del_flg']==0){ ?>
  <tr>
       <td><?=$player['id'] ?></td>
       <td><?=$player['uniform_num']?></td>
       <td><?=$player['position']?></td>
       <td><?=$player['name']?></td>
       <td><?=$player['club']?></td>
       <td><?=$player['birth']?></td>
       <td><?=$player['height']?>cm</td>
       <td><?=$player['weight']?>kg</td>
       <td><?=$player['country']?></td>
       <td><?=$player['del_flg']; ?></td>
       <td><a href="/view.php?id=<?=$player["id"]?>">詳細</a></td>

      <?php if($result['role'] == 0){?>
       <td><a href="/edit.php?id=<?=$player['id']?>">編集</a></td>
       <td><a href="/delete.php?id=<?=$player['id']?>" onclick='return confirm("削除しますか？");'>削除</a></td>
      <?php } ?>
  </tr>
  <?php } ?>

  <?php endforeach; ?>
</table>
  <div class='paging_box'>
    <div class=' paging'>
      <?php
    for($i=0; $i<=$params['pages']; $i++) {
      if(isset($_GET['page']) && $_GET['page'] == $i) {
        echo $i+1;
      } else {
        echo "<a href='?page=". $i. "'>". ($i+1). "</a>";
      }
    }
    ?>
    </div>
  </div>
</body>
</html>
