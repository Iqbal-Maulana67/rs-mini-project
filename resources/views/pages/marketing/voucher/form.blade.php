@extends('layouts/marketing-template')

@section('marketing-content')
    <div class="add-form-list">
        <div class="row">
            <div class="col-sm-12">
                @if ($errors->any())
                    <div class="w-full bg-red-500 text-white p-3 rounded">
                        <span>Error </span>
                        @foreach ($errors->all() as $item)
                            <span>{{ $item }}</span>
                        @endforeach
                    </div>
                @endif
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">{{ isset($voucher) ? 'Update' : 'Add' }} Voucher</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ isset($voucher) ? route('voucher.update', ['voucher' => $voucher->id]) : route('voucher.store') }}"
                            method="POST">
                            @csrf
                            @if (isset($voucher))
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Insurance *</label>
                                        <select name="insurance_id" class="selectpicker form-control" data-style="py-0">
                                            <option>Choose Insurance</option>
                                            @foreach ($insurances as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ isset($voucher) ? ($voucher->insurance_id == $item->id ? 'selected' : '') : '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="">Discount Type</label>
                                        <select name="discount_type" class="selectpicker form-control" data-style="py-0">
                                            <option value="percent"
                                                {{ isset($voucher) ? ($voucher->discount_type == 'percent' ? 'selected' : '') : '' }}>
                                                %</option>
                                            <option value="fixed"
                                                {{ isset($voucher) ? ($voucher->discount_type == 'fixed' ? 'selected' : '') : '' }}>
                                                Rp.</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Discount Value</label>
                                        <input type="text" class="form-control" name="discount_value"
                                            value="{{ isset($voucher) ? $voucher->discount_value : '' }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <input type="datetime-local" class="form-control" name="start_date"
                                            value="{{ isset($voucher) && $voucher->start_date ? \Carbon\Carbon::parse($voucher->start_date)->format('Y-m-d\TH:i') : '' }}">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>End Date</label>
                                        <input type="datetime-local" class="form-control" name="end_date"
                                            value="{{ isset($voucher) && $voucher->end_date ? \Carbon\Carbon::parse($voucher->end_date)->format('Y-m-d\TH:i') : '' }}">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Max Discount (Rp.)</label>
                                        <input type="text" class="form-control" name="max_discount"
                                            value="{{ isset($voucher) ? $voucher->max_discount : 0 }}">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">{{ isset($voucher) ? 'Update' : 'Add' }}
                                Voucher</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
