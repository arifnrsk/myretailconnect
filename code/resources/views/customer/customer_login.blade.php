<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Welcome!</title>
</head>
<body>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 d-flex flex-column align-items-center justify-content-center" style="height: 100vh; background-color: #f0f0f0;">
                <img src="{{ asset('assets/Login asset.svg') }}" alt="Login Image" style="width: 400px">
                <h1 style="font-weight: bold">
                    My Retail Connect
                </h1>
                <p>
                    Shop Easier, Faster, and More Conveniently!
                </p>
            </div>
            <div class="col-6 d-flex flex-column align-items-center justify-content-center">
                <h2 class="mb-3" style="font-weight: bold">
                    Log in
                </h2>
                <form class="login-form" method="POST" action="{{ route('customer.login') }}">
                    @csrf
                    <div class="mb-3 d-flex flex-column align-items-center">
                        <label for="email" class="form-label" style="width: 60%">Email</label>
                        <input name="email" type="email" id="email" class="form-control" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3 d-flex flex-column align-items-center">
                        <label for="inputPassword5" class="form-label" style="width: 60%">Password</label>
                        <div class="position-relative" style="width: 60%">
                            <input type="password" id="inputPassword5" name="password" class="form-control" aria-describedby="passwordHelpBlock" required style="width: 100%">
                            <button type="button" class="btn position-absolute end-0" onclick="togglePasswordVisibility('inputPassword5', 'toggleLoginPasswordIcon')" style="top: 50%; transform: translateY(-50%);">
                                <img src="{{ asset('icons/Icon eye close.svg') }}" id="toggleLoginPasswordIcon" alt="Toggle Password">
                            </button>
                        </div>
                        <div id="passwordHelpBlock" class="form-text" style="width: 60%">
                            Your password must be 8-20 characters long, contain letters,  special characters, and numbers, and must not contain spaces or emoji.
                        </div>
                    </div>
                    <div class="col-auto d-flex flex-column align-items-center">
                        <button type="submit" class="login-type-btn">
                            Log In
                        </button>
                    </div>
                </form>
                <p class="mt-3">Don't have an account? <a href="/customer/signup">Sign Up</a></p>
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

</body>
<script>
    function togglePasswordVisibility(passwordInputId, toggleIconId) {
        var passwordInput = document.getElementById(passwordInputId);
        var toggleIcon = document.getElementById(toggleIconId);
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.src = "{{ asset('icons/Icon eye open.svg') }}";
        } else {
            passwordInput.type = "password";
            toggleIcon.src = "{{ asset('icons/Icon eye close.svg') }}";
        }
    }
</script>
</html>