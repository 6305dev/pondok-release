@extends('layouts.admin')
@section('title', 'Pesan Admin')

@section('content')
<style>
    /* Override padding & height bawaan layout untuk halaman ini agar full bleed/full page */
    html, body {
        height: 100%;
        overflow: hidden;
    }
    
    .content-wrapper {
        height: calc(100vh - 57px) !important; /* Tinggi dikurangi navbar (biasanya 57px) */
        overflow: hidden !important;
        display: flex;
        flex-direction: column;
    }
    
    .content {
        padding: 0 !important;
        margin: 0 !important;
        flex: 1;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .container-fluid {
        padding: 0 !important;
        margin: 0 !important;
        height: 100%;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .app-container,
    .app-container *,
    .app-container *::before,
    .app-container *::after {
        box-sizing: border-box;
    }

    :root {
        --wa-bg-app: #d1d7db;
        --wa-header-bg: #f0f2f5;
        --wa-sidebar-bg: #ffffff;
        --wa-chat-bg: #efeae2;
        --wa-bubble-me: #d9fdd3;
        --wa-bubble-user: #ffffff;
        --wa-text-primary: #111b21;
        --wa-text-secondary: #667781;
        --wa-green: #00a884;
        --wa-border: #e9edef;
    }

    /* Container aplikasi ala WhatsApp Web - Disesuaikan agar Full Page */
    .app-container {
        width: 100%;
        height: 100%;
        flex: 1;
        display: flex;
        background-color: #ffffff;
        position: relative;
        overflow: hidden;
        border: none;
        border-radius: 0;
    }

    /* ========== SIDEBAR KIRI ========== */
    #user-list-container {
        width: 350px;
        min-width: 300px;
        background-color: var(--wa-sidebar-bg);
        border-right: 1px solid var(--wa-border);
        display: flex;
        flex-direction: column;
    }

    .sidebar-header {
        height: 60px;
        background-color: var(--wa-header-bg);
        padding: 10px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid var(--wa-border);
    }

    .admin-profile {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .avatar-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #6b7c85;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 1.1rem;
    }

    .sidebar-header h3 {
        font-size: 1rem;
        font-weight: 600;
        color: var(--wa-text-primary);
    }

    .sidebar-search {
        padding: 8px 12px;
        background-color: #ffffff;
        border-bottom: 1px solid var(--wa-border);
    }

    .search-box {
        background-color: #f0f2f5;
        border-radius: 8px;
        padding: 7px 12px;
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--wa-text-secondary);
        font-size: 0.9rem;
    }

    .search-input-wrapper {
        background-color: #f0f2f5;
        border-radius: 8px;
        padding: 7px 12px;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 6px;
    }

    .search-input-wrapper svg {
        flex-shrink: 0;
        color: var(--wa-text-secondary);
    }

    #search-user-input {
        border: none;
        outline: none;
        background: transparent;
        font-size: 0.875rem;
        font-family: inherit;
        color: var(--wa-text-primary);
        width: 100%;
    }

    #search-user-input::placeholder {
        color: var(--wa-text-secondary);
    }

    #user-list {
        list-style: none;
        overflow-y: auto;
        flex-grow: 1;
        padding: 0;
        margin: 0;
    }

    #user-list::-webkit-scrollbar {
        width: 6px;
    }

    #user-list::-webkit-scrollbar-thumb {
        background-color: #cccccc;
    }

    .user-item {
        display: flex;
        align-items: center;
        padding: 12px 16px;
        cursor: pointer;
        border-bottom: 1px solid var(--wa-border);
        transition: background-color 0.15s ease;
        gap: 12px;
    }

    .user-item:hover {
        background-color: #f5f6f6;
    }

    .user-item.active {
        background-color: #f0f2f5;
    }

    .user-avatar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background-color: #00a884;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.15rem;
        font-weight: 600;
        flex-shrink: 0;
    }

    .user-info {
        flex-grow: 1;
        min-width: 0; /* Penting agar text-overflow: ellipsis berfungsi */
        overflow: hidden;
    }

    .user-top {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        gap: 8px;
    }

    .user-name {
        font-size: 1rem;
        font-weight: 500;
        color: var(--wa-text-primary);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .user-time {
        font-size: 0.75rem;
        color: var(--wa-text-secondary);
        flex-shrink: 0;
    }

    .user-subtext {
        font-size: 0.8rem;
        color: var(--wa-text-secondary);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        flex-grow: 1;
    }

    .user-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 2px;
        gap: 8px;
    }

    .unread-badge {
        background-color: #25d366;
        color: #ffffff;
        font-size: 0.7rem;
        font-weight: bold;
        min-width: 19px;
        height: 19px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 4px;
        flex-shrink: 0;
        line-height: 1;
    }

    /* ========== JENDELA CHAT KANAN ========== */
    #chat-window-container {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        background-color: var(--wa-chat-bg);
        background-image: radial-gradient(#cbd5e1 0.75px, transparent 0.75px);
        background-size: 16px 16px;
        position: relative;
    }

    #chat-header {
        height: 60px;
        padding: 10px 16px;
        background-color: var(--wa-header-bg);
        border-bottom: 1px solid var(--wa-border);
        display: flex;
        align-items: center;
        gap: 12px;
        z-index: 10;
    }

    .chat-header-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #00a884;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
    }

    .chat-header-text {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .chat-header-text h4 {
        font-size: 1rem;
        font-weight: 600;
        color: var(--wa-text-primary);
        margin: 0 !important;
        padding: 0;
        line-height: 1.2;
    }

    .chat-header-text p {
        font-size: 0.75rem;
        color: var(--wa-text-secondary);
        margin: 2px 0 0 0 !important;
        padding: 0;
        line-height: 1.2;
    }

    #chat-messages {
        flex-grow: 1;
        padding: 20px 5%;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    #chat-messages::-webkit-scrollbar {
        width: 6px;
    }

    #chat-messages::-webkit-scrollbar-thumb {
        background-color: rgba(11, 20, 26, 0.2);
    }

    /* Pesan Bubble */
    .message {
        max-width: 65%;
        padding: 6px 10px 6px 10px;
        border-radius: 8px;
        font-size: 0.9375rem;
        line-height: 1.45;
        word-wrap: break-word;
        box-shadow: 0 1px 0.5px rgba(11, 20, 26, 0.13);
        position: relative;
        animation: fadeIn 0.15s ease;
        display: flex;
        flex-direction: column;
    }

    .msg-time {
        font-size: 0.6875rem;
        color: var(--wa-text-secondary);
        align-self: flex-end;
        margin-top: 2px;
        margin-left: 8px;
        user-select: none;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(4px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .message-user {
        background-color: var(--wa-bubble-user);
        align-self: flex-start;
        border-top-left-radius: 0;
        color: var(--wa-text-primary);
    }

    .message-me {
        background-color: var(--wa-bubble-me);
        align-self: flex-end;
        border-top-right-radius: 0;
        color: var(--wa-text-primary);
    }

    .message img.chat-img {
        max-width: 280px;
        max-height: 280px;
        border-radius: 6px;
        display: block;
        cursor: pointer;
        object-fit: cover;
        margin-top: 2px;
    }

    /* Area Input */
    #chat-input-area {
        min-height: 62px;
        padding: 10px 16px;
        background-color: var(--wa-header-bg);
        border-top: 1px solid var(--wa-border);
        display: flex;
        align-items: flex-end;
        gap: 10px;
    }

    #chat-input {
        flex-grow: 1;
        border: none;
        border-radius: 8px;
        padding: 10px 16px;
        font-size: 0.9375rem;
        outline: none;
        background-color: #ffffff;
        color: var(--wa-text-primary);
        font-family: inherit;
        resize: none;
        height: 42px;
        min-height: 42px;
        max-height: 120px;
        line-height: 1.4;
    }

    #upload-button,
    #send-button {
        background: none;
        border: none;
        color: #54656f;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        transition: background 0.2s;
    }

    #upload-button:hover,
    #send-button:hover {
        background-color: rgba(11, 20, 26, 0.08);
    }

    #send-button {
        color: var(--wa-green);
    }

    /* Lightbox */
    #img-lightbox {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(11, 20, 26, 0.85);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 16px;
    }

    #img-lightbox.open {
        display: flex;
    }

    #img-lightbox img {
        max-width: 90vw;
        max-height: 80vh;
        border-radius: 8px;
        object-fit: contain;
    }

    #img-lightbox button {
        background: rgba(255, 255, 255, 0.2);
        border: none;
        color: #fff;
        padding: 8px 20px;
        border-radius: 20px;
        cursor: pointer;
    }

    /* Preview Overlay */
    #upload-preview-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(11, 20, 26, 0.6);
        z-index: 8000;
        align-items: center;
        justify-content: center;
    }

    #upload-preview-overlay.open {
        display: flex;
    }

    #upload-preview-box {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 14px;
        width: 320px;
    }

    #upload-preview-box img {
        width: 100%;
        max-height: 240px;
        border-radius: 8px;
        object-fit: contain;
    }

    .preview-actions {
        display: flex;
        gap: 10px;
        width: 100%;
    }

    .preview-actions button {
        flex: 1;
        padding: 10px;
        border: none;
        border-radius: 20px;
        cursor: pointer;
        font-weight: 500;
    }

    #btn-preview-send {
        background: var(--wa-green);
        color: #fff;
    }

    #btn-preview-cancel {
        background: #e9edef;
        color: var(--wa-text-primary);
    }

    /* Responsif untuk Mobile */
    @media (max-width: 768px) {
        .app-container {
            height: calc(100vh - 110px);
            height: calc(100dvh - 110px);
        }

        #user-list-container {
            width: 100% !important;
            min-width: 100% !important;
            border-right: none;
        }

        #chat-window-container {
            width: 100% !important;
            position: absolute;
            inset: 0;
            z-index: 100;
            display: none;
        }

        .app-container.chat-active #chat-window-container {
            display: flex;
        }

        #back-button {
            display: flex !important;
            align-items: center;
            justify-content: center;
            background: none;
            border: none;
            color: var(--wa-text-secondary);
            cursor: pointer;
            padding: 8px;
            margin-right: 8px;
            border-radius: 50%;
            outline: none;
        }

        #back-button:hover {
            background-color: rgba(11, 20, 26, 0.08);
        }
    }

    #back-button {
        display: none;
    }
</style>

<div class="app-container">
    <!-- Sidebar Kiri -->
    <div id="user-list-container">
        <div class="sidebar-search">
            <div class="search-input-wrapper">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8" />
                    <line x1="21" y1="21" x2="16.65" y2="16.65" />
                </svg>
                <input type="text" id="search-user-input" placeholder="Cari nama atau ID..." autocomplete="off">
            </div>
        </div>
        <ul id="user-list">
            <!-- Daftar user akan dimuat di sini -->
        </ul>
    </div>

    <!-- Jendela Chat Kanan -->
    <div id="chat-window-container">
        <div id="chat-header">
            <button id="back-button" title="Kembali ke Daftar">
                <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
                    <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z" />
                </svg>
            </button>
            <div class="chat-header-avatar" id="header-avatar" style="display:none;">U</div>
            <div class="chat-header-text">
                <h4 id="header-title">Pilih percakapan untuk memulai</h4>
                <p id="header-subtitle"></p>
            </div>
        </div>

        <div id="chat-messages">
            <div style="text-align: center; color: #8696a0; margin-top: 50px; font-size: 0.9rem;">
                Silakan pilih salah satu user dari daftar di sebelah kiri untuk melihat pesan.
            </div>
        </div>

        <div id="chat-input-area">
            <input type="file" id="admin-file-input" accept="image/jpeg,image/png,image/webp" style="display:none;">
            <button id="upload-button" title="Kirim Gambar">
                <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
                    <path
                        d="M1.998 21.5h19.999c1.104 0 2-.896 2-2V4.5c0-1.104-.896-2-2-2H1.998c-1.104 0-2 .896-2 2v15c0 1.104.896 2 2 2zm2-16h16v13h-16v-13zm11.5 8.5l-3.5 4.5-2.5-3-3.5 4.5h14l-4.5-6z" />
                </svg>
            </button>
            <textarea id="chat-input" placeholder="Ketik balasan..." autocomplete="off" rows="1"></textarea>
            <button id="send-button" title="Kirim Pesan">
                <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
                    <path
                        d="M1.101 21.757L23.8 12.028 1.101 2.3l.011 7.912 13.623 1.816-13.623 1.817-.011 7.912z" />
                </svg>
            </button>
        </div>
    </div>
</div>

<!-- Lightbox -->
<div id="img-lightbox">
    <img id="lightbox-img" src="" alt="Gambar Penuh">
    <button onclick="closeLightbox()">✕ Tutup</button>
</div>

<!-- Preview sebelum kirim -->
<div id="upload-preview-overlay">
    <div id="upload-preview-box">
        <strong>Kirim Gambar</strong>
        <img id="preview-img" src="" alt="Preview">
        <p id="preview-filename" style="font-size: 0.8rem; color: #667781;"></p>
        <div class="preview-actions">
            <button id="btn-preview-cancel">Batal</button>
            <button id="btn-preview-send">Kirim</button>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    const userList = document.getElementById('user-list');
    const headerAvatar = document.getElementById('header-avatar');
    const headerTitle = document.getElementById('header-title');
    const headerSubtitle = document.getElementById('header-subtitle');
    const messagesDiv = document.getElementById('chat-messages');
    const input = document.getElementById('chat-input');
    const sendButton = document.getElementById('send-button');

    let currentChatUserId = null;
    let lastMessageId = 0;

    function escapeHtml(str) {
        return String(str ?? '').replace(/[&<>"']/g, s => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#39;'
        }[s]));
    }

    document.getElementById('search-user-input').addEventListener('input', function() {
        filterUsers(this.value);
    });

    function formatMsgTime(dateString) {
        if (!dateString) return new Date().toLocaleTimeString('id-ID', {
            hour: '2-digit',
            minute: '2-digit'
        });
        const date = new Date(dateString);
        return date.toLocaleTimeString('id-ID', {
            hour: '2-digit',
            minute: '2-digit'
        });
    }

    function displayMessage(content, sender, imageUrl = null, dateString = null) {
        const messageElement = document.createElement('div');
        messageElement.classList.add('message');

        if (sender === 'me') {
            messageElement.classList.add('message-me');
        } else {
            messageElement.classList.add('message-user');
        }

        if (imageUrl) {
            const img = document.createElement('img');
            img.className = 'chat-img';
            const imgSrc = imageUrl;
            img.src = imgSrc;
            img.alt = 'Gambar';
            img.loading = 'lazy';
            img.onclick = () => openLightbox(imgSrc);
            img.onload = () => {
                messagesDiv.scrollTop = messagesDiv.scrollHeight;
            };
            messageElement.appendChild(img);
        } else {
            const textSpan = document.createElement('span');
            textSpan.textContent = content;
            messageElement.appendChild(textSpan);
        }

        const timeSpan = document.createElement('span');
        timeSpan.className = 'msg-time';
        timeSpan.textContent = formatMsgTime(dateString);
        messageElement.appendChild(timeSpan);

        messagesDiv.appendChild(messageElement);
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
    }

    function formatLastDate(dateString) {
        if (!dateString) return '';
        const date = new Date(dateString);
        const now = new Date();
        const isToday = date.toDateString() === now.toDateString();
        if (isToday) {
            return date.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });
        } else {
            return date.toLocaleDateString('id-ID', {
                day: '2-digit',
                month: '2-digit'
            });
        }
    }

    let allConversations = [];

    function renderUserList(conversations) {
        userList.innerHTML = '';
        if (conversations.length === 0) {
            userList.innerHTML = '<li style="padding: 20px 16px; text-align: center; color: var(--wa-text-secondary); font-size: 0.85rem;">Tidak ada hasil ditemukan.</li>';
            return;
        }
        conversations.forEach(conv => {
            const userItem = document.createElement('li');
            userItem.className = 'user-item';
            userItem.dataset.userId = conv.user.id;
            if (conv.user.id === currentChatUserId) {
                userItem.classList.add('active');
            }

            const initial = (conv.user.name || 'U').charAt(0).toUpperCase();

            const lastMsg = conv.lastMessage || null;
            const formattedDate = lastMsg ? formatLastDate(lastMsg.createdAt) : '';
            const lastSnippet = lastMsg ? (lastMsg.imageUrl ? '📷 Gambar' : lastMsg.content) : `User ID: ${conv.user.id}`;

            const unreadCount = conv.unreadCount || 0;

            userItem.innerHTML = `
                    <div class="user-avatar">${initial}</div>
                    <div class="user-info">
                        <div class="user-top">
                            <div class="user-name">${escapeHtml(conv.user.name)}</div>
                            <div class="user-time">${formattedDate}</div>
                        </div>
                        <div class="user-bottom">
                            <div class="user-subtext">${escapeHtml(lastSnippet)}</div>
                            ${unreadCount > 0 ? `<span class="unread-badge">${unreadCount}</span>` : ''}
                        </div>
                    </div>
                `;

            userItem.onclick = () => selectUser(conv.user.id, conv.user.name);
            userList.appendChild(userItem);
        });
    }

    function filterUsers(query) {
        const q = query.trim().toLowerCase();
        if (!q) {
            renderUserList(allConversations);
            return;
        }
        const filtered = allConversations.filter(conv => {
            const nameMatch = (conv.user.name || '').toLowerCase().includes(q);
            const idMatch = String(conv.user.id).toLowerCase().includes(q);
            return nameMatch || idMatch;
        });
        renderUserList(filtered);
    }

    function updateSidebarBadges() {
        let totalUnread = 0;
        allConversations.forEach(c => {
            totalUnread += c.unreadCount || 0;
        });
        const badgeDesktop = document.getElementById('unread-pesan-badge-desktop');
        const badgeMobile = document.getElementById('unread-pesan-badge-mobile');
        if (badgeDesktop) {
            if (totalUnread > 0) {
                badgeDesktop.textContent = totalUnread;
                badgeDesktop.style.display = 'inline-block';
            } else {
                badgeDesktop.style.display = 'none';
            }
        }
        if (badgeMobile) {
            if (totalUnread > 0) {
                badgeMobile.textContent = totalUnread;
                badgeMobile.style.display = 'inline-block';
            } else {
                badgeMobile.style.display = 'none';
            }
        }
    }

    async function loadAllConversations() {
        try {
            const response = await fetch('/chat-proxy/admin-conversations');
            allConversations = await response.json();
            updateSidebarBadges();

            const currentQuery = document.getElementById('search-user-input')?.value || '';
            filterUsers(currentQuery);
        } catch (error) {
            console.error('Gagal memuat daftar percakapan:', error);
        }
    }

    async function selectUser(userId, username) {
        // Toggle view on mobile
        document.querySelector('.app-container').classList.add('chat-active');

        document.querySelectorAll('.user-item').forEach(item => {
            item.classList.remove('active');
        });

        const selectedItem = document.querySelector(`.user-item[data-user-id="${userId}"]`);
        if (selectedItem) {
            selectedItem.classList.add('active');
        }

        currentChatUserId = userId;
        lastMessageId = 0;

        // Update local count (server menandai terbaca saat thread dimuat)
        const conversation = allConversations.find(c => c.user.id === userId);
        if (conversation) {
            conversation.unreadCount = 0;
            updateSidebarBadges();
            // Re-render user list
            const currentQuery = document.getElementById('search-user-input')?.value || '';
            filterUsers(currentQuery);
        }

        headerAvatar.style.display = 'flex';
        headerAvatar.textContent = (username || 'U').charAt(0).toUpperCase();
        headerTitle.textContent = username;
        headerSubtitle.textContent = `${userId}`;

        messagesDiv.innerHTML = '';

        try {
            const response = await fetch(`/chat-proxy/conversation/${userId}`);
            const messages = await response.json();

            messages.forEach(msg => {
                if (msg.id && msg.id > lastMessageId) {
                    lastMessageId = msg.id;
                }
                const sender = msg.mine ? 'me' : 'user';
                displayMessage(msg.content, sender, msg.imageUrl, msg.createdAt);
            });

            // Scroll ke pesan terakhir setelah semua pesan di-render
            requestAnimationFrame(() => {
                messagesDiv.scrollTop = messagesDiv.scrollHeight;
            });
        } catch (error) {
            console.error('Gagal memuat percakapan:', error);
        }
    }

    async function sendMessage() {
        const content = input.value.trim();
        if (!content) return;

        if (!currentChatUserId) {
            alert('Pilih user terlebih dahulu dari daftar di sebelah kiri.');
            return;
        }

        sendButton.disabled = true;
        try {
            const response = await fetch('/chat-proxy/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    peer_id: currentChatUserId,
                    content: content
                })
            });
            if (!response.ok) throw new Error('HTTP error! status: ' + response.status);

            const msg = await response.json();
            if (msg.id && msg.id > lastMessageId) {
                lastMessageId = msg.id;
            }
            displayMessage(msg.content, 'me', msg.imageUrl, msg.createdAt);
            loadAllConversations();

            input.value = '';
            input.style.height = '42px'; // Reset height
        } catch (err) {
            alert('Gagal mengirim pesan: ' + err.message);
        } finally {
            sendButton.disabled = false;
        }
    }

    loadAllConversations();

    // Polling dijeda saat tab tidak aktif agar tidak membebani server
    let pollingPaused = document.hidden;

    document.addEventListener('visibilitychange', () => {
        pollingPaused = document.hidden;
        if (!pollingPaused) {
            pollNewMessages();
            loadAllConversations();
        }
    });

    async function pollNewMessages() {
        if (pollingPaused || !currentChatUserId) return;
        try {
            const response = await fetch(`/chat-proxy/conversation/${currentChatUserId}?after_id=` + lastMessageId);
            if (!response.ok) return;

            const messages = await response.json();
            if (messages.length === 0) return;

            messages.forEach(msg => {
                if (msg.id && msg.id > lastMessageId) {
                    lastMessageId = msg.id;
                }
                displayMessage(msg.content, msg.mine ? 'me' : 'user', msg.imageUrl, msg.createdAt);
            });
        } catch (error) {
            console.error('Gagal memuat pesan baru:', error);
        }
    }

    // Polling pesan baru untuk percakapan yang sedang terbuka
    setInterval(pollNewMessages, 5000);

    // Polling daftar percakapan (badge & pesan terakhir)
    setInterval(() => {
        if (!pollingPaused) loadAllConversations();
    }, 10000);

    sendButton.addEventListener('click', sendMessage);
    
    // Auto-resize textarea
    input.addEventListener('input', function() {
        this.style.height = '42px';
        this.style.height = Math.min(this.scrollHeight, 120) + 'px';
    });

    // Handle keydown on textarea
    input.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });

    document.getElementById('back-button').addEventListener('click', () => {
        document.querySelector('.app-container').classList.remove('chat-active');
        currentChatUserId = null;
        document.querySelectorAll('.user-item').forEach(item => {
            item.classList.remove('active');
        });
    });

    const adminFileInput = document.getElementById('admin-file-input');
    const uploadButton = document.getElementById('upload-button');
    const previewOverlay = document.getElementById('upload-preview-overlay');
    const previewImg = document.getElementById('preview-img');
    const previewFilename = document.getElementById('preview-filename');
    const btnPreviewSend = document.getElementById('btn-preview-send');
    const btnPreviewCancel = document.getElementById('btn-preview-cancel');

    let selectedFile = null;

    uploadButton.addEventListener('click', () => adminFileInput.click());

    adminFileInput.addEventListener('change', () => {
        const file = adminFileInput.files[0];
        if (!file) return;

        // Validasi ukuran file (maksimal 2 MB = 2 * 1024 * 1024 bytes)
        const maxSize = 2 * 1024 * 1024;
        if (file.size > maxSize) {
            alert('Ukuran file terlalu besar! Maksimal ukuran file adalah 2 MB.');
            adminFileInput.value = '';
            return;
        }

        selectedFile = file;
        previewImg.src = URL.createObjectURL(file);
        previewFilename.textContent = file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)';
        previewOverlay.classList.add('open');
        adminFileInput.value = '';
    });

    btnPreviewCancel.addEventListener('click', () => {
        previewOverlay.classList.remove('open');
        selectedFile = null;
    });

    btnPreviewSend.addEventListener('click', async () => {
        if (!selectedFile || !currentChatUserId) {
            alert('Pilih user terlebih dahulu sebelum mengirim gambar.');
            return;
        }
        btnPreviewSend.disabled = true;
        btnPreviewSend.textContent = 'Mengunggah...';

        const formData = new FormData();
        formData.append('image', selectedFile);

        try {
            formData.append('peer_id', currentChatUserId);
            formData.append('_token', document.querySelector('meta[name="csrf-token"]')?.content || '');

            const res = await fetch('/chat-proxy/send', {
                method: 'POST',
                body: formData
            });
            if (!res.ok) throw new Error('Gagal mengunggah (HTTP ' + res.status + ')');
            const msg = await res.json();

            if (msg.id && msg.id > lastMessageId) {
                lastMessageId = msg.id;
            }
            displayMessage(msg.content, 'me', msg.imageUrl, msg.createdAt);
            loadAllConversations();

            previewOverlay.classList.remove('open');
            selectedFile = null;
        } catch (err) {
            alert('Gagal mengunggah gambar: ' + err.message);
        } finally {
            btnPreviewSend.disabled = false;
            btnPreviewSend.textContent = 'Kirim';
        }
    });

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
</script>
@endsection