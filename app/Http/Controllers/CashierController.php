<?php

namespace App\Http\Controllers;

use App\Models\Insurance;
use App\Models\Procedure;
use App\Models\Voucher;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function index()
    {
        $today = now()->format('Y-m-d');

        $procedures = Procedure::whereHas('prices', fn($q) => $q->active())
            ->with('activePrices')
            ->get();

        $vouchers = Insurance::whereHas('vouchers', fn($q) => $q->active())
            ->with('activeVouchers')
            ->get();
            
        return view('pages/kasir/kasir', compact(['procedures', 'vouchers']));
    }
}
