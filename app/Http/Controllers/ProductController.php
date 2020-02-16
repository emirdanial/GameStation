<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Validator;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{

    public function index(Request $request)
    {

        // WORKING BUTTON + ROUTE
       /* $btn .= '<a data-toggle="modal" data-id="'.$product->id.'" href="' . route('products.show', $product->id) .'" class="btn btn-success btn-sm btnView">View</a>';*/

        if ($request->ajax()) {
            $data = Product::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($product){ 
                        $btn = '<a href="' . route('products.edit', $product->id) .'" class="btn btn-primary btn-sm mr-1 btnEdit" name="edit" >Edit</a>';
                        $btn .= '<a data-toggle="modal" href="#modalView" data-id="' . url('products/'.$product->id.'/show') .'" class="btn btn-success btn-sm mr-1 btnView">View</a>';
                        $btn .= '<button type="button" data-id="'.$product->id.'" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDelete">Delete</button>';
     
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }

/*        $products = Product::all();*/

        return view('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();

        return view('admin.products.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'price' => 'required|numeric',
            'platform' =>'required',
            'genre' => 'required',
            'publisher' => 'required',
            'image' => 'required|image|max:2048',
        ]);


        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $imagePath = request('image')->store('uploads', 'public');
        $image = Image::make(public_path("storage/{$imagePath}"));
        $image->save();

        $product = $request->except('image');
        $product['image'] = $imagePath;

        Product::create($product);
        return redirect()->route('admin.products.index');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return $product->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
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
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'price' => 'required|numeric',
            'platform' =>'required',
            'genre' => 'required',
            'publisher' => 'required',
            'image' => 'image|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        if (file_exists($request->image)) {
            $imagePath = $product->image;
            $image = public_path('/storage/'.$imagePath);
            unlink($image);
        }

        $imagePath = request('image')->store('uploads', 'public');
        $image = Image::make(public_path("storage/{$imagePath}"));
        $image->save();

        $data = $request->except('image');
        $data['image'] = $imagePath;

        $product->update($data);
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {   
        
        $imagePath = $product['image'];
        $image = public_path('/storage/'.$imagePath);

        if (file_exists($image)) {
            unlink($image);
        }
        
        $product->delete();

        return back();
    }
}
