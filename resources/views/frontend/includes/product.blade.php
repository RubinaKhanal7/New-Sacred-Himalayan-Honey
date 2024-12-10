<!-- <section class="container-fluid">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 160">
        <path fill="#fff6e6" fill-opacity="1"
            d="M0,128L120,117.3C240,107,480,85,720,90.7C960,96,1200,128,1320,144L1440,160L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z">
        </path>
    </svg>
    <div class="customsection customsection_product">
        <div class="container">    
   <div class="titlebannnersection">
                <span class="d-flex flex-column justify-content-center align-items-center containertitle">
                    <h2 class="d-flex justify-content-center">Product We Provide</h2>
                </span>
            </div>
            <div class="productsection d-flex justify-content-between row pb-5">
                @foreach ($products as $product)
                <div class="productsectioncontent d-flex flex-column justify-content-center align-items-center text-center col-md-2 col-10 my-3 mx-4">
                    <div class="productsectioncontent_imagecontainer">
                        <img src="{{ asset($product->product_image) }}" alt="{{ $product->product_name }}" />
                    </div>
                    <span>{{ $product->product_name }}</span>
                    <span class="price">${{ $product->selling_price }}</span>
                    <a href="#" class="addtocart" onclick="addToCart({{ $product->id }}, '{{ $product->product_name }}', {{ $product->selling_price }})">Add To Cart</a>
                </div>
                @endforeach
            </div>
            <script>
                function addToCart(id, name, price) {
                    let cart = JSON.parse(localStorage.getItem('cart') || '{}');
                    if (cart[id]) {
                        cart[id].quantity += 1;
                    } else {
                        cart[id] = {id: id, name: name, price: price, quantity: 1};
                    }
                    localStorage.setItem('cart', JSON.stringify(cart));
                    updateCartCount();
                    window.location.href = "{{ route('show', '') }}/" + id;
                }

                function updateCartCount() {
                    let cart = JSON.parse(localStorage.getItem('cart') || '{}');
                    let count = Object.values(cart).reduce((total, item) => total + item.quantity, 0);
                    document.getElementById('cartCount').textContent = count;
                }

                // Call this when the page loads
                document.addEventListener('DOMContentLoaded', updateCartCount);
            </script>
        </div>
    </div>
</section> -->

<style>
    /* Apply styles for mobile devices */
@media (max-width: 767px) {
    .productsection {
        flex-direction: column;
    }

    .productsectioncontent {
        width: 100%;
        margin: 0 auto;
        padding: 0 10px;
    }

    .productsectioncontent_imagecontainer img {
        max-width: 100%;
        height: auto;
    }

    .titlebannnersection {
        margin-bottom: 1rem;
    }

    .addtocart {
        display: inline-block;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        background: #8B4513;
        color: #fff;
        text-decoration: none;
        margin-top: 0.5rem;
        border-radius: 20px;
        border: none;
    }
        .addtocart:hover {
            background: #faa000;
    }

    .productsectioncontent h6 {
        font-size: 1rem;
    }
}

</style>
<section class="container-fluid">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 160">
        <path fill="#fff6e6" fill-opacity="1"
            d="M0,128L120,117.3C240,107,480,85,720,90.7C960,96,1200,128,1320,144L1440,160L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z">
        </path>
    </svg>
    <div class="customsection customsection_product">
    <div class="container productitems_content d-flex flex-column align-center justify-center py-2">
    @foreach ($categories as $category)
           <div class="titlebannnersection ">
                <span class="d-flex flex-column justify-content-center align-items-center containertitle">
                      <h2 class="d-flex justify-content-center py-2">{{ $category->category_name }}</h2>
                        <p class="commondescription text-center">{{ $category->description }}</p>
                </span>
            </div>
            <div class="productsection d-flex justify-center align-center">
            @foreach ($category->products as $product)
                    <div class="productsectioncontent d-flex flex-column justify-content-center align-items-center text-center col-md-3 col-10 my-3 mx-4">
                        <div class="productsectioncontent_imagecontainer">
                            <img src="{{ asset($product->product_image) }}" alt="{{ $product->product_name }}" />
                        </div>
                        <h6 class="py-2">{{ $product->product_name }}</h6>
                        {{-- <p>
                            {{ Str::limit($product->description, 100, '...') }}
                        </p> --}}
                        <span class="price">${{ $product->selling_price }}</span>
                        <a href="#" class="addtocart" onclick="addToCart({{ $product->id }}, '{{ $product->product_name }}', {{ $product->selling_price }})">Add To Cart</a>
                    </div>
                    @endforeach
            
            
                 
            </div>
            @endforeach

    </div>

    </div>
    <script>
                function addToCart(id, name, price) {
                    let cart = JSON.parse(localStorage.getItem('cart') || '{}');
                    if (cart[id]) {
                        cart[id].quantity += 1;
                    } else {
                        cart[id] = {id: id, name: name, price: price, quantity: 1};
                    }
                    localStorage.setItem('cart', JSON.stringify(cart));
                    updateCartCount();
                    window.location.href = "{{ route('show', '') }}/" + id;
                }
                function updateCartCount() {
                    let cart = JSON.parse(localStorage.getItem('cart') || '{}');
                    let count = Object.values(cart).reduce((total, item) => total + item.quantity, 0);
                    document.getElementById('cartCount').textContent = count;
                }
                // Call this when the page loads
                document.addEventListener('DOMContentLoaded', updateCartCount);
            </script>


</section>



