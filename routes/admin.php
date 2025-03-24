<?php

use App\Http\Controllers\Admin\BranchesController;
use App\Http\Controllers\Admin\CompanySettingController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\Finance_calendersController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductController2;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ShiftsController;
use App\Http\Controllers\Admin\UnitController;
use App\Livewire\Admin\Brands;
use App\Livewire\Admin\Users;
use App\Livewire\Admin\Admins;
use App\Livewire\Admin\Categories;
use App\Livewire\Admin\Products;
use App\Livewire\Admin\Colors;
use App\Livewire\Admin\Products2;
use App\Livewire\Admin\Products3;
use App\Livewire\Admin\Products\CreateProduct;
use App\Livewire\Admin\Products\UpdateProduct;
use App\Livewire\Admin\Sizes;
use App\Models\Product;
use App\Livewire\Admin\Animals;
// use App\Livewire\Admin\AboutUs;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Livewire\Livewire;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth','admin.only']
    ],
    function () {
        Route::prefix('/admin')->group(function () {
            Livewire::setUpdateRoute(function ($handle) {
                return Route::post('/livewire/update', $handle);
            });
            Route::get('/', [HomeController::class, 'index'])->name('admin.home');
            Route::get('/settings', [SettingController::class, 'index'])->name('settings')->middleware('permission:read_settings');
            Route::get('admins', Admins::class)->name('admins')->middleware('permission:read_admins');
            Route::get('users', Users::class)->name('users')->middleware('permission:read_users');
            Route::resource('/roles', RoleController::class)->except('show');
            Route::get('brands', Brands::class)->name('brands');
            Route::get('categories', Categories::class)->name('categories');
            Route::get('colors', Colors::class)->name('colors');
            Route::get('sizes', Sizes::class)->name('sizes');
            Route::get('animals', Animals::class)->name('animals');
            Route::get('products3', Products3::class)->name('products3');
            // Route::get('/admin/products3/create', \App\Livewire\Admin\Products3::class)->name('admin.products.create');
            // Route::get('/admin/products/update/{id}', \App\Livewire\Admin\Products3::class)->name('admin.products.update')->middleware('AdminOnly');
            Route::get('/products3/create', \App\Livewire\Admin\CreateProduct3::class)
            ->name('products3.create');
        Route::get('/products/edit/{id}', \App\Livewire\Admin\CreateProduct3::class)
            ->name('products3.edit');


            // Route::get('/about_us', AboutUs::class)->name('AboutUs');

            // Route::get('/products', Products::class)->name('products');
            Route::controller(ProductController::class)->group(function(){
                Route::post('/products/addBrand','addBrand')->name('addBrand');  // product add brand
                Route::post('/products/addColor','addColor')->name('addColor');  // product add color
                Route::post('/products/addSize','addSize')->name('addSize');  // product add size
                Route::post('/products/addCategory','addCategory')->name('addCategory');  // product add Category
                Route::delete('/products/bulk_delete','bulkDelete')->name('products.bulk_delete');
                Route::post('/products/remove_cert','remove_cert')->name('products.remove_cert');
                Route::resource('products',ProductController::class);
            });
            // Route::get('/products2',[ProductController2::class,'index'])->name('products2');
            Route::get('/products2',Products2::class)->name('products2');
            Route::get('/products2/create',CreateProduct::class)->name('products2.create');
            Route::get('/products2/update/{id}',UpdateProduct::class)->name('products2.update');





            // Route::get('/car/list', CarList::class)->name('admin.car.list');
            // Route::get('/add/car', AddCar::class)->name('admin.add.car');
            // Route::get('/edit/car/{id}', EditCar::class)->name('admin.edit.car');

            // Route::view('buses', 'livewire.bus')->name('admin.bus');
            // Route::get('buses', Bus::class)->name('admin.bus');


            Route::get('/units',[UnitController::class,'index'])->name('units');


            // company settings route
            Route::get('/company', [CompanySettingController::class, 'index'])->name('company.settings');
            Route::get('/company/edit', [CompanySettingController::class, 'edit'])->name('company.settings.edit');
            Route::post('/company/update', [CompanySettingController::class, 'update'])->name('company.settings.update');
             // end company settings route

             /*  بداية  تكويد السنوات المالية */
            Route::resource('/finance_calender', Finance_calendersController::class);
            Route::post('/finance_calender/show_year_monthes', [Finance_calendersController::class, 'show_year_monthes'])->name('finance_calender.show_year_monthes');
            Route::get('/finance_calender/do_open/{id}', [Finance_calendersController::class, 'do_open'])->name('finance_calender.do_open');
            /* بداية الفروع */
            Route::resource('/branches', BranchesController::class);
            /* بداية الشفتات */
            Route::resource('/shiftes', ShiftsController::class);
            Route::post('/shiftes_search', [ShiftsController::class, 'ajax_search'])->name('ShiftsTypes.ajax_search');





            //start Dr Clinic Routes
            Route::resource('departments', DepartmentController::class);
            // Route::resource('products', ProductController::class);


            //

        });
    }
);
