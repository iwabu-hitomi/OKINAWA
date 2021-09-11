<?php
// セッション開始
session_start();

// var_dump($_POST);

$db['host'] = "localhost";  // DBサーバのURL
$db['user'] = "root";  // ユーザー名
$db['pass'] = "root";  // ユーザー名のパスワード
$db['dbname'] = "okinawa";  // データベース名

// エラーメッセージ、登録完了メッセージの初期化
$errorMessage = "";
$signUpMessage = "";


// ログインボタンが押された場合
if (isset($_POST["passcom"])) {

    $dsn = sprintf('mysql: host=localhost; dbname=okinawa; charset=utf8', $db['host'], $db['dbname']);

    $pdo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

    $sql = "SELECT email, passreset FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':email' => $_POST["email"]));
    // $user = 0;
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if(empty($user)){
      header("Location: pass_com.php");
      exit();

    }

    if($_POST['passreset'] != $user['passreset']){
      header("Location: pass_com.php");
      exit();

    }

    // 1. ユーザIDの入力チェック
    if(empty($_POST["password"])){
        $errorMessage = 'パスワードが未入力です。';
        header("Location: pass_com.php");
        exit();

    } else if (empty($_POST["password2"])) {
        $errorMessage = 'パスワードが未入力です。';
        header("Location: pass_com.php");
        exit();

    } else if($_POST["password"] != $_POST["password2"]){
      header("Location: pass_com.php");
      exit();

    }

    if (!empty($_POST["password"]) && !empty($_POST["password2"]) && $_POST["password"] === $_POST["password2"]) {

      //パスワードの正規表現
      if (preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{5,100}+\z/i', $_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
       } else {
        echo '<div class="login_text" style="text-align:center;margin-top:30px">パスワードは半角英数字をそれぞれ1文字以上含んだ5文字以上で設定してください。</div>';
        $hostname = $_SERVER['HTTP_HOST'];//ドメインを取得
        if (!empty($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'],$hostname) !== false)) {
          echo '<div class="login_text" style="text-align:center"><a href="' . $_SERVER['HTTP_REFERER'] . '">戻る</a></div>';
        }
        // return false;
      }

      // $_POST['email'];


        // 入力したユーザIDとパスワードを格納
        // $name = $_POST["name"];
        $email = $_POST["email"];
        // $password = $_POST["password"];
        // $role = 1;

        // 2. ユーザIDとパスワードが入力されていたら認証する
        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);


        $pdo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $sql = "UPDATE users SET password='$password' WHERE email = '$email'";

        $sth=$pdo->prepare($sql);

        // 3. エラー処理
        try{
          $pdo->beginTransaction();
          // $sth->bindValue(':password',$password);
          $sth->execute();
          $pdo->commit();
        }catch(PDOException $e){
          $pdo->rollback();
          // var_dump('rollbackd');
          return false;
          // exit();
        }
    } else if($_POST["password"] != $_POST["password2"]) {
        $errorMessage = 'パスワードに誤りがあります。';
    }
}
?>
<div class="top">
  <a href="login.php">ログイン画面へ</a>
</div>
