<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TransactionsController extends Controller
{
    /**
     * Shows form to add a new transaction
     */
    public function showAddForm(Request $request): View
    {
        $request->validate([
            'wallet_id' => ['required', Rule::exists('wallets', 'id')->where('user_id', Auth::id())]
        ]);
        return view('transaction-add', [
            'wallet' => Wallet::find($request->input('wallet_id')),
        ]);
    }

    /**
     * Adds a new transaction
     */
    public function add(Request $request): RedirectResponse
    {
        $request->merge(['amount' => str_replace(',', '.', $request->input('amount'))]);
        $request->validate([
            'wallet_id' => ['required', Rule::exists('wallets', 'id')->where('user_id', Auth::id())],
            'description' => ['required', 'max:64'],
            'amount' => ['required', 'numeric', 'not_in:0']
        ]);
        Transaction::create([
            'wallet_id' => $request->input('wallet_id'),
            'description' => $request->input('description'),
            'amount' => $request->input('amount') * 100
        ]);
        return redirect('/wallet/' . $request->input('wallet_id'));
    }

    /**
     * Marks a transaction as fraudulent or safe
     */
    public function toggleFraudulent(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => ['required', Rule::exists('transactions')->where('wallet_id', $request->input('wallet_id'))],
            'wallet_id' => ['required', Rule::exists('wallets', 'id')->where('user_id', Auth::id())]
        ]);
        $transaction = Transaction::find($request->input('id'));
        $transaction->update(['is_fraudulent' => !$transaction->is_fraudulent]);
        return redirect('/wallet/' . $transaction->wallet_id);
    }

    /**
     * Shows form to delete a transaction
     */
    public function showDeleteForm(Request $request): View
    {
        $request->validate([
            'id' => ['required', Rule::exists('transactions')->where('wallet_id', $request->input('wallet_id'))],
            'wallet_id' => ['required', Rule::exists('wallets', 'id')->where('user_id', Auth::id())]
        ]);
        return view('transaction-delete', [
            'transaction' => Transaction::find($request->input('id')),
            'wallet' => Wallet::find($request->input('wallet_id'))
        ]);
    }

    /**
     * Deletes a transaction
     */
    public function delete(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => ['required', Rule::exists('transactions')->where('wallet_id', $request->input('wallet_id'))],
            'wallet_id' => ['required', Rule::exists('wallets', 'id')->where('user_id', Auth::id())]
        ]);
        $transaction = Transaction::find($request->input('id'));
        $transaction->delete();
        return redirect('/wallet/' . $transaction->wallet_id);
    }
}
