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
                    <p>Your virtual wallets</p>
                    <br>
                    <form method="post" action="/wallet-create">
                        @csrf
                        <input type="text" name="name">
                        <input type="submit" value="Create new wallet">
                    </form>
                    <table>
                        @foreach($wallets as $wallet)
                            <tr>
                                <td>
                                    <form method="post" action="/wallet-delete">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$wallet->id}}">
                                        <input type="submit" value="Delete">
                                    </form>
                                </td>
                                <td><a href="/wallet?id={{$wallet->id}}">{{$wallet->name}}</a></td>
                                <td>
                                    <form method="post" action="/wallet-rename">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$wallet->id}}">
                                        <input type="text" name="name">
                                        <input type="submit" value="Rename">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
