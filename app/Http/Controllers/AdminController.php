<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Image;

class AdminController extends Controller
{
    function index() 
    {  
        $categories = Category::all();
        return view('admin.adminPage' , ['categories' => $categories]);
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
    }

    function deleteCategory(Request $request)
    {

    }
}