<div style="margin-bottom: 5.5rem"></div>
<footer class="fixed bottom-0 left-0 right-0 bg-white/95 backdrop-blur-md border-t border-gray-100 shadow-[0_-8px_25px_rgba(0,0,0,0.05)] z-50">
    <nav class="flex justify-around items-center h-16 text-gray-400 max-w-md mx-auto px-4 relative">
        
        {{-- Tautan Beranda --}}
        <a href="{{ route('home') }}" class="flex flex-col items-center justify-center w-14 h-full transition-all duration-200 active:scale-90
            {{ request()->routeIs('home') ? 'text-blue-600' : 'text-gray-400 hover:text-gray-600' }}"
            aria-label="Beranda">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            <span class="text-[10px] mt-1 font-bold tracking-wide">Beranda</span>
        </a>

        {{-- Tautan Lacak (Pengajuan) --}}
        <a href="{{ route('tracking.index') }}" id="pengajuan-link" class="flex flex-col items-center justify-center w-14 h-full transition-all duration-200 active:scale-90
            {{ request()->routeIs('tracking.index') ? 'text-blue-600' : 'text-gray-400 hover:text-gray-600' }}"
            aria-label="Lacak Permohonan">
            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.602 10.602Z" />
                </svg>

                {{-- Notifikasi Badge dengan Angka --}}
                @if(session('unread_count', 0) > 0)
                    <span class="absolute -top-1.5 -right-2 bg-red-600 text-white text-[9px] font-black rounded-full min-w-[16px] h-4 px-1 flex items-center justify-center border-2 border-white shadow-sm z-10 animate-pulse">
                        {{ session('unread_count') }}
                    </span>
                @endif
            </div>
            <span class="text-[10px] mt-1 font-bold tracking-wide">Lacak</span>
        </a>

        {{-- Logo Tengah (Floating Action Button) --}}
        <a href="{{ route('home') }}" class="flex items-center justify-center 
            bg-black 
            -mt-7
            w-14 h-14
            rounded-full 
            border-4 border-white
            shadow-[0_8px_16px_rgba(0,0,0,0.15)]
            transition-all duration-200 
            hover:scale-105 active:scale-90
            overflow-hidden
            z-20
        " aria-label="Beranda Utama">
            <img src="{{ asset('icon/logo4.webp') }}" alt="Logo" class="w-full h-full object-cover">
        </a>

        {{-- Tautan Pesan --}}
        <a href="{{ route('pesan.index') }}" id="chat-link" class="flex flex-col items-center justify-center w-14 h-full transition-all duration-200 active:scale-90
            {{ request()->routeIs('pesan.index') ? 'text-blue-600' : 'text-gray-400 hover:text-gray-600' }}"
            aria-label="Pesan">
            <div class="relative" id="chat-link-container">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a.75.75 0 0 1-1.074-.765 5.99 5.99 0 0 1 1.523-3.64C4.29 15.11 3 12.813 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                </svg>
            </div>
            <span class="text-[10px] mt-1 font-bold tracking-wide">Pesan</span>
        </a>

        {{-- Tautan Akun --}}
        <a href="{{ route('account.index') }}" id="akun-link" class="flex flex-col items-center justify-center w-14 h-full transition-all duration-200 active:scale-90
            {{ request()->routeIs('account.index') ? 'text-blue-600' : 'text-gray-400 hover:text-gray-600' }}"
            aria-label="Akun">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>
            <span class="text-[10px] mt-1 font-bold tracking-wide">Akun</span>
        </a>
    </nav>
</footer>

@auth
<span id="global-user-id" data-id="{{ Auth::id() }}" data-username="{{ Auth::user()->name }}" class="hidden"></span>

<script src="https://cdn.socket.io/4.7.2/socket.io.min.js"></script>
<script>
    (function() {
        const SOCKET_SERVER_URL = "{{ env('SOCKET_URL') }}";
        const userEl = document.getElementById('global-user-id');
        if (!userEl) return;

        const userId = userEl.getAttribute('data-id');
        const username = userEl.getAttribute('data-username');

        // Connect socket
        if (!window.globalUserSocket) {
            window.globalUserSocket = io(SOCKET_SERVER_URL, {
                transports: ["websocket", "polling"]
            });
            window.globalUserSocket.on('connect', () => {
                window.globalUserSocket.emit('register', {
                    id: userId,
                    username: username,
                    role: 'user'
                });
            });
        }

        async function updateClientUnreadBadge() {
            try {
                // Jika sedang berada di halaman chat, jangan tampilkan badge
                if (window.location.pathname.includes('/pesan')) {
                    const container = document.getElementById('chat-link-container');
                    if (container) {
                        const oldBadge = container.querySelector('.badge-chat-client');
                        if (oldBadge) oldBadge.remove();
                    }
                    return;
                }

                const response = await fetch(`${SOCKET_SERVER_URL}/chat/messages/unread/user/${userId}`);
                const data = await response.json();
                const count = parseInt(data.count || 0);

                const container = document.getElementById('chat-link-container');
                if (container) {
                    const oldBadge = container.querySelector('.badge-chat-client');
                    if (oldBadge) oldBadge.remove();

                    if (count > 0) {
                        const badge = document.createElement('span');
                        badge.className = 'badge-chat-client absolute -top-1.5 -right-2 bg-green-600 text-white text-[9px] font-black rounded-full min-w-[16px] h-4 px-1 flex items-center justify-center border-2 border-white shadow-sm z-10 animate-pulse';
                        badge.textContent = count;
                        container.appendChild(badge);
                    }
                }
            } catch (error) {
                console.error('Error fetching client unread count:', error);
            }
        }

        // Run on load
        document.addEventListener('DOMContentLoaded', () => {
            updateClientUnreadBadge();
        });

        // Listen for new messages
        window.globalUserSocket.on('newMessageFromAdmin', () => {
            updateClientUnreadBadge();
        });
        
        // Listen when messages are marked read
        window.globalUserSocket.on('messagesRead', () => {
            updateClientUnreadBadge();
        });
    })();
</script>
@endauth

@guest
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const protectedLinks = [
            { id: 'pengajuan-link', name: 'Lacak' },
            { id: 'chat-link', name: 'Pesan' },
            { id: 'akun-link', name: 'Akun' }
        ];

        protectedLinks.forEach(linkInfo => {
            const el = document.getElementById(linkInfo.id);
            if (el) {
                el.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (window.Swal) {
                        Swal.fire({
                            title: 'Akses Ditolak',
                            text: `Anda harus login terlebih dahulu untuk mengakses menu ${linkInfo.name}.`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Login Sekarang',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "{{ route('login') }}";
                            }
                        });
                    } else {
                        if (confirm(`Anda harus login terlebih dahulu untuk mengakses menu ${linkInfo.name}. Apakah Anda ingin login?`)) {
                            window.location.href = "{{ route('login') }}";
                        }
                    }
                });
            }
        });
    });
</script>
@endguest
