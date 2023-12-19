@push('styles_product_detail')
<link rel="stylesheet" href="{{ asset('css/product_detail.css') }}">
@endpush

@extends('customer.layouts.customer_master')

@section('content')
    <div class="row review-title">
        <div class="col-12 review-h1-title">
            <h1>Product Detail</h1>
        </div>
    </div>

    <div class="rmc-flex">
        <div class="row review-main-content">
            <div class="row mt-4 mb-3" style="background-color: white; width: 95%; border-radius: 10px;">
                <a class="mt-3" href="{{ url('customer/home') }}">
                    <img src="{{ asset('icons/Icon arrow left.svg') }}" alt="Back">
                </a>
                <div class="col-6 d-flex justify-content-center mt-4 mb-5" style="width: 50%">
                    <img src="{{ asset('storage/products/' . $product->images->first()->image_path) }}" alt="{{ $product->name }}" style="box-shadow: 0px 0px 7px 0px rgba(0, 0, 0, 0.5); border-radius: 10px; width: 50%; height: 200px">
                </div>
                <div class="col-6 mt-4 mb-5">
                    <strong style="font-size: 28px">{{ $product->name }}</strong>
                    <p><br></p>
                    <p><strong>Product Description</strong> <br> {{ $product->description }}</p>
                    <p>Rp {{ number_format($product->price, 2, ',', '.') }} | Stock {{ $product->stock }} pcs</p>
                </div>
            </div>

            <div class="row">
                <h3 class="mt-3" style="font-weight: bold">Review</h3>
                <div class="container rcm-container mt-3">
                    <div class="row mb-4 align-items-center" style="width: 95%; height: 50px; background-color: white; border-radius: 10px;">
                        <div class="col-2">
                            <strong>User name</strong>
                        </div>
                        <div class="col-3">
                            <strong>Review date</strong>
                        </div>
                        <div class="col-2">
                            <strong>Ratings</strong>
                        </div>
                        <div class="col-5">
                            <strong>Comment</strong>
                        </div>
                    </div>
                    
                    <!-- Review cards loop -->
                    @forelse ($product->reviews as $review)
                    <div class="row mb-4 align-items-center" style="width: 95%; height: 50px; background-color: white; border-radius: 10px;">
                        <div class="col-2">
                            <!-- User name review product detail -->
                            {{ $review->customer->name }}
                        </div>
                        <div class="col-3">
                            <!-- Review date product detail -->
                            {{ $review->review_date->format('M d, Y') }}
                        </div>
                        <div class="col-2">
                            <!-- Ratings product detail -->
                            {{ $review->ratings }}
                        </div>
                        <div class="col-5">
                            <!-- Comment product detail -->
                            {{ $review->comment }}
                        </div>
                    </div>
                    @empty
                        <div class="row">
                            <p>No reviews yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
{{-- End of Content --}}
@endsection