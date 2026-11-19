<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PembayaranService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PembayaranServiceController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'Data pembayaran berhasil ditampilkan',
            'data' => PembayaranService::with('daftarService.pelanggan', 'daftarService.kendaraan')
                ->latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'daftar_service_id' => 'required|exists:daftar_services,id|unique:pembayaran_services,daftar_service_id',
            'jumlah_biaya' => 'required|numeric|min:0',
            'jenis_pembayaran' => 'required|in:cash,non_tunai',
            'keterangan' => 'nullable|string',
        ]);

        $pembayaran = PembayaranService::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran servis berhasil ditambahkan',
            'data' => $pembayaran->load('daftarService.pelanggan', 'daftarService.kendaraan'),
        ], 201);
    }

    public function show(PembayaranService $pembayaranService)
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail pembayaran berhasil ditampilkan',
            'data' => $pembayaranService->load('daftarService.pelanggan', 'daftarService.kendaraan'),
        ]);
    }

    public function update(Request $request, PembayaranService $pembayaranService)
    {
        $validated = $request->validate([
            'daftar_service_id' => [
                'required',
                'exists:daftar_services,id',
                Rule::unique('pembayaran_services', 'daftar_service_id')->ignore($pembayaranService->id),
            ],
            'jumlah_biaya' => 'required|numeric|min:0',
            'jenis_pembayaran' => 'required|in:cash,non_tunai',
            'keterangan' => 'nullable|string',
        ]);

        $pembayaranService->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran servis berhasil diperbarui',
            'data' => $pembayaranService->load('daftarService.pelanggan', 'daftarService.kendaraan'),
        ]);
    }

    public function destroy(PembayaranService $pembayaranService)
    {
        $pembayaranService->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran servis berhasil dihapus',
        ]);
    }
}
