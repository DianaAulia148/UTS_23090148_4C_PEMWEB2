<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');

        $products = Product::when($q, function ($query, $q) {
            return $query->where('name', 'like', "%$q%");
        })->paginate(10);

        $category = Category::all();

        return view('dashboard.products.index', compact('products', 'category', 'q'));
    }

    public function create()
    {
        $category = Category::all();
        return view('dashboard.products.create', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'is_active' => 'required|boolean',
            'categories_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->slug = \Str::slug($request->name);
        $product->sku = $request->sku ?? \Str::random(8);
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->is_active = $request->is_active;
        $product->categories_id = $request->categories_id;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $product->image_url = $imagePath;
        }

        $product->save();

        return redirect()->route('dashboard.products.index')->with('successMessage', 'Product data successfully saved');
    }

    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('dashboard.products.show', compact('product'));
    }

    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $category = Category::all();
        return view('dashboard.products.edit', compact('product', 'category'));
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $product->id,
            'description' => 'nullable|string',
            'sku' => 'required|string|max:50|unique:products,sku,' . $product->id,
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categories_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()
                ->with('errorMessage', 'Validation failed, please fill in the required fields.');
        }

        $product->fill($request->only([
            'name', 'slug', 'description', 'sku', 'price',
            'stock', 'categories_id', 'is_active'
        ]));

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->image_url = $path;
        }

        $product->save();

        return redirect()->route('dashboard.products.index')->with('successMessage', 'Product data successfully updated');
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('dashboard.products.index')->with('successMessage', 'Product data successfully deleted');
    }

    public function publicView($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('dashboard.products.show', compact('product'));
    }
}
