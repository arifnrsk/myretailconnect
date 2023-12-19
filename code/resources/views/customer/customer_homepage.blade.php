@push('styles_customer_homepage')
<link rel="stylesheet" href="{{ asset('css/customer_homepage.css') }}">
@endpush

@extends('customer.layouts.customer_master')

@section('content')
{{-- Content --}}
<div class="list-product-content">
    <div class="row m-3">
        <div class="col-12 d-flex align-items-center list-product-col">
            <div class="filter-category">
                <select class="form-select filter-select" id="categoryFilter">
                    <option value="" {{ $selectedCategory === '' ? 'selected' : '' }}>All Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $selectedCategory == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <button class="sort-btn">
                <img src="{{ asset('icons/Icon sort.svg') }}" alt="Sort Icon">
            </button>
        </div>
    </div>

    <div class="row m-3 products-row">
        <div class="col-12 products-col d-flex flex-wrap">
            @if ($products->isEmpty())
                <div class="mb-3">
                    <strong>No Data</strong>
                </div>
            @endif
            @foreach ($products as $product)
                <div class="card rounded-3 content" style="width: 22%; margin: 15px 1vw;">
                    <a href="{{ route('customer.product.detail', $product->id) }}">
                        <img class="card-img-top px-3 pt-3" src="{{ asset('storage/products/'.$product->images->first()->image_path) }}" alt="{{ $product->name }}" style="border-radius: 25px; width: 100%; height: 200px">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $product->name }}</h5>
                            <div class="card-content d-flex">
                                <p class="card-text card-price border border-dark rounded-3 p-1" style="margin-bottom: 0">Rp {{ number_format($product->price, 2, ',', '.') }}</p>
                                <p class="card-text card-stock ms-3 border border-dark rounded-3 p-1">{{ $product->stock }} pcs</p>
                            </div>
                        </div>
                    </a>
                    <div class="mb-3 d-flex justify-content-center" style="width: 100%">
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" style="width: 80%;">
                            @csrf
                            <button type="submit" class="add-to-cart-btn">
                                Add to cart
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
{{-- End of Content --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var url = new URL(window.location);
        url.searchParams.delete('search');
        window.history.replaceState(null, null, url);

        var categoryFilter = document.getElementById('categoryFilter');
        var sortButton = document.querySelector('.sort-btn');
        var searchInput = document.querySelector('.search-input');

        categoryFilter.addEventListener('change', function() {
            updateURL('category', this.value);
        });

        sortButton.addEventListener('click', function() {
            var currentSortOrder = new URLSearchParams(window.location.search).get('sort') || 'asc';
            var newSortOrder = currentSortOrder === 'asc' ? 'desc' : 'asc';
            updateURL('sort', newSortOrder);
        });

        searchInput.addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                updateURL('search', this.value.trim());
            }
        });

        function updateURL(key, value) {
            var searchParams = new URLSearchParams(window.location.search);
            searchParams.set(key, value);

            if (key === 'category' && !value) {
                searchParams.delete('category');
            }

            if (key === 'search' && !value) {
                searchParams.delete('search');
            }

            window.location.search = searchParams.toString();
        }
    });
</script>
@endsection