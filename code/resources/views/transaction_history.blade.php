@push('styles_transaction_history')
<link rel="stylesheet" href="{{ asset('css/transaction_history.css') }}">
@endpush

@extends('layouts.master')

@section('content')
{{-- Content --}}

<div class="review-content">

    <div class="row review-title">
        <div class="col-12 review-h1-title">
            <h1>Transaction History</h1>
        </div>
    </div>

    <div class="rmc-flex">
        <div class="row review-main-content">
            <div class="row rmc-first-row">
                <div class="col-12 rmc-first-col mt-3 ms-4">
                    <div class="col-search col-search-review">
                        <div class="search-bar-delivery">
                            <img src="{{ asset('icons/Icon search.svg') }}" alt="Search Icon" class="search-icon">
                            <input type="text" placeholder="Search" class="search-input-delivery">
                        </div>
                    </div>
                </div>
            </div>

            <div class="container rcm-container mt-4">
                <div class="row mb-4 align-items-center" style="width: 95%; height: 50px; background-color: white; border-radius: 10px;">
                    <div class="col-2 d-flex justify-content-center">
                        <strong>Transaction ID</strong>
                    </div>
                    <div class="col-2">
                        <strong>Name</strong>
                    </div>
                    <div class="col-2">
                        <strong>Date</strong>
                    </div>
                    <div class="col-2">
                        <strong>Status</strong>
                    </div>
                    <div class="col-4">
                        <strong>Total Ammount</strong>
                    </div>
                </div>
                <!-- Transaction History loop -->
                @if ($transactions->isEmpty())
                <div class="mb-3">
                    <strong>No Data</strong>
                </div>
                @endif
                @foreach ($transactions as $transaction)
                <div class="row mb-4 align-items-center" style="width: 95%; height: 120px; background-color: white; border-radius: 10px;">
                    <div class="col-2 d-flex justify-content-center">
                        <!-- Transaction ID -->
                        {{ $transaction->id }}
                    </div>
                    <div class="col-2">
                        <!-- Customer Name -->
                        {{ $transaction->customer->name }}
                    </div>
                    <div class="col-2">
                        <!-- Transaction date -->
                        {{ $transaction->transaction_date->format('M d, Y') }} at {{ $transaction->transaction_date->format('h:i A') }}
                    </div>
                    <div class="col-2">
                        <!-- Transaction status -->
                        {{ $transaction->transactionStatus->name }}
                    </div>
                    <div class="col-2">
                        <!-- Total Amount -->
                        Rp {{ number_format($transaction->total_amount, 2, ',', '.') }}
                    </div>
                    <div class="col-2">
                        <div class="col-3 d-flex flex-column align-items-center w-100">
                            <a href="{{ route('invoices.show', ['id' => $transaction->invoice->id]) }}" style="width: 70%;">
                                <button class="detail-delivery-btn">
                                    Detail
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>

{{-- End of Content --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var url = new URL(window.location);
        url.searchParams.delete('search');
        window.history.replaceState(null, null, url);
        
        var searchInput = document.querySelector('.search-input-delivery');

        // Listener untuk input pencarian
        searchInput.addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                var searchQuery = this.value.trim();
                updateURL('search', searchQuery);
            }
        });

        function updateURL(key, value) {
            var searchParams = new URLSearchParams(window.location.search);
            searchParams.set(key, value);
            window.location.search = searchParams.toString();
        }
    });
</script>

@endsection