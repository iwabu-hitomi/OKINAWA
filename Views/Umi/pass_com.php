<?php

if(!isset($_POST['email'])){
  header("Location: pass_reset.php");
  exit();
}

// echo $_POST["email"];

// mb_send_mail($_POST["email"],'パスワード変更について','パスワード変更について');

// セッション開始
session_start();

$db['host'] = "localhost";  // DBサーバのURL
$db['user'] = "root";  // ユーザー名
$db['pass'] = "root";  // ユーザー名のパスワード
$db['dbname'] = "okinawa";  // データベース名

// エラーメッセージの初期化
$errorMessage = "";

// 認証ボタンが押された場合
if (isset($_POST["passreset"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST["email"])) {  // emptyは値が空のとき
        $errorMessage = 'メールアドレスが未入力です。';
    }

    if (!empty($_POST["email"])) {

        // 入力したユーザIDを格納
        $email = $_POST["email"];
        // $password = $_POST["password"];

        // 2. ユーザIDとパスワードが入力されていたら認証する
        $dsn = sprintf('mysql: host=localhost; dbname=okinawa; charset=utf8', $db['host'], $db['dbname']);

        // 3. エラー処理
        try {
            $pdo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(':email' => $_POST["email"]));
            // $user = 0;
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
              echo '<div class="login_text" style="text-align:center;margin-top:30px">入力された値が不正です。</div>';
              return false;
            }
            //emailがDB内に存在しているか確認
            if (!isset($user['email'])) {
              echo '<div class="login_text" style="text-align:center;margin-top:30px">メールアドレスが間違っています。</div>';
              echo '<br>';
              $hostname = $_SERVER['HTTP_HOST'];//ドメインを取得
              if (!empty($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'],$hostname) !== false)) {
                echo '<div class="login_text" style="text-align:center"><a href="' . $_SERVER['HTTP_REFERER'] . '">戻る</a></div>';
              }
              return false;
            }


        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $sql;
            // $e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）
            // echo $e->getMessage();
        }
    }
}
// 　　　　 $passreset = rand(4,1000);
        $passreset = rand(4,10000);

        mb_language("Japanese");
        mb_internal_encoding("UTF-8");

        $to = $_POST['email'];
        $title = 'パスワードリセット';
        $message = 'パスワードをリセットします'.$passreset;
        $header = 'From:' . $_POST['email'];
        if(mb_send_mail($to, $title, $message, $header, '-f' . $_POST['email'])){
          echo "メールを送信しました";
        } else {
          echo "メールの送信に失敗しました";
        };

        $pdo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

        $sql = "UPDATE users SET passreset ='$passreset' WHERE email = '$email'";
        var_dump($sql);
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        // $user = 0;
        // $user = $stmt->fetch(PDO::FETCH_ASSOC);


        // $sql = "UPDATE users SET passreset='$passreset' WHERE email = $email";


// var_dump($sql);


// $_SESSION['email'] = $_POST['email'];
// var_dump($_POST);
// var_dump($user);

 ?>

 <!doctype html>
 <html>
 <head>
 <meta charset="UTF-8">
 <title>パスワード変更</title>
 <link rel="stylesheet" href="../css/base.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
 <script src="https://code.jquery.com/jquery-1.9.1.min.js" integrity="sha256-wS9gmOZBqsqWxgIVgA8Y9WcQOa7PgSIX+rPA0VL2rbQ=" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

 </head>
     <body class="sign_up">
         <h1>パスワード変更</h1>
         <form id="loginForm" name="loginForm" action="pass_update.php" method="POST">

           <input type="hidden" name="email" value="<?php echo $_POST["email"];?>" >

             <fieldset>
                 <legend>パスワードを入力</legend>
                 <div><font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>
                 <label for="password">パスワード</label><input type="password" id="password" name="password" value="" placeholder="パスワードを入力">
                 <br>
                 <label for="password2">パスワード(確認用)</label><input type="password" id="password2" name="password2" value="" placeholder="再度パスワードを入力">
                 <br>
                 <label for="passreset">認証数字入力</label>
                 <input type="passreset" id="passreset" name="passreset" value="">
                 <br>
                 <input type="submit" id="passcom" name="passcom" value="パスワード変更">
                 <!-- <button type="submit" name="passreset" onClick='return confirm("上書きしますか？");'>パスワード変更</button> -->

             </fieldset>
         </form>
         <br>
         <form id="loginForm_next" action="login.php">
             <input type="submit" value="ログイン画面へ">
         </form>

         <!-- <div class="top">
           <a href="index.php">トップへ戻る</a>
         </div> -->

     </body>
 </html>
