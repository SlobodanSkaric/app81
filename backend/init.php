<?php

if(session_status() === PHP_SESSION_NONE){
    session_start();
}   

ini_set("session.gc_maxlifetime", 3600);
session_set_cookie_params(3600);

define("ABSOLUTE_PATH", $_SERVER["DOCUMENT_ROOT"]."/inco81/");
define("ENV_FAJL", ABSOLUTE_PATH."config/.env");
define("BASE", "http://localhost/inco81/");






