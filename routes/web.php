<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AgeCheck;
use App\Mail\AdminWelcomeEmail;
use Illuminate\Routing\Route as RoutingRoute;
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

//multi auth
Route::prefix('cms')->middleware('guest:admin')->group(function () {
    Route::get('{guard}/login', [AuthController::class, 'showLogin'])->name('cms.login');
    Route::post('login', [AuthController::class, 'login']);
});

Route::prefix('email')->middleware('auth:admin,user')->group(function () {
  Route::get('verify', [EmailVerificationController::class, 'notice'])->name('verification.notice');
  Route::get('verification-notification',[EmailVerificationController::class, 'send'])->name('verification.send');
  Route::get('verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify');

});

//single auth
Route::prefix('cms/admin')->middleware('guest:admin')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('cms.login');
    Route::post('login', [AuthController::class, 'login']);
});


 
// Route::prefix('cms/admin')->group(function () {
//     Route::view('/', 'cms.temp');
//     Route::resource('cities', CityController::class);
//     Route::resource('admins', AdminController::class);

//  }); 

 Route::prefix('cms/admin')->middleware(['auth:admin,user','verified'])->group(function () {
    Route::view('/', 'cms.temp')->name('cms.dashboard');
    Route::resource('cities', CityController::class);
    Route::resource('admins', AdminController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('sub-categories', SubCategoryController::class);
    Route::resource('tasks', TaskController::class);


    Route::get('edit-password',[AuthController::class, 'editPassword'])->name('cms.edit-password');
    Route::put('edit-password',[AuthController::class, 'updatePassword']);

    Route::get('logout',[AuthController::class, 'logout'])->name('cms.logout');

 });
 Route::prefix('cms/admin')->middleware(['auth:admin','verified'])->group(function () { 
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('users', UserController::class);


    Route::get('roles/{role}/permissions',[RoleController::class,'editRolePermissions'])->name('role.edit-permissions');
    Route::put('roles/{role}/permissions',[RoleController::class,'updateRolePermissions']);

    Route::get('users/{user}/permissions',[UserController::class,'editPermissions'])->name('user.edit-permissions');
    Route::put('users/{user}/permissions',[UserController::class,'updatePermissions']);

 });

    // Route::get('test-email', function (){
    //     return new AdminWelcomeEmail();
    // });

 

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

// Route::middleware('age.Check:18')->get('news', function () {
//     echo "This is the new tittle ";
// });