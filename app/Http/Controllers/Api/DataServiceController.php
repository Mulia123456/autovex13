<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DataService;
use App\Models\DaftarService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DataServiceController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'Data pengerjaan servis berhasil ditampilkan',
            'data' => DataService::with('daftarService.pelanggan', 'daftarService.kendaraan')
                ->latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'daftar_service_id' => 'required|exists:daftar_services,id|unique:data_services,daftar_service_id',
            'estimasi_service' => 'required|numeric|min:0',
            'nama_mekanik' => 'required|string|max:255',
            'sparepart_pengganti' => 'nullable|string',
        ]);

        $pendaftaran = DaftarService::findOrFail($validated['daftar_service_id']);

        $validated['keluhan'] = $pendaftaran->keluhan;

        $service = DataService::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data pengerjaan servis berhasil ditambahkan',
            'data' => $service->load('daftarService.pelanggan', 'daftarService.kendaraan'),
        ], 201);
    }

    public function show(DataService $dataService)
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail pengerjaan servis berhasil ditampilkan',
            'data' => $dataService->load('daftarService.pelanggan', 'daftarService.kendaraan'),
        ]);
    }

    public function update(Request $request, DataService $dataService)
    {
        $validated = $request->validate([
            'daftar_service_id' => [
                'required',
                'exists:daftar_services,id',
                Rule::unique('data_services', 'daftar_service_id')->ignore($dataService->id),
            ],
            'estimasi_service' => 'required|numeric|min:0',
            'nama_mekanik' => 'required|string|max:255',
            'sparepart_pengganti' => 'nullable|string',
        ]);

        $pendaftaran = DaftarService::findOrFail($validated['daftar_service_id']);
        $validated['keluhan'] = $pendaftaran->keluhan;

        $dataService->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data pengerjaan servis berhasil diperbarui',
            'data' => $dataService->load('daftarService.pelanggan', 'daftarService.kendaraan'),
        ]);
    }

    public function destroy(DataService $dataService)
    {
        $dataService->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data pengerjaan servis berhasil dihapus',
        ]);
    }
}
