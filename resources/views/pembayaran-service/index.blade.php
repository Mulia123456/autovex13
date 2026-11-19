
@extends('layouts.app')

@section('title', 'Pembayaran Service')
@section('page-title', 'Pembayaran Service')

@section('content')

<div class="payment-page">

    <div class="payment-heading">
        <div>
            <h1>Pembayaran Service</h1>
            <p>Kelola transaksi pembayaran service kendaraan pelanggan.</p>
        </div>

        <a href="{{ route('pembayaran-service.create') }}" class="payment-add">
            ＋ Tambah Pembayaran
        </a>
    </div>

    <div class="payment-summary">
        <div class="payment-summary-icon">💳</div>
        <div>
            <span>Total Transaksi Pembayaran</span>
            <h2>{{ $pembayarans->count() }}</h2>
            <small>Seluruh transaksi yang tercatat di AUTOVEX</small>
        </div>
    </div>

    <div class="payment-card">

        <div class="payment-card-header">
            <div>
                <h3>Riwayat Pembayaran</h3>
                <p>Informasi biaya dan metode pembayaran service.</p>
            </div>

            <div class="payment-search">
                <span>⌕</span>
                <input
                    type="text"
                    id="searchPayment"
                    placeholder="Cari pembayaran..."
                >
            </div>
        </div>

        <div class="payment-table-wrapper">

            <table class="payment-table" id="paymentTable">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Service</th>
                        <th>Nama Pelanggan</th>
                        <th>No Plat</th>
                        <th>Jumlah Biaya</th>
                        <th>Jenis Pembayaran</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pembayarans as $pembayaran)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <span class="payment-code">
                                    {{ $pembayaran->daftarService->kode_service ?? '-' }}
                                </span>
                            </td>

                            <td class="payment-name">
                                {{ $pembayaran->daftarService->pelanggan->nama_lengkap ?? '-' }}
                            </td>

                            <td>
                                <span class="payment-plate">
                                    {{ $pembayaran->daftarService->kendaraan->no_plat ?? '-' }}
                                </span>
                            </td>

                            <td class="payment-amount">
                                Rp {{ number_format($pembayaran->jumlah_biaya, 0, ',', '.') }}
                            </td>

                            <td>
                                @if($pembayaran->jenis_pembayaran === 'cash')
                                    <span class="payment-method cash">
                                        Cash / Tunai
                                    </span>
                                @else
                                    <span class="payment-method noncash">
                                        Non Tunai
                                    </span>
                                @endif
                            </td>

                            <td>
                                {{ $pembayaran->keterangan ?: '-' }}
                            </td>

                            <td>
                                <div class="payment-actions">

                                    <a
                                        href="{{ route('pembayaran-service.edit', $pembayaran->id) }}"
                                        class="payment-edit"
                                        title="Edit"
                                    >
                                        ✎
                                    </a>

                                    <form
                                        action="{{ route('pembayaran-service.destroy', $pembayaran->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus pembayaran ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="payment-delete"
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
                            <td colspan="8" class="payment-empty">
                                <div>💳</div>
                                <strong>Belum Ada Transaksi Pembayaran</strong>
                                <p>Transaksi pembayaran service belum tercatat.</p>

                                <a href="{{ route('pembayaran-service.create') }}">
                                    Tambah Pembayaran Sekarang
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
    .payment-page {
        color: #f4f0ff;
    }

    .payment-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 25px;
    }

    .payment-heading h1 {
        color: white;
        font-size: 25px;
        margin: 0 0 8px;
    }

    .payment-heading p {
        color: #a9a1c2;
        font-size: 12px;
        margin: 0;
    }

    .payment-add {
        display: inline-block;
        padding: 12px 19px;
        color: white;
        background: linear-gradient(135deg,#9672ed,#6846bd);
        border-radius: 10px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
        transition: .2s;
    }

    .payment-add:hover {
        transform: translateY(-2px);
        filter: brightness(1.1);
    }

    .payment-summary {
        display: flex;
        align-items: center;
        gap: 17px;
        padding: 22px;
        margin-bottom: 24px;
        background: linear-gradient(120deg,#302650,#211d39);
        border: 1px solid rgba(182,154,255,.14);
        border-radius: 16px;
    }

    .payment-summary-icon {
        width: 55px;
        height: 55px;
        display: grid;
        place-items: center;
        background: rgba(182,154,255,.13);
        border-radius: 14px;
        font-size: 24px;
    }

    .payment-summary span {
        color: #b9afd3;
        font-size: 12px;
    }

    .payment-summary h2 {
        color: white;
        font-size: 27px;
        margin: 5px 0;
    }

    .payment-summary small {
        color: #9489ae;
        font-size: 11px;
    }

    .payment-card {
        background: #211d39;
        border: 1px solid rgba(255,255,255,.07);
        border-radius: 16px;
        overflow: hidden;
    }

    .payment-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        padding: 22px;
        border-bottom: 1px solid rgba(255,255,255,.07);
    }

    .payment-card-header h3 {
        margin: 0 0 6px;
        font-size: 15px;
    }

    .payment-card-header p {
        margin: 0;
        color: #9990b2;
        font-size: 11px;
    }

    .payment-search {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 0 12px;
        background: #19162d;
        border: 1px solid rgba(182,154,255,.17);
        border-radius: 9px;
        color: #a78be9;
    }

    .payment-search input {
        width: 190px;
        padding: 11px 0;
        background: transparent;
        border: none;
        outline: none;
        color: white;
        font-size: 11px;
    }

    .payment-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .payment-table {
        width: 100%;
        min-width: 1050px;
        border-collapse: collapse;
    }

    .payment-table th {
        padding: 15px 13px;
        text-align: left;
        white-space: nowrap;
        background: #292344;
        color: #c6b9ec;
        font-size: 10px;
        text-transform: uppercase;
    }

    .payment-table td {
        padding: 16px 13px;
        border-bottom: 1px solid rgba(255,255,255,.055);
        color: #ded8ed;
        font-size: 11px;
        vertical-align: middle;
    }

    .payment-table tbody tr:hover {
        background: rgba(182,154,255,.055);
    }

    .payment-code {
        color: #c0a8ff;
        background: rgba(137,103,232,.13);
        padding: 6px 9px;
        border-radius: 6px;
        font-weight: 700;
    }

    .payment-name {
        color: white !important;
        font-weight: 600;
    }

    .payment-plate {
        color: white;
        background: #34304a;
        padding: 6px 9px;
        border-radius: 6px;
        font-weight: 600;
    }

    .payment-amount {
        color: #c0a8ff !important;
        font-weight: 700;
        white-space: nowrap;
    }

    .payment-method {
        display: inline-block;
        padding: 6px 9px;
        border-radius: 6px;
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
    }

    .payment-method.cash {
        color: #9ee8c3;
        background: rgba(66,190,130,.12);
    }

    .payment-method.noncash {
        color: #c0a8ff;
        background: rgba(137,103,232,.15);
    }

    .payment-actions {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .payment-actions form {
        margin: 0;
    }

    .payment-edit,
    .payment-delete {
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

    .payment-edit {
        color: #c0a8ff;
        background: rgba(137,103,232,.16);
    }

    .payment-delete {
        color: #ff8093;
        background: rgba(239,84,112,.12);
    }

    .payment-empty {
        padding: 55px 20px !important;
        text-align: center !important;
    }

    .payment-empty div {
        font-size: 35px;
        margin-bottom: 12px;
    }

    .payment-empty strong {
        display: block;
        color: white;
        font-size: 14px;
    }

    .payment-empty p {
        color: #9990b2;
        font-size: 11px;
    }

    .payment-empty a {
        color: #b99aff;
        text-decoration: none;
        font-size: 11px;
        font-weight: 700;
    }

    @media(max-width:700px) {
        .payment-heading h1 {
            font-size: 21px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const search = document.getElementById('searchPayment');
        const rows = document.querySelectorAll('#paymentTable tbody tr');

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
