<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KendaraanController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'Data kendaraan berhasil ditampilkan',
            'data' => Kendaraan::latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_plat' => 'required|string|max:255|unique:kendaraans,no_plat',
            'jenis_kendaraan' => 'required|in:matic,manual',
            'no_stnk' => 'required|string|max:255|unique:kendaraans,no_stnk',
            'tahun_pembuatan' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'nama_pemilik' => 'required|string|max:255',
            'warna' => 'required|string|max:100',
        ]);

        $kendaraan = Kendaraan::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Kendaraan berhasil ditambahkan',
            'data' => $kendaraan,
        ], 201);
    }

    public function show(Kendaraan $kendaraan)
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail kendaraan berhasil ditampilkan',
            'data' => $kendaraan,
        ]);
    }

    public function update(Request $request, Kendaraan $kendaraan)
    {
        $validated = $request->validate([
            'no_plat' => [
                'required', 'string', 'max:255',
                Rule::unique('kendaraans', 'no_plat')->ignore($kendaraan->id),
            ],
            'jenis_kendaraan' => 'required|in:matic,manual',
            'no_stnk' => [
                'required', 'string', 'max:255',
                Rule::unique('kendaraans', 'no_stnk')->ignore($kendaraan->id),
            ],
            'tahun_pembuatan' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'nama_pemilik' => 'required|string|max:255',
            'warna' => 'required|string|max:100',
        ]);

        $kendaraan->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Kendaraan berhasil diperbarui',
            'data' => $kendaraan,
        ]);
    }

    public function destroy(Kendaraan $kendaraan)
    {
        $kendaraan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kendaraan berhasil dihapus',
        ]);
    }
}

