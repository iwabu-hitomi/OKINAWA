<?php
require_once(ROOT_PATH .'/Models/Db.php');


class Sea extends Db {
    private $table = 'seas,users,areas';

    public function __construct($dbh = null) {
      parent::__construct($dbh);
    }


    /**
     * seasテーブルからすべてデータを取得
     *
     * @param integer $page ページ番号
     * @return Array $result 全選手データ
     */

     public function findAll(){
       $sql = 'SELECT seas.id,seas.area_id,seas.date,seas.point,seas.temperature,seas.transparency,seas.image,seas.comment,seas.create_at,seas.del_flg,seas.user_id,seas.latitude,seas.longitude,areas.name AS area_name FROM seas LEFT JOIN areas ON areas.id = seas.area_id ORDER BY id DESC';
       $sth = $this->dbh->prepare($sql);
       $sth->execute(array());
       $seas = $sth->fetchAll(PDO::FETCH_ASSOC);
       return $seas;
     }

     public function save(){

       $sth = $this->dbh->prepare('SELECT id, email FROM users WHERE email = :email');
       $sth->execute(array(':email' => $_SESSION['EMAIL']));
       $reslt = 0;
       $reslt = $sth->fetch(PDO::FETCH_ASSOC);
       // return $user;
       // echo $reslt['id'];


       $area_id = $_POST['area_id'];
       $date = $_POST['date'];
       $point = $_POST['point'];
       $temperature = $_POST['temperature'];
       $transparency = $_POST['transparency'];
       // $image = $_POST['image'];
       $comment = $_POST['comment'];
       $latitude = $_POST['latitude'];
       $longitude = $_POST['longitude'];
       $user_id = $reslt['id'];

       // $file = $_POST['d_file'];

       $error="";


       if (isset($_FILES['image'])) {//送信ボタンが押された場合
       $image= uniqid(mt_rand(), true);//ファイル名をユニーク化
       $image.= '.' . substr(strrchr($_FILES['image']['name'], '.'), 1);//アップロードされたファイルの拡張子を取得
       // $image .= '.' . $_FILES['image']['name'];//アップロードされたファイルの拡張子を取得

       $file = "./images/".$image;

       if (!empty($_FILES['image']['name'])) {//ファイルが選択されていれば$imageにファイル名を代入
           move_uploaded_file($_FILES['image']['tmp_name'],$file);//imagesディレクトリにファイル保存
           if (exif_imagetype($file)) {//画像ファイルかのチェック
               $message = '画像をアップロードしました';
               // $stmt->execute();
           } else {
               $message = '画像ファイルではありません';
           }
       }else{
         $error.="写真を選択してください<br>\n";

       }
       // $error="";

       if($comment==""){
         $error.="コメントを記入してください<br>\n";
       }

       if($date==""){
         $error.="日付を入力してください<br>\n";
       }elseif($date !== date('Y-m-d',strtotime($date))){
               $error.="日付はYYYY-MM-DDの形式で半角数字で入力してください。<br>\n";
           }

       if($latitude==""){
         $error.="緯度を入力してください<br>\n";
       }

       if($longitude==""){
         $error.="経度を入力してください<br>\n";
       }

       if($_FILES['image']==""){
         $error.="写真を選択してください<br>\n";
       }


       if($error!=""){
         echo "<p style='color:red;text-align:center'>".$error."</p>";
         echo "<div style='text-align:center'><a href='insert.php'>戻る</a></div>";
         exit;
       }



           // SQL作成

           try{


          $sql = "INSERT INTO seas (area_id, date, point, temperature, transparency, image, comment, latitude, longitude, user_id)
                  VALUES (:area_id,:date,:point,:temperature,:transparency,:image,:comment,:latitude,:longitude,:user_id)";
          // $sql = "INSERT INTO seas (area_id)
          //         VALUES (:area_id)";
          $sth = $this->dbh->prepare($sql);
          $sth -> bindValue(':area_id',$area_id); //エリア
          $sth -> bindValue(':date',$date); //日付
          $sth -> bindValue(':point',$point); //ポイント
          $sth -> bindValue(':temperature',$temperature); //水温
          $sth -> bindValue(':transparency',$transparency); //透明度
          $sth -> bindValue(':image',$file); //写真
          $sth -> bindValue(':comment',$comment); //コメント
          $sth -> bindValue(':latitude',$latitude); //緯度
          $sth -> bindValue(':longitude',$longitude); //経度
          $sth -> bindValue(':user_id',$user_id); //ユーザーID

          var_dump($sth->execute());
        }catch (PDOException $e){
          var_dump($e);
          return false;
        }

          // var_dump($sth->execute();

      }

    return true;
  }

  public function findById($id = 0):Array {
    // $sql = 'SELECT players.id,players.country_id,players.uniform_num,players.position,players.name,players.club,players.birth,players.height,players.weight,countries.name AS country,players.del_flg FROM ' .$this->table;
    // $sql = 'SELECT seas.id,seas.area_id,seas.date,seas.point,seas.temperature,seas.transparency,seas.image,seas.comment,seas.create_at,seas.del_flg,seas.user_id,seas.latitude,seas.longitude,areas.name AS area_name FROM seas LEFT JOIN areas ON areas.id = seas.area_id LEFT JOIN users ON users.id = seas.user_id';
    $sql = 'SELECT * FROM seas LEFT JOIN areas ON areas.id = seas.area_id';
    $sql .= ' WHERE seas.id = :id';
    $sth = $this->dbh->prepare($sql);
    $sth->bindParam(':id', $id, PDO::PARAM_INT);
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_ASSOC);
    // var_dump($result);
    return $result;
  }

  public function editUpdate(){

  $id=$_POST["id"];
  $area_id=$_POST["area_id"];
  $date=$_POST["date"];
  $point=$_POST["point"];
  $temperature=$_POST["temperature"];
  $transparency=$_POST["transparency"];
  $file = $_POST['d_file'];
  $comment=$_POST["comment"];
  $latitude=$_POST["latitude"];
  $longitude=$_POST["longitude"];

  // var_dump($_POST["id"]);

  $error="";

  if($date==""){
    $error.="日付が未入力です<br>\n";
  }

  if($comment==""){
    $error.="コメントを記入してください<br>\n";
  }

  if($date==""){
    $error.="日付を入力してください<br>\n";
  }elseif($date !== date('Y-m-d',strtotime($date))){
          $error.="日付はYYYY-MM-DDの形式で半角数字で入力してください。<br>\n";
      }

  if($latitude==""){
    $error.="緯度を入力してください<br>\n";
  }

  if($longitude==""){
    $error.="経度を入力してください";
  }




  if($error!=""){
    echo "<p style='color:red;text-align:center'>".$error."</p>";
    echo "<div style='text-align:center'><a href='edit.php?id=$id'>戻る</a></div>";

    exit;
  }

  // if (isset($_FILES['image'])) {//送信ボタンが押された場合
  // $image= uniqid(mt_rand(), true);//ファイル名をユニーク化
  // $image.= '.' . substr(strrchr($_FILES['image']['name'], '.'), 1);//アップロードされたファイルの拡張子を取得
  // $file = $_POST['d_file'];

  if (!empty($_FILES['image']['name'])) {//ファイルが選択されていれば$imageにファイル名を代入
    $image= uniqid(mt_rand(), true);//ファイル名をユニーク化
    $image.= '.' . substr(strrchr($_FILES['image']['name'], '.'), 1);//アップロードされたファイルの拡張子を取得
    $file = "./images/$image";

      move_uploaded_file($_FILES['image']['tmp_name'],$file);//imagesディレクトリにファイル保存
      if (exif_imagetype($file)) {//画像ファイルかのチェック
          $message = '画像をアップロードしました';
          // $stmt->execute();
      } else {
          $message = '画像ファイルではありません';
      }
  }

  // var_dump($_FILES['image']['name']);

  // $image = $image_name;

    $sql = "UPDATE seas SET area_id='$area_id', date='$date', point='$point', temperature='$temperature', transparency='$transparency', image='$file', comment='$comment', latitude='$latitude', longitude='$longitude' WHERE id = $id";
    // $sql="UPDATE seas SET seas.area_id = :area_id,
    //           seas.date = :date,
    //           seas.point = :point,
    //           seas.temperature = :temperature,
    //           seas.transparency = :transparency,
    //           seas.image = :image,
    //           seas.comment = :comment,
    //           seas.latitude = :latitude,
    //           seas.longitude = :longitude,
    //           WHERE seas.id = :id";
  #$sql.=" WHERE p.id=:id AND ".$country."=c.name";
  $sth=$this->dbh->prepare($sql);

  try{
    $this->dbh->beginTransaction();
    $sth->bindValue(':area_id',$area_id);
    $sth->bindValue(':date',$date);
    $sth->bindValue(':point',$point);
    $sth->bindValue(':temperature',$temperature);
    $sth->bindValue(':transparency',$transparency);
    $sth->bindValue(':image',$file);
    $sth->bindValue(':comment',$comment);
    $sth->bindValue(':latitude',$latitude);
    $sth->bindValue(':longitude',$longitude);
    $sth->execute();
    $this->dbh->commit();
  }catch(PDOException $e){
    $this->dbh->rollback();
    // var_dump('rollbackd');
    return false;
    // exit();
  }
 // }
 return true;
}

  // public function delete($id){
  //   $sql='UPDATE seas SET del_flg=1 WHERE id=:id';
  //   $sth=$this->dbh->prepare($sql);
  //
  //   $this->dbh->beginTransaction();
  //
  //   try{
  //     $sth->bindParam(':id', $id, PDO::PARAM_INT);
  //     $sth->execute();
  //     $this->dbh->commit();
  //    // print_r($sth->errorInfo());
  //   }catch(PDOException $e){
  //     $this->dbh->rollback();
  //     throw $e;
  //   }
  //
  // }

  public function delete(){
     $sql = 'DELETE FROM seas WHERE id = :id';
     $sth = $this->dbh->prepare($sql);
     $sth->execute(array(':id' => $_GET["id"]));
  }


  public function mypage_view(){
    // $sql = 'SELECT * FROM seas WHERE user_id = :user_id ORDER BY id DESC';
    $sql = 'SELECT seas.* ,areas.name FROM seas LEFT JOIN areas ON areas.id = seas.area_id
            WHERE user_id = :user_id ORDER BY id DESC';
    $sth = $this->dbh->prepare($sql);
    $sth->execute(array(':user_id' => $_GET["id"]));
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }




}



?>
