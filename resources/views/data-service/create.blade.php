
@extends('layouts.app')

@section('title', 'Tambah Data Service')
@section('page-title', 'Tambah Data Service')

@section('content')

<div class="data-form-page">

    <div class="data-form-heading">
        <div>
            <h1>Tambah Data Service</h1>
            <p>Masukkan detail pengerjaan service kendaraan pelanggan.</p>
        </div>

        <a href="{{ route('data-service.index') }}" class="data-back-btn">
            ← Kembali
        </a>
    </div>

    <div class="data-form-card">

        <div class="data-form-intro">
            <div class="data-form-icon">⚙️</div>
            <div>
                <h3>Informasi Pengerjaan Service</h3>
                <p>Lengkapi informasi pekerjaan mekanik dan sparepart.</p>
            </div>
        </div>

        @if ($errors->any())
            <div class="data-error-box">
                <strong>Data belum berhasil disimpan:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($daftarServices->isEmpty())
            <div class="data-warning-box">
                <strong>Belum ada ID Service yang tersedia!</strong>
                <p>
                    Semua pendaftaran service mungkin sudah memiliki Data Service.
                    Tambahkan Daftar Service baru terlebih dahulu.
                </p>
            </div>
        @endif

        <form action="{{ route('data-service.store') }}" method="POST">
            @csrf

            <div class="data-form-grid">

                <div class="data-form-group full">
                    <label for="daftar_service_id">
                        ID Service <span>*</span>
                    </label>

                    <select
                        name="daftar_service_id"
                        id="daftar_service_id"
                        required
                    >
                        <option value="">-- Pilih ID Service --</option>

                        @foreach ($daftarServices as $service)
                            <option
                                value="{{ $service->id }}"
                                data-keluhan="{{ $service->keluhan }}"
                                data-pelanggan="{{ $service->pelanggan->nama_lengkap ?? '-' }}"
                                data-plat="{{ $service->kendaraan->no_plat ?? '-' }}"
                                {{ old('daftar_service_id') == $service->id ? 'selected' : '' }}
                            >
                                {{ $service->kode_service }}
                                - {{ $service->pelanggan->nama_lengkap ?? 'Pelanggan' }}
                                - {{ $service->kendaraan->no_plat ?? 'Kendaraan' }}
                            </option>
                        @endforeach
                    </select>

                    <small>
                        Pilih ID Service dari pendaftaran yang belum memiliki Data Service.
                    </small>
                </div>

                <div class="data-form-group">
                    <label for="nama_pelanggan_display">
                        Nama Pelanggan
                    </label>

                    <input
                        type="text"
                        id="nama_pelanggan_display"
                        placeholder="Terisi otomatis"
                        readonly
                    >
                </div>

                <div class="data-form-group">
                    <label for="no_plat_display">
                        Nomor Plat Kendaraan
                    </label>

                    <input
                        type="text"
                        id="no_plat_display"
                        placeholder="Terisi otomatis"
                        readonly
                    >
                </div>

                <div class="data-form-group full">
                    <label for="keluhan_display">
                        Keluhan Kendaraan
                    </label>

                    <textarea
                        id="keluhan_display"
                        rows="4"
                        placeholder="Keluhan akan muncul otomatis setelah ID Service dipilih"
                        readonly
                    ></textarea>

                    <small>
                        Keluhan diambil langsung dari Daftar Service.
                    </small>
                </div>

                <div class="data-form-group">
                    <label for="estimasi_service">
                        Estimasi Service (Rp) <span>*</span>
                    </label>

                    <input
                        type="number"
                        name="estimasi_service"
                        id="estimasi_service"
                        value="{{ old('estimasi_service') }}"
                        min="0"
                        step="1000"
                        placeholder="Contoh: 300000"
                        required
                    >
                </div>

                <div class="data-form-group">
                    <label for="nama_mekanik">
                        Nama Mekanik <span>*</span>
                    </label>

                    <input
                        type="text"
                        name="nama_mekanik"
                        id="nama_mekanik"
                        value="{{ old('nama_mekanik') }}"
                        placeholder="Masukkan nama mekanik"
                        maxlength="255"
                        required
                    >
                </div>

                <div class="data-form-group full">
                    <label for="sparepart_pengganti">
                        Sparepart Pengganti
                    </label>

                    <input
                        type="text"
                        name="sparepart_pengganti"
                        id="sparepart_pengganti"
                        value="{{ old('sparepart_pengganti') }}"
                        placeholder="Contoh: Busi NGK Original (boleh dikosongkan)"
                        maxlength="255"
                    >

                    <small>
                        Isi sparepart yang diganti. Kosongkan apabila tidak ada.
                    </small>
                </div>

            </div>

            <div class="data-form-footer">
                <a
                    href="{{ route('data-service.index') }}"
                    class="data-cancel-btn"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="data-submit-btn"
                    {{ $daftarServices->isEmpty() ? 'disabled' : '' }}
                >
                    ✓ Simpan Data Service
                </button>
            </div>

        </form>

    </div>
</div>

<style>
    .data-form-page {
        color: #f4f0ff;
    }

    .data-form-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 25px;
    }

    .data-form-heading h1 {
        color: white;
        font-size: 24px;
        margin: 0 0 8px;
    }

    .data-form-heading p {
        color: #a9a1c2;
        font-size: 12px;
        margin: 0;
    }

    .data-back-btn {
        padding: 11px 17px;
        background: #30294c;
        color: #c9b8f6;
        border-radius: 9px;
        text-decoration: none;
        font-size: 12px;
    }

    .data-form-card {
        max-width: 900px;
        margin: auto;
        padding: 28px;
        background: #211d39;
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 17px;
    }

    .data-form-intro {
        display: flex;
        align-items: center;
        gap: 15px;
        padding-bottom: 23px;
        margin-bottom: 25px;
        border-bottom: 1px solid rgba(255,255,255,.08);
    }

    .data-form-icon {
        width: 50px;
        height: 50px;
        display: grid;
        place-items: center;
        border-radius: 13px;
        background: rgba(137,103,232,.16);
        font-size: 23px;
    }

    .data-form-intro h3 {
        font-size: 15px;
        margin: 0 0 6px;
    }

    .data-form-intro p {
        color: #a9a1c2;
        font-size: 11px;
        margin: 0;
    }

    .data-form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 22px;
    }

    .data-form-group.full {
        grid-column: 1 / -1;
    }

    .data-form-group label {
        display: block;
        margin-bottom: 9px;
        color: #ddd5f0;
        font-size: 12px;
        font-weight: 600;
    }

    .data-form-group label span {
        color: #ff829a;
    }

    .data-form-group input,
    .data-form-group select,
    .data-form-group textarea {
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
        transition: .2s;
    }

    .data-form-group input:focus,
    .data-form-group select:focus,
    .data-form-group textarea:focus {
        border-color: #9672ed;
        box-shadow: 0 0 0 3px rgba(137,103,232,.10);
    }

    .data-form-group select {
        cursor: pointer;
    }

    .data-form-group select option {
        background: #211d39;
        color: white;
    }

    .data-form-group input[readonly],
    .data-form-group textarea[readonly] {
        color: #c5afff;
        background: #26203f;
        cursor: not-allowed;
    }

    .data-form-group textarea {
        resize: vertical;
        min-height: 105px;
        line-height: 1.6;
    }

    .data-form-group small {
        display: block;
        color: #9388ab;
        font-size: 10px;
        margin-top: 8px;
    }

    .data-form-footer {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 27px;
        padding-top: 22px;
        border-top: 1px solid rgba(255,255,255,.08);
    }

    .data-cancel-btn,
    .data-submit-btn {
        padding: 12px 20px;
        border: none;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
    }

    .data-cancel-btn {
        color: #c9c2df;
        background: #302a4b;
    }

    .data-submit-btn {
        color: white;
        background: linear-gradient(135deg,#9672ed,#6846bd);
    }

    .data-submit-btn:hover:not(:disabled) {
        filter: brightness(1.12);
        transform: translateY(-1px);
    }

    .data-submit-btn:disabled {
        opacity: .45;
        cursor: not-allowed;
    }

    .data-error-box,
    .data-warning-box {
        padding: 15px 17px;
        border-radius: 10px;
        margin-bottom: 22px;
        font-size: 12px;
        line-height: 1.7;
    }

    .data-error-box {
        color: #ff9cab;
        background: rgba(239,84,112,.10);
        border: 1px solid rgba(239,84,112,.3);
    }

    .data-warning-box {
        color: #f1ce83;
        background: rgba(239,185,74,.09);
        border: 1px solid rgba(239,185,74,.3);
    }

    .data-warning-box p {
        margin: 5px 0 0;
    }

    .data-error-box ul {
        margin-bottom: 0;
        padding-left: 20px;
    }

    @media(max-width:650px) {
        .data-form-grid {
            grid-template-columns: 1fr;
        }

        .data-form-group.full {
            grid-column: auto;
        }

        .data-form-card {
            padding: 19px;
        }

        .data-form-footer {
            flex-wrap: wrap;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const serviceSelect = document.getElementById('daftar_service_id');
        const namaPelanggan = document.getElementById('nama_pelanggan_display');
        const noPlat = document.getElementById('no_plat_display');
        const keluhan = document.getElementById('keluhan_display');

        function tampilkanInformasiService() {
            const selectedOption =
                serviceSelect.options[serviceSelect.selectedIndex];

            if (selectedOption && selectedOption.value !== '') {
                namaPelanggan.value =
                    selectedOption.getAttribute('data-pelanggan') || '';

                noPlat.value =
                    selectedOption.getAttribute('data-plat') || '';

                keluhan.value =
                    selectedOption.getAttribute('data-keluhan') || '';
            } else {
                namaPelanggan.value = '';
                noPlat.value = '';
                keluhan.value = '';
            }
        }

        serviceSelect.addEventListener('change', tampilkanInformasiService);

        // Mengembalikan informasi otomatis jika validasi sebelumnya gagal.
        tampilkanInformasiService();
    });
</script>

@endsection
