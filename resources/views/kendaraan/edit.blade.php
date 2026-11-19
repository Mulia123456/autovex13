
@extends('layouts.app')

@section('title', 'Edit Kendaraan')
@section('page-title', 'Edit Kendaraan')

@section('content')

<style>
    .vehicle-edit-card {
        max-width: 850px;
        margin: auto;
        background: #211d39;
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 18px;
        padding: 30px;
    }

    .vehicle-edit-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .vehicle-edit-group {
        margin-bottom: 20px;
    }

    .vehicle-edit-group.full {
        grid-column: 1 / -1;
    }

    .vehicle-edit-group label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: #d8d0eb;
        margin-bottom: 9px;
    }

    .vehicle-edit-group input:not([type="radio"]) {
        width: 100%;
        box-sizing: border-box;
        padding: 13px 14px;
        border: 1px solid rgba(182,154,255,.2);
        border-radius: 10px;
        background: #19162d;
        color: white;
        font-size: 13px;
        outline: none;
    }

    .vehicle-edit-group input:focus {
        border-color: #8967e8;
    }

    .vehicle-edit-radio {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .vehicle-edit-radio label {
        flex: 1;
        min-width: 140px;
        padding: 15px;
        border: 1px solid rgba(182,154,255,.2);
        border-radius: 11px;
        background: #19162d;
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
    }

    .vehicle-edit-radio input {
        accent-color: #8967e8;
    }

    .vehicle-edit-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 15px;
        padding-top: 22px;
        border-top: 1px solid rgba(255,255,255,.08);
    }

    .vehicle-edit-btn {
        padding: 12px 20px;
        border-radius: 10px;
        border: none;
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
    }

    .vehicle-edit-submit {
        background: linear-gradient(135deg,#8967e8,#5940a8);
        color: white;
    }

    .vehicle-edit-cancel {
        background: #302a4b;
        color: #c9c2df;
    }

    @media(max-width:650px) {
        .vehicle-edit-grid {
            grid-template-columns: 1fr;
        }

        .vehicle-edit-group.full {
            grid-column: auto;
        }
    }
</style>

<div class="vehicle-edit-card">

    <form action="{{ route('kendaraan.update', $kendaraan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="vehicle-edit-grid">

            <div class="vehicle-edit-group">
                <label>Nomor Plat Kendaraan *</label>
                <input type="text" name="no_plat"
                    value="{{ old('no_plat', $kendaraan->no_plat) }}"
                    maxlength="20" required>
            </div>

            <div class="vehicle-edit-group">
                <label>Nomor STNK *</label>
                <input type="text" name="no_stnk"
                    value="{{ old('no_stnk', $kendaraan->no_stnk) }}"
                    maxlength="50" required>
            </div>

            <div class="vehicle-edit-group full">
                <label>Jenis Kendaraan *</label>

                <div class="vehicle-edit-radio">
                    <label>
                        <input type="radio" name="jenis_kendaraan"
                            value="matic"
                            {{ old('jenis_kendaraan', $kendaraan->jenis_kendaraan) == 'matic' ? 'checked' : '' }}
                            required>
                        🛵 Matic
                    </label>

                    <label>
                        <input type="radio" name="jenis_kendaraan"
                            value="manual"
                            {{ old('jenis_kendaraan', $kendaraan->jenis_kendaraan) == 'manual' ? 'checked' : '' }}>
                        🏍️ Manual Transmisi
                    </label>
                </div>
            </div>

            <div class="vehicle-edit-group">
                <label>Tahun Pembuatan *</label>
                <input type="number" name="tahun_pembuatan"
                    value="{{ old('tahun_pembuatan', $kendaraan->tahun_pembuatan) }}"
                    min="1900" max="{{ date('Y') }}" required>
            </div>

            <div class="vehicle-edit-group">
                <label>Nama Pemilik *</label>
                <input type="text" name="nama_pemilik"
                    value="{{ old('nama_pemilik', $kendaraan->nama_pemilik) }}"
                    required>
            </div>

            <div class="vehicle-edit-group full">
                <label>Warna Kendaraan *</label>
                <input type="text" name="warna"
                    value="{{ old('warna', $kendaraan->warna) }}"
                    required>
            </div>

        </div>

        <div class="vehicle-edit-actions">
            <a href="{{ route('kendaraan.index') }}"
                class="vehicle-edit-btn vehicle-edit-cancel">
                Batal
            </a>

            <button type="submit"
                class="vehicle-edit-btn vehicle-edit-submit">
                ✓ Simpan Perubahan
            </button>
        </div>

    </form>
</div>

@endsection
