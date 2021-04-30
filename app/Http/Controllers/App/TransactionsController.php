<?php
declare(strict_types=1);

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TransactionsController extends Controller
{
    public function add(Request $request): RedirectResponse
    {
        $request->merge(['amount' => str_replace(',', '.', $request->input('amount'))]);
        $request->validate([
            'wallet_id' => ['required', Rule::exists('wallets', 'id')->where('user_id', Auth::id())],
            'description' => ['required', 'max:255'],
            'amount' => ['required', 'numeric']
        ]);
        Transaction::create([
            'wallet_id' => $request->input('wallet_id'),
            'description' => $request->input('description'),
            'amount' => $request->input('amount') * 100
        ]);
        return redirect('/wallet?id=' . $request->input('wallet_id'));
    }

    public function toggleFraudulent(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => ['required', Rule::exists('transactions')->where('wallet_id', $request->input('wallet_id'))],
            'wallet_id' => ['required', Rule::exists('wallets', 'id')->where('user_id', Auth::id())]
        ]);
        $transaction = Transaction::where(['id' => $request->input('id')])->firstOrFail();
        $transaction->update(['is_fraudulent' => !$transaction->is_fraudulent]);
        return redirect('/wallet?id=' . $transaction->wallet_id);
    }

    public function delete(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => ['required', Rule::exists('transactions')->where('wallet_id', $request->input('wallet_id'))],
            'wallet_id' => ['required', Rule::exists('wallets', 'id')->where('user_id', Auth::id())]
        ]);
        $transaction = Transaction::where(['id' => $request->input('id')])->firstOrFail();
        $transaction->delete();
        return redirect('/wallet?id=' . $transaction->wallet_id);
    }
}