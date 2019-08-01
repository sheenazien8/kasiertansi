<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubsdiaryRequest;
use App\Models\Subsidiary;

class SubsidiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subsidiaries = Subsidiary::where('user_id', auth_cache()->id)
                                ->orderBy('created_at', 'desc')
                                ->paginate();

        return response()->json($subsidiaries);
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
     * @param  \Illuminate\Http\SubsdiaryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubsdiaryRequest $request)
    {
        $subsidiary = new Subsidiary();
        request()->json()->add([
            'status' => true,
        ]);
        $subsidiary->fill($request->json()->all());
        $subsidiary->save();

        return $subsidiary;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subsidiary  $subsidiary
     * @return \Illuminate\Http\Response
     */
    public function show(Subsidiary $subsidiary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subsidiary  $subsidiary
     * @return \Illuminate\Http\Response
     */
    public function edit(Subsidiary $subsidiary)
    {
        return response()->json($subsidiary);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\SubsdiaryRequest  $request
     * @param  \App\Models\Subsidiary  $subsidiary
     * @return \Illuminate\Http\Response
     */
    public function update(SubsdiaryRequest $request, Subsidiary $subsidiary)
    {
        $subsidiary->fill($request->json()->all());
        $subsidiary->save();

        return $subsidiary;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subsidiary  $subsidiary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subsidiary $subsidiary)
    {
        $subsidiary->delete();

        return 'Success';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subsidiary  $subsidiary
     * @return \Illuminate\Http\Response
     */
    public function searchSubsdiary($query)
    {
        $subsidiary = Subsidiary::select('id', 'name')
                    ->where('user_id', auth_cache()->id)
                    ->where('name', 'LIKE', "%%".$query."%%")->get();

        return response()->json($subsidiary);
    }

    public function updateStatus(SubsdiaryRequest $request, Subsidiary $subsidiary)
    {
        $subsidiary->closed_at = $request->json('closed_at');
        $subsidiary->status = false;
        $subsidiary->save();

        if (!$request->json('closed_at')) {
            $subsidiary->status = true;
            $subsidiary->save();
        }

        return response()->json($subsidiary);
    }
}
