<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\WalletAuthorizeIdRequest;
use App\Http\Requests\WalletAuthorizeIdNameRequest;
use App\Models\Transaction;
use App\Models\Wallet;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WalletsController extends Controller
{
    public function show(WalletAuthorizeIdRequest $authorizeRequest): View
    {
        $id = $authorizeRequest->validated()['id'];
        return view('wallet', [
            'wallet' => Wallet::where('id', $id)->first(),
            'transactions' => Transaction::where('wallet_id', $id)->orderByDesc('created_at')->get(),
            'sumIncoming' => Transaction::where('amount', '>', 0)
                ->where('wallet_id', $id)->sum('amount'),
            'sumOutgoing' => Transaction::where('amount', '<', 0)
                ->where('wallet_id', $id)->sum('amount')
        ]);
    }

    public function showCreateForm(): View
    {
        return view('wallet-create');
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'max:32']
        ]);
        Wallet::create([
            'user_id' => Auth::id(),
            'name' => $request->input('name')
        ]);
        return redirect('/dashboard');
    }

    public function showRenameForm(WalletAuthorizeIdRequest $authorizeRequest): View
    {
        $id = $authorizeRequest->validated()['id'];
        return view('wallet-rename', ['wallet' => Wallet::find($id)]);
    }

    public function rename(WalletAuthorizeIdNameRequest $authorizeRequest): RedirectResponse
    {
        ['id' => $id, 'name' => $name] = $authorizeRequest->validated();
        Wallet::where(['id' => $id])->update(['name' => $name]);
        return redirect('/dashboard');
    }

    public function showDeleteForm(WalletAuthorizeIdRequest $authorizeRequest): View
    {
        $id = $authorizeRequest->validated()['id'];
        return view('wallet-delete', ['wallet' => Wallet::find($id)]);
    }

    public function delete(WalletAuthorizeIdRequest $authorizeRequest): RedirectResponse
    {
        $id = $authorizeRequest->validated()['id'];
        Wallet::where(['id' => $id])->delete();
        return redirect('/dashboard');
    }
}
