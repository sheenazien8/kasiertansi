<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Models\Category;
use App\Models\Item;
use App\Models\Unit;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = Item::where('user_id', auth()->id())->get();

        return response()->json($item->load('category', 'unit', 'prices', 'price'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ItemRequest $request)
    {
        $query = $request->input('query');
        $units = Unit::select('id', 'unit')->where('unit', 'LIKE', "%%".$query."%%")->get();
        $categories = Category::select('id', 'name')->where('name', 'LIKE', "%%".$query."%%")->get();

        return response()->json([
            'units' => $units,
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        $category = Category::find($request->json('category_id'));
        $unit = Unit::find($request->json('unit_id'));
        $item = new Item();
        $item->fill($request->json()->all());
        $item->category()->associate($category);
        $item->unit()->associate($unit);
        $item->save();

        return $item;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $units = Unit::select('id', 'unit')->where('user_id', auth()->id())->get();
        $categories = Category::select('id', 'name')->where('user_id', auth()->id())->get();

        return response()->json([
            'units' => $units,
            'categories' => $categories,
            'item' => $item->load('category', 'unit')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ItemRequest  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(ItemRequest $request, Item $item)
    {
        $category = Category::find($request->json('category_id'));
        $unit = Unit::find($request->json('unit_id'));
        $item->fill($request->json()->all());
        $item->category()->associate($category);
        $item->unit()->associate($unit);
        $item->save();

        return $item;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return 'Success';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ItemRequest  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function updateStock(ItemRequest $request, Item $item)
    {
        $stock = $item->stock + $request->json('stock');
        $item->fill([
            'stock' => $stock
        ]);
        $item->save();

        return $item;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searhItems($query)
    {
        $item = Item::where('user_id', auth()->id())->where('name', 'LIKE', "%%".$query."%%")->get();

        return response()->json($item->load('category', 'unit', 'prices', 'price'));
    }
}
