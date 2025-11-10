<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function userDashboard()
    {
        // Allow admins to view the user dashboard as well when they click the user "Dashboard" link.
        // Previously we redirected admins to /admin/dashboard automatically; that caused the user
        // dashboard link to always take admins away from the user view. Removing the redirect
        // keeps the link behavior consistent for all roles.

        try {
            $userId = session('user_id');
            $totalProducts = Product::where('status', 'aktif')->count();
            $totalOrders = Order::where('user_id', $userId)->count();
            $totalSpent = Order::where('user_id', $userId)->where('status', 'Selesai')->sum('total_harga') ?? 0;

            return view('user.dashboard', compact('totalProducts', 'totalOrders', 'totalSpent'));
        } catch (\Exception $e) {
            return view('user.dashboard', [
                'totalProducts' => 0,
                'totalOrders' => 0,
                'totalSpent' => 0
            ]);
        }
    }

    public function adminDashboard()
    {
        try {
            $totalProducts = Product::where('status', 'aktif')->count();
            $totalOrders = Order::count();
            $totalRevenue = Order::where('status', 'Selesai')->sum('total_harga') ?? 0;
            $pendingOrders = Order::where('status', 'Menunggu')->count();

            return view('admin.dashboard', compact('totalProducts', 'totalOrders', 'totalRevenue', 'pendingOrders'));
        } catch (\Exception $e) {
            return view('admin.dashboard', [
                'totalProducts' => 0,
                'totalOrders' => 0,
                'totalRevenue' => 0,
                'pendingOrders' => 0
            ]);
        }
    }

    public function wishlist()
    {
        $products = Product::where('status', 'aktif')->get();
        return view('user.wishlist', compact('products'));
    }

    public function notifications()
    {
        return view('admin.notifikasi');
    }
}