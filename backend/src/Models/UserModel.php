<?php
    namespace App\Models;   

    class UserModel extends Model{
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

        public function registerUser(){
            $data = $this->getJsonDatas();
            $name = filter_var( $data["name"], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW);
            $lastName = filter_var( $data["lastname"], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW);
            $email = filter_var( $data["email"], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW);
            $phone = filter_var( $data["phone"], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW);
            $password = filter_var( $data["password"], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW);

            if(!$name || !$lastName || !$email || !$phone || !$password){
                return false;
            }

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                return "Email is not valid";
            }

            if(strlen($email) < 6){
                return "Email must have at least 6 characters";
            }

            if(!preg_match('/^(\+3816[0-9]{7,8})$/', $phone)){
                return "Phone number is not valid";
            }

            if(strlen($phone) < 9){
                return "Phone number must have at least 9 characters";
            }

            if(strlen($name) < 3 || strlen($lastName) < 3){
                return "Name and last name must have at least 3 characters";
            }    

            

            

            if(strlen($password) < 6){
                return false;
            }


            $password = md5($password);
           
            
            
            
            $sql = "INSERT INTO user (name,lastname,email,phone,password) VALUES (?, ?, ?, ?, ?)";
            $prep = $this->dbConnection->getConnection()->prepare($sql);
            $res = $prep->execute([$name, $lastName, $email, $phone, $password]);

            if(!$res){
                return false;
            }
            
            return true;
        }


        public function loginUser(){
            $data = $this->getJsonDatas();
            $email = filter_var( $data["email"], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW);
            $password = filter_var( $data["password"], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW);

            if(!$email || !$password){
                return "Email and password are required";
            }

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                return "Email is not valid";
            }

            if(strlen($email) < 6){
                return "Email must have at least 6 characters";
            }

            if(strlen($password) < 6){
                return false;
            }

            
            $sql = "SELECT * FROM user WHERE email = ? ";
            $prep = $this->dbConnection->getConnection()->prepare($sql);
            $res = $prep->execute([$email]);
            $user = NULL;
            if($res){
                $user = $prep->fetch(\PDO::FETCH_OBJ);
            }

            IF(!$user){
                return "User with this email does not exist";
            }

            if(!password_verify($password, $user->password)){
                return "Password is not correct";
            }   

            //print_r(json_decode(json_encode($user), true));
            $serData = $this->removePasswordFromData((array)$user);
            return $serData;
            
        }
    }