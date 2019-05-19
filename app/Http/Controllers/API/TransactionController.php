<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Services\TransactionService;
use App\Services\CodeGeneratorService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('ok');
        $transactions = Transaction::where('user_id', auth_cache()->id)
                                ->orderBy('created_at', 'desc')
                                ->paginate(5);

        return response()->json($transactions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transactionService = new TransactionService();
        $total_profit = $transactionService->getProfitFromRequest($request->json('transactionDetails'));
        $codeGeneratorService = new CodeGeneratorService();
        $invoice_number = $codeGeneratorService->generateCode();
        $request->json()->add([
            'invoice_number' => $invoice_number,
            'total_profit' => $total_profit
        ]);
        $transaction = new Transaction();
        $transaction->fill($request->json()->all());
        $transaction->save();
        $transactionService->insertTransactionDetail($request, $transaction);

        return response()->json($transaction);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        return response()->json($transaction);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $transaction->fill($request->json()->all());
        $transaction->save();

        return $transaction;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return 'Success';
    }

    /**
     * Get invoice number from storage.
     */

    public function getInvoiceCode()
    {
        $codeGeneratorService = new CodeGeneratorService();
        $code = $codeGeneratorService->generateCodePurchasing();

        return response()->json($code);
    }
}
