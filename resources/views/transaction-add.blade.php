<x-app-layout>
    <x-slot name="header">
        <div class="flex xs:space-x-8 sm:space-x-16 font-semibold text-xl leading-tight">
            <h2 class="text-gray-800">
                Add transaction
            </h2>
            <h2 class="text-gray-800">
                <span class="text-base font-normal mr-2">to wallet:</span>
                {{$wallet->name}}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="post" action="/transaction-add">
                        @csrf
                        <input type="hidden" name="wallet_id" value="{{$wallet->id}}">
                        <label for="description" class="mr-2">Description:</label><br>
                        <input type="text" id="description" name="description"
                               class="h-8 xs:w-full sm:w-96 border rounded border-gray-400 mb-8">
                        <br>
                        <label for="amount" class="mr-2">Amount:</label><br>
                        <input type="text" id="amount" name="amount"
                               class="h-8 xs:w-1/2 sm:w-48 border rounded border-gray-400"
                               maxlength="12" pattern="[-]?[0-9]+([\.,][0-9]{1,2})?">
                        <span class="font-semibold text-xl"> €</span>
                        <p class="text-sm mb-8">positive number for incoming<br>negative number for outgoing</p>
                        <input type="submit" value="Add transaction"
                               class="w-48 h-8 bg-white text-base hover:border-blue-500 hover:text-blue-500 px-2 border rounded border-gray-400">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
