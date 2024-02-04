<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionsController extends Controller
{
    public function index()
    {
        $transactions = auth()->user()->transactions;
        return view('transactions.index', compact('transactions'));
    }

    public function show(Transaction $transaction)
    {
        // $this->authorize('update', $transaction);
        return view('transactions.show', compact('transaction'));
    }

    public function create(Request $request)
    {
        $user = $request->user();
        $data['accounts'] = $user->accounts()->pluck('name', 'id');
        $data['categories'] = $user->categories()->pluck('name', 'id');
        return view('transactions.create', $data);
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $attributes = $request->validate([
            'account_id' => 'required|exists:accounts,id,user_id,'.$user->id,
            'category_id' => 'required|exists:categories,id,user_id,'.$user->id,
            'date' => 'required|date',
            'amount' => 'required|decimal:0,2',
            'description' => 'nullable|string'
        ]);
        $transaction = $user->transactions()->create($attributes);
        return redirect("/transactions/{$transaction->id}");
    }

    function update(Transaction $transaction) {
        // $this->authorize('update', $transaction);
        $transaction->update([
            'amount' => request()->amount
        ]);
        return redirect("/transactions/{$transaction->id}");
    }
}
