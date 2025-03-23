<?php

//use App\Core\Route;


 return [
    \App\Core\Route::post("|admin/register|", "Adminstrator", "adminRegistration"),
    \App\Core\Route::post("|admin/login|", "Adminstrator", "adminLogin"),
    \App\Core\Route::get("|admin/([0-9]+)/?|", "Adminstrator", "getAdminById"),

    \App\Core\Route::post("|user/login|", "User", "userLogin"),
    \App\Core\Route::post("|user/register|", "User", "userRegistration"),
    \App\Core\Route::get("|user/([0-9]+)/?|", "User", "getUserById"),
    \App\Core\Route::get("|user/([0-9]+)/edit|", "User", "edit"),
    \App\Core\Route::get("|^.*$|", "Home", "index"),


    \App\Core\Route::get("|^.*$|", "Home", "index")
];