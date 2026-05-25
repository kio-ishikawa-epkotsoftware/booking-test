<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SortableController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BookingController;

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

Route::get('/sortable', [SortableController::class, 'index']);
Route::post('/sortable/register', [SortableController::class, 'register']);
Route::post('/sortable/update', [SortableController::class, 'update']);
Route::get('/task', [TaskController::class, 'index']);
Route::post('/task/register', [TaskController::class, 'register']);
Route::post('/task/delete', [TaskController::class, 'delete']);

// デフォルトルート
Route::get('/', fn () => redirect()->route('login'));

// ログイン画面
Route::middleware(['guest', 'prevent-back-history'])->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});




// 認証済みユーザーのみアクセス
Route::middleware('auth')->group(function () {
    // ダッシュボード
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 予約機能
    Route::prefix('booking')->name('booking.')->group(function () {

        // 一覧
        Route::get('/', [BookingController::class, 'index'])
            ->name('index');

        // 登録画面
        Route::get('/register', [BookingController::class, 'create'])
            ->name('register');

        // 登録処理
        Route::post('/register', [BookingController::class, 'store'])
            ->name('store');

        // 削除
        Route::delete('/{booking}', [BookingController::class, 'destroy'])
            ->name('destroy');
    });

    // ログアウト
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');


    // 管理者向け：
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('users', AdminUserController::class)->only(['index','create','store','edit','update','destroy']);
    });
});