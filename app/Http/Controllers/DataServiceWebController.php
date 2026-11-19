<?php

namespace App\Http\Controllers;

use App\Models\DataService;
use App\Models\DaftarService;
use Illuminate\Http\Request;

class DataServiceWebController extends Controller
{
    // Menampilkan seluruh data service
    public function index()
    {
        $dataServices = DataService::with([
            'daftarService.pelanggan',
            'daftarService.kendaraan'
        ])->latest()->get();

        return view('data-service.index', compact('dataServices'));
    }

    // Menampilkan form tambah data service
    public function create()
    {
        // Hanya menampilkan daftar service yang belum memiliki data service
        $daftarServices = DaftarService::with([
            'pelanggan',
            'kendaraan'
        ])
        ->whereDoesntHave('dataService')
        ->latest()
        ->get();

        return view('data-service.create', compact('daftarServices'));
    }

    // Menyimpan data service
    public function store(Request $request)
    {
        $validated = $request->validate([
            'daftar_service_id' => 'required|exists:daftar_services,id|unique:data_services,daftar_service_id',
            'estimasi_service' => 'required|numeric|min:0',
            'nama_mekanik' => 'required|string|max:255',
            'sparepart_pengganti' => 'nullable|string|max:255',
        ]);

        // Mengambil keluhan dari Daftar Service
        $daftarService = DaftarService::findOrFail(
            $validated['daftar_service_id']
        );

        $validated['keluhan'] = $daftarService->keluhan;

        DataService::create($validated);

        return redirect()
            ->route('data-service.index')
            ->with('success', 'Data service berhasil ditambahkan!');
    }

    // Menampilkan form edit
    public function edit(DataService $dataService)
    {
        $daftarServices = DaftarService::with([
            'pelanggan',
            'kendaraan'
        ])
        ->where(function ($query) use ($dataService) {
            $query->whereDoesntHave('dataService')
                  ->orWhere('id', $dataService->daftar_service_id);
        })
        ->latest()
        ->get();

        return view('data-service.edit', compact(
            'dataService',
            'daftarServices'
        ));
    }

    // Memperbarui data service
    public function update(Request $request, DataService $dataService)
    {
        $validated = $request->validate([
            'daftar_service_id' => [
                'required',
                'exists:daftar_services,id',
                'unique:data_services,daftar_service_id,' . $dataService->id,
            ],
            'estimasi_service' => 'required|numeric|min:0',
            'nama_mekanik' => 'required|string|max:255',
            'sparepart_pengganti' => 'nullable|string|max:255',
        ]);

        // Mengambil keluhan sesuai Daftar Service yang dipilih
        $daftarService = DaftarService::findOrFail(
            $validated['daftar_service_id']
        );

        $validated['keluhan'] = $daftarService->keluhan;

        $dataService->update($validated);

        return redirect()
            ->route('data-service.index')
            ->with('success', 'Data service berhasil diperbarui!');
    }

    // Menghapus data service
    public function destroy(DataService $dataService)
    {
        $dataService->load('daftarService');

        if (
            $dataService->daftarService &&
            $dataService->daftarService->pembayaranService()->exists()
        ) {
            return redirect()
                ->route('data-service.index')
                ->with(
                    'error',
                    'Data service tidak dapat dihapus karena sudah memiliki pembayaran.'
                );
        }

        $dataService->delete();

        return redirect()
            ->route('data-service.index')
            ->with('success', 'Data service berhasil dihapus!');
    }
}

