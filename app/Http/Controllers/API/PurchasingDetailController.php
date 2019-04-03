<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Purchase;
use App\Models\PurchasingDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PurchasingDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Purchase $purchase)
    {
        $purchasingDetails = PurchasingDetail::where('user_id', auth()->id())
                                                ->where('purchase_id', $purchase->id)
                                                ->get();

        return response()->json($purchasingDetails->load('item.category', 'item.unit', 'item.price', 'purchase'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Item::select('id', 'name')
                        ->where('user_id', auth()->id())
                        ->get();

        return response()->json($items);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $purchasingDetail =  new PurchasingDetail();
        $purchasingDetail->fill($request->json()->all());
        $purchasingDetail->save();

        return response()->json($purchasingDetail);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchasingDetail  $purchasingDetail
     * @return \Illuminate\Http\Response
     */
    public function show(PurchasingDetail $purchasingDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchasingDetail  $purchasingDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchasingDetail $purchasingDetail)
    {
        $items = Item::select('id', 'name')->where('user_id', auth()->id())->get();
        $categories = Category::select('id', 'name')->where('user_id', auth()->id())->get();

        return response()->json([
            'items' => $items,
            'purchasingDetail' => $purchasingDetail->load('category', 'item')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchasingDetail  $purchasingDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchasingDetail $purchasingDetail)
    {
        $purchasingDetail->fill($request->json()->all());
        $purchasingDetail->save();

        return response()->json($purchasingDetail);

        return $purchasingDetail;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchasingDetail  $purchasingDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase, PurchasingDetail $purchasingDetail)
    {
        $purchasingDetail->delete();

        return 'Success';
    }
}
