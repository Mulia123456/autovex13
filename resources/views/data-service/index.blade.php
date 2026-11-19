
@extends('layouts.app')

@section('title', 'Data Service')
@section('page-title', 'Data Service')

@section('content')

<div class="data-service-page">

    <div class="data-service-heading">
        <div>
            <h1>Data Service</h1>
            <p>Kelola detail pengerjaan service kendaraan pelanggan.</p>
        </div>

        <a href="{{ route('data-service.create') }}" class="data-service-add">
            ＋ Tambah Data Service
        </a>
    </div>

    <div class="data-service-summary">
        <div class="data-service-icon">⚙️</div>
        <div>
            <span>Total Data Service</span>
            <h2>{{ $dataServices->count() }}</h2>
            <small>Detail pengerjaan service yang terdaftar</small>
        </div>
    </div>

    <div class="data-service-card">

        <div class="data-service-card-header">
            <div>
                <h3>Informasi Pengerjaan Service</h3>
                <p>Data keluhan, estimasi biaya, mekanik, dan sparepart.</p>
            </div>

            <div class="data-service-search">
                <span>⌕</span>
                <input
                    type="text"
                    id="searchDataService"
                    placeholder="Cari data service..."
                >
            </div>
        </div>

        <div class="data-service-table-wrapper">

            <table class="data-service-table" id="dataServiceTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Service</th>
                        <th>No Plat</th>
                        <th>Nama Pelanggan</th>
                        <th>Keluhan</th>
                        <th>Estimasi Service</th>
                        <th>Nama Mekanik</th>
                        <th>Sparepart Pengganti</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($dataServices as $dataService)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <span class="data-service-code">
                                    {{ $dataService->daftarService->kode_service ?? '-' }}
                                </span>
                            </td>

                            <td>
                                <span class="data-service-plate">
                                    {{ $dataService->daftarService->kendaraan->no_plat ?? '-' }}
                                </span>
                            </td>

                            <td class="data-service-name">
                                {{ $dataService->daftarService->pelanggan->nama_lengkap ?? '-' }}
                            </td>

                            <td class="data-service-complaint">
                                {{ $dataService->keluhan }}
                            </td>

                            <td class="data-service-price">
                                Rp {{ number_format($dataService->estimasi_service, 0, ',', '.') }}
                            </td>

                            <td>{{ $dataService->nama_mekanik }}</td>

                            <td>
                                {{ $dataService->sparepart_pengganti ?: 'Tidak ada' }}
                            </td>

                            <td>
                                <div class="data-service-actions">

                                    <a
                                        href="{{ route('data-service.edit', $dataService->id) }}"
                                        class="data-service-edit"
                                        title="Edit"
                                    >
                                        ✎
                                    </a>

                                    <form
                                        action="{{ route('data-service.destroy', $dataService->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data service ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="data-service-delete"
                                            title="Hapus"
                                        >
                                            🗑
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="data-service-empty">
                                <div>⚙️</div>
                                <strong>Belum Ada Data Service</strong>
                                <p>Silakan tambahkan detail pengerjaan service.</p>

                                <a href="{{ route('data-service.create') }}">
                                    Tambah Data Service
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</div>

<style>
    .data-service-page {
        color: #f4f0ff;
    }

    .data-service-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 25px;
    }

    .data-service-heading h1 {
        color: white;
        font-size: 25px;
        margin: 0 0 8px;
    }

    .data-service-heading p {
        color: #a9a1c2;
        font-size: 12px;
        margin: 0;
    }

    .data-service-add {
        display: inline-block;
        padding: 12px 19px;
        color: white;
        background: linear-gradient(135deg, #9672ed, #6846bd);
        border-radius: 10px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
        transition: .2s;
    }

    .data-service-add:hover {
        transform: translateY(-2px);
        filter: brightness(1.1);
    }

    .data-service-summary {
        display: flex;
        align-items: center;
        gap: 17px;
        padding: 22px;
        margin-bottom: 24px;
        background: linear-gradient(120deg, #302650, #211d39);
        border: 1px solid rgba(182,154,255,.14);
        border-radius: 16px;
    }

    .data-service-icon {
        width: 55px;
        height: 55px;
        display: grid;
        place-items: center;
        background: rgba(182,154,255,.13);
        border-radius: 14px;
        font-size: 24px;
    }

    .data-service-summary span {
        color: #b9afd3;
        font-size: 12px;
    }

    .data-service-summary h2 {
        margin: 5px 0;
        color: white;
        font-size: 27px;
    }

    .data-service-summary small {
        color: #9489ae;
        font-size: 11px;
    }

    .data-service-card {
        background: #211d39;
        border: 1px solid rgba(255,255,255,.07);
        border-radius: 16px;
        overflow: hidden;
    }

    .data-service-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 15px;
        padding: 22px;
        border-bottom: 1px solid rgba(255,255,255,.07);
    }

    .data-service-card-header h3 {
        margin: 0 0 6px;
        font-size: 15px;
    }

    .data-service-card-header p {
        margin: 0;
        color: #9990b2;
        font-size: 11px;
    }

    .data-service-search {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 0 12px;
        background: #19162d;
        border: 1px solid rgba(182,154,255,.17);
        border-radius: 9px;
        color: #a78be9;
    }

    .data-service-search input {
        width: 190px;
        padding: 11px 0;
        background: transparent;
        border: none;
        outline: none;
        color: white;
        font-size: 11px;
    }

    .data-service-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .data-service-table {
        width: 100%;
        min-width: 1150px;
        border-collapse: collapse;
    }

    .data-service-table th {
        padding: 15px 13px;
        text-align: left;
        white-space: nowrap;
        background: #292344;
        color: #c6b9ec;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: .4px;
    }

    .data-service-table td {
        padding: 16px 13px;
        border-bottom: 1px solid rgba(255,255,255,.055);
        color: #ded8ed;
        font-size: 11px;
        vertical-align: middle;
    }

    .data-service-table tbody tr:hover {
        background: rgba(182,154,255,.055);
    }

    .data-service-code {
        padding: 6px 9px;
        color: #c0a8ff;
        background: rgba(137,103,232,.13);
        border-radius: 6px;
        font-weight: 700;
    }

    .data-service-plate {
        padding: 6px 9px;
        color: white;
        background: #34304a;
        border-radius: 6px;
        font-weight: 600;
    }

    .data-service-name {
        color: white !important;
        font-weight: 600;
    }

    .data-service-complaint {
        max-width: 210px;
        line-height: 1.6;
    }

    .data-service-price {
        color: #c0a8ff !important;
        white-space: nowrap;
        font-weight: 700;
    }

    .data-service-actions {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .data-service-actions form {
        margin: 0;
    }

    .data-service-edit,
    .data-service-delete {
        width: 32px;
        height: 32px;
        display: grid;
        place-items: center;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        text-decoration: none;
        font-size: 13px;
    }

    .data-service-edit {
        color: #c0a8ff;
        background: rgba(137,103,232,.16);
    }

    .data-service-delete {
        color: #ff8093;
        background: rgba(239,84,112,.12);
    }

    .data-service-empty {
        padding: 55px 20px !important;
        text-align: center !important;
    }

    .data-service-empty div {
        margin-bottom: 12px;
        font-size: 35px;
    }

    .data-service-empty strong {
        display: block;
        color: white;
        font-size: 14px;
    }

    .data-service-empty p {
        color: #9990b2;
        font-size: 11px;
    }

    .data-service-empty a {
        color: #b99aff;
        text-decoration: none;
        font-size: 11px;
        font-weight: 700;
    }

    @media(max-width:700px) {
        .data-service-heading h1 {
            font-size: 21px;
        }

        .data-service-card-header {
            align-items: stretch;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const search = document.getElementById('searchDataService');
        const rows = document.querySelectorAll('#dataServiceTable tbody tr');

        if (search) {
            search.addEventListener('input', function () {
                const keyword = this.value.toLowerCase();

                rows.forEach(function (row) {
                    row.style.display = row.innerText
                        .toLowerCase()
                        .includes(keyword) ? '' : 'none';
                });
            });
        }
    });
</script>

@endsection
