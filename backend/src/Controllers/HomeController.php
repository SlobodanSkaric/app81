<?php 
namespace App\Controllers; 
class HomeController extends Controller{
    public function getUserUd(int $id){
        $userModel = new \App\Models\UserModel($this->getDbConnection());
        $user = $userModel->getUserById($id);
        return $user;
    }
   /*  public function index(){
        $this->set('message', 'Hello world!');
    } */
}