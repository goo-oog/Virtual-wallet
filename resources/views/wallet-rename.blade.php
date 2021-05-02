<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-gray-800 text-xl leading-tight">
            Rename wallet
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="post" action="/wallet-rename">
                        @csrf
                        <input type="hidden" name="id" value="{{$wallet->id}}">
                        <label for="name">Rename wallet <span class="font-bold text-blue-600">{{$wallet->name}}</span>
                            to:</label>
                        <br>
                        <input type="text" id="name" name="name" class="h-8 w-48 border rounded border-gray-400 mb-4">
                        <br>
                        <input type="submit" value="Rename"
                               class="w-24 h-8 bg-white text-base hover:border-blue-500 hover:text-blue-500 px-2 border rounded border-gray-400">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
