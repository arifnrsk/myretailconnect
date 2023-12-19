@push('styles_profile')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush

@extends('customer.layouts.customer_master')

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
                        <a href="{{ url('customer/profile') }}">
                            <strong>Personal Information</strong>
                        </a>
                    </div>
                </div>
                <div class="row mb-3" style="width: 95%;">
                    <div class="col-6 d-flex flex-column align-items-center justify-content-center">
                        <div>
                            {{-- Profile picture from database --}}
                            @if($customer && $customer->profile_picture_path)
                                <img src="{{ asset('storage/customer/' . $customer->profile_picture_path) }}" alt="Profile Picture" class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                            @else
                                {{-- Default image if customer doesn't have profile picture --}}
                                <img src="{{ asset('customer/1.png') }}" alt="Default Profile Picture" class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                            @endif
                        </div>
                        <div class="col-2" style="width: 50%;">
                            <div class="col-3 d-flex flex-column align-items-center w-100">
                                <form action="{{ route('customer.updateProfilePicture') }}" method="POST" enctype="multipart/form-data" id="profilePictureForm" style="width: 70%">
                                    @csrf
                                    <input type="file" name="profile_picture" accept="image/*" id="profilePictureInput" style="display: none;" onchange="this.form.submit()">
                                    <button type="button" class="edit-profile-btn mt-3 mb-3" onclick="document.getElementById('profilePictureInput').click();">
                                        Edit Profile Picture
                                    </button>
                                </form>
                                <form id="logoutForm" action="{{ route('customer.logout') }}" method="POST" style="width: 70%;">
                                    @csrf
                                    <button class="logout-profile-btn" onclick="document.getElementById('logoutForm').submit();">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        {{-- Forms --}}
                        <form class="profile-form" action="{{ route('customer.updateProfile') }}" method="POST" style="width: 70%;">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input name="name" type="text" id="name" class="form-control" value="{{ $customer->name ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input name="email" type="email" id="email" class="form-control" value="{{ $customer->email ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input name="phone_number" type="text" id="phone_number" class="form-control" value="{{ $customer->phone_number ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input name="address" type="textarea" id="address" class="form-control" value="{{ $customer->address ?? '' }}">
                            </div>
                            <div class="mb-3 position-relative">
                                <label for="password" class="form-label">Password</label>
                                <input name="password" type="password" id="password" class="form-control">
                                <button type="button" class="btn position-absolute end-0" onclick="togglePasswordVisibility()" style="top: 73%; transform: translateY(-50%);">
                                    <img src="{{ asset('icons/Icon eye close.svg') }}" id="togglePasswordIcon" alt="Toggle Password">
                                </button>
                            </div>
                            <div id="passwordHelpBlock" class="form-text mb-3" style="width: 100%">
                                Your password must be 8-20 characters long and contain letters, numbers, and special characters. It must not include spaces or emojis. If these requirements are not met, the password will not be updated.
                            </div>
                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <input name="gender" type="text" id="gender" class="form-control" value="{{ $customer->gender ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label for="birth_date" class="form-label">Birth Date</label>
                                <input type="text" id="birth_date" class="form-control" value="{{ $customer->birth_date->format('d/m/Y') ?? '' }}" readonly>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="save-profile-btn">
                                        Save
                                </button>
                            </div>
                        </form>
                        @if($errors->any())
                            <div class="alert alert-danger mt-3" style="width: 60%;">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- End of Content --}}
<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById('password');
        var toggleIcon = document.getElementById('togglePasswordIcon');
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.src = "{{ asset('icons/Icon eye open.svg') }}";
        } else {
            passwordInput.type = "password";
            toggleIcon.src = "{{ asset('icons/Icon eye close.svg') }}";
        }
    }

    function formatPhoneNumber(phoneNumber) {
    var cleaned = ('' + phoneNumber).replace(/\D/g, '');
    var match = cleaned.match(/^(\d{2})(\d{3})(\d{4})(\d{4})$/);
    if (match) {
        return '+' + match[1] + ' ' + match[2] + '-' + match[3] + '-' + match[4];
    }
    return null;
    }

    window.onload = function() {
        var input = document.getElementById('phone_number');
        input.value = formatPhoneNumber(input.value);

        input.addEventListener('input', function (e) {
            var x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,3})(\d{0,4})(\d{0,4})/);
            e.target.value = !x[2] ? x[1] : '+' + x[1] + ' ' + x[2] + (x[3] ? '-' + x[3] : '') + (x[4] ? '-' + x[4] : '');
        });
    };

</script>
@endsection