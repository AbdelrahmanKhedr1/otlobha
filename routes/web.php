<?php

use Illuminate\Support\Facades\Broadcast;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ConversationController;
use App\Http\Controllers\Admin\DashboardOfferController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Store\ChatController as StoreChatController;
use App\Http\Controllers\Store\ImageOfferController;
use App\Http\Controllers\Store\ImageUnitController;
use App\Http\Controllers\Store\OfferController;
use App\Http\Controllers\Store\OrderController;
use App\Http\Controllers\Store\ProductController as StoreProductController;
use App\Http\Controllers\Store\SettingController;
use App\Http\Controllers\Store\UnitController;
use App\Livewire\Store\Item\Tag;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

// Livewire::setUpdateRoute(function ($handle) {
//     return Route::post('new_magpro22/public/livewire/update', $handle);
// });

// Broadcast::routes(['middleware' => ['web']]);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    Route::get('/', function () {
        return view('store.index');
    })->name('store.dashboard');
    // Route::get('/', [HomeController::class, 'index'])->name('dashboard.index');

    Route::get('/chat', [StoreChatController::class, 'index'])->name('store.chat');
    Route::post('/chat/send', [StoreChatController::class, 'sendMessage'])->name('store.chat.send');

    Route::get('/product', [StoreProductController::class, 'index'])->name('store.product.index');
    Route::get('/product/create', [StoreProductController::class, 'create'])->name('store.product.create');
    Route::post('/product/store', [StoreProductController::class, 'store'])->name('store.product.store');
    Route::get('/product/edit/{id}', [StoreProductController::class, 'edit'])->name('store.product.edit');
    Route::get('/product/show/{id}', [StoreProductController::class, 'show'])->name('store.product.show');
    Route::put('/product/update/{id}', [StoreProductController::class, 'update'])->name('store.product.update');
    Route::delete('/product/destroy/{id}', [StoreProductController::class, 'destroy'])->name('store.product.destroy');

    // Route::get('/store/item/{itemId}/tags', Tag::class)->name('store.item.tags');

    Route::get('/unit/{id}', [UnitController::class, 'index'])->name('unit.index');
    Route::get('/unit/create/{id}', [UnitController::class, 'create'])->name('unit.create');
    Route::post('/unit/store', [UnitController::class, 'store'])->name('unit.store');
    Route::get('/unit/edit/{id}', [UnitController::class, 'edit'])->name('unit.edit');
    Route::get('/unit/show/{id}', [UnitController::class, 'show'])->name('unit.show');
    Route::put('/unit/update/{id}', [UnitController::class, 'update'])->name('unit.update');
    Route::delete('/unit/destroy/{id}', [UnitController::class, 'destroy'])->name('unit.destroy');

    Route::get('/image-unit/{id}', [ImageUnitController::class, 'index'])->name('image-unit.index');
    Route::get('/image-unit/create/{id}', [ImageUnitController::class, 'create'])->name('image-unit.create');
    Route::post('/image-unit/store', [ImageUnitController::class, 'store'])->name('image-unit.store');
    Route::get('/image-unit/edit/{id}', [ImageUnitController::class, 'edit'])->name('image-unit.edit');
    Route::put('/image-unit/update/{id}', [ImageUnitController::class, 'update'])->name('image-unit.update');
    Route::delete('/image-unit/destroy/{id}', [ImageUnitController::class, 'destroy'])->name('image-unit.destroy');

    Route::get('/offer', [OfferController::class, 'index'])->name('offer.index');
    Route::get('/offer/create', [OfferController::class, 'create'])->name('offer.create');
    Route::post('/offer/store', [OfferController::class, 'store'])->name('offer.store');
    Route::get('/offer/edit/{id}', [OfferController::class, 'edit'])->name('offer.edit');
    Route::get('/offer/show/{id}', [OfferController::class, 'show'])->name('offer.show');
    Route::put('/offer/update/{id}', [OfferController::class, 'update'])->name('offer.update');
    Route::delete('/offer/destroy/{id}', [OfferController::class, 'destroy'])->name('offer.destroy');

    Route::get('/image-offer/{id}', [ImageOfferController::class, 'index'])->name('image-offer.index');
    Route::get('/image-offer/create/{id}', [ImageOfferController::class, 'create'])->name('image-offer.create');
    Route::post('/image-offer/store', [ImageOfferController::class, 'store'])->name('image-offer.store');
    Route::get('/image-offer/edit/{id}', [ImageOfferController::class, 'edit'])->name('image-offer.edit');
    Route::put('/image-offer/update/{id}', [ImageOfferController::class, 'update'])->name('image-offer.update');
    Route::delete('/image-offer/destroy/{id}', [ImageOfferController::class, 'destroy'])->name('image-offer.destroy');

    Route::get('/order', [OrderController::class, 'index'])->name('order.index');

    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::post('/setting/updateOrCreateStore', [SettingController::class, 'updateOrCreateStore'])->name('setting.updateOrCreateStore');
});





Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login']);

    Route::middleware(['auth:admin'])->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
        // Route::get('/dashboard', function () {
        //     return view('admin.dashboard');
        // })->name('admin.dashboard');
        Route::get('/', [HomeController::class, 'index'])->name('dashboard.index');

        Route::get('/conversation', [ConversationController::class, 'inbox'])->name('conversation.inbox');
        Route::get('/conversation/{id}', [ConversationController::class, 'show'])->name('conversation.show');
        Route::post('/conversation/{id}/sendMessage', [ConversationController::class, 'sendMessage'])->name('conversation.sendMessage');


        Route::get('/company', [CompanyController::class, 'index'])->name('company.index');
        Route::get('/company/create', [CompanyController::class, 'create'])->name('company.create');
        Route::post('company/store', [CompanyController::class, 'store'])->name('company.store');
        Route::get('company/edit/{id}', [CompanyController::class, 'edit'])->name('company.edit');
        Route::put('company/update/{id}', [CompanyController::class, 'update'])->name('company.update');

        Route::get('/tag', [TagController::class, 'index'])->name('tag.index');
        Route::get('/tag/create', [TagController::class, 'create'])->name('tag.create');
        Route::post('tag/store', [TagController::class, 'store'])->name('tag.store');
        Route::get('tag/edit/{id}', [TagController::class, 'edit'])->name('tag.edit');
        Route::put('tag/update/{id}', [TagController::class, 'update'])->name('tag.update');

        Route::get('/product', [ProductController::class, 'index'])->name('product.index');
        Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('product/store', [ProductController::class, 'store'])->name('product.store');
        Route::get('product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('product/update/{id}', [ProductController::class, 'update'])->name('product.update');

        Route::get('/store/{id}', [StoreController::class, 'index'])->name('store.index');
        Route::get('/store/show/{id}', [StoreController::class, 'show'])->name('store.show');
        Route::get('/store/product/{id}', [StoreController::class, 'product'])->name('store.product');
        Route::get('/store/unit/{id}', [StoreController::class, 'unit'])->name('store.unit');
        Route::get('/store/unit/{id}/image-unit', [StoreController::class, 'unit_images'])->name('store.unit.image-unit');
        Route::get('/store/unit/show/{id}', [StoreController::class, 'unitShow'])->name('store.unit.show');
        Route::get('/store/order/{id}', [StoreController::class, 'order'])->name('store.order');
        Route::get('/store/toggle-active/{id}', [StoreController::class, 'toggleActive'])->name('store.toggleActive');

        Route::get('payment/{id}', [PaymentController::class, 'index'])->name('payment.index');
        Route::get('payment/create/{id}', [PaymentController::class, 'create'])->name('payment.create');
        Route::post('payment/store', [PaymentController::class, 'store'])->name('payment.store');
        Route::get('payment/edit/{id}', [PaymentController::class, 'edit'])->name('payment.edit');
        Route::put('payment/update/{id}', [PaymentController::class, 'update'])->name('payment.update');

        Route::get('/city', [CityController::class, 'index'])->name('city.index');
        Route::put('/city/update/{id}', [CityController::class, 'update'])->name('city.update');

        Route::get('subscription', [SubscriptionController::class, 'index'])->name('subscription.index');
        Route::get('subscription/create', [SubscriptionController::class, 'create'])->name('subscription.create');
        Route::post('subscription/store', [SubscriptionController::class, 'store'])->name('subscription.store');
        Route::get('subscription/edit/{id}', [SubscriptionController::class, 'edit'])->name('subscription.edit');
        Route::put('subscription/update/{id}', [SubscriptionController::class, 'update'])->name('subscription.update');
        Route::delete('subscription/destroy/{id}', [SubscriptionController::class, 'destroy'])->name('subscription.destroy');
        Route::get('subscription/endSub', [SubscriptionController::class, 'endSub'])->name('subscription.endSub');

        Route::get('dashoffer', [DashboardOfferController::class, 'index'])->name('dashoffer.index');
        Route::get('dashoffer/create', [DashboardOfferController::class, 'create'])->name('dashoffer.create');
        Route::post('dashoffer/store', [DashboardOfferController::class, 'store'])->name('dashoffer.store');
        Route::get('dashoffer/edit/{id}', [DashboardOfferController::class, 'edit'])->name('dashoffer.edit');
        Route::put('/dashoffer/update/{id}', [DashboardOfferController::class, 'update'])->name('dashoffer.update');
    });
});
