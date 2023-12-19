@extends('layouts.master')

@section('content')
{{-- Content --}}
<div class="content">
    <div class="reminder">
        <div class="row row-content">

        </div>
        <div class="row row-content mt-4">
            <div class="col-12 remcol delivery">
                <div class="reminder-text">
                    <h4>{{ $deliveryCount }} Delivery</h4>
                    <p>Please assign courier or update the delivery status</p>
                </div>
                <a href="{{ url('/delivery') }}">
                    <img src="{{ asset('icons/Icon local shipping.svg') }}" alt="Shipping Icon">
                </a>
            </div>
        </div>
    </div>
    <div class="row row-content" id="main-content">
        <div class="col-12 overview">
            <div class="row">
                <div class="col-12">
                    <h4>Overview</h4>
                </div>
            </div>
            <div class="row overview-r2">
                <div class="col-6 incos-col">
                    <img src="{{ asset('icons/Icon chart line.svg') }}" alt="Chart Icon">
                    <div class="or2c1">
                        <h4>Income</h4>
                        <h1>Rp {{ number_format($totalIncome, 0, ',', '.') }}</h1>
                    </div>
                </div>
                <div class="col-6 incos-col">
                    <img src="{{ asset('icons/Icon people.svg') }}" alt="Customers Icon">
                    <div class="or2c1">
                        <h4>Customers</h4>
                        <h1>{{ number_format($customerCount, 0, ',', '.') }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-content" id="chart">
        <div class="col-12 col-chart1">
            <canvas id="salesChart" width="400" height="200"></canvas>
        </div>
    </div>
</div>
{{-- End of Content --}}
<script>
    window.salesData = @json($salesData);
</script>
<script src="{{ asset('js/salesChart.js') }}"></script>
@endsection