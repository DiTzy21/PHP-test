<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'amount' => 'required|numeric',
        ]);

        Transaction::create([
            'title' => $request->title,
            'description' => $request->description,
            'amount' => $request->amount,
        ]);

        return redirect()->route('transactions.index');
    }

    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'title' => 'required',
            'amount' => 'required|numeric',
        ]);

        $transaction->update([
            'title' => $request->title,
            'description' => $request->description,
            'amount' => $request->amount,
        ]);

        return redirect()->route('transactions.index');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index');
    }
}
