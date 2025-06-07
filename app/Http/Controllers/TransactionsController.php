<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class TransactionsController extends Controller
{
    public function index(Request $request){
        $request->validate([
            'type' => 'nullable|in:sale,rent'
        ]);
        $query = Transaction::query();
        if ($request->has('mine')) {
            $query->where('buyer_id', Auth::id());
        }
        if ($request->has('type')) {
            $query->where('transaction_type', $request->input('type'));
        }
        return $query->get();
    }
    public function store(Request $request){
        $fields = $request->validate([
            'property_id' => "required|exists:properties,id",
            'transaction_type' => "required|in:sale,rent",
            'amount' => "required|numeric|min:0",
            'start_date',
            'end_date',
        ]);
        $fields['buyer_id'] = Auth::id();

        $transaction = Transaction::create($fields);
        return $transaction;
    }
    public function show($id){
        
        $transaction = Transaction::findOrFail($id);
        return $transaction;
        
    }    
}
