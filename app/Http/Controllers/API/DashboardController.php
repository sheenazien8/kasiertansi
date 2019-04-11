<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Income;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getDataDashboard()
    {
        $carbon = Carbon::now();
        $incomes = Income::select('total_price')->where('user_id', auth()->id())
                           ->where('date', $carbon->today()->format('Y-m-d'))->get()->sum('total_price');
        $transactions = Transaction::select('total_qty', 'invoice_number', 'created_at')
                                    ->where('user_id', auth()->id())
                                    ->where('purchase_date', $carbon->today()->format('Y-m-d'));
        $employees = Employee::select('id')->where('owner_id', auth()->user()->userable->id)
                                ->get()->count();

        return response()->json([
            'incomes' => $incomes,
            'items' => $transactions->get()->sum('total_qty'),
            'employees' => $employees,
            'invoice_number' => $transactions->orderBy('created_at', 'desc')->limit(5)->get()
        ]);
    }
}
