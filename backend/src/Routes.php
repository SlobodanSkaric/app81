<?php

namespace App\Routes;

class Routes{

    private $routesGet = [
        "/home" => "HomeControlle",
        "/idnum" => "SearcControlle",
    ];
    private $routesPost = [];



    public function serchRoutes(string $url, string $methods){
        if($methods === "GET"){
            if(in_array($url, $this->routesGet)){
                foreach($this->routesGet as $uri => $controller){
                    if($uri === $url){
                        return [$uri => $controller];
                    }
                }
            }
        }

        
        if($methods === "POST"){
            if(in_array($url, $this->routesPost)){
                foreach($this->routesPost as $uri => $controller){
                    if($uri === $url){
                        return [$uri => $controller];
                    }
                }
            }
        }
    }


}