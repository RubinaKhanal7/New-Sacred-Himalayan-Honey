<?php

use App\Models\SuperAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\SitesettingController;
use App\Http\Controllers\BlogPostsCategoryController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\WhyusController;
use App\Http\Controllers\PhotoGalleryController;
use App\Http\Controllers\VideoGalleryController;
use App\Http\Controllers\FrontviewController;
use App\Http\Controllers\SingleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CoverImageController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\ChangePasswordController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\PaymentWithoutLoginController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\OrderWithoutLoginController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/layout', function () {
    return view('layouts2.superadmin');
});
Route::get('/dashboard', [FrontviewController::class, 'userIndex'])->middleware(['auth'])->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/change-password', [ChangePasswordController::class, 'showChangePasswordForm'])->name('password.change.form');
    Route::post('/profile/change-password', [ChangePasswordController::class, 'updatePassword'])->name('password.change');



    // Customer related routes


});
Route::middleware(['auth:superadmin'])->prefix('backend')->name('backend.')->group(function () {

    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');


    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');


    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    


    Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
    Route::get('/brands/create', [BrandController::class, 'create'])->name('brands.create');
    Route::post('/brands', [BrandController::class, 'store'])->name('brands.store');
    Route::get('/brands/{brand}/edit', [BrandController::class, 'edit'])->name('brands.edit');
    Route::put('/brands/{brand}', [BrandController::class, 'update'])->name('brands.update');
    Route::delete('/brands/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy');

   


    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/categories/{category}/brands', [ProductController::class, 'getBrands'])->name('products.getBrands');


    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
    Route::get('/payments/{payment}/edit', [PaymentController::class, 'edit'])->name('payments.edit');
    Route::put('/payments/{payment}', [PaymentController::class, 'update'])->name('payments.update');
    Route::delete('/payments/{payment}', [PaymentController::class, 'destroy'])->name('payments.destroy');


    Route::get('/coupons', [CouponController::class, 'index'])->name('coupons.index');
    Route::get('/coupons/create', [CouponController::class, 'create'])->name('coupons.create');
    Route::post('/coupons', [CouponController::class, 'store'])->name('coupons.store');
    Route::get('/coupons/{coupon}/edit', [CouponController::class, 'edit'])->name('coupons.edit');
    Route::put('/coupons/{coupon}', [CouponController::class, 'update'])->name('coupons.update');
    Route::delete('/coupons/{coupon}', [CouponController::class, 'destroy'])->name('coupons.destroy');


    Route::get('/inventories', [InventoryController::class, 'index'])->name('inventories.index');
    Route::get('/inventories/create', [InventoryController::class, 'create'])->name('inventories.create');
    Route::post('/inventories', [InventoryController::class, 'store'])->name('inventories.store');
    Route::get('/inventories/{inventory}/edit', [InventoryController::class, 'edit'])->name('inventories.edit');
    Route::put('/inventories/{inventory}', [InventoryController::class, 'update'])->name('inventories.update');
    Route::delete('/inventories/{inventory}', [InventoryController::class, 'destroy'])->name('inventories.destroy');

    Route::get('/shipments', [ShipmentController::class, 'index'])->name('shipments.index');
    Route::get('/shipments/create', [ShipmentController::class, 'create'])->name('shipments.create');
    Route::post('/shipments', [ShipmentController::class, 'store'])->name('shipments.store');
    Route::get('/shipments/{shipment}/edit', [ShipmentController::class, 'edit'])->name('shipments.edit');
    Route::put('/shipments/{shipment}', [ShipmentController::class, 'update'])->name('shipments.update');
    Route::delete('/shipments/{shipment}', [ShipmentController::class, 'destroy'])->name('shipments.destroy');

    Route::get('/carts', [CartController::class, 'index'])->name('carts.index');
    Route::get('/carts/create', [CartController::class, 'create'])->name('carts.create');
    Route::post('/carts', [CartController::class, 'store'])->name('carts.store');
    Route::get('/carts/{cart}/edit', [CartController::class, 'edit'])->name('carts.edit');
    Route::put('/carts/{cart}', [CartController::class, 'update'])->name('carts.update');
    Route::delete('/carts/{cart}', [CartController::class, 'destroy'])->name('carts.destroy');
    Route::get('/cart-count', [CartController::class, 'getCartCount']);
    Route::post('/add-to-cart', [CartController::class, 'store']);


    Route::get('/wishlists', [WishlistController::class, 'index'])->name('wishlists.index');
    Route::get('/wishlists/create', [WishlistController::class, 'create'])->name('wishlists.create');
    Route::post('/wishlists', [WishlistController::class, 'store'])->name('wishlists.store');
    Route::get('/wishlists/{wishlist}/edit', [WishlistController::class, 'edit'])->name('wishlists.edit');
    Route::put('/wishlists/{wishlist}', [WishlistController::class, 'update'])->name('wishlists.update');
    Route::delete('/wishlists/{wishlist}', [WishlistController::class, 'destroy'])->name('wishlists.destroy');

    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/transactions/{transaction}/edit', [TransactionController::class, 'edit'])->name('transactions.edit');
    Route::put('/transactions/{transaction}', [TransactionController::class, 'update'])->name('transactions.update');
    Route::delete('/transactions/{transaction}', [TransactionController::class, 'destroy'])->name('transactions.destroy');

    Route::get('/sitesettings', [SitesettingController::class, 'index'])->name('sitesettings.index');
    Route::get('/sitesettings/create', [SitesettingController::class, 'create'])->name('sitesettings.create');
    Route::post('/sitesettings', [SitesettingController::class, 'store'])->name('sitesettings.store');
    Route::get('/sitesettings/{sitesetting}/edit', [SitesettingController::class, 'edit'])->name('sitesettings.edit');
    Route::put('/sitesettings/{sitesetting}', [SitesettingController::class, 'update'])->name('sitesettings.update');
    Route::delete('/sitesettings/{sitesetting}', [SitesettingController::class, 'destroy'])->name('sitesettings.destroy');

    Route::get('/blogpostscategories', [BlogPostsCategoryController::class, 'index'])->name('blogpostscategories.index');
    Route::get('/blogpostscategories/create', [BlogPostsCategoryController::class, 'create'])->name('blogpostscategories.create');
    Route::post('/blogpostscategories', [BlogPostsCategoryController::class, 'store'])->name('blogpostscategories.store');
    Route::get('/blogpostscategories/{blogpostscategory}/edit', [BlogPostsCategoryController::class, 'edit'])->name('blogpostscategories.edit');
    Route::put('/blogpostscategories/{blogpostscategory}', [BlogPostsCategoryController::class, 'update'])->name('blogpostscategories.update');
    Route::delete('/blogpostscategories/{id}', [BlogPostsCategoryController::class, 'destroy'])->name('blogpostscategories.destroy');


    Route::get('/aboutus', [AboutController::class, 'index'])->name('aboutus.index');
    Route::get('/aboutus/create', [AboutController::class, 'create'])->name('aboutus.create');
    Route::post('/aboutus', [AboutController::class, 'store'])->name('aboutus.store');
    Route::get('/aboutus/{about}/edit', [AboutController::class, 'edit'])->name('aboutus.edit');
    Route::put('/aboutus/{about}', [AboutController::class, 'update'])->name('aboutus.update');
    Route::delete('/aboutus/{about}', [AboutController::class, 'destroy'])->name('aboutus.destroy');

    Route::get('/whyus', [WhyusController::class, 'index'])->name('whyus.index');
    Route::get('/whyus/create', [WhyusController::class, 'create'])->name('whyus.create');
    Route::post('/whyus', [WhyusController::class, 'store'])->name('whyus.store');
    Route::get('/whyus/{whyus}/edit', [WhyusController::class, 'edit'])->name('whyus.edit');
    Route::put('/whyus/{whyus}', [WhyusController::class, 'update'])->name('whyus.update');
    Route::delete('/whyus/{whyus}', [WhyusController::class, 'destroy'])->name('whyus.destroy');

    Route::get('/photogalleries', [PhotoGalleryController::class, 'index'])->name('photogalleries.index');
    Route::get('/photogalleries/create', [PhotoGalleryController::class, 'create'])->name('photogalleries.create');
    Route::post('/photogalleries', [PhotoGalleryController::class, 'store'])->name('photogalleries.store');
    Route::get('/photogalleries/{photogallery}/edit', [PhotoGalleryController::class, 'edit'])->name('photogalleries.edit');
    Route::put('/photogalleries/{photogallery}', [PhotoGalleryController::class, 'update'])->name('photogalleries.update');
    Route::delete('/photogalleries/{id}', [PhotoGalleryController::class, 'destroy'])->name('photogalleries.destroy');

    Route::get('/videogalleries', [VideoGalleryController::class, 'index'])->name('videogalleries.index');
    Route::get('/videogalleries/create', [VideoGalleryController::class, 'create'])->name('videogalleries.create');
    Route::post('/videogalleries', [VideoGalleryController::class, 'store'])->name('videogalleries.store');
    Route::get('videogalleries/{id}/edit', [VideoGalleryController::class, 'edit'])->name('videogalleries.edit');
    Route::put('/videogalleries/{videogallery}', [VideoGalleryController::class, 'update'])->name('videogalleries.update');
    Route::delete('/videogalleries/{id}', [VideoGalleryController::class, 'destroy'])->name('videogalleries.destroy');

    Route::get('/coverimages', [CoverImageController::class, 'index'])->name('coverimages.index');
    Route::get('/coverimages/create', [CoverImageController::class, 'create'])->name('coverimages.create');
    Route::post('/coverimages', [CoverImageController::class, 'store'])->name('coverimages.store');
    Route::get('coverimages/{id}/edit', [CoverImageController::class, 'edit'])->name('coverimages.edit');
    Route::put('/coverimages/{coverimage}', [CoverImageController::class, 'update'])->name('coverimages.update');
    Route::delete('/coverimages/{id}', [CoverImageController::class, 'destroy'])->name('coverimages.destroy');

    Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
    Route::get('/testimonials/create', [TestimonialController::class, 'create'])->name('testimonials.create');
    Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');
    Route::get('testimonials/{id}/edit', [TestimonialController::class, 'edit'])->name('testimonials.edit');
    Route::put('/testimonials/{testimonial}', [TestimonialController::class, 'update'])->name('testimonials.update');
    Route::delete('/testimonials/{id}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');

    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');

});

    Route::get('/', [FrontviewController::class, 'index'])->name('Index');
    Route::get('/bulk-payment', [FrontviewController::class, 'bulkPayment'])->name('bulk.payment');
    Route::post('/bulk-payment/process', [FrontviewController::class, 'processBulkPayment'])->name('bulk.payment.process');
    Route::get('/order-confirmation/{order_id}', [FrontviewController::class, 'orderConfirmation'])->name('order.confirmation');

    // Route::post('/store-cart-session', function (Request $request) {
    //     session([
    //         'cart_total' => $request->input('total'),
    //         'cart_total_items' => $request->input('totalItems')
    //     ]);
    //     return response()->json(['status' => 'success']);
    // })->name('store.cart.session');
   

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login')
    ->middleware('guest');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->middleware('guest');

    Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout')
        ->middleware('auth');

    Route::get('/payment/{id}', [PaymentController::class, 'show'])
        ->name('payment')
        ->middleware('auth');

        Route::get('/check-auth', function () {
            return response()->json(['authenticated' => Auth::check()]);
        })->name('check.auth');

        Route::post('/set-intended-route', function (Request $request) {
            $request->session()->put('intendedPaymentRoute', $request->route);
            return response()->json(['success' => true]);
        })->name('set.intended.route');

//Routes for SingleController
Route::prefix('/')->group(function () {
    Route::get('/product', [SingleController::class, 'render_products'])->name('Product');
    Route::get('/contact', [SingleController::class, 'render_contact'])->name('Contact');
    Route::get('/blog', [SingleController::class, 'render_blogpostcategory'])->name('Blog');
    Route::get('/blogdetail/{slug}', [SingleController::class, 'render_blogdetail'])->name('BlogDetail');
    Route::get('/about', [SingleController::class, 'render_aboutus'])->name('About');
    Route::get('/whyus', [SingleController::class, 'render_whyus'])->name('Whyus');
    Route::get('/imagegallery', [SingleController::class, 'render_photogallery'])->name('PhotoGallery');
    Route::get('/videogallery', [SingleController::class, 'render_videogallery'])->name('VideoGallery');
    Route::get('/catalog', [SingleController::class, 'render_catalog'])->name('Catalog');
    Route::get('/productdetail/{id}', [ProductController::class, 'show'])->name('show');
    Route::post('/contact/store', [ContactController::class, 'store'])->name('Contact.store');

    Route::get('/search', [SingleController::class, 'search'])->name('search');
    Route::get('/blog/search', [SingleController::class, 'searchBlog'])->name('blog.search');
    
});

//with login
Route::get('payment/{productId}', [PaymentController::class, 'show'])->name('payment.show');
Route::post('payment', [PaymentController::class, 'process'])->name('payment.process');
Route::get('/bill/{orderId}', [PaymentController::class, 'showOrderSummary'])->name('Bill');

Route::get('/bulkbill/{orderId}', [FrontviewController::class, 'showBulkOrder'])->name('BulkBill');

//userchoice doing the payment with out login auth

//userpayment done witout login 
// Route::post('/payment/process_without_login', [PaymentController::class, 'processPaymentWithoutLogin'])->name('payment.process_without_login');
Route::get('/newpayment/{id}', [FrontviewController::class, 'showNewPaymentPage'])->name('newpayment');
Route::post('/payment/process_without_login', [PaymentWithoutLoginController::class, 'processPayment'])->name('payment.process_without_login');


//SuperAdmin
Route::get('/orderswithoutlogin', [OrderWithoutLoginController::class, 'index'])->name('backend.orderswithoutlogin.index');

// Additional routes for OrderWithoutLoginController (if needed)
Route::get('/orderswithoutlogin/create', [OrderWithoutLoginController::class, 'create'])->name('backend.orderswithoutlogin.create');
Route::post('/orderswithoutlogin', [OrderWithoutLoginController::class, 'store'])->name('backend.orderswithoutlogin.store');
Route::get('/orderswithoutlogin/{order}/edit', [OrderWithoutLoginController::class, 'edit'])->name('backend.orderswithoutlogin.edit');
Route::put('/orderswithoutlogin/{order}', [OrderWithoutLoginController::class, 'update'])->name('backend.orderswithoutlogin.update');
Route::delete('/orderswithoutlogin/{order}', [OrderWithoutLoginController::class, 'destroy'])->name('backend.orderswithoutlogin.destroy');
Route::get('/orderswithoutlogin', [OrderController::class, 'index'])->name('backend.orders.index');
Route::get('/product/{id}', [ProductController::class, 'showProduct'])->name('product.show');

Route::get('/payment/bill/{order}', [PaymentWithoutLoginController::class, 'showBill'])->name('payment.bill');

Route::post('/handle-payment-success', [PayPalController::class, 'handlePaymentSuccess'])->name('handle.payment.success');
Route::get('/order-summary/{orderId}', [PayPalController::class, 'showOrderSummary'])->name('order.summary');

Route::post('handle-bulk-payment-success', [PayPalController::class, 'handleBulkPaymentSuccess'])->name('handle.bulk.payment.success');
Route::get('/bulkorder-summary/{orderId}', [PayPalController::class, 'showBulkOrder'])->name('bulkorder.summary');
// Route::post('/backend/customers', [CustomerController::class, 'store'])->name('backend.customers.store');
// Route::get('/backend/customers', [CustomerController::class, 'index'])->name('backend.customers.index');
require __DIR__.'/auth.php';
require __DIR__.'/superadmin-auth.php';