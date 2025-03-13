<?php

use App\Http\Controllers\Admin\BranchesController;
use App\Http\Controllers\Admin\CompanySettingController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\Finance_calendersController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ShiftsController;
use App\Http\Controllers\Admin\UnitController;
use App\Livewire\Admin\Brands;
use App\Livewire\Admin\Categories;
use App\Livewire\Admin\Products;
// use App\Livewire\Admin\AboutUs;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Livewire\Livewire;

Route::prefix('admin')->group(function () {
    Route::get('login', function () {
        return view('auth.login');
    });
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ],
    function () {
        Route::prefix('/admin')->group(function () {
            Livewire::setUpdateRoute(function ($handle) {
                return Route::post('/livewire/update', $handle);
            });
            Route::get('/home', [HomeController::class, 'index'])->name('admin.home');
            Route::get('/settings', [SettingController::class, 'index'])->name('settings');
            Route::get('brands', Brands::class)->name('brands');
            Route::get('categories', Categories::class)->name('categories');
            // Route::get('/about_us', AboutUs::class)->name('AboutUs');

            // Route::get('/products', Products::class)->name('products');
            Route::controller(ProductController::class)->group(function(){
                Route::post('/products/addBrand','addBrand')->name('addBrand');  // product add brand
                Route::post('/products/addColor','addColor')->name('addColor');  // product add color
                Route::post('/products/addSize','addSize')->name('addSize');  // product add size
                Route::post('/products/addCategory','addCategory')->name('addCategory');  // product add Category
                Route::delete('/products/bulk_delete','bulkDelete')->name('products.bulk_delete');
                Route::resource('products',ProductController::class);
            });





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
            Route::resource('/roles', RoleController::class)->except('show');
        });
    }
);
