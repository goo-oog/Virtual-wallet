<x-app-layout>
    <x-slot name="header">
        <div class="sm:flex sm:justify-start sm:flex-nowrap sm:space-x-16 xs:space-y-4 sm:space-y-0 items-end font-semibold text-xl leading-tight">
            <h2 class="text-gray-800">
                <span class="text-base font-normal mr-2">Wallet:</span>
                {{$wallet->name}}
            </h2>
            <p>
                <span class="text-base font-normal mr-2 whitespace-nowrap">Balance:</span>
                <span class="{{$sumIncoming+$sumOutgoing>=0?'text-green-500':'text-red-500'}}">
                    {{sprintf('%0.2f €',($sumIncoming+$sumOutgoing)/100)}}</span>
            </p>
            <form method="get" action="/transaction/show-form/add">
                @csrf
                <input type="hidden" name="wallet_id" value="{{$wallet->id}}">
                <input type="submit" value="Add transaction"
                       class="bg-white text-base hover:border-blue-500 hover:text-blue-500 px-2 border rounded border-gray-400">
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="space-y-12 p-6 bg-white border-b border-gray-200">
                    <div>
                        <div class="flex justify-between font-semibold text-xl pb-3">
                            <h2 class="text-gray-800">Incoming transactions</h2>
                            <h2 class="text-green-500 whitespace-nowrap">{{sprintf('%0.2f €',$sumIncoming/100)}}</h2>
                        </div>
                        @foreach($transactions as $transaction)
                            @if($transaction->amount>0)
                                @include('components.transactions-list')
                            @endif
                        @endforeach
                    </div>
                    <div>
                        <div class="flex justify-between font-semibold text-xl pb-3">
                            <h2 class="text-gray-800">Outgoing transactions</h2>
                            <h2 class="text-red-500 whitespace-nowrap">{{sprintf('%0.2f €',$sumOutgoing/100)}}</h2>
                        </div>
                        @foreach($transactions as $transaction)
                            @if($transaction->amount<0)
                                @include('components.transactions-list')
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
