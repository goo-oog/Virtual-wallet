<?php
declare(strict_types=1);

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\WalletsController;
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

Route::view('/', 'welcome');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');

    Route::prefix('wallet')->group(function () {
        Route::get('{id}', [WalletsController::class, 'show']);
        Route::post('create', [WalletsController::class, 'create']);
        Route::patch('rename', [WalletsController::class, 'rename']);
        Route::delete('delete', [WalletsController::class, 'delete']);
        Route::prefix('show-form')->group(function () {
            Route::get('create', [WalletsController::class, 'showCreateForm']);
            Route::get('rename', [WalletsController::class, 'showRenameForm']);
            Route::get('delete', [WalletsController::class, 'showDeleteForm']);
        });
    });

    Route::prefix('transaction')->group(function () {
        Route::post('add', [TransactionsController::class, 'add']);
        Route::patch('fraudulent', [TransactionsController::class, 'toggleFraudulent']);
        Route::delete('delete', [TransactionsController::class, 'delete']);
        Route::prefix('show-form')->group(function () {
            Route::get('add', [TransactionsController::class, 'showAddForm']);
            Route::get('delete', [TransactionsController::class, 'showDeleteForm']);
        });
    });
});

require __DIR__ . '/auth.php';
