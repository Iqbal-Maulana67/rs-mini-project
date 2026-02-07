@extends('layouts/marketing-template')

@section('marketing-content')
    <div class="row">
        <div class="w-1/4">
            <div class="card card-block card-stretch card-height">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4 card-total-sale">
                        <div class="bg-info-light flex justify-center items-center p-4 rounded-2xl mr-4">
                            <img src="{{ asset('assets/images/product/1.png') }}" class="img-fluid" alt="image">
                        </div>
                        <div>
                            <p class="mb-2">Total Sales</p>
                            <h4>31.50</h4>
                        </div>
                    </div>
                    <div class="iq-progress-bar mt-2">
                        <span class="bg-info iq-progress progress-1" data-percent="100">
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
