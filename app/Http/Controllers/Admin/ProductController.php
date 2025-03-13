<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ColorRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Size;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
class ProductController extends Controller
{
    public function index(){
        if (request()->ajax()) {
            $products = Product::with(['category','color', 'image','size'])->select();
            return DataTables::of($products)
                ->addIndexColumn()
                ->addColumn('record_select', 'admin.products.data_table.record_select')
                ->editColumn('created_at', function (Product $product) {
                    return $product->created_at->format('Y-m-d');
                })
                ->addColumn('image', function (Product $product) {
                    return view('admin.products.data_table.image', compact('product'));
                })
                ->addColumn('colors', function (Product $product) {
                    return view('admin.products.data_table.colors',compact('product'));
                })
                ->addColumn('sizes', function (Product $product) {
                    return view('admin.products.data_table.sizes',compact('product'));
                })
                ->addColumn('brand', function (Product $product) {
                    return $product->brand?->name;
                })
                ->addColumn('category', function (Product $product) {
                    return $product->category?->name;
                })
                ->editColumn('creator', function (Product $product) {
                    return $product->admin?->name;
                })
                // ->addColumn('actions', function (Product $product) {
                //     return view('admin.products.data_table.actions',compact('product'));
                // })
                ->rawColumns(['record_select'])
                ->toJson();
        }
        return view('admin.products.index');
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input['name']     = $request->product_name;
        $input['brand_id'] = $request->brand_id;
        $input['code']     = '';
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
        if (request('thumb_image')) {
            $input['thumb_image'] = store_file(request('thumb_image'), 'products');
        }
        $input['status'] = $request->status;
        $input['creator'] = Auth::user()->id;
        $product  =  Product::create($input);

        // $product->code = 'ECO-' . Carbon::now()->year . Carbon::now()->month . $product->id . Carbon::now()->day;
        $product->code = 'ECO-' . Carbon::now()->year ;
        $product->slug = Str::slug($product->name);
        $product->save();

        if ($request->has('product_main_category_id')) {
            $product->main_category()->attach($request->product_main_category_id);
        }

        if ($request->has('product_category_id')) {
            $product->category()->attach($request->product_category_id);
        }
        if ($request->has('writer_id')) {
            $product->writer()->attach($request->writer_id);
        }
        if ($request->has('color_id')) {
            $product->color()->attach($request->color_id);
        }
        if ($request->has('size_id')) {
            $product->size()->attach($request->size_id);
        }
        if ($request->has('vendor_id')) {
            $product->vendor()->attach($request->vendor_id);
        }
        return redirect()->route('admin.products.index');
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
