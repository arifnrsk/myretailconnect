@push('styles_add_product')
<link rel="stylesheet" href="{{ asset('css/add_product.css') }}">
@endpush

@extends('layouts.master')

@section('content')
{{-- Content --}}
<div class="add-content">

    <div class="row add-title">
        <div class="col-12 add-h1-title">
            <h1>Edit Product</h1>
        </div>
    </div>
    <div class="row add-main-content">
        <div class="col-12 add-form">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="was-validated">
                @csrf
                @method('PUT')
                <div class="row add-form-row">
                    <div class="col">
                        <div class="mb-3 mt-3">
                            <label for="input-product-name">Product name</label>
                            <input type="text" class="form-control" value="{{ $product->name }}" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="input-product-description">Product description</label>
                            <input type="text" class="form-control description" value="{{ $product->description }}" name="description" required>
                        </div>

                        <div class="mb-3">
                            <label for="input-product-price">Price</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" value="{{ $product->price }}" name="price" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="custom-file-label" for="customFileInput">
                                <div class="icon-wrapper">
                                    <img src="{{ asset('icons/Icon upload image.svg') }}" alt="Upload Icon">
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
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}" {{ $product->unit_id == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="input-category">Category</label>
                            <select class="form-select" id="input-category" name="category_id" required>
                                <option value="" disabled>Choose a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="input-product-stock">Stock</label>
                            <input type="number" class="form-control" value="{{ $product->stock }}" name="stock" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div id="imagePreviewContainer">
                        @foreach ($product->images as $image)
                            <div class="image-preview-wrapper">
                                <img src="{{ asset('storage/products/' . $image->image_path) }}" alt="{{ $product->name }}" style="box-shadow: 0px 0px 7px 0px rgba(0, 0, 0, 0.5); border-radius: 10px; width: 100%; height: 100px">
                        
                                <button class="delete-btn" data-image-id="{{ $image->id }}">x</button>
                            </div>
                        @endforeach
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
{{-- End of Content --}}
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
            previewWrapper.className = 'image-preview-wrapper';

            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.height = 100; // Atur ukuran preview

            const deleteBtn = document.createElement('button');
            deleteBtn.textContent = 'x'; // Tombol hapus
            deleteBtn.className = 'delete-btn';

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
@endsection