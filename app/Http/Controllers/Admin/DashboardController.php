<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $activeProducts = Product::where('status', 1)->count();
        $inactiveProducts = Product::where('status', 0)->count();
        $totalCategories = Category::count();

        $latestProducts = Product::with('category')
            ->latest()
            ->take(5)
            ->get();

        $productsByCategory = Category::withCount('products')
            ->get();

        $monthlyProducts = Product::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('YEAR(created_at) as year'),
            DB::raw('COUNT(*) as total')
        )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        return view('admin.dashboard.index', compact(
            'totalProducts',
            'activeProducts',
            'inactiveProducts',
            'totalCategories',
            'latestProducts',
            'productsByCategory',
            'monthlyProducts'
        ));
    }
}
