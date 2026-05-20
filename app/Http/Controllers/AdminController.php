<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function showAddAdminForm()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return view('tambah-admin');
    }

    public function storeAdmin(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return redirect()->route('admin.index')->with('success', 'Akun admin baru berhasil ditambahkan!');
    }

    public function indexAdmin()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $admins = User::where('role', 'admin')->get();
        return view('manajemen-admin', compact('admins'));
    }

    public function editAdmin($id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $admin = User::findOrFail($id);
        return view('edit-admin', compact('admin'));
    }

    public function updateAdmin(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $admin = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $admin->id,
            'password' => 'nullable|string|min:3',
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()->route('admin.index')->with('success', 'Data admin berhasil diperbarui!');
    }

    public function deleteAdmin($id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $admin = User::findOrFail($id);

        // Prevent self-deletion
        if ($admin->id === Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $admin->delete();

        return redirect()->route('admin.index')->with('success', 'Akun admin berhasil dihapus!');
    }
}
