<?php
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Show forms
Route::get('/register', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
});

// Submit forms
Route::post('/register', [LoginController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

// Dashboards (RBAC test)
Route::get('/employee-dashboard', function () {
    return "Employee Dashboard";
})->middleware('role:employee');

Route::get('/dealer-dashboard', function () {
    return "Dealer Dashboard";
})->middleware('role:dealer');