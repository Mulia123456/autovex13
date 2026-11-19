
@extends('layouts.app')

@section('title', 'Data Kendaraan')
@section('page-title', 'Data Kendaraan')

@section('content')

<div class="page-heading">
    <h1>Data Kendaraan 🏍️</h1>
    <p>Kelola informasi kendaraan pelanggan AUTOVEX.</p>
</div>

<style>
    .vehicle-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 22px;
        flex-wrap: wrap;
    }

    .vehicle-search {
        width: 280px;
        max-width: 100%;
        padding: 12px 15px;
        border: 1px solid rgba(182,154,255,.2);
        border-radius: 10px;
        background: #19162d;
        color: white;
        outline: none;
    }

    .vehicle-search:focus {
        border-color: #8967e8;
    }

    .vehicle-btn {
        display: inline-block;
        padding: 12px 18px;
        border-radius: 10px;
        background: linear-gradient(135deg,#8967e8,#5940a8);
        color: white;
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
        transition: .25s;
        border: none;
        cursor: pointer;
    }

    .vehicle-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 20px #7655c955;
    }

    .vehicle-table-wrapper {
        overflow-x: auto;
    }

    .vehicle-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 850px;
    }

    .vehicle-table th {
        padding: 15px 12px;
        text-align: left;
        color: #aaa4c2;
        font-size: 11px;
        border-bottom: 1px solid rgba(255,255,255,.1);
        white-space: nowrap;
    }

    .vehicle-table td {
        padding: 16px 12px;
        font-size: 12px;
        color: #e6e0f7;
        border-bottom: 1px solid rgba(255,255,255,.06);
    }

    .vehicle-table tbody tr {
        transition: .2s;
    }

    .vehicle-table tbody tr:hover {
        background: rgba(137,103,232,.08);
    }

    .vehicle-plate {
        display: inline-block;
        padding: 7px 11px;
        border-radius: 7px;
        background: rgba(137,103,232,.16);
        color: #c5adff;
        font-weight: 800;
        letter-spacing: .5px;
    }

    .vehicle-type {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        background: rgba(182,154,255,.12);
        color: #c9b5ff;
        font-size: 10px;
        font-weight: 700;
    }

    .vehicle-actions {
        display: flex;
        gap: 7px;
    }

    .action-edit,
    .action-delete {
        padding: 7px 10px;
        border-radius: 7px;
        font-size: 11px;
        text-decoration: none;
        border: none;
        cursor: pointer;
    }

    .action-edit {
        background: rgba(137,103,232,.2);
        color: #c5adff;
    }

    .action-delete {
        background: rgba(255,100,100,.12);
        color: #ff9999;
    }

    .empty-vehicle {
        text-align: center;
        padding: 45px 15px !important;
        color: #aaa4c2 !important;
    }

    .vehicle-count {
        margin-top: 18px;
        color: #aaa4c2;
        font-size: 11px;
    }
</style>

<div class="panel">

    <div class="vehicle-toolbar">

        <input
            type="text"
            id="vehicleSearch"
            class="vehicle-search"
            placeholder="⌕ Cari plat, pemilik, warna..."
        >

        <a href="{{ route('kendaraan.create') }}" class="vehicle-btn">
            + Tambah Kendaraan
        </a>

    </div>

    <div class="vehicle-table-wrapper">
        <table class="vehicle-table">

            <thead>
                <tr>
                    <th>NO</th>
                    <th>NO PLAT</th>
                    <th>JENIS KENDARAAN</th>
                    <th>NO STNK</th>
                    <th>TAHUN</th>
                    <th>NAMA PEMILIK</th>
                    <th>WARNA</th>
                    <th>AKSI</th>
                </tr>
            </thead>

            <tbody id="vehicleTableBody">

                @forelse($kendaraans as $kendaraan)

                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        <span class="vehicle-plate">
                            {{ $kendaraan->no_plat }}
                        </span>
                    </td>

                    <td>
                        <span class="vehicle-type">
                            {{ $kendaraan->jenis_kendaraan === 'matic' ? 'Matic' : 'Manual Transmisi' }}
                        </span>
                    </td>

                    <td>{{ $kendaraan->no_stnk }}</td>

                    <td>{{ $kendaraan->tahun_pembuatan }}</td>

                    <td>{{ $kendaraan->nama_pemilik }}</td>

                    <td>{{ $kendaraan->warna }}</td>

                    <td>
                        <div class="vehicle-actions">

                            <a
                                href="{{ route('kendaraan.edit', $kendaraan->id) }}"
                                class="action-edit"
                            >
                                Edit
                            </a>

                            <form
                                action="{{ route('kendaraan.destroy', $kendaraan->id) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus kendaraan ini?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="action-delete">
                                    Hapus
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>

                @empty

                <tr>
                    <td colspan="8" class="empty-vehicle">
                        🏍️<br><br>
                        Belum ada data kendaraan.<br>
                        Silakan tambahkan kendaraan pertama AUTOVEX.
                    </td>
                </tr>

                @endforelse

            </tbody>
        </table>
    </div>

    <div class="vehicle-count">
        Total kendaraan: {{ $kendaraans->count() }} data
    </div>

</div>

<script>
document.getElementById('vehicleSearch').addEventListener('input', function () {

    const keyword = this.value.toLowerCase();

    document.querySelectorAll('#vehicleTableBody tr').forEach(function (row) {

        row.style.display = row.textContent.toLowerCase().includes(keyword)
            ? ''
            : 'none';

    });

});
</script>

@endsection
