<?php
session_start();
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

  <section class="sigh_up_pass">
    <h1>パスワードを忘れた方へ</h1>
       <form id="loginForm" name="loginForm" action="pass_com.php" method="POST">
        <fieldset>
            <legend>登録しているメールアドレス</legend>

            <label for="email">メールアドレス</label><input type="text" id="email" name="email" placeholder="メールアドレスを入力" value="">
             <br>
            <button type="submit" name="passreset" id="passreset">認証</button>
        </fieldset>
    </form>

  </section>
  <div class="sigh_up_pass">
        <a href="login.php">ログインへ戻る</a>
  </div>


</body>
</html>
