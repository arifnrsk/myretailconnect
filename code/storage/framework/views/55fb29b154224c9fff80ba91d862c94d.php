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

    <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg d-flex justify-content-center">
            <div class="modal-content" style="width: 50%">
                <div class="modal-header">
                    <h5 class="modal-title" id="reviewModalLabel">Product Reviews</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="background: none; border: none;">
                        <span aria-hidden="true"><img src="<?php echo e(asset('icons/Icon close.svg')); ?>" alt="Close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="reviewForm" onsubmit="submitReview(event)">
                        <input type="hidden" id="transactionId" name="transaction_id">
                        <div id="productReviews">
                        </div>
                        <button type="submit" class="btn btn-primary mt-3 detail-delivery-btn" id="submitBtn">Submit All Reviews</button>
                    </form>
                </div>
            </div>
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
                        <strong>Delivery type: <br> <?php echo e($invoice->delivery->deliveryType->name); ?> - Rp <?php echo e(number_format($invoice->delivery->deliveryType->price, 2, ',', '.')); ?></strong>
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
                    <div class="row d-flex align-items-center" style="padding-top: 15px; border-top: 1px solid #6c757d;">
                        <div class="col-10">
                            <strong>
                                Total Amount: <br> Rp <?php echo e(number_format($invoice->transaction->total_amount, 2, ',', '.')); ?>

                            </strong>
                        </div>
                        <div class="col-2">
                            <?php if($canReview): ?>
                                <button class="detail-delivery-btn" id="reviewButton" onclick="openReviewModal(<?php echo e($invoice->transaction_id); ?>, <?php echo e(json_encode($invoice->transaction->transactionDetails)); ?>)">
                                    Review Products
                                </button>
                            <?php endif; ?>                             
                        </div>                        
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<script>
    function openReviewModal(transactionId, transactionDetails) {
        document.getElementById('transactionId').value = transactionId;

        var productReviewsContainer = document.getElementById('productReviews');
        productReviewsContainer.innerHTML = '';

        transactionDetails.forEach(detail => {
            productReviewsContainer.innerHTML += `
                <div class="d-flex flex-column mb-3" style="padding-bottom: 15px; border-bottom: 1px solid #6c757d;">
                    <strong class="mb-2">Product: ${detail.product.name}</strong>
                    <input style="border-radius: 10px;" type="hidden" name="product_ids[]" value="${detail.product.id}">
                    <label for="rating-${detail.product.id}">Rating (1-5):</label>
                    <input style="border-radius: 10px;" type="number" id="rating-${detail.product.id}" name="ratings[]" min="1" max="5" required>
                    <label for="comment-${detail.product.id}">Comment:</label>
                    <textarea style="border-radius: 10px;" id="comment-${detail.product.id}" name="comments[]"></textarea>
                </div>
            `;
        });

        $('#reviewModal').modal('show');
    }

    function submitReview(event) {
        event.preventDefault();
        var formData = new FormData(document.getElementById('reviewForm'));

        fetch('/submit-review', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
            $('#reviewModal').modal('hide');
            document.getElementById('reviewButton').style.display = 'none'; // Menyembunyikan tombol
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('customer.layouts.customer_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\AcerP\Documents\Kuliah\SMT5\Web Programming\2\fix adminside\adminside\resources\views/customer/customer_invoice.blade.php ENDPATH**/ ?>