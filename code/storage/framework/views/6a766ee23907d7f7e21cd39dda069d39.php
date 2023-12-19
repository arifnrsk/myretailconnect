<?php $__env->startPush('styles_review_product'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/review_product.css')); ?>">
<?php $__env->stopPush(); ?>



<?php $__env->startSection('content'); ?>


<div class="review-content">

    <div class="row review-title">
        <div class="col-12 review-h1-title">
            <h1>Product Reviews</h1>
        </div>
    </div>

    <div class="rmc-flex">
        <div class="row review-main-content">
            <div class="row rmc-first-row">
                <div class="col-12 rmc-first-col mt-3 ms-4">
                    <div class="col-search col-search-review">
                        <div class="search-bar-review">
                            <img src="<?php echo e(asset('icons/Icon search.svg')); ?>" alt="Search Icon" class="search-icon">
                            <input type="text" placeholder="Search Customer Name" class="search-input-review">
                        </div>
                    </div>

                    <button class="sort-btn">
                        <img src="<?php echo e(asset('icons/Icon sort white.svg')); ?>" alt="Sort Icon">
                    </button>
                </div>
            </div>

            <div class="container rcm-container mt-4">
                <div class="row mb-4 align-items-center" style="width: 95%; height: 50px; background-color: white; border-radius: 10px;">
                    <div class="col-2">
                        <strong>User name</strong>
                    </div>
                    <div class="col-3">
                        <strong>Product name</strong>
                    </div>
                    <div class="col-3">
                        <strong>Review date</strong>
                    </div>
                    <div class="col-2">
                        <strong>Ratings</strong>
                    </div>
                    <div class="col-2">
                        <strong>Comment</strong>
                    </div>
                </div>
                <!-- Review cards loop -->
                <?php if($reviews->isEmpty()): ?>
                <div class="mb-3">
                    <strong>No Data</strong>
                </div>
                <?php endif; ?>
                <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row mb-4 align-items-center" style="width: 95%; height: 85px; background-color: white; border-radius: 10px;">
                    <div class="col-2">
                        <!-- User name -->
                        <?php echo e($review->customer->name); ?>

                    </div>
                    <div class="col-3">
                        <!-- Product name -->
                        <?php echo e($review->product->name); ?>

                    </div>
                    <div class="col-3">
                        <!-- Review date -->
                        <?php echo e($review->review_date->format('M d, Y')); ?> at <?php echo e($review->review_date->format('h:i A')); ?>

                    </div>
                    <div class="col-2">
                        <!-- Ratings -->
                        <?php for($i = 0; $i < $review->ratings; $i++): ?>
                            <span class="fa fa-star checked"></span>
                        <?php endfor; ?>
                        <?php for($i = $review->ratings; $i < 5; $i++): ?>
                            <span class="fa fa-star"></span>
                        <?php endfor; ?>
                    </div>
                    <div class="col-2">
                        <!-- Comment -->
                        <?php echo e($review->comment ?? 'No comment provided'); ?>

                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Hapus parameter 'search' dan 'sort' dari URL saat halaman dimuat
        var url = new URL(window.location);
        url.searchParams.delete('search');
        window.history.replaceState(null, null, url);

        var searchInput = document.querySelector('.search-input-review');
        var sortButton = document.querySelector('.sort-btn');

        // Listener untuk input pencarian
        searchInput.addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                updateURL('search', this.value.trim());
            }
        });

        // Listener untuk tombol sort
        sortButton.addEventListener('click', function() {
            var currentSortOrder = new URLSearchParams(window.location.search).get('sort') || 'desc';
            var newSortOrder = currentSortOrder === 'desc' ? 'asc' : 'desc';
            updateURL('sort', newSortOrder);
        });

        // Fungsi untuk memperbarui URL
        function updateURL(key, value) {
            var searchParams = new URLSearchParams(window.location.search);
            searchParams.set(key, value);
            window.location.search = searchParams.toString();
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\AcerP\Documents\Kuliah\SMT5\Web Programming\2\adminside\resources\views/review_product.blade.php ENDPATH**/ ?>