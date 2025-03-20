<?php 

namespace App\Controllers;

class UserController extends Controller{   

    public function getUserById(int $id){
        $userModel = new \App\Models\UserModel($this->getDbConnection());       
        $user = $userModel->getUserById($id);
        $this->set('user', $user);
        //$this->getData();
    }
   
}