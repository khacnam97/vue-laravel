<?php


namespace App\Http\Controllers;


use App\Http\Resources\ProductCollection;
use App\Product;
use Illuminate\Http\Request;
use File;
use Image;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $image = $request->file('img');
        $imageName = "/images/product/" . $request->file('img')->getClientOriginalName();
        Image::make($image)->save(public_path($imageName));
        $post = new Product([
            'title' => $request->get('title'),
            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'img' => $imageName
        ]);
        $post->save();

        return response()->json('successfully added');
    }

    public function index()
    {
        return new ProductCollection(Product::all());
    }
    public function edit($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    public function update($id, Request $request)
    {
        $image = $request->file('img');
        $all = $request->all();

        if ($image){
            $imageName = "/images/product/" . $request->file('img')->getClientOriginalName();
            Image::make($image)->save(public_path($imageName));
            $all['img'] = $imageName;
        }

        $product = Product::find($id);

        $product->update($all);

        return response()->json('successfully updated');
    }
    public function delete($id)
    {
        $product = Product::find($id);

        $product->delete();

        return response()->json('successfully deleted');
    }
}
