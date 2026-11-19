
@extends('layouts.app')

@section('title', 'Edit Data Service')
@section('page-title', 'Edit Data Service')

@section('content')

<div class="data-edit-page">

    <div class="data-edit-heading">
        <div>
            <h1>Edit Data Service</h1>
            <p>Perbarui informasi pengerjaan service kendaraan.</p>
        </div>

        <a href="{{ route('data-service.index') }}" class="data-edit-back">
            ← Kembali
        </a>
    </div>

    <div class="data-edit-card">

        <div class="data-edit-intro">
            <div class="data-edit-icon">⚙️</div>
            <div>
                <h3>Perbarui Informasi Pengerjaan</h3>
                <p>
                    ID Data Service:
                    <strong>{{ $dataService->id }}</strong>
                </p>
            </div>
        </div>

        @if ($errors->any())
            <div class="data-edit-error">
                <strong>Periksa kembali data berikut:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('data-service.update', $dataService->id) }}"
            method="POST"
        >
            @csrf
            @method('PUT')

            <div class="data-edit-grid">

                <div class="data-edit-group full">
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
                                {{ old('daftar_service_id', $dataService->daftar_service_id) == $service->id ? 'selected' : '' }}
                            >
                                {{ $service->kode_service }}
                                - {{ $service->pelanggan->nama_lengkap ?? 'Pelanggan' }}
                                - {{ $service->kendaraan->no_plat ?? 'Kendaraan' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="data-edit-group">
                    <label for="nama_pelanggan_display">Nama Pelanggan</label>

                    <input
                        type="text"
                        id="nama_pelanggan_display"
                        readonly
                        placeholder="Terisi otomatis"
                    >
                </div>

                <div class="data-edit-group">
                    <label for="no_plat_display">Nomor Plat Kendaraan</label>

                    <input
                        type="text"
                        id="no_plat_display"
                        readonly
                        placeholder="Terisi otomatis"
                    >
                </div>

                <div class="data-edit-group full">
                    <label for="keluhan_display">Keluhan Kendaraan</label>

                    <textarea
                        id="keluhan_display"
                        rows="4"
                        readonly
                        placeholder="Keluhan terisi otomatis"
                    ></textarea>

                    <small>
                        Keluhan mengikuti ID Service yang dipilih.
                    </small>
                </div>

                <div class="data-edit-group">
                    <label for="estimasi_service">
                        Estimasi Service (Rp) <span>*</span>
                    </label>

                    <input
                        type="number"
                        name="estimasi_service"
                        id="estimasi_service"
                        value="{{ old('estimasi_service', $dataService->estimasi_service) }}"
                        min="0"
                        step="1000"
                        required
                    >
                </div>

                <div class="data-edit-group">
                    <label for="nama_mekanik">
                        Nama Mekanik <span>*</span>
                    </label>

                    <input
                        type="text"
                        name="nama_mekanik"
                        id="nama_mekanik"
                        value="{{ old('nama_mekanik', $dataService->nama_mekanik) }}"
                        maxlength="255"
                        required
                    >
                </div>

                <div class="data-edit-group full">
                    <label for="sparepart_pengganti">
                        Sparepart Pengganti
                    </label>

                    <input
                        type="text"
                        name="sparepart_pengganti"
                        id="sparepart_pengganti"
                        value="{{ old('sparepart_pengganti', $dataService->sparepart_pengganti) }}"
                        maxlength="255"
                        placeholder="Contoh: Busi NGK Original"
                    >

                    <small>
                        Kosongkan jika tidak ada penggantian sparepart.
                    </small>
                </div>

            </div>

            <div class="data-edit-footer">
                <a
                    href="{{ route('data-service.index') }}"
                    class="data-edit-cancel"
                >
                    Batal
                </a>

                <button type="submit" class="data-edit-submit">
                    ✓ Simpan Perubahan
                </button>
            </div>

        </form>

    </div>

</div>

<style>
    .data-edit-page {
        color: #f4f0ff;
    }

    .data-edit-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 25px;
    }

    .data-edit-heading h1 {
        color: white;
        font-size: 24px;
        margin: 0 0 8px;
    }

    .data-edit-heading p {
        color: #a9a1c2;
        font-size: 12px;
        margin: 0;
    }

    .data-edit-back {
        padding: 11px 17px;
        background: #30294c;
        color: #c9b8f6;
        border-radius: 9px;
        text-decoration: none;
        font-size: 12px;
    }

    .data-edit-card {
        max-width: 900px;
        margin: auto;
        padding: 28px;
        background: #211d39;
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 17px;
    }

    .data-edit-intro {
        display: flex;
        align-items: center;
        gap: 15px;
        padding-bottom: 23px;
        margin-bottom: 25px;
        border-bottom: 1px solid rgba(255,255,255,.08);
    }

    .data-edit-icon {
        width: 50px;
        height: 50px;
        display: grid;
        place-items: center;
        border-radius: 13px;
        background: rgba(137,103,232,.16);
        font-size: 23px;
    }

    .data-edit-intro h3 {
        font-size: 15px;
        margin: 0 0 6px;
    }

    .data-edit-intro p {
        color: #a9a1c2;
        font-size: 11px;
        margin: 0;
    }

    .data-edit-intro strong {
        color: #c0a8ff;
    }

    .data-edit-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 22px;
    }

    .data-edit-group.full {
        grid-column: 1 / -1;
    }

    .data-edit-group label {
        display: block;
        margin-bottom: 9px;
        color: #ddd5f0;
        font-size: 12px;
        font-weight: 600;
    }

    .data-edit-group label span {
        color: #ff829a;
    }

    .data-edit-group input,
    .data-edit-group select,
    .data-edit-group textarea {
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

    .data-edit-group input:focus,
    .data-edit-group select:focus,
    .data-edit-group textarea:focus {
        border-color: #9672ed;
        box-shadow: 0 0 0 3px rgba(137,103,232,.10);
    }

    .data-edit-group select option {
        color: white;
        background: #211d39;
    }

    .data-edit-group input[readonly],
    .data-edit-group textarea[readonly] {
        color: #c5afff;
        background: #26203f;
        cursor: not-allowed;
    }

    .data-edit-group textarea {
        resize: vertical;
        min-height: 105px;
        line-height: 1.6;
    }

    .data-edit-group small {
        display: block;
        color: #9388ab;
        font-size: 10px;
        margin-top: 8px;
    }

    .data-edit-footer {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 27px;
        padding-top: 22px;
        border-top: 1px solid rgba(255,255,255,.08);
    }

    .data-edit-cancel,
    .data-edit-submit {
        padding: 12px 20px;
        border: none;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
    }

    .data-edit-cancel {
        color: #c9c2df;
        background: #302a4b;
    }

    .data-edit-submit {
        color: white;
        background: linear-gradient(135deg,#9672ed,#6846bd);
    }

    .data-edit-submit:hover {
        filter: brightness(1.12);
        transform: translateY(-1px);
    }

    .data-edit-error {
        padding: 15px;
        margin-bottom: 22px;
        color: #ff9cab;
        background: rgba(239,84,112,.10);
        border: 1px solid rgba(239,84,112,.3);
        border-radius: 10px;
        font-size: 12px;
    }

    @media(max-width:650px) {
        .data-edit-grid {
            grid-template-columns: 1fr;
        }

        .data-edit-group.full {
            grid-column: auto;
        }

        .data-edit-card {
            padding: 19px;
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

        // Menampilkan informasi saat halaman edit pertama kali dibuka.
        tampilkanInformasiService();
    });
</script>

@endsection
