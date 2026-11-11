@extends('layouts.app')

@section('content')
<div class="chat-wrapper">
    <div class="chat-container">
        <header class="chat-header">
            <div class="header-info">
                <a href="{{ route('home') }}" class="btn-back" aria-label="Kembali" title="Kembali ke Beranda">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                </a>
                <div class="header-avatar">CS</div>
                <div class="header-text">
                    <h2>Layanan Konsultasi</h2>
                    <p><span class="status-dot"></span> Online</p>
                </div>
            </div>
        </header>

        <main class="chat-body" id="messages"></main>

        <form class="chat-footer" id="form">
            <input type="file" id="file-input" accept="image/*" style="display:none;">
            <button type="button" id="btn-upload" aria-label="Upload Gambar" title="Kirim Gambar">
                <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                    <circle cx="8.5" cy="8.5" r="1.5" />
                    <polyline points="21 15 16 10 5 21" />
                </svg>
            </button>
            <textarea id="input" placeholder="Ketik pesan..." autocomplete="off" rows="1"></textarea>
            <button type="submit" class="btn-send" aria-label="Kirim" title="Kirim Pesan">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                    <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z" />
                </svg>
            </button>
        </form>
    </div>
</div>

<div id="img-lightbox">
    <img id="lightbox-img" src="" alt="Gambar Penuh">
    <button onclick="closeLightbox()">✕ Tutup</button>
</div>

<div id="upload-preview-overlay">
    <div id="upload-preview-box">
        <strong>Kirim Gambar</strong>
        <img id="preview-img" src="" alt="Preview">
        <p id="preview-filename"></p>
        <div class="preview-actions">
            <button type="button" id="btn-preview-cancel">Batal</button>
            <button type="button" id="btn-preview-send">Kirim</button>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    *,
    *::before,
    *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    :root {
        --primary: #0f766e;
        --primary-hover: #115e59;
        --primary-light: #ccfbf1;
        --bg-page: #f8fafc;
        --bg-card: #ffffff;
        --bg-chat: #f1f5f9;
        --text-main: #0f172a;
        --text-muted: #64748b;
        --bubble-me: #0f766e;
        --bubble-me-text: #ffffff;
        --bubble-admin: #ffffff;
        --bubble-admin-text: #1e293b;
        --border-color: #e2e8f0;
        --radius-lg: 16px;
        --radius-md: 12px;
        --radius-full: 9999px;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
    }

    html,
    body {
        height: 100%;
        height: 100dvh;
        overflow: hidden;
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        background-color: var(--bg-page);
        color: var(--text-main);
        -webkit-font-smoothing: antialiased;
    }

    .chat-wrapper {
        width: 100%;
        height: 100%;
        height: 100dvh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(135deg, #f0fdf4 0%, #e0f2fe 100%);
    }

    .chat-container {
        width: 100%;
        max-width: 800px;
        height: 100%;
        display: flex;
        flex-direction: column;
        background: var(--bg-card);
        box-shadow: var(--shadow-lg);
        position: relative;
        overflow: hidden;
    }

    @media (min-width: 769px) {
        .chat-wrapper {
            padding: 20px;
            height: 100%;
            height: 100dvh;
        }

        .chat-container {
            height: calc(100vh - 40px);
            height: calc(100dvh - 40px);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-color);
        }
    }

    .chat-header {
        height: 64px;
        padding: 0 20px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-bottom: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-shrink: 0;
        z-index: 10;
    }

    .header-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .btn-back {
        background: none;
        border: none;
        color: var(--text-muted);
        cursor: pointer;
        padding: 6px;
        margin-right: 2px;
        border-radius: var(--radius-full);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .btn-back:hover {
        background: #f1f5f9;
        color: var(--primary);
    }

    .btn-back:active {
        transform: scale(0.92);
    }

    .header-avatar {
        width: 40px;
        height: 40px;
        border-radius: var(--radius-full);
        background: var(--primary-light);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.1rem;
    }

    .header-text h2 {
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-main);
        line-height: 1.2;
    }

    .header-text p {
        font-size: 0.75rem;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 6px;
        margin-top: 2px;
    }

    .status-dot {
        width: 8px;
        height: 8px;
        background-color: #10b981;
        border-radius: 50%;
        display: inline-block;
        box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2);
    }

    .chat-body {
        flex: 1;
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 12px;
        background-color: var(--bg-chat);
        background-size: 16px 16px;
    }

    .chat-body::-webkit-scrollbar {
        width: 5px;
    }

    .chat-body::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    .message-wrapper {
        display: flex;
        width: 100%;
        align-items: flex-start;
        animation: fadeIn 0.2s cubic-bezier(0, 0, 0.2, 1);
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(6px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .message-wrapper.me {
        justify-content: flex-end;
    }

    .message-wrapper.admin {
        justify-content: flex-start;
    }

    .message-container {
        max-width: 75%;
        display: flex;
        flex-direction: column;
    }

    @media (min-width: 640px) {
        .message-container {
            max-width: 60%;
        }
    }

    .bubble {
        padding: 12px 16px;
        border-radius: var(--radius-md);
        font-size: 0.9375rem;
        line-height: 1.5;
        word-wrap: break-word;
        white-space: pre-wrap;
        box-shadow: var(--shadow-sm);
        position: relative;
    }

    .bubble.me {
        background: var(--bubble-me);
        color: var(--bubble-me-text);
        border-bottom-right-radius: 4px;
    }

    .bubble.admin {
        background: var(--bubble-admin);
        color: var(--bubble-admin-text);
        border: 1px solid var(--border-color);
        border-bottom-left-radius: 4px;
    }

    .message-date {
        font-size: 0.7rem;
        color: var(--text-muted);
        margin-top: 4px;
        padding: 0 4px;
        font-weight: 500;
    }

    .message-wrapper.me .message-date {
        text-align: right;
    }

    .message-wrapper.admin .message-date {
        text-align: left;
    }

    .date-divider {
        text-align: center;
        margin: 16px 0;
        position: relative;
    }

    .date-divider span {
        background-color: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(4px);
        padding: 4px 12px;
        color: var(--text-muted);
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: var(--radius-full);
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-color);
    }

    .bubble img.chat-img {
        max-width: 100%;
        max-height: 260px;
        border-radius: 8px;
        display: block;
        cursor: pointer;
        object-fit: cover;
        transition: transform 0.2s ease, opacity 0.2s ease;
    }

    .bubble img.chat-img:hover {
        opacity: 0.95;
        transform: scale(1.01);
    }

    .chat-footer {
        padding: 12px 16px;
        background: var(--bg-card);
        border-top: 1px solid var(--border-color);
        display: flex;
        align-items: flex-end;
        gap: 10px;
        flex-shrink: 0;
    }

    .chat-footer textarea {
        flex: 1;
        border: 1px solid var(--border-color);
        background: #f8fafc;
        border-radius: 20px;
        padding: 10px 18px;
        font-size: 0.9375rem;
        color: var(--text-main);
        outline: none;
        transition: border-color 0.2s ease, background 0.2s ease;
        font-family: inherit;
        resize: none;
        height: 42px;
        min-height: 42px;
        max-height: 120px;
        line-height: 1.4;
    }

    .chat-footer textarea:focus {
        border-color: var(--primary);
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.15);
    }

    .chat-footer button {
        flex-shrink: 0;
        width: 44px;
        height: 44px;
        border: none;
        border-radius: var(--radius-full);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    #btn-upload {
        background: #f1f5f9;
        color: var(--text-muted);
    }

    #btn-upload:hover {
        background: #e2e8f0;
        color: var(--text-main);
    }

    .btn-send {
        background: var(--primary);
        color: #ffffff;
    }

    .btn-send:hover {
        background: var(--primary-hover);
        transform: scale(1.03);
    }

    .btn-send:active {
        transform: scale(0.97);
    }

    #img-lightbox {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.85);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 16px;
        padding: 20px;
        animation: fadeIn 0.2s ease;
    }

    #img-lightbox.open {
        display: flex;
    }

    #img-lightbox img {
        max-width: 95vw;
        max-height: 80vh;
        border-radius: var(--radius-md);
        object-fit: contain;
        box-shadow: var(--shadow-lg);
    }

    #img-lightbox button {
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: #ffffff;
        font-size: 0.875rem;
        font-weight: 600;
        padding: 10px 24px;
        border-radius: var(--radius-full);
        cursor: pointer;
        transition: background 0.2s;
    }

    #img-lightbox button:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    #upload-preview-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(4px);
        z-index: 8000;
        align-items: center;
        justify-content: center;
        padding: 20px;
        animation: fadeIn 0.2s ease;
    }

    #upload-preview-overlay.open {
        display: flex;
    }

    #upload-preview-box {
        background: var(--bg-card);
        border-radius: var(--radius-lg);
        padding: 24px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 16px;
        width: 100%;
        max-width: 360px;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--border-color);
    }

    #upload-preview-box strong {
        font-size: 1rem;
        color: var(--text-main);
    }

    #upload-preview-box img {
        width: 100%;
        max-height: 240px;
        border-radius: var(--radius-md);
        object-fit: contain;
        background: #f8fafc;
        border: 1px solid var(--border-color);
    }

    #upload-preview-box p {
        font-size: 0.8125rem;
        color: var(--text-muted);
        text-align: center;
        word-break: break-all;
    }

    .preview-actions {
        display: flex;
        gap: 12px;
        width: 100%;
    }

    .preview-actions button {
        flex: 1;
        padding: 10px 16px;
        border: none;
        border-radius: var(--radius-full);
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    #btn-preview-send {
        background: var(--primary);
        color: #ffffff;
    }

    #btn-preview-send:hover {
        background: var(--primary-hover);
    }

    #btn-preview-cancel {
        background: #f1f5f9;
        color: var(--text-main);
    }

    #btn-preview-cancel:hover {
        background: #e2e8f0;
    }
</style>
@endpush

@push('scripts')

<script>
    const SERVER_URL = "{{ config('services.chat.url') }}";
    const ADMIN_ID = "{{ config('services.chat.admin_id') }}";
    const USER_ID = "{{ auth()->user()->nik}}";
    const USER_NAME = "{{ auth()->user()->name}}";
    const IMAGE_PROXY_PATH = "/imgs";
    const IMAGE_SERVER_PATH = "/uploads";

    function resolveImageUrl(imageUrl) {
        if (!imageUrl) return imageUrl;
        return imageUrl.replace(IMAGE_SERVER_PATH, IMAGE_PROXY_PATH);
    }
</script>
<script src="https://cdn.socket.io/4.7.2/socket.io.min.js"></script>
<script>
    const socket = io(SERVER_URL, {
        transports: ["websocket", "polling"]
    });
    const form = document.getElementById('form');
    const input = document.getElementById('input');
    const box = document.getElementById('messages');

    // Auto-resize textarea
    input.addEventListener('input', function() {
        this.style.height = '42px';
        this.style.height = Math.min(this.scrollHeight, 120) + 'px';
    });

    // Handle keydown on textarea
    input.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            const btnSend = document.querySelector('.btn-send');
            if (btnSend) btnSend.click();
        }
    });

    let lastDisplayedDate = null; // Untuk melacak tanggal terakhir yang ditampilkan

    // Fungsi untuk memformat tanggal
    function formatDate(dateString) {
        const date = new Date(dateString);
        const today = new Date();
        const yesterday = new Date(today);
        yesterday.setDate(yesterday.getDate() - 1);

        // Cek apakah tanggalnya hari ini
        if (date.toDateString() === today.toDateString()) {
            return 'Hari ini, ' + date.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        // Cek apakah tanggalnya kemarin
        if (date.toDateString() === yesterday.toDateString()) {
            return 'Kemarin, ' + date.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        // Jika bukan hari ini atau kemarin, tampilkan tanggal lengkap
        return date.toLocaleDateString('id-ID', {
            day: 'numeric',
            month: 'long',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    }

    // Fungsi untuk menambahkan pembatas tanggal
    function addDateDivider(dateString) {
        const date = new Date(dateString);
        const today = new Date();
        const yesterday = new Date(today);
        yesterday.setDate(yesterday.getDate() - 1);

        let dateText;
        if (date.toDateString() === today.toDateString()) {
            dateText = 'Hari ini';
        } else if (date.toDateString() === yesterday.toDateString()) {
            dateText = 'Kemarin';
        } else {
            dateText = date.toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
        }

        const divider = document.createElement('div');
        divider.classList.add('date-divider');
        const span = document.createElement('span');
        span.textContent = dateText;
        divider.appendChild(span);
        box.appendChild(divider);
    }

    // FUNGSI YANG SUDAH DIPERBAIKI
    function addBubble(text, siapa = 'me', createdAt, imageUrl = null) {
        // Format tanggal
        const messageDate = new Date(createdAt);
        const messageDateString = messageDate.toDateString();

        // Tambahkan pembatas tanggal jika ini adalah pesan pertama atau tanggal berbeda dari pesan sebelumnya
        if (lastDisplayedDate === null || messageDateString !== lastDisplayedDate) {
            addDateDivider(createdAt);
            lastDisplayedDate = messageDateString;
        }

        // 1. Buat wrapper untuk pesan
        const messageWrapper = document.createElement('div');
        messageWrapper.classList.add('message-wrapper');
        messageWrapper.classList.add(siapa);

        // 2. Buat container untuk gelembung pesan dan tanggal
        const messageContainer = document.createElement('div');
        messageContainer.classList.add('message-container');

        // 3. Buat gelembung pesan
        const b = document.createElement('div');
        b.className = 'bubble ' + siapa;

        if (imageUrl) {
            const img = document.createElement('img');
            img.className = 'chat-img';
            const imgSrc = resolveImageUrl(imageUrl);
            img.src = imgSrc;
            img.alt = 'Gambar';
            img.loading = 'lazy';
            img.onclick = () => openLightbox(imgSrc);
            img.onload = () => {
                box.scrollTop = box.scrollHeight;
            };
            b.appendChild(img);
        } else {
            b.textContent = text;
        }

        // 4. Buat elemen tanggal
        const messageDateElement = document.createElement('div');
        messageDateElement.classList.add('message-date');
        messageDateElement.textContent = formatDate(createdAt);

        // 5. Susun elemen
        messageContainer.appendChild(b);
        messageContainer.appendChild(messageDateElement);
        messageWrapper.appendChild(messageContainer);
        box.appendChild(messageWrapper);

        // 6. Auto-scroll ke pesan terbaru
        box.scrollTop = box.scrollHeight;
    }

    // FUNGSI YANG SUDAH DIPERBAIKI
    async function loadMessageHistory() {
        // Tampilkan indikator loading (opsional)
        box.innerHTML = '<div style="text-align:center; color:#888;">Memuat pesan...</div>';

        try {
            const response = await fetch('/chat-proxy/conversation');
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const messages = await response.json();

            // Kosongkan kotak pesan sebelum menambahkan histori
            box.innerHTML = '';
            lastDisplayedDate = null; // Reset tanggal terakhir yang ditampilkan

            // Tampilkan setiap pesan
            messages.forEach(msg => {
                // PERBAIKAN: Akses ID pengirim dari objek 'sender' yang bersarang
                // Fallback ke msg.senderId jika 'sender' tidak ada
                const senderIdFromApi = msg.sender ? msg.sender.id : msg.senderId;

                // Bandingkan dengan ID user yang sedang login
                const sender = (senderIdFromApi == USER_ID) ? 'me' : 'admin';

                addBubble(msg.content, sender, msg.createdAt, msg.imageUrl);
            });

            // Scroll ke pesan terakhir setelah semua pesan di-render
            requestAnimationFrame(() => {
                box.scrollTop = box.scrollHeight;
            });

        } catch (error) {
            console.error('Gagal memuat histori pesan:', error);
            box.innerHTML = '<div style="text-align:center; color:red;">Gagal memuat pesan lama.</div>';
        }
    }

    // Panggil fungsi untuk memuat histori saat halaman dibuka
    loadMessageHistory();

    socket.on('connect', () => {
        socket.emit('register', {
            id: `${USER_ID}`,
            username: `${USER_NAME}`,
            role: 'user'
        });
        socket.emit('markMessagesAsRead', { otherUserId: `${ADMIN_ID}` });
    });
    socket.on('newMessageFromAdmin', m => {
        addBubble(m.content, 'admin', m.createdAt, m.imageUrl);
        socket.emit('markMessagesAsRead', { otherUserId: `${ADMIN_ID}` });
    });

    form.addEventListener('submit', e => {
        e.preventDefault();
        const pesan = input.value.trim();
        if (!pesan) return;

        // Tambahkan pesan ke UI dengan timestamp saat ini
        const now = new Date().toISOString();
        addBubble(pesan, 'me', now);

        // Kirim pesan ke server
        socket.emit('sendMessageToAdmin', pesan);
        input.value = '';
        input.style.height = '42px';
    });

    // --- UPLOAD GAMBAR ---
    const fileInput = document.getElementById('file-input');
    const btnUpload = document.getElementById('btn-upload');
    const previewOverlay = document.getElementById('upload-preview-overlay');
    const previewImg = document.getElementById('preview-img');
    const previewFilename = document.getElementById('preview-filename');
    const btnPreviewSend = document.getElementById('btn-preview-send');
    const btnPreviewCancel = document.getElementById('btn-preview-cancel');

    let selectedFile = null;

    btnUpload.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', () => {
        const file = fileInput.files[0];
        if (!file) return;

        // Validasi ukuran file (maksimal 2 MB = 2 * 1024 * 1024 bytes)
        const maxSize = 2 * 1024 * 1024;
        if (file.size > maxSize) {
            alert('Ukuran file terlalu besar! Maksimal ukuran file adalah 2 MB.');
            fileInput.value = '';
            return;
        }

        selectedFile = file;
        previewImg.src = URL.createObjectURL(file);
        previewFilename.textContent = file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)';
        previewOverlay.classList.add('open');
        fileInput.value = ''; // reset agar bisa pilih file sama lagi
    });

    btnPreviewCancel.addEventListener('click', () => {
        previewOverlay.classList.remove('open');
        selectedFile = null;
    });

    btnPreviewSend.addEventListener('click', async () => {
        if (!selectedFile) return;
        btnPreviewSend.disabled = true;
        btnPreviewSend.textContent = 'Mengunggah...';

        const formData = new FormData();
        formData.append('image', selectedFile);

        try {
            const res = await fetch('/chat-proxy/upload', {
                method: 'POST',
                body: formData
            });
            if (!res.ok) throw new Error('Upload gagal');
            const {
                imageUrl
            } = await res.json();

            // Tampilkan di UI lokal
            const now = new Date().toISOString();
            addBubble(null, 'me', now, imageUrl);

            // Kirim ke server via socket
            socket.emit('sendImageToAdmin', imageUrl);

            previewOverlay.classList.remove('open');
            selectedFile = null;
        } catch (err) {
            alert('Gagal mengunggah gambar: ' + err.message);
        } finally {
            btnPreviewSend.disabled = false;
            btnPreviewSend.textContent = 'Kirim';
        }
    });

    // --- LIGHTBOX ---
    function openLightbox(src) {
        document.getElementById('lightbox-img').src = src;
        document.getElementById('img-lightbox').classList.add('open');
    }

    function closeLightbox() {
        document.getElementById('img-lightbox').classList.remove('open');
    }
    document.getElementById('img-lightbox').addEventListener('click', function(e) {
        if (e.target === this) closeLightbox();
    });

    // Fokus otomatis ke input saat halaman dimuat
    window.addEventListener('load', () => {
        input.focus();
    });

    // Fokus kembali ke input setelah mengirim pesan
    input.addEventListener('blur', () => {
        setTimeout(() => input.focus(), 100);
    });

    $("footer").hide()
</script>


@endpush