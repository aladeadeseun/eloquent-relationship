<?php

use App\Models\Role;
use App\Util\RegisterUser;
use App\Util\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Image;
use App\Models\Post;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::get("/", function(){
    // $user = new RegisterUser("", "");
    // $validator = new Validator();
    // $validator->validate($user);
    return response(["success"=>true, "message"=>"Hello world"]);
});

Route::get("/many-to-many", function(){
    
    return response()->json([
        "success"=>true,
        /**
         * ->with(["users.posts"])->get()
         */
        //"data"=>Role::with(["users", "users.posts"])->where("id", 2)->get()
        // "data" => Role::with(['users' => function ($query) {
        //     $query->has('posts'); // Only fetch users that have at least one post
        // }, 'users.posts' => function ($query) {
        //     $query->latest()->limit(1); // Only get the 5 most recent posts per user
        // }])->find(2)
        //"data"=>Role::whereHas('users.posts')->with('users.posts')->where("id", 2)->get()
    ]);
});

Route::get("/one-to-one-polymorphic", function(){
    return response()->json([
        "success"=>true, 
        "data"=>Image::find(1, "*")->imageable
        //"data"=>Post::find(7, "*")->image
    ]);
});