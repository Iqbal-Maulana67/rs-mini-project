@extends('layouts/base-layout')

@section('content')
    <div class="iq-sidebar  sidebar-default ">
        <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
            <a href="{{ asset('backend/index.html') }}" class="header-logo">
                <h5 class="logo-title ml-3">RS MINI PROJECT</h5>
            </a>
            <div class="iq-menu-bt-sidebar ml-0">
                <i class="las la-bars wrapper-menu"></i>
            </div>
        </div>
        <div class="data-scrollbar" data-scroll="1">
            <nav class="iq-sidebar-menu">
                <ul id="iq-sidebar-toggle" class="iq-menu">
                    <li class="">
                        <a href="{{ route('marketing.dashboard') }}" class="svg-icon">
                            <svg class="svg-icon" id="p-dash1" width="20" height="20"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                                </path>
                                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                <line x1="12" y1="22.08" x2="12" y2="12"></line>
                            </svg>
                            <span class="ml-4">Dashboard</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('voucher.index') }}" class="svg-icon">
                            <svg class="svg-icon" id="p-dash5" width="20" height="20"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                <line x1="1" y1="10" x2="23" y2="10"></line>
                            </svg>
                            <span class="ml-4">Vouchers</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="iq-top-navbar">
        <div class="w-full min-h-[73px] flex flex-column justify-center items-end">
            <a href="{{ route('logout') }}">
                <span class="text-red-500 cursor-pointer">Logout</span>
            </a>
        </div>
    </div>
    <div class="modal fade" id="new-order" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="popup text-left">
                        <h4 class="mb-3">New Order</h4>
                        <div class="content create-workform bg-body">
                            <div class="pb-3">
                                <label class="mb-2">Email</label>
                                <input type="text" class="form-control" placeholder="Enter Name or Email">
                            </div>
                            <div class="col-lg-12 mt-4">
                                <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                                    <div class="btn btn-primary mr-4" data-dismiss="modal">Cancel</div>
                                    <div class="btn btn-outline-primary" data-dismiss="modal">Create</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-page">
        @yield('marketing-content')
    </div>
@endsection
