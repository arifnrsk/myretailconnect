<?php $__env->startPush('styles_product_detail'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/product_detail.css')); ?>">
<?php $__env->stopPush(); ?>



<?php $__env->startSection('content'); ?>
    <div class="row review-title">
        <div class="col-12 review-h1-title">
            <h1>Product Detail</h1>
        </div>
    </div>

    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="background: none; border: none;">
                        <span aria-hidden="true"><img src="<?php echo e(asset('icons/Icon close.svg')); ?>" alt="Close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this product?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="rmc-flex">
        <div class="row review-main-content">
            <div class="row mt-4 mb-3" style="background-color: white; width: 95%; border-radius: 10px;">
                <a class="mt-3" href="<?php echo e(url('/list-product')); ?>">
                    <img src="<?php echo e(asset('icons/Icon arrow left.svg')); ?>" alt="Back">
                </a>
                <div class="col-6 d-flex justify-content-center mt-4 mb-5" style="width: 50%">
                    <img src="<?php echo e(asset('storage/products/' . $product->images->first()->image_path)); ?>" alt="<?php echo e($product->name); ?>" style="box-shadow: 0px 0px 7px 0px rgba(0, 0, 0, 0.5); border-radius: 10px; width: 50%; height: 200px">
                </div>
                <div class="col-6 mt-4 mb-5">
                    <strong style="font-size: 28px"><?php echo e($product->name); ?></strong>
                    <p><br></p>
                    <p><strong>Product Description</strong> <br> <?php echo e($product->description); ?></p>
                    <p>Rp <?php echo e(number_format($product->price, 2, ',', '.')); ?> | Stock <?php echo e($product->stock); ?> pcs</p>
                    <div class="w-100">
                        <form id="deleteForm" action="<?php echo e(route('product.delete', $product->id)); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                        </form>
                        <button type="button" class="cancel-delivery-btn" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                            Delete
                        </button>                  
                        <a href="<?php echo e(route('edit.product', $product->id)); ?>">
                            <button class="detail-delivery-btn">
                                Edit
                            </button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <h3 class="mt-3" style="font-weight: bold">Review</h3>
                <div class="container rcm-container mt-3">
                    <div class="row mb-4 align-items-center" style="width: 95%; height: 50px; background-color: white; border-radius: 10px;">
                        <div class="col-2">
                            <strong>User name</strong>
                        </div>
                        <div class="col-3">
                            <strong>Review date</strong>
                        </div>
                        <div class="col-2">
                            <strong>Ratings</strong>
                        </div>
                        <div class="col-5">
                            <strong>Comment</strong>
                        </div>
                    </div>
                    
                    <!-- Review cards loop -->
                    <?php $__empty_1 = true; $__currentLoopData = $product->reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="row mb-4 align-items-center" style="width: 95%; height: 50px; background-color: white; border-radius: 10px;">
                        <div class="col-2">
                            <!-- User name review product detail -->
                            <?php echo e($review->customer->name); ?>

                        </div>
                        <div class="col-3">
                            <!-- Review date product detail -->
                            <?php echo e($review->review_date->format('M d, Y')); ?>

                        </div>
                        <div class="col-2">
                            <!-- Ratings product detail -->
                            <?php echo e($review->ratings); ?>

                        </div>
                        <div class="col-5">
                            <!-- Comment product detail -->
                            <?php echo e($review->comment); ?>

                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="row">
                            <p>No reviews yet.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>

<script>
    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        document.getElementById('deleteForm').submit();
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\AcerP\Documents\Kuliah\SMT5\Web Programming\2\fix adminside\adminside\resources\views/product_detail.blade.php ENDPATH**/ ?>