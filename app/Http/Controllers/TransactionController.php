<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\TransactionItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        DB::beginTransaction();

        $items = collect($request->input('items', []));

        $subtotal = $items->sum(fn ($i) => (float) $i['price']);

        $discount = (float) ($request->discount ?? 0);
        $total = $subtotal - $discount;

        try {

            $transaction = Transaction::create([
                'transaction_number' => 'TRX-' . now()->format('YmdHis') . '-' . rand(100, 999),
                'insurance_id' => $request->insurance_id,
                'cashier_id' => Auth::user()->id,
                'patient_name' => $request->patient_name,
                'subtotal' => $subtotal,
                'discount' => $discount,
                'total' => $total
            ]);

            foreach ($request->items as $item) {
                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'procedure_id' => $item['id'],
                    'procedure_name' => $item['name'],
                    'price' => $item['price'],
                    'total' => $item['price']
                ]);
            }

            DB::commit();
            
            return response()->json([
                'success' => true,
                'transaction_id' => $transaction->id,
                'invoice_url' => route('transactions.invoice', $transaction->id)
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'subtotal' => $subtotal,
                'diskon' => $discount,
                'total' => $total,
            ]);
        }
    }

    public function invoice(Transaction $transaction)
    {
        $pdf = Pdf::loadView('invoice.transaction.invoice', [
            'transaction' => $transaction->load('items', 'cashier'),
        ]);

        return $pdf->download("nota-{$transaction->transaction_number}.pdf");
    }


    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
