@extends('layouts.app')
@section('content')

<header class="flex item-center mb-3 py-4">
    <div class="flex justify-between items-end w-full">
        <h2 class="text-gray-400 text-lg">My Transactions</h2>
        <a href="/transactions/create"><p class="button">New transaction</p></a>
    </div>
</header>
    <div class="lg:flex lg:flex-wrap -mx-3">
        @if ($transactions)
        <table class="table-auto">
            <thead>
                <tr>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Account</th>
                    <th class="px-4 py-2">Category</th>
                    <th class="px-4 py-2">Amount</th>
                    <th class="px-4 py-2">Description</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transactions as $transaction)
                <tr class={{ ($loop->index%2) ? 'bg-gray-100' : '' }}>
                    <td class="border px-4 py-2">{{$transaction->date}}</td>
                    <td class="border px-4 py-2">{{$transaction->account->name}}</td>
                    <td class="border px-4 py-2">{{$transaction->category->name}}</td>
                    <td class="border px-4 py-2">{{$transaction->amount}}</td>
                    <td class="border px-4 py-2">{{$transaction->description}}</td>
                </tr>
                @empty
                    <div>No transactions yet.</div>
                @endforelse
            </tbody>
        </table>
        @else
            <div>No transactions yet.</div>
        @endif
    </div>
@endsection
