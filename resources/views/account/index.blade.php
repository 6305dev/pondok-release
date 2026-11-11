@extends('layouts.app')
@section('content')

<div class="max-w-4xl mx-auto p-4 pb-20">
    <h1 class="text-2xl font-bold mb-4">Akun Saya</h1>

    <div class="bg-white rounded-xl shadow-sm p-5 mb-6 border border-gray-100">
        <div class="flex items-center">
            <div class="relative inline-block mr-4">
                <img src="{{ $user->avatar_url }}" 
                    alt="Foto Profil" 
                    class="rounded-full w-16 h-16 object-cover ring-2 ring-gray-200">
                <form action="{{ route('account.updateAvatar') }}" method="POST" enctype="multipart/form-data" id="avatar-form-public">
                    @csrf
                    <input type="file" name="photos" id="avatar-input-public" class="hidden" accept="image/*">
                </form>
                <button type="button" class="absolute bottom-0 right-0 bg-blue-600 text-white rounded-full p-1 shadow-md hover:bg-blue-700 transition-colors flex items-center justify-center w-6 h-6 border-2 border-white" 
                        onclick="document.getElementById('avatar-input-public').click()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                </button>
            </div>
            
            <div>
                <p class="font-semibold text-lg text-gray-800">{{ $user->name }}</p>
                <p class="text-gray-600 text-sm">NIK: {{ $user->nik }}</p>
                <p class="text-gray-600 text-sm">KK: {{ $user->kk }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-4">

        {{-- Pengaturan Akun --}}
        <a href="javascript:void(0);" id="settings-link" class="flex items-center py-3 px-4 border-b border-gray-200 hover:bg-gray-50 rounded-t-lg transition-colors">
            <span class="mr-3 text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
            </span>
            <span class="font-semibold text-gray-800">Pengaturan Akun</span>
        </a>

        <div id="settings-form" class="hidden p-4 bg-gray-50 mt-2 rounded-lg">
            <h3 class="font-semibold text-md mb-4">Ubah Data Akun</h3>
            <form action="{{ route('account.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">e-Mail</label>
                    <input type="email" name="email" id="email" value="{{ $user->email }}" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 placeholder:text-gray-400 hover:shadow-md"
                        required>
                    @error('email')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor WhatsApp</label>
                    <input type="tel" name="phone" id="phone" value="{{ $user->phone }}" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 placeholder:text-gray-400 hover:shadow-md"
                        required>
                    @error('phone')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-start">
                    <button type="submit" class="inline-flex justify-center py-2.5 px-6 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:-translate-y-0.5 hover:scale-105">
                        Simpan
                    </button>
                </div>
            </form>
        </div>

        {{-- Ubah Password --}}
        <a href="javascript:void(0);" id="change-password-link" class="flex items-center py-3 px-4 border-b border-gray-200 hover:bg-gray-50 transition-colors">
            <span class="mr-3 text-red-600">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M6.94318 11h-.85227l.96023-2.90909h1.07954L9.09091 11h-.85227l-.63637-2.10795h-.02272L6.94318 11Zm-.15909-1.14773h1.60227v.59093H6.78409v-.59093ZM9.37109 11V8.09091h1.25571c.2159 0 .4048.04261.5667.12784.162.08523.2879.20502.3779.35937.0899.15436.1349.33476.1349.5412 0 .20833-.0464.38873-.1392.54119-.0918.15246-.2211.26989-.3878.35229-.1657.0824-.3593.1236-.5809.1236h-.75003v-.61367h.59093c.0928 0 .1719-.0161.2372-.0483.0663-.03314.1169-.08002.152-.14062.036-.06061.054-.13211.054-.21449 0-.08334-.018-.15436-.054-.21307-.0351-.05966-.0857-.10511-.152-.13636-.0653-.0322-.1444-.0483-.2372-.0483h-.2784V11h-.78981Zm3.41481-2.90909V11h-.7898V8.09091h.7898Z"/>
                    <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M8.31818 2c-.55228 0-1 .44772-1 1v.72878c-.06079.0236-.12113.04809-.18098.07346l-.55228-.53789c-.38828-.37817-1.00715-.37817-1.39543 0L3.30923 5.09564c-.19327.18824-.30229.44659-.30229.71638 0 .26979.10902.52813.30229.71637l.52844.51468c-.01982.04526-.03911.0908-.05785.13662H3c-.55228 0-1 .44771-1 1v2.58981c0 .5523.44772 1 1 1h.77982c.01873.0458.03802.0914.05783.1366l-.52847.5147c-.19327.1883-.30228.4466-.30228.7164 0 .2698.10901.5281.30228.7164l1.88026 1.8313c.38828.3781 1.00715.3781 1.39544 0l.55228-.5379c.05987.0253.12021.0498.18102.0734v.7288c0 .5523.44772 1 1 1h2.65912c.5523 0 1-.4477 1-1v-.7288c.1316-.0511.2612-.1064.3883-.1657l.5435.2614v.4339c0 .5523.4477 1 1 1H14v.0625c0 .5523.4477 1 1 1h.0909v.0625c0 .5523.4477 1 1 1h.6844l.4952.4823c1.1648 1.1345 3.0214 1.1345 4.1863 0l.2409-.2347c.1961-.191.3053-.454.3022-.7277-.0031-.2737-.1183-.5342-.3187-.7207l-6.2162-5.7847c.0173-.0398.0342-.0798.0506-.12h.7799c.5522 0 1-.4477 1-1V8.17969c0-.55229-.4478-1-1-1h-.7799c-.0187-.04583-.038-.09139-.0578-.13666l.5284-.51464c.1933-.18824.3023-.44659.3023-.71638 0-.26979-.109-.52813-.3023-.71637l-1.8803-1.8313c-.3883-.37816-1.0071-.37816-1.3954 0l-.5523.53788c-.0598-.02536-.1201-.04985-.1809-.07344V3c0-.55228-.4477-1-1-1H8.31818Z"/>
                </svg>
            </span>
            <span class="font-semibold text-gray-800">Ubah Password</span>
        </a>

        <div id="change-password-form" class="hidden p-4 bg-gray-50 mt-2 rounded-lg">
            {{-- <h3 class="font-italic text-sm mb-4">Demi Kemamanan, Jaga Kerahasiaan Passwrord Anda !</h3> --}}
            <h3 style="
                    font-style: italic;
                    color: red;
                    font-size: 12px; /* Ukuran Huruf: 20 piksel */
                    margin-bottom: 15px; /* Jarak Bawah: 15 piksel */
                    line-height: 1.4; /* Spasi Antar Baris: 1.4 kali ukuran font */
                ">
                    Demi Kemamanan, Jaga Kerahasiaan Password Anda!
                </h3>
            <form action="{{ route('account.password.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4 relative">
                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Password Lama</label>
                    <div class="relative">
                        <input type="password" name="current_password" id="current_password" 
                               class="w-full px-4 py-2 pr-10 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 placeholder:text-gray-400 hover:shadow-md"
                               required>
                        <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600" onclick="togglePasswordVisibility('current_password')">
                            <svg id="eye-open-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577a11.217 11.217 0 0 1 4.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z" />
                                <path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0 1 15.75 12ZM12.53 15.713l-4.243-4.244a3.75 3.75 0 0 0 4.244 4.243Z" />
                                <path d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 0 0-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 0 1 6.75 12Z" />
                            </svg>
                            <svg id="eye-closed-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hidden">
                                <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    @error('current_password')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4 relative">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" 
                               class="w-full px-4 py-2 pr-10 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 placeholder:text-gray-400 hover:shadow-md"
                               required>
                        <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600" onclick="togglePasswordVisibility('password')">
                            <svg id="eye-open-new" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577a11.217 11.217 0 0 1 4.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z" />
                                <path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0 1 15.75 12ZM12.53 15.713l-4.243-4.244a3.75 3.75 0 0 0 4.244 4.243Z" />
                                <path d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 0 0-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 0 1 6.75 12Z" />
                            </svg>
                            <svg id="eye-closed-new" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hidden">
                                <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4 relative">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="password_confirmation" 
                               class="w-full px-4 py-2 pr-10 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 placeholder:text-gray-400 hover:shadow-md"
                               required>
                        <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600" onclick="togglePasswordVisibility('password_confirmation')">
                            <svg id="eye-open-confirm" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577a11.217 11.217 0 0 1 4.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z" />
                                <path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0 1 15.75 12ZM12.53 15.713l-4.243-4.244a3.75 3.75 0 0 0 4.244 4.243Z" />
                                <path d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 0 0-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 0 1 6.75 12Z" />
                            </svg>    
                            <svg id="eye-closed-confirm" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hidden">
                                <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-start">
                    <button type="submit" class="inline-flex justify-center py-2.5 px-6 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:-translate-y-0.5 hover:scale-105">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        {{-- Logout --}}
        <a href="{{ route('logout') }}" class="flex items-center py-3 px-4 border-t border-gray-200 hover:bg-gray-50 rounded-b-lg transition-colors"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <span class="mr-3 text-red-500">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 15v2a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-2M12 4v12m0-12 4 4m-4-4L8 8"/>
                </svg>
            </span>
            <span class="font-semibold text-gray-800">Logout</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const settingsLink = document.getElementById('settings-link');
        const settingsForm = document.getElementById('settings-form');
        const changePasswordLink = document.getElementById('change-password-link');
        const changePasswordForm = document.getElementById('change-password-form');

        settingsLink?.addEventListener('click', function(e) {
            e.preventDefault();
            settingsForm.classList.toggle('hidden');
            if (!settingsForm.classList.contains('hidden')) {
                changePasswordForm.classList.add('hidden');
            }
        });

        changePasswordLink?.addEventListener('click', function(e) {
            e.preventDefault();
            changePasswordForm.classList.toggle('hidden');
            if (!changePasswordForm.classList.contains('hidden')) {
                settingsForm.classList.add('hidden');
            }
        });

        const avatarInputPublic = document.getElementById('avatar-input-public');
        avatarInputPublic?.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                document.getElementById('avatar-form-public').submit();
            }
        });

        // Toggle Password Visibility
        window.togglePasswordVisibility = function(inputId) {
            const input = document.getElementById(inputId);
            const eyeOpen = document.getElementById(`eye-open-${inputId === 'current_password' ? 'current' : inputId === 'password' ? 'new' : 'confirm'}`);
            const eyeClosed = document.getElementById(`eye-closed-${inputId === 'current_password' ? 'current' : inputId === 'password' ? 'new' : 'confirm'}`);

            if (input.type === 'password') {
                input.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            } else {
                input.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            }
        };

        // SweetAlert Notifications
        @if (session('password_updated'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Password Anda berhasil diperbarui. Anda akan logout sebentar lagi...',
                timer: 2000,
                showConfirmButton: false,
                willClose: () => {
                    document.getElementById('logout-form').submit();
                }
            });
        @elseif ($errors->any())
            changePasswordForm.classList.remove('hidden');
            settingsForm.classList.add('hidden');

            let errorMsg = '';
            @foreach ($errors->all() as $error)
                errorMsg += "{{ $error }}\n";
            @endforeach

            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: errorMsg.trim(),
                confirmButtonText: 'OK'
            });
        @elseif (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false
            });
        @endif
    });
</script>

@endsection