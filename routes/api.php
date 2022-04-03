<?php

use App\Http\Controllers\EmployeeController;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Får alle employees og kalder all() fra employee controlleren
Route::get('/employees', [EmployeeController::class, 'all']);

//Opretter en employee med create() fra employee controlleren
Route::post('/employee',  [EmployeeController::class, 'create']);
