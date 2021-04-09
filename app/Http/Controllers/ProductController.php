<?php


namespace App\Http\Controllers;


use App\Http\Resources\ProductCollection;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $post = new Product([
            'title' => $request->get('title'),
            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'img' => $request->get('img')
        ]);
        dd("dd");
        $post->save();

        return response()->json('successfully added');
    }

    public function index()
    {
        return new ProductCollection(Product::all());
    }
    public function delete($id)
    {
        $post = Product::find($id);

        $post->delete();

        return response()->json('successfully deleted');
    }
}
