<?php 
namespace App\Controllers;

class UserController extends Controller{   
    public function getUserById(int $id){
        
        $this->analiseToken();//betater mechanisam for checking token
        if(!$this->checkedUserId($id)) return false;
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
        var_dump($user);    //imlement exception handling
        
        $token = $this->generateToken($user, "user");   

        $this->set('token', $token);
    }
   
}