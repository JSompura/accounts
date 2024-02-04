@extends('layouts.app')
@section('content')
<header class="flex item-center mb-3 py-4">
    <div class="flex justify-between items-end w-full">
            <h2 class="text-gray-400 text-normal">
                <a href="/transactions" class="hover:underline">Transaction</a> / {{ $transaction->description }}
            </h2>
        <a href="/transactions/create"><p class="button">New transaction</p></a>
    </div>
</header>
<main>
    <div class="">
        <div class="px-4 py-2"> Date: <p class="font-bold">{{$transaction->date}}</p></div>
        <div class="px-4 py-2"> Account name: <p class="font-bold">{{$transaction->account->name}}</p></div>
        <div class="px-4 py-2"> Category name: <p class="font-bold">{{$transaction->category->name}}</p></div>
        <div class="px-4 py-2"> Amount: <p class="font-bold">{{$transaction->amount}}</p></div>
        <div class="px-4 py-2"> Description: <p class="font-bold">{{$transaction->description}}</p></div>
    </div>
</main>

@endsection
