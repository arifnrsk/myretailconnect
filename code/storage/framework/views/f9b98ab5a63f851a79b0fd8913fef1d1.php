<?php $__env->startPush('styles_delivery'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/delivery.css')); ?>">
<?php $__env->stopPush(); ?>



<?php $__env->startSection('content'); ?>


<div class="review-content">

    <div class="row review-title">
        <div class="col-12 review-h1-title">
            <h1>Delivery Status</h1>
        </div>
    </div>

    <div class="modal fade" id="confirmCancelModal" tabindex="-1" role="dialog" aria-labelledby="confirmCancelModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmCancelModalLabel">Confirm Cancellation</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="background: none; border: none;>
                        <span aria-hidden="true"><img src="<?php echo e(asset('icons/Icon close.svg')); ?>" alt="Close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to cancel this delivery?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger" id="confirmCancelBtn">Yes</button>
                </div>
            </div>
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
                        <strong>Delivery ID</strong>
                    </div>
                    <div class="col-2">
                        <strong>Courier Name</strong>
                    </div>
                    <div class="col-2">
                        <strong>Date</strong>
                    </div>
                    <div class="col-2">
                        <strong>Type</strong>
                    </div>
                    <div class="col-4">
                        <strong>Status</strong>
                    </div>
                </div>
                <!-- Delivery loop -->
                <?php if($deliveries->isEmpty()): ?>
                <div class="mb-3">
                    <strong>No Data</strong>
                </div>
                <?php endif; ?>
                <?php $__currentLoopData = $deliveries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $delivery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row mb-4 align-items-center" style="width: 95%; height: 120px; background-color: white; border-radius: 10px;">
                    <div class="col-2 d-flex justify-content-center">
                        <!-- Delivery ID -->
                        <strong><?php echo e($delivery->id); ?></strong>
                    </div>
                    <div class="col-2">
                        <!-- Assign Courier Name -->
                        <select class="form-select">
                            <option value="">Assign Courier</option>
                            <?php $__currentLoopData = $couriers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $courier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($courier->id); ?>" <?php echo e($delivery->courier_id == $courier->id ? 'selected' : ''); ?>>
                                    <?php echo e($courier->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-2">
                        <!-- Delivery date -->
                        <?php echo e($delivery->delivery_date->format('M d, Y')); ?> at <?php echo e($delivery->delivery_date->format('h:i A')); ?>

                    </div>
                    <div class="col-2">
                        <!-- Delivery type -->
                        <?php echo e($delivery->deliveryType->name); ?>

                    </div>
                    <div class="col-2">
                        <!-- Assign Status -->
                        <select class="form-select">
                            <option value="">Choose a delivery status</option>
                            <?php $__currentLoopData = $deliveryStatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($status->id); ?>" <?php echo e($delivery->delivery_status_id == $status->id ? 'selected' : ''); ?>>
                                    <?php echo e($status->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-2">
                        <div class="col-3 d-flex flex-column align-items-center w-100">
                            <button class="cancel-delivery-btn mb-2" data-delivery-id="<?php echo e($delivery->id); ?>">
                                Cancel
                            </button>
                            <a href="<?php echo e(route('invoices.show', ['id' => $delivery->id])); ?>" style="width: 70%">
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
        // Logika untuk pencarian
        var url = new URL(window.location);
        url.searchParams.delete('search');
        window.history.replaceState(null, null, url);
        
        var searchInput = document.querySelector('.search-input-delivery');

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

        // Logika untuk modal konfirmasi
        var deliveryIdToCancel = null;
        document.querySelectorAll('.cancel-delivery-btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                deliveryIdToCancel = this.getAttribute('data-delivery-id');
                $('#confirmCancelModal').modal('show');
            });
        });

        // Handler untuk tombol konfirmasi di dalam modal
        document.getElementById('confirmCancelBtn').addEventListener('click', function() {
            if(deliveryIdToCancel) {
                fetch('/delivery/' + deliveryIdToCancel, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Success:', data);
                    location.reload();
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
                $('#confirmCancelModal').modal('hide');
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\AcerP\Documents\Kuliah\SMT5\Web Programming\2\adminside\resources\views/delivery.blade.php ENDPATH**/ ?>