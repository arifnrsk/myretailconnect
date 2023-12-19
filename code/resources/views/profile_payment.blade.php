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
                        <div class="row mb-4 align-items-center" style="width: 90%; height: 50px; background-color: white; border-radius: 10px;">
                            <div class="col-3">
                                <strong>Bank Name</strong>
                            </div>
                            <div class="col-3">
                                <strong>Account Name</strong>
                            </div>
                            <div class="col-4">
                                <strong>Account Number</strong>
                            </div>
                        </div>
                        <!-- Payment information loop -->
                        @if ($banks->isEmpty())
                        <div class="mb-3">
                            <strong>No Data</strong>
                        </div>
                        @else
                        @foreach ($banks as $bank)
                        <div class="row mb-4 align-items-center" style="width: 90%; height: 50px; background-color: white; border-radius: 10px;">
                            <div class="col-3">
                                <!-- Bank name -->
                                {{ $bank->bankName->name }}
                            </div>
                            <div class="col-3">
                                <!-- Account name -->
                                {{ $bank->account_name }}
                            </div>
                            <div class="col-4">
                                <!-- Account number -->
                                {{ $bank->account_number }}
                            </div>
                            <div class="col-2">
                                <button class="cancel-delivery-btn" data-id="{{ $bank->id }}">
                                    <img src="{{ asset('icons/Icon trash.svg') }}" alt="">
                                </button>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <div class="col-6 mb-3">
                        {{-- Forms --}}
                        <form class="profile-form" action="{{ route('payments.add') }}" method="POST" class="profile-form">
                            @csrf
                            <div class="mb-3">
                                <strong><label for="account_name" class="form-label">Account Name</label></strong>
                                <input name="account_name" type="text" id="account_name" class="form-control" placeholder="Enter your bank account name" style="width: 60%;">
                            </div>
                            <div class="mb-3">
                                <strong><label for="account_number" class="form-label">Account Number</label></strong>
                                <input name="account_number" type="number" id="account_number" class="form-control" placeholder="0" style="width: 60%;">
                            </div>
                            <div class="mb-3">
                                <strong><label for="bank_name" class="form-label">Bank Name</label></strong>
                                <select name="bank_name" id="bank_name" class="form-control" style="width: 60%; border-radius: 10px;">
                                    <option value="">Select a Bank</option>
                                    @foreach ($bankNames as $bankName)
                                        <option value="{{ $bankName->id }}">{{ $bankName->name }}</option>
                                    @endforeach
                                </select>
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
            const bankId = this.dataset.id;
            if(confirm('Are you sure you want to delete this bank information?')) {
                fetch(`/payment-banks/${bankId}`, {
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
                        alert('Error occurred while deleting the bank information');
                    }
                });
            }
        });
    });
</script>
@endsection