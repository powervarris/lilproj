<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use App\Http\Controllers\UserController;


//-------------------------------------------------
//SAMPLE ONLY!
//-------------------------------------------------

// Route::get('/user', function () {
//     return dd('hello user');
// });

// Route::get('/user/{name}', function ($name) {
//     return dd('hello ' .$name);
// });

// Route::get('/about', function () {
//     return dd('About Page');
// });

// Route::get('/contact', function () {
//     return dd('Contact Page');
// });

// Route::get('/user/random/random/random', function (){
//     return dd('user');
// })->name('user');



//-------------------------------------------------
//VIEWS ROUTE
//-------------------------------------------------
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/categories', function () {
    return view('categories');
})->name('categories');

Route::get('/faqs', function () {
    return view('faqs');
})->name('faqs');

Route::get('/eventsgeneral', function () {
    return view('eventsgeneral');
})->name('eventsgeneral');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        // $users = User::all();
        // return view('dashboard', compact('users'));
         return view('dashboard');
    })->name('dashboard');
    Route::get('/events', function () {
        return view('events');
    })->name('events');
    Route::get('/createevent', function () {
        return view('createevent');
    })->name('createevent');

    Route::get('admin/profile', function () {
        return dd('admin profile page');
    })->name('adminprofile');
});

                    //name of the class
Route::get('/user',[UserController::class,'index']);
Route::get('/createStudent',[UserController::class,'create']);

Route::get('/blogs',[UserController::class,'index']);
Route::get('/blogs-create',[UserController::class,'create'])->middleware(AdminMiddleware::class);
Route::get('/blogs-ucreate', [UserController::class, 'userCreate']);
Route::get('/blogs/{id}', [UserController::class, 'show'])->middleware(UserMiddleware::class);
Route::post('/blogs', [UserController::class, 'store']);
Route::get('/blogs/{id}/edit', [UserController::class, 'edit'])->middleware(AdminMiddleware::class);
Route::put('/blogs/{id}', [UserController::class, 'update']);

