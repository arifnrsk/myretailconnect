

<?php $__env->startSection('content'); ?>

<div class="content">
    <div class="reminder">
        <div class="row row-content">

        </div>
        <div class="row row-content mt-4">
            <div class="col-12 remcol delivery">
                <div class="reminder-text">
                    <h4><?php echo e($deliveryCount); ?> Delivery</h4>
                    <p>Please assign courier or update the delivery status</p>
                </div>
                <a href="<?php echo e(url('/delivery')); ?>">
                    <img src="<?php echo e(asset('icons/Icon local shipping.svg')); ?>" alt="Shipping Icon">
                </a>
            </div>
        </div>
    </div>
    <div class="row row-content" id="main-content">
        <div class="col-12 overview">
            <div class="row">
                <div class="col-12">
                    <h4>Overview</h4>
                </div>
            </div>
            <div class="row overview-r2">
                <div class="col-6 incos-col">
                    <img src="<?php echo e(asset('icons/Icon chart line.svg')); ?>" alt="Chart Icon">
                    <div class="or2c1">
                        <h4>Income</h4>
                        <h1>Rp <?php echo e(number_format($totalIncome, 0, ',', '.')); ?></h1>
                    </div>
                </div>
                <div class="col-6 incos-col">
                    <img src="<?php echo e(asset('icons/Icon people.svg')); ?>" alt="Customers Icon">
                    <div class="or2c1">
                        <h4>Customers</h4>
                        <h1><?php echo e(number_format($customerCount, 0, ',', '.')); ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-content" id="chart">
        <div class="col-12 col-chart1">
            <canvas id="salesChart" width="400" height="200"></canvas>
        </div>
    </div>
</div>

<script>
    window.salesData = <?php echo json_encode($salesData, 15, 512) ?>;
</script>
<script src="<?php echo e(asset('js/salesChart.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\AcerP\Documents\Kuliah\SMT5\Web Programming\2\fix adminside\adminside\resources\views/homepage.blade.php ENDPATH**/ ?>