
@extends('layouts.app')

@section('title', 'Daftar Service')
@section('page-title', 'Daftar Service')

@section('content')

<div class="service-page">

    <div class="service-heading">
        <div>
            <h1>Daftar Service</h1>
            <p>Kelola pendaftaran dan keluhan service kendaraan pelanggan.</p>
        </div>

        <a href="{{ route('daftar-service.create') }}" class="service-add-btn">
            <span>＋</span> Tambah Service
        </a>
    </div>

    <div class="service-summary">
        <div class="service-summary-icon">🔧</div>
        <div>
            <span>Total Pendaftaran Service</span>
            <h2>{{ $daftarServices->count() }}</h2>
            <small>Seluruh data service yang terdaftar</small>
        </div>
    </div>

    <div class="service-table-card">

        <div class="service-table-header">
            <div>
                <h3>Data Pendaftaran Service</h3>
                <p>Informasi pelanggan, kendaraan, dan keluhan.</p>
            </div>

            <div class="service-search">
                <span>⌕</span>
                <input
                    type="text"
                    id="searchService"
                    placeholder="Cari data service..."
                >
            </div>
        </div>

        <div class="service-table-wrapper">
            <table class="service-table" id="serviceTable">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Service</th>
                        <th>No Plat</th>
                        <th>ID Pelanggan</th>
                        <th>Nama Pelanggan</th>
                        <th>Keluhan Kendaraan</th>
                        <th>Tanggal Service</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($daftarServices as $service)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <span class="service-code">
                                    {{ $service->kode_service }}
                                </span>
                            </td>

                            <td>
                                <span class="service-plate">
                                    {{ $service->kendaraan->no_plat ?? '-' }}
                                </span>
                            </td>

                            <td>
                                PLG{{ str_pad($service->pelanggan_id, 3, '0', STR_PAD_LEFT) }}
                            </td>

                            <td class="service-name">
                                {{ $service->pelanggan->nama_lengkap ?? '-' }}
                            </td>

                            <td class="service-complaint">
                                {{ $service->keluhan }}
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($service->tanggal_service)->format('d M Y') }}
                            </td>

                            <td>
                                <div class="service-actions">

                                    <a
                                        href="{{ route('daftar-service.edit', $service->id) }}"
                                        class="service-edit-btn"
                                        title="Edit"
                                    >
                                        ✎
                                    </a>

                                    <form
                                        action="{{ route('daftar-service.destroy', $service->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data service ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="service-delete-btn"
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
                            <td colspan="8" class="service-empty">
                                <div class="service-empty-icon">📋</div>
                                <strong>Belum Ada Data Service</strong>
                                <p>Silakan tambahkan pendaftaran service pertama.</p>

                                <a href="{{ route('daftar-service.create') }}">
                                    Tambah Service Sekarang
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
    .service-page {
        color: #f4f0ff;
    }

    .service-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        flex-wrap: wrap;
        margin-bottom: 25px;
    }

    .service-heading h1 {
        font-size: 25px;
        margin: 0 0 8px;
        color: #fff;
    }

    .service-heading p {
        font-size: 13px;
        color: #a9a1c2;
        margin: 0;
    }

    .service-add-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, #9672ed, #6846bd);
        color: white;
        padding: 12px 19px;
        border-radius: 10px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
        box-shadow: 0 5px 18px rgba(118,85,201,.22);
        transition: .25s;
    }

    .service-add-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 22px rgba(118,85,201,.35);
    }

    .service-add-btn span {
        font-size: 18px;
    }

    .service-summary {
        display: flex;
        align-items: center;
        gap: 17px;
        padding: 22px;
        margin-bottom: 24px;
        background: linear-gradient(120deg, #302650, #211d39);
        border: 1px solid rgba(182,154,255,.14);
        border-radius: 16px;
    }

    .service-summary-icon {
        width: 55px;
        height: 55px;
        display: grid;
        place-items: center;
        background: rgba(182,154,255,.13);
        border: 1px solid rgba(182,154,255,.18);
        border-radius: 14px;
        font-size: 24px;
    }

    .service-summary span {
        font-size: 12px;
        color: #b9afd3;
    }

    .service-summary h2 {
        margin: 5px 0;
        font-size: 27px;
        color: #fff;
    }

    .service-summary small {
        color: #9489ae;
        font-size: 11px;
    }

    .service-table-card {
        background: #211d39;
        border: 1px solid rgba(255,255,255,.07);
        border-radius: 16px;
        overflow: hidden;
    }

    .service-table-header {
        padding: 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 15px;
        border-bottom: 1px solid rgba(255,255,255,.07);
    }

    .service-table-header h3 {
        margin: 0 0 6px;
        font-size: 15px;
    }

    .service-table-header p {
        margin: 0;
        color: #9990b2;
        font-size: 11px;
    }

    .service-search {
        display: flex;
        align-items: center;
        gap: 9px;
        background: #19162d;
        border: 1px solid rgba(182,154,255,.17);
        padding: 0 12px;
        border-radius: 9px;
        color: #a78be9;
    }

    .service-search input {
        width: 190px;
        padding: 11px 0;
        outline: none;
        border: none;
        background: transparent;
        color: white;
        font-size: 11px;
    }

    .service-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .service-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1050px;
    }

    .service-table th {
        padding: 15px 13px;
        text-align: left;
        white-space: nowrap;
        background: #292344;
        color: #c6b9ec;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    .service-table td {
        padding: 16px 13px;
        border-bottom: 1px solid rgba(255,255,255,.055);
        color: #ded8ed;
        font-size: 11px;
        vertical-align: middle;
    }

    .service-table tbody tr {
        transition: .2s;
    }

    .service-table tbody tr:hover {
        background: rgba(182,154,255,.055);
    }

    .service-code {
        color: #c0a8ff;
        font-weight: 700;
        background: rgba(137,103,232,.13);
        padding: 6px 9px;
        border-radius: 6px;
    }

    .service-plate {
        color: #fff;
        background: #34304a;
        padding: 6px 9px;
        border-radius: 6px;
        font-weight: 600;
    }

    .service-name {
        color: #fff !important;
        font-weight: 600;
    }

    .service-complaint {
        max-width: 210px;
        line-height: 1.6;
    }

    .service-actions {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .service-actions form {
        margin: 0;
    }

    .service-edit-btn,
    .service-delete-btn {
        width: 32px;
        height: 32px;
        display: grid;
        place-items: center;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        text-decoration: none;
        font-size: 13px;
        transition: .2s;
    }

    .service-edit-btn {
        background: rgba(137,103,232,.16);
        color: #c0a8ff;
    }

    .service-delete-btn {
        background: rgba(239,84,112,.12);
        color: #ff8093;
    }

    .service-edit-btn:hover,
    .service-delete-btn:hover {
        transform: translateY(-2px);
        filter: brightness(1.3);
    }

    .service-empty {
        text-align: center !important;
        padding: 55px 20px !important;
    }

    .service-empty-icon {
        font-size: 35px;
        margin-bottom: 12px;
    }

    .service-empty strong {
        display: block;
        color: white;
        font-size: 14px;
    }

    .service-empty p {
        color: #9990b2;
        font-size: 11px;
        margin: 8px 0 15px;
    }

    .service-empty a {
        color: #b99aff;
        text-decoration: none;
        font-size: 11px;
        font-weight: 700;
    }

    @media(max-width:700px) {
        .service-heading h1 {
            font-size: 21px;
        }

        .service-table-header {
            align-items: stretch;
        }

        .service-search input {
            width: 100%;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const search = document.getElementById('searchService');
        const rows = document.querySelectorAll('#serviceTable tbody tr');

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

