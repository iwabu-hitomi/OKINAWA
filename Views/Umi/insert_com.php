<?php

session_start();

// $_POST['area_id'] = $_SESSION['area_id'];
// $_POST['date'] = $_SESSION['date'];
// $_POST['point'] = $_SESSION['point'];
// $_POST ['temperature']= $_SESSION['temperature'];
// $_POST ['transparency']= $_SESSION['transparency'];
// $_POST ['image']= $_SESSION['image'];
// $_POST['comment'] = $_SESSION['comment'];
// $_POST ['latitude']= $_SESSION['latitude'];
// $_POST ['longitude']= $_SESSION['longitude'];
//
// var_dump($_POST['area_id']);
// var_dump ($_POST['date']) ;
// var_dump ($_POST['point']);
// var_dump ($_POST['temperature']);
// var_dump ($_POST['transparency']);
// var_dump ($_FILES['image']);
// var_dump ($_POST['comment']);
// var_dump ($_POST['latitude']);
// var_dump ($_POST['longitude']);
//
// var_dump($_POST);


?>

<?php
require_once(ROOT_PATH .'Controllers/SeaController.php');
$seas = new SeaController();
$result = $seas->save();

if($result == true){
  header('location:index.php');

}else{
  echo 'エラーです';
}

?>
