<?php
namespace App\Models;

class Model {
    
    public function getJsonDatas(){
        $jsonData = file_get_contents('php://input');
        $data = json_decode($jsonData, true);
        return $data;
    }

    public function removePasswordFromData($data){
        
        unset($data['password']);
        return $data;
    }   
}
