<?php
    namespace App\Models;   

    class UserModel{
        private $dbConnection;

        public function __construct(\App\Core\DatabaseConnection &$db){
            $this->dbConnection = $db;
        }

        public function getUserById(int $id){
            $sql = "SELECT * FROM user WHERE id = ?";
            $prep = $this->dbConnection->getConnection()->prepare($sql);
            $res = $prep->execute([$id]);
            $user = NULL;
            if($res){
                $user = $prep->fetch(\PDO::FETCH_OBJ);
            }
            return $user;
        }
    }