<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Image;
use Auth;

class ProductController extends Controller
{
    function index($category)
    {
        $products = Product::where('category', $category)->get();
        //$products = Product::where('category', $category);
        //$products = DB::table('products')->where('category', $category);
        $admin = (Auth::user())->admin;
        return view('products.products', ['products' => $products, 'category' => $category, 'admin' => $admin]);
    }

    function addProduct(Request $request, $category)
    {
        $data = $request->all();
        $name = $data['messageText'];
        $description = $data['description'];
        $price = $data['price'];
        $extension = $data['image']->extension();
        $image = Image::make($data['image'])
            ->resize(null, 200, function($image) {
            $image->aspectRatio();
        });
        $photoName = $this->genFileName($extension);
        $image->save( getcwd() .'/resources/images/products/' . $photoName);
        $product = new Product();
        $product->name = $name;
        $product->description = $description;
        $product->category = $category;
        $product->price = $price;
        $product->photo = $photoName;
        $product->save();
        $products = Product::where('category', $category)->get();
        $admin = (Auth::user())->admin;
        return view('products.products', ['products' => $products, 'category' => $category, 'admin' => $admin]);
    }

    public function genFileName ($extension)
    {
        return sha1(microtime(1) . rand(1, 1000000000)) . '.' . $extension;
    }
}
