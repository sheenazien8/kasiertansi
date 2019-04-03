<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class TransactionDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactionDetails = TransactionDetail::with('item')
                                                ->where('transaction_id', null)
                                                ->orderBy('created_at','desc')
                                                ->get();

        return response()->json([
            'transaction_details'=> $transactionDetails,
            'total_price' => $transactionDetails->sum('price'),
            'total_qty' => $transactionDetails->sum('qty')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transactionDetail = TransactionDetail::whereItemId($request->json('item_id'))->first();
        if ($transactionDetail) {
            $request->qty = $request->qty + $transactionDetail->qty;
            $request->price = $request->price + $transactionDetail->price;
            $request->json()->add([
                'qty' => $request->qty,
                'price' => $request->price,
            ]);
        }else {
            $transactionDetail = new TransactionDetail();
        }
        $transactionDetail->fill($request->json()->all());
        $transactionDetail->item()->associate($request->json('item_id'));
        $transactionDetail->save();

        return response()->json($transactionDetail);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransactionDetail  $transactionDetail
     * @return \Illuminate\Http\Response
     */
    public function show(TransactionDetail $transactionDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TransactionDetail  $transactionDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(TransactionDetail $transactionDetail)
    {
        return response()->json($transactionDetail);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransactionDetail  $transactionDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransactionDetail $transactionDetail)
    {
        $transactionDetail->fill($request->json()->all());
        $transactionDetail->save();

        return $transactionDetail;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransactionDetail  $transactionDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransactionDetail $transactionDetail)
    {
        $transactionDetail->delete();

        return 'Success';
    }


    /**
     * Save the specified resource in Session storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sessionStorage(Request $request)
    {
        $item = Item::find($request->json('item_id'));
        $cart = session()->get('cart');
        if (!$cart) {
            $cart = [
                $request->json('item_id') => [
                    'qty' => $request->json('qty'),
                    'price' => $request->json('price')
                ]
            ];
            session()->push('cart', $cart);
            $cart = session()->get('cart');

            return response()->json($cart);
        };

        if (isset($cart[$request->json('id')])) {
            $cart[$request->json('id')]['qty']++;
            session()->push('cart', $cart);

            $cart = session()->get('cart');

            return response()->json($cart);
        }

        $cart[$request->json('item_id')] = [
            'qty' => $request->json('qty'),
            'price' => $request->json('price')
        ];
        session()->push('cart', $cart);
        $cart = session()->get('cart');

        return response()->json($cart);
    }
}
