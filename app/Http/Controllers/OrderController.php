<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        try {
            $orders = Order::orderBy('created_at', 'desc')->get();
            $pendingOrders = Order::where('status', 'Menunggu')->count();
            $completedOrders = Order::where('status', 'Selesai')->count();
            $cancelledOrders = Order::where('status', 'Dibatalkan')->count();
            
            return view('admin.pesanan', compact('orders', 'pendingOrders', 'completedOrders', 'cancelledOrders'));
        } catch (\Exception $e) {
            return view('admin.pesanan', [
                'orders' => collect(),
                'pendingOrders' => 0,
                'completedOrders' => 0,
                'cancelledOrders' => 0
            ]);
        }
    }

    public function userOrders()
    {
        $userId = session('user_id');
        $orders = Order::where('user_id', $userId)
                      ->orderBy('created_at', 'desc')
                      ->get();
        
        return view('user.pesanan', compact('orders'));
    }

    public function riwayat()
    {
        $userId = session('user_id');
        $orders = Order::where('user_id', $userId)
                      ->orderBy('created_at', 'desc')
                      ->get();
        
        return view('user.riwayat', compact('orders'));
    }

    public function checkout()
    {
        return view('user.checkout');
    }

    public function store(Request $request)
    {
        try {
            $cartItems = json_decode($request->cart_items, true);
            $buktiPath = null;
            
            // Handle file upload
            if ($request->hasFile('bukti_pembayaran')) {
                $file = $request->file('bukti_pembayaran');
                $fileName = 'bukti_' . time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('assets/img'), $fileName);
                $buktiPath = $fileName;
            }
            
            foreach ($cartItems as $item) {
                Order::create([
                    'user_id' => session('user_id'),
                    'nama_pembeli' => session('user_name'),
                    'kelas' => $request->kelas ?? session('user_kelas') ?? 'N/A',
                    'ruangan' => $request->ruangan ?? 'N/A',
                    'lokasi_sekolah' => $request->lokasi_sekolah ?? 'SMK Negeri 1 Jakarta',
                    'product_id' => $item['id'],
                    'nama_produk' => $item['name'],
                    'jumlah' => $item['quantity'],
                    'harga_satuan' => $item['price'],
                    'total_harga' => $item['price'] * $item['quantity'],
                    'status' => 'Menunggu',
                    'metode_pembayaran' => $request->payment_method ?? 'Cash',
                    'metode_pengambilan' => $request->pickup_method ?? 'Ambil di Kantin',
                    'waktu_pengambilan' => $request->pickup_time,
                    'catatan' => $request->notes,
                    'bukti_pembayaran' => $buktiPath,
                ]);
            }

            return redirect()->route('pesanan')->with('success', 'Pesanan berhasil dibuat!');
        } catch (\Exception $e) {
            return redirect()->route('checkout')->with('error', 'Gagal membuat pesanan: ' . $e->getMessage());
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return redirect()->route('admin.pesanan')->with('success', 'Status pesanan berhasil diupdate');
    }

    public function cancel($id)
    {
        $order = Order::findOrFail($id);
        
        // Only allow cancellation if order is still pending
        if ($order->status === 'Menunggu') {
            $order->update(['status' => 'Dibatalkan']);
            return redirect()->route('pesanan')->with('success', 'Pesanan berhasil dibatalkan');
        }
        
        return redirect()->route('pesanan')->with('error', 'Pesanan tidak dapat dibatalkan');
    }

    public function delete($id)
    {
        $order = Order::findOrFail($id);
        
        // Check if order belongs to current user
        if ($order->user_id == session('user_id')) {
            $order->delete();
            return redirect()->route('pesanan')->with('success', 'Pesanan berhasil dihapus');
        }
        
        return redirect()->route('pesanan')->with('error', 'Tidak dapat menghapus pesanan ini');
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.edit-pesanan', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update([
            'nama_pembeli' => $request->nama_pembeli,
            'kelas' => $request->kelas,
            'ruangan' => $request->ruangan,
            'jumlah' => $request->jumlah,
            'status' => $request->status
        ]);

        return redirect()->route('admin.pesanan')->with('success', 'Pesanan berhasil diupdate');
    }

    public function destroy($id)
    {
        Order::findOrFail($id)->delete();
        return redirect()->route('admin.pesanan')->with('success', 'Pesanan berhasil dihapus');
    }

    public function getOrderCount()
    {
        try {
            $count = Order::count();
            return response()->json(['count' => $count]);
        } catch (\Exception $e) {
            return response()->json(['count' => 0]);
        }
    }

    // Return aggregated totals for admin dashboard
    public function getTotals()
    {
        try {
            $totalRevenue = Order::where('status', 'Selesai')->sum('total_harga');
            $pendingCount = Order::where('status', 'Menunggu')->count();

            return response()->json([
                'total_revenue' => $totalRevenue,
                'pending_count' => $pendingCount,
            ]);
        } catch (\Exception $e) {
            return response()->json(['total_revenue' => 0, 'pending_count' => 0]);
        }
    }

    // Mark all pending orders as completed and return updated totals
    public function completeAllPending()
    {
        try {
            // Update pending orders to Selesai
            Order::where('status', 'Menunggu')->update(['status' => 'Selesai']);

            $totalRevenue = Order::where('status', 'Selesai')->sum('total_harga');
            $pendingCount = Order::where('status', 'Menunggu')->count();

            return response()->json([
                'success' => true,
                'total_revenue' => $totalRevenue,
                'pending_count' => $pendingCount,
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    // Return total spent by current logged-in user
    public function getUserTotalSpent()
    {
        try {
            $userId = session('user_id');
            if (!$userId) {
                return response()->json(['total_spent' => 0]);
            }

            $total = Order::where('user_id', $userId)->where('status', 'Selesai')->sum('total_harga');
            return response()->json(['total_spent' => $total]);
        } catch (\Exception $e) {
            return response()->json(['total_spent' => 0]);
        }
    }

    // Return list of pending orders (for admin notifications)
    public function getPendingOrders()
    {
        try {
            $orders = Order::where('status', 'Menunggu')
                ->orderBy('created_at', 'asc')
                ->get(['id', 'user_id', 'nama_pembeli', 'product_id', 'nama_produk', 'jumlah', 'total_harga', 'created_at']);

            return response()->json(['orders' => $orders]);
        } catch (\Exception $e) {
            return response()->json(['orders' => []]);
        }
    }

    // Delete all orders
    public function deleteAll()
    {
        try {
            Order::truncate();
            return redirect()->route('admin.pesanan')->with('success', 'Semua pesanan berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('admin.pesanan')->with('error', 'Gagal menghapus semua pesanan: ' . $e->getMessage());
        }
    }
}