<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p>Wallet: {{$wallet->name}}</p>
                    <br>
                    <form method="post" action="/transaction-add">
                        @csrf
                        <input type="hidden" name="wallet_id" value="{{$wallet->id}}">
                        <input type="text" name="description">
                        <input type="text" name="amount" maxlength="12" pattern="[-]?[0-9]+([\.,][0-9]{1,2})?">
                        <input type="submit" value="Add transaction">
                    </form>
                    <table>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>
                                    <form method="post" action="/transaction-delete">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$transaction->id}}">
                                        <input type="hidden" name="wallet_id" value="{{$transaction->wallet_id}}">
                                        <input type="submit" value="Delete">
                                    </form>
                                </td>
                                <td>{{$transaction->description}}</td>
                                <td class="text-right">{{sprintf('%0.2f €',$transaction->amount/100)}}</td>
                                <td>{{$transaction->is_fraudulent?'Fraudulent':'OK'}}</td>
                                <td>
                                    <form method="post" action="/transaction-fraudulent">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$transaction->id}}">
                                        <input type="hidden" name="wallet_id" value="{{$transaction->wallet_id}}">
                                        <input type="submit" value="Fraudulent">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <p>Sum incoming {{sprintf('%0.2f €',$sumIncoming/100)}}</p>
                    <p>Sum outgoing {{sprintf('%0.2f €',$sumOutgoing/100)}}</p>
                    <p>Grand total {{sprintf('%0.2f €',($sumIncoming+$sumOutgoing)/100)}}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
