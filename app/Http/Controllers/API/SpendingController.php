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
                                ->where('user_id', auth_cache()->id)
                                ->groupBy('date')
                                ->paginate();

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
                                    ->where('user_id', auth_cache()->id)
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

    /**
     * getSpending the specified resource from storage.
     *
     * @param  \App\Models\Spending  $spending
     * @return \Illuminate\Http\Response
     **/
    public function getSpending(Request $request)
    {
        $transaction = Purchase::with('spending')
            ->where('user_id', auth_cache()->id)
            ->where('is_paid', true)
            ->whereBetween('purchase_date', [
                $request->json('start_date'), $request->json('end_date')
            ])
            ->get();

        return response()->json($transaction);
    }
}
