
@extends('layouts.app')

@section('title', 'Tambah Kendaraan')
@section('page-title', 'Tambah Kendaraan')

@section('content')

<div class="page-heading">
    <h1>Tambah Kendaraan 🏍️</h1>
    <p>Masukkan informasi kendaraan pelanggan ke dalam sistem AUTOVEX.</p>
</div>

<style>
    .vehicle-form-card {
        max-width: 850px;
        margin: auto;
        background: #211d39;
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 18px;
        padding: 30px;
    }

    .form-section-title {
        font-family: 'Outfit', sans-serif;
        font-size: 16px;
        margin-bottom: 22px;
        color: #c9b5ff;
    }

    .vehicle-form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .vehicle-form-group {
        margin-bottom: 20px;
    }

    .vehicle-form-group.full {
        grid-column: 1 / -1;
    }

    .vehicle-form-group label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: #d8d0eb;
        margin-bottom: 9px;
    }

    .vehicle-form-group input {
        width: 100%;
        padding: 13px 14px;
        border: 1px solid rgba(182,154,255,.2);
        border-radius: 10px;
        background: #19162d;
        color: white;
        font-family: inherit;
        font-size: 13px;
        outline: none;
        transition: .25s;
    }

    .vehicle-form-group input:focus {
        border-color: #8967e8;
        box-shadow: 0 0 0 3px rgba(137,103,232,.12);
    }

    .vehicle-form-group input::placeholder {
        color: #77718f;
    }

    .vehicle-radio-group {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .vehicle-radio-option {
        flex: 1;
        min-width: 140px;
        padding: 15px;
        border: 1px solid rgba(182,154,255,.2);
        border-radius: 11px;
        background: #19162d;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13px;
        color: #e6e0f7;
        transition: .25s;
    }

    .vehicle-radio-option:has(input:checked) {
        border-color: #8967e8;
        background: rgba(137,103,232,.15);
    }

    .vehicle-radio-option input {
        accent-color: #8967e8;
        width: 16px;
        height: 16px;
    }

    .vehicle-form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 15px;
        padding-top: 22px;
        border-top: 1px solid rgba(255,255,255,.08);
    }

    .vehicle-form-btn {
        padding: 12px 20px;
        border-radius: 10px;
        border: none;
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: .25s;
    }

    .vehicle-submit {
        background: linear-gradient(135deg,#8967e8,#5940a8);
        color: white;
    }

    .vehicle-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 20px #7655c955;
    }

    .vehicle-cancel {
        background: #302a4b;
        color: #c9c2df;
    }

    .vehicle-cancel:hover {
        background: #40375f;
    }

    @media(max-width:650px) {
        .vehicle-form-grid {
            grid-template-columns: 1fr;
        }

        .vehicle-form-group.full {
            grid-column: auto;
        }

        .vehicle-form-card {
            padding: 20px;
        }
    }
</style>

<div class="vehicle-form-card">

    <h3 class="form-section-title">✦ Informasi Kendaraan</h3>

    <form action="{{ route('kendaraan.store') }}" method="POST">
        @csrf

        <div class="vehicle-form-grid">

            <div class="vehicle-form-group">
                <label>Nomor Plat Kendaraan *</label>
                <input
                    type="text"
                    name="no_plat"
                    value="{{ old('no_plat') }}"
                    placeholder="Contoh: BP 1234 AA"
                    maxlength="20"
                    required
                >
            </div>

            <div class="vehicle-form-group">
                <label>Nomor STNK *</label>
                <input
                    type="text"
                    name="no_stnk"
                    value="{{ old('no_stnk') }}"
                    placeholder="Masukkan nomor STNK"
                    maxlength="50"
                    required
                >
            </div>

            <div class="vehicle-form-group full">
                <label>Jenis Kendaraan *</label>

                <div class="vehicle-radio-group">

                    <label class="vehicle-radio-option">
                        <input
                            type="radio"
                            name="jenis_kendaraan"
                            value="matic"
                            {{ old('jenis_kendaraan') == 'matic' ? 'checked' : '' }}
                            required
                        >
                        🛵 Matic
                    </label>

                    <label class="vehicle-radio-option">
                        <input
                            type="radio"
                            name="jenis_kendaraan"
                            value="manual"
                            {{ old('jenis_kendaraan') == 'manual' ? 'checked' : '' }}
                        >
                        🏍️ Manual Transmisi
                    </label>

                </div>
            </div>

            <div class="vehicle-form-group">
                <label>Tahun Pembuatan *</label>
                <input
                    type="number"
                    name="tahun_pembuatan"
                    value="{{ old('tahun_pembuatan') }}"
                    placeholder="Contoh: 2022"
                    min="1900"
                    max="{{ date('Y') }}"
                    required
                >
            </div>

            <div class="vehicle-form-group">
                <label>Nama Pemilik *</label>
                <input
                    type="text"
                    name="nama_pemilik"
                    value="{{ old('nama_pemilik') }}"
                    placeholder="Masukkan nama pemilik"
                    required
                >
            </div>

            <div class="vehicle-form-group full">
                <label>Warna Kendaraan *</label>
                <input
                    type="text"
                    name="warna"
                    value="{{ old('warna') }}"
                    placeholder="Contoh: Hitam, Merah, Putih"
                    required
                >
            </div>

        </div>

        <div class="vehicle-form-actions">

            <a href="{{ route('kendaraan.index') }}"
               class="vehicle-form-btn vehicle-cancel">
                Batal
            </a>

            <button type="submit"
                    class="vehicle-form-btn vehicle-submit">
                ✓ Simpan Kendaraan
            </button>

        </div>

    </form>

</div>

@endsection
