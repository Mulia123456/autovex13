
@extends('layouts.app')

@section('title', 'Tambah Pembayaran')
@section('page-title', 'Tambah Pembayaran')

@section('content')

<div class="payment-form-page">

    <div class="payment-form-heading">
        <div>
            <h1>Tambah Pembayaran Service</h1>
            <p>Catat transaksi pembayaran service pelanggan AUTOVEX.</p>
        </div>

        <a href="{{ route('pembayaran-service.index') }}" class="payment-back">
            ← Kembali
        </a>
    </div>

    <div class="payment-form-card">

        <div class="payment-form-intro">
            <div class="payment-form-icon">💳</div>
            <div>
                <h3>Informasi Pembayaran</h3>
                <p>Lengkapi informasi transaksi pembayaran service.</p>
            </div>
        </div>

        @if ($errors->any())
            <div class="payment-error">
                <strong>Data belum berhasil disimpan:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($daftarServices->isEmpty())
            <div class="payment-warning">
                <strong>Belum ada ID Service yang tersedia!</strong>
                <p>
                    Pastikan Daftar Service sudah memiliki Data Service
                    dan belum memiliki transaksi pembayaran.
                </p>
            </div>
        @endif

        <form action="{{ route('pembayaran-service.store') }}" method="POST">
            @csrf

            <div class="payment-form-grid">

                <div class="payment-form-group full">
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
                                data-pelanggan="{{ $service->pelanggan->nama_lengkap ?? '-' }}"
                                data-plat="{{ $service->kendaraan->no_plat ?? '-' }}"
                                data-estimasi="{{ $service->dataService->estimasi_service ?? 0 }}"
                                {{ old('daftar_service_id') == $service->id ? 'selected' : '' }}
                            >
                                {{ $service->kode_service }}
                                - {{ $service->pelanggan->nama_lengkap ?? 'Pelanggan' }}
                                - {{ $service->kendaraan->no_plat ?? 'Kendaraan' }}
                            </option>
                        @endforeach
                    </select>

                    <small>
                        Pilih ID Service yang sudah memiliki Data Service.
                    </small>
                </div>

                <div class="payment-form-group">
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

                <div class="payment-form-group">
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

                <div class="payment-form-group full">
                    <label for="jumlah_biaya">
                        Jumlah Biaya (Rp) <span>*</span>
                    </label>

                    <input
                        type="number"
                        name="jumlah_biaya"
                        id="jumlah_biaya"
                        value="{{ old('jumlah_biaya') }}"
                        min="0"
                        step="1"
                        placeholder="Contoh: 300000"
                        required
                    >

                    <small>
                        Jumlah biaya akan mengikuti estimasi service secara otomatis.
                        Kamu tetap bisa mengubahnya sesuai biaya sebenarnya.
                    </small>
                </div>

                <div class="payment-form-group full">
                    <label>
                        Jenis Pembayaran <span>*</span>
                    </label>

                    <div class="payment-radio-group">

                        <label class="payment-radio-card">
                            <input
                                type="radio"
                                name="jenis_pembayaran"
                                value="cash"
                                {{ old('jenis_pembayaran') == 'cash' ? 'checked' : '' }}
                                required
                            >

                            <span class="payment-radio-icon">💵</span>

                            <span>
                                <strong>Cash / Tunai</strong>
                                <small>Pembayaran secara langsung.</small>
                            </span>
                        </label>

                        <label class="payment-radio-card">
                            <input
                                type="radio"
                                name="jenis_pembayaran"
                                value="non_tunai"
                                {{ old('jenis_pembayaran') == 'non_tunai' ? 'checked' : '' }}
                            >

                            <span class="payment-radio-icon">💳</span>

                            <span>
                                <strong>Non Tunai</strong>
                                <small>Transfer, QRIS, atau metode digital.</small>
                            </span>
                        </label>

                    </div>
                </div>

                <div class="payment-form-group full">
                    <label for="keterangan">
                        Keterangan Pembayaran
                    </label>

                    <textarea
                        name="keterangan"
                        id="keterangan"
                        rows="4"
                        maxlength="1000"
                        placeholder="Contoh: Pembayaran melalui transfer bank..."
                    >{{ old('keterangan') }}</textarea>

                    <small>
                        Isi catatan tambahan pembayaran jika diperlukan.
                    </small>
                </div>

            </div>

            <div class="payment-form-footer">
                <a
                    href="{{ route('pembayaran-service.index') }}"
                    class="payment-cancel"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="payment-submit"
                    {{ $daftarServices->isEmpty() ? 'disabled' : '' }}
                >
                    ✓ Simpan Pembayaran
                </button>
            </div>

        </form>

    </div>
</div>

<style>
    .payment-form-page {
        color: #f4f0ff;
    }

    .payment-form-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 25px;
    }

    .payment-form-heading h1 {
        color: white;
        font-size: 24px;
        margin: 0 0 8px;
    }

    .payment-form-heading p {
        color: #a9a1c2;
        font-size: 12px;
        margin: 0;
    }

    .payment-back {
        padding: 11px 17px;
        color: #c9b8f6;
        background: #30294c;
        border-radius: 9px;
        text-decoration: none;
        font-size: 12px;
    }

    .payment-form-card {
        max-width: 900px;
        margin: auto;
        padding: 28px;
        background: #211d39;
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 17px;
    }

    .payment-form-intro {
        display: flex;
        align-items: center;
        gap: 15px;
        padding-bottom: 23px;
        margin-bottom: 25px;
        border-bottom: 1px solid rgba(255,255,255,.08);
    }

    .payment-form-icon {
        width: 50px;
        height: 50px;
        display: grid;
        place-items: center;
        border-radius: 13px;
        background: rgba(137,103,232,.16);
        font-size: 23px;
    }

    .payment-form-intro h3 {
        font-size: 15px;
        margin: 0 0 6px;
    }

    .payment-form-intro p {
        color: #a9a1c2;
        font-size: 11px;
        margin: 0;
    }

    .payment-form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 22px;
    }

    .payment-form-group.full {
        grid-column: 1 / -1;
    }

    .payment-form-group > label {
        display: block;
        margin-bottom: 9px;
        color: #ddd5f0;
        font-size: 12px;
        font-weight: 600;
    }

    .payment-form-group > label span {
        color: #ff829a;
    }

    .payment-form-group input:not([type="radio"]),
    .payment-form-group select,
    .payment-form-group textarea {
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

    .payment-form-group input:focus,
    .payment-form-group select:focus,
    .payment-form-group textarea:focus {
        border-color: #9672ed;
        box-shadow: 0 0 0 3px rgba(137,103,232,.10);
    }

    .payment-form-group select {
        cursor: pointer;
    }

    .payment-form-group select option {
        color: white;
        background: #211d39;
    }

    .payment-form-group input[readonly] {
        color: #c5afff;
        background: #26203f;
        cursor: not-allowed;
    }

    .payment-form-group textarea {
        resize: vertical;
        min-height: 100px;
        line-height: 1.6;
    }

    .payment-form-group small {
        display: block;
        color: #9388ab;
        font-size: 10px;
        margin-top: 8px;
    }

    .payment-radio-group {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    .payment-radio-card {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 17px;
        background: #19162d;
        border: 1px solid rgba(182,154,255,.19);
        border-radius: 11px;
        cursor: pointer;
        transition: .2s;
    }

    .payment-radio-card:has(input:checked) {
        background: rgba(137,103,232,.13);
        border-color: #9672ed;
    }

    .payment-radio-card input {
        accent-color: #9672ed;
    }

    .payment-radio-icon {
        font-size: 23px;
    }

    .payment-radio-card strong,
    .payment-radio-card small {
        display: block;
    }

    .payment-radio-card strong {
        color: white;
        font-size: 12px;
        margin-bottom: 5px;
    }

    .payment-radio-card small {
        color: #a9a1c2;
        font-size: 10px;
        margin: 0;
    }

    .payment-form-footer {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 27px;
        padding-top: 22px;
        border-top: 1px solid rgba(255,255,255,.08);
    }

    .payment-cancel,
    .payment-submit {
        padding: 12px 20px;
        border: none;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
    }

    .payment-cancel {
        color: #c9c2df;
        background: #302a4b;
    }

    .payment-submit {
        color: white;
        background: linear-gradient(135deg,#9672ed,#6846bd);
    }

    .payment-submit:hover:not(:disabled) {
        filter: brightness(1.12);
        transform: translateY(-1px);
    }

    .payment-submit:disabled {
        opacity: .45;
        cursor: not-allowed;
    }

    .payment-error,
    .payment-warning {
        padding: 15px 17px;
        margin-bottom: 22px;
        border-radius: 10px;
        font-size: 12px;
        line-height: 1.7;
    }

    .payment-error {
        color: #ff9cab;
        background: rgba(239,84,112,.10);
        border: 1px solid rgba(239,84,112,.3);
    }

    .payment-warning {
        color: #f1ce83;
        background: rgba(239,185,74,.09);
        border: 1px solid rgba(239,185,74,.3);
    }

    .payment-warning p {
        margin: 5px 0 0;
    }

    .payment-error ul {
        margin-bottom: 0;
        padding-left: 20px;
    }

    @media(max-width:650px) {
        .payment-form-grid,
        .payment-radio-group {
            grid-template-columns: 1fr;
        }

        .payment-form-group.full {
            grid-column: auto;
        }

        .payment-form-card {
            padding: 19px;
        }

        .payment-form-footer {
            flex-wrap: wrap;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const serviceSelect = document.getElementById('daftar_service_id');
        const namaPelanggan = document.getElementById('nama_pelanggan_display');
        const noPlat = document.getElementById('no_plat_display');
        const jumlahBiaya = document.getElementById('jumlah_biaya');

        function tampilkanInformasiService(isiBiayaOtomatis = false) {
            const selectedOption =
                serviceSelect.options[serviceSelect.selectedIndex];

            if (selectedOption && selectedOption.value !== '') {
                namaPelanggan.value =
                    selectedOption.getAttribute('data-pelanggan') || '';

                noPlat.value =
                    selectedOption.getAttribute('data-plat') || '';

                if (isiBiayaOtomatis) {
                    jumlahBiaya.value =
                        selectedOption.getAttribute('data-estimasi') || '';
                }
            } else {
                namaPelanggan.value = '';
                noPlat.value = '';

                if (isiBiayaOtomatis) {
                    jumlahBiaya.value = '';
                }
            }
        }

        serviceSelect.addEventListener('change', function () {
            tampilkanInformasiService(true);
        });

        // Menampilkan informasi pelanggan dan kendaraan saat halaman dibuka.
        // Nilai jumlah biaya lama tetap dipertahankan jika validasi gagal.
        tampilkanInformasiService(false);
    });
</script>

@endsection
