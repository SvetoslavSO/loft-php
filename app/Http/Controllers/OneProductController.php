<?php

namespace App\Http\Controllers;

use App\Product;
use App\Orders;
use App\Category;
use Illuminate\Http\Request;
use Image;
use Auth;
use Mail;

class OneProductController extends Controller
{
    function index($category, $product)
    {   
        $products = Product::where('name', $product)->get();
        $admin = (Auth::user())->admin;
        return view('products.product', ['product' => $products, 'category' => $category, 'admin' => $admin]);
    }

    function buyProductIndex($category, $product)
    {
        $user = Auth::user();
        $products = Product::where('name', $product)->get();
        return view('products.productBuy', ['product' => $products, 'category' => $category, 'user' => $user]);
    }

    function confirmBuy(Request $request, $category, $product)
    {
        $data = $request->all();
        Mail::send([], [], function($message) use ($data, $product){
                $message->to('php-loft@mail.ru', 'to admin')->subject('new order from '.$data['name'].' user mail '.$data['email'].' product id: '.$product);
                $message->from('php-loft@mail.ru', 'new order');
            }
        );
        $order = new Orders();
        $order->email = $data['email'];
        $order->product_id = $product;
        $order->save();
        return redirect('categories');
    }

    function deleteCategory($category, $product)
    {
        $admin = (Auth::user())->admin;
        if($admin){
            Product::where('name', $product)->delete();
            $products = Product::where('name', $product)->get();
            return view('products.product', ['product' => $products, 'category' => $category, 'admin' => $admin]);
        } else {
            $products = Product::where('name', $product)->get();
            return view('products.product', ['product' => $products, 'category' => $category, 'admin' => $admin]);
        }
    }

    function redactProduct(Request $request, $category, $product)
    {
        $admin = (Auth::user())->admin;
        if($admin){
            $data = $request->all();
            $oldProduct = Product::where('name', $product)->get();
            $text = $data['messageText'];
            $description = $data['description'];
            $price = $data['price'];
            if($_FILES['photo']['tmp_name'] != ''){
                $extension = $data['photo']->extension();
                $image = Image::make($data['photo'])
                    ->resize(null, 200, function($image) {
                    $image->aspectRatio();
                });
                $photoName = $this->genFileName($extension);
                $image->save( getcwd() .'/resources/images/products/' . $photoName);
            }
            Product::where('name', $product)->update([
                'name' => $text == '' ? $oldProduct[0]['name'] : $text,
                'description'=> $description == '' ? $oldProduct[0]['description'] : $description,
                'photo' => $_FILES['photo']['tmp_name'] == '' ? $oldProduct[0]['photo'] : $photoName,
                'price' => $price == '' ? $oldProduct[0]['price'] : $price
            ]);
            $name = $text == '' ? $oldProduct[0]['name'] : $text;
            $products = Product::where('name', $name)->get();
            $admin = (Auth::user())->admin;
            return view('products.product', ['product' => $products, 'category' => $category, 'admin' => $admin]);
        } else {
            $products = Product::where('name', $product)->get();
            return view('products.product', ['product' => $products, 'category' => $category, 'admin' => $admin]);
        }
    }

    public function genFileName ($extension)
    {
        return sha1(microtime(1) . rand(1, 1000000000)) . '.' . $extension;
    }
}
