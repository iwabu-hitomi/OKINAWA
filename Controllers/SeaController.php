<?php
require_once(ROOT_PATH .'/Models/User.php');
require_once(ROOT_PATH .'/Models/Sea.php');

class SeaController {

  private $request;
  private $User;
  private $Sea;

  public function __construct() {
    // リクエストパラメータの取得
    $this->request['get'] = $_GET;
    $this->request['post'] = $_POST;

    // モデルオブジェクトの生成
    $this->User = new User();
    $this->Sea=new Sea();
  }

  public function index() {
    $seas = $this->Sea->findAll();
    $params = ['seas' => $seas];
    return $params;
  }


  public function view() {
    if(empty($this->request['get']['id'])) {
      echo '指定のパラメータが不正です。このページを表示できません。';
      exit;
    }
    $sea = $this->Sea->findById($this->request['get']['id']);
    $params = array('sea' => $sea);
    return $params;
}


  public function save(){
    $result = $this->Sea->save();
    // $params = ['seas' => $seas];
  return $result;
  }
  

  public function edit(){
        if(empty($this->request["get"]["id"])){
            echo "指定のパラメータが不正です。このページを表示できません。";
            exit;
        }else {
          $sea = $this->Sea->findById($this->request['get']['id']);
          $params = array('sea' => $sea);
          return $params;
        }
      }


  public function update(){
    $result = $this->Sea->editUpdate();
    // $params = ['seas' => $seas];
    return $result;
  }

  public function delete($id){
        if(empty($this->request["get"]["id"])){
            echo "指定のパラメータが不正です。このページを表示できません。";
            exit;
        }

		$this->Sea->delete($this->request["get"]["id"]);
		$this->Sea->delete($id);
    return $result;

		// $tmp=$this->Player_tmp->tmpUpdate();
	}


  public function mypage_view() {
    if(empty($this->request['get']['id'])) {
      echo '<div class="mypage_view" style="text-align:center">投稿画像がありません</div>';
      exit;
    }
    $seas = $this->Sea->mypage_view($this->request['get']['id']);
    $params = array('seas' => $seas);
    return $params;
}

  public function pass_reset(){
    $users = $this->User->pass_reset();
    $params = ['users' => $users];
    return $params;
  }

  public function pass_save(){
    $users = $this->User->pass_save();
    $params = ['users' => $users];
    return $params;
  }




}


?>
