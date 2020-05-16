<?php
namespace App\Services;

class ArrayService
{
    public function countValue($array)
    {
        $total = 0;
        foreach ($array as $value) {
            $total += $value;
        }

        return $total;
    }
}
