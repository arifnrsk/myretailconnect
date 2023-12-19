<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Retail Connect!</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <link href="<?php echo e(asset('css/homepage.css')); ?>" rel="stylesheet">
    <?php echo $__env->yieldPushContent('styles_add_product'); ?>
    <?php echo $__env->yieldPushContent('styles_list_product'); ?>
    <?php echo $__env->yieldPushContent('styles_schedule_product'); ?>
    <?php echo $__env->yieldPushContent('styles_review_product'); ?>
    <?php echo $__env->yieldPushContent('styles_delivery'); ?>
    <?php echo $__env->yieldPushContent('styles_transaction_history'); ?>
    <?php echo $__env->yieldPushContent('styles_profile'); ?>
    <?php echo $__env->yieldPushContent('styles_profile_delivery'); ?>
    <?php echo $__env->yieldPushContent('styles_product_detail'); ?>
    <?php echo $__env->yieldPushContent('styles_invoice'); ?>
    <?php echo $__env->yieldPushContent('styles_rar_detail'); ?>
</head>
<body>

    <div class="container-fluid">
        <div class="row">
    
            <!-- Side Left Navbar -->
            <div class="col-3 p-0" id="side-navbar">
                <h4 class="text-center mt-3">Home</h4>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset('icons/Icon home.svg')); ?>" alt="Home Icon"><span class="nav-text">Home</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#manageProductsDropdown"><img src="<?php echo e(asset('icons/Icon inventory.svg')); ?>" alt="Manage Products Icon"><span class="nav-text">Manage Products</span></a>
                        <div id="manageProductsDropdown" class="collapse">
                            <a class="dropdown-item" href="<?php echo e(url('/list-product')); ?>"><img src="<?php echo e(asset('icons/Icon format list bulleted.svg')); ?>" alt="List Icon"><span class="nav-text">List</span></a>
                            
                            <a class="dropdown-item" href="<?php echo e(url('/product-reviews')); ?>"><img src="<?php echo e(asset('icons/Icon reviews.svg')); ?>" alt="Review Icon"><span class="nav-text">Reviews</span></a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(url('/delivery')); ?>"><img src="<?php echo e(asset('icons/Icon truck.svg')); ?>" alt="Delivery Icon"><span class="nav-text">Delivery</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(url('/transaction-history')); ?>"><img src="<?php echo e(asset('icons/Icon receipt long.svg')); ?>" alt="Transaction Icon"><span class="nav-text">Transaction History</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-profile" href="<?php echo e(url('/profile')); ?>"><img src="<?php echo e(asset('icons/Icon account circle.svg')); ?>" alt="Profile Icon"><span class="nav-text">Profile</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><img src="<?php echo e(asset('icons/Icon chat.svg')); ?>" alt="Profile Icon"><span class="nav-text">Chat</span></a>
                    </li>
                </ul>
                <footer class="mb-3 footer-mb">
                    <img src="<?php echo e(asset('icons/Icon info circle.svg')); ?>" alt="Info Icon"><span class="mb-3-text">
                        Welcome Admin to MyRetailConnect!
                    </span>
                </footer>
            </div>
    
            <!-- Main -->
            <div class="col-9" id="main">
                <div class="row" id="header">
                    <div class="col-8 col-search">
                        <div class="search-bar">
                            <img src="<?php echo e(asset('icons/Icon search.svg')); ?>" alt="Search Icon" class="search-icon">
                            <input type="text" placeholder="Search for a product" class="search-input" id="globalSearchInput">
                        </div>
                    </div>
                    <div class="col-4 add">
                        <a href="<?php echo e(url('/add-product')); ?>" class="add-link">
                            <button class="add-product-btn">
                                <img src="<?php echo e(asset('icons/Icon add circle.svg')); ?>" alt="Add Product" class="add-icon">
                                <span class="add-text">Add Product</span>
                            </button>
                        </a>
                    </div>
                </div>
                
                <?php echo $__env->yieldContent('content'); ?>
                
            </div>
    
        </div>
    </div>

    <script>
        document.getElementById('globalSearchInput').addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                var searchQuery = this.value.trim();
                if (searchQuery) {
                    window.location.href = '/list-product?search=' + encodeURIComponent(searchQuery);
                }
            }
        });
    </script>
</body>
</html><?php /**PATH C:\Users\AcerP\Documents\Kuliah\SMT5\Web Programming\2\fix adminside\adminside\resources\views/layouts/master.blade.php ENDPATH**/ ?>