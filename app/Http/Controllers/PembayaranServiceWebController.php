<?php

namespace App\Http\Controllers;

use App\Models\PembayaranService;
use App\Models\DaftarService;
use Illuminate\Http\Request;

class PembayaranServiceWebController extends Controller
{
    // Menampilkan seluruh data pembayaran
    public function index()
    {
        $pembayarans = PembayaranService::with([
            'daftarService.pelanggan',
            'daftarService.kendaraan'
        ])->latest()->get();

        return view('pembayaran-service.index', compact('pembayarans'));
    }

    // Menampilkan form tambah pembayaran
    public function create()
    {
        // Hanya service yang sudah memiliki Data Service
        // dan belum memiliki pembayaran yang ditampilkan
        $daftarServices = DaftarService::with([
            'pelanggan',
            'kendaraan',
            'dataService'
        ])
        ->whereHas('dataService')
        ->whereDoesntHave('pembayaranService')
        ->latest()
        ->get();

        return view('pembayaran-service.create', compact('daftarServices'));
    }

    // Menyimpan pembayaran baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'daftar_service_id' => [
                'required',
                'exists:daftar_services,id',
                'unique:pembayaran_services,daftar_service_id',
            ],
            'jumlah_biaya' => 'required|numeric|min:0',
            'jenis_pembayaran' => 'required|in:cash,non_tunai',
            'keterangan' => 'nullable|string|max:1000',
        ]);

        PembayaranService::create($validated);

        return redirect()
            ->route('pembayaran-service.index')
            ->with('success', 'Pembayaran service berhasil ditambahkan!');
    }

    // Menampilkan form edit pembayaran
    public function edit(PembayaranService $pembayaranService)
    {
        $daftarServices = DaftarService::with([
            'pelanggan',
            'kendaraan',
            'dataService'
        ])
        ->whereHas('dataService')
        ->where(function ($query) use ($pembayaranService) {
            $query->whereDoesntHave('pembayaranService')
                ->orWhere('id', $pembayaranService->daftar_service_id);
        })
        ->latest()
        ->get();

        return view('pembayaran-service.edit', compact(
            'pembayaranService',
            'daftarServices'
        ));
    }

    // Memperbarui pembayaran
    public function update(
        Request $request,
        PembayaranService $pembayaranService
    ) {
        $validated = $request->validate([
            'daftar_service_id' => [
                'required',
                'exists:daftar_services,id',
                'unique:pembayaran_services,daftar_service_id,' . $pembayaranService->id,
            ],
            'jumlah_biaya' => 'required|numeric|min:0',
            'jenis_pembayaran' => 'required|in:cash,non_tunai',
            'keterangan' => 'nullable|string|max:1000',
        ]);

        $pembayaranService->update($validated);

        return redirect()
            ->route('pembayaran-service.index')
            ->with('success', 'Pembayaran service berhasil diperbarui!');
    }

    // Menghapus pembayaran
    public function destroy(PembayaranService $pembayaranService)
    {
        $pembayaranService->delete();

        return redirect()
            ->route('pembayaran-service.index')
            ->with('success', 'Pembayaran service berhasil dihapus!');
    }
}

