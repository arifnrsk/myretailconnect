<?php $__env->startPush('styles_rar_detail'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/return_and_refund_detail.css')); ?>">
<?php $__env->stopPush(); ?>



<?php $__env->startSection('content'); ?>


<div class="review-content">

    <div class="row review-title">
        <div class="col-10 review-h1-title">
            <h1 style="font-weight: bold">
                Transaction ID: <?php echo e($returnAndRefund->transaction->id ?? 'N/A'); ?>

            </h1>
        </div>
        <div class="col-2 d-flex justify-content-center">
            <a class="mt-3" href="#" onclick="history.back(); return false;">
                <img src="<?php echo e(asset('icons/Icon close.svg')); ?>" alt="Back">
            </a>
        </div>
    </div>

    <div class="rmc-flex">
        <div class="row review-main-content">
            <div class="container rcm-container mt-4 mb-4">
                
                <div class="row mb-3 row-content-invoce">
                    <div class="col-3">
                        <strong>Customer name: <br> <?php echo e($returnAndRefund->transaction->customer->name); ?></strong> 
                    </div>
                    <div class="col-6">
                        <strong>Delivery type: <br> <?php echo e($returnAndRefund->transaction->delivery->deliveryType->name); ?> </strong> 
                    </div>
                    <div class="col-3">
                        <strong>Invoice date: <br> <?php echo e($returnAndRefund->returns_and_refunds_date->format('M d, Y')); ?> </strong> 
                    </div>
                </div>

                <div class="row mb-3 row-content-invoce" style="padding-bottom: 15px; border-bottom: 1px solid #6c757d;">
                    <div class="col-6">
                        <strong>Address: <br> <?php echo e($returnAndRefund->transaction->customer->address); ?> </strong>
                    </div>
                    <div class="col-3">
                        <strong>Courier name: <br> <?php echo e($returnAndRefund->transaction->delivery->courier->name ?? 'N/A'); ?> </strong>
                    </div>
                    <div class="col-3">
                        <strong>Payment type: <br> <?php echo e($returnAndRefund->transaction->payment->name ?? 'N/A'); ?> </strong>
                    </div>
                </div>

                <div class="row mb-3 row-content-invoce d-flex justify-content-center">
                    <div class="row mt-3 mb-3" style="padding-bottom: 15px; border-bottom: 1px solid #6c757d;">
                        <div class="col-9">
                            <strong>Reason: <br> </strong> <?php echo e($returnAndRefund->reason); ?>

                        </div>
                        <div class="col-3">
                            <button class="preview-product-btn mb-3">
                                Discuss
                            </button>
                        </div>
                    </div>
                    <div class="row mb-3" >
                        <div class="col-12">
                            <strong>Images:</strong>
                            <?php $__empty_1 = true; $__currentLoopData = $returnAndRefund->returnAndRefundImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="col-12">
                                    <img class="mt-3" src="<?php echo e(asset('images/' . $image->image_proof_path)); ?>" alt="Proof Image" style="width: 150px; border-radius: 10px;">
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="col-12">No images</div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 15px; border-top: 1px solid #6c757d;">
                        <div class="col-12 mt-3">
                            <div class="col-3 d-flex justify-content-center w-100">
                                <button class="cancel-delivery-btn me-2">
                                    Reject
                                </button>
                                <button class="detail-delivery-btn ms-2">
                                    Approve
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\AcerP\Documents\Kuliah\SMT5\Web Programming\2\adminside\resources\views/return_and_refund_detail.blade.php ENDPATH**/ ?>