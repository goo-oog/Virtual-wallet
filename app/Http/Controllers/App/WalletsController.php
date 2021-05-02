<?php
declare(strict_types=1);

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Wallet;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class WalletsController extends Controller
{
    public function show(Request $request): View
    {
        $request->validate([
            'id' => ['required', Rule::exists('wallets')->where('user_id', Auth::id())]
        ]);
        return view('wallet', [
            'wallet' => Wallet::where('id', $request->input('id'))->first(),
            'transactions' => Transaction::where('wallet_id', $request->input('id'))->get(),
            'sumIncoming' => Transaction::where('amount', '>', 0)
                ->where('wallet_id', $request->input('id'))->sum('amount'),
            'sumOutgoing' => Transaction::where('amount', '<', 0)
                ->where('wallet_id', $request->input('id'))->sum('amount')
        ]);
    }

    public function showCreateForm(): View
    {
        return view('wallet-create');
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'max:255']
        ]);
        Wallet::create([
            'user_id' => Auth::id(),
            'name' => $request->input('name')
        ]);
        return redirect('/dashboard');
    }

    public function showRenameForm(Request $request): View
    {
        $request->validate([
            'id' => ['required', Rule::exists('wallets')->where('user_id', Auth::id())]
        ]);
        return view('wallet-rename', ['wallet' => Wallet::find($request->input('id'))]);
    }

    public function rename(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => ['required', Rule::exists('wallets')->where('user_id', Auth::id())],
            'name' => ['required', 'max:255']
        ]);
        Wallet::where(['id' => $request->input('id')])
            ->update(['name' => $request->input('name')]);
        return redirect('/dashboard');
    }

    public function showDeleteForm(Request $request): View
    {
        $request->validate([
            'id' => ['required', Rule::exists('wallets')->where('user_id', Auth::id())]
        ]);
        return view('wallet-delete', ['wallet' => Wallet::find($request->input('id'))]);
    }

    public function delete(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => ['required', Rule::exists('wallets')->where('user_id', Auth::id())]
        ]);
        Wallet::where(['id' => $request->input('id')])->delete();
        return redirect('/dashboard');
    }
}
