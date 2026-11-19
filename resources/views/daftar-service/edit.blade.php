
@extends('layouts.app')

@section('title', 'Edit Daftar Service')
@section('page-title', 'Edit Daftar Service')

@section('content')

<div class="service-edit-page">

    <div class="service-edit-heading">
        <div>
            <h1>Edit Daftar Service</h1>
            <p>Perbarui informasi pendaftaran service kendaraan.</p>
        </div>

        <a href="{{ route('daftar-service.index') }}" class="service-back">
            ← Kembali
        </a>
    </div>

    <div class="service-edit-card">

        <div class="service-edit-intro">
            <div class="service-edit-icon">🔧</div>
            <div>
                <h3>Perbarui Informasi Service</h3>
                <p>ID Service:
                    <strong>{{ $daftarService->kode_service }}</strong>
                </p>
            </div>
        </div>

        @if ($errors->any())
            <div class="service-error">
                <strong>Periksa kembali data yang dimasukkan:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('daftar-service.update', $daftarService->id) }}"
            method="POST"
        >
            @csrf
            @method('PUT')

            <div class="service-edit-grid">

                <div class="service-edit-group">
                    <label>ID Service</label>
                    <input
                        type="text"
                        value="{{ $daftarService->kode_service }}"
                        readonly
                    >
                    <small>ID Service dibuat otomatis dan tidak dapat diubah.</small>
                </div>

                <div class="service-edit-group">
                    <label for="tanggal_service">Tanggal Service *</label>
                    <input
                        type="date"
                        name="tanggal_service"
                        id="tanggal_service"
                        value="{{ old('tanggal_service', \Carbon\Carbon::parse($daftarService->tanggal_service)->format('Y-m-d')) }}"
                        required
                    >
                </div>

                <div class="service-edit-group">
                    <label for="kendaraan_id">Nomor Plat Kendaraan *</label>

                    <select name="kendaraan_id" id="kendaraan_id" required>
                        <option value="">-- Pilih Kendaraan --</option>

                        @foreach ($kendaraans as $kendaraan)
                            <option
                                value="{{ $kendaraan->id }}"
                                {{ old('kendaraan_id', $daftarService->kendaraan_id) == $kendaraan->id ? 'selected' : '' }}
                            >
                                {{ $kendaraan->no_plat }} -
                                {{ ucfirst($kendaraan->jenis_kendaraan) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="service-edit-group">
                    <label for="pelanggan_id">ID Pelanggan *</label>

                    <select name="pelanggan_id" id="pelanggan_id" required>
                        <option value="">-- Pilih ID Pelanggan --</option>

                        @foreach ($pelanggans as $pelanggan)
                            <option
                                value="{{ $pelanggan->id }}"
                                data-nama="{{ $pelanggan->nama_lengkap }}"
                                {{ old('pelanggan_id', $daftarService->pelanggan_id) == $pelanggan->id ? 'selected' : '' }}
                            >
                                PLG{{ str_pad($pelanggan->id, 3, '0', STR_PAD_LEFT) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="service-edit-group full">
                    <label for="nama_pelanggan_display">Nama Pelanggan</label>

                    <input
                        type="text"
                        id="nama_pelanggan_display"
                        placeholder="Nama pelanggan tampil otomatis"
                        readonly
                    >

                    <small>Nama pelanggan mengikuti ID yang dipilih.</small>
                </div>

                <div class="service-edit-group full">
                    <label for="keluhan">Keluhan Kendaraan *</label>

                    <textarea
                        name="keluhan"
                        id="keluhan"
                        rows="5"
                        maxlength="1000"
                        placeholder="Tuliskan keluhan kendaraan..."
                        required
                    >{{ old('keluhan', $daftarService->keluhan) }}</textarea>
                </div>

            </div>

            <div class="service-edit-footer">
                <a
                    href="{{ route('daftar-service.index') }}"
                    class="service-cancel"
                >
                    Batal
                </a>

                <button type="submit" class="service-save">
                    ✓ Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</div>

<style>
    .service-edit-page {
        color: #f4f0ff;
    }

    .service-edit-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 25px;
    }

    .service-edit-heading h1 {
        margin: 0 0 8px;
        font-size: 24px;
        color: white;
    }

    .service-edit-heading p {
        margin: 0;
        font-size: 12px;
        color: #a9a1c2;
    }

    .service-back {
        padding: 11px 17px;
        background: #30294c;
        color: #c9b8f6;
        border-radius: 9px;
        text-decoration: none;
        font-size: 12px;
    }

    .service-edit-card {
        max-width: 900px;
        margin: auto;
        padding: 28px;
        background: #211d39;
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 17px;
    }

    .service-edit-intro {
        display: flex;
        align-items: center;
        gap: 15px;
        padding-bottom: 22px;
        margin-bottom: 25px;
        border-bottom: 1px solid rgba(255,255,255,.08);
    }

    .service-edit-icon {
        width: 50px;
        height: 50px;
        display: grid;
        place-items: center;
        border-radius: 13px;
        background: rgba(137,103,232,.16);
        font-size: 23px;
    }

    .service-edit-intro h3 {
        font-size: 15px;
        margin: 0 0 6px;
    }

    .service-edit-intro p {
        color: #a9a1c2;
        font-size: 11px;
        margin: 0;
    }

    .service-edit-intro strong {
        color: #c0a8ff;
    }

    .service-edit-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 22px;
    }

    .service-edit-group.full {
        grid-column: 1 / -1;
    }

    .service-edit-group label {
        display: block;
        margin-bottom: 9px;
        color: #ddd5f0;
        font-size: 12px;
        font-weight: 600;
    }

    .service-edit-group input,
    .service-edit-group select,
    .service-edit-group textarea {
        width: 100%;
        box-sizing: border-box;
        padding: 13px 14px;
        color: white;
        background: #19162d;
        border: 1px solid rgba(182,154,255,.19);
        border-radius: 9px;
        outline: none;
        font-family: inherit;
        font-size: 12px;
    }

    .service-edit-group input:focus,
    .service-edit-group select:focus,
    .service-edit-group textarea:focus {
        border-color: #9672ed;
        box-shadow: 0 0 0 3px rgba(137,103,232,.10);
    }

    .service-edit-group input[readonly] {
        color: #c5afff;
        background: #26203f;
        cursor: not-allowed;
    }

    .service-edit-group select option {
        background: #211d39;
        color: white;
    }

    .service-edit-group textarea {
        resize: vertical;
        min-height: 120px;
        line-height: 1.6;
    }

    .service-edit-group small {
        display: block;
        color: #9388ab;
        font-size: 10px;
        margin-top: 8px;
    }

    .service-edit-footer {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 27px;
        padding-top: 22px;
        border-top: 1px solid rgba(255,255,255,.08);
    }

    .service-cancel,
    .service-save {
        padding: 12px 20px;
        border: none;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
    }

    .service-cancel {
        color: #c9c2df;
        background: #302a4b;
    }

    .service-save {
        color: white;
        background: linear-gradient(135deg,#9672ed,#6846bd);
    }

    .service-save:hover {
        filter: brightness(1.12);
        transform: translateY(-1px);
    }

    .service-error {
        padding: 15px;
        margin-bottom: 22px;
        color: #ff9cab;
        background: rgba(239,84,112,.10);
        border: 1px solid rgba(239,84,112,.3);
        border-radius: 10px;
        font-size: 12px;
    }

    @media(max-width:650px) {
        .service-edit-grid {
            grid-template-columns: 1fr;
        }

        .service-edit-group.full {
            grid-column: auto;
        }

        .service-edit-card {
            padding: 19px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const pelangganSelect = document.getElementById('pelanggan_id');
        const namaPelanggan = document.getElementById('nama_pelanggan_display');

        function tampilkanNamaPelanggan() {
            const selectedOption =
                pelangganSelect.options[pelangganSelect.selectedIndex];

            namaPelanggan.value =
                selectedOption && selectedOption.value
                    ? selectedOption.getAttribute('data-nama') || ''
                    : '';
        }

        pelangganSelect.addEventListener('change', tampilkanNamaPelanggan);

        // Nama langsung tampil saat halaman edit dibuka.
        tampilkanNamaPelanggan();
    });
</script>

@endsection
