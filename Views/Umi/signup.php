<?php
// セッション開始
session_start();

$db['host'] = "localhost";  // DBサーバのURL
$db['user'] = "root";  // ユーザー名
$db['pass'] = "root";  // ユーザー名のパスワード
$db['dbname'] = "okinawa";  // データベース名

// エラーメッセージ、登録完了メッセージの初期化
$errorMessage = "";
$signUpMessage = "";


// ログインボタンが押された場合
if (isset($_POST["signUp"])) {

    $dsn = sprintf('mysql: host=localhost; dbname=okinawa; charset=utf8', $db['host'], $db['dbname']);

    $pdo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

    $sql = "SELECT email FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':email' => $_POST["email"]));
    $user = 0;
    $user = $stmt->fetch(PDO::FETCH_ASSOC);



    // 1. ユーザIDの入力チェック
    if(empty($_POST["name"])){
        $errorMessage = '名前が未入力です。';
    }else if (empty($_POST["email"])) {  // 値が空のとき
        $errorMessage = 'メールアドレスが未入力です。';
    } else if (empty($_POST["password"])) {
        $errorMessage = 'パスワードが未入力です。';
    } else if (empty($_POST["password2"])) {
        $errorMessage = 'パスワードが未入力です。';
    }

    if (!empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["password2"]) && $_POST["password"] === $_POST["password2"]) {

      // //POSTのValidate。
      if (!$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo '<div class="login_text" style="text-align:center;margin-top:30px">入力された値が不正です。</div>';
        $hostname = $_SERVER['HTTP_HOST'];//ドメインを取得
        if (!empty($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'],$hostname) !== false)) {
          echo '<div class="login_text" style="text-align:center"><a href="' . $_SERVER['HTTP_REFERER'] . '">戻る</a></div>';
        }
        return false;
      }else if (!empty($user['email'])){
        if($user['email'] === $email) {
          echo '<div class="login_text" style="text-align:center;margin-top:30px">同じメールアドレスが存在します。</div>';
          echo '<div class="login_text" style="text-align:center"><a href="signup.php">戻る</a></div>';
        }
        return false;
      }
      //パスワードの正規表現
      if (preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{5,100}+\z/i', $_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
       } else {
        echo '<div class="login_text" style="text-align:center;margin-top:30px">パスワードは半角英数字をそれぞれ1文字以上含んだ5文字以上で設定してください。</div>';
        $hostname = $_SERVER['HTTP_HOST'];//ドメインを取得
        if (!empty($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'],$hostname) !== false)) {
          echo '<div class="login_text" style="text-align:center"><a href="' . $_SERVER['HTTP_REFERER'] . '">戻る</a></div>';
        }
        return false;
      }


        // 入力したユーザIDとパスワードを格納
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $role = 1;

        // 2. ユーザIDとパスワードが入力されていたら認証する
        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);



        // 3. エラー処理
        try {
            $pdo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

            $stmt = $pdo->prepare("INSERT INTO users (name, email, password,role) VALUES (?, ?, ?, ?)");

            $stmt->execute(array($name,$email, password_hash($password, PASSWORD_DEFAULT),$role));  // パスワードのハッシュ化を行う（今回は文字列のみなのでbindValue(変数の内容が変わらない)を使用せず、直接excuteに渡しても問題ない）
            $userid = $pdo->lastinsertid();  // 登録した(DB側でauto_incrementした)IDを$useridに入れる

            $signUpMessage = '登録が完了しました。登録の名前は '. $name. ' です。メールアドレスは '. $email. ' です。ログインして下さい。';  // ログイン時に使用するIDとパスワード

        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';


            // $e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）
            // echo $e->getMessage();
        }
    } else if($_POST["password"] != $_POST["password2"]) {
        $errorMessage = 'パスワードに誤りがあります。';
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
        <h1>新規登録画面</h1>
        <form id="loginForm" name="loginForm" action="" method="POST">
            <fieldset>
                <legend>新規登録フォーム</legend>
                <div><font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>
                <div><font color="#0000ff"><?php echo htmlspecialchars($signUpMessage, ENT_QUOTES); ?></font></div>
                <label for="name">名前</label><input type="text" id="name" name="name" placeholder="名前を入力" value="<?php if (!empty($_POST["name"])) {echo htmlspecialchars($_POST["name"], ENT_QUOTES);} ?>">
                <br>
                <label for="email">メールアドレス</label><input type="text" id="email" name="email" placeholder="メールアドレスを入力" value="<?php if (!empty($_POST["email"])) {echo htmlspecialchars($_POST["email"], ENT_QUOTES);} ?>">
                <br>
                <label for="password">パスワード</label><input type="password" id="password" name="password" value="" placeholder="パスワードを入力">
                <br>
                <label for="password2">パスワード(確認用)</label><input type="password" id="password2" name="password2" value="" placeholder="再度パスワードを入力">
                <br>
                <input type="submit" id="signUp" name="signUp" value="新規登録">
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
