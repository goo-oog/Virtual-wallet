<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-gray-800 text-xl leading-tight">
            Delete transaction
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="post" action="/transaction-delete">
                        @csrf
                        <input type="hidden" name="id" value="{{$transaction->id}}">
                        <input type="hidden" name="wallet_id" value="{{$wallet->id}}">
                        <p>Delete transaction <span
                                    class="font-bold text-red-700">{{$transaction->description}}</span> {{sprintf('(%0.2f €)',$transaction->amount/100)}}
                            created {{$transaction->created_at->format('d.m.Y H:i')}}?</p>
                        <br>
                        <input type="submit" value="Delete"
                               class="w-24 h-8 bg-white text-base hover:border-red-500 hover:text-red-500 px-2 border rounded border-gray-400">
                        <a href="/wallet?id={{$wallet->id}}"> or cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
