<?php
namespace App\Controllers;

class Controller{
    private $dbConnection;
    private $data = [];

    final public function __construct(\App\Core\DatabaseConnection $dbc){
        $this->dbConnection = $dbc;
    }

   

    final protected function set(string $name, $value){
        $result = false;
        if(preg_match("/^[a-z][a-z0-9]+([A-Z][a-z0-9]+)*$/", $name)){
            $this->data[$name] = $value;
            $result = true;
        }

        return $result;
    }


    public function &getDbConnection(): \App\Core\DatabaseConnection{
        return $this->dbConnection;
    }
    final public function &getData(): array{
        return $this->data;
    }

    public function redirect(string $path, array $data = []){
        ob_clean();
        session_start();
        $_SESSION["data"] = [
            "messages" => "Login successful",
            //"role" => $data["role"],
            "id" => $data["id"],
            "email" => $data["email"],
            "phone" => $data["phone"],
            "name" => $data["name"],
            "lastname" => $data["lastname"],
        ];
        header("Location: app81/".$path);
        exit;
    }
}