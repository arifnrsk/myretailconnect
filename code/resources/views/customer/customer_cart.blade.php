@push('styles_customer_cart')
<link rel="stylesheet" href="{{ asset('css/customer_cart.css') }}">
@endpush

@extends('customer.layouts.customer_master')

@section('content')
{{-- Content --}}

<div class="review-content">

    <div class="row review-title">
        <div class="col-12 review-h1-title">
            <h1>Cart</h1>
        </div>
    </div>

    <div class="rmc-flex">
        <div class="row review-main-content">

            <div class="container rcm-container mt-4">
                <form class="d-flex flex-column align-items-center" action="{{ route('cart.checkout') }}" method="POST" style="width: 100%">
                    @csrf
                    <div class="row mb-4 align-items-center" style="width: 95%; height: 100px; background-color: white; border-radius: 10px;">
                        <div class="col-6" style="text-align: center;">
                            <strong>Address <br> </strong>
                            <strong>{{ $customerInfo ? $customerInfo->address : 'No address provided' }}</strong>
                        </div>
                        <div class="col-6 d-flex flex-column align-items-center" style="text-align: center;">
                            <strong>Delivery Type <br> </strong>
                            <select name="delivery_type" class="form-select mt-2" style="width: 50%; border-radius: 10px;">
                                <option value="">Choose delivery type</option>
                                @foreach ($deliveryTypeInfo as $item)
                                    <option value="{{ $item->id }}" data-price="{{ $item->price }}">
                                        {{ $item->name }} - Rp {{ number_format($item->price, 2, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4 align-items-center" style="width: 95%; height: 45px; background-color: white; border-radius: 10px;">
                        <div class="col-12" style="text-align: center;">
                            <strong>Products</strong>
                        </div>
                    </div>
                    <!-- Add to cart loop -->
                    @if ($cartItems->isEmpty())
                    <div class="mb-3">
                        <strong>Empty cart</strong>
                    </div>
                    @endif
                    @foreach ($cartItems as $item)
                    <div class="row mb-4 align-items-center" style="width: 95%; height: 120px; background-color: white; border-radius: 10px;">
                        <div class="col-3">
                            <!-- Product image cart -->
                            <img src="{{ asset('storage/products/'.$item->product->images->first()->image_path) }}" alt="{{ $item->product->name }}" style="height: 100px; border-radius: 15px;">
                        </div>
                        <div class="col-3">
                            <!-- Product name cart -->
                            <strong>{{ $item->product->name }}</strong>
                        </div>
                        <div class="col-3">
                            <!-- Product price cart -->
                            Rp {{ number_format($item->product->price, 2, ',', '.') }}
                        </div>
                        <div class="col-1">
                            <!-- Product quantity -->
                            <input type="number" value="{{ $item->quantity }}" class="quantity-input" data-cart-item-id="{{ $item->id }}" data-product-id="{{ $item->product->id }}" data-product-price="{{ $item->product->price }}" style="width: 50px; text-align: center; border: 1px solid #212529;border-radius: 10px;">
                        </div>
                        <div class="col-2">
                            <button type="button" onclick="deleteCartItem('{{ $item->id }}')" class="delete-cart-btn">Delete</button>
                        </div>
                        <input type="hidden" name="cart_items[{{ $item->id }}][product_id]" value="{{ $item->product->id }}">
                        <input type="hidden" name="cart_items[{{ $item->id }}][quantity]" value="{{ $item->quantity }}">
                    </div>
                    @endforeach
                    <div class="row d-flex align-items-center mb-4" style="width: 55%">
                        <div class="col-6 text-center">
                            <strong>Total Amount: <span id="total-amount">Rp 0</span></strong>
                        </div>                    
                        <div class="col-6">
                            <input type="hidden" id="delivery_price" name="delivery_price" value="">
                            <button id="checkout-btn" type="submit" class="checkout-btn">
                                Checkout
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>

{{-- End of Content --}}
<script>
    function deleteCartItem(id) {
        if(confirm('Are you sure you want to delete this item?')) {
            fetch(`/customer/cart/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    console.log('Item deleted');
                    window.location.reload();
                } else {
                    console.error('Failed to delete item');
                }
            });
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        // Fungsi untuk memperbarui total
        function updateTotal() {
            let total = 0;
            document.querySelectorAll('.quantity-input').forEach(input => {
                const price = parseFloat(input.dataset.productPrice);
                const quantity = parseInt(input.value);
                total += price * quantity;
            });
            var formattedPrice = total.toLocaleString("id-ID", { style: "currency", currency: "IDR" });
            document.getElementById('total-amount').textContent = formattedPrice;
        }
        
        // Event listener untuk perubahan kuantitas dan update database
        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('change', function() {
                const cartItemId = input.dataset.cartItemId;
                const quantity = input.value;
    
                // Update database dengan AJAX
                fetch('/customer/cart/update-quantity', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Mengambil CSRF token
                    },
                    body: JSON.stringify({ cart_item_id: cartItemId, quantity: quantity })
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        console.log(data.message);
                        updateTotal();
                    } else {
                        console.error(data.message);
                    }
                });
    
                updateTotal();
            });
        });
    
        updateTotal();

        var deliveryTypeSelect = document.querySelector('.form-select');
        var deliveryPriceInput = document.querySelector('#delivery_price');

        // Event listener untuk mengubah delivery price ketika delivery type berubah
        deliveryTypeSelect.addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var price = selectedOption.getAttribute('data-price');
            deliveryPriceInput.value = price; // Set delivery price input dengan harga yang terpilih
        });

        // ---
        var deliveryTypeSelect = document.querySelector('.form-select');
        var checkoutButton = document.querySelector('#checkout-btn');

        // Fungsi untuk memeriksa dan mengubah status tombol checkout
        function toggleCheckoutButton() {
            if (deliveryTypeSelect.value) {
                checkoutButton.disabled = false;
                checkoutButton.style.backgroundColor = ''; // Warna default
            } else {
                checkoutButton.disabled = true;
                checkoutButton.style.backgroundColor = 'gray'; // Warna abu-abu
            }
        }

        // Event listener untuk perubahan pada select delivery type
        deliveryTypeSelect.addEventListener('change', toggleCheckoutButton);

        toggleCheckoutButton();

    });
</script>
@endsection