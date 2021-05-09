<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Shows the list of user wallets
     */
    public function show(): View
    {
        $user = User::find(Auth::id());
        return view('dashboard', [
            'wallets' => $user->wallets()->get()
        ]);
    }
}
