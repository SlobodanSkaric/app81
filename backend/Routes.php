<?php

//use App\Core\Route;


 return [
    \App\Core\Route::post("|admin/register|", "Adminstrator", "adminRegistration", "any"),
    \App\Core\Route::post("|admin/login|", "Adminstrator", "adminLogin", "any"),
    \App\Core\Route::get("|admin/([0-9]+)/?|", "Adminstrator", "getAdminById", "admin"),

    \App\Core\Route::post("|user/login|", "User", "userLogin", "any"),
    \App\Core\Route::post("|user/register|", "User", "userRegistration", "any"),
    \App\Core\Route::get("|user/([0-9]+)/?|", "User", "getUserById", "user"),
    \App\Core\Route::get("|user/([0-9]+)/edit|", "User", "edit","user"),
    


    \App\Core\Route::get("|^.*$|", "Home", "index", "any")
];