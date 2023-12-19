<?php $__env->startPush('styles_profile'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/profile.css')); ?>">
<?php $__env->stopPush(); ?>



<?php $__env->startSection('content'); ?>


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
                        <a href="<?php echo e(url('/profile')); ?>">
                            <strong>Personal Information</strong>
                        </a>
                    </div>
                    <div class="col-1">
                        <a href="<?php echo e(url('/profile-delivery')); ?>">
                        <strong>Delivery</strong>
                        </a>
                    </div>
                    <div class="col-1">
                        <a href="<?php echo e(url('/profile-courier')); ?>">
                        <strong>Courier</strong>
                        </a>
                    </div>
                    <div class="col-8">
                        <a href="<?php echo e(url('/profile-payment')); ?>">
                        <strong>Payment</strong>
                        </a>
                    </div>
                </div>
                <div class="row mb-3" style="width: 95%;">
                    <div class="col-6 d-flex flex-column align-items-center justify-content-center">
                        <div>
                            
                            <?php if($admin && $admin->profile_picture_path): ?>
                                <img src="<?php echo e(asset('storage/admin/' . $admin->profile_picture_path)); ?>" alt="Profile Picture" class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                            <?php else: ?>
                                
                                <img src="<?php echo e(asset('admin/default-profile-picture.jpg')); ?>" alt="Default Profile Picture" class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                            <?php endif; ?>
                        </div>
                        <div class="col-2" style="width: 50%;">
                            <div class="col-3 d-flex flex-column align-items-center w-100">
                                <form action="<?php echo e(route('admin.updateProfilePicture')); ?>" method="POST" enctype="multipart/form-data" id="profilePictureForm" style="width: 70%">
                                    <?php echo csrf_field(); ?>
                                    <input type="file" name="profile_picture" accept="image/*" id="profilePictureInput" style="display: none;" onchange="this.form.submit()">
                                    <button type="button" class="edit-profile-btn mt-3 mb-3" onclick="document.getElementById('profilePictureInput').click();">
                                        Edit Profile Picture
                                    </button>
                                </form>
                                <form id="logoutForm" action="<?php echo e(route('admin.logout')); ?>" method="POST" style="width: 70%;">
                                    <?php echo csrf_field(); ?>
                                    <button class="logout-profile-btn" onclick="document.getElementById('logoutForm').submit();">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        
                        <form class="profile-form" action="<?php echo e(route('admin.updateProfile')); ?>" method="POST" style="width: 70%;">
                            <?php echo csrf_field(); ?>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input name="name" type="text" id="name" class="form-control" value="<?php echo e($admin->name ?? ''); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input name="email" type="email" id="email" class="form-control" value="<?php echo e($admin->email ?? ''); ?>">
                            </div>
                            <div class="mb-3 position-relative">
                                <label for="password" class="form-label">Password</label>
                                <input name="password" type="password" id="password" class="form-control">
                                <button type="button" class="btn position-absolute end-0" onclick="togglePasswordVisibility()" style="top: 73%; transform: translateY(-50%);">
                                    <img src="<?php echo e(asset('icons/Icon eye close.svg')); ?>" id="togglePasswordIcon" alt="Toggle Password">
                                </button>
                            </div>
                            <div id="passwordHelpBlock" class="form-text mb-3" style="width: 100%">
                                Your password must be 8-20 characters long and contain letters, numbers, and special characters. It must not include spaces or emojis. If these requirements are not met, the password will not be updated.
                            </div>
                            <div class="mb-3">
                                <label for="birth_date" class="form-label">Birth Date</label>
                                <input type="text" id="birth_date" class="form-control" value="<?php echo e($admin->birth_date->format('d/m/Y') ?? ''); ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="save-profile-btn">
                                        Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById('password');
        var toggleIcon = document.getElementById('togglePasswordIcon');
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.src = "<?php echo e(asset('icons/Icon eye open.svg')); ?>";
        } else {
            passwordInput.type = "password";
            toggleIcon.src = "<?php echo e(asset('icons/Icon eye close.svg')); ?>";
        }
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\AcerP\Documents\Kuliah\SMT5\Web Programming\2\fix adminside\adminside\resources\views/profile.blade.php ENDPATH**/ ?>