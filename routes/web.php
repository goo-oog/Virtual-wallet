<?php
declare(strict_types=1);

use App\Http\Controllers\App\HomeController;
use App\Http\Controllers\App\TransactionsController;
use App\Http\Controllers\App\WalletsController;
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

Route::get('/', [HomeController::class, 'home']);

Route::get('/dashboard', [HomeController::class, 'dashboard'])
    ->middleware(['auth'])->name('dashboard');

Route::get('/wallet', [WalletsController::class, 'show'])
    ->middleware(['auth']);

Route::post('/wallet-create', [WalletsController::class, 'create'])
    ->middleware(['auth']);

Route::post('/wallet-rename', [WalletsController::class, 'rename'])
    ->middleware(['auth']);

Route::post('/wallet-delete', [WalletsController::class, 'delete'])
    ->middleware(['auth']);

Route::post('/transaction-add', [TransactionsController::class, 'add'])
    ->middleware(['auth']);

Route::post('/transaction-fraudulent', [TransactionsController::class, 'toggleFraudulent'])
    ->middleware(['auth']);

Route::post('/transaction-delete', [TransactionsController::class, 'delete'])
    ->middleware(['auth']);

require __DIR__ . '/auth.php';
