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
        $imageName = "images/product/" . $request->file('img')->getClientOriginalName();
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
    public function delete($id)
    {
        $product = Product::find($id);

        $product->delete();

        return response()->json('successfully deleted');
    }
}
