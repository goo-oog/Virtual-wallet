<x-app-layout>
    <x-slot name="header">
        <div class="sm:flex sm:justify-start sm:flex-nowrap sm:space-x-16 xs:space-y-4 sm:space-y-0 items-end font-semibold text-xl leading-tight">
            <h2 class="text-gray-800">
                {{ __('Dashboard') }}
            </h2>
            <form method="get" action="/wallet/show-form/create">
                @csrf
                <input type="submit" value="Create new wallet"
                       class="bg-white text-base hover:border-blue-500 hover:text-blue-500 px-2 border rounded border-gray-400">
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-gray-800 font-semibold text-xl pb-3">Virtual wallets</h2>
                    @foreach($wallets as $wallet)
                        <div class="border-t border-gray-400 pb-3 hover:bg-yellow-50">
                            <a href="/wallet/{{$wallet->id}}">
                                <div class="flex p-2 space-x-4 xs:flex-wrap sm:flex-nowrap xs:justify-end sm:justify-between">
                                    <p class="xs:w-full sm:w-96">{{$wallet->name}}</p>
                                    <div class="flex space-x-4 items-end">
                                        <p class="w-32 text-right
                                    {{$wallet->transactions()->sum('amount')>=0?'text-green-500':'text-red-500'}}">
                                            {{sprintf('%0.2f €',$wallet->transactions()->sum('amount')/100)}}
                                        </p>
                                        <form method="get" action="/wallet/show-form/rename">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$wallet->id}}">
                                            <input type="submit" value="Rename"
                                                   class="text-sm hover:border-blue-500 hover:text-blue-500 px-2 bg-transparent border rounded border-gray-400">
                                        </form>
                                        <form method="get" action="/wallet/show-form/delete">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$wallet->id}}">
                                            <input type="submit" value="Delete"
                                                   class="text-sm hover:border-red-500 hover:text-red-500 px-2 bg-transparent border rounded border-gray-400">
                                        </form>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
