<?php

use Illuminate\Support\Facades\Route;

Route::prefix('tes')->group(function(){
    Route::get('/', function () {
        return ["message"=>"tes"];
    });
});

