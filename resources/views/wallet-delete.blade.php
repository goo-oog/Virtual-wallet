<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-gray-800 text-xl leading-tight">
            Delete wallet
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="post" action="/wallet/delete">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="id" value="{{$wallet->id}}">
                        <p>Delete wallet <span class="font-bold text-red-700">{{$wallet->name}}</span> ?</p>
                        <br>
                        <input type="submit" value="Delete"
                               class="w-24 h-8 bg-white text-base hover:border-red-500 hover:text-red-500 px-2 border rounded border-gray-400">
                        <a href="/dashboard"> or cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
