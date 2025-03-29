<?php 
namespace App\Core;

use Dotenv\Dotenv;

class DatabaseConnection{
    private static ?DatabaseConnection $instance = null;    
    private  $connection;

   
    private function __construct(){
        /* $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../../");
        $dotenv->load();
     */
        $host       = "127.0.0.1";
        $dbname     = "inco81";
        $username   = "root";
        $password   = "";

        try{
            $this->connection = new \PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }catch(\PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
    }


    public static function getInstance(): DatabaseConnection{
        if(is_null(self::$instance)){
            self::$instance = new DatabaseConnection();
        }
        return self::$instance;
    }

    
    public function getConnection(){
        return $this->connection;  
    }         
    
}