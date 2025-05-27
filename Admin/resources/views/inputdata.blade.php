@extends('layouts.app')

@section('content')
<div class="container">
    <div class="header">
        <h1>Add New Product</h1>
        <p>Fill in the product details to add to your catalog</p>
    </div>
    
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
    
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-container">
            <!-- Product Info Card -->
            <div class="form-card">
                <div class="card-header">
                    <h2>Basic Information</h2>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input type="text" class="form-control @error('product_name') is-invalid @enderror" 
                               id="product_name" name="product_name" 
                               value="{{ old('product_name') }}" 
                               placeholder="Enter product name">
                        @error('product_name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="product_gender">Gender</label>
                        <select class="form-control @error('product_gender') is-invalid @enderror" 
                                id="product_gender" name="product_gender">
                            <option value="">Select gender</option>
                            <option value="male" {{ old('product_gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('product_gender') == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('product_gender')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="product_category">Category</label>
                        <select class="form-control @error('product_category') is-invalid @enderror" 
                                id="product_category" name="product_category">
                            <option value="">Select a category</option>
                            <option value="men" {{ old('product_category') == 'men' ? 'selected' : '' }}>Men's Clothing</option>
                            <option value="women" {{ old('product_category') == 'women' ? 'selected' : '' }}>Women's Clothing</option>
                            <option value="accessories" {{ old('product_category') == 'accessories' ? 'selected' : '' }}>Accessories</option>
                            <option value="footwear" {{ old('product_category') == 'footwear' ? 'selected' : '' }}>Footwear</option>
                        </select>
                        @error('product_category')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="product_price">Price ($)</label>
                        <input type="number" step="0.01" class="form-control @error('product_price') is-invalid @enderror" 
                               id="product_price" name="product_price" 
                               value="{{ old('product_price') }}" 
                               placeholder="0.00">
                        @error('product_price')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="product_stock">Stock Quantity</label>
                        <input type="number" class="form-control @error('product_stock') is-invalid @enderror" 
                               id="product_stock" name="product_stock" 
                               value="{{ old('product_stock') }}" 
                               placeholder="Enter stock quantity">
                        @error('product_stock')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <!-- Product Image Card -->
            <div class="form-card">
                <div class="card-header">
                    <h2>Product Image</h2>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="product_image">Upload Image</label>
                        <input type="file" class="form-control @error('product_image') is-invalid @enderror" 
                               id="product_image" name="product_image" accept="image/*">
                        @error('product_image')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="image-preview">
                        <div class="preview-placeholder">
                            <i class="fas fa-image"></i>
                            <p>Image preview will appear here</p>
                        </div>
                    </div>
                    
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline">
                            <i class="fas fa-upload"></i> Upload
                        </button>
                        <button type="button" class="btn btn-outline">
                            <i class="fas fa-trash"></i> Remove
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Product Options Card -->
            <div class="form-card">
                <div class="card-header">
                    <h2>Product Options</h2>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="product_size">Available Sizes</label>
                        @error('sizes')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="size_s" name="sizes[]" value="S"
                                   {{ in_array('S', old('sizes', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="size_s">Small (S)</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="size_m" name="sizes[]" value="M"
                                   {{ in_array('M', old('sizes', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="size_m">Medium (M)</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="size_l" name="sizes[]" value="L"
                                   {{ in_array('L', old('sizes', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="size_l">Large (L)</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="size_xl" name="sizes[]" value="XL"
                                   {{ in_array('XL', old('sizes', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="size_xl">Extra Large (XL)</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="submit-container">
            <button type="submit" class="submit-btn">Save Product</button>
        </div>
    </form>
</div>

<style>
    :root {
        --primary: #8a6bff;
        --primary-hover: #7559ff;
        --light-bg: #f3efec;
        --border-radius: 12px;
        --shadow: 0 4px 12px rgba(0,0,0,0.1);
        --text-primary: #333;
        --text-secondary: #666;
        --border-color: #e3e3e0;
    }
    
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }
    
    .header {
        text-align: center;
        margin-bottom: 40px;
    }
    
    .header h1 {
        color: var(--text-primary);
        font-size: 32px;
        margin-bottom: 12px;
    }
    
    .header p {
        color: var(--text-secondary);
        font-size: 16px;
    }
    
    .form-container {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
        max-width: 1000px;
        margin: 0 auto;
    }
    
    .form-card {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        overflow: hidden;
        transition: transform 0.3s ease;
        height: 100%;
        border: 1px solid var(--border-color);
    }
    
    .form-card:hover {
        transform: translateY(-5px);
    }
    
    .card-header {
        padding: 16px;
        background-color: var(--light-bg);
        color: var(--text-primary);
        border-bottom: 1px solid var(--border-color);
    }
    
    .card-body {
        padding: 24px;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: var(--text-primary);
    }
    
    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        font-size: 15px;
        transition: border 0.3s ease;
        background-color: white;
    }
    
    .form-control:focus {
        outline: none;
        border-color: var(--primary);
    }
    
    .color-options {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }
    
    .color-option {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        cursor: pointer;
        position: relative;
        border: 2px solid var(--border-color);
    }
    
    .color-option.active {
        border: 2px solid var(--primary);
    }
    
    .rating {
        display: flex;
        gap: 2px;
        margin: 12px 0;
    }
    
    .star {
        color: #ffc107;
        font-size: 18px;
    }
    
    .btn-group {
        display: flex;
        gap: 12px;
        margin-top: 24px;
    }
    
    .btn {
        padding: 12px 20px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
    }
    
    .btn-primary {
        background-color: var(--primary);
        color: white;
    }
    
    .btn-primary:hover {
        background-color: var(--primary-hover);
    }
    
    .btn-outline {
        background-color: white;
        border: 1px solid var(--border-color);
        color: var(--text-primary);
    }
    
    .btn-outline:hover {
        background-color: var(--light-bg);
        border-color: var(--text-primary);
    }
    
    .image-preview {
        width: 100%;
        height: 220px;
        background-color: var(--light-bg);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
        border: 1px solid var(--border-color);
    }
    
    .image-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .preview-placeholder {
        color: var(--text-secondary);
        text-align: center;
    }
    
    .preview-placeholder i {
        font-size: 48px;
        margin-bottom: 12px;
    }
    
    .submit-container {
        margin-top: 40px;
        display: flex;
        justify-content: center;
    }
    
    .submit-btn {
        background-color: var(--primary);
        color: white;
        padding: 14px 36px;
        border: none;
        border-radius: 8px;
        font-size: 18px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .submit-btn:hover {
        background-color: var(--primary-hover);
        transform: translateY(-2px);
    }
    
    .form-check {
        margin-bottom: 8px;
    }
    
    .form-check-input {
        margin-right: 8px;
    }
    
    .form-check-label {
        color: var(--text-primary);
    }
    
    @media (max-width: 768px) {
        .form-container {
            grid-template-columns: 1fr;
        }
    }
    
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }
    
    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }
    
    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }
    
    .invalid-feedback {
        display: block;
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
    
    .is-invalid {
        border-color: #dc3545;
    }
</style>

<script>
    // Preview image upload
    const imageInput = document.getElementById('product_image');
    const imagePreview = document.querySelector('.image-preview');
    const previewPlaceholder = document.querySelector('.preview-placeholder');
    
    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            
            reader.addEventListener('load', function() {
                previewPlaceholder.style.display = 'none';
                
                const img = document.createElement('img');
                img.src = reader.result;
                
                // Remove any existing image
                const existingImg = imagePreview.querySelector('img');
                if (existingImg) {
                    imagePreview.removeChild(existingImg);
                }
                
                imagePreview.appendChild(img);
            });
            
            reader.readAsDataURL(file);
        }
    });
    
    // Color selection
    const colorOptions = document.querySelectorAll('.color-option');
    
    colorOptions.forEach(option => {
        option.addEventListener('click', function() {
            // Remove active class from all options
            colorOptions.forEach(opt => opt.classList.remove('active'));
            
            // Add active class to clicked option
            this.classList.add('active');
        });
    });
    
    // Star rating functionality
    const stars = document.querySelectorAll('.star');
    
    stars.forEach((star, index) => {
        star.addEventListener('click', function() {
            // Update stars based on selection
            stars.forEach((s, i) => {
                if (i <= index) {
                    s.innerHTML = '<i class="fas fa-star"></i>';
                } else {
                    s.innerHTML = '<i class="far fa-star"></i>';
                }
            });
        });
    });
</script>
@endsection