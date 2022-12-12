<?php

use Illuminate\Support\Facades\Route;

Route::prefix('tesrouting')->group(function(){
    Route::get('/', function () {
        echo "tes routing";
    });
});

