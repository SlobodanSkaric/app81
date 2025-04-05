<?php 

namespace App\Core;

final class Route{
    private string $requestMethod;
    private string $pattern;
    private string $controller;
    private string $method;
    private string $role;

    private function __construct(string $requestMethod, string $pattern, string $controller, string $method, $role = ""){
        $this->requestMethod = $requestMethod;
        $this->pattern       = $pattern;
        $this->controller    = $controller;
        $this->method        = $method;
        $this->role          = $role;
    }

    public static function get(string  $pattern, string $controller, string $method, $role): Route {
        return new Route("GET", $pattern, $controller, $method,$role);
    }

    public static function post(string  $pattern, string $controller, string $method, $role): Route{
        return new Route("POST",  $pattern, $controller, $method, $role);
    }

    public function matches(string $method, string $url):bool{
        if(!preg_match("/^" . $this->requestMethod . "$/", $method)){
            return false;
        }

        return boolval(preg_match($this->pattern, $url));
    }

    public function getController(){
        return $this->controller;
    }

    public function getMethod(){
        return $this->method;
    }

    public function extractArguments($url){
            $matches = [];
            $arguments = [];
            preg_match_all($this->pattern, $url, $matches);
    
            if(isset($matches[1])){
                $arguments = $matches[1];
            }
            
            
            return  $arguments;
        
    }

    public function checkedPremisinon(){
        if($this->role === "any"){
            return true;
        }

        $jwt = new \App\Auths\JWTToken();
        $userData = $jwt->analiseToken();

        if($userData === false){
            return false;
        }
        
        if($userData["role"] === $this->role){
            return true;
        }else{
            return false;
        }
    }
}