<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Product::latest()->where('user_id',Auth::id())->where('status',1)->with('category')->get();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->except('_token');
        $rules = [
            'name' => 'required | min:3',
            'category_id' => 'required| integer',
            'short_description' => 'required',
        ];

        $validation = Validator::make($inputs, $rules);
        if ($validation->fails())
        {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $product = new Product();
        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->short_description = $request->input('short_description');
        $product->description = $request->input('description');
        $product->user_id = Auth::id();
        $product->status = 1;
        $product->save();


        $files = [];

        if($request->hasfile('images'))

         {

            foreach($request->file('images') as $file)

            {

                $name = $product->id . '_' .time().rand(1,100).'.'.$file->extension();

                $file->move(public_path('files'), $name);  

                $fileone= new ProductImage();

                $fileone->image_name = $name;
                $fileone->product_id = $product->id;

                $fileone->save(); 
                //dd($name);

            }

         }

         

        return redirect()->route('product.index')->with('success','Entry added Succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $inputs = $request->except('_token');
        $rules = [
            'name' => 'required | min:3',
            'category_id' => 'required| integer',
            'short_description' => 'required',
        ];

        $validation = Validator::make($inputs, $rules);
        if ($validation->fails())
        {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->short_description = $request->input('short_description');
        $product->description = $request->input('description');
        $product->status = $request->input('status');
        $product->user_id = Auth::id();
        $product->save();

        return redirect()->route('product.index')->with('success','Entry updated Succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index');
    }

    public function Delete(Request $request)
    {
        $product_id = $request->input('product_id');
        
        $product = Product::find($product_id);
        $product->delete();
        
        return 1;
    }
}
