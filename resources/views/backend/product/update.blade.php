@extends('layouts2.superadmin')

@section('content')
    <div class="container">
        <h1>Edit Product</h1>

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

        <form action="{{ route('backend.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" name="product_name" class="form-control" value="{{ $product->product_name }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" required>{{ $product->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="price">Cost Price</label>
                <input type="number" name="cost_price" class="form-control" value="{{ $product->cost_price }}" required>
            </div>

            <div class="form-group">
                <label for="selling_price">Selling Price</label>
                <input type="number" name="selling_price" class="form-control" value="{{ $product->selling_price }}" required>
            </div>

            <div class="form-group">
                <label for="product_quantity">Quantity</label>
                <input type="number" name="product_quantity" class="form-control" value="{{ $product->product_quantity }}"
                    required>
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if ($category->id == $product->category_id) selected @endif>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="brand_id">Brand</label>
                <select name="brand_id" id="brand_id" class="form-control" required>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" @if ($brand->id == $product->brand_id) selected @endif>
                            {{ $brand->brand_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="material">Material</label>
                <input type="text" name="material" class="form-control" value="{{ $product->material }}">
            </div>

            <div class="form-group">
                <label for="product_image">Product Image</label>
                <input type="file" name="product_image" class="form-control-file"
                    onchange="previewImage(this, 'product_image_preview')">
                <img id="product_image_preview" src="{{ $product->product_image_url }}" alt="Product Image Preview"
                    style="max-width: 200px; margin-top: 10px;">
            </div>

            <div class="form-group">
                <label for="other_images">Other Images</label>
                <input type="file" name="other_images[]" id="other_images" class="form-control-file" multiple
                    onchange="previewMultipleImages(this, 'other_images_preview')">
                <div id="other_images_preview" style="margin-top: 10px; display: flex; flex-wrap: wrap;">
                    @if (is_array($product->other_images) || is_object($product->other_images))
                        @foreach ($product->other_images as $image)
                            <img src="{{ $image }}" style="max-width: 200px; margin: 10px;">
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="active" @if ($product->status == 'active') selected @endif>Active</option>
                    <option value="inactive" @if ($product->status == 'inactive') selected @endif>Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
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
