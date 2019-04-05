<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseRequest;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Services\ArrayService;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = Purchase::where('user_id', auth()->id())
                                ->orderBy('created_at','desc')
                                ->paginate(5);

        return response()->json($purchases->load('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::select('id', 'name')
                                ->where('user_id', auth()->id())
                                ->get();

        return response()->json($suppliers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\PurchaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseRequest $request)
    {
        dd($request->json()->all());
        $supplier = Supplier::find($request->json('supplier_id'));
        $purchase = new Purchase();
        $purchase->fill($request->json()->all());
        $purchase->supplier()->associate($supplier);
        $purchase->save();

        return $purchase;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        return response()->json($purchase);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        $suppliers = Supplier::select('id', 'name')
                                ->where('user_id', auth()->id())
                                ->get();

        return response()->json([
            'purchase' => $purchase->load('supplier'),
            'suppliers' => $suppliers,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\PurchaseRequest  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(PurchaseRequest $request, Purchase $purchase)
    {
        $supplier = Supplier::find($request->json('supplier_id'));
        $purchase->fill($request->json()->all());
        $purchase->supplier()->associate($supplier);
        $purchase->save();

        return $purchase;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        foreach ($purchase->purchasingDetails as $purchasing) {
            $stock = $purchasing->item->current_stock - $purchasing->qty;
            $purchasing->item->current_stock = $stock;
            $purchasing->item->save();
        }
        $purchase->delete();

        return 'Success';
    }

    /**
     * Update the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function paidPurchasing(Purchase $purchase)
    {
        $array = new ArrayService();
        $total_qty = $array->countValue($purchase->purchasingDetails->pluck('qty')->toArray());
        $total_price = $array->countValue($purchase->purchasingDetails->pluck('total_price')->toArray());
        if (!$purchase->is_paid) {
            $purchase->is_paid = true;
            foreach ($purchase->purchasingDetails as $purchasing) {
                $stock = $purchasing->item->current_stock + $purchasing->qty;
                $purchasing->item->current_stock = $stock;
                $purchasing->item->save();
            }
            $purchase->spending()->create([
                'date' => Carbon::now()->format('Y-m-d'),
                'total_qty' => $total_qty,
                'total_price' => $total_price
            ]);
        }else {
            $purchase->is_paid = false;
            foreach ($purchase->purchasingDetails as $purchasing) {
                $stock = $purchasing->item->current_stock - $purchasing->qty;
                $purchasing->item->current_stock = $stock;
                $purchasing->item->save();
            }
            $purchase->spending()->create([
                'date' => Carbon::now()->format('Y-m-d'),
                'total_qty' => $total_qty,
                'total_price' => $total_price
            ]);
        }
        $purchase->save();

        return 'Success';
    }
}
