<?php $__env->startPush('styles_transaction_history'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/transaction_history.css')); ?>">
<?php $__env->stopPush(); ?>



<?php $__env->startSection('content'); ?>


<div class="review-content">

    <div class="row review-title">
        <div class="col-12 review-h1-title">
            <h1>Transaction History</h1>
        </div>
    </div>

    <div class="rmc-flex">
        <div class="row review-main-content">
            <div class="row rmc-first-row">
                <div class="col-12 rmc-first-col mt-3 ms-4">
                    <div class="col-search col-search-review">
                        <div class="search-bar-delivery">
                            <img src="<?php echo e(asset('icons/Icon search.svg')); ?>" alt="Search Icon" class="search-icon">
                            <input type="text" placeholder="Search Transaction ID" class="search-input-delivery">
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
                    <div class="col-2">
                        <strong>Status</strong>
                    </div>
                    <div class="col-4">
                        <strong>Total Ammount</strong>
                    </div>
                </div>
                <!-- Transaction History loop -->
                <?php if($transactions->isEmpty()): ?>
                <div class="mb-3">
                    <strong>No Transaction</strong>
                </div>
                <?php endif; ?>
                <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row mb-4 align-items-center" style="width: 95%; height: 120px; background-color: white; border-radius: 10px;">
                    <div class="col-2 d-flex justify-content-center">
                        <?php echo e($transaction->id); ?> <!-- Transaction ID -->
                    </div>
                    <div class="col-2">
                        <?php echo e($transaction->customer->name); ?> <!-- Customer Name -->
                    </div>
                    <div class="col-2">
                        <?php echo e($transaction->transaction_date->format('M d, Y')); ?> at <?php echo e($transaction->transaction_date->format('h:i A')); ?> <!-- Transaction date -->
                    </div>
                    <div class="col-2">
                        <?php echo e($transaction->transactionStatus->name); ?> <!-- Transaction status -->
                    </div>
                    <div class="col-2">
                        Rp <?php echo e(number_format($transaction->total_amount, 2, ',', '.')); ?> <!-- Total Amount -->
                    </div>
                    <div class="col-2">
                        <div class="col-3 d-flex flex-column align-items-center w-100">
                            <a href="<?php echo e(route('customer.invoices.show', ['id' => $transaction->invoice->id])); ?>" style="width: 70%;">
                                <button class="detail-delivery-btn">
                                    Detail
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var url = new URL(window.location);
        url.searchParams.delete('search');
        window.history.replaceState(null, null, url);
        
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
    
    function openReviewModal(transactionId, products) {
        document.getElementById('transactionId').value = transactionId;
        var productReviewsContainer = document.getElementById('productReviews');
        productReviewsContainer.innerHTML = '';

        products.forEach(product => {
            productReviewsContainer.innerHTML += `
                <div>
                    <h3>${product.name}</h3> <!-- Nama produk -->
                    <input type="hidden" name="product_ids[]" value="${product.id}">
                    <label for="rating-${product.id}">Rating (1-5):</label>
                    <input type="number" id="rating-${product.id}" name="ratings[]" min="1" max="5" required>
                    <label for="comment-${product.id}">Comment:</label>
                    <textarea id="comment-${product.id}" name="comments[]"></textarea>
                </div>
            `;
        });

        document.getElementById('reviewModal').style.display = 'block';
    }
</script>    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('customer.layouts.customer_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\AcerP\Documents\Kuliah\SMT5\Web Programming\2\fix adminside\adminside\resources\views/customer/customer_transaction_history.blade.php ENDPATH**/ ?>