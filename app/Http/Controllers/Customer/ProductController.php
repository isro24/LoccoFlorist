<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category; 
use Illuminate\Http\Request; 

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->where('status', true)
            ->latest()
            ->take(8) 
            ->get();

        return view('customer.index', compact('products'));
    }

    public function catalog(Request $request)
    {
        $query = Product::query()->with('category')->where('status', true);

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('name', $request->category);
            });
        }
        
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        switch ($request->input('sort', 'latest')) { 
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->latest(); 
                break;
        }
        
        $categories = Category::all();

        $products = $query->paginate(8)->appends($request->except('page'));

        return view('customer.catalog', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::with('category')->where('slug', $slug)->firstOrFail();

        if (!$product->status){
            return redirect()->route('home')->with('warning', 'Product tidak tersedia');
        }

        $relatedProducts = Product::where('status', true)
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('customer.show', compact('product', 'relatedProducts'));
    }

}