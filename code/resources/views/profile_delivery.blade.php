@push('styles_profile_delivery')
<link rel="stylesheet" href="{{ asset('css/profile_delivery.css') }}">
@endpush

@extends('layouts.master')

@section('content')
{{-- Content --}}

<div class="review-content">

    <div class="row review-title">
        <div class="col-12 review-h1-title">
            <h1>Profile</h1>
        </div>
    </div>

    <div class="rmc-flex">
        <div class="row review-main-content">
            <div class="container rcm-container mt-4">
                <div class="row mb-4 align-items-center" style="width: 95%; height: 50px; background-color: white; border-radius: 10px;">
                    <div class="col-2">
                        <a href="{{ url('/profile') }}">
                            <strong>Personal Information</strong>
                        </a>
                    </div>
                    <div class="col-1">
                        <a href="{{ url('/profile-delivery') }}">
                        <strong>Delivery</strong>
                        </a>
                    </div>
                    <div class="col-1">
                        <a href="{{ url('/profile-courier') }}">
                        <strong>Courier</strong>
                        </a>
                    </div>
                    <div class="col-8">
                        <a href="{{ url('/profile-payment') }}">
                        <strong>Payment</strong>
                        </a>
                    </div>
                </div>
                <div class="row mb-3" style="width: 95%;">
                    <div class="col-6 d-flex flex-column align-items-center">
                        <div class="row mb-4 align-items-center" style="width: 60%; height: 50px; background-color: white; border-radius: 10px;">
                            <div class="col-4">
                                <strong>Delivery Type</strong>
                            </div>
                            <div class="col-8">
                                <strong>Price</strong>
                            </div>
                        </div>
                        <!-- Delivery type loop -->
                        @if ($types->isEmpty())
                        <div class="mb-3">
                            <strong>No Data</strong>
                        </div>
                        @else
                        @foreach ($types as $type)
                        <div class="row mb-4 align-items-center" style="width: 60%; height: 70px; background-color: white; border-radius: 10px;">
                            <div class="col-4">
                                <!-- Delivery type name -->
                                {{ $type->name }}
                            </div>
                            <div class="col-4">
                                <!-- Delivery type price -->
                                Rp {{ number_format($type->price , 2, ',', '.') }}
                            </div>
                            <div class="col-4">
                                <button class="cancel-delivery-btn mb-2" data-id="{{ $type->id }}">
                                    <img src="{{ asset('icons/Icon trash.svg') }}" alt="">
                                </button>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <div class="col-6 mb-3">
                        {{-- Forms --}}
                        <form class="profile-form" style="width: 100%" action="{{ route('delivery_types.store') }}" method="POST">
                            @csrf
                            <div class="mb-3" style="width: 60%;">
                                <strong><label for="address" class="form-label">Retail Address</label></strong>
                                <input type="textarea" id="address" class="form-control" value="{{ $currentAddress }}">
                            </div>
                            <div class="mb-3" style="border-top: 1px solid #6c757d; width: 60%;">
                                <strong><label for="delivery_method" class="form-label mt-3">Delivery Method</label></strong>
                                <input name="name" type="text" id="delivery_method" class="form-control" placeholder="Enter your available delivery method">
                            </div>
                            <div class="mb-3" style="width: 60%;">
                                <strong><label for="price" class="form-label">Price per 1KM</label></strong>
                                <input name="price" type="number" id="price" class="form-control" placeholder="0">
                            </div>
                            <button type="submit" class="save-delivery-type-btn">
                                Save
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- End of Content --}}
<script>
    document.getElementById('address').addEventListener('blur', function() {
        const address = this.value;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('/update-retail-address', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken // Menggunakan CSRF token dari tag meta
            },
            body: JSON.stringify({ address: address })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if(data.success) {
                console.log('Address updated');
            } else {
                console.error('Failed to update address');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    document.querySelectorAll('.cancel-delivery-btn').forEach(button => {
        button.addEventListener('click', function() {
            const typeId = this.dataset.id;
            if(confirm('Are you sure you want to delete this delivery type?')) {
                fetch(`/delivery-types/${typeId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                })
                .then(response => {
                    if(response.ok) {
                        window.location.reload();
                    } else {
                        alert('Error occurred while deleting the delivery type');
                    }
                });
            }
        });
    });
</script>
@endsection