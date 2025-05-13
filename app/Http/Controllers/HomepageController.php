<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class HomepageController extends Controller
{
    public function index()
    {
        $category = Category::all();
        
        return view('web.homepage', [
            'categories' => $category,
            'title' => 'Homepage'
        ]);
    }

    public function products()
    {
        $title = "Products";

        return view('web.products', [
            'title' => $title
        ]);
    }

    public function product($slug)
    {
        return view('web.product', [
            'slug' => $slug
        ]);
    }

    public function categories()
    {
        $category = Category::all(); // atau with pagination jika dibutuhkan
        return view('web.categories', [
            'title' => 'Categories',
            'categories' => $category
        ]);
    }

    public function category($slug)
    {
        // Jika slug bukan ID, gunakan where
        $category = Category::where('slug', $slug)->first();

        return view('web.category_by_slug', [
            'slug' => $slug, 
            'category' => $category
        ]);
    }

    public function cart()
    {
        return view('web.cart', [
            'title' => 'Cart'
        ]);
    }

    public function checkout()
    {
        return view('web.checkout', [
            'title' => 'Checkout'
        ]);
    }
}
