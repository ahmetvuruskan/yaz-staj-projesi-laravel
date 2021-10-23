<?php

use App\Models\Orders;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\PageController;


Route::middleware('Share')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::get('urundetay/{slug}', [ShopController::class, 'singleProduct'])->name('urun.detay');
    Route::get('kategori/{slug}', [ShopController::class, 'categoryIndex'])->name('category.list');
    Route::get('sayfa/{slug}',[ShopController::class,'page'])->name('page.detail');
    Route::get('ode/{product_id}', [ShopController::class, 'pay'])->name('shop.pay');
    Route::post('sanalPos', [ShopController::class, 'virtualTerminal'])->name('virtualTerminal');
    Route::get('arama',[IndexController::class,'search'])->name('search');
});


Route::prefix('admin')->group(function () {
    Route::get('/', [MainController::class, 'login'])->middleware('CheckSession')->name('admin.login');
    Route::get('cikis', [MainController::class, 'logout'])->name('logout');
    Route::post('adminCheck', [MainController::class, 'loginCheck'])->name('login.check');
    Route::middleware(['admin'])->group(function () {
        Route::get('anasayfa', [MainController::class, 'index'])->name('admin.index');
        Route::get('profil', [MainController::class, 'profile'])->name('admin.profile');
        Route::post('updadeUser/{id}', [MainController::class, 'updateUser'])->name('admin.user.update');
        Route::prefix('ayarlar')->group(function () {
            Route::get('/', [SettingsController::class, 'index'])->name('admin.settings');
            Route::get('odemeAyarlari', [SettingsController::class, 'paymetSettings'])->name('admin.payment.settings');
            Route::get('duzenle/{id}', [SettingsController::class, 'edit'])->name('admin.settings.edit');
            Route::get('sanalPosDuzenle/{id}', [SettingsController::class, 'editPayment'])->name('admin.settings.payment.edit');
            Route::post('update/{id}', [SettingsController::class, 'updateSettings'])->name('admin.settings.update');

        });
        Route::prefix('urunler')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('admin.prouducts');
            Route::get('ekle', [ProductController::class, 'addNew'])->name('admin.product.add');
            Route::get('duzenle/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
            Route::post('urunKaydet', [ProductController::class, 'saveProduct'])->name('admin.product.save');
            Route::post('update/{id}', [ProductController::class, 'update'])->name('admin.product.update');
            Route::delete('urunsil/{id}', [ProductController::class, 'urunSil'])->name('admin.product.product.delete');
            Route::delete('sil/{id}', [ProductController::class, 'deletePhoto'])->name('admin.product.photo.delete');
        });
        Route::prefix('kategoriler')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('admin.categories');
            Route::get('ekle', [CategoryController::class, 'addNew'])->name('admin.category.add');
            Route::post('sortable', [CategoryController::class, 'sortable'])->name('admin.category.sortable');
            Route::post('kategoriKaydet', [CategoryController::class, 'saveCategory'])->name('admin.category.save');
            Route::get('duzenle/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
            Route::post('update/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
        });
        Route::prefix('siparisler')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('admin.orders');
            Route::get('duzenle/{id}', [OrderController::class, 'editOrder'])->name('admin.orders.edit');
            Route::get('createShipment/{id}', [OrderController::class, 'createShipment'])->name('createShipment');
        });
        Route::prefix('slider')->group(function () {
            Route::get('/', [SliderController::class, 'index'])->name('admin.sliders');
            Route::get('ekle', [SliderController::class, 'addNew'])->name('admin.slider.add');
            Route::get('duzenle/{id}', [SliderController::class, 'edit'])->name('admin.slider.edit');
            Route::post('update/{id}', [SliderController::class, 'update'])->name('admin.slider.update');
            Route::delete('sil/{id}', [SliderController::class, 'delete']);
            Route::post('sliderKaydet', [SliderController::class, 'saveSlider'])->name('admin.slider.save');
        });
        Route::prefix('sayfalar')->group(function () {
            Route::get('/', [PageController::class, 'index'])->name('admin.pages.index');
            Route::get('ekle', [PageController::class, 'addNew'])->name('admin.pages.add');
            Route::post('save',[PageController::class,'save'])->name('admin.pages.save');
            Route::get('duzenle/{id}',[PageController::class,'edit'])->name('admin.pages.edit');
            Route::post('update/{id}',[PageController::class,'update'])->name('admin.pages.update');
        });

    });


});



