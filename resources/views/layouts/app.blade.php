
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | AUTOVEX</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg: #11101f;
            --sidebar: #19162d;
            --panel: #211d39;
            --panel-light: #292448;
            --purple: #8967e8;
            --lavender: #b69aff;
            --text: #f4f0ff;
            --muted: #aaa4c2;
            --border: rgba(255,255,255,.08);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: 255px;
            padding: 28px 18px;
            background: var(--sidebar);
            border-right: 1px solid var(--border);
            z-index: 10;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 4px 10px 34px;
        }

        .brand-icon {
            width: 43px;
            height: 43px;
            display: grid;
            place-items: center;
            border-radius: 14px;
            background: linear-gradient(135deg, #9b79f5, #5940a8);
            font-size: 23px;
            box-shadow: 0 5px 22px #7655c955;
        }

        .brand h2 {
            font-family: 'Outfit', sans-serif;
            font-size: 21px;
            letter-spacing: 1.5px;
        }

        .brand small {
            display: block;
            color: var(--muted);
            font-size: 10px;
            letter-spacing: 1.2px;
            margin-top: 2px;
        }

        .nav-label {
            color: #817b9e;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            padding: 10px 12px;
        }

        .nav-menu {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .nav-menu a {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 13px 14px;
            color: #b9b3d0;
            text-decoration: none;
            border-radius: 11px;
            font-size: 13px;
            font-weight: 600;
            transition: .25s ease;
        }

        .nav-menu a:hover,
        .nav-menu a.active {
            color: white;
            background: linear-gradient(100deg, #7655c944, #7655c911);
            transform: translateX(4px);
        }

        .nav-menu a.active {
            border-left: 3px solid var(--lavender);
        }

        .nav-icon { width: 20px; text-align: center; }

        .sidebar-bottom {
            position: absolute;
            bottom: 25px;
            left: 22px;
            right: 22px;
            padding: 15px;
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 13px;
        }

        .sidebar-bottom strong { font-size: 12px; }

        .sidebar-bottom p {
            color: var(--muted);
            font-size: 10px;
            margin-top: 5px;
        }

        .main {
            margin-left: 255px;
            min-height: 100vh;
        }

        .topbar {
            height: 78px;
            padding: 0 38px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--border);
            background: rgba(25,22,45,.72);
        }

        .topbar h3 {
            font-family: 'Outfit', sans-serif;
            font-size: 19px;
        }

        .topbar p {
            color: var(--muted);
            font-size: 11px;
            margin-top: 3px;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 11px;
            font-size: 12px;
            font-weight: 600;
        }

        .avatar {
            width: 36px;
            height: 36px;
            display: grid;
            place-items: center;
            border-radius: 12px;
            background: linear-gradient(135deg, #9878ed, #55418e);
        }

        .content {
            padding: 35px 38px;
            animation: appear .55s ease both;
        }

        @keyframes appear {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .page-heading { margin-bottom: 25px; }

        .page-heading h1 {
            font-family: 'Outfit', sans-serif;
            font-size: 27px;
            margin-bottom: 7px;
        }

        .page-heading p {
            color: var(--muted);
            font-size: 13px;
        }

        .panel {
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 17px;
            padding: 23px;
        }

        /* =====================================
           GLOBAL NOTIFICATION AUTOVEX
        ===================================== */

        .autovex-toast {
            position: fixed;
            top: 24px;
            right: 24px;
            z-index: 99999;
            min-width: 290px;
            max-width: 370px;
            padding: 17px 20px;
            border: 1px solid rgba(182,154,255,.35);
            border-radius: 15px;
            background: #211d39;
            color: #f4f0ff;
            box-shadow: 0 12px 35px rgba(0,0,0,.35);
            display: flex;
            align-items: center;
            gap: 13px;
            opacity: 0;
            transform: translateX(30px);
            pointer-events: none;
            transition: .35s ease;
        }

        .autovex-toast.show {
            opacity: 1;
            transform: translateX(0);
        }

        .autovex-toast-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: rgba(137,103,232,.2);
            color: #b69aff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
            flex-shrink: 0;
        }

        .autovex-toast.error .autovex-toast-icon {
            color: #ff8585;
            background: rgba(255,100,100,.15);
        }

        .autovex-toast-title {
            font-weight: 700;
            font-size: 14px;
            margin-bottom: 4px;
        }

        .autovex-toast-message {
            font-size: 13px;
            color: #c9c2df;
            line-height: 1.5;
        }

        .autovex-sound-button {
            position: fixed;
            right: 24px;
            bottom: 22px;
            z-index: 99998;
            border: 1px solid rgba(182,154,255,.4);
            border-radius: 30px;
            padding: 10px 16px;
            background: #29234b;
            color: #f4f0ff;
            font-size: 12px;
            cursor: pointer;
            box-shadow: 0 5px 18px rgba(0,0,0,.2);
            transition: .25s ease;
        }

        .autovex-sound-button:hover {
            background: #7655c9;
            transform: translateY(-2px);
        }

        @media (max-width: 900px) {
            .sidebar { width: 210px; }
            .main { margin-left: 210px; }
            .content { padding: 25px 20px; }
            .topbar { padding: 0 20px; }
        }

        @media (max-width: 650px) {
            .sidebar {
                position: relative;
                width: 100%;
                padding: 15px;
            }

            .sidebar-bottom { display: none; }

            .nav-menu {
                display: grid;
                grid-template-columns: 1fr 1fr;
            }

            .main { margin-left: 0; }
            .topbar { height: 68px; }
            .content { padding: 22px 15px; }
        }

        @media (max-width: 500px) {
            .autovex-toast {
                top: 12px;
                right: 12px;
                left: 12px;
                min-width: auto;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="brand">
            <div class="brand-icon">⚙</div>
            <div>
                <h2>AUTOVEX</h2>
                <small>MOTORCYCLE SERVICE</small>
            </div>
        </div>

        <div class="nav-label">MENU UTAMA</div>

        <nav class="nav-menu">
            <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">
                <span class="nav-icon">▦</span> Dashboard
            </a>

            <a href="{{ url('/pelanggan') }}" class="{{ request()->is('pelanggan*') ? 'active' : '' }}">
                <span class="nav-icon">♙</span> Data Pelanggan
            </a>

            <a href="{{ url('/kendaraan') }}" class="{{ request()->is('kendaraan*') ? 'active' : '' }}">
                <span class="nav-icon">🏍</span> Data Kendaraan
            </a>

            <a href="{{ url('/daftar-service') }}" class="{{ request()->is('daftar-service*') ? 'active' : '' }}">
                <span class="nav-icon">▤</span> Daftar Service
            </a>

            <a href="{{ url('/data-service') }}" class="{{ request()->is('data-service*') ? 'active' : '' }}">
                <span class="nav-icon">🔧</span> Data Service
            </a>

            <a href="{{ url('/pembayaran-service') }}" class="{{ request()->is('pembayaran-service*') ? 'active' : '' }}">
                <span class="nav-icon">▣</span> Pembayaran
            </a>
        </nav>

        <div class="sidebar-bottom">
            <strong>✦ AUTOVEX SYSTEM</strong>
            <p>Motorcycle Service Management</p>
        </div>
    </aside>

    <main class="main">
        <header class="topbar">
            <div>
                <h3>@yield('page-title', 'Dashboard')</h3>
                <p>Motorcycle Service Management System</p>
            </div>

            <div class="profile">
                <div class="avatar">A</div>
                <span>Administrator</span>
            </div>
        </header>

        <section class="content">
            @yield('content')
        </section>
    </main>

    <!-- GLOBAL TOAST -->
    <div
        id="autovexToast"
        class="autovex-toast"
        data-message="{{ session('success') ?? session('error') ?? $errors->first() }}"
        data-type="@if(session('error') || $errors->any()) error @else success @endif"
    >
        <div class="autovex-toast-icon" id="autovexToastIcon">✓</div>

        <div>
            <div class="autovex-toast-title" id="autovexToastTitle">
                Berhasil!
            </div>

            <div class="autovex-toast-message" id="autovexToastMessage"></div>
        </div>
    </div>

    <!-- TOMBOL AKTIVASI SUARA -->
    <button type="button" class="autovex-sound-button" id="autovexSoundButton">
        🔊 Aktifkan Suara
    </button>

    <script>
    document.addEventListener('DOMContentLoaded', function () {

        const toast = document.getElementById('autovexToast');
        const soundButton = document.getElementById('autovexSoundButton');

        let soundEnabled = localStorage.getItem('autovexSoundEnabled') === 'true';
        let audioContext = null;

        // Perbarui tampilan tombol suara.
        function updateSoundButton() {
            soundButton.innerHTML = soundEnabled
                ? '🔊 Suara Aktif'
                : '🔊 Aktifkan Suara';

            soundButton.style.background = soundEnabled
                ? '#7655c9'
                : '#29234b';
        }

        updateSoundButton();

        // Siapkan audio.
        function prepareAudio() {
            const AudioContextClass =
                window.AudioContext || window.webkitAudioContext;

            if (!AudioContextClass) return false;

            if (!audioContext) {
                audioContext = new AudioContextClass();
            }

            if (audioContext.state === 'suspended') {
                audioContext.resume();
            }

            return true;
        }

        // Bunyi ding.
        function playDing() {
            if (!soundEnabled) return;

            try {
                if (!prepareAudio()) return;

                const oscillator = audioContext.createOscillator();
                const gain = audioContext.createGain();

                oscillator.connect(gain);
                gain.connect(audioContext.destination);

                oscillator.type = 'sine';

                oscillator.frequency.setValueAtTime(
                    880,
                    audioContext.currentTime
                );

                gain.gain.setValueAtTime(
                    0.001,
                    audioContext.currentTime
                );

                gain.gain.exponentialRampToValueAtTime(
                    0.18,
                    audioContext.currentTime + 0.03
                );

                gain.gain.exponentialRampToValueAtTime(
                    0.001,
                    audioContext.currentTime + 0.35
                );

                oscillator.start();
                oscillator.stop(audioContext.currentTime + 0.36);

            } catch (error) {
                console.log('Audio belum dapat diputar:', error);
            }
        }

        // Suara berbicara bahasa Indonesia.
        function speakNotification(message) {
            if (!soundEnabled || !('speechSynthesis' in window)) return;

            window.speechSynthesis.cancel();

            const utterance = new SpeechSynthesisUtterance(message);

            utterance.lang = 'id-ID';
            utterance.rate = 0.95;
            utterance.pitch = 1.15;
            utterance.volume = 1;

            const voices = window.speechSynthesis.getVoices();

            const indonesianVoices = voices.filter(voice =>
                voice.lang.toLowerCase().startsWith('id')
            );

            const femaleVoice = indonesianVoices.find(voice =>
                /female|woman|perempuan|gadis/i.test(voice.name)
            );

            utterance.voice = femaleVoice || indonesianVoices[0] || null;

            window.speechSynthesis.speak(utterance);
        }

        // Aktifkan suara setelah tombol ditekan.
        soundButton.addEventListener('click', function () {

            soundEnabled = true;

            localStorage.setItem('autovexSoundEnabled', 'true');

            updateSoundButton();

            prepareAudio();

            playDing();

            speakNotification(
                'Suara notifikasi AUTOVEX telah aktif.'
            );
        });

        // Tampilkan notifikasi dari Laravel.
        const message = toast.dataset.message;

        if (message && message.trim() !== '') {

            const isError = toast.dataset.type.trim() === 'error';

            toast.classList.toggle('error', isError);

            document.getElementById('autovexToastTitle').textContent =
                isError ? 'Terjadi Kesalahan' : 'Berhasil!';

            document.getElementById('autovexToastIcon').textContent =
                isError ? '!' : '✓';

            document.getElementById('autovexToastMessage').textContent =
                message;

            setTimeout(function () {
                toast.classList.add('show');
            }, 150);

            if (soundEnabled) {
                playDing();
                speakNotification(message);
            }

            setTimeout(function () {
                toast.classList.remove('show');
            }, 5500);
        }

    });
    </script>

</body>
</html>
