<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $total = Complaint::count();
        $pending = Complaint::where('status', 'pending')->count();
        $approved = Complaint::where('status', 'approved')->count();
        $done = Complaint::where('status', 'done')->count();

        // Top Produk
        $topProduct = Complaint::select('product_name')
            ->selectRaw('count(*) as total')
            ->groupBy('product_name')
            ->orderByDesc('total')
            ->first();

        // Kategori Dominan
        $topCategory = Complaint::select('damage_category')
            ->selectRaw('count(*) as total')
            ->groupBy('damage_category')
            ->orderByDesc('total')
            ->first();

        // Grafik Tipe Kerusakan
        $chartData = Complaint::select('damage_category')
            ->selectRaw('count(*) as total')
            ->groupBy('damage_category')
            ->pluck('total', 'damage_category')
            ->toArray();

        // Optional: Get latest complaints for the dashboard
        $latestComplaints = Complaint::with('user')->latest()->take(5)->get();

        return view('dashboard', compact('total', 'pending', 'approved', 'done', 'topProduct', 'topCategory', 'chartData', 'latestComplaints'));
    }

    public function manajemen()
    {
        $complaints = Complaint::with('user')->latest()->get();
        return view('manajemen-komplain', compact('complaints'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,done,rejected'
        ]);

        $complaint = Complaint::findOrFail($id);
        $complaint->status = $request->status;
        if ($request->status === 'done') {
            $complaint->completed_at = now();
        }
        $complaint->save();

        return redirect()->back()->with('success', 'Status komplain berhasil diperbarui!');
    }
}
