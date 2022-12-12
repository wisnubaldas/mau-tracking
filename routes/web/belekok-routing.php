<?php

use Illuminate\Support\Facades\Route;

Route::prefix('belekok-routing')->group(function(){
    Route::get('/', function () {
        return ['message'=>"belekok-routing"];
    });
});

