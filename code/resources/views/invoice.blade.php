@push('styles_invoice')
    <link rel="stylesheet" href="{{ asset('css/invoice.css') }}">
@endpush

@extends('layouts.master')

@section('content')
{{-- Content --}}

<div class="review-content">

    <div class="row review-title">
        <div class="col-10 review-h1-title">
            <h1 style="font-weight: bold">
                Invoice ID: {{ $invoice->id }}
            </h1>
        </div>
        <div class="col-2 d-flex justify-content-center">
            <a class="mt-3" href="#" onclick="history.back(); return false;">
                <img src="{{ asset('icons/Icon close.svg') }}" alt="Back">
            </a>
        </div>
    </div>

    <div class="rmc-flex">
        <div class="row review-main-content">
            <div class="container rcm-container mt-4 mb-4">
                
                <div class="row mb-3 row-content-invoce">
                    <div class="col-3">
                        <strong>Customer name: <br> {{ $invoice->customer->name }} </strong>
                    </div>
                    <div class="col-6">
                        <strong>Delivery type: <br> {{ $invoice->delivery->deliveryType->name }} </strong>
                    </div>
                    <div class="col-3">
                        <strong>Invoice date: <br> {{ $invoice->invoice_date->format('M d, Y') }} </strong>
                    </div>
                </div>

                <div class="row mb-3 row-content-invoce" style="padding-bottom: 15px; border-bottom: 1px solid #6c757d;">
                    <div class="col-9">
                        <strong>Address: <br> {{ $invoice->customer->address }} </strong>
                    </div>
                    <div class="col-3">
                        <strong>Delivery type: <br> {{ $invoice->delivery->deliveryType->name }} - Rp {{ number_format($invoice->delivery->deliveryType->price, 2, ',', '.') }} </strong>
                    </div>
                </div>

                <div class="row mb-3 row-content-invoce d-flex justify-content-center">
                    <div class="row" style="padding-bottom: 15px; border-bottom: 1px solid #6c757d;">
                        <div class="col-4">
                            <strong>Product Name</strong>
                        </div>
                        <div class="col-3">
                            <strong>Cost</strong>
                        </div>
                        <div class="col-2">
                            <strong>Qty</strong>
                        </div>
                        <div class="col-3">
                            <strong>Ammount</strong>
                        </div>
                    </div>
                    <div class="row mt-3 mb-3">
                        <!-- Transaction detail loop -->
                        @forelse ($invoice->transaction->transactionDetails as $detail)
                            <div class="col-4">
                                {{ $detail->product->name }}
                            </div>
                            <div class="col-3">
                                Rp {{ number_format($detail->product->price, 2, ',', '.') }}
                            </div>
                            <div class="col-2">
                                {{ $detail->quantity }}
                            </div>
                            <div class="col-3">
                                Rp {{ number_format($detail->quantity * $detail->product->price, 2, ',', '.') }}
                            </div>
                        @empty
                            <div class="mb-3">
                                <strong>No Transaction</strong>
                            </div>
                        @endforelse
                    </div>
                    <div class="row" style="padding-top: 15px; border-top: 1px solid #6c757d;">
                        <div class="col-12">
                            <strong>
                                Total Ammount: <br> Rp {{ number_format($invoice->transaction->total_amount, 2, ',', '.') }}
                            </strong>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
{{-- End of Content --}}
@endsection