<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /** Katalog publik — demo eager loading (with / withCount / withAvg). */
    public function index(Request $request)
    {
        $products = Product::query()
            ->with('category')
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->active()
            ->search($request->query('q'))
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        return view('products.index', compact('products'));
    }
}
