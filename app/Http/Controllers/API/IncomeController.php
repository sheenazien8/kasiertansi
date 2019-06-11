<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incomes = Income::selectRaw('date, SUM(total_price) as total_price')
                        ->where('user_id', auth_cache()->id)
                        ->groupBy('date')
                        ->get();

        return response()->json($incomes);
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
        $transaction = Transaction::find($request->json('transaction_id'));
        $request->json()->add([
            'date' => date('Y-m-d'),
            'total_price' => $transaction->total_price,
            'total_qty' => $transaction->total_qty,
            'total_profit' => $transaction->total_profit,
        ]);
        $income = new Income();
        $income->fill($request->json()->all());
        $income->transaction()->associate($transaction);
        $income->save();

        return $income;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function show($income)
    {
        $listIncome = Income::with('transaction.transactionDetails.item')
                                    ->where('date', $income)
                                    ->where('user_id', auth_cache()->id)
                                    ->get();

        return response()->json($listIncome);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function edit(Income $income)
    {
        return response()->json($income);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Income $income)
    {
        $income->fill($request->json()->all());
        $income->save();

        return $income;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function destroy(Income $income)
    {
        $income->delete();

        return 'Success';
    }

    public function getIncome(Request $request)
    {
        $income = Income::with('transaction.transactionDetails.item')
                            ->whereUserId(auth_cache()->id)
                            ->whereBetween('date', [
                                $request->json('start_date'), $request->json('end_date')
                            ])
                            ->get();

        return response()->json($income);
    }
    public function getItem($transaction_id)
    {
        $transaction_details = TransactionDetail::with('item.category', 'item.price')
                                                ->whereTransactionId($transaction_id)
                                                ->get();

        return response()->json($transaction_details);
    }

    public function printPdfIncome(Request $request)
    {
        $data = ['title' => 'Welcome to belajarphp.net'];

        $pdf = PDF::loadView('myPDF', $data);
        return $pdf->download('laporan-pdf.pdf');
    }
}
