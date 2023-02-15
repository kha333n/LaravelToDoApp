<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
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

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    /*Route::get('/home', [HomeController::class, 'index']);*/
    Route::get('/home', function () {
        return redirect('/tasks');
    });
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::get('tasks/create', [TaskController::class, 'create']);
    Route::post('tasks/store', [TaskController::class, 'store']);
    Route::get('tasks/show/{id}', [TaskController::class, 'show']);
    Route::get('tasks/edit/{id}', [TaskController::class, 'edit']);
    Route::put('/tasks/update/{id}', [TaskController::class, 'update']);
    Route::put('/tasks/complete', [TaskController::class, 'complete']);
    Route::delete('/tasks/delete', [TaskController::class, 'destroy']);
});

/*Auth Controller*/
Route::get('/register', [AuthController::class, 'showRegistrationForm']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/', function () {
    return view('Welcome');
});
