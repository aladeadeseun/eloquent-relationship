<?php

use App\Util\RegisterUser;
use App\Util\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::get("/", function(){
    $user = new RegisterUser("", "");
    $validator = new Validator();
    $validator->validate($user);
    return response(["success"=>true, "message"=>"Hello world"]);
});