<?php

use Illuminate\Support\Facades\Route;

Route::prefix('belekok')->group(function(){
    Route::get('/', function () {
        return ["message"=>"belekok"];
    });
});

