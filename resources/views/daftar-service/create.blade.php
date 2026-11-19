
@extends('layouts.app')

@section('title', 'Tambah Daftar Service')
@section('page-title', 'Tambah Daftar Service')

@section('content')

<div class="service-form-page">

    <div class="service-form-heading">
        <div>
            <h1>Tambah Pendaftaran Service</h1>
            <p>Masukkan informasi pelanggan dan kendaraan yang akan diservice.</p>
        </div>

        <a href="{{ route('daftar-service.index') }}" class="service-back-btn">
            ← Kembali
        </a>
    </div>

    <div class="service-form-card">

        <div class="service-form-intro">
            <div class="service-form-icon">🔧</div>
            <div>
                <h3>Informasi Pendaftaran</h3>
                <p>Lengkapi seluruh informasi di bawah ini.</p>
            </div>
        </div>

        @if ($errors->any())
            <div class="service-error-box">
                <strong>Data belum berhasil disimpan.</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($pelanggans->isEmpty() || $kendaraans->isEmpty())
            <div class="service-warning-box">
                <strong>Data belum lengkap!</strong>
                <p>
                    @if ($pelanggans->isEmpty())
                        Belum ada data pelanggan. Tambahkan pelanggan terlebih dahulu.
                    @endif

                    @if ($pelanggans->isEmpty() && $kendaraans->isEmpty())
                        <br>
                    @endif

                    @if ($kendaraans->isEmpty())
                        Belum ada data kendaraan. Tambahkan kendaraan terlebih dahulu.
                    @endif
                </p>
            </div>
        @endif

        <form action="{{ route('daftar-service.store') }}" method="POST">
            @csrf

            <div class="service-form-grid">

                <div class="service-form-group">
                    <label for="kendaraan_id">
                        Nomor Plat Kendaraan <span>*</span>
                    </label>

                    <select name="kendaraan_id" id="kendaraan_id" required>
                        <option value="">-- Pilih Kendaraan --</option>

                        @foreach ($kendaraans as $kendaraan)
                            <option
                                value="{{ $kendaraan->id }}"
                                {{ old('kendaraan_id') == $kendaraan->id ? 'selected' : '' }}
                            >
                                {{ $kendaraan->no_plat }} -
                                {{ ucfirst($kendaraan->jenis_kendaraan) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="service-form-group">
                    <label for="pelanggan_id">
                        ID Pelanggan <span>*</span>
                    </label>

                    <select name="pelanggan_id" id="pelanggan_id" required>
                        <option value="">-- Pilih ID Pelanggan --</option>

                        @foreach ($pelanggans as $pelanggan)
                            <option
                                value="{{ $pelanggan->id }}"
                                data-nama="{{ $pelanggan->nama_lengkap }}"
                                {{ old('pelanggan_id') == $pelanggan->id ? 'selected' : '' }}
                            >
                                PLG{{ str_pad($pelanggan->id, 3, '0', STR_PAD_LEFT) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="service-form-group full">
                    <label for="nama_pelanggan_display">
                        Nama Pelanggan
                    </label>

                    <input
                        type="text"
                        id="nama_pelanggan_display"
                        placeholder="Nama pelanggan akan terisi otomatis"
                        readonly
                    >

                    <small>
                        Nama akan muncul otomatis setelah ID pelanggan dipilih.
                    </small>
                </div>

                <div class="service-form-group full">
                    <label for="keluhan">
                        Keluhan Kendaraan <span>*</span>
                    </label>

                    <textarea
                        name="keluhan"
                        id="keluhan"
                        rows="5"
                        maxlength="1000"
                        placeholder="Contoh: Mesin sulit dinyalakan, rem berbunyi, atau perlu ganti oli..."
                        required
                    >{{ old('keluhan') }}</textarea>
                </div>

                <div class="service-form-group full">
                    <label for="tanggal_service">
                        Tanggal Service <span>*</span>
                    </label>

                    <input
                        type="date"
                        name="tanggal_service"
                        id="tanggal_service"
                        value="{{ old('tanggal_service', date('Y-m-d')) }}"
                        required
                    >
                </div>

            </div>

            <div class="service-form-footer">
                <a href="{{ route('daftar-service.index') }}" class="service-cancel-btn">
                    Batal
                </a>

                <button
                    type="submit"
                    class="service-submit-btn"
                    {{ $pelanggans->isEmpty() || $kendaraans->isEmpty() ? 'disabled' : '' }}
                >
                    ✓ Simpan Pendaftaran
                </button>
            </div>

        </form>

    </div>

</div>

<style>
    .service-form-page {
        color: #f4f0ff;
    }

    .service-form-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
        margin-bottom: 25px;
    }

    .service-form-heading h1 {
        font-size: 24px;
        margin: 0 0 8px;
        color: #fff;
    }

    .service-form-heading p {
        color: #a9a1c2;
        font-size: 12px;
        margin: 0;
    }

    .service-back-btn {
        text-decoration: none;
        color: #c9b8f6;
        background: #30294c;
        padding: 11px 17px;
        border-radius: 9px;
        font-size: 12px;
    }

    .service-form-card {
        max-width: 900px;
        margin: auto;
        padding: 28px;
        background: #211d39;
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 17px;
    }

    .service-form-intro {
        display: flex;
        align-items: center;
        gap: 15px;
        padding-bottom: 23px;
        margin-bottom: 25px;
        border-bottom: 1px solid rgba(255,255,255,.08);
    }

    .service-form-icon {
        width: 50px;
        height: 50px;
        display: grid;
        place-items: center;
        border-radius: 13px;
        background: rgba(137,103,232,.16);
        font-size: 23px;
    }

    .service-form-intro h3 {
        font-size: 15px;
        margin: 0 0 6px;
    }

    .service-form-intro p {
        font-size: 11px;
        color: #a9a1c2;
        margin: 0;
    }

    .service-form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 22px;
    }

    .service-form-group.full {
        grid-column: 1 / -1;
    }

    .service-form-group label {
        display: block;
        margin-bottom: 9px;
        color: #ddd5f0;
        font-size: 12px;
        font-weight: 600;
    }

    .service-form-group label span {
        color: #ff829a;
    }

    .service-form-group input,
    .service-form-group select,
    .service-form-group textarea {
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

    .service-form-group select {
        cursor: pointer;
    }

    .service-form-group select option {
        background: #211d39;
        color: white;
    }

    .service-form-group input:focus,
    .service-form-group select:focus,
    .service-form-group textarea:focus {
        border-color: #9672ed;
        box-shadow: 0 0 0 3px rgba(137,103,232,.10);
    }

    .service-form-group input[readonly] {
        color: #c5afff;
        background: #26203f;
        cursor: not-allowed;
    }

    .service-form-group textarea {
        resize: vertical;
        min-height: 120px;
        line-height: 1.6;
    }

    .service-form-group small {
        display: block;
        color: #9388ab;
        font-size: 10px;
        margin-top: 8px;
    }

    .service-form-group input[type="date"]::-webkit-calendar-picker-indicator {
        cursor: pointer;
        filter: invert(1);
    }

    .service-form-footer {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 27px;
        padding-top: 22px;
        border-top: 1px solid rgba(255,255,255,.08);
    }

    .service-cancel-btn,
    .service-submit-btn {
        padding: 12px 20px;
        border: none;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
    }

    .service-cancel-btn {
        color: #c9c2df;
        background: #302a4b;
    }

    .service-submit-btn {
        color: white;
        background: linear-gradient(135deg,#9672ed,#6846bd);
    }

    .service-submit-btn:hover {
        filter: brightness(1.12);
        transform: translateY(-1px);
    }

    .service-submit-btn:disabled {
        opacity: .45;
        cursor: not-allowed;
        transform: none;
    }

    .service-error-box,
    .service-warning-box {
        padding: 15px 17px;
        border-radius: 10px;
        margin-bottom: 22px;
        font-size: 12px;
        line-height: 1.7;
    }

    .service-error-box {
        background: rgba(239,84,112,.10);
        border: 1px solid rgba(239,84,112,.3);
        color: #ff9cab;
    }

    .service-warning-box {
        background: rgba(239,185,74,.09);
        border: 1px solid rgba(239,185,74,.3);
        color: #f1ce83;
    }

    .service-warning-box p {
        margin: 5px 0 0;
    }

    .service-error-box ul {
        margin-bottom: 0;
        padding-left: 20px;
    }

    @media(max-width:650px) {
        .service-form-grid {
            grid-template-columns: 1fr;
        }

        .service-form-group.full {
            grid-column: auto;
        }

        .service-form-card {
            padding: 19px;
        }

        .service-form-footer {
            flex-wrap: wrap;
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

            if (selectedOption && selectedOption.value !== '') {
                namaPelanggan.value =
                    selectedOption.getAttribute('data-nama') || '';
            } else {
                namaPelanggan.value = '';
            }
        }

        pelangganSelect.addEventListener('change', tampilkanNamaPelanggan);

        // Mengisi kembali nama jika form sebelumnya gagal divalidasi
        tampilkanNamaPelanggan();
    });
</script>

@endsection
