<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
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
        $user = User::find(Auth::id());
        return view('dashboard', [
            'wallets' => $user->wallets()->get(),
            'transactions' => Transaction::all()
        ]);
    }
}
