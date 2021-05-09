<?php
declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletAuthorizeIdRequest extends FormRequest
{
    /**
     * Determine if the user owns the wallet with this id
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        $user = User::find(Auth::id());
        $wallet = $user->wallets()->findOrFail($request->input('id'));
        return $wallet->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required'
        ];
    }
}
