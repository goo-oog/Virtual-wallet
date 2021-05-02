<?php
declare(strict_types=1);

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Wallet;
use Auth;
use Illuminate\View\View;

class AppController extends Controller
{
    public function home(): View
    {
        return view('welcome');
    }

    public function dashboard(): View
    {
        return view('dashboard', [
            'wallets' => Wallet::where(['user_id' => Auth::id()])->get(),
            'transactions' => Transaction::all()
        ]);
    }
}
