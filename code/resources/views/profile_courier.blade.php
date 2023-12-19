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
                        <div class="row mb-4 align-items-center" style="width: 80%; height: 50px; background-color: white; border-radius: 10px;">
                            <div class="col-4">
                                <strong>Name</strong>
                            </div>
                            <div class="col-8">
                                <strong>Phone</strong>
                            </div>
                        </div>
                        <!-- Delivery type loop -->
                        @if ($couriers->isEmpty())
                        <div class="mb-3">
                            <strong>No Data</strong>
                        </div>
                        @else
                        @foreach ($couriers as $courier)
                        <div class="row mb-4 align-items-center" style="width: 80%; height: 70px; background-color: white; border-radius: 10px;">
                            <div class="col-4">
                                <!-- Delivery type name -->
                                {{ $courier->name }}
                            </div>
                            <div class="col-6">
                                <!-- Delivery type price -->
                                {{ $courier->phone_number }}
                            </div>
                            <div class="col-2">
                                <button class="cancel-delivery-btn mb-2" data-id="{{ $courier->id }}">
                                    <img src="{{ asset('icons/Icon trash.svg') }}" alt="">
                                </button>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <div class="col-6 mb-3">
                        {{-- Forms --}}
                        <form class="profile-form" style="width: 100%" action="{{ route('couriers.store') }}" method="POST">
                            @csrf
                            <div class="mb-3" style="width: 60%;">
                                <strong><label for="name" class="form-label">Name</label></strong>
                                <input name="name" type="text" id="name" class="form-control" placeholder="Input courier name">
                            </div>
                            <div class="mb-3" style="width: 60%;">
                                <strong><label for="birth_date" class="form-label">Birth Date</label></strong>
                                <input name="birth_date" type="date" id="birth_date" class="form-control">
                            </div>
                            <div class="mb-3" style="width: 60%;">
                                <strong><label for="address" class="form-label">Address</label></strong>
                                <input name="address" type="textarea" id="address" class="form-control" placeholder="Input courier address">
                            </div>
                            <div class="mb-3" style="width: 60%;">
                                <strong><label for="phone_number" class="form-label">Phone Number</label></strong>
                                {{-- <input name="phone_number" type="textarea" id="phone_number" class="form-control" placeholder="Input courier phone number"> --}}
                                <input name="phone_number" type="text" id="phone_number" class="form-control" placeholder="Example: 6287887654321" required>
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
    document.querySelectorAll('.cancel-delivery-btn').forEach(button => {
        button.addEventListener('click', function() {
            const typeId = this.dataset.id;
            if(confirm('Are you sure you want to delete this courier information?')) {
                fetch(`/profile-courier/${typeId}`, {
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

    document.getElementById('phone_number').addEventListener('input', function (e) {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,3})(\d{0,4})(\d{0,4})/);
        e.target.value = !x[2] ? x[1] : '+' + x[1] + ' ' + x[2] + (x[3] ? '-' + x[3] : '') + (x[4] ? '-' + x[4] : '');
    });
</script>
@endsection