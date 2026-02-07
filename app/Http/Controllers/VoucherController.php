<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use App\Http\Requests\StoreVoucherRequest;
use App\Http\Requests\UpdateVoucherRequest;
use App\Models\Insurance;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Voucher::with('insurances')->get();

        return view('pages/marketing/voucher/voucher', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $insurances = Insurance::all();

        return view('pages/marketing/voucher/form', compact(['insurances']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVoucherRequest $request)
    {
        $validated = $request->validated();

        $validated['start_date'] = $validated['start_date'] ?? now()->toDateString();

        Voucher::create($validated);

        return redirect()->route('voucher.index')->with('success', 'Voucher successfully added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Voucher $voucher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Voucher $voucher)
    {
        $insurances = Insurance::all();

        return view('pages/marketing/voucher/form', compact(['voucher', 'insurances']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVoucherRequest $request, Voucher $voucher)
    {
        $validated = $request->validated();

        $validated['start_date'] = $validated['start_date'] ?? now()->toDateString();

        $validated['end_date'] = $validated['end_date'] ?: null;

        $voucher->update($validated);

        return redirect()
            ->route('voucher.index')
            ->with('success', 'Voucher successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voucher $voucher)
    {
        $voucher->delete();

        return redirect()
            ->route('voucher.index')
            ->with('success', 'Voucher successfully deleted!');
    }
}
