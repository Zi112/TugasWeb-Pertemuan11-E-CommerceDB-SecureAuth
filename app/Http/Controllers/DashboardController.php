<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Post;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    /** Hanya role admin (lihat routes/web.php). */
    public function admin()
    {
        $stats = [
            'Total User'    => User::count(),
            'Total Produk'  => Product::count(),
            'Total Order'   => Order::count(),
            'Total Artikel' => Post::count(),
        ];

        $users = User::orderBy('role')->orderBy('name')->get(['id', 'name', 'email', 'role']);

        return view('admin.dashboard', compact('stats', 'users'));
    }

    /** Role admin & editor. */
    public function editor()
    {
        $myPosts = auth()->user()->posts()->latest()->get();

        return view('editor.dashboard', compact('myPosts'));
    }
}
