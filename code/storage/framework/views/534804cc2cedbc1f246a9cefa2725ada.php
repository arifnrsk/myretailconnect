<?php $__env->startPush('styles_invoice'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/invoice.css')); ?>">
<?php $__env->stopPush(); ?>



<?php $__env->startSection('content'); ?>


<div class="review-content">

    <div class="row review-title">
        <div class="col-10 review-h1-title">
            <h1 style="font-weight: bold">
                Invoice ID: <?php echo e($invoice->id); ?>

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
                        <strong>Customer name: <br> <?php echo e($invoice->customer->name); ?> </strong>
                    </div>
                    <div class="col-6">
                        <strong>Delivery type: <br> <?php echo e($invoice->delivery->deliveryType->name); ?> </strong>
                    </div>
                    <div class="col-3">
                        <strong>Invoice date: <br> <?php echo e($invoice->invoice_date->format('M d, Y')); ?> </strong>
                    </div>
                </div>

                <div class="row mb-3 row-content-invoce" style="padding-bottom: 15px; border-bottom: 1px solid #6c757d;">
                    <div class="col-9">
                        <strong>Address: <br> <?php echo e($invoice->customer->address); ?> </strong>
                    </div>
                    <div class="col-3">
                        <strong>Delivery type: <br> <?php echo e($invoice->delivery->deliveryType->name); ?> - Rp <?php echo e(number_format($invoice->delivery->deliveryType->price, 2, ',', '.')); ?> </strong>
                    </div>
                </div>

                <div class="row mb-3 row-content-invoce d-flex justify-content-center">
                    <div class="row" style="padding-bottom: 15px; border-bottom: 1px solid #6c757d;">
                        <div class="col-4">
                            <strong>Product Name</strong>
                        </div>
                        <div class="col-3">
                            <strong>Cost</strong>
                        </div>
                        <div class="col-2">
                            <strong>Qty</strong>
                        </div>
                        <div class="col-3">
                            <strong>Ammount</strong>
                        </div>
                    </div>
                    <div class="row mt-3 mb-3">
                        <!-- Transaction detail loop -->
                        <?php $__empty_1 = true; $__currentLoopData = $invoice->transaction->transactionDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="col-4">
                                <?php echo e($detail->product->name); ?>

                            </div>
                            <div class="col-3">
                                Rp <?php echo e(number_format($detail->product->price, 2, ',', '.')); ?>

                            </div>
                            <div class="col-2">
                                <?php echo e($detail->quantity); ?>

                            </div>
                            <div class="col-3">
                                Rp <?php echo e(number_format($detail->quantity * $detail->product->price, 2, ',', '.')); ?>

                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="mb-3">
                                <strong>No Transaction</strong>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="row" style="padding-top: 15px; border-top: 1px solid #6c757d;">
                        <div class="col-12">
                            <strong>
                                Total Ammount: <br> Rp <?php echo e(number_format($invoice->transaction->total_amount, 2, ',', '.')); ?>

                            </strong>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\AcerP\Documents\Kuliah\SMT5\Web Programming\2\fix adminside\adminside\resources\views/invoice.blade.php ENDPATH**/ ?>