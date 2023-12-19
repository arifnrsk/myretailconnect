<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?php echo e(asset('css/login.css')); ?>">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Welcome!</title>
</head>
<body>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 d-flex flex-column align-items-center justify-content-center" style="height: 100vh; background-color: #f0f0f0;">
                <img src="<?php echo e(asset('assets/Login asset.svg')); ?>" alt="Login Image" style="width: 400px">
                <h1 style="font-weight: bold">
                    My Retail Connect
                </h1>
                <p>
                    Shop Easier, Faster, and More Conveniently!
                </p>
            </div>
            <div class="col-6 d-flex flex-column align-items-center justify-content-center">
                <h2 class="mb-3" style="font-weight: bold">
                    Sign Up
                </h2>
                <form class="signup-form" method="POST" action="<?php echo e(route('customer.signup')); ?>" style="width: 60%;">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3 d-flex flex-column align-items-center">
                        <label for="name" class="form-label" style="width: 100%">Name</label>
                        <input name="name" type="text" id="name" class="form-control" placeholder="Enter your name" required>
                    </div>
                    <div class="mb-3 d-flex flex-column align-items-center">
                        <label for="birth_date" class="form-label" style="width: 100%">Birth Date</label>
                        <input name="birth_date" type="date" id="birth_date" class="form-control" placeholder="Enter your birth date" required>
                    </div>
                    <div class="mb-3 d-flex flex-column align-items-center">
                        <label for="address" class="form-label" style="width: 100%">Address</label>
                        <input name="address" type="textarea" id="address" class="form-control" placeholder="Enter your address" required>
                    </div>
                    <div class="mb-3 d-flex flex-column align-items-center">
                        <label for="email" class="form-label" style="width: 100%">Email</label>
                        <input name="email" type="email" id="email" class="form-control" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3 d-flex flex-column align-items-center">
                        <label for="phone_number" class="form-label" style="width: 100%">Phone number</label>
                        <input name="phone_number" type="text" id="phone_number" class="form-control" placeholder="Example: 6287887654321" required>
                    </div>                    
                    <div class="mb-3 d-flex flex-column align-items-center">
                        <label for="gender" class="form-label" style="width: 100%">Gender</label>
                        <select name="gender" id="gender" class="form-control" required>
                            <option value="">Select your gender</option>
                            <option value="female">Female</option>
                            <option value="male">Male</option>
                        </select>
                    </div>
                    <div class="mb-3 d-flex flex-column align-items-center">
                        <label for="inputPassword5" class="form-label" style="width: 100%">Password</label>
                        <input type="password" id="inputPassword5" name="password" class="form-control" aria-describedby="passwordHelpBlock" required>
                        <div id="passwordHelpBlock" class="form-text" style="width: 100%">
                            Your password must be 8-20 characters long, contain letters,  special characters, and numbers, and must not contain spaces or emoji.
                        </div>
                    </div>
                    <div class="col-auto d-flex flex-column align-items-center">
                        <button type="submit" class="login-type-btn">
                            Sign Up
                        </button>
                    </div>
                </form>
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger mt-3" style="width: 60%;">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

</body>
<script>
    document.getElementById('phone_number').addEventListener('input', function (e) {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,3})(\d{0,4})(\d{0,4})/);
        e.target.value = !x[2] ? x[1] : '+' + x[1] + ' ' + x[2] + (x[3] ? '-' + x[3] : '') + (x[4] ? '-' + x[4] : '');
    });
</script>
</html><?php /**PATH C:\Users\AcerP\Documents\Kuliah\SMT5\Web Programming\2\adminside\resources\views/customer/customer_signup.blade.php ENDPATH**/ ?>