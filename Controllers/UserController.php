 <?php
 require_once(ROOT_PATH .'/Models/User.php');
 // require_once(ROOT_PATH .'/Models/Umi.php');



 class UserController {

   private $request;
   private $User;
   // private $Umi;

   public function __construct() {
     // リクエストパラメータの取得
     $this->request['get'] = $_GET;
     $this->request['post'] = $_POST;

     // モデルオブジェクトの生成
     // $this->Umi = new Umi();
     $this->User=new User();
   }



   public function my_page(){
     $users = $this->User->my_page();
     $params = ['users' => $users];
     return $params;
   }

   public function login_user(){
     $users = $this->User->login_user();
     $params = ['users' => $users];
     return $params;
   }

   public function findAll_user() {
     $users = $this->User->findAll_user();
     $params = ['users' => $users];
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
