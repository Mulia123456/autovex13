<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DaftarService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DaftarServiceController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'Daftar servis berhasil ditampilkan',
            'data' => DaftarService::with(['pelanggan', 'kendaraan'])
                ->latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_service' => 'required|string|max:255|unique:daftar_services,kode_service',
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'keluhan' => 'required|string',
            'tanggal_service' => 'required|date',
        ]);

        $service = DaftarService::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pendaftaran servis berhasil ditambahkan',
            'data' => $service->load(['pelanggan', 'kendaraan']),
        ], 201);
    }

    public function show(DaftarService $daftarService)
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail pendaftaran servis berhasil ditampilkan',
            'data' => $daftarService->load([
                'pelanggan', 'kendaraan', 'dataService', 'pembayaranService'
            ]),
        ]);
    }

    public function update(Request $request, DaftarService $daftarService)
    {
        $validated = $request->validate([
            'kode_service' => [
                'required', 'string', 'max:255',
                Rule::unique('daftar_services', 'kode_service')->ignore($daftarService->id),
            ],
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'keluhan' => 'required|string',
            'tanggal_service' => 'required|date',
        ]);

        $daftarService->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pendaftaran servis berhasil diperbarui',
            'data' => $daftarService->load(['pelanggan', 'kendaraan']),
        ]);
    }

    public function destroy(DaftarService $daftarService)
    {
        $daftarService->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pendaftaran servis berhasil dihapus',
        ]);
    }
}
