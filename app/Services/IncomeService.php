<?php
namespace App\Services;

use App\Models\Income;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class IncomeService
{
    public function getTodayIncome()
    {
        $carbon = Carbon::now();
        $incomes = Income::select('total_price')->where('user_id', auth()->id())
            ->where('date', $carbon->today()->format('Y-m-d'))
            ->get()->sum('total_price');

        return $incomes;
    }

    public function getIncomeByRequest($request, $column)
    {
        if ($request->day == 30) {
            $carbon = Carbon::today();
            $lastTirtyDay = Carbon::today()->subDays(30)->format('Y-m-d');
            $incomes = Income::select($column)->where('user_id', auth()->id())
                ->whereBetween('date', [$lastTirtyDay, $carbon->format('Y-m-d')])
                ->orderBy('date')->get();

            $result = $this->countByRequest($incomes);

            dd($result);
        }
        dd('ok');
        $carbon = Carbon::today();
        $lastWeek = Carbon::today()->subWeek()->format('Y-m-d');
        $incomes = Income::select($column)->where('user_id', auth()->id())
            ->whereBetween('date', [$lastWeek, $carbon->format('Y-m-d')])
            ->orderBy('date')->get();
        $result = $this->countByRequest($incomes);

        return $result;
    }

    public function countByRequest($incomes)
    {
        $result = [];
        $data = collect($incomes->toArray());
        $array = $data->groupBy('date')->toArray();
        foreach ($array as $value) {
            $total_price = Arr::pluck($value, 'total_price');
            $result[Carbon::parse($value[0]['date'])->format('D')] = array_sum($total_price);
        }

       return $result;
    }
}
