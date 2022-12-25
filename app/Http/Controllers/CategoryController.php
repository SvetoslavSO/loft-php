<?php

namespace App\Http\Controllers;

use App\Category;
use Auth;
use Illuminate\Http\Request;
use Image;

class CategoryController extends Controller
{
    function index() {
        $categories = Category::all();
        $admin = (Auth::user())->admin;
        return view('categories.categories', ['categories' => $categories, 'admin' => $admin]);
    }
    
    function addCategory(Request $request)
    {
        $data = $request->all();
        $text = $data['messageText'];
        $description = $data['description'];
        $extension = $data['image']->extension();
        $image = Image::make($data['image'])
            ->resize(null, 200, function($image) {
            $image->aspectRatio();
        });
        $image->save( getcwd() .'/resources/images/categories/' . $text . '.' . $extension);
        $category = new Category();
        $category->name = $text;
        $category->description = $description;
        $category->image = $text . '.' . $extension;
        $category->save();
        $categories = Category::all();
        $admin = (Auth::user())->admin;
        return view('categories.categories', ['categories' => $categories, 'admin' => $admin]);
    }

    function deleteCategory($category)
    {
        $admin = (Auth::user())->admin;
        if($admin){
            Category::where('name', $category)->delete();
            $categories = Category::all();
            return view('categories.categories', ['categories' => $categories, 'admin' => $admin]);
        } else {
            $categories = Category::all();
            return view('categories.categories', ['categories' => $categories, 'admin' => $admin]);
        }
    }

    function indexRedactCategory($category)
    {
        $admin = (Auth::user())->admin;
        if($admin){
            $categories = Category::where('name', $category)->get();
            return view('categories.categoriesRedact', ['category' => $categories[0], 'admin' => $admin]);
        } else {
            $categories = Category::all();
            return view('categories.categories', ['categories' => $categories, 'admin' => $admin]);
        }
    }

    function redactCategory(Request $request, $category)
    {
        $admin = (Auth::user())->admin;
        if($admin){
            $data = $request->all();
            $oldCategory = Category::where('name', $category)->get();
            $text = $data['messageText'];
            $description = $data['description'];
            if($_FILES['image']['tmp_name'] != ''){
                $extension = $data['image']->extension();
                $image = Image::make($data['image'])
                    ->resize(null, 200, function($image) {
                    $image->aspectRatio();
                });
                $image->save( getcwd() .'/resources/images/categories/' . $text . '.' . $extension);
            }
            $category = Category::where('name', $category)->update([
                'name' => $text == '' ? $oldCategory[0]['name'] : $text,
                'description'=> $description == '' ? $oldCategory[0]['description'] : $description,
                'image' => $_FILES['image']['tmp_name'] == '' ? $oldCategory[0]['image'] : $text . '.' . $extension
            ]);
            $categories = Category::all();
            $admin = (Auth::user())->admin;
            return redirect('categories', ['categories' => $categories, 'admin' => $admin]);
        } else {
            $categories = Category::all();
            $admin = (Auth::user())->admin;
            return redirect('categories', ['categories' => $categories, 'admin' => $admin]);
        }
    }
}
