<?php

namespace App\Http\Controllers;

use App\Models\DaftarService;
use App\Models\Pelanggan;
use App\Models\Kendaraan;
use Illuminate\Http\Request;

class DaftarServiceWebControllerBaru extends Controller
{
    // Menampilkan daftar seluruh service
    public function index()
    {
        $daftarServices = DaftarService::with([
            'pelanggan',
            'kendaraan'
        ])->latest()->get();

        return view('daftar-service.index', compact('daftarServices'));
    }

    // Menampilkan form tambah service
    public function create()
    {
        $pelanggans = Pelanggan::orderBy('nama_lengkap')->get();
        $kendaraans = Kendaraan::orderBy('no_plat')->get();

        return view('daftar-service.create', compact(
            'pelanggans',
            'kendaraans'
        ));
    }

    // Menyimpan data service
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'keluhan' => 'required|string|max:1000',
            'tanggal_service' => 'required|date',
        ]);

        $nomor = (DaftarService::max('id') ?? 0) + 1;

        $validated['kode_service'] = 'SRV' . str_pad(
            $nomor,
            3,
            '0',
            STR_PAD_LEFT
        );

        DaftarService::create($validated);

        return redirect()
            ->route('daftar-service.index')
            ->with('success', 'Daftar service berhasil ditambahkan!');
    }

    // Menampilkan form edit
    public function edit(DaftarService $daftarService)
    {
        $pelanggans = Pelanggan::orderBy('nama_lengkap')->get();
        $kendaraans = Kendaraan::orderBy('no_plat')->get();

        return view('daftar-service.edit', compact(
            'daftarService',
            'pelanggans',
            'kendaraans'
        ));
    }

    // Memperbarui data service
    public function update(
        Request $request,
        DaftarService $daftarService
    ) {
        $validated = $request->validate([
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'keluhan' => 'required|string|max:1000',
            'tanggal_service' => 'required|date',
        ]);

        $daftarService->update($validated);

        return redirect()
            ->route('daftar-service.index')
            ->with('success', 'Daftar service berhasil diperbarui!');
    }

    // Menghapus data service
    public function destroy(DaftarService $daftarService)
    {
        if (
            $daftarService->dataService()->exists() ||
            $daftarService->pembayaranService()->exists()
        ) {
            return redirect()
                ->route('daftar-service.index')
                ->with(
                    'error',
                    'Daftar service tidak dapat dihapus karena sudah memiliki data service atau pembayaran.'
                );
        }

        $daftarService->delete();

        return redirect()
            ->route('daftar-service.index')
            ->with('success', 'Daftar service berhasil dihapus!');
    }
}
