<?php $__env->startPush('styles_return_and_refund'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/return_and_refund.css')); ?>">
<?php $__env->stopPush(); ?>



<?php $__env->startSection('content'); ?>


<div class="review-content">

    <div class="row review-title">
        <div class="col-12 review-h1-title">
            <h1>Return and Refund</h1>
        </div>
    </div>

    <div class="rmc-flex">
        <div class="row review-main-content">
            <div class="row rmc-first-row">
                <div class="col-12 rmc-first-col mt-3 ms-4">
                    <div class="col-search col-search-review">
                        <div class="search-bar-delivery">
                            <img src="<?php echo e(asset('icons/Icon search.svg')); ?>" alt="Search Icon" class="search-icon">
                            <input type="text" placeholder="Search" class="search-input-delivery">
                        </div>
                    </div>
                </div>
            </div>

            <div class="container rcm-container mt-4">
                <div class="row mb-4 align-items-center" style="width: 95%; height: 50px; background-color: white; border-radius: 10px;">
                    <div class="col-2 d-flex justify-content-center">
                        <strong>Transaction ID</strong>
                    </div>
                    <div class="col-2">
                        <strong>Name</strong>
                    </div>
                    <div class="col-2">
                        <strong>Date</strong>
                    </div>
                    <div class="col-1">
                        <strong>Status</strong>
                    </div>
                    <div class="col-5">
                        <strong>Reason</strong>
                    </div>
                </div>
                <!-- Return and Refund loop -->
                <?php if($returnsAndRefunds->isEmpty()): ?>
                <div class="mb-3">
                    <strong>No Data</strong>
                </div>
                <?php else: ?>
                <?php $__currentLoopData = $returnsAndRefunds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $returnAndRefund): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row mb-4 align-items-center" style="width: 95%; height: 120px; background-color: white; border-radius: 10px;">
                    <div class="col-2 d-flex justify-content-center">
                        <!-- Transaction ID -->
                        <?php echo e($returnAndRefund->transaction->id); ?>

                    </div>
                    <div class="col-2">
                        <!-- Customer Name -->
                        <?php echo e($returnAndRefund->transaction->customer->name); ?>

                    </div>
                    <div class="col-2">
                        <!-- Transaction date -->
                        <?php echo e($returnAndRefund->transaction->transaction_date->format('M d, Y')); ?> at <?php echo e($returnAndRefund->transaction->transaction_date->format('h:i A')); ?>

                    </div>
                    <div class="col-1">
                        <!-- Return and Refund status -->
                        <?php echo e($returnAndRefund->returnAndRefundStatus->name); ?>

                    </div>
                    <div class="col-3">
                        <!-- Reason -->
                        <div class="reason-text">
                            <?php echo e($returnAndRefund->reason); ?>

                        </div>
                    </div>
                    <div class="col-2">
                        <div class="col-3 d-flex flex-column align-items-center w-100">
                            <a href="<?php echo e(route('return_and_refund.detail', $returnAndRefund->id)); ?>" style="width: 70%;">
                                <button class="detail-delivery-btn">
                                    Detail
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var searchInput = document.querySelector('.search-input-delivery');

        // Listener untuk input pencarian
        searchInput.addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                var searchQuery = this.value.trim();
                updateURL('search', searchQuery);
            }
        });

        function updateURL(key, value) {
            var searchParams = new URLSearchParams(window.location.search);
            searchParams.set(key, value);
            window.location.search = searchParams.toString();
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\AcerP\Documents\Kuliah\SMT5\Web Programming\2\adminside\resources\views/return_and_refund.blade.php ENDPATH**/ ?>