<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Imports\ItemImport;
use App\Models\Category;
use App\Models\Item;
use App\Models\Unit;
use App\Services\CodeGeneratorService;
use Excel;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = Item::with('category', 'unit', 'prices', 'price')
                    ->orderBy('id', 'desc')
                    ->where('user_id', auth_cache()->id)
                    ->paginate(10);

        return response()->json($item);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ItemRequest $request)
    {
        $query = $request->input('query');
        $units = Unit::select('id', 'unit')
                        ->where('user_id', auth_cache()->id)
                        ->where('unit', 'LIKE', "%%".$query."%%")->get();
        $categories = Category::select('id', 'name')
                        ->where('user_id', auth_cache()->id)
                        ->where('name', 'LIKE', "%%".$query."%%")->get();
        $codeServices = new CodeGeneratorService();
        $codeItem = $codeServices->generateCodeItem();

        return response()->json([
           'units' => $units,
           'categories' => $categories,
           'codeItem' => $codeItem,
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
        return response()->json($item->load('price'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $units = Unit::select('id', 'unit')->where('user_id', auth_cache()->id)->get();
        $categories = Category::select('id', 'name')->where('user_id', auth_cache()->id)->get();

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
        $item = Item::select('id', 'name')
                    ->where('user_id', auth_cache()->id)
                    ->where('name', 'LIKE', "%%".$query."%%")->get();

        return response()->json($item);
    }

    /**
     * Import Item
     *
     * @return Void
    **/

    public function import()
    {
        $file = request()->file('file');
        Excel::import(new ItemImport, $file);

        return response()->json([
            'status' => 200,
            'msg' => 'Success'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getItem()
    {
        $item = Item::with('category', 'unit', 'prices', 'price')
                    ->orderBy('id', 'desc')
                    ->where('user_id', auth_cache()->id)
                    ->get();

        return response()->json($item);
    }
}
