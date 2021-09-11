<!-- Models user -->
<?php
require_once(ROOT_PATH .'/Models/Db.php');


class User extends Db {
  private $table = 'users';

  public function __construct($dbh = null) {
    parent::__construct($dbh);
  }


  public function my_page(){
    if (isset($_SESSION['EMAIL'])) {
      $stmt = $this->dbh->prepare('SELECT * FROM users WHERE email = :email');
      $stmt->execute(array(':email' => $_SESSION['EMAIL']));
      $user = 0;
      $user = $stmt->fetch(PDO::FETCH_ASSOC);
      echo '<h2>'. $user['name'] .'さんのマイページ<h1>';
      return $user;
    }
  }

  public function findAll_user(){
      $sql = 'SELECT * FROM users';
      $sth = $this->dbh->prepare($sql);
      $sth->execute(array());
      $users = $sth->fetchAll(PDO::FETCH_ASSOC);
      return $users;
  }

  public function login_user(){
     session_start();
     // echo $_SESSION['EMAIL'];
      //ログイン済みの場合
     if (isset($_SESSION['EMAIL'])) {
       $stmt = $this->dbh->prepare('SELECT id, name, email, role FROM users WHERE email = :email');
       $stmt->execute(array(':email' => $_SESSION['EMAIL']));
       $user = 0;
       $user = $stmt->fetch(PDO::FETCH_ASSOC);
       // echo $user['role'];
       if($user['role'] == 0){
         echo '<div class="user_role">管理者ユーザー</div>';
         return $user;
       }else{
         echo '<div class="user_role">一般ユーザー</div>';
         // echo $user['id'] .'ログインID';
         // echo '<br>';
         return $user;
       }
     }
   }



   public function pass_reset(){
      $email = $_POST['email'];
      $stmt = $this->dbh->prepare('SELECT * FROM users WHERE email = :email');
      $stmt->execute(array(':email' => $email));
      $user = 0;
      $user = $stmt->fetch(PDO::FETCH_ASSOC);
      return $user;
   }

   public function pass_save(){
      $email = $_POST['email'];
      $passreset = md5(uniqid(rand(),true));
      // $now = date("Y/m/d H:i:s");

      $sql = "UPDATE users SET passreset='$passreset' WHERE email = '$email'";
      $sth = $this->dbh->prepare($sql);
      $sth->bindValue(':passreset', $passreset);
      // $sth->bindValue(':resetdate', $now);
      $sth->execute(array($passreset));
      // print_r($sth -> errorInfo());
      echo '登録完了';
   }





}


?>
