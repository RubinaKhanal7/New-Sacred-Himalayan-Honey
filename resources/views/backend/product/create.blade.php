@extends('layouts2.superadmin')

@section('content')
    <div class="container">
        <h1>Create Product</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('backend.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Product Name -->
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" name="product_name" class="form-control" required>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>

            <!-- Price -->
            <div class="form-group">
                <label for="cost_price">Cost Price</label>
                <input type="number" name="cost_price" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="selling_price">Selling Price</label>
                <input type="number" name="selling_price" class="form-control" required>
            </div>

            <!-- Product Quantity -->
            <div class="form-group">
                <label for="product_quantity">Product Quantity</label>
                <input type="number" name="product_quantity" class="form-control" required>
            </div>

            <!-- Category -->
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Brand -->
            <div class="form-group">
                <label for="brand_id">Brand</label>
                <select name="brand_id" id="brand_id" class="form-control" required>
                    <option value="">Select Brand</option>
                </select>
            </div>

            <!-- Material -->
            <div class="form-group">
                <label for="material">Material</label>
                <input type="text" name="material" class="form-control">
            </div>

            <!-- Product Image -->
            <div class="form-group">
                <label for="product_image">Product Image</label>
                <input type="file" name="product_image" id="product_image" class="form-control-file"
                    onchange="previewImage(this, 'product_image_preview')">
                <img id="product_image_preview" src="" alt="Product Image Preview"
                    style="max-width: 200px; margin-top: 10px;">
            </div>

            <!-- Other Images -->
            <div class="form-group">
                <label for="other_images">Other Images</label>
                <input type="file" name="other_images[]" id="other_images" class="form-control-file" multiple
                    onchange="previewMultipleImages(this, 'other_images_preview')">
                <div id="other_images_preview" style="margin-top: 10px; display: flex; flex-wrap: wrap;"></div>
            </div>

            <!-- Status -->
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control" required>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#category_id').change(function() {
                var categoryId = $(this).val();
                if (categoryId) {
                    $.ajax({
                        url: '/backend/categories/' + categoryId + '/brands',
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#brand_id').empty();
                            $('#brand_id').append('<option value="">Select Brand</option>');
                            $.each(data, function(key, value) {
                                $('#brand_id').append('<option value="' + value.id +
                                    '">' + value.brand_name + '</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error("Error retrieving brands: " + error);
                            alert('Error retrieving brands');
                        }
                    });
                } else {
                    $('#brand_id').empty();
                    $('#brand_id').append('<option value="">Select Brand</option>');
                }
            });
        });

        function previewImage(input, previewId) {
            var preview = document.getElementById(previewId);
            var file = input.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
            }
        }

        function previewMultipleImages(input, previewContainerId) {
            var previewContainer = document.getElementById(previewContainerId);
            previewContainer.innerHTML = ""; // Clear existing previews
            var files = input.files;

            Array.from(files).forEach(file => {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var img = document.createElement("img");
                    img.src = e.target.result;
                    img.style.maxWidth = "200px";
                    img.style.margin = "10px";
                    previewContainer.appendChild(img);
                }

                reader.readAsDataURL(file);
            });
        }
    </script>
@endsection
