<?php $__env->startPush('styles_add_product'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/add_product.css')); ?>">
<?php $__env->stopPush(); ?>



<?php $__env->startSection('content'); ?>

<div class="add-content">

    <div class="row add-title">
        <div class="col-12 add-h1-title">
            <h1>Add Product</h1>
        </div>
    </div>
    <div class="row add-main-content">
        <div class="col-12 add-form">
            <form action="<?php echo e(route('products.store')); ?>" method="POST" enctype="multipart/form-data" class="was-validated">
                <?php echo csrf_field(); ?>
                <div class="row add-form-row">
                    <div class="col">
                        <div class="mb-3 mt-3">
                            <label for="input-product-name">Product name</label>
                            <input type="text" class="form-control" placeholder="Enter product name" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="input-product-description">Product description</label>
                            <input type="text" class="form-control description" placeholder="Add a description" name="description" required>
                        </div>

                        <div class="mb-3">
                            <label for="input-product-price">Price</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" placeholder="Enter product price" name="price" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="custom-file-label" for="customFileInput">
                                <div class="icon-wrapper">
                                    <img src="<?php echo e(asset('icons/Icon upload image.svg')); ?>" alt="Upload Icon">
                                </div>
                                <span>Images</span>
                                <input type="file" class="custom-file-input" id="customFileInput" name="images[]" multiple accept="image/*">
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3 mt-3">
                            <label for="input-unit">Unit</label>
                            <select class="form-select" id="input-unit" name="unit_id" required>
                                <option value="" disabled selected>Choose a unit</option>
                                <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($unit->id); ?>"><?php echo e($unit->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="input-category">Category</label>
                            <select class="form-select" id="input-category" name="category_id" required>
                                <option value="" disabled selected>Choose a category</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="input-product-stock">Stock</label>
                            <input type="number" class="form-control" placeholder="Enter total stock" name="stock" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div id="imagePreviewContainer"></div>
                </div>

                <div class="row mb-3 d-flex justify-content-center align-items-center w-100" style="margin-top: 15px; border-top: 1px solid #6c757d;">
                    <div class="col-6 add-schedule-and-button">
                        <div class="row add-schedule mb-3">
                            <div class="col-12 add-schedule-content d-flex align-items-center justify-content-center">
                                <div class="container">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <!-- Date Picker -->
                                            <div class="form-group">
                                                <div class="input-group date" id="datePicker">
                                                    <input type="date" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <!-- Time Picker (not provided by Bootstrap 5 Datepicker) -->
                                            <div class="form-group">
                                                <input type="time" class="form-control" id="timePicker">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-center">
                                            <!-- Schedule Button -->
                                            <button type="button" class="schedule-product-btn">Schedule</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
    
                    <div class="col-6 add-buttons">
                        <div class="col-12 add-buttons-content d-flex flex-column align-items-center justify-content-center">
                            <button class="publish-product-btn mt-3 mb-3">
                                Publish Product
                            </button>
                            
                            <button class="cancel-product-btn mb-3">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
        
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var datePickerEl = document.getElementById('datePicker');
        var datePicker = new bootstrap.Datepicker(datePickerEl, {
            // Opsi untuk datepicker, misalnya:
            format: 'mm/dd/yyyy',
        });
    });

    let uploadedFileNames = [];

    document.getElementById('customFileInput').addEventListener('change', function(event) {
        const imagePreviewContainer = document.getElementById('imagePreviewContainer');
        const files = event.target.files;

        for(let i = 0; i < files.length; i++) {
            const file = files[i];

            // Cek apakah nama file sudah ada di array
            if (uploadedFileNames.includes(file.name)) {
                continue; // Lewati file ini
            }

            uploadedFileNames.push(file.name); // Tambahkan nama file ke array

            const previewWrapper = document.createElement('div');
            previewWrapper.className = 'image-preview-wrapper'; // Class untuk styling

            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.height = 100; // Atur ukuran preview

            const deleteBtn = document.createElement('button');
            deleteBtn.textContent = 'x'; // Tombol hapus
            deleteBtn.className = 'delete-btn'; // Class untuk styling

            deleteBtn.onclick = function() {
                const index = uploadedFileNames.indexOf(file.name);
                if (index > -1) {
                    uploadedFileNames.splice(index, 1); // Hapus nama file dari array
                }
                previewWrapper.remove(); // Hapus preview
            };

            previewWrapper.appendChild(img);
            previewWrapper.appendChild(deleteBtn);
            imagePreviewContainer.appendChild(previewWrapper);
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\AcerP\Documents\Kuliah\SMT5\Web Programming\2\adminside\resources\views/add_product.blade.php ENDPATH**/ ?>