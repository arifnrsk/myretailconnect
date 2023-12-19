<?php $__env->startPush('styles_profile_delivery'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/profile_delivery.css')); ?>">
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
                        <?php if($couriers->isEmpty()): ?>
                        <div class="mb-3">
                            <strong>No Data</strong>
                        </div>
                        <?php else: ?>
                        <?php $__currentLoopData = $couriers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $courier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row mb-4 align-items-center" style="width: 80%; height: 70px; background-color: white; border-radius: 10px;">
                            <div class="col-4">
                                <!-- Delivery type name -->
                                <?php echo e($courier->name); ?>

                            </div>
                            <div class="col-6">
                                <!-- Delivery type price -->
                                <?php echo e($courier->phone_number); ?>

                            </div>
                            <div class="col-2">
                                <button class="cancel-delivery-btn mb-2" data-id="<?php echo e($courier->id); ?>">
                                    <img src="<?php echo e(asset('icons/Icon trash.svg')); ?>" alt="">
                                </button>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                    <div class="col-6 mb-3">
                        
                        <form class="profile-form" style="width: 100%" action="<?php echo e(route('couriers.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
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
                                <input name="phone_number" type="textarea" id="phone_number" class="form-control" placeholder="Input courier phone number">
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
                        window.location.reload(); // Reload halaman
                    } else {
                        alert('Error occurred while deleting the delivery type');
                    }
                });
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\AcerP\Documents\Kuliah\SMT5\Web Programming\2\adminside\resources\views/profile_courier.blade.php ENDPATH**/ ?>