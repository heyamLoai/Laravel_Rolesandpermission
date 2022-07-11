<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Middleware\AgeCheck;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//Route::view('/', 'cms.parent');


Route::prefix('cms/admin')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('cms.login');
    Route::post('login', [AuthController::class, 'login']);
});

// Route::prefix('cms/admin')->group(function () {
//     Route::view('/', 'cms.temp');
//     Route::resource('cities', CityController::class);
//     Route::resource('admins', AdminController::class);

//  });

 Route::prefix('cms/admin')->middleware('auth:admin')->group(function () {
    Route::view('/', 'cms.temp');
    Route::resource('cities', CityController::class);
    Route::resource('admins', AdminController::class);

 });
 
 

// //without middleware
// Route::get('news', function () {
//     echo "This is the new tittle ";
// });

/*************************************/

// Route::get('news', function () {
//     echo "This is the new tittle ";
// })->middleware('age.Check');

/*************************************/

// Route::middleware('age.Check')->get('news', function () {
//     echo "This is the new tittle ";
// });

/*************************************/

// Route::get('news', function () {
//     echo "This is the new tittle ";
// })->middleware(AgeCheck::class);

/*************************************/

// تعريف ال ميدل وير على مستوى مجموعة من الراوتس

// Route::middleware('age.Check')->group(function(){
//     Route::get('news', function () {
//         echo "This is the new tittle ";
//     });    
//     Route::get('news-2', function () {
//         echo "This is the new-2 tittle ";
//     })->withoutMiddleware('age.check'); 
// });

/********************************/

Route::middleware('age.Check:18')->get('news', function () {
    echo "This is the new tittle ";
});
