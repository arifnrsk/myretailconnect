@push('styles_product_detail')
<link rel="stylesheet" href="{{ asset('css/product_detail.css') }}">
@endpush

@extends('layouts.master')

@section('content')
    <div class="row review-title">
        <div class="col-12 review-h1-title">
            <h1>Product Detail</h1>
        </div>
    </div>

    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="background: none; border: none;">
                        <span aria-hidden="true"><img src="{{ asset('icons/Icon close.svg') }}" alt="Close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this product?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="rmc-flex">
        <div class="row review-main-content">
            <div class="row mt-4 mb-3" style="background-color: white; width: 95%; border-radius: 10px;">
                <a class="mt-3" href="{{ url('/list-product') }}">
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
                    <div class="w-100">
                        <form id="deleteForm" action="{{ route('product.delete', $product->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        <button type="button" class="cancel-delivery-btn" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                            Delete
                        </button>                  
                        <a href="{{ route('edit.product', $product->id) }}">
                            <button class="detail-delivery-btn">
                                Edit
                            </button>
                        </a>
                    </div>
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
<script>
    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        document.getElementById('deleteForm').submit();
    });
</script>
@endsection