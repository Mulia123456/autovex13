
@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')

@section('content')

<div class="page-heading">
    <h1>Selamat Datang di AUTOVEX 👋</h1>
    <p>Kelola seluruh aktivitas bengkel motor dengan mudah dalam satu sistem.</p>
</div>

<div class="stats-grid">

    <div class="stat-card">
        <div class="stat-top">
            <span>Total Pelanggan</span>
            <span class="stat-icon">♙</span>
        </div>
        <h2 data-count="{{ $totalPelanggan }}">0</h2>
        <p>Data pelanggan terdaftar</p>
    </div>

    <div class="stat-card">
        <div class="stat-top">
            <span>Total Kendaraan</span>
            <span class="stat-icon">🏍</span>
        </div>
        <h2 data-count="{{ $totalKendaraan }}">0</h2>
        <p>Kendaraan terdaftar</p>
    </div>

    <div class="stat-card">
        <div class="stat-top">
            <span>Daftar Service</span>
            <span class="stat-icon">▤</span>
        </div>
        <h2 data-count="{{ $totalDaftarService }}">0</h2>
        <p>Servis yang tercatat</p>
    </div>

    <div class="stat-card">
        <div class="stat-top">
            <span>Pembayaran</span>
            <span class="stat-icon">▣</span>
        </div>
        <h2 data-count="{{ $totalPembayaran }}">0</h2>
        <p>Transaksi pembayaran</p>
    </div>

</div>

<div class="dashboard-grid">

    <div class="panel welcome-panel">
        <span class="welcome-tag">AUTOVEX MANAGEMENT SYSTEM</span>
        <h2>Everything Your Workshop Needs.</h2>
        <p>
            Pantau data pelanggan, kendaraan, proses servis, hingga
            pembayaran melalui satu dashboard yang terintegrasi.
        </p>
        <a href="{{ url('/daftar-service') }}" class="primary-btn">
            Lihat Daftar Service →
        </a>
    </div>

    <div class="panel quick-panel">
        <h3>Akses Cepat</h3>
        <p class="panel-desc">Pilih menu untuk mengelola data bengkel.</p>

        <a href="{{ url('/pelanggan') }}" class="quick-link">
            <span>♙</span>
            <div><strong>Data Pelanggan</strong><small>Kelola informasi pelanggan</small></div>
            <b>→</b>
        </a>

        <a href="{{ url('/kendaraan') }}" class="quick-link">
            <span>🏍</span>
            <div><strong>Data Kendaraan</strong><small>Kelola informasi kendaraan</small></div>
            <b>→</b>
        </a>

        <a href="{{ url('/pembayaran-service') }}" class="quick-link">
            <span>▣</span>
            <div><strong>Pembayaran</strong><small>Kelola transaksi servis</small></div>
            <b>→</b>
        </a>
    </div>

</div>

<style>
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 17px;
    margin-bottom: 23px;
}

.stat-card {
    padding: 21px;
    background: linear-gradient(145deg, #292448, #201d36);
    border: 1px solid rgba(255,255,255,.08);
    border-radius: 16px;
    transition: .3s ease;
}

.stat-card:hover {
    transform: translateY(-6px);
    border-color: #8967e8;
    box-shadow: 0 12px 30px #7655c922;
}

.stat-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    color: #b9b2d1;
    font-size: 12px;
}

.stat-icon {
    width: 35px;
    height: 35px;
    display: grid;
    place-items: center;
    background: #7655c933;
    color: #c2aaff;
    border-radius: 11px;
    font-size: 17px;
}

.stat-card h2 {
    font-family: 'Outfit', sans-serif;
    font-size: 32px;
    margin: 15px 0 5px;
}

.stat-card p, .panel-desc {
    color: #a9a2c2;
    font-size: 11px;
}

.dashboard-grid {
    display: grid;
    grid-template-columns: 1.2fr 1fr;
    gap: 20px;
}

.welcome-panel {
    min-height: 270px;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: center;
    background:
        radial-gradient(circle at 90% 10%, #8967e833, transparent 35%),
        linear-gradient(135deg, #292448, #211d39);
}

.welcome-tag {
    color: #b69aff;
    font-size: 10px;
    letter-spacing: 1.7px;
    font-weight: 700;
}

.welcome-panel h2 {
    font-family: 'Outfit', sans-serif;
    font-size: 29px;
    max-width: 390px;
    margin: 17px 0 10px;
}

.welcome-panel p {
    max-width: 440px;
    color: #b9b2d1;
    font-size: 12px;
    line-height: 1.8;
}

.primary-btn {
    margin-top: 22px;
    padding: 12px 17px;
    border-radius: 9px;
    background: linear-gradient(110deg, #8967e8, #6548b8);
    color: white;
    font-size: 11px;
    font-weight: 700;
    text-decoration: none;
    transition: .25s;
}

.primary-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 7px 20px #8967e855;
}

.quick-panel h3 {
    font-family: 'Outfit', sans-serif;
    font-size: 18px;
    margin-bottom: 6px;
}

.quick-link {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 13px 0;
    border-bottom: 1px solid rgba(255,255,255,.07);
    text-decoration: none;
    color: white;
    transition: .2s;
}

.quick-link:hover { transform: translateX(5px); }

.quick-link > span {
    width: 37px;
    height: 37px;
    display: grid;
    place-items: center;
    border-radius: 11px;
    background: #7655c933;
}

.quick-link div { flex: 1; }
.quick-link strong { display: block; font-size: 12px; }
.quick-link small {
    display: block;
    color: #a9a2c2;
    font-size: 10px;
    margin-top: 4px;
}

.quick-link b { color: #b69aff; }

@media (max-width: 1000px) {
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 700px) {
    .dashboard-grid { grid-template-columns: 1fr; }
}

@media (max-width: 400px) {
    .stats-grid { grid-template-columns: 1fr; }
}
</style>

<script>
document.querySelectorAll('[data-count]').forEach(element => {
    const target = Number(element.dataset.count);
    const duration = 900;
    const start = performance.now();

    function animate(now) {
        const progress = Math.min((now - start) / duration, 1);
        element.textContent = Math.floor(target * progress).toLocaleString('id-ID');

        if (progress < 1) {
            requestAnimationFrame(animate);
        }
    }

    requestAnimationFrame(animate);
});
</script>

@endsection
