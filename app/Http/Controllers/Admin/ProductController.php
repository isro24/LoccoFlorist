<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; 

class ProductController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $query = Product::with('category')->latest();

        if($search = $request->get('search')){
            $query->where('name', 'like', "%{$search}%")
                  ->orWhereHas('category', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
        }

        $products = $query->paginate(10)->withQueryString();
        $categories = Category::all();

        if ($request->ajax()) {
            return view('admin.product.partials.product-table', compact('products'))->render();
        }

        return view('admin.product.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
            'category_id' => 'required|exists:categories,id',
        ],
        [
            'price.min' => 'Harga harus bernilai positif.',
        ]
    );

        $validated['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product = Product::create($validated);
        // $product->load('category');

        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil ditambahkan.');
        // return response()->json(['success' => 'Produk berhasil ditambahkan.', 'product' => $product]);
    }

    public function show(Product $product)
    {
        $product->load('category');
        return response()->json($product);
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
            'category_id' => 'required|exists:categories,id',
        ],
        [
            'price.min' => 'Harga harus bernilai positif.',
        ]
    );

        $validated['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);
        // $product->load('category');

        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil diperbarui.');
        // return response()->json(['success' => 'Produk berhasil diperbarui.', 'product' => $product]);
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        $product->delete();

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        return response()->json(['success' => 'Produk berhasil dihapus.']);
    }  
}
