<?php

//use App\Core\Route;


 return [
    \App\Core\Route::get("|user/([0-9]+)/?|", "User", "getUserById"),
    \App\Core\Route::get("|user/([0-9]+)/edit|", "User", "edit"),
    \App\Core\Route::get("|^.*$|", "Home", "index"),
];