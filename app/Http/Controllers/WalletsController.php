<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\WalletAuthorizeIdRequest;
use App\Http\Requests\WalletAuthorizeIdNameRequest;
use App\Http\Requests\WalletAuthorizeIdRoute;
use App\Models\Wallet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class WalletsController extends Controller
{
    /**
     * Shows the list of all transactions of the current wallet
     */
    public function show(WalletAuthorizeIdRoute $authorizeRoute): View
    {
        $wallet = Wallet::find($authorizeRoute->route('id'));
        return view('wallet', [
            'wallet' => $wallet,
            'transactions' => $wallet->transactions()->orderByDesc('created_at')->get(),
            'sumIncoming' => $wallet->transactions()->where('amount', '>', 0)->sum('amount'),
            'sumOutgoing' => $wallet->transactions()->where('amount', '<', 0)->sum('amount')
        ]);
    }

    /**
     * Shows form to add a new wallet
     */
    public function showCreateForm(): View
    {
        return view('wallet-create');
    }

    /**
     * Creates a new wallet
     */
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

    /**
     * Shows form to rename a wallet
     */
    public function showRenameForm(WalletAuthorizeIdRequest $authorizeRequest): View
    {
        $id = $authorizeRequest->validated()['id'];
        return view('wallet-rename', ['wallet' => Wallet::find($id)]);
    }

    /**
     * Renames a wallet
     */
    public function rename(WalletAuthorizeIdNameRequest $authorizeRequest): RedirectResponse
    {
        ['id' => $id, 'name' => $name] = $authorizeRequest->validated();
        $wallet = Wallet::find($id);
        $wallet->update(['name' => $name]);
        return redirect('/dashboard');
    }

    /**
     * Shows form to delete a wallet
     */
    public function showDeleteForm(WalletAuthorizeIdRequest $authorizeRequest): View
    {
        $id = $authorizeRequest->validated()['id'];
        return view('wallet-delete', ['wallet' => Wallet::find($id)]);
    }

    /**
     * Deletes a wallet and all transactions associated with it
     */
    public function delete(WalletAuthorizeIdRequest $authorizeRequest): RedirectResponse
    {
        $id = $authorizeRequest->validated()['id'];
        $wallet = Wallet::find($id);
        $wallet->transactions()->delete();
        $wallet->delete();
        return redirect('/dashboard');
    }
}
