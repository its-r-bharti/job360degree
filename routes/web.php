<?php
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

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


// Route::get('/',[HomeController::class,'index'])->name('home');
// Route::get('/', function() {
//     return view('component.home');
// });
// Route::get('/account/register', function() {
//     return view('/account.registration');
// });
// Route::get('/contact', function() {
//     return view('component.layout.contact');
// });
// Route::get('/register', function() {
//     return view('component.account.registration');
// });
// Route::get('/account/registration', function() {
//     return view('component.component.registration');
// });
Route::get('/', [HomeController::class, 'index'])->name('component.home');

// Route::get('/', [HomeController::class, 'job'])->name('component.findjob');


Route::group(['account'], function(){

    //guest Route
        Route::group(['middleware' =>'guest'], function(){
            Route::get('/account/register', [AccountController::class, 'registration'])->name('account.registration');
            Route::post('/account/process-register', [AccountController::class, 'processRegistration'])->name('account.processRegistration');
            Route::get('/account/login', [AccountController::class, 'login'])->name('account.login');
            Route::post('/account/authenticate', [AccountController::class, 'authenticate'])->name('account.authenticate');

        });
    //authorized Route
    Route::group(['middleware' =>'auth'], function(){
        Route::get('/account/profile', [AccountController::class, 'profile'])->name('account.profile');
        Route::get('/account/logout', [AccountController::class, 'logout'])->name('account.logout');
        
    });

});