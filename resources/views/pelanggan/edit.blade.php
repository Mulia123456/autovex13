
@extends('layouts.app')

@section('title', 'Edit Pelanggan')
@section('page-title', 'Edit Pelanggan')

@section('content')

<div class="page-heading">
    <h1>Edit Data Pelanggan</h1>
    <p>Perbarui informasi pelanggan AUTOVEX.</p>
</div>

<div class="form-panel">

    <div class="form-heading">
        <div>
            <h3>Informasi Pelanggan</h3>
            <p>Ubah data sesuai informasi terbaru.</p>
        </div>
        <span class="form-icon">✎</span>
    </div>

    @if($errors->any())
        <div class="alert error">
            <strong>Periksa kembali data:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-grid">

            <div class="form-group">
                <label>Kode Pelanggan <span>*</span></label>
                <input type="text" name="kode_pelanggan"
                    value="{{ old('kode_pelanggan', $pelanggan->kode_pelanggan) }}"
                    required>
            </div>

            <div class="form-group">
                <label>Nama Lengkap <span>*</span></label>
                <input type="text" name="nama_lengkap"
                    value="{{ old('nama_lengkap', $pelanggan->nama_lengkap) }}"
                    required>
            </div>

            <div class="form-group">
                <label>Nomor HP <span>*</span></label>
                <input type="text" name="no_hp"
                    value="{{ old('no_hp', $pelanggan->no_hp) }}"
                    required>
            </div>

            <div class="form-group">
                <label>Pekerjaan <span>*</span></label>
                <input type="text" name="pekerjaan"
                    value="{{ old('pekerjaan', $pelanggan->pekerjaan) }}"
                    required>
            </div>

            <div class="form-group full">
                <label>Alamat Pelanggan <span>*</span></label>
                <textarea name="alamat" rows="4" required>{{ old('alamat', $pelanggan->alamat) }}</textarea>
            </div>

        </div>

        <div class="form-note">
            * Pastikan informasi pelanggan sudah benar sebelum menyimpan.
        </div>

        <div class="form-actions">
            <a href="{{ route('pelanggan.index') }}" class="cancel-btn">
                Batal
            </a>

            <button type="submit" class="save-btn">
                Simpan Perubahan →
            </button>
        </div>
    </form>
</div>

<style>
.form-panel {
    max-width: 850px;
    background: #211d39;
    border: 1px solid rgba(255,255,255,.08);
    border-radius: 17px;
    padding: 27px;
}

.form-heading {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 22px;
    margin-bottom: 24px;
    border-bottom: 1px solid rgba(255,255,255,.08);
}

.form-heading h3 {
    font-family: 'Outfit', sans-serif;
    font-size: 18px;
}

.form-heading p {
    color: #aaa4c2;
    font-size: 11px;
    margin-top: 5px;
}

.form-icon {
    width: 43px;
    height: 43px;
    display: grid;
    place-items: center;
    border-radius: 13px;
    background: #8967e833;
    color: #c4aaff;
    font-size: 20px;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 21px;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 9px;
}

.form-group.full { grid-column: 1 / -1; }

.form-group label {
    color: #ddd7ee;
    font-size: 12px;
    font-weight: 600;
}

.form-group label span { color: #ff8299; }

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 13px 14px;
    background: #17142d;
    color: white;
    border: 1px solid rgba(255,255,255,.1);
    border-radius: 9px;
    outline: none;
    font-family: inherit;
    font-size: 12px;
    transition: .2s;
}

.form-group input:focus,
.form-group textarea:focus {
    border-color: #8967e8;
    box-shadow: 0 0 0 3px #8967e81c;
}

.form-group textarea { resize: vertical; }

.form-note {
    color: #aaa4c2;
    font-size: 10px;
    margin-top: 19px;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 25px;
    padding-top: 20px;
    border-top: 1px solid rgba(255,255,255,.08);
}

.cancel-btn, .save-btn {
    padding: 12px 18px;
    border: none;
    border-radius: 9px;
    font-size: 11px;
    font-weight: 700;
    text-decoration: none;
    cursor: pointer;
    transition: .25s;
}

.cancel-btn {
    color: #c1bad5;
    background: #ffffff12;
}

.save-btn {
    color: white;
    background: linear-gradient(110deg, #8967e8, #6548b8);
}

.cancel-btn:hover, .save-btn:hover {
    transform: translateY(-2px);
}

.alert.error {
    padding: 13px 16px;
    margin-bottom: 20px;
    border-radius: 9px;
    background: #e65d7330;
    color: #ff9aaa;
    font-size: 12px;
}

.alert.error ul { padding-left: 20px; margin-top: 7px; }

@media(max-width: 650px) {
    .form-grid { grid-template-columns: 1fr; }
    .form-group.full { grid-column: auto; }
    .form-panel { padding: 18px; }
}
</style>

@endsection
