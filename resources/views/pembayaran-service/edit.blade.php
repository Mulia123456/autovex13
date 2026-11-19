
@extends('layouts.app')

@section('title', 'Edit Pembayaran')
@section('page-title', 'Edit Pembayaran')

@section('content')

<div class="payment-edit-page">

    <div class="payment-edit-heading">
        <div>
            <h1>Edit Pembayaran Service</h1>
            <p>Perbarui informasi transaksi pembayaran pelanggan.</p>
        </div>

        <a href="{{ route('pembayaran-service.index') }}" class="payment-edit-back">
            ← Kembali
        </a>
    </div>

    <div class="payment-edit-card">

        <div class="payment-edit-intro">
            <div class="payment-edit-icon">💳</div>
            <div>
                <h3>Perbarui Informasi Pembayaran</h3>
                <p>
                    ID Pembayaran:
                    <strong>{{ $pembayaranService->id }}</strong>
                </p>
            </div>
        </div>

        @if ($errors->any())
            <div class="payment-edit-error">
                <strong>Periksa kembali data berikut:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('pembayaran-service.update', $pembayaranService->id) }}"
            method="POST"
        >
            @csrf
            @method('PUT')

            <div class="payment-edit-grid">

                <div class="payment-edit-group full">
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
                                {{ old('daftar_service_id', $pembayaranService->daftar_service_id) == $service->id ? 'selected' : '' }}
                            >
                                {{ $service->kode_service }}
                                - {{ $service->pelanggan->nama_lengkap ?? 'Pelanggan' }}
                                - {{ $service->kendaraan->no_plat ?? 'Kendaraan' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="payment-edit-group">
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

                <div class="payment-edit-group">
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

                <div class="payment-edit-group full">
                    <label for="jumlah_biaya">
                        Jumlah Biaya (Rp) <span>*</span>
                    </label>

                    <input
                        type="number"
                        name="jumlah_biaya"
                        id="jumlah_biaya"
                        value="{{ old('jumlah_biaya', $pembayaranService->jumlah_biaya) }}"
                        min="0"
                        step="1"
                        required
                    >
                </div>

                <div class="payment-edit-group full">
                    <label>
                        Jenis Pembayaran <span>*</span>
                    </label>

                    <div class="payment-edit-radio">

                        <label class="payment-edit-radio-card">
                            <input
                                type="radio"
                                name="jenis_pembayaran"
                                value="cash"
                                {{ old('jenis_pembayaran', $pembayaranService->jenis_pembayaran) == 'cash' ? 'checked' : '' }}
                                required
                            >

                            <span class="payment-edit-radio-icon">💵</span>

                            <span>
                                <strong>Cash / Tunai</strong>
                                <small>Pembayaran secara langsung.</small>
                            </span>
                        </label>

                        <label class="payment-edit-radio-card">
                            <input
                                type="radio"
                                name="jenis_pembayaran"
                                value="non_tunai"
                                {{ old('jenis_pembayaran', $pembayaranService->jenis_pembayaran) == 'non_tunai' ? 'checked' : '' }}
                            >

                            <span class="payment-edit-radio-icon">💳</span>

                            <span>
                                <strong>Non Tunai</strong>
                                <small>Transfer, QRIS, atau metode digital.</small>
                            </span>
                        </label>

                    </div>
                </div>

                <div class="payment-edit-group full">
                    <label for="keterangan">
                        Keterangan Pembayaran
                    </label>

                    <textarea
                        name="keterangan"
                        id="keterangan"
                        rows="4"
                        maxlength="1000"
                        placeholder="Masukkan keterangan pembayaran..."
                    >{{ old('keterangan', $pembayaranService->keterangan) }}</textarea>
                </div>

            </div>

            <div class="payment-edit-footer">
                <a
                    href="{{ route('pembayaran-service.index') }}"
                    class="payment-edit-cancel"
                >
                    Batal
                </a>

                <button type="submit" class="payment-edit-submit">
                    ✓ Simpan Perubahan
                </button>
            </div>

        </form>

    </div>

</div>

<style>
    .payment-edit-page {
        color: #f4f0ff;
    }

    .payment-edit-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 25px;
    }

    .payment-edit-heading h1 {
        color: white;
        font-size: 24px;
        margin: 0 0 8px;
    }

    .payment-edit-heading p {
        color: #a9a1c2;
        font-size: 12px;
        margin: 0;
    }

    .payment-edit-back {
        padding: 11px 17px;
        background: #30294c;
        color: #c9b8f6;
        border-radius: 9px;
        text-decoration: none;
        font-size: 12px;
    }

    .payment-edit-card {
        max-width: 900px;
        margin: auto;
        padding: 28px;
        background: #211d39;
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 17px;
    }

    .payment-edit-intro {
        display: flex;
        align-items: center;
        gap: 15px;
        padding-bottom: 23px;
        margin-bottom: 25px;
        border-bottom: 1px solid rgba(255,255,255,.08);
    }

    .payment-edit-icon {
        width: 50px;
        height: 50px;
        display: grid;
        place-items: center;
        border-radius: 13px;
        background: rgba(137,103,232,.16);
        font-size: 23px;
    }

    .payment-edit-intro h3 {
        font-size: 15px;
        margin: 0 0 6px;
    }

    .payment-edit-intro p {
        color: #a9a1c2;
        font-size: 11px;
        margin: 0;
    }

    .payment-edit-intro strong {
        color: #c0a8ff;
    }

    .payment-edit-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 22px;
    }

    .payment-edit-group.full {
        grid-column: 1 / -1;
    }

    .payment-edit-group > label {
        display: block;
        margin-bottom: 9px;
        color: #ddd5f0;
        font-size: 12px;
        font-weight: 600;
    }

    .payment-edit-group > label span {
        color: #ff829a;
    }

    .payment-edit-group input:not([type="radio"]),
    .payment-edit-group select,
    .payment-edit-group textarea {
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

    .payment-edit-group input:focus,
    .payment-edit-group select:focus,
    .payment-edit-group textarea:focus {
        border-color: #9672ed;
        box-shadow: 0 0 0 3px rgba(137,103,232,.10);
    }

    .payment-edit-group input[readonly] {
        color: #c5afff;
        background: #26203f;
        cursor: not-allowed;
    }

    .payment-edit-group select option {
        color: white;
        background: #211d39;
    }

    .payment-edit-group textarea {
        resize: vertical;
        min-height: 100px;
        line-height: 1.6;
    }

    .payment-edit-radio {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    .payment-edit-radio-card {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 17px;
        background: #19162d;
        border: 1px solid rgba(182,154,255,.19);
        border-radius: 11px;
        cursor: pointer;
    }

    .payment-edit-radio-card:has(input:checked) {
        background: rgba(137,103,232,.13);
        border-color: #9672ed;
    }

    .payment-edit-radio-card input {
        accent-color: #9672ed;
    }

    .payment-edit-radio-icon {
        font-size: 23px;
    }

    .payment-edit-radio-card strong,
    .payment-edit-radio-card small {
        display: block;
    }

    .payment-edit-radio-card strong {
        color: white;
        font-size: 12px;
        margin-bottom: 5px;
    }

    .payment-edit-radio-card small {
        color: #a9a1c2;
        font-size: 10px;
    }

    .payment-edit-footer {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 27px;
        padding-top: 22px;
        border-top: 1px solid rgba(255,255,255,.08);
    }

    .payment-edit-cancel,
    .payment-edit-submit {
        padding: 12px 20px;
        border: none;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
    }

    .payment-edit-cancel {
        color: #c9c2df;
        background: #302a4b;
    }

    .payment-edit-submit {
        color: white;
        background: linear-gradient(135deg,#9672ed,#6846bd);
    }

    .payment-edit-submit:hover {
        filter: brightness(1.12);
        transform: translateY(-1px);
    }

    .payment-edit-error {
        padding: 15px;
        margin-bottom: 22px;
        color: #ff9cab;
        background: rgba(239,84,112,.10);
        border: 1px solid rgba(239,84,112,.3);
        border-radius: 10px;
        font-size: 12px;
    }

    @media(max-width:650px) {
        .payment-edit-grid,
        .payment-edit-radio {
            grid-template-columns: 1fr;
        }

        .payment-edit-group.full {
            grid-column: auto;
        }

        .payment-edit-card {
            padding: 19px;
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

        // Biaya pembayaran yang sudah tersimpan tetap dipertahankan.
        tampilkanInformasiService(false);
    });
</script>

@endsection
