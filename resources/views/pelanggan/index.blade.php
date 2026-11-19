
@extends('layouts.app')

@section('title', 'Data Pelanggan')
@section('page-title', 'Data Pelanggan')

@section('content')

<div class="page-heading">
    <h1>Data Pelanggan</h1>
    <p>Kelola informasi seluruh pelanggan bengkel AUTOVEX.</p>
</div>

@if(session('success'))
    <div class="alert success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert error">{{ session('error') }}</div>
@endif

@if($errors->any())
    <div class="alert error">
        {{ $errors->first() }}
    </div>
@endif

<div class="table-panel">

    <div class="table-header">
        <div>
            <h3>Daftar Pelanggan</h3>
            <p>Informasi pelanggan yang terdaftar dalam sistem.</p>
        </div>

        <a href="{{ route('pelanggan.create') }}" class="add-btn">
            + Tambah Pelanggan
        </a>
    </div>

    <div class="table-tools">
        <input type="text" id="searchPelanggan"
               placeholder="Cari nama, kode, atau nomor HP...">

        <span>Total: {{ $pelanggans->count() }} pelanggan</span>
    </div>

    <div class="table-responsive">
        <table id="pelangganTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Pelanggan</th>
                    <th>Nama Lengkap</th>
                    <th>No. HP</th>
                    <th>Alamat</th>
                    <th>Pekerjaan</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($pelanggans as $index => $pelanggan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <span class="code-badge">
                                {{ $pelanggan->kode_pelanggan }}
                            </span>
                        </td>
                        <td class="name-cell">{{ $pelanggan->nama_lengkap }}</td>
                        <td>{{ $pelanggan->no_hp }}</td>
                        <td>{{ $pelanggan->alamat }}</td>
                        <td>{{ $pelanggan->pekerjaan }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('pelanggan.edit', $pelanggan->id) }}"
                                   class="edit-btn">Edit</a>

                                <form action="{{ route('pelanggan.destroy', $pelanggan->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="empty-data">
                            Belum ada data pelanggan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
.table-panel {
    background: #211d39;
    border: 1px solid rgba(255,255,255,.08);
    border-radius: 16px;
    padding: 23px;
}

.table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    margin-bottom: 23px;
}

.table-header h3 {
    font-family: 'Outfit', sans-serif;
    font-size: 18px;
}

.table-header p {
    color: #aaa4c2;
    font-size: 11px;
    margin-top: 5px;
}

.add-btn, .edit-btn, .delete-btn {
    border: none;
    border-radius: 8px;
    padding: 10px 14px;
    font-size: 11px;
    font-weight: 700;
    text-decoration: none;
    cursor: pointer;
    transition: .25s;
}

.add-btn {
    color: white;
    background: linear-gradient(110deg, #8967e8, #6548b8);
}

.add-btn:hover, .edit-btn:hover, .delete-btn:hover {
    transform: translateY(-2px);
    filter: brightness(1.15);
}

.table-tools {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    margin-bottom: 17px;
}

.table-tools input {
    width: 320px;
    max-width: 100%;
    padding: 11px 14px;
    background: #17142d;
    border: 1px solid rgba(255,255,255,.1);
    border-radius: 9px;
    color: white;
    outline: none;
}

.table-tools input:focus {
    border-color: #8967e8;
}

.table-tools span {
    color: #aaa4c2;
    font-size: 11px;
}

.table-responsive { overflow-x: auto; }

table {
    width: 100%;
    border-collapse: collapse;
    min-width: 750px;
}

th {
    text-align: left;
    padding: 14px 12px;
    background: #292448;
    color: #b9a5f3;
    font-size: 10px;
    text-transform: uppercase;
    letter-spacing: .7px;
}

td {
    padding: 15px 12px;
    border-bottom: 1px solid rgba(255,255,255,.06);
    color: #d8d3e8;
    font-size: 11px;
}

tbody tr { transition: .2s; }
tbody tr:hover { background: #ffffff08; }

.code-badge {
    color: #c3aaff;
    background: #8967e822;
    padding: 6px 9px;
    border-radius: 6px;
}

.name-cell { font-weight: 700; color: white; }

.action-buttons {
    display: flex;
    gap: 6px;
    align-items: center;
}

.edit-btn {
    background: #8967e833;
    color: #c5aaff;
}

.delete-btn {
    background: #e65d7330;
    color: #ff899a;
}

.empty-data {
    text-align: center;
    padding: 35px;
    color: #aaa4c2;
}

.alert {
    padding: 13px 16px;
    margin-bottom: 18px;
    border-radius: 9px;
    font-size: 12px;
}

.alert.success {
    background: #2a8c6030;
    color: #83e5b2;
}

.alert.error {
    background: #e65d7330;
    color: #ff9aaa;
}

@media(max-width: 600px) {
    .table-header, .table-tools {
        align-items: flex-start;
        flex-direction: column;
    }
}
</style>

<script>
document.getElementById('searchPelanggan').addEventListener('input', function () {
    const keyword = this.value.toLowerCase();

    document.querySelectorAll('#pelangganTable tbody tr').forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(keyword)
            ? ''
            : 'none';
    });
});
</script>

@endsection
