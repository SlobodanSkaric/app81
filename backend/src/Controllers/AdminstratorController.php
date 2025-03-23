<?php
namespace App\Controllers;

class AdminstratorController extends Controller{
    public function getAdminById(int $id){
        $adminModel = new \App\Models\AdminstratorModel($this->getDbConnection());
        $admin = $adminModel->getAdminstratorById($id);
        $this->set('admin', $admin);
    }

    public function adminRegistration(){
        $adminModel = new \App\Models\AdminstratorModel($this->getDbConnection());
        $admin = $adminModel->registerAdminstrator();
        $this->set('admin', $admin);
    }

    public function adminLogin(){
        $adminModel = new \App\Models\AdminstratorModel($this->getDbConnection());
        $admin = $adminModel->loginAdminstrator();
        $this->redirect('/', (array)$admin);
    }
}