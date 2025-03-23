<?php 
namespace App\Controllers; 
session_start();
class HomeController extends Controller{
    


   
   
    public function index(){
        $this->set('message', 'Hello world!');
    } 
}