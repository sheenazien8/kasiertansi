<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Income;
use App\Services\EmployeeService;
use App\Services\IncomeService;
use App\Services\TransactionService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getDataDashboard(Request $request)
    {
        $transactionService = new TransactionService();
        $incomeService = new IncomeService();
        $employeeService = new EmployeeService();
        $transactionToday = $transactionService->getTodayTransaction(
            'total_qty'
        )->get()->sum('total_qty');
        $invoiceNumber = $transactionService->getTodayTransaction(
            'invoice_number',
            'created_at'
        )->orderBy('created_at', 'desc')->limit(5)->get();

        $incomes = $incomeService->getTodayIncome();
        $employees = $employeeService->getTotalEmployee();

        return response()->json([
            'incomes' => $incomes,
            'items' => $transactionToday,
            'employees' => $employees,
            'invoice_number' => $invoiceNumber
        ]);
    }

    public function getDataIncme(Request $request)
    {
        $incomeService = new IncomeService();
        $interIncome = $incomeService->getIncomeByRequest(
            $request, ['total_price', 'date']
        );

        return response()->json($interIncome);
    }
}
