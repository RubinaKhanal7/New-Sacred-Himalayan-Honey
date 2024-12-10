<nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
    <script>
        var navbarStyle = localStorage.getItem("navbarStyle");
        if (navbarStyle && navbarStyle !== 'transparent') {
            document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
        }
    </script>
    <div class="d-flex align-items-center">
        <div class="toggle-icon-wrapper">
            <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip"
                data-bs-placement="left" aria-label="Toggle Navigation" data-bs-original-title="Toggle Navigation">
                <span class="navbar-toggle-icon"><span class="toggle-line"></span></span>
            </button>
        </div>
        <a class="navbar-brand" href="#">
            <div class="d-flex align-items-center py-3">
                <img class="me-2" src="{{ asset('adminassets/assets/img/icons/spot-illustrations/falcon.png') }}"
                    alt="" width="40">
                <span class="font-sans-serif">Admin</span>
            </div>
        </a>
    </div>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <div class="navbar-vertical-content scrollbar">
            <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                <!-- Dashboard Link -->
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Dashboard</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>
                    <a class="nav-link dropdown-indicator" href="#dashboard" role="button" data-bs-toggle="collapse"
                        aria-expanded="true" aria-controls="dashboard">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <svg class="svg-inline--fa fa-chart-pie fa-w-17" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="chart-pie" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 544 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M527.79 288H290.5l158.03 158.03c6.04 6.04 15.98 6.53 22.19.68 38.7-36.46 65.32-85.61 73.13-140.86 1.34-9.46-6.51-17.85-16.06-17.85zm-15.83-64.8C503.72 103.74 408.26 8.28 288.8.04 279.68-.59 272 7.1 272 16.24V240h223.77c9.14 0 16.82-7.68 16.19-16.8zM224 288V50.71c0-9.55-8.39-17.4-17.84-16.06C86.99 51.49-4.1 155.6.14 280.37 4.5 408.51 114.83 513.59 243.03 511.98c50.4-.63 96.97-16.87 135.26-44.03 7.9-5.6 8.42-17.23 1.57-24.08L224 288z">
                                    </path>
                                </svg>
                            </span>
                            <span class="nav-link-text ps-1">Dashboard</span>
                        </div>
                    </a>
                </li>

                <!-- Sitesetting Link -->
                <li class="nav-item">
                        <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                            <div class="col-auto navbar-vertical-label">Site Settings</div>
                            <div class="col ps-0">
                                <hr class="mb-0 navbar-vertical-divider">
                            </div>
                        </div>

                    <a class="nav-link dropdown-indicator" href="#sitesettings" role="button" data-bs-toggle="collapse"
                        aria-expanded="false" aria-controls="sitesettings">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <!-- Icon for sitesettings -->
                                <svg class="svg-inline--fa fa-cog fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="cog" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path fill="currentColor" d="M472 278.9l-42.7-7.1c-4.4-13.1-10.2-25.3-17.2-36.7l20.5-37.3c8.3-15.2 3.6-34.4-11.6-44.1l-37.9-26.7c-11.5-8.1-27.4-5.7-36.1 5.2l-27.5 35.2c-10.9-3.8-22.2-6.7-33.7-8.7l-7.1-42.7C303.6 34.6 290.4 32 277.3 32h-41.1c-13.1 0-26.3 2.6-38.5 7.6l-7.1 42.7c-11.5 2-22.8 5-33.7 8.7l-27.5-35.2c-8.7-11.1-24.6-13.3-36.1-5.2l-37.9 26.7c-15.2 9.7-19.9 28.9-11.6 44.1l20.5 37.3c-7 11.4-12.9 23.6-17.2 36.7l-42.7 7.1C34.6 289.4 32 302.6 32 315.7v41.1c0 13.1 2.6 26.3 7.6 38.5l42.7 7.1c4.4 13.1 10.2 25.3 17.2 36.7l-20.5 37.3c-8.3 15.2-3.6 34.4 11.6 44.1l37.9 26.7c11.5 8.1 27.4 5.7 36.1-5.2l27.5-35.2c10.9 3.8 22.2 6.7 33.7 8.7l7.1 42.7c12.2 5 25.4 7.6 38.5 7.6h41.1c13.1 0 26.3-2.6 38.5-7.6l7.1-42.7c11.5-2 22.8-5 33.7-8.7l27.5 35.2c8.7 11.1 24.6 13.3 36.1 5.2l37.9-26.7c15.2-9.7 19.9-28.9 11.6-44.1l-20.5-37.3c7-11.4 12.9-23.6 17.2-36.7l42.7-7.1c5-12.2 7.6-25.4 7.6-38.5v-41.1c0-13.1-2.6-26.3-7.6-38.5zM256 352c-44.1 0-80-35.9-80-80s35.9-80 80-80 80 35.9 80 80-35.9 80-80 80z"></path>
                                </svg>
                                
                            </span>
                            <span class="nav-link-text ps-1">Site Settings</span>
                        </div>
                    </a>
                    <ul class="nav collapse" id="sitesettings">
                        <li class="nav-item">
                            <!-- Link to view all sitesettings -->
                            <a class="nav-link" href="{{ route('backend.sitesettings.index') }}">Site Settings</a>
                            <a class="nav-link" href="{{ route('backend.aboutus.index') }}">About Us</a>
                            <a class="nav-link" href="{{ route('backend.whyus.index') }}">Why Us</a>
                        </li>
                    </ul>
                </li>


                  <!-- Cover Image Link -->
                  <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Cover Image</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>

                <a class="nav-link dropdown-indicator" href="#coverimages" role="button" data-bs-toggle="collapse"
                    aria-expanded="false" aria-controls="coverimages">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon">
                            <!-- Icon for coverimages -->
                            <svg class="svg-inline--fa fa-cog fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="cog" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path fill="currentColor" d="M472 278.9l-42.7-7.1c-4.4-13.1-10.2-25.3-17.2-36.7l20.5-37.3c8.3-15.2 3.6-34.4-11.6-44.1l-37.9-26.7c-11.5-8.1-27.4-5.7-36.1 5.2l-27.5 35.2c-10.9-3.8-22.2-6.7-33.7-8.7l-7.1-42.7C303.6 34.6 290.4 32 277.3 32h-41.1c-13.1 0-26.3 2.6-38.5 7.6l-7.1 42.7c-11.5 2-22.8 5-33.7 8.7l-27.5-35.2c-8.7-11.1-24.6-13.3-36.1-5.2l-37.9 26.7c-15.2 9.7-19.9 28.9-11.6 44.1l20.5 37.3c-7 11.4-12.9 23.6-17.2 36.7l-42.7 7.1C34.6 289.4 32 302.6 32 315.7v41.1c0 13.1 2.6 26.3 7.6 38.5l42.7 7.1c4.4 13.1 10.2 25.3 17.2 36.7l-20.5 37.3c-8.3 15.2-3.6 34.4 11.6 44.1l37.9 26.7c11.5 8.1 27.4 5.7 36.1-5.2l27.5-35.2c10.9 3.8 22.2 6.7 33.7 8.7l7.1 42.7c12.2 5 25.4 7.6 38.5 7.6h41.1c13.1 0 26.3-2.6 38.5-7.6l7.1-42.7c11.5-2 22.8-5 33.7-8.7l27.5 35.2c8.7 11.1 24.6 13.3 36.1 5.2l37.9-26.7c15.2-9.7 19.9-28.9 11.6-44.1l-20.5-37.3c7-11.4 12.9-23.6 17.2-36.7l42.7-7.1c5-12.2 7.6-25.4 7.6-38.5v-41.1c0-13.1-2.6-26.3-7.6-38.5zM256 352c-44.1 0-80-35.9-80-80s35.9-80 80-80 80 35.9 80 80-35.9 80-80 80z"></path>
                            </svg>
                            
                        </span>
                        <span class="nav-link-text ps-1">Cover Images</span>
                    </div>
                </a>
                <ul class="nav collapse" id="coverimages">
                    <li class="nav-item">
                        <!-- Link to view all coverimages -->
                        <a class="nav-link" href="{{ route('backend.coverimages.index') }}">Cover Images</a>
                    </li>
                </ul>
            </li>

                 <!-- Gallery Link -->
                 <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Gallery</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>
                    <a class="nav-link dropdown-indicator" href="#galleries" role="button" data-bs-toggle="collapse"
                        aria-expanded="false" aria-controls="galleries">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <!-- Icon for galleries -->
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-newspaper fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="newspaper" role="img">
                                    <path fill="currentColor" d="M464 32H48C21.49 32 0 53.49 0 80v320c0 26.51 21.49 48 48 48h48v48c0 13.25 10.75 24 24 24h288c13.25 0 24-10.75 24-24v-48h48c26.51 0 48-21.49 48-48V80c0-26.51-21.49-48-48-48zm-48 368H96v-96h320zm0-144H96V80h320z"></path>
                                </svg>
                                
                            </span>
                            <span class="nav-link-text ps-1">Gallery</span>
                        </div>
                    </a>
                    <ul class="nav collapse" id="galleries">
                        <li class="nav-item">
                            <!-- Link to create photo galleries -->
                            <a class="nav-link" href="{{ route('backend.photogalleries.index') }}">Photo Gallery</a>
                        </li>
                        <li class="nav-item">
                            <!-- Link to create video galleries -->
                            <a class="nav-link" href="{{ route('backend.videogalleries.index') }}">Video Gallery</a>
                        </li>
                    </ul>
                </li>


                <!-- Product Management Dropdown -->
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Product Management</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>
                    <a class="nav-link dropdown-indicator" href="#product-management" role="button"
                        data-bs-toggle="collapse" aria-expanded="false" aria-controls="product-management">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <!-- Replace the SVG code with your desired logo -->
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    width="24" height="24">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M21 5.17L19.59 3.76 7.83 15.51 7.83 19.17 11.5 19.17 23.24 7.41 21.83 6 21 5.17zM7.83 13.51L13.83 7.51 16.48 10.16 10.47 16.17 7.83 13.51zM2.5 20.92l2.56-2.57 1.42 1.41-2.56 2.57c-.39.39-1.02.39-1.41 0-.4-.39-.4-1.03 0-1.41zm18.95-16.61c.39-.39 1.02-.39 1.41 0 .4.39.4 1.02 0 1.41l-1.03 1.03-1.41-1.41 1.03-1.03z" />
                                </svg>
                            </span>
                            <span class="nav-link-text ps-1">Product Management</span>
                        </div>
                    </a>
                    <ul class="nav collapse" id="product-management">
                        <!-- Add link to product categories -->
                        @can('create_categories')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('backend.categories.index') }}">Categories</a>
                            </li>
                        @endcan

                        <!-- Add link to product brands -->
                        @can('create_brands')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('backend.brands.index') }}">Brands</a>
                            </li>
                        @endcan

                        <!-- Add link to products -->
                        @can('create_products')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('backend.products.index') }}">Products</a>
                            </li>
                        @endcan
                    </ul>
                </li>



                
                    <!-- Order Management Dropdown -->
                    <li class="nav-item">
                        <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                            <div class="col-auto navbar-vertical-label">Order Management</div>
                            <div class="col ps-0">
                                <hr class="mb-0 navbar-vertical-divider">
                            </div>
                        </div>
                        <a class="nav-link dropdown-indicator" href="#order-management" role="button"
                            data-bs-toggle="collapse" aria-expanded="false" aria-controls="order-management">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon">
                                    <svg class="svg-inline--fa fa-shopping-cart fa-w-18" aria-hidden="true"
                                        focusable="false" data-prefix="fas" data-icon="shopping-cart" role="img"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                        <path fill="currentColor"
                                            d="M512 160h-64V64c0-35.35-28.65-64-64-64H192c-35.35 0-64 28.65-64 64v96H64c-35.35 0-64 28.65-64 64v256c0 35.35 28.65 64 64 64h448c35.35 0 64-28.65 64-64V224c0-35.35-28.65-64-64-64zm-256-96c0-17.67 14.33-32 32-32h192c17.67 0 32 14.33 32 32v96H256V64zm-64 416H96v-64h96zm0-128H96v-64h96zm0-128H96v-64h96zm128 256H160v-64h128zm0-128H160v-64h128zm0-128H160v-64h128zm192 256H288v-64h192zm0-128H288v-64h192zm0-128H288v-64h192z">
                                        </path>
                                    </svg>
                                </span>
                                <span class="nav-link-text ps-1">Order Management</span>
                            </div>
                        </a>
                        <ul class="nav collapse" id="order-management">
                            <!-- Add link to orders -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('backend.orders.index') }}">Orders</a>
                            </li>
                           
                        </ul>
                      
                    </li>
                


                <!-- Customers Link -->
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Customers</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>
                    <a class="nav-link dropdown-indicator" href="#customers" role="button" data-bs-toggle="collapse"
                        aria-expanded="false" aria-controls="customers">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <svg class="svg-inline--fa fa-users fa-w-20" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="users" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M96 256a128 128 0 1 0 0-256 128 128 0 0 0 0 256zm448-32a128 128 0 1 0 0-256 128 128 0 0 0 0 256zM309.1 128c4.4 9.9 8.9 20.1 13.4 30.4a72 72 0 0 0 69.2 42.7H480a72 72 0 0 0 69.2-42.7c4.5-10.3 9-20.5 13.4-30.4H309.1zM120 256a120 120 0 0 0-120 120c0 66.2 53.8 120 120 120h56a72 72 0 0 0 72-72V360a72 72 0 0 0-72-72h-56zm240 64h56a72 72 0 0 1 72 72v24a72 72 0 0 1-72 72h-56a120 120 0 0 1-120-120 120 120 0 0 1 120-120zm240 0a120 120 0 0 0-120 120c0 66.2 53.8 120 120 120h56a72 72 0 0 0 72-72V360a72 72 0 0 0-72-72h-56z">
                                    </path>
                                </svg>
                            </span>
                            <span class="nav-link-text ps-1">Customers</span>
                        </div>
                    </a>
                    <ul class="nav collapse" id="customers">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('backend.customers.index') }}">View All</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('backend.customers.create') }}">Add New</a>
                        </li>
                    </ul>
                </li>


                <!-- Shopping Cart Dropdown -->
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Shopping Cart</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>
                    <a class="nav-link dropdown-indicator" href="#shopping-cart" role="button"
                        data-bs-toggle="collapse" aria-expanded="false" aria-controls="shopping-cart">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <svg class="svg-inline--fa fa-shopping-cart fa-w-18" aria-hidden="true"
                                    focusable="false" data-prefix="fas" data-icon="shopping-cart" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <path fill="currentColor"
                                        d="M512 160h-64V64c0-35.35-28.65-64-64-64H192c-35.35 0-64 28.65-64 64v96H64c-35.35 0-64 28.65-64 64v256c0 35.35 28.65 64 64 64h448c35.35 0 64-28.65 64-64V224c0-35.35-28.65-64-64-64zm-256-96c0-17.67 14.33-32 32-32h192c17.67 0 32 14.33 32 32v96H256V64zm-64 416H96v-64h96zm0-128H96v-64h96zm0-128H96v-64h96zm128 256H160v-64h128zm0-128H160v-64h128zm0-128H160v-64h128zm192 256H288v-64h192zm0-128H288v-64h192zm0-128H288v-64h192z">
                                    </path>
                                </svg>
                            </span>
                            <span class="nav-link-text ps-1">Shopping Cart</span>
                        </div>
                    </a>
                    <ul class="nav collapse" id="shopping-cart">
                        <!-- Add link to carts -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('backend.carts.index') }}">Carts</a>
                        </li>
                    </ul>
                </li>



                <!-- Coupons Link -->
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Coupons</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>
                    <a class="nav-link dropdown-indicator" href="#coupons" role="button" data-bs-toggle="collapse"
                        aria-expanded="false" aria-controls="coupons">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <!-- Icon for coupons -->
                                <svg class="svg-inline--fa fa-tags fa-w-20" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="tags" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M619.67 302.9L337.47 20.7c-9.4-9.4-24.6-9.4-33.9 0L20.7 303c-9.4 9.4-9.4 24.6 0 33.9l282.2 282.2c9.4 9.4 24.6 9.4 33.9 0l282.2-282.2c9.5-9.4 9.5-24.6.1-34zM284.4 84.7l256.3 256.3-82.2 82.2-256.3-256.3 82.2-82.2zm-29.8 221.2L83.5 497.5c-4.7 4.7-12.3 4.7-17 0l-56.6-56.6c-4.7-4.7-4.7-12.3 0-17l223.1-223.1 73.1 73.1-56.6 56.6zm322.7-34l-73.1-73.1L503 122.5l73.1 73.1-90.8 90.3zM146.2 32.7l73.1 73.1-90.3 90.8-73.1-73.1 90.3-90.8zm99.5 99.5L338.8 205l-49.3 49.3-22.6-22.6 49.3-49.3zm-65.6 22.6L375.5 205l-49.3 49.3-22.6-22.6 49.3-49.3zM318.9 307l-49.3 49.3-22.6-22.6 49.3-49.3 22.6 22.6zM256 346.8l49.3-49.3 22.6 22.6-49.3 49.3-22.6-22.6z">
                                    </path>
                                </svg>
                            </span>
                            <span class="nav-link-text ps-1">Coupons</span>
                        </div>
                    </a>
                    <ul class="nav collapse" id="coupons">
                        <li class="nav-item">
                            <!-- Link to view all coupons -->
                            <a class="nav-link" href="{{ route('backend.coupons.index') }}">View All</a>
                        </li>
                        <li class="nav-item">
                            <!-- Link to create a new coupon -->
                            <a class="nav-link" href="{{ route('backend.coupons.create') }}">Add New</a>
                        </li>
                    </ul>
                </li>


                <!-- Inventories Link -->
                {{-- <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Inventories</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>
                    <a class="nav-link dropdown-indicator" href="#inventories" role="button"
                        data-bs-toggle="collapse" aria-expanded="false" aria-controls="inventories">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <!-- Icon for inventories -->
                                <svg class="svg-inline--fa fa-boxes fa-w-20" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="boxes" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M160 128V64h384v64zm128 192h128v128H288zm-192-64H64V192h128zm192 0H320V192h128zM64 320h128v128H64z">
                                    </path>
                                </svg>
                            </span>
                            <span class="nav-link-text ps-1">Inventories</span>
                        </div>
                    </a>
                    <ul class="nav collapse" id="inventories">
                        <li class="nav-item">
                            <!-- Link to view all inventories -->
                            <a class="nav-link" href="{{ route('backend.inventories.index') }}">View All</a>
                        </li>
                        <li class="nav-item">
                            <!-- Link to create a new inventory -->
                            <a class="nav-link" href="{{ route('backend.inventories.create') }}">Add New</a>
                        </li>
                    </ul>
                </li> --}}





                <!-- Shipments Link -->
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Shipments</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>
                    <a class="nav-link dropdown-indicator" href="#shipments" role="button"
                        data-bs-toggle="collapse" aria-expanded="false" aria-controls="shipments">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <!-- Icon for shipments -->
                                <svg class="svg-inline--fa fa-truck fa-w-20" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="truck" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M624 352h-16V240c0-8.84-7.16-16-16-16h-48v-64c0-17.67-14.33-32-32-32h-64v128h-64V112c0-17.67-14.33-32-32-32H16c-8.84 0-16 7.16-16 16v304c0 8.84 7.16 16 16 16h16v-16c0-17.67 14.33-32 32-32h192c17.67 0 32 14.33 32 32v16h128v-16c0-17.67 14.33-32 32-32h32v-16h176c8.84 0 16-7.16 16-16v-48c0-8.84-7.16-16-16-16zm-400-64v-64H32v64h192zM64 352c0-17.67-14.33-32-32-32s-32 14.33-32 32 14.33 32 32 32 32-14.33 32-32zm496 32c17.67 0 32-14.33 32-32s-14.33-32-32-32-32 14.33-32 32 14.33 32 32 32zm48-32h-64v-64h64v64zm-416-32c0-17.67-14.33-32-32-32s-32 14.33-32 32 14.33 32 32 32 32-14.33 32-32zm176 0h-64v-64h64v64zm0-96h-64v-32h64v32zm96 64h-64v-64h64v64zm0-96h-64v-32h64v32zm176 64h-64v-64h64v64z">
                                    </path>
                                </svg>
                            </span>
                            <span class="nav-link-text ps-1">Shipments</span>
                        </div>
                    </a>
                    <ul class="nav collapse" id="shipments">
                        <li class="nav-item">
                            <!-- Link to view all shipments -->
                            <a class="nav-link" href="{{ route('backend.shipments.index') }}">View All</a>
                        </li>
                        <li class="nav-item">
                            <!-- Link to create a new shipment -->
                            <a class="nav-link" href="{{ route('backend.shipments.create') }}">Add New</a>
                        </li>
                    </ul>
                </li>



                <!-- Transactions Link -->
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Transactions</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>
                    <a class="nav-link dropdown-indicator" href="#transactions" role="button"
                        data-bs-toggle="collapse" aria-expanded="false" aria-controls="transactions">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <!-- Icon for transactions -->
                                <svg class="svg-inline--fa fa-money-bill fa-w-20" aria-hidden="true"
                                    focusable="false" data-prefix="fas" data-icon="money-bill" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M320 144c-44.18 0-80 35.82-80 80s35.82 80 80 80 80-35.82 80-80-35.82-80-80-80zm-192 96c-8.84 0-16-7.16-16-16v-48c0-8.84 7.16-16 16-16s16 7.16 16 16v48c0 8.84-7.16 16-16 16zm416 0c-8.84 0-16-7.16-16-16v-48c0-8.84 7.16-16 16-16s16 7.16 16 16v48c0 8.84-7.16 16-16 16zM576 64H64C28.65 64 0 92.65 0 128v256c0 35.35 28.65 64 64 64h512c35.35 0 64-28.65 64-64V128c0-35.35-28.65-64-64-64zM320 336c-61.86 0-112-50.14-112-112s50.14-112 112-112 112 50.14 112 112-50.14 112-112 112zm128 64H192c-8.84 0-16-7.16-16-16s7.16-16 16-16h256c8.84 0 16 7.16 16 16s-7.16 16-16 16z">
                                    </path>
                                </svg>
                            </span>
                            <span class="nav-link-text ps-1">Transactions</span>
                        </div>
                    </a>
                    <ul class="nav collapse" id="transactions">
                        <li class="nav-item">
                            <!-- Link to view all transactions -->
                            <a class="nav-link" href="{{ route('backend.transactions.index') }}">View All</a>
                        </li>
                        <li class="nav-item">
                            <!-- Link to create a new transaction -->
                            <a class="nav-link" href="{{ route('backend.transactions.create') }}">Add New</a>
                        </li>
                    </ul>
                </li>


                <!-- Wishlists Link -->
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Wishlists</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>
                    <a class="nav-link dropdown-indicator" href="#wishlists" role="button"
                        data-bs-toggle="collapse" aria-expanded="false" aria-controls="wishlists">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <!-- Icon for wishlists -->
                                <svg class="svg-inline--fa fa-heart fa-w-20" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="heart" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M462.3 62.7c-54.5-46.4-136-38.6-186.4 13.6L256 96.9l-19.9-20.6c-50.3-52.1-131.9-60-186.4-13.6C7.4 82.2-10.6 132.3 1.7 178.3c9.2 35.5 30.3 70.2 59.5 98.7l175.4 178.7c6.6 6.7 15.3 10.2 24 10.2s17.4-3.4 24-10.2l175.4-178.7c29.3-28.5 50.4-63.2 59.5-98.7 12.2-46.1-5.7-96.2-48.6-115.6zM256 464L80.8 286.3C52 258.3 32 225.4 23.5 193.9 15.4 163.6 28.7 127.6 60.5 105.6c37.4-26 87.6-20.1 121.1 13.6L256 189.4l74.4-70.2c33.5-33.7 83.7-39.6 121.1-13.6 31.8 22 45.1 58 37 88.3-8.5 31.4-28.5 64.4-57.3 92.4L256 464z">
                                    </path>
                                </svg>
                            </span>
                            <span class="nav-link-text ps-1">Wishlists</span>
                        </div>
                    </a>
                    <ul class="nav collapse" id="wishlists">
                        <li class="nav-item">
                            <!-- Link to view all wishlists -->
                            <a class="nav-link" href="{{ route('backend.wishlists.index') }}">View All</a>
                        </li>
                        <li class="nav-item">
                            <!-- Link to create a new wishlist -->
                            <a class="nav-link" href="{{ route('backend.wishlists.create') }}">Add New</a>
                        </li>
                    </ul>
                </li>



                <!-- Payments Link -->
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Payment Integration</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>
                    <a class="nav-link dropdown-indicator" href="#payments" role="button" data-bs-toggle="collapse"
                        aria-expanded="false" aria-controls="payments">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <!-- Icon for payments -->
                                <svg class="svg-inline--fa fa-credit-card fa-w-20" aria-hidden="true"
                                    focusable="false" data-prefix="fas" data-icon="credit-card" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M0 80C0 53.49 21.49 32 48 32H528c26.51 0 48 21.49 48 48V144H0V80zM576 192v192c0 26.51-21.49 48-48 48H48c-26.51 0-48-21.49-48-48V192H576zM128 320c-17.67 0-32 14.33-32 32s14.33 32 32 32h320c17.67 0 32-14.33 32-32s-14.33-32-32-32H128z">
                                    </path>
                                </svg>
                            </span>
                            <span class="nav-link-text ps-1">Payment Integration</span>
                        </div>
                    </a>
                    <ul class="nav collapse" id="payments">
                        <li class="nav-item">
                            <!-- Link to view all payments -->
                            <a class="nav-link" href="{{ route('backend.payments.index') }}">View All</a>
                        </li>
                        <li class="nav-item">
                            <!-- Link to create a new payment -->
                            <a class="nav-link" href="{{ route('backend.payments.create') }}">Add New</a>
                        </li>
                    </ul>
                </li>

                 <!-- Blogpost Link -->
                 <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Blogs</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>
                    <a class="nav-link dropdown-indicator" href="#blogpostscategories" role="button" data-bs-toggle="collapse"
                        aria-expanded="false" aria-controls="blogpostscategories">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <!-- Icon for blogpostscategories -->
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-newspaper fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="newspaper" role="img">
                                    <path fill="currentColor" d="M464 32H48C21.49 32 0 53.49 0 80v320c0 26.51 21.49 48 48 48h48v48c0 13.25 10.75 24 24 24h288c13.25 0 24-10.75 24-24v-48h48c26.51 0 48-21.49 48-48V80c0-26.51-21.49-48-48-48zm-48 368H96v-96h320zm0-144H96V80h320z"></path>
                                </svg>
                                
                            </span>
                            <span class="nav-link-text ps-1">Blogs</span>
                        </div>
                    </a>
                    <ul class="nav collapse" id="blogpostscategories">
                        <li class="nav-item">
                            <!-- Link to view all blogpostscategories -->
                            <a class="nav-link" href="{{ route('backend.blogpostscategories.index') }}">View All</a>
                        </li>
                        <li class="nav-item">
                            <!-- Link to create a new blogpostscategories -->
                            <a class="nav-link" href="{{ route('backend.blogpostscategories.create') }}">Add New</a>
                        </li>
                    </ul>
                </li>

                 <!-- Testimonial Link -->
                 <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Testimonial</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>
                    <a class="nav-link dropdown-indicator" href="#testimonials" role="button" data-bs-toggle="collapse"
                        aria-expanded="false" aria-controls="testimonials">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <!-- Icon for testimonials -->
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-newspaper fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="newspaper" role="img">
                                    <path fill="currentColor" d="M464 32H48C21.49 32 0 53.49 0 80v320c0 26.51 21.49 48 48 48h48v48c0 13.25 10.75 24 24 24h288c13.25 0 24-10.75 24-24v-48h48c26.51 0 48-21.49 48-48V80c0-26.51-21.49-48-48-48zm-48 368H96v-96h320zm0-144H96V80h320z"></path>
                                </svg>
                                
                            </span>
                            <span class="nav-link-text ps-1">Testimonial</span>
                        </div>
                    </a>
                    <ul class="nav collapse" id="testimonials">
                        <li class="nav-item">
                            <!-- Link to view all testimonials -->
                            <a class="nav-link" href="{{ route('backend.testimonials.index') }}">View All</a>
                        </li>
                        <li class="nav-item">
                            <!-- Link to create a new testimonials -->
                            <a class="nav-link" href="{{ route('backend.testimonials.create') }}">Add New</a>
                        </li>
                    </ul>
                </li>

                <!-- Contact Link -->
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Contact</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>
                    <a class="nav-link dropdown-indicator" href="#contacts" role="button" data-bs-toggle="collapse"
                        aria-expanded="false" aria-controls="contacts">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <!-- Icon for contacts -->
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-newspaper fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="newspaper" role="img">
                                    <path fill="currentColor" d="M464 32H48C21.49 32 0 53.49 0 80v320c0 26.51 21.49 48 48 48h48v48c0 13.25 10.75 24 24 24h288c13.25 0 24-10.75 24-24v-48h48c26.51 0 48-21.49 48-48V80c0-26.51-21.49-48-48-48zm-48 368H96v-96h320zm0-144H96V80h320z"></path>
                                </svg>
                                
                            </span>
                            <span class="nav-link-text ps-1">Contact</span>
                        </div>
                    </a>
                    <ul class="nav collapse" id="contacts">
                        <li class="nav-item">
                            <!-- Link to view all contacts -->
                            <a class="nav-link" href="{{ route('backend.contacts.index') }}">View All</a>
                        </li>
                    </ul>
                </li>

                
            </ul>
        </div>
    </div>
</nav>
