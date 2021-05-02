<?php
declare(strict_types=1);

use App\Http\Controllers\App\AppController;
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

Route::get('/', [AppController::class, 'home']);

Route::get('/dashboard', [AppController::class, 'dashboard'])
    ->middleware(['auth'])->name('dashboard');

Route::get('/wallet', [WalletsController::class, 'show'])
    ->middleware(['auth']);

Route::get('/wallet-create', [WalletsController::class, 'showCreateForm'])
    ->middleware(['auth']);

Route::post('/wallet-create', [WalletsController::class, 'create'])
    ->middleware(['auth']);

Route::get('/wallet-rename', [WalletsController::class, 'showRenameForm'])
    ->middleware(['auth']);

Route::post('/wallet-rename', [WalletsController::class, 'rename'])
    ->middleware(['auth']);

Route::get('/wallet-delete', [WalletsController::class, 'showDeleteForm'])
    ->middleware(['auth']);

Route::post('/wallet-delete', [WalletsController::class, 'delete'])
    ->middleware(['auth']);

Route::get('/transaction-add', [TransactionsController::class, 'showAddForm'])
    ->middleware(['auth']);

Route::post('/transaction-add', [TransactionsController::class, 'add'])
    ->middleware(['auth']);

Route::post('/transaction-fraudulent', [TransactionsController::class, 'toggleFraudulent'])
    ->middleware(['auth']);

Route::get('/transaction-delete', [TransactionsController::class, 'showDeleteForm'])
    ->middleware(['auth']);

Route::post('/transaction-delete', [TransactionsController::class, 'delete'])
    ->middleware(['auth']);

require __DIR__ . '/auth.php';
