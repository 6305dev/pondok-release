<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PONDOK DUKCAPIL - Tutup</title>
    <style>
        body {
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            color: white;
            text-align: center;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            max-width: 600px;
            width: 100%;
        }
        h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }
        p {
            font-size: 1.2em;
            margin-bottom: 20px;
        }
        .countdown {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 20px 0;
        }
        .countdown-box {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 10px;
            min-width: 60px;
        }
        .countdown-box span {
            display: block;
            font-size: 1.5em;
            font-weight: bold;
        }
        .countdown-box small {
            font-size: 0.8em;
        }
        .maintenance {
            margin-top: 30px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }
        .maintenance svg {
            width: 40px;
            height: 40px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>PONDOK DUKCAPIL</h1>
        <p>Pelayanan Online Dokumen Kependudukan</p>
        <h2>Close / Tutup</h2>
        <p>Mohon maaf saat ini kami sedang di luar jam layanan, untuk sementara menu pelayanan tidak dapat diakses.</p>

        <div class="countdown">
            <div class="countdown-box">
                <span id="days">00</span>
                <small>HARI</small>
            </div>
            <div class="countdown-box">
                <span id="hours">23</span>
                <small>JAM</small>
            </div>
            <div class="countdown-box">
                <span id="minutes">59</span>
                <small>MENIT</small>
            </div>
            <div class="countdown-box">
                <span id="seconds">59</span>
                <small>DETIK</small>
            </div>
        </div>

        <div class="maintenance">
            <svg data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7.864 4.243A7.5 7.5 0 0 1 19.5 10.5c0 2.92-.556 5.709-1.568 8.268M5.742 6.364A7.465 7.465 0 0 0 4.5 10.5a7.464 7.464 0 0 1-1.15 3.993m1.989 3.559A11.209 11.209 0 0 0 8.25 10.5a3.75 3.75 0 1 1 7.5 0c0 .527-.021 1.049-.064 1.565M12 10.5a14.94 14.94 0 0 1-3.6 9.75m6.633-4.596a18.666 18.666 0 0 1-2.485 5.33"></path>
            </svg>
            <p><strong>INFORMASI</strong></p>
            <p>Aplikasi masih dalam pengembangan.</p>
        </div>
    </div>

    <script>
        // Hitung waktu sampai buka kembali
        function hitungWaktu() {
            const now = new Date();
            const hariIni = now.toLocaleDateString('id-ID', { weekday: 'long' });

            let nextOpen = new Date(now);
            nextOpen.setHours(7, 30, 0, 0); // Jam buka default

            if (now > nextOpen) {
                // Jika sudah lewat jam buka hari ini, cari hari berikutnya yang aktif
                const hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                const indexHariIni = hari.indexOf(hariIni);

                for (let i = 1; i <= 2; i++) {
                    const index = (indexHariIni + i) % 2;
                    const hariBerikutnya = hari[index];

                    // Ganti dengan logika ambil dari database jika Anda punya API
                    if (hariBerikutnya === 'Senin') {
                        nextOpen.setDate(now.getDate() + i);
                        break;
                    }
                }
            }

            const diff = nextOpen - now;
            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((diff % (1000 * 60)) / 1000);

            document.getElementById('days').textContent = String(days).padStart(2, '0');
            document.getElementById('hours').textContent = String(hours).padStart(2, '0');
            document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
            document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');
        }

        setInterval(hitungWaktu, 1000);
        hitungWaktu();
    </script>
</body>
</html>