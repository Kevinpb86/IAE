@extends('layouts.layouts')

@section('content')
<!-- Hero Section -->
<section class="bg-black p-0 m-0">
    <div class="container-fluid px-0">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-inner" style="height: 350px; @media (min-width: 768px) { height: 450px; }">
                <div class="carousel-item active">
                    <img src="{{ asset('images/carrousels1.png') }}" class="d-block w-100 h-100 object-fit-cover" alt="Hero Image 1">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/carrousels2.png') }}" class="d-block w-100 h-100 object-fit-cover" alt="Hero Image 2">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/carrousels3.png') }}" class="d-block w-100 h-100 object-fit-cover" alt="Hero Image 3">
                </div>
                <!-- Tambahkan slide lain jika perlu -->
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="bg-[#f3efec] py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-semibold text-center mb-10 text-black">Featured Products</h2>
        <div id="featuredProductsCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($products->chunk(5) as $chunkIndex => $chunk)
                    <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
                        <div class="d-flex justify-content-center gap-3">
                            @foreach($chunk as $product)
                                <div class="bg-white rounded-lg shadow-md overflow-hidden text-center" style="width: 250px;">
                                    <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->product_name }}" class="w-full h-40 object-contain bg-gray-50 mb-4">
                                    <h3 class="font-medium text-gray-800 mb-2">{{ $product->product_name }}</h3>
                                    <div class="text-primary font-semibold text-lg mb-2">${{ number_format($product->price, 2) }}</div>
                                    <a href="{{ route('shop') }}" class="bg-black text-white px-4 py-2 rounded font-medium inline-block">Shop Now</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev custom-carousel-btn" type="button" data-bs-target="#featuredProductsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next custom-carousel-btn" type="button" data-bs-target="#featuredProductsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>

<!-- Promotion Banner -->
<section class="py-16 bg-cover bg-center relative" style="background-image: url({{ asset('images/promo-banner.jpg') }});">
    <div class="absolute inset-0 bg-black bg-opacity-80"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center text-white">
            <h2 class="text-3xl font-bold mb-4">Start Of New Dress</h2>
            <p class="text-xl mb-6">Crafted with New Valuable Designs in Dress</p>
            <a href="#" class="bg-black text-white px-6 py-3 rounded font-medium inline-block">Shop Now</a>
        </div>
    </div>
</section>

<!-- Exclusive Collection Section -->
<section class="bg-black py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-semibold text-center mb-10 text-white">Exclusive Collection</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($products as $product)
            <div class="bg-black rounded-lg shadow-sm overflow-hidden transform hover:-translate-y-1 hover:shadow-lg transition duration-300">
                <div class="relative">
                    <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-64 object-cover">
                    <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-80 py-3 px-4 transform translate-y-full opacity-0 group-hover:opacity-100 group-hover:translate-y-0 transition duration-300">
                        <button class="w-full bg-black text-white py-2 rounded font-medium">Add to Cart</button>
                    </div>
                </div>
                <div class="p-4">
                    <div class="flex text-yellow-400 mb-2">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $product->rating)
                                <i class="fas fa-star"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif
                        @endfor
                    </div>
                    <h3 class="font-medium text-white mb-2">{{ $product->name }}</h3>
                    <div class="text-white font-semibold text-lg mb-4">${{ number_format($product->price, 2) }}</div>
                    <div class="flex justify-between">
                        <button class="border border-gray-300 rounded px-2 py-1 hover:bg-gray-100">
                            <i class="far fa-heart"></i>
                        </button>
                        <button class="bg-black text-white rounded px-4 py-1 flex-grow mx-1">
                            Add to Cart
                        </button>
                        <button class="border border-gray-300 rounded px-2 py-1 hover:bg-gray-100">
                            <i class="far fa-eye"></i>
                        </button>
                        <button class="border border-gray-300 rounded px-2 py-1 hover:bg-gray-100">
                            <i class="fas fa-retweet"></i>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="flex justify-center mt-10 space-x-2">
            <span class="w-3 h-3 rounded-full bg-black inline-block cursor-pointer"></span>
            <span class="w-3 h-3 rounded-full bg-gray-300 inline-block cursor-pointer"></span>
            <span class="w-3 h-3 rounded-full bg-gray-300 inline-block cursor-pointer"></span>
        </div>
    </div>
</section>
@endsection


<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JS (letakkan sebelum </body>) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<style>
.object-fit-cover {
    object-fit: cover;
    height: 100%;
}


#featuredProductsCarousel .carousel-control-prev,
#featuredProductsCarousel .carousel-control-next {
    width: 50px; /* Adjust control width only for the products carousel */
}

/* Custom styles for carousel buttons */
.custom-carousel-btn {
    background-color: black;
    border: 2px solid black;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 5;
}

.custom-carousel-btn .carousel-control-prev-icon,
.custom-carousel-btn .carousel-control-next-icon {
    background-color: black;
    width: 20px;
    height: 20px;
    border-radius: 50%;
}

.custom-carousel-btn:hover {
    background-color: black;
    color: white;
}

.custom-carousel-btn.carousel-control-prev {
    left: -20px; /* Adjust position */
}

.custom-carousel-btn.carousel-control-next {
    right: -20px; /* Adjust position */
}
</style>