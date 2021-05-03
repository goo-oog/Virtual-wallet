<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Virtual Wallet</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="antialiased">
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-36 sm:pt-0">
    @if (Route::has('login'))
        <div class="fixed top-0 right-0 px-6 py-4 block">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="max-w-lg mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-center pt-8 sm:pt-0">
            <x-application-logo class="block h-10 w-auto fill-current text-gray-600"/>
        </div>
        <div style="color: #ff9037" class="text-center text-3xl font-semibold mt-8">
            <span style="color: #ff4b37">V</span>irtual <span style="color: #ff4b37">W</span>allet
        </div>
        <div class="mt-16 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-6">
            <div class="mt-2 text-gray-600 text-justify dark:text-gray-400 text-sm">
                Manage virtual wallets, view balance by transaction type, add and handle transactions. Application
                features full scale authentication powered by Laravel Breeze. And, of course, created with Laravel.
            </div>
        </div>
    </div>
</div>
</body>
</html>
