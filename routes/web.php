<?php

use Illuminate\Support\Facades\Route;

Route::get('/navbar', function () {
    return view('navbar');
});

Route::get('/footer', function () {
    return view('footer');
});git