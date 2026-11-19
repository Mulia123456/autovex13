<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KendaraanWebController extends Controller
{
    // Menampilkan seluruh data kendaraan
    public function index()
    {
        $kendaraans = Kendaraan::latest()->get();

        return view('kendaraan.index', compact('kendaraans'));
    }

    // Menampilkan form tambah kendaraan
    public function create()
    {
        return view('kendaraan.create');
    }

    // Menyimpan kendaraan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_plat' => 'required|string|max:20|unique:kendaraans,no_plat',
            'jenis_kendaraan' => 'required|in:matic,manual',
            'no_stnk' => 'required|string|max:50|unique:kendaraans,no_stnk',
            'tahun_pembuatan' => 'required|integer|min:1900|max:' . date('Y'),
            'nama_pemilik' => 'required|string|max:255',
            'warna' => 'required|string|max:100',
        ]);

        Kendaraan::create($validated);

        return redirect()
            ->route('kendaraan.index')
            ->with('success', 'Data kendaraan berhasil ditambahkan!');
    }

    // Menampilkan form edit
    public function edit(Kendaraan $kendaraan)
    {
        return view('kendaraan.edit', compact('kendaraan'));
    }

    // Memperbarui data kendaraan
    public function update(Request $request, Kendaraan $kendaraan)
    {
        $validated = $request->validate([
            'no_plat' => 'required|string|max:20|unique:kendaraans,no_plat,' . $kendaraan->id,
            'jenis_kendaraan' => 'required|in:matic,manual',
            'no_stnk' => 'required|string|max:50|unique:kendaraans,no_stnk,' . $kendaraan->id,
            'tahun_pembuatan' => 'required|integer|min:1900|max:' . date('Y'),
            'nama_pemilik' => 'required|string|max:255',
            'warna' => 'required|string|max:100',
        ]);

        $kendaraan->update($validated);

        return redirect()
            ->route('kendaraan.index')
            ->with('success', 'Data kendaraan berhasil diperbarui!');
    }

    // Menghapus kendaraan
    public function destroy(Kendaraan $kendaraan)
    {
        if ($kendaraan->daftarServices()->exists()) {
            return redirect()
                ->route('kendaraan.index')
                ->with('error', 'Kendaraan tidak dapat dihapus karena masih memiliki riwayat service.');
        }

        $kendaraan->delete();

        return redirect()
            ->route('kendaraan.index')
            ->with('success', 'Data kendaraan berhasil dihapus!');
    }
}

