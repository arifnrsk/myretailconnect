<?php $__env->startPush('styles_add_product'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/add_product.css')); ?>">
<?php $__env->stopPush(); ?>



<?php $__env->startSection('content'); ?>

<div class="add-content">

    <div class="row add-title">
        <div class="col-12 add-h1-title">
            <h1>Edit Product</h1>
        </div>
    </div>
    <div class="row add-main-content">
        <div class="col-12 add-form">
            <form action="<?php echo e(route('products.update', $product->id)); ?>" method="POST" enctype="multipart/form-data" class="was-validated">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="row add-form-row">
                    <div class="col">
                        <div class="mb-3 mt-3">
                            <label for="input-product-name">Product name</label>
                            <input type="text" class="form-control" value="<?php echo e($product->name); ?>" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="input-product-description">Product description</label>
                            <input type="text" class="form-control description" value="<?php echo e($product->description); ?>" name="description" required>
                        </div>

                        <div class="mb-3">
                            <label for="input-product-price">Price</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" value="<?php echo e($product->price); ?>" name="price" required>
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
                                <option value="" disabled>Choose a unit</option>
                                <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($unit->id); ?>" <?php echo e($product->unit_id == $unit->id ? 'selected' : ''); ?>><?php echo e($unit->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="input-category">Category</label>
                            <select class="form-select" id="input-category" name="category_id" required>
                                <option value="" disabled>Choose a category</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>" <?php echo e($product->category_id == $category->id ? 'selected' : ''); ?>><?php echo e($category->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="input-product-stock">Stock</label>
                            <input type="number" class="form-control" value="<?php echo e($product->stock); ?>" name="stock" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div id="imagePreviewContainer">
                        <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="image-preview-wrapper">
                                <img src="<?php echo e(asset('storage/products/' . $image->image_path)); ?>" alt="<?php echo e($product->name); ?>" style="box-shadow: 0px 0px 7px 0px rgba(0, 0, 0, 0.5); border-radius: 10px; width: 100%; height: 100px">
                        
                                <button class="delete-btn" data-image-id="<?php echo e($image->id); ?>">x</button>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <div class="row mb-3 d-flex justify-content-center align-items-center w-100" style="margin-top: 15px; border-top: 1px solid #6c757d;">
                    <div class="col-6 add-buttons">
                        <div class="col-12 add-buttons-content d-flex flex-column align-items-center justify-content-center">
                            <button class="publish-product-btn mt-3 mb-3">
                                Save Edit
                            </button>
                            <a href="#" onclick="history.back(); return false;" style="width: 50%;">
                                <button class="cancel-product-btn mb-3" style="width: 100%;">
                                    Cancel
                                </button>
                            </a>
                        </div>
                    </div>
                </div>

            </form>
        </div>
        
    </div>

</div>

<script>

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

    document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function() {
            const imageId = this.getAttribute('data-image-id');
            // Dalam event listener di atas
            fetch('/delete-image/' + imageId, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ image_id: imageId })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Image deleted:', data);
                // Hapus preview dari DOM
                this.parentElement.remove();
            })
            .catch(error => console.error('Error:', error));
            this.parentElement.remove();
        });
    });

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\AcerP\Documents\Kuliah\SMT5\Web Programming\2\fix adminside\adminside\resources\views/edit_product.blade.php ENDPATH**/ ?>