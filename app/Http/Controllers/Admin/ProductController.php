<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ColorRequest;
use App\Http\Requests\Admin\ProductRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Size;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
class ProductController extends Controller
{
    // public function index(){
    //     if (request()->ajax()) {
    //         $products = Product::with(['category','brand','color', 'image','size','admin']);
    //         if (request()->filled('brand_id')) {
    //             $products->where('brand_id', request()->brand_id);
    //         }
    //         // return DataTables::of($products)
    //         //     ->addIndexColumn()
    //         //     ->addColumn('record_select', 'admin.products.data_table.record_select')
    //         //     ->editColumn('created_at', function (Product $product) {
    //         //         return $product->created_at->format('Y-m-d');
    //         //     })
    //         //     ->addColumn('image', function (Product $product) {
    //         //         return view('admin.products.data_table.image', compact('product'));
    //         //     })
    //         //     ->addColumn('colors', function (Product $product) {
    //         //         return view('admin.products.data_table.colors',compact('product'));
    //         //     })
    //         //     ->addColumn('sizes', function (Product $product) {
    //         //         return view('admin.products.data_table.sizes',compact('product'));
    //         //     })
    //         //     ->addColumn('brand', function (Product $product) {
    //         //         return $product->brand?->name;
    //         //     })
    //         //     ->addColumn('category', function (Product $product) {
    //         //         return $product->category?->name;
    //         //     })
    //         //     ->editColumn('creator', function (Product $product) {
    //         //         return $product->admin?->name;
    //         //     })
    //         //     // ->addColumn('actions', function (Product $product) {
    //         //     //     return view('admin.products.data_table.actions',compact('product'));
    //         //     // })
    //         //     ->rawColumns(['record_select'])
    //         //     ->toJson();
    //         // }
    //         return DataTables::of($products)
    //             ->addIndexColumn()
    //             ->addColumn('record_select', 'admin.products.data_table.record_select')
    //             ->editColumn('created_at', fn(Product $product) => $product->created_at->format('Y-m-d'))
    //             ->addColumn('image', fn(Product $product) => view('admin.products.data_table.image', compact('product')))
    //             ->addColumn('colors', fn(Product $product) => view('admin.products.data_table.colors', compact('product')))
    //             ->addColumn('sizes', fn(Product $product) => view('admin.products.data_table.sizes', compact('product')))
    //             ->addColumn('brand', fn(Product $product) => optional($product->brand)->name)
    //             ->addColumn('category', fn(Product $product) => optional($product->category)->name)
    //             ->editColumn('creator', fn(Product $product) => optional($product->admin)->name)
    //             ->rawColumns(['record_select'])
    //             ->toJson();

    //     // $brand = null;
    //     // if (request()->has('brand_id')) {
    //     //     $brand = Brand::find(request()->brand_id);
    //     // }
    //     }
    //     $brand = request()->filled('brand_id') ? Brand::find(request()->brand_id) : null;
    //     return view('admin.products.index', compact('brand'));
    // }
    public function index()
    {
        // dd(request('brand_id'));
        if (request()->ajax()) {
            $products = Product::with(['category', 'brand', 'color', 'images', 'size', 'admin']);
            if (request()->filled('brand_id')) {
                $products = $products->where('brand_id', request('brand_id'));
            }
            return DataTables::of($products)->with(['brand_id' => request('brand_id')])
                ->addIndexColumn()
                ->addColumn('record_select', 'admin.products.data_table.record_select')
                ->editColumn('created_at', fn(Product $product) => $product->created_at->format('Y-m-d'))
                ->addColumn('image', fn(Product $product) => view('admin.products.data_table.image', compact('product')))
                ->addColumn('colors', fn(Product $product) => view('admin.products.data_table.colors', compact('product')))
                ->addColumn('sizes', fn(Product $product) => view('admin.products.data_table.sizes', compact('product')))
                ->addColumn('brand', fn(Product $product) => optional($product->brand)->name)
                ->addColumn('category', fn(Product $product) => optional($product->category)->name)
                ->editColumn('creator', fn(Product $product) => optional($product->admin)->name)
                ->addColumn('actions', function (Product $product) {
                    return view('admin.products.data_table.actions',compact('product'));
                })

                ->rawColumns(['record_select','actions'])
                ->toJson();
        }
        $brand = request()->filled('brand_id') ? Brand::find(request('brand_id')) : null;
        return view('admin.products.index', compact('brand'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $colors = Color::latest()->get();
        $sizes  = Size::latest()->get();
        return view('admin.products.create',compact('categories','brands','colors','sizes'));
    }
    public function store(ProductRequest $request)
    {
        // dd($request->all());
        $input = $request->except('image','name','color_id','size_id','proengsoft_jsvalidation','products_images');
        if (request('image')) {
            $input['image'] = store_file(request('image'), 'products');
        }
        // $input['status'] = $request->status;
        $input['creator'] = Auth::user()->id;
        $input['slug'] = Str::slug($request->product_name);
        $input['code'] = 'ECO-' . Carbon::now()->year . '-' . uniqid();

        $product  =  Product::create($input);

        if ($request->has('color_id')) {
            $product->color()->attach($request->color_id);
        }
        if ($request->has('size_id')) {
            $product->size()->attach($request->size_id);
        }
        if ($request->file('products_images') && count($request->file('products_images')) > 0) {
            $i = 1;
            foreach ($request->file('products_images') as $key =>$file) {
                $file_name =  time().$file->getClientOriginalName();
                $file_size = $file->getSize();
                $file_type = $file->getMimeType();
                $files[] = store_file($file, 'products_images');
                $product->images()->create([
                    'file_name' => $file_name,
                    'file_nametype' => 'products_images',
                    'file_size' => $file_size,
                    'file_type' => $file_type,
                    'file_status' => true,
                    'file_sort' => $i,
                ]);
                $i++;
            }
        }
        return redirect()->route('products.index')->with('success','Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::where('is_active', 1)->get();
        $brands = Brand::where('is_active', 1)->get();
        $colors = Color::where('status', 1)->get();
        $sizes  = Size::where('status', 1)->get();
        return view('admin.products.edit',compact('product','categories','brands','colors','sizes'));
    }

    public function update(Request $request, Product $product)
    {
        // dd($product->id);
        // $product = Product::findOrFail($id);
        // return ' hell';
        $input['name']     = $request->product_name;
        $input['brand_id'] = $request->brand_id;
        $input['code']     = $product->code;
        $input['tax'] = $request->tax;
        $input['price'] = $request->price;
        $input['sku'] = '';
        $input['stock'] = $request->stock;
        $input['discount'] = $request->discount;
        $input['expiration_date'] = $request->expiration_date;
        $input['minimum_amount'] = $request->alert_quantity;
        $input['free_delivery'] = $request->free_delivery;
        $input['description'] = $request->description;
        $input['features'] = $request->features;
        $input['status'] = $request->status;
        $input['creator'] = Auth::user()->id;
        if ($request->file('thumb_image')) {
            if ($product->thumb_image != 'products/LOGO.png') {
                delete_file($product->getRawOriginal('thumb_image'));
            }
            $input['thumb_image'] = store_file(request('thumb_image'), 'products');
        }
        $product->update($input);
        if ($request->has('product_main_category_id')) {
            $product->main_category()->sync($request->product_main_category_id);
        }
        if ($request->has('color_id')) {
            $product->color()->sync($request->color_id);
        }

        if ($request->has('size_id')) {
            $product->size()->sync($request->size_id);
        }
        return redirect()->route('admin.products.index');
    }

    public function destroy(Product $product)
    {
        //
    }
    public function addBrand(Request $request)
    {
        $this->validate($request,[
            'name' => ['required'],
            'logo' => ['nullable']
        ]);
        $brand = Brand::create($request->except('logo'));
        if (request('logo')) {
            $brand->logo = store_file(request('logo'), 'brands');
        }
        $brand->slug = Str::slug($brand->name);
        $brand->creator = Auth::user()->id;
        $brand->save();
        return response()->json([
            'html' => "<option value='".$brand->id."'>".$brand->name."</option>",
            'value' => $brand->id,
        ]);
    }
    public function addColor(Request $request)
    {
        $this->validate($request,[
            'name' => ['required'],
        ]);
        $color = Color::create($request->all());
        $color->slug = Str::slug($color->name);
        $color->creator = Auth::user()->id;
        $color->save();
        return response()->json([
            'html' => "<option value='".$color->id."'>".$color->name."</option>",
            'value' => $color->id,
        ]);
    }
    public function addSize(Request $request)
    {
        $this->validate($request,[
            'name' => ['required'],
        ]);
        $size = Size::create($request->all());
        $size->slug = Str::slug($size->name);
        $size->creator = Auth::user()->id;
        $size->save();
        return response()->json([
            'html' => "<option value='".$size->id."'>".$size->name."</option>",
            'value' => $size->id,
        ]);
    }
    public function addCategory(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'image' => ['nullable'],
        ]);
        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'creator' => Auth::user()->id,
            'is_active' => true
        ];
        if ($request->has('image')) {
            $data['image'] = store_file($request->image, 'categories');
        }
        $category = Category::create($data);
        return response()->json([
            'html' => "<option value='{$category->id}'>{$category->name}</option>",
            'value' => $category->id,
        ]);
    }



}
