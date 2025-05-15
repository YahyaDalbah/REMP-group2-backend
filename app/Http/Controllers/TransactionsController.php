<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
class TransactionsController extends Controller
{
    public function index(){
        return Transaction::all();
    }
    public function store(Request $request){
        $fields = $request->validate([
            'property_id' => "required|exists:properties,id",
            'buyer_id' => "required|exists:users,id",
            'transaction_type' => "required|string",
            'amount' => "required|numeric|min:0",
            'start_date',
            'end_date',
        ]);

        $transaction = Transaction::create($fields);
        return $transaction;
    }
    public function show($id){
        
        $transaction = Transaction::findOrFail($id);
        return $transaction;
        
    }    
}
