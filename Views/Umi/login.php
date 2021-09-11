<!-- 管理者
email　test@test.com
password  pass1

一般
email  hitomiiiin3@gmail.com
password  pass1 -->


<?php
// セッション開始
session_start();

$db['host'] = "localhost";  // DBサーバのURL
$db['user'] = "root";  // ユーザー名
$db['pass'] = "root";  // ユーザー名のパスワード
$db['dbname'] = "okinawa";  // データベース名

// エラーメッセージの初期化
$errorMessage = "";

// ログインボタンが押された場合
if (isset($_POST["login"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST["email"])) {  // emptyは値が空のとき
        $errorMessage = 'メールアドレスが未入力です。';
    } else if (empty($_POST["password"])) {
        $errorMessage = 'パスワードが未入力です。';
    }

    if (!empty($_POST["email"]) && !empty($_POST["password"])) {


        // 入力したユーザIDを格納
        $email = $_POST["email"];
        $password = $_POST["password"];

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
              echo '入力された値が不正です。';
              return false;
            }
            //emailがDB内に存在しているか確認
            if (!isset($user['email'])) {
              echo 'メールアドレス又はパスワードが間違っています。';
              echo '<br>';
              $hostname = $_SERVER['HTTP_HOST'];//ドメインを取得
              if (!empty($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'],$hostname) !== false)) {
                echo '<a href="' . $_SERVER['HTTP_REFERER'] . '">戻る</a>';
              }
              return false;
            }

            // var_dump($_POST['password']);
            // var_dump($user['password']);

            //パスワード確認後sessionにメールアドレスを渡す
            if (password_verify($_POST['password'], $user['password'])) {
              session_regenerate_id(true); //session_idを新しく生成し、置き換える
              $_SESSION['EMAIL'] = $user['email'];
              $_SESSION['name'] = $user['name'];
              $_SESSION['id'] = $user['id'];
              echo '<div class="login_text" style="text-align:center;margin-top:30px">ログインしました</div>';
              // echo '<br>';
              echo '<div class="login_text" style="text-align:center"><a href="index.php" style="text-align:center">トップへ</a></div>';

            } else {
              echo '間違えているので、もう一度お願い致します。';
              echo '<br>';
              $hostname = $_SERVER['HTTP_HOST'];//ドメインを取得
              if (!empty($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'],$hostname) !== false)) {
                echo '<a href="' . $_SERVER['HTTP_REFERER'] . '">戻る</a>';
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
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>新規会員登録</title>
<link rel="stylesheet" href="../css/base.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.9.1.min.js" integrity="sha256-wS9gmOZBqsqWxgIVgA8Y9WcQOa7PgSIX+rPA0VL2rbQ=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

</head>
    <body class="sign_up">
        <h1>ログイン画面</h1>
        <form id="loginForm" name="loginForm" action="login.php" method="POST">
            <fieldset>
                <legend>ログインフォーム</legend>
                <div><font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>
                <label for="email">メールアドレス</label><input type="text" id="email" name="email" placeholder="メールアドレスを入力" value="<?php if (!empty($_POST["email"])) {echo htmlspecialchars($_POST["email"], ENT_QUOTES);} ?>">
                <br>
                <label for="password">パスワード</label><input type="password" id="password" name="password" value="" placeholder="パスワードを入力">
                <br>
                <input type="submit" id="login" name="login" value="ログイン">
            </fieldset>
        </form>
        <br>
        <form action="signup.php">
            <fieldset>
                <legend>新規登録はこちらから</legend>
                <input type="submit" value="新規登録">
            </fieldset>
        </form>

        <div class="login_pass">
              <a href="pass_reset.php">パスワードを忘れた方はこちら</a>
        </div>

        <!-- <div class="top">
          <a href="index.php">トップへ戻る</a>
        </div> -->

    </body>
</html>
