<?php 

namespace App\Controllers;

class UserController extends Controller{   

    public function getUserById(int $id){
        $userModel = new \App\Models\UserModel($this->getDbConnection());       
        $user = $userModel->getUserById($id);
        $this->set('user', $user);
    }


    public function userRegistration(){
        $userModel = new \App\Models\UserModel($this->getDbConnection());
        $user = $userModel->registerUser();
        $this->set('user', $user);
    }

    public function userLogin(){
        $userModel = new \App\Models\UserModel($this->getDbConnection());
        $user = $userModel->loginUser();


        $this->redirect('/',(array) $user);
    }
   
}