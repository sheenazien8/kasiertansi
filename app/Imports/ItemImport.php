<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Item;
use App\Models\Price;
use App\Models\Unit;
use App\Services\CodeGeneratorService;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ItemImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Item|null
     */
    public function model(array $row)
    {
        $category = Category::whereName(strtolower($row['kategori']))->first();
        if (!$category) {
            $category = new Category();
            $category->fill([
                'name' => ucwords($row['kategori']),
            ]);
            $category->save();
        }
        $unit = Unit::whereUnit(strtolower($row['unit']))->first();
        if (!$unit) {
            $unit = new Unit();
            $unit->fill([
                'unit' => ucwords($row['unit'])
            ]);
            $unit->save();
        }

        $item = Item::whereName(strtolower($row['nama_barang']))->first();
        if (!$item) {
            $codeServices = new CodeGeneratorService();
            $codeItem = $codeServices->generateCodeItem();
            $item = new Item();
            $item->fill([
                'name' => ucwords($row['nama_barang']),
                'current_stock' => $row['stok_terakhir'],
                'code' => $codeItem,
            ]);
            $item->category()->associate($category);
            $item->unit()->associate($unit);
            $item->save();
            $price = new Price();
            $price->fill([
                'initial_price' => $row['harga_beli'],
                'selling_price' => $row['harga_jual']
            ]);
            $price->item()->associate($item);
            $price->save();

            return $item;
        } else {
            $item->name = ucwords($row['nama_barang']);
            $current_stock = $item->current_stock + $row['stok_terakhir'];
            $item->fill([
                'current_stock' => $current_stock,
            ]);
            $item->category()->associate($category);
            $item->unit()->associate($unit);
            $item->save();
            if ($item->price->initial_price != $row['harga_beli'] || $item->price->selling_price != $row['harga_jual']) {
                $price = new Price();
                $price->fill([
                    'initial_price' => $row['harga_beli'],
                    'selling_price' => $row['harga_jual']
                ]);
                $price->item()->associate($item);
                $price->save();
            }

            return $item;
        }
    }
}
