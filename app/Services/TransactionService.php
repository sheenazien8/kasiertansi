<?php
namespace App\Services;

use App\Models\Item;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use App\Services\ArrayService;

class TransactionService
{
    public function insertTransactionDetail($request, $transaction)
    {
        $id = Arr::pluck($request->json('transactionDetails'), 'id');
        $transactionDetails = TransactionDetail::find($id);
        foreach ($transactionDetails as $transactionDetail) {
            $transactionDetail->transaction()->associate($transaction);
            $transactionDetail->save();
        }
    }

    public function getProfitFromRequest($transactionDetail)
    {
        $arrayService = new ArrayService();
        $profit = Arr::pluck($transactionDetail, 'profit');
        $result = $arrayService->countValue($profit);

        return $result;
    }
    public function getConstructorClass($request, $item)
    {
        $transactionDetail = TransactionDetail::whereNull('transaction_id')
                                ->whereItemId($request->json('item_id'))->first();
        if ($transactionDetail) {
            if (!$transactionDetail->transaction_id) {
                $request->qty = $request->qty + $transactionDetail->qty;
                $request->price = $request->price + $transactionDetail->price;
                $profit = ($item->price->selling_price * $request->qty) - ($item->price->initial_price * $request->qty);
                $request->json()->add([
                    'qty' => $request->qty,
                    'price' => $request->price,
                    'profit' => $profit
                ]);
            } else {
                $profit = ($item->price->selling_price * $request->qty) - ($item->price->initial_price * $request->qty);
                $request->json()->add([
                    'profit' => $profit
                ]);
                $transactionDetail = new TransactionDetail();
            }
        }
        if (!$transactionDetail) {
            $profit = ($item->price->selling_price * $request->qty) - ($item->price->initial_price * $request->qty);
            $request->json()->add([
                'profit' => $profit
            ]);
            $transactionDetail = new TransactionDetail();
        }

        return $transactionDetail;
    }

    public function reduceCurrentStock($request)
    {
        $item = Item::find($request->json('item_id'));
        $current_stock = $item->current_stock - $request->json('qty');
        $item->current_stock = $current_stock;
        $item->save();

        return $item;
    }

    public function getTodayTransaction($column)
    {
        $carbon = Carbon::now();
        $transactions = Transaction::select($column)
                            ->where('user_id', auth()->id())
                            ->where('purchase_date', $carbon->today()->format('Y-m-d'));

        return $transactions;
    }

    public function getTransactionByRequest($request)
    {
    }
}
