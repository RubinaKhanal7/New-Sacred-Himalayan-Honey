@extends('frontend.layouts.master')
@section('content')


  <section class="container-fluid">
    <div class="customsection customsection_product">
    <div class="container productitems_content d-flex flex-column align-center justify-center py-2">
    <!-- <div class="search-section d-flex justify-content-end mb-4">
        <form id="searchForm" action="{{ route('search') }}" method="GET">
          <input class="form-control me-2" type="search" id="searchInput" name="query" placeholder="Search" aria-label="Search" value="{{ request('query') }}" />
        </form>
      </div> -->
    @foreach ($categories as $category)
           <div class="titlebannnersection ">
                <span class="d-flex flex-column justify-content-center align-items-center containertitle">
                      <h2 class="d-flex justify-content-center pt-5 pb-1">{{ $category->category_name }}</h2>
                        <p class="commondescription text-center">{{ $category->description }}</p>
                </span>
            </div>
            <div class="productsection row mx-4 align-items-center d-flex flex-wrap singleproduct" id="productSection">
                        @foreach ($category->products as $product)
                        <a href="{{ route('show', ['id' => $product->id]) }}" class="col-md-3 align-items-center d-flex flex-column product_item_collection ">
                            <div class="product_image_price">
                                <span class="price text-center">${{ $product->selling_price }}</span>
                                <div class="product_image">
                                    <img src="{{ asset($product->product_image) }}" alt="{{ $product->product_name }}" />
                                </div>
                                <h6 class="py-2">{{ $product->product_name }}</h6>
                                {{-- <p style="color: black">
                                  {{ Str::limit($product->description, 100, '...') }}
                                </p> --}}
                            </div>
                            <div class="buy_addbuttom">
                                <button class="addtocart" onclick="addToCart({{ $product->id }}, '{{ $product->product_name }}', {{ $product->selling_price }})">Add To Cart</button>
                            </div>
                        </a>
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



















  <script>
    // Function to handle form submission
    document.getElementById('searchForm').addEventListener('submit', function(event) {
      event.preventDefault();
      const query = document.getElementById('searchInput').value.trim();
      if (query.length > 0) {
        this.submit();
      }
    });
    // Function to handle Enter key press
    document.getElementById('searchInput').addEventListener('keypress', function(event) {
      if (event.key === 'Enter') {
        event.preventDefault();
        document.getElementById('searchForm').submit();
      }
    });
    // Function to add product to cart (simulated example)
    function addToCart(id, name, price) {
      let cart = JSON.parse(localStorage.getItem('cart') || '{}');
      if (cart[id]) {
        cart[id].quantity += 1;
      } else {
        cart[id] = { id: id, name: name, price: price, quantity: 1 };
      }
      localStorage.setItem('cart', JSON.stringify(cart));
      updateCartCount();
      window.location.href = "{{ route('show', '') }}/" + id;
    }
    // Function to update cart count (simulated example)
    function updateCartCount() {
      let cart = JSON.parse(localStorage.getItem('cart') || '{}');
      let count = Object.values(cart).reduce((total, item) => total + item.quantity, 0);
      document.getElementById('cartCount').textContent = count;
    }
    // Call this when the page loads
    document.addEventListener('DOMContentLoaded', updateCartCount);
  </script>
@endsection