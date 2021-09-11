<?php
session_start();
// require_once(ROOT_PATH .'Controllers/SeaController.php');
// $seas = new SeaController();
// $params = $seas->index();


require_once(ROOT_PATH .'Controllers/SeaController.php');
$seas = new SeaController();
$result = $seas->update();

// var_dump($_POST);
// var_dump($_FILES);
// exit;

if($result == true){
  header('location:index.php');

}else{
  echo 'エラーです';
}

?>
