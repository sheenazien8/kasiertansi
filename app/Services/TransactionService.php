<?php
namespace App\Services;

use App\Models\Item;
use App\Models\TransactionDetail;
use Illuminate\Support\Arr;

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

    public function getConstructorClass($request)
    {
        $transactionDetail = TransactionDetail::whereNull('transaction_id')
                                                ->whereItemId($request->json('item_id'))->first();
        if ($transactionDetail) {
            if (!$transactionDetail->transaction_id) {
                $request->qty = $request->qty + $transactionDetail->qty;
                $request->price = $request->price + $transactionDetail->price;
                $request->json()->add([
                    'qty' => $request->qty,
                    'price' => $request->price,
                ]);
            }else {
                $transactionDetail = new TransactionDetail();
            }
        }
        if (!$transactionDetail) {
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
}
