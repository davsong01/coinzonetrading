<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InvestorPackage;

class DashboardController extends Controller
{
    public function adminTransactions(){
        return view('transactions.index', [
            'transactions' => InvestorPackage::all(),
        ]);
    }
}
