<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\Spending;
use Illuminate\Http\Request;

class SpendingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $spendings = Spending::selectRaw('date, SUM(total_price) as total_price')
                                ->with('purchase')
                                ->where('user_id', auth()->id())
                                ->groupBy('date')
                                ->paginate(5);

        return response()->json($spendings->load('purchase'));
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
        $spending = new Spending();
        $spending->fill($request->json()->all());
        $spending->save();

        return $spending;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Spending  $spending
     * @return \Illuminate\Http\Response
     */
    public function show($spending)
    {
        $listSpending = Spending::with('purchase.purchasingDetails.item')
                                    ->where('date', $spending)
                                    ->where('user_id', auth()->id())
                                    ->get();

        return response()->json($listSpending);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spending  $spending
     * @return \Illuminate\Http\Response
     */
    public function edit(Spending $spending)
    {
        return response()->json($spending);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Spending  $spending
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spending $spending)
    {
        $spending->fill($request->json()->all());
        $spending->save();

        return $spending;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spending  $spending
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spending $spending)
    {
        $spending->delete();

        return 'Success';
    }

    /**
     * getPurchasingDetails the specified resource from storage.
     *
     * @param  \App\Models\Spending  $spending
     * @return \Illuminate\Http\Response
     */
    public function getPurchasingDetails(Purchase $purchase)
    {
        return response()->json($purchase->load('purchasingDetails.item'));
    }

}
