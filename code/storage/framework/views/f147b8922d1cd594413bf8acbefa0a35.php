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
    <title>Welcome Admin!</title>
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
                    Make your retail store go online!
                </p>
            </div>
            <div class="col-6 d-flex flex-column align-items-center justify-content-center">
                <h2 class="mb-3" style="font-weight: bold">
                    Log in
                </h2>
                <form class="login-form" method="POST" action="<?php echo e(route('admin.login')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3 d-flex flex-column align-items-center">
                        <label for="email" class="form-label" style="width: 60%">Email</label>
                        <input name="email" type="email" id="email" class="form-control" placeholder="Enter admin email" required>
                    </div>
                    <div class="mb-3 d-flex flex-column align-items-center">
                        <label for="inputPassword5" class="form-label" style="width: 60%">Password</label>
                        <div class="position-relative" style="width: 60%">
                            <input type="password" id="inputPassword5" name="password" class="form-control" aria-describedby="passwordHelpBlock" required style="width: 100%">
                            <button type="button" class="btn position-absolute end-0" onclick="togglePasswordVisibility('inputPassword5', 'toggleLoginPasswordIcon')" style="top: 50%; transform: translateY(-50%);">
                                <img src="<?php echo e(asset('icons/Icon eye close.svg')); ?>" id="toggleLoginPasswordIcon" alt="Toggle Password">
                            </button>
                        </div>
                        <div id="passwordHelpBlock" class="form-text" style="width: 60%">
                            Your password must be 8-20 characters long, contain letters, special characters, and numbers, and must not contain spaces or emoji.
                        </div>
                    </div>                    
                    <div class="col-auto d-flex flex-column align-items-center">
                        <button type="submit" class="login-type-btn">
                            Log In
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
    function togglePasswordVisibility(passwordInputId, toggleIconId) {
        var passwordInput = document.getElementById(passwordInputId);
        var toggleIcon = document.getElementById(toggleIconId);
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.src = "<?php echo e(asset('icons/Icon eye open.svg')); ?>";
        } else {
            passwordInput.type = "password";
            toggleIcon.src = "<?php echo e(asset('icons/Icon eye close.svg')); ?>";
        }
    }
</script>
</html><?php /**PATH C:\Users\AcerP\Documents\Kuliah\SMT5\Web Programming\2\fix adminside\adminside\resources\views/login.blade.php ENDPATH**/ ?>