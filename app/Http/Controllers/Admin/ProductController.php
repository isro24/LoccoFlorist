<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdditionalImage;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
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

        if ($search = $request->get('search')) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhereHas('category', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
        }

        $products = $query->paginate(10)->withQueryString();
        $categories = Category::all();

        if ($request->ajax()) {
            return view('admin.product.partials._product-table', compact('products'))->render();
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
        $validated = $request->validate(
            [
                'name' => 'required|string|max:255|unique:products,name',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'status' => 'required|boolean',
                'is_best_seller' => 'nullable|boolean',
                'category_id' => 'required|exists:categories,id',
                'extra_images' => 'nullable|array|max:3',
                'extra_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'price.min' => 'Harga harus bernilai positif.',
            ]
        );

        $validated['admin_id'] = Auth::id();

        $validated['is_best_seller'] = $request->boolean('is_best_seller');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product = Product::create($validated);
        // $product->load('category');

        if ($request->hasFile('extra_images')) {
            $files = array_slice($request->extra_images, 0, 4);
            foreach ($files as $img) {
                $path = $img->store('product_images', 'public');
                AdditionalImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                ]);
            }
        }

        $product->update($validated);

        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil ditambahkan.');
        // return response()->json(['success' => 'Produk berhasil ditambahkan.', 'product' => $product]);
    }

    public function show(Product $product)
    {
        $product->load('category');
        $product->load('images');
        return response()->json($product);
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $product->load('images');
        return view('admin.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $validated = $request->validate(
            [
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

        $validated['admin_id'] = Auth::id();

        if ($request->has('is_best_seller')) {
            $validated['is_best_seller'] = $request->boolean('is_best_seller');
        }

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);
        // $product->load('category');

        if ($request->hasFile('extra_images')) {
            $existingCount = $product->images()->count();
            $files = array_slice($request->file('extra_images'), 0, 4 - $existingCount);

            foreach ($files as $img) {
                $path = $img->store('product_images', 'public');

                AdditionalImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                ]);
            }
        }

        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil diperbarui.');


        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil diperbarui.');
        // return response()->json(['success' => 'Produk berhasil diperbarui.', 'product' => $product]);
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        foreach ($product->images as $img) {
            Storage::disk('public')->delete($img->image);
            $img->delete();
        }

        $product->delete();

        return response()->json(['success' => 'Produk berhasil dihapus.']);
    }

    public function destroyImage($id)
    {
        $image = AdditionalImage::findOrFail($id);

        if ($image->product) {
            $this->authorize('update', $image->product);
        }

        if ($image->image && Storage::disk('public')->exists($image->image)) {
            Storage::disk('public')->delete($image->image);
        }

        $image->delete();

        return response()->json(['success' => 'Gambar tambahan berhasil dihapus.']);
    }

    public function toggleBestSeller(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);

            $this->authorize('update', $product);

            $product->is_best_seller = $request->boolean('status');
            $product->save();

            return response()->json([
                'success' => true,
                'message' => 'Status Best Seller berhasil diubah!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan.'
            ], 500);
        }
    }
}
