<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Delivery;
use App\Models\Transaction;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    
    public function index()
    {

        $deliveryCount = Delivery::where('delivery_status_id', 1)->count();

        $totalIncome = Transaction::sum('total_amount');

        $customerCount = Customer::count();

        $salesData = Transaction::select(
            DB::raw('SUM(total_amount) as total_sales'),
            DB::raw('DATE_FORMAT(transaction_date, "%b %Y") as month_year')
        )
        ->groupBy('month_year')
        ->orderBy('transaction_date', 'asc')
        ->get();        

        return view('homepage', compact('deliveryCount', 'totalIncome', 'customerCount', 'salesData'));
    }

}
