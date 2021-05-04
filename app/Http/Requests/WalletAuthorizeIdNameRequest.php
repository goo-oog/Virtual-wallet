<?php
declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Wallet;
use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class WalletAuthorizeIdNameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        if (Wallet::where('id', $request->input('id'))
            ->where('user_id', Auth::id())->exists()) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required',
            'name' => 'required', 'max:32'
        ];
    }
}
