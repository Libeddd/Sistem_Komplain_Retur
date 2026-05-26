<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaints = Auth::user()->complaints()->latest()->get();
        return view('home', compact('complaints'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kendala' => 'required|in:barang_rusak,barang_tidak_sesuai',
            'kategori' => 'required|string',
            'detail' => 'required|string',
            'produk_name' => 'required|string',
            'serial' => 'required|string',
            'tipe_refund' => 'required|in:bank,ewallet',
            'foto' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'video' => 'nullable|file|mimes:mp4,mov|max:51200',
        ]);

        $fotoPath = $request->file('foto')->store('complaints/fotos', 'public');
        $videoPath = $request->hasFile('video') ? $request->file('video')->store('complaints/videos', 'public') : null;

        $refundMethod = $request->tipe_refund === 'bank' 
            ? "Transfer Bank - {$request->pilihan_bank} ({$request->nomor_rekening})" 
            : "E-Wallet - {$request->pilihan_ewallet} ({$request->nomor_hp_ewallet})";

        Complaint::create([
            'complaint_code' => '#CMP-' . rand(1000, 9999),
            'user_id' => Auth::id(),
            'order_number' => $request->serial,
            'product_name' => $request->produk_name,
            'damage_category' => $request->kategori,
            'description' => $request->detail,
            'refund_method' => $refundMethod,
            'proof_image_path' => $fotoPath,
            'unboxing_video_path' => $videoPath,
            'status' => 'pending',
        ]);

        return redirect('/home')->with('success', 'Komplain berhasil diajukan dan sedang diproses admin.');
    }

    public function submitResi(Request $request, $id)
    {
        $request->validate([
            'nomor_resi' => ['required', 'string', 'min:5', 'max:50'],
        ]);

        $complaint = Complaint::where('id', $id)
                              ->where('user_id', Auth::id())
                              ->where('status', 'approved_menunggu_resi')
                              ->firstOrFail();

        $complaint->update([
            'nomor_resi' => $request->nomor_resi,
            'status'     => 'in_progress',
            'resi_at'    => now(),
        ]);

        return redirect()->back()->with('success', 'Nomor resi berhasil dikirim. Status komplain Anda kini "In Progress".');
    }
}
