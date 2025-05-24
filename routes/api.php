<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Course;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/courses/occupied-times', function (Request $request) {
    $date = $request->get('date');
    $masterId = $request->get('master_id');
    $occupied = Course::where('start_date', $date)->where('master', $masterId)->pluck('event_time');
    return response()->json(['occupied' => $occupied]);
});