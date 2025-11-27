<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class CashPaymentController extends Controller
{
    public function index(): View
    {
        return view('cash_payment.index');
    }
}
