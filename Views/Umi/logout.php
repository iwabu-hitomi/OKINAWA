<?php
session_start();
$_SESSION = array();//セッションの中身をすべて削除
session_destroy();//セッションを破壊
?>

<p>ログアウトしました。</p>
<a href="index.php">トップへ</a>
<script type='text/javascript'>location.href = './index.php'</script>
