<?php $__env->startPush('styles_schedule_product'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/schedule_product.css')); ?>">
<?php $__env->stopPush(); ?>



<?php $__env->startSection('content'); ?>

<div class="schedule-content">

    <div class="row schedule-title">
        <div class="col-12 schedule-h1-title">
            <h1>Scheduled for</h1>
        </div>
    </div>

    <div class="smc-flex">
        <div class="row schedule-main-content">
            <div class="row smc-first-row">
                <div class="col-12 smc-first-col mt-3 ms-4">
                    <div class="col-search">
                        <div class="search-bar">
                            <img src="<?php echo e(asset('icons/Icon search.svg')); ?>" alt="Search Icon" class="search-icon">
                            <input type="text" placeholder="Search" class="search-input">
                        </div>
                    </div>
                    
                    <button class="sort-btn">
                        <img src="<?php echo e(asset('icons/Icon sort white.svg')); ?>" alt="Sort Icon">
                    </button>
                </div>
            </div>

            <div class="container scm-container">
                <div class="row mt-4 mb-4" style="width: 95%;">
                <?php $__currentLoopData = $scheduledProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $product->schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-12 mb-3">
                            <div class="card shadow-sm" style="border-radius: 15px;">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="col-9 flex-grow-1 ms-3">
                                            <h5 class="card-title"><?php echo e($product->name); ?></h5>
                                            <p class="card-text">
                                                Scheduled date: <?php echo e($schedule->scheduled_date->format('M d, Y')); ?> at <?php echo e($schedule->scheduled_date->format('h:i A')); ?>

                                            </p>
                                            <p class="card-text">Stock: <?php echo e($schedule->stock); ?></p>
                                        </div>
                                        <div class="col-3 ms-auto">
                                            <button class="cancel-product-btn">
                                                Cancel
                                            </button>
                                            <button class="publish-product-btn ms-3">
                                                Publish Now
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var searchInput = document.querySelector('.search-input');
        var sortButton = document.querySelector('.sort-btn');

        // Listener untuk input pencarian
        searchInput.addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                updateURL('search', this.value);
            }
        });

        // Listener untuk tombol sort
        sortButton.addEventListener('click', function() {
            var currentSortOrder = new URLSearchParams(window.location.search).get('sort') || 'asc';
            var newSortOrder = currentSortOrder === 'asc' ? 'desc' : 'asc';
            updateURL('sort', newSortOrder);
        });

        function updateURL(key, value) {
            var searchParams = new URLSearchParams(window.location.search);
            searchParams.set(key, value);
            window.location.search = searchParams.toString();
        }
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\AcerP\Documents\Kuliah\SMT5\Web Programming\2\adminside\resources\views/schedule_product.blade.php ENDPATH**/ ?>