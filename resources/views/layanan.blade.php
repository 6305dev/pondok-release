@extends('layouts.app')
@section('content')
<main id="main-content" class="max-w-7xl mx-auto px-5 py-8">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Menu Layanan</h1>
        <p class="text-sm md:text-base text-gray-800 font-semibold max-w-3xl mx-auto leading-relaxed">Silahkan klik tombol <strong class="text-blue-800 font-bold">Informasi</strong> di setiap layanan yang dipilih, agar dapat memahami detail layanannya. Siapkan <strong class="text-red-800 font-bold">foto (asli)</strong> persyaratan, dan semua <strong class="text-red-800 font-bold">wajib</strong> dilengkapi.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 -m-2">
        {{-- KTP --}}
        <div class="p-2 fade-in-card">
            <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-500 ease-out border-2 border-transparent hover:shadow-xl hover:scale-[1.02] hover:border-blue-500 h-full flex flex-col justify-between">
                <div>
                    <div class="bg-blue-50 p-6 flex justify-center">
                        <img src="{{ asset('icon/ktp.webp') }}" alt="Gambar KTP-EL" class="w-32 h-32 object-contain">
                    </div>
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-2">KTP-EL</h2>
                        <p class="text-gray-800 font-semibold text-sm mb-4 leading-relaxed">Pengajuan KTP-El karena hilang, rusak, atau perubahan data</p>
                    </div>
                </div>
                <div class="px-6 pb-6">
                    <div class="flex space-x-2">
                        @guest
                            <button type="button"
                                aria-label="Informasi Layanan KTP-EL"
                                onclick="event.preventDefault(); event.stopPropagation(); showPanduanRich(
                                    'Layanan Kartu Tanda Penduduk',
                                    `
                                    <div class='p-0 sm:p-1 text-gray-800 rounded-lg text-xs sm:text-sm leading-relaxed' style='text-align: left !important'>
                                        <div class='flex flex-col items-center mb-4'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' fill='none' stroke='#1D4ED8' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'>
                                                <rect x='3' y='5' width='18' height='14' rx='2'/>
                                                <path d='M8 10h4'/>
                                                <path d='M8 14h6'/>
                                                <circle cx='17' cy='12' r='1'/>
                                            </svg>
                                            <h2 class='mt-2 text-lg font-bold text-blue-800'>Layanan KTP-EL</h2>
                                        </div>
                                        <p>KTP elektronik (KTP-el) merupakan identitas resmi penduduk Indonesia yang berbasis teknologi chip untuk menyimpan data kependudukan secara digital. Disdukcapil Tapin menyediakan layanan terkait KTP-el diantaranya penerbitan KTP-el baru bagi penduduk yang telah berusia 17 tahun atau sudah menikah, penggantian KTP-el karena hilang atau rusak, dan perubahan data KTP-el.</p><br>
                                        <p>Sebelum melakukan pengajuan permohonan, pastikan Anda telah menyiapkan lampiran foto berkas pendukung asli yang dibutuhkan (bukan fotocopy) dan pastikan foto berkas dapat terbaca dengan jelas.</p>
                                        <br>
                                        <ul class='list-disc pl-5 space-y-1 mt-2'>
                                            <li><strong>Pengajuan Baru</strong>: Lampirkan foto bukti perekaman.</li>
                                            <li><strong>Hilang</strong>: Lampirkan foto surat kehilangan dari kepolisian.</li>
                                            <li><strong>Rusak</strong>: Lampirkan foto KTP yang rusak.</li>
                                            <li><strong>Perubahan Data</strong>: Lampirkan foto KK baru yang sudah diperbarui. Data pada KTP mengikuti data pada KK. Sebelum mengajukan perubahan data KTP, pastikan data KK sudah sesuai dengan data terbaru. Golongan Darah : Lampirkan foto KK terbaru yang ada golongan darah, atau KTP lama yang sudah ada golongan darah. Golongan darah akan muncul jika di data KK sudah ada golongan darah. Jika KK belum ada golongan darah dan ingin menambahkan golongan darah pada KTP, ubah terlebih dahulu KK melalui menu Kartu Keluarga.</li>
                                        </ul>
                                        <br>
                                        <p>Selengkapnya lihat <a href='https://dukcapil.tapinkab.go.id/pelayanan/ktp-elektronik' target='_blank' rel='noopener noreferrer' aria-label='Lihat informasi lengkap KTP-EL (Buka di tab baru)' class='text-blue-800 font-bold underline'>disini</a>.</p>
                                    </div>
                                    <div class='mt-4 pt-3 border-t border-gray-200'></div>
                                    <div class='bg-gray-100 py-4 px-4 sm:px-4 rounded-md'>
                                        <div class='flex justify-between gap-2 fade-in-card'>
                                            <button type='button' aria-label='Masuk ke Akun' class='btn-masuk flex-1 px-4 py-2 h-10 bg-green-700 text-white font-bold rounded-sm hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-600'>Masuk</button>
                                            <button type='button' aria-label='Daftar Akun Baru' class='btn-daftar flex-1 px-4 py-2 h-10 bg-blue-700 text-white font-bold rounded-sm hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600'>Daftar</button>
                                        </div>
                                    </div>
                                    `,
                                    '/form_pengajuan?keterangan=KTP&judul=Kartu%20Tanda%20Penduduk&icon=ktp.webp',
                                    '/login',
                                    '/register'
                                )"
                                class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-900 border border-blue-300 text-xs font-bold rounded-md hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Informasi
                            </button>
                            <button type="button"
                                aria-label="Cek Status Permohonan KTP-EL"
                                onclick="event.preventDefault(); event.stopPropagation(); cekStatusTransaksi();"
                                class="px-4 py-2 bg-blue-700 text-white text-xs font-bold rounded-md hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all">
                                Status
                            </button>
                        @else
                            <a href="/form_pengajuan?keterangan=KTP&judul=KTP-Elektronik"
                                aria-label="Ajukan Permohonan KTP-EL"
                                class="inline-flex items-center justify-center px-4 py-2 bg-green-700 text-white text-xs font-bold rounded-md hover:bg-green-800 transition-colors focus:outline-none focus:ring-2 focus:ring-green-600">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Ajukan Permohonan
                            </a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>

        {{-- Kartu Keluarga --}}
        <div class="p-2 fade-in-card">
            <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-500 ease-out border-2 border-transparent hover:shadow-xl hover:scale-[1.02] hover:border-blue-500 h-full flex flex-col justify-between">
                <div>
                    <div class="bg-blue-50 p-6 flex justify-center">
                        <img src="{{ asset('icon/kk.webp') }}" alt="Gambar Kartu Keluarga" class="w-32 h-32 object-contain">
                    </div>
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-2">Kartu Keluarga</h2>
                        <p class="text-gray-800 font-semibold text-sm mb-4 leading-relaxed">Pengajuan perubahan data di Kartu Keluarga</p>
                    </div>
                </div>
                <div class="px-6 pb-6">
                    <div class="flex space-x-2">
                        @guest
                            <button type="button"
                                aria-label="Informasi Layanan Kartu Keluarga"
                                onclick="event.preventDefault(); event.stopPropagation(); showPanduanRich(
                                    'Layanan Kartu Keluarga',
                                    `
                                    <div class='p-0 sm:p-1 text-gray-800 rounded-lg text-xs sm:text-sm leading-relaxed' style='text-align: left !important'>
                                        <div class='flex flex-col items-center mb-4'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' fill='none' stroke='#1D4ED8' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'>
                                                <path d='m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z'/>
                                                <path d='M10 13a2 2 0 1 0 4 0'/>
                                                <path d='M10 22v-4a2 2 0 0 1 2-2h0a2 2 0 0 1 2 2v4'/>
                                            </svg>
                                            <h2 class='mt-2 text-lg font-bold text-blue-800'>Layanan Kartu Keluarga</h2>
                                        </div>
                                        <p>Layanan Kartu Keluarga dapat digunakan dalam pembaruan, perubahan data, dan pencetakan kartu keluarga sebagai dokumen resmi yang memuat data anggota keluarga.</p>
                                        <br>
                                        <p>Pastikan Anda telah menyiapkan lampiran foto berkas pendukung asli yang dibutuhkan (bukan fotocopy) dan pastikan foto berkas dapat terbaca dengan jelas.</p>
                                        <ul class='list-disc pl-5 space-y-1 mt-2'>
                                            <li><strong>Perubahan Data</strong> : Melampirkan foto bukti pendukung asli berwarna dan Formulir Perubahan Data (F-1.06).</li>
                                            <li><strong>Hilang</strong> : Melampirkan foto surat kehilangan dari Kepolisian.</li>
                                            <li><strong>Rusak</strong> : Melampirkan foto KK yang rusak.</li>
                                        </ul>
                                        <br>
                                        <p>Selengkapnya mengenai tata cara dan persyaratan pengajuan layanan Kartu Keluarga, dapat dilihat <a href='https://dukcapil.tapinkab.go.id/pelayanan/kartu-keluarga' target='_blank' rel='noopener noreferrer' aria-label='Lihat informasi lengkap Kartu Keluarga (Buka di tab baru)' class='text-blue-800 font-bold underline'>disini</a>.</p>
                                        <br>
                                        <p>Silahkan masuk atau daftar aplikasi untuk melanjutkan proses pengajuan permohonan administrasi kependudukan. Semua formulir kependudukan dapat diunduh <a href='https://pondok.dukcapil.tapinkab.go.id/formulir' target='_blank' rel='noopener noreferrer' aria-label='Unduh semua formulir kependudukan (Buka di tab baru)' class='text-blue-800 font-bold underline'>disini</a>.</p>
                                    </div>
                                    <div class='mt-4 pt-3 border-t border-gray-200'></div>
                                    <div class='bg-gray-100 py-4 px-4 sm:px-4 rounded-md'>
                                        <div class='flex justify-between gap-2 fade-in-card'>
                                            <button type='button' aria-label='Masuk ke Akun' class='btn-masuk flex-1 px-4 py-2 h-10 bg-green-700 text-white font-bold rounded-sm hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-600'>Masuk</button>
                                            <button type='button' aria-label='Daftar Akun Baru' class='btn-daftar flex-1 px-4 py-2 h-10 bg-blue-700 text-white font-bold rounded-sm hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600'>Daftar</button>
                                        </div>
                                    </div>
                                    `,
                                    '/form_pengajuan?keterangan=KK&judul=Kartu%20Keluarga&icon=kk.webp',
                                    '/login',
                                    '/register'
                                )"
                                class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-900 border border-blue-300 text-xs font-bold rounded-md hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Informasi
                            </button>
                            <button type="button"
                                aria-label="Cek Status Permohonan Kartu Keluarga"
                                onclick="event.preventDefault(); event.stopPropagation(); cekStatusTransaksi();"
                                class="px-4 py-2 bg-blue-700 text-white text-xs font-bold rounded-md hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all">
                                Status
                            </button>
                        @else
                            <a href="/form_pengajuan?keterangan=KK&judul=Kartu%20Keluarga&icon=kk.png"
                                aria-label="Ajukan Permohonan Kartu Keluarga"
                                class="inline-flex items-center justify-center px-4 py-2 bg-green-700 text-white text-xs font-bold rounded-md hover:bg-green-800 transition-colors focus:outline-none focus:ring-2 focus:ring-green-600">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Ajukan Permohonan
                            </a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>

        {{-- KIA --}}
        <div class="p-2 fade-in-card">
            <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-500 ease-out border-2 border-transparent hover:shadow-xl hover:scale-[1.02] hover:border-blue-500 h-full flex flex-col justify-between">
                <div>
                    <div class="bg-blue-50 p-6 flex justify-center">
                        <img src="{{ asset('icon/kia.webp') }}" alt="Gambar Kartu Identitas Anak" class="w-32 h-32 object-contain">
                    </div>
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-2">KIA</h2>
                        <p class="text-gray-800 font-semibold text-sm mb-4 leading-relaxed">Pengajuan KIA baru, hilang, perubahan, atau rusak</p>
                    </div>
                </div>
                <div class="px-6 pb-6">
                    <div class="flex space-x-2">
                        @guest
                            <button type="button"
                                aria-label="Informasi Layanan Kartu Identitas Anak"
                                onclick="event.preventDefault(); event.stopPropagation(); showPanduanRich(
                                    'Layanan Kartu Identitas Anak',
                                    `
                                    <div class='p-0 sm:p-1 text-gray-800 rounded-lg text-xs sm:text-sm leading-relaxed' style='text-align: left !important'>
                                        <div class='flex flex-col items-center mb-4'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' fill='none' stroke='#1D4ED8' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'>
                                                <rect x='3' y='5' width='18' height='14' rx='2'/>
                                                <circle cx='10' cy='12' r='1.5'/>
                                                <path d='M13 14c1.1 0 2-.9 2-2s-.9-2-2-2'/>
                                                <path d='M17 10h-2'/>
                                            </svg>
                                            <h2 class='mt-2 text-lg font-bold text-blue-800'>Layanan Kartu Identitas Anak</h2>
                                        </div>
                                        <p>Layanan Kartu Identitas Anak (KIA) bertujuan untuk menyediakan dokumen identitas resmi bagi anak-anak berusia 0 hingga 16 tahun yang belum memiliki KTP. Layanan mencakup pembuatan KIA baru, penggantian KIA yang hilang atau rusak, serta pembaruan data sesuai perubahan identitas anak.</p>
                                        <br>
                                        <p>Pastikan Anda telah menyiapkan lampiran foto berkas pendukung asli yang dibutuhkan (bukan fotocopy) dan pastikan foto berkas dapat terbaca dengan jelas.</p>
                                        <ul class='list-disc pl-5 space-y-1 mt-2'>
                                            <li><strong>Perubahan Data</strong> : Melampirkan foto bukti pendukung asli berwarna dan Formulir Perubahan Data (F-1.06).</li>
                                            <li><strong>Perpanjangan KIA</strong> : Melampirkan foto KIA lama.</li>
                                            <li><strong>Hilang</strong> : Melampirkan foto surat kehilangan dari Kepolisian.</li>
                                            <li><strong>Rusak</strong> : Melampirkan foto KIA yang rusak.</li>
                                        </ul>
                                        <br>
                                        <p>Selengkapnya mengenai tata cara dan persyaratan pengajuan layanan KIA, dapat dilihat <a href='https://dukcapil.tapinkab.go.id/pelayanan/kartu-identitas-anak' target='_blank' rel='noopener noreferrer' aria-label='Lihat informasi lengkap KIA (Buka di tab baru)' class='text-blue-800 font-bold underline'>disini</a>.</p>
                                        <br>
                                        <p>Silahkan masuk atau daftar aplikasi untuk melanjutkan proses pengajuan permohonan administrasi kependudukan. Semua formulir kependudukan dapat diunduh <a href='https://pondok.dukcapil.tapinkab.go.id/formulir' target='_blank' rel='noopener noreferrer' aria-label='Unduh semua formulir kependudukan (Buka di tab baru)' class='text-blue-800 font-bold underline'>disini</a>.</p>
                                    </div>
                                    <div class='mt-4 pt-3 border-t border-gray-200'></div>
                                    <div class='bg-gray-100 py-4 px-4 sm:px-4 rounded-md'>
                                        <div class='flex justify-between gap-2 fade-in-card'>
                                            <button type='button' aria-label='Masuk ke Akun' class='btn-masuk flex-1 px-4 py-2 h-10 bg-green-700 text-white font-bold rounded-sm hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-600'>Masuk</button>
                                            <button type='button' aria-label='Daftar Akun Baru' class='btn-daftar flex-1 px-4 py-2 h-10 bg-blue-700 text-white font-bold rounded-sm hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600'>Daftar</button>
                                        </div>
                                    </div>
                                    `,
                                    '/form_pengajuan?keterangan=KIA&judul=Kartu%20Identitas%20Anak&icon=kia.webp',
                                    '/login',
                                    '/register'
                                )"
                                class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-900 border border-blue-300 text-xs font-bold rounded-md hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Informasi
                            </button>
                            <button type="button"
                                aria-label="Cek Status Permohonan KIA"
                                onclick="event.preventDefault(); event.stopPropagation(); cekStatusTransaksi();"
                                class="px-4 py-2 bg-blue-700 text-white text-xs font-bold rounded-md hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all">
                                Status
                            </button>
                        @else
                            <a href="/form_pengajuan?keterangan=KIA&judul=Kartu%20Identitas%20Anak&icon=kia.png"
                                aria-label="Ajukan Permohonan KIA"
                                class="inline-flex items-center justify-center px-4 py-2 bg-green-700 text-white text-xs font-bold rounded-md hover:bg-green-800 transition-colors focus:outline-none focus:ring-2 focus:ring-green-600">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Ajukan Permohonan
                            </a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>

        {{-- Akta Kelahiran --}}
        <div class="p-2 fade-in-card">
            <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-500 ease-out border-2 border-transparent hover:shadow-xl hover:scale-[1.02] hover:border-blue-500 h-full flex flex-col justify-between">
                <div>
                    <div class="bg-blue-50 p-6 flex justify-center">
                        <img src="{{ asset('icon/akta-kelahiran.webp') }}" alt="Gambar Akta Kelahiran" class="w-32 h-32 object-contain">
                    </div>
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-2">Akta Kelahiran</h2>
                        <p class="text-gray-800 font-semibold text-sm mb-4 leading-relaxed">Pengajuan Akta kelahiran baru, hilang, perubahan, atau rusak</p>
                    </div>
                </div>
                <div class="px-6 pb-6">
                    <div class="flex space-x-2">
                        @guest
                            <button type="button"
                                aria-label="Informasi Layanan Akta Kelahiran"
                                onclick="event.preventDefault(); event.stopPropagation(); showPanduanRich(
                                    'Layanan Akta Kelahiran',
                                    `
                                    <div class='p-0 sm:p-1 text-gray-800 rounded-lg text-xs sm:text-sm leading-relaxed' style='text-align: left !important'>
                                        <div class='flex flex-col items-center mb-4'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' fill='none' stroke='#1D4ED8' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'>
                                                <path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'/>
                                                <path d='M14 2v6h6'/>
                                                <path d='M12 11v6'/>
                                                <path d='M9 14h6'/>
                                            </svg>
                                            <h2 class='mt-2 text-lg font-bold text-blue-800'>Layanan Akta Kelahiran</h2>
                                        </div>
                                        <p>Layanan Akta Kelahiran menyediakan dokumen legal yang mencatat kelahiran seseorang sebagai bentuk pengakuan resmi dari pemerintah. Akta kelahiran merupakan dokumen dasar dalam administrasi kependudukan yang penting untuk berbagai keperluan, seperti pendidikan, kesehatan, pekerjaan, dan perjalanan. Akta Kelahiran dirancang untuk memastikan hak identitas setiap warga negara tercatat dan diakui secara sah.</p>
                                        <br>
                                        <p>Pastikan Anda telah menyiapkan lampiran foto berkas pendukung asli yang dibutuhkan (bukan fotocopy) dan pastikan foto berkas dapat terbaca dengan jelas.</p>
                                        <ul class='list-disc pl-5 space-y-1 mt-2'>
                                            <li><strong>Pengajuan Akta Kelahiran</strong> : Melampirkan foto bukti pendukung asli berwarna.</li>
                                            <li><strong>Perubahan Data Akta</strong> : Melampirkan foto bukti pendukung asli berwarna dan Formulir Perubahan Data (F-1.06).</li>
                                            <li><strong>Hilang</strong> : Melampirkan foto surat kehilangan dari Kepolisian.</li>
                                            <li><strong>Rusak</strong> : Melampirkan foto Akta yang rusak.</li>
                                        </ul>
                                        <br>
                                        <p>Selengkapnya mengenai tata cara dan persyaratan pengajuan layanan Akta Kelahiran, dapat dilihat <a href='https://dukcapil.tapinkab.go.id/pelayanan/akta-kelahiran' target='_blank' rel='noopener noreferrer' aria-label='Lihat informasi lengkap Akta Kelahiran (Buka di tab baru)' class='text-blue-800 font-bold underline'>disini</a>.</p>
                                        <br>
                                        <p>Silahkan masuk atau daftar aplikasi untuk melanjutkan proses pengajuan permohonan administrasi kependudukan. Semua formulir kependudukan dapat diunduh <a href='https://pondok.dukcapil.tapinkab.go.id/formulir' target='_blank' rel='noopener noreferrer' aria-label='Unduh semua formulir kependudukan (Buka di tab baru)' class='text-blue-800 font-bold underline'>disini</a>.</p>
                                    </div>
                                    <div class='mt-4 pt-3 border-t border-gray-200'></div>
                                    <div class='bg-gray-100 py-4 px-4 sm:px-4 rounded-md'>
                                        <div class='flex justify-between gap-2 fade-in-card'>
                                            <button type='button' aria-label='Masuk ke Akun' class='btn-masuk flex-1 px-4 py-2 h-10 bg-green-700 text-white font-bold rounded-sm hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-600'>Masuk</button>
                                            <button type='button' aria-label='Daftar Akun Baru' class='btn-daftar flex-1 px-4 py-2 h-10 bg-blue-700 text-white font-bold rounded-sm hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600'>Daftar</button>
                                        </div>
                                    </div>
                                    `,
                                    '/form_pengajuan?keterangan=ALH&judul=Akta%20Kelahiran&icon=akta-kelahiran.webp',
                                    '/login',
                                    '/register'
                                )"
                                class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-900 border border-blue-300 text-xs font-bold rounded-md hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Informasi
                            </button>
                            <button type="button"
                                aria-label="Cek Status Permohonan Akta Kelahiran"
                                onclick="event.preventDefault(); event.stopPropagation(); cekStatusTransaksi();"
                                class="px-4 py-2 bg-blue-700 text-white text-xs font-bold rounded-md hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all">
                                Status
                            </button>
                        @else
                            <a href="/form_pengajuan?keterangan=ALH&judul=Akta%20Kelahiran&icon=akta-kelahiran.png"
                                aria-label="Ajukan Permohonan Akta Kelahiran"
                                class="inline-flex items-center justify-center px-4 py-2 bg-green-700 text-white text-xs font-bold rounded-md hover:bg-green-800 transition-colors focus:outline-none focus:ring-2 focus:ring-green-600">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Ajukan Permohonan
                            </a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>

        {{-- Akta Kematian --}}
        <div class="p-2 fade-in-card">
            <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-500 ease-out border-2 border-transparent hover:shadow-xl hover:scale-[1.02] hover:border-blue-500 h-full flex flex-col justify-between">
                <div>
                    <div class="bg-blue-50 p-6 flex justify-center">
                        <img src="{{ asset('icon/akta-kematian.webp') }}" alt="Gambar Akta Kematian" class="w-32 h-32 object-contain">
                    </div>
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-2">Akta Kematian</h2>
                        <p class="text-gray-800 font-semibold text-sm mb-4 leading-relaxed">Pengajuan Akta kematian baru, hilang, perubahan, atau rusak</p>
                    </div>
                </div>
                <div class="px-6 pb-6">
                    <div class="flex space-x-2">
                        @guest
                            <button type="button"
                                aria-label="Informasi Layanan Akta Kematian"
                                onclick="event.preventDefault(); event.stopPropagation(); showPanduanRich(
                                    'Layanan Akta Kematian',
                                    `
                                    <div class='p-0 sm:p-1 text-gray-800 rounded-lg text-xs sm:text-sm leading-relaxed' style='text-align: left !important'>
                                        <div class='flex flex-col items-center mb-4'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' fill='none' stroke='#1D4ED8' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'>
                                                <path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'/>
                                                <path d='M14 2v6h6'/>
                                                <path d='M8 15h8'/>
                                            </svg>
                                            <h2 class='mt-2 text-lg font-bold text-blue-800'>Layanan Akta Kematian</h2>
                                        </div>
                                        <p>Layanan akta kematian adalah proses administratif yang bertujuan untuk mencatat dan mengesahkan kematian seseorang oleh pihak berwenang. Akta kematian digunakan sebagai bukti sah atas kematian seseorang untuk berbagai keperluan hukum dan administratif.</p>
                                        <br>
                                        <p>Pastikan Anda telah menyiapkan lampiran foto berkas pendukung asli yang dibutuhkan (bukan fotocopy) dan pastikan foto berkas dapat terbaca dengan jelas.</p>
                                        <ul class='list-disc pl-5 space-y-1 mt-2'>
                                            <li><strong>Pengajuan Akta Kematian</strong> : Melampirkan foto bukti pendukung asli berwarna.</li>
                                            <li><strong>Hilang</strong> : Melampirkan foto surat kehilangan dari Kepolisian.</li>
                                            <li><strong>Rusak</strong> : Melampirkan foto Akta Kematian yang rusak.</li>
                                        </ul>
                                        <br>
                                        <p>Selengkapnya mengenai tata cara dan persyaratan pengajuan layanan Akta Kematian, dapat dilihat <a href='https://dukcapil.tapinkab.go.id/pelayanan/akta-kematian' target='_blank' rel='noopener noreferrer' aria-label='Lihat informasi lengkap Akta Kematian (Buka di tab baru)' class='text-blue-800 font-bold underline'>disini</a>.</p>
                                        <br>
                                        <p>Silahkan masuk atau daftar aplikasi untuk melanjutkan proses pengajuan permohonan administrasi kependudukan. Semua formulir kependudukan dapat diunduh <a href='https://pondok.dukcapil.tapinkab.go.id/formulir' target='_blank' rel='noopener noreferrer' aria-label='Unduh semua formulir kependudukan (Buka di tab baru)' class='text-blue-800 font-bold underline'>disini</a>.</p>
                                    </div>
                                    <div class='mt-4 pt-3 border-t border-gray-200'></div>
                                    <div class='bg-gray-100 py-4 px-4 sm:px-4 rounded-md'>
                                        <div class='flex justify-between gap-2 fade-in-card'>
                                            <button type='button' aria-label='Masuk ke Akun' class='btn-masuk flex-1 px-4 py-2 h-10 bg-green-700 text-white font-bold rounded-sm hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-600'>Masuk</button>
                                            <button type='button' aria-label='Daftar Akun Baru' class='btn-daftar flex-1 px-4 py-2 h-10 bg-blue-700 text-white font-bold rounded-sm hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600'>Daftar</button>
                                        </div>
                                    </div>
                                    `,
                                    '/form_pengajuan?keterangan=AMT&judul=Akta%20Kematian&icon=akta-kematian.webp',
                                    '/login',
                                    '/register'
                                )"
                                class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-900 border border-blue-300 text-xs font-bold rounded-md hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Informasi
                            </button>
                            <button type="button"
                                aria-label="Cek Status Permohonan Akta Kematian"
                                onclick="event.preventDefault(); event.stopPropagation(); cekStatusTransaksi();"
                                class="px-4 py-2 bg-blue-700 text-white text-xs font-bold rounded-md hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all">
                                Status
                            </button>
                        @else
                            <a href="/form_pengajuan?keterangan=AMT&judul=Akta%20Kematian&icon=akta-kematian.png"
                                aria-label="Ajukan Permohonan Akta Kematian"
                                class="inline-flex items-center justify-center px-4 py-2 bg-green-700 text-white text-xs font-bold rounded-md hover:bg-green-800 transition-colors focus:outline-none focus:ring-2 focus:ring-green-600">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Ajukan Permohonan
                            </a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>

        {{-- Kedatangan Penduduk --}}
        <div class="p-2 fade-in-card">
            <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-500 ease-out border-2 border-transparent hover:shadow-xl hover:scale-[1.02] hover:border-blue-500 h-full flex flex-col justify-between">
                <div>
                    <div class="bg-blue-50 p-6 flex justify-center">
                        <img src="{{ asset('icon/kedatangan.webp') }}" alt="Gambar Pindah Datang" class="w-32 h-32 object-contain">
                    </div>
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-2">Pindah Datang</h2>
                        <p class="text-gray-800 font-semibold text-sm mb-4 leading-relaxed">Pengajuan menjadi warga Tapin dengan melampirkan SKPWNI</p>
                    </div>
                </div>
                <div class="px-6 pb-6">
                    <div class="flex space-x-2">
                        @guest
                            <button type="button"
                                aria-label="Informasi Layanan Pindah Datang"
                                onclick="event.preventDefault(); event.stopPropagation(); showPanduanRich(
                                    'Layanan Kedatangan Penduduk',
                                    `
                                    <div class='p-0 sm:p-1 text-gray-800 rounded-lg text-xs sm:text-sm leading-relaxed' style='text-align: left !important'>
                                        <div class='flex flex-col items-center mb-4'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' fill='none' stroke='#1D4ED8' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'>
                                                <rect x='4' y='12' width='16' height='5' rx='1'/>
                                                <path d='M6 12V9h12v3'/>
                                                <circle cx='7' cy='19' r='1.5'/>
                                                <circle cx='17' cy='19' r='1.5'/>
                                                <path d='M18 6H6'/>
                                                <path d='M8 4l-2 2 2 2'/>
                                            </svg>
                                            <h2 class='mt-2 text-lg font-bold text-blue-800'>Persyaratan Pindah Masuk Tapin</h2>
                                        </div>
                                        <p class='font-bold text-amber-800'>A. KK ANGGOTA SENDIRI ATAU SATU KELUARGA</p>
                                        <ul class='list-disc pl-5 space-y-0 mt-1'>
                                            <li>Foto asli surat pindah/SKPWNI dari Dukcapil asal;</li>
                                            <li>Foto semua KTP lama asli;</li>
                                            <li>Foto asli Surat pernyataan tempat tinggal di Tapin bermaterai terbaru Rp.10,000 dan ditandatangani ybs, ditandatangani RT dan di beri cap RT (jika kost/kontrak/numpang alamat yang bertandatangan pemilik alamat tempat tinggal);</li>
                                            <li>Foto asli form F-1.06 perubahan elemen data dan dokumen pendukung asli perubahan data jika ada perubahan data, misal: perubahan pendidikan, pekerjaan, agama, dll contoh: pendidikan terakhir semua SLTP/Sederajat menjadi S1, maka melampirkan foto asli IJAZAH S1.</li>
                                        </ul>
                                        <br>
                                        <p class='font-bold text-amber-800'>B. PINDAH NUMPANG KK</p>
                                        <ul class='list-disc pl-5 space-y-0 mt-1'>
                                            <li>Foto asli surat pindah/SKPWNI dari Dukcapil asal;</li>
                                            <li>Foto semua KTP lama asli yang pindah;</li>
                                            <li>Foto asli KK yang akan di tumpangi, sudah ditandatangani oleh Kepala Keluarga;</li>
                                            <li>Surat Pernyataan numpang KK yang ditandatangani oleh Kepala Keluarga bermaterai dan ditandatangani (jika anak kandung tidak perlu dilampirkan);</li>
                                            <li>Foto asli form F-1.06 perubahan elemen data dan dokumen pendukung asli perubahan data jika ada perubahan data, misal: perubahan pendidikan, pekerjaan, agama, dll contoh: pendidikan terakhir semua SLTP/Sederajat menjadi S1, maka melampirkan foto asli IJAZAH S1.</li>
                                        </ul>
                                        <br>
                                        <p class='font-bold text-amber-800'>C. PINDAH MEMBUAT KK KARENA MENIKAH/SUAMI ISTRI</p>
                                        <ul class='font-bold pl-4 space-y-0 mt-1'>1. KEDUA PASANGAN DENGAN ALAMAT LUAR TAPIN</ul>
                                        <ul class='list-disc pl-12 space-y-0 mt-1'>
                                            <li>Foto asli surat pindah/SKPWNI suami dan istri dari Dukcapil asal;</li>
                                            <li>Foto KTP lama asli yang pindah;</li>
                                            <li>Foto asli Surat pernyataan tempat tinggal di Tapin bermaterai terbaru Rp.10,000 dan ditandatangani ybs, ditandatangani RT dan di beri cap RT (jika kost/kontrak/numpang alamat yang bertandatangan pemilik alamat tempat tinggal);</li>
                                            <li>Foto asli buku nikah yang ada data pengantin suami istri;</li>
                                            <li>Foto asli form F1.06 perubahan elemen data dan dokumen pendukung asli perubahan data jika ada perubahan data, misal: perubahan pendidikan, pekerjaan, agama, status pernikahan (dari belum kawin/cerai menjadi kawin tercatat) dll contoh: pendidikan terakhir semua SLTP/Sederajat menjadi S1, maka melampirkan foto asli IJAZAH S1.</li>
                                        </ul>
                                        <ul class='font-bold pl-4 space-y-0 mt-1'>2. PASANGAN DENGAN ALAMAT PROVINSI/KAB BERBEDA</ul>
                                        <ul class='list-disc pl-12 space-y-0 mt-1'>
                                            <li>Foto asli surat pindah/SKPWNI dari Dukcapil asal;</li>
                                            <li>Foto KTP lama asli yang pindah;</li>
                                            <li>Foto asli buku nikah yang ada data pengantin suami istri;</li>
                                            <li>Foto KK asli Tapin yang sudah ditandatangani Kepala Keluarga (jika alamat tujuan di surat-pindah dan KK Tapin-nya sama);</li>
                                            <li>Foto asli form F1.06 perubahan elemen data dan dokumen pendukung asli perubahan data jika ada perubahan data, misal: perubahan pendidikan, pekerjaan, agama, status pernikahan (dari belum kawin/cerai menjadi kawin tercatat) dll contoh: pendidikan terakhir semua SLTP/Sederajat menjadi S1, maka melampirkan foto asli IJAZAH S1.</li>
                                            <li>Foto asli Surat pernyataan tempat tinggal di Tapin bermaterai terbaru Rp.10,000 dan ditandatangani ybs, ditandatangani RT dan di beri cap RT (jika kost/kontrak/numpang alamat yang bertandatangan pemilik alamat tempat tinggal);</li>
                                            <li>Mendapatkan KK suami istri dan KK orangtua (jika KK lama masih menjadi satu dengan orangtua);</li>
                                        </ul>
                                        <br>
                                        <p>Semua format formulir yang dibutuhkan, dapat diunduh <a href='https://pondok.dukcapil.tapinkab.go.id/formulir' target='_blank' rel='noopener noreferrer' aria-label='Unduh semua formulir kependudukan (Buka di tab baru)' class='text-blue-800 font-bold underline'>disini</a>.</p>
                                    </div>
                                    <div class='mt-4 pt-3 border-t border-gray-200'></div>
                                    <div class='bg-gray-100 py-4 px-4 sm:px-4 rounded-md'>
                                        <div class='flex justify-between gap-2 fade-in-card'>
                                            <button type='button' aria-label='Masuk ke Akun' class='btn-masuk flex-1 px-4 py-2 h-10 bg-green-700 text-white font-bold rounded-sm hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-600'>Masuk</button>
                                            <button type='button' aria-label='Daftar Akun Baru' class='btn-daftar flex-1 px-4 py-2 h-10 bg-blue-700 text-white font-bold rounded-sm hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600'>Daftar</button>
                                        </div>
                                    </div>
                                    `,
                                    '/form_pengajuan?keterangan=DTG&judul=Lapor%20Kedatangan&icon=kedatangan.webp',
                                    '/login',
                                    '/register'
                                )"
                                class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-900 border border-blue-300 text-xs font-bold rounded-md hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Informasi
                            </button>
                            <button type="button"
                                aria-label="Cek Status Permohonan Pindah Datang"
                                onclick="event.preventDefault(); event.stopPropagation(); cekStatusTransaksi();"
                                class="px-4 py-2 bg-blue-700 text-white text-xs font-bold rounded-md hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all">
                                Status
                            </button>
                        @else
                            <a href="/form_pengajuan?keterangan=DTG&judul=Lapor%20Kedatangan&icon=kedatangan.png"
                                aria-label="Ajukan Permohonan Pindah Datang"
                                class="inline-flex items-center justify-center px-4 py-2 bg-green-700 text-white text-xs font-bold rounded-md hover:bg-green-800 transition-colors focus:outline-none focus:ring-2 focus:ring-green-600">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Ajukan Permohonan
                            </a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>

        {{-- Pindah Keluar --}}
        <div class="p-2 fade-in-card">
            <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-500 ease-out border-2 border-transparent hover:shadow-xl hover:scale-[1.02] hover:border-blue-500 h-full flex flex-col justify-between">
                <div>
                    <div class="bg-blue-50 p-6 flex justify-center">
                        <img src="{{ asset('icon/pindah.webp') }}" alt="Gambar Pindah Keluar" class="w-32 h-32 object-contain">
                    </div>
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-2">Pindah Keluar</h2>
                        <p class="text-gray-800 font-semibold text-sm mb-4 leading-relaxed">Pengajuan pindah menjadi warga kabupaten lain diluar Tapin</p>
                    </div>
                </div>
                <div class="px-6 pb-6">
                    <div class="flex space-x-2">
                        @guest
                            <button type="button"
                                aria-label="Informasi Layanan Pindah Keluar"
                                onclick="event.preventDefault(); event.stopPropagation(); showPanduanRich(
                                    'Layanan Perpindahan Penduduk',
                                    `
                                    <div class='p-0 sm:p-1 text-gray-800 rounded-lg text-xs sm:text-sm leading-relaxed' style='text-align: left !important'>
                                        <div class='flex flex-col items-center mb-4'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' fill='none' stroke='#1D4ED8' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'>
                                                <rect x='4' y='12' width='16' height='5' rx='1'/>
                                                <path d='M6 12V9h12v3'/>
                                                <circle cx='7' cy='19' r='1.5'/>
                                                <circle cx='17' cy='19' r='1.5'/>
                                                <path d='M6 6h12'/>
                                                <path d='M16 4l2 2-2 2'/>
                                            </svg>
                                            <h2 class='mt-2 text-lg font-bold text-blue-800'>Layanan Pindah Keluar</h2>
                                        </div>
                                        <p>Layanan Pindah Keluar merupakan Layanan pindah keluar dalam konteks administrasi kependudukan adalah proses administratif yang dilakukan oleh penduduk ketika mereka hendak pindah dari satu wilayah ke wilayah lain. Layanan ini dikelola oleh instansi pemerintah, seperti Dinas Kependudukan dan Catatan Sipil (Disdukcapil), dengan tujuan untuk mencatat perpindahan penduduk secara resmi dan memastikan data kependudukan tetap akurat.</p>
                                        <br>
                                        <p>Pastikan Anda telah menyiapkan lampiran foto berkas pendukung asli yang dibutuhkan (bukan fotocopy) dan astikan foto berkas dapat terbaca dengan jelas, diantaranya.</p>
                                        <ul class='list-disc pl-5 space-y-1 mt-2'>
                                            <li>KK dan KTP Tapin, bagi anak di bawah umur wajib melampirkan surat persetujuan dari kepala keluarga dan KK tujuan, serta pernyataan persetujuan dari kepala keluarga KK yang akan ditumpangi.</li>
                                            <li>Alamat lengkap tujuan pindah, termasuk nomor RT dan Kodepos. Data yang tidak lengkap akan mengakibatkan permohonan ditolak.</li>
                                        </ul>
                                        <br>
                                        <p>Selengkapnya mengenai tata cara dan persyaratan pengajuan layanan Pindah Keluar, dapat dilihat <a href='https://dukcapil.tapinkab.go.id/pelayanan/skpwni' target='_blank' rel='noopener noreferrer' aria-label='Lihat informasi lengkap Pindah Keluar (Buka di tab baru)' class='text-blue-800 font-bold underline'>disini</a>.</p>
                                        <br>
                                        <p>Silahkan masuk atau daftar aplikasi untuk melanjutkan proses pengajuan permohonan administrasi kependudukan. Semua formulir kependudukan dapat diunduh <a href='https://pondok.dukcapil.tapinkab.go.id/formulir' target='_blank' rel='noopener noreferrer' aria-label='Unduh semua formulir kependudukan (Buka di tab baru)' class='text-blue-800 font-bold underline'>disini</a>.</p>
                                    </div>
                                    <div class='mt-4 pt-3 border-t border-gray-200'></div>
                                    <div class='bg-gray-100 py-4 px-4 sm:px-4 rounded-md'>
                                        <div class='flex justify-between gap-2 fade-in-card'>
                                            <button type='button' aria-label='Masuk ke Akun' class='btn-masuk flex-1 px-4 py-2 h-10 bg-green-700 text-white font-bold rounded-sm hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-600'>Masuk</button>
                                            <button type='button' aria-label='Daftar Akun Baru' class='btn-daftar flex-1 px-4 py-2 h-10 bg-blue-700 text-white font-bold rounded-sm hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600'>Daftar</button>
                                        </div>
                                    </div>
                                    `,
                                    '/form_pengajuan?keterangan=PDH&judul=Lapor%20Perpindahan&icon=pindah.webp',
                                    '/login',
                                    '/register'
                                )"
                                class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-900 border border-blue-300 text-xs font-bold rounded-md hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Informasi
                            </button>
                            <button type="button"
                                aria-label="Cek Status Permohonan Pindah Keluar"
                                onclick="event.preventDefault(); event.stopPropagation(); cekStatusTransaksi();"
                                class="px-4 py-2 bg-blue-700 text-white text-xs font-bold rounded-md hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all">
                                Status
                            </button>
                        @else
                            <a href="/form_pengajuan?keterangan=PDH&judul=Lapor%20Perpindahan&icon=pindah.png"
                                aria-label="Ajukan Permohonan Pindah Keluar"
                                class="inline-flex items-center justify-center px-4 py-2 bg-green-700 text-white text-xs font-bold rounded-md hover:bg-green-800 transition-colors focus:outline-none focus:ring-2 focus:ring-green-600">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Ajukan Permohonan
                            </a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>

        {{-- Akta Perkawinan --}}
        <div class="p-2 fade-in-card">
            <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-500 ease-out border-2 border-transparent hover:shadow-xl hover:scale-[1.02] hover:border-blue-500 h-full flex flex-col justify-between">
                <div>
                    <div class="bg-blue-50 p-6 flex justify-center">
                        <img src="{{ asset('icon/perkawinan.webp') }}" alt="Gambar Akta Perkawinan" class="w-32 h-32 object-contain">
                    </div>
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-2">Akta Perkawinan</h2>
                        <p class="text-gray-800 font-semibold text-sm mb-4 leading-relaxed">Pengajuan akta perkawinan bagi Non Muslim</p>
                    </div>
                </div>
                <div class="px-6 pb-6">
                    <div class="flex space-x-2">
                        @guest
                            <button type="button"
                                aria-label="Informasi Layanan Akta Perkawinan"
                                onclick="event.preventDefault(); event.stopPropagation(); showPanduanRich(
                                    'Layanan Akta Perkawinan',
                                    `
                                    <div class='p-0 sm:p-1 text-gray-800 rounded-lg text-xs sm:text-sm leading-relaxed' style='text-align: left !important'>
                                        <div class='flex flex-col items-center mb-4'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' fill='none' stroke='#1D4ED8' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'>
                                                <path d='M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z'/>
                                            </svg>
                                            <h2 class='mt-2 text-lg font-bold text-blue-800'>Layanan Akta Perkawinan</h2>
                                        </div>
                                        <p>Layanan Akta Perkawinan merupakan layanan pencatatan secara resmi oleh pemerintah atas suatu pernikahan yang telah berlangsung bagi warga Tapin yang beragama non-muslim, sehingga dapat diakui secara hukum. Akta ini dikeluarkan oleh instansi yang berwenang, seperti Dinas Kependudukan dan Pencatatan Sipil (Disdukcapil), dan berfungsi sebagai bukti legal bahwa pernikahan tersebut telah sah secara administrasi. Bagi warga yang beragama Islam tidak perlu mengajukan akta perkawinan karena pencatatan perkawinan dilakukan di KUA.</p>
                                        <br>
                                        <p>Pastikan Anda telah menyiapkan lampiran foto berkas pendukung asli yang dibutuhkan (bukan fotocopy) dan astikan foto berkas dapat terbaca dengan jelas.</p>
                                        <ul class='list-disc pl-5 space-y-1 mt-2'>
                                            <li><strong>Pengajuan Akta Perkawinan</strong> : Melampirkan foto bukti pendukung asli berwarna.</li>
                                            <li><strong>Hilang</strong> : Melampirkan foto surat kehilangan dari Kepolisian.</li>
                                            <li><strong>Rusak</strong> : Melampirkan foto Akta Perkawinan yang rusak.</li>
                                        </ul>
                                        <br>
                                        <p>Selengkapnya mengenai tata cara dan persyaratan pengajuan layanan Akta Perkawinan, dapat dilihat <a href='https://dukcapil.tapinkab.go.id/pelayanan/akta-perkawinan' target='_blank' rel='noopener noreferrer' aria-label='Lihat informasi lengkap Akta Perkawinan (Buka di tab baru)' class='text-blue-800 font-bold underline'>disini</a>.</p>
                                        <br>
                                        <p>Silahkan masuk atau daftar aplikasi untuk melanjutkan proses pengajuan permohonan administrasi kependudukan. Semua formulir kependudukan dapat diunduh <a href='https://pondok.dukcapil.tapinkab.go.id/formulir' target='_blank' rel='noopener noreferrer' aria-label='Unduh semua formulir kependudukan (Buka di tab baru)' class='text-blue-800 font-bold underline'>disini</a>.</p>
                                    </div>
                                    <div class='mt-4 pt-3 border-t border-gray-200'></div>
                                    <div class='bg-gray-100 py-4 px-4 sm:px-4 rounded-md'>
                                        <div class='flex justify-between gap-2 fade-in-card'>
                                            <button type='button' aria-label='Masuk ke Akun' class='btn-masuk flex-1 px-4 py-2 h-10 bg-green-700 text-white font-bold rounded-sm hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-600'>Masuk</button>
                                            <button type='button' aria-label='Daftar Akun Baru' class='btn-daftar flex-1 px-4 py-2 h-10 bg-blue-700 text-white font-bold rounded-sm hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600'>Daftar</button>
                                        </div>
                                    </div>
                                    `,
                                    '/form_pengajuan?keterangan=AKW&judul=Akta%20Perkawinan&icon=perkawinan.webp',
                                    '/login',
                                    '/register'
                                )"
                                class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-900 border border-blue-300 text-xs font-bold rounded-md hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Informasi
                            </button>
                            <button type="button"
                                aria-label="Cek Status Permohonan Akta Perkawinan"
                                onclick="event.preventDefault(); event.stopPropagation(); cekStatusTransaksi();"
                                class="px-4 py-2 bg-blue-700 text-white text-xs font-bold rounded-md hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all">
                                Status
                            </button>
                        @else
                            <a href="/form_pengajuan?keterangan=AKW&judul=Akta%20Perkawinan&icon=perkawinan.png"
                                aria-label="Ajukan Permohonan Akta Perkawinan"
                                class="inline-flex items-center justify-center px-4 py-2 bg-green-700 text-white text-xs font-bold rounded-md hover:bg-green-800 transition-colors focus:outline-none focus:ring-2 focus:ring-green-600">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Ajukan Permohonan
                            </a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>

        {{-- Akta Perceraian --}}
        <div class="p-2 fade-in-card">
            <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-500 ease-out border-2 border-transparent hover:shadow-xl hover:scale-[1.02] hover:border-blue-500 h-full flex flex-col justify-between">
                <div>
                    <div class="bg-blue-50 p-6 flex justify-center">
                        <img src="{{ asset('icon/perceraian.webp') }}" alt="Gambar Akta Perceraian" class="w-32 h-32 object-contain">
                    </div>
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-2">Akta Perceraian</h2>
                        <p class="text-gray-800 font-semibold text-sm mb-4 leading-relaxed">Pengajuan akta perceraian bagi Non Muslim</p>
                    </div>
                </div>
                <div class="px-6 pb-6">
                    <div class="flex space-x-2">
                        @guest
                            <button type="button"
                                aria-label="Informasi Layanan Akta Perceraian"
                                onclick="event.preventDefault(); event.stopPropagation(); showPanduanRich(
                                    'Layanan Akta Perceraian',
                                    `
                                    <div class='p-0 sm:p-1 text-gray-800 rounded-lg text-xs sm:text-sm leading-relaxed' style='text-align: left !important'>
                                        <div class='flex flex-col items-center mb-4'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' fill='none' stroke='#1D4ED8' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'>
                                                <path d='M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z'/>
                                                <path d='M9 9l6 6'/>
                                                <path d='M15 9l-6 6'/>
                                            </svg>
                                            <h2 class='mt-2 text-lg font-bold text-blue-800'>Layanan Akta Perceraian</h2>
                                        </div>
                                        <p>Layanan Akta Perceraian merupakan layanan proses pencatatan resmi oleh pemerintah atas perceraian yang telah disahkan oleh pengadilan. Akta ini dikeluarkan oleh instansi terkait, seperti Dinas Kependudukan dan Pencatatan Sipil (Disdukcapil), dan berfungsi sebagai bukti hukum yang sah atas perpisahan pasangan suami istri.</p>
                                        <br>
                                        <p>Pastikan Anda telah menyiapkan lampiran foto berkas pendukung asli yang dibutuhkan (bukan fotocopy) dan astikan foto berkas dapat terbaca dengan jelas.</p>
                                        <ul class='list-disc pl-5 space-y-1 mt-2'>
                                            <li><strong>Pengajuan Akta Perceraian</strong> : Melampirkan foto bukti pendukung asli berwarna.</li>
                                            <li><strong>Hilang</strong> : Melampirkan foto surat kehilangan dari Kepolisian.</li>
                                            <li><strong>Rusak</strong> : Melampirkan foto Akta Perceraian yang rusak.</li>
                                        </ul>
                                        <br>
                                        <p>Selengkapnya mengenai tata cara dan persyaratan pengajuan layanan Akta Perceraian, dapat dilihat <a href='http://pondok.dukcapil.tapinkab.go.id/persyaratan' target='_blank' rel='noopener noreferrer' aria-label='Lihat persyaratan lengkap Akta Perceraian (Buka di tab baru)' class='text-blue-800 font-bold underline'>disini</a>.</p>
                                        <br>
                                        <p>Silahkan masuk atau daftar aplikasi untuk melanjutkan proses pengajuan permohonan administrasi kependudukan. Semua formulir kependudukan dapat diunduh <a href='https://pondok.dukcapil.tapinkab.go.id/formulir' target='_blank' rel='noopener noreferrer' aria-label='Unduh semua formulir kependudukan (Buka di tab baru)' class='text-blue-800 font-bold underline'>disini</a>.</p>
                                    </div>
                                    <div class='mt-4 pt-3 border-t border-gray-200'></div>
                                    <div class='bg-gray-100 py-4 px-4 sm:px-4 rounded-md'>
                                        <div class='flex justify-between gap-2 fade-in-card'>
                                            <button type='button' aria-label='Masuk ke Akun' class='btn-masuk flex-1 px-4 py-2 h-10 bg-green-700 text-white font-bold rounded-sm hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-600'>Masuk</button>
                                            <button type='button' aria-label='Daftar Akun Baru' class='btn-daftar flex-1 px-4 py-2 h-10 bg-blue-700 text-white font-bold rounded-sm hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600'>Daftar</button>
                                        </div>
                                    </div>
                                    `,
                                    '/form_pengajuan?keterangan=ACR&judul=Akta%20Perceraian&icon=perceraian.webp',
                                    '/login',
                                    '/register'
                                )"
                                class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-900 border border-blue-300 text-xs font-bold rounded-md hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Informasi
                            </button>
                            <button type="button"
                                aria-label="Cek Status Permohonan Akta Perceraian"
                                onclick="event.preventDefault(); event.stopPropagation(); cekStatusTransaksi();"
                                class="px-4 py-2 bg-blue-700 text-white text-xs font-bold rounded-md hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all">
                                Status
                            </button>
                        @else
                            <a href="/form_pengajuan?keterangan=ACR&judul=Akta%20Perceraian&icon=perceraian.png"
                                aria-label="Ajukan Permohonan Akta Perceraian"
                                class="inline-flex items-center justify-center px-4 py-2 bg-green-700 text-white text-xs font-bold rounded-md hover:bg-green-800 transition-colors focus:outline-none focus:ring-2 focus:ring-green-600">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Ajukan Permohonan
                            </a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
const layananMeta = {
    'kartu keluarga': {
        judul: 'Kartu Keluarga',
        deskripsi: `
            <p class="font-bold mb-2 text-gray-800">Persyaratan / Formulir yang dibutuhkan:</p>
            <ul class="list-decimal pl-5 space-y-2 text-gray-600 text-xs sm:text-sm font-semibold mb-4">
                <li>
                    Formulir F.1-02 (Pendaftaran Peristiwa Kependudukan) <span class="text-red-500 font-bold">*</span>
                    <a href="/formulir/download/981444167735976.pdf" class="ml-1 px-2 py-0.5 text-[10px] bg-blue-50 text-blue-600 border border-blue-200 rounded hover:bg-blue-100 transition inline-flex items-center gap-0.5" target="_blank">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" stroke-linecap="round"/></svg> Unduh
                    </a>
                </li>
                <li>
                    Formulir F.1-06 (Perubahan Data Kependudukan)
                    <a href="/formulir/download/113641721586859.pdf" class="ml-1 px-2 py-0.5 text-[10px] bg-blue-50 text-blue-600 border border-blue-200 rounded hover:bg-blue-100 transition inline-flex items-center gap-0.5" target="_blank">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" stroke-linecap="round"/></svg> Unduh
                    </a>
                </li>
                <li>Dokumen Pendukung (Akta Lahir/Ijazah/Buku Nikah/dll)</li>
                <li>Kartu Keluarga (KK) Lama / Asli <span class="text-red-500 font-bold">*</span></li>
                <li>Buku Nikah / Kutipan Akta Perkawinan (jika ada perubahan status kawin)</li>
            </ul>
            <p class="font-bold mb-2 text-gray-800 border-t pt-2.5">Output:</p>
            <ul class="list-decimal pl-5 space-y-1.5 text-gray-600 text-xs sm:text-sm font-semibold mb-3">
                <li>Kartu Keluarga (KK) Baru</li>
                <li>KTP/KIA jika ada perubahan data dalam Kartu Keluarga</li>
            </ul>
            <p class="text-[11px] text-red-500 font-bold border-t pt-2 mt-1">Tanda (*) menunjukkan dokumen/formulir yang wajib dilengkapi.</p>
        `,
        icon: `<svg class="w-6 h-6 text-emerald-500 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>`
    },
    'ktp': {
        judul: 'KTP',
        deskripsi: `
            <p class="font-bold mb-2 text-gray-800">Persyaratan / Formulir yang dibutuhkan:</p>
            <ul class="list-decimal pl-5 space-y-2 text-gray-600 text-xs sm:text-sm font-semibold mb-4">
                <li>
                    Formulir F.1-02 (Pendaftaran Peristiwa Kependudukan) <span class="text-red-500 font-bold">*</span>
                    <a href="/formulir/download/981444167735976.pdf" class="ml-1 px-2 py-0.5 text-[10px] bg-blue-50 text-blue-600 border border-blue-200 rounded hover:bg-blue-100 transition inline-flex items-center gap-0.5" target="_blank">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" stroke-linecap="round"/></svg> Unduh
                    </a>
                </li>
                <li>
                    Formulir F.1-06 (Perubahan Data Kependudukan)
                    <a href="/formulir/download/113641721586859.pdf" class="ml-1 px-2 py-0.5 text-[10px] bg-blue-50 text-blue-600 border border-blue-200 rounded hover:bg-blue-100 transition inline-flex items-center gap-0.5" target="_blank">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" stroke-linecap="round"/></svg> Unduh
                    </a>
                </li>
                <li>Buku Nikah / Kutipan Akta Perkawinan (jika ada perubahan status kawin)</li>
                <li>Fotokopi Kartu Keluarga (KK)/Asli <span class="text-red-500 font-bold">*</span></li>
                <li>KTP-el Asli (jika penggantian karena rusak/ganti data) <span class="text-red-500 font-bold">*</span></li>
                <li>Surat Keterangan Kehilangan dari Kepolisian (jika KTP-el hilang) <span class="text-red-500 font-bold">*</span></li>
                <li>Dokumen Pendukung (Akta Lahir/Ijazah/Buku Nikah/dll)</li>
            </ul>
            <p class="font-bold mb-2 text-gray-800 border-t pt-2.5">Output:</p>
            <ul class="list-decimal pl-5 space-y-1.5 text-gray-600 text-xs sm:text-sm font-semibold mb-3">
                <li>KTP-el Baru</li>
                <li>Kartu Keluarga (KK) Baru jika ada perubahan data</li>
            </ul>
            <p class="text-[11px] text-red-500 font-bold border-t pt-2 mt-1">Tanda (*) menunjukkan dokumen/formulir yang wajib dilengkapi.</p>
        `,
        icon: `<svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.333 0 4 .8 4 2v1H5v-1c0-1.2 2.667-2 4-2z"/></svg>`
    },
    'kia': {
        judul: 'Kartu Identitas Anak',
        deskripsi: `
            <p class="font-bold mb-2 text-gray-800">Persyaratan / Formulir yang dibutuhkan:</p>
            <ul class="list-decimal pl-5 space-y-2 text-gray-600 text-xs sm:text-sm font-semibold mb-4">
                <li>
                    Formulir F.1-02 (Pendaftaran Peristiwa Kependudukan) <span class="text-red-500 font-bold">*</span>
                    <a href="/formulir/download/981444167735976.pdf" class="ml-1 px-2 py-0.5 text-[10px] bg-blue-50 text-blue-600 border border-blue-200 rounded hover:bg-blue-100 transition inline-flex items-center gap-0.5" target="_blank">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" stroke-linecap="round"/></svg> Unduh
                    </a>
                </li>
                <li>Fotokopi Akta Kelahiran Anak <span class="text-red-500 font-bold">*</span></li>
                <li>Fotokopi Kartu Keluarga (KK) <span class="text-red-500 font-bold">*</span></li>
                <li>Pasfoto Anak berwarna ukuran 3 x 4 sebanyak 1 lembar (untuk anak usia 5-17 tahun kurang satu hari)</li>
            </ul>
            <p class="font-bold mb-2 text-gray-800 border-t pt-2.5">Output:</p>
            <ul class="list-decimal pl-5 space-y-1.5 text-gray-600 text-xs sm:text-sm font-semibold mb-3">
                <li>KIA (Kartu Identitas Anak) Baru</li>
                <li>Kartu Keluarga (KK) Baru jika ada perubahan data</li>
            </ul>
            <p class="text-[11px] text-red-500 font-bold border-t pt-2 mt-1">Tanda (*) menunjukkan dokumen/formulir yang wajib dilengkapi.</p>
        `,
        icon: `<svg class="w-6 h-6 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.333 0 4 .8 4 2v1H5v-1c0-1.2 2.667-2 4-2z"/></svg>`
    },
    'pindah': {
        judul: 'Pindah Keluar',
        deskripsi: `
            <p class="font-bold mb-2 text-gray-900">Persyaratan / Formulir yang dibutuhkan:</p>
            <ul class="list-decimal pl-5 space-y-2 text-gray-800 text-xs sm:text-sm font-semibold mb-4">
                <li>
                    Formulir F.1-03 (Formulir Pindah Warga Negara Indonesia) 2 (dua) Lembar jika pasangan suami-istri <span class="text-red-700 font-bold">*</span>
                    <a href="/formulir/download/631669847402004.pdf" aria-label="Unduh Formulir F.1-03 Pindah WNI (PDF)" class="ml-1 px-2 py-0.5 text-[10px] bg-blue-100 text-blue-900 border border-blue-300 rounded hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-600 transition inline-flex items-center gap-0.5" target="_blank" rel="noopener noreferrer">
                        <svg aria-hidden="true" class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" stroke-linecap="round"/></svg> Unduh
                    </a>
                </li>
                <li>Kartu Keluarga (KK) Asli <span class="text-red-700 font-bold">*</span></li>
                <li>KTP-el Asli <span class="text-red-700 font-bold">*</span></li>
            </ul>
            <p class="font-bold mb-2 text-gray-900 border-t pt-2.5">Output:</p>
            <ul class="list-decimal pl-5 space-y-1.5 text-gray-800 text-xs sm:text-sm font-semibold mb-3">
                <li>Surat Keterangan Pindah WNI (SKPWNI)</li>
                <li>Kartu Keluarga (KK) Baru bagi anggota keluarga yang tinggal</li>
            </ul>
            <p class="text-[11px] text-red-700 font-bold border-t pt-2 mt-1">Tanda (*) menunjukkan dokumen/formulir yang wajib dilengkapi.</p>
        `,
        icon: `<svg aria-hidden="true" class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>`
    },
    'datang': {
        judul: 'Pindah Datang',
        deskripsi: `
            <p class="font-bold mb-2 text-gray-900">Persyaratan / Formulir yang dibutuhkan:</p>
            <ul class="list-decimal pl-5 space-y-2 text-gray-800 text-xs sm:text-sm font-semibold mb-4">
                <li>
                    Formulir F.1-02 (Pendaftaran Peristiwa Kependudukan) <span class="text-red-700 font-bold">*</span>
                    <a href="/formulir/download/981444167735976.pdf" aria-label="Unduh Formulir F.1-02 Pendaftaran Kependudukan (PDF)" class="ml-1 px-2 py-0.5 text-[10px] bg-blue-100 text-blue-900 border border-blue-300 rounded hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-600 transition inline-flex items-center gap-0.5" target="_blank" rel="noopener noreferrer">
                        <svg aria-hidden="true" class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" stroke-linecap="round"/></svg> Unduh
                    </a>
                </li>
                <li>Surat Keterangan Pindah WNI (SKPWNI) Asli dari daerah asal <span class="text-red-700 font-bold">*</span></li>
                <li>KTP-el Asli <span class="text-red-700 font-bold">*</span></li>
            </ul>
            <p class="font-bold mb-2 text-gray-900 border-t pt-2.5">Output:</p>
            <ul class="list-decimal pl-5 space-y-1.5 text-gray-800 text-xs sm:text-sm font-semibold mb-3">
                <li>Kartu Keluarga (KK) Baru</li>
                <li>KTP-el Baru dengan alamat baru</li>
                <li>KIA Baru dengan alamat baru</li>
            </ul>
            <p class="text-[11px] text-red-700 font-bold border-t pt-2 mt-1">Tanda (*) menunjukkan dokumen/formulir yang wajib dilengkapi.</p>
        `,
        icon: `<svg aria-hidden="true" class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>`
    },
    'kelahiran': {
        judul: 'Akta Kelahiran',
        deskripsi: `
            <p class="font-bold mb-2 text-gray-900">Persyaratan / Formulir yang dibutuhkan:</p>
            <ul class="list-decimal pl-5 space-y-2 text-gray-800 text-xs sm:text-sm font-semibold mb-4">
                <li>
                    Formulir F.2-01 (Formulir Pendaftaran Kelahiran) <span class="text-red-700 font-bold">*</span>
                    <a href="/formulir/download/079808525067389.pdf" aria-label="Unduh Formulir F.2-01 Pendaftaran Kelahiran (PDF)" class="ml-1 px-2 py-0.5 text-[10px] bg-blue-100 text-blue-900 border border-blue-300 rounded hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-600 transition inline-flex items-center gap-0.5" target="_blank" rel="noopener noreferrer">
                        <svg aria-hidden="true" class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" stroke-linecap="round"/></svg> Unduh
                    </a>
                </li>
                <li>Surat Keterangan Kelahiran dari Rumah Sakit / Bidan / Kades <span class="text-red-700 font-bold">*</span></li>
                <li>Buku Nikah / Kutipan Akta Perkawinan Orang Tua <span class="text-red-700 font-bold">*</span></li>
                <li>Fotokopi Kartu Keluarga (KK) & KTP-el Orang Tua <span class="text-red-700 font-bold">*</span></li>
                <li>Fotokopi KTP-el 2 (dua) orang saksi <span class="text-red-700 font-bold">*</span></li>
            </ul>
            <p class="font-bold mb-2 text-gray-900 border-t pt-2.5">Output:</p>
            <ul class="list-decimal pl-5 space-y-1.5 text-gray-800 text-xs sm:text-sm font-semibold mb-3">
                <li>Akta Kelahiran</li>
                <li>Kartu Keluarga (KK) Baru dengan penambahan anak</li>
                <li>KIA Baru bagi anak baru lahir</li>
            </ul>
            <p class="text-[11px] text-red-700 font-bold border-t pt-2 mt-1">Tanda (*) menunjukkan dokumen/formulir yang wajib dilengkapi.</p>
        `,
        icon: `<svg aria-hidden="true" class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>`
    },
    'kematian': {
        judul: 'Akta Kematian',
        deskripsi: `
            <p class="font-bold mb-2 text-gray-900">Persyaratan / Formulir yang dibutuhkan:</p>
            <ul class="list-decimal pl-5 space-y-2 text-gray-800 text-xs sm:text-sm font-semibold mb-4">
                <li>
                    Formulir F.2-01 (Formulir Pelaporan Kematian) <span class="text-red-700 font-bold">*</span>
                    <a href="/formulir/download/794514332173911.pdf" aria-label="Unduh Formulir F.2-01 Pelaporan Kematian (PDF)" class="ml-1 px-2 py-0.5 text-[10px] bg-blue-100 text-blue-900 border border-blue-300 rounded hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-600 transition inline-flex items-center gap-0.5" target="_blank" rel="noopener noreferrer">
                        <svg aria-hidden="true" class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" stroke-linecap="round"/></svg> Unduh
                    </a>
                </li>
                <li>Surat Keterangan Kematian dari Rumah Sakit/Dokter/Kades <span class="text-red-700 font-bold">*</span></li>
                <li>Kartu Keluarga (KK) & KTP-el Asli yang bersangkutan (meninggal) <span class="text-red-700 font-bold">*</span></li>
                <li>Fotokopi KTP-el pelapor & 2 (dua) orang saksi <span class="text-red-700 font-bold">*</span></li>
            </ul>
            <p class="font-bold mb-2 text-gray-900 border-t pt-2.5">Output:</p>
            <ul class="list-decimal pl-5 space-y-1.5 text-gray-800 text-xs sm:text-sm font-semibold mb-3">
                <li>Akta Kematian</li>
                <li>Kartu Keluarga (KK) Baru dengan penghapusan anggota yang meninggal</li>
                <li>KTP dengan status Baru bagi suami/istri yang ditinggalkan</li>
            </ul>
            <p class="text-[11px] text-red-700 font-bold border-t pt-2 mt-1">Tanda (*) menunjukkan dokumen/formulir yang wajib dilengkapi.</p>
        `,
        icon: `<svg aria-hidden="true" class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>`
    },
    'perkawinan': {
        judul: 'Akta Perkawinan',
        deskripsi: `
            <p class="font-bold mb-2 text-gray-900">Persyaratan / Formulir yang dibutuhkan (bagi Non-Muslim):</p>
            <ul class="list-decimal pl-5 space-y-2 text-gray-800 text-xs sm:text-sm font-semibold mb-4">
                <li>
                    Formulir F.2-01 (Formulir Pendaftaran Perkawinan) <span class="text-red-700 font-bold">*</span>
                    <a href="/formulir/download/558798102271853.pdf" aria-label="Unduh Formulir F.2-01 Pendaftaran Perkawinan (PDF)" class="ml-1 px-2 py-0.5 text-[10px] bg-blue-100 text-blue-900 border border-blue-300 rounded hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-600 transition inline-flex items-center gap-0.5" target="_blank" rel="noopener noreferrer">
                        <svg aria-hidden="true" class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" stroke-linecap="round"/></svg> Unduh
                    </a>
                </li>
                <li>Surat Keterangan Perkawinan dari Pemuka Agama / Penghayat Kepercayaan <span class="text-red-700 font-bold">*</span></li>
                <li>Fotokopi Akta Kelahiran Suami & Istri <span class="text-red-700 font-bold">*</span></li>
                <li>Fotokopi Kartu Keluarga (KK) & KTP-el Suami & Istri <span class="text-red-700 font-bold">*</span></li>
                <li>Pasfoto berdampingan ukuran 4x6 berwarna sebanyak 4 lembar <span class="text-red-700 font-bold">*</span></li>
            </ul>
            <p class="font-bold mb-2 text-gray-900 border-t pt-2.5">Persyaratan Tambahan:</p>
            <ul class="list-decimal pl-5 space-y-2 text-gray-800 text-xs sm:text-sm font-semibold mb-4">
                <li>Bagi janda/duda karena cerai mati: Fotokopi Akta Kematian pasangan</li>
                <li>Bagi janda/duda karena cerai hidup: Fotokopi Akta Perceraian</li>
            </ul>
            
            <p class="font-bold mb-2 text-gray-900 border-t pt-2.5">Output:</p>
            <ul class="list-decimal pl-5 space-y-1.5 text-gray-800 text-xs sm:text-sm font-semibold mb-3">
                <li>Kutipan Akta Perkawinan</li>
                <li>Kartu Keluarga (KK) & KTP-el Baru dengan status Kawin</li>
            </ul>
            <p class="text-[11px] text-red-700 font-bold border-t pt-2 mt-1">Tanda (*) menunjukkan dokumen/formulir yang wajib dilengkapi.</p>
        `,
        icon: `<svg aria-hidden="true" class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>`
    },
    'perceraian': {
        judul: 'Akta Perceraian',
        deskripsi: `
            <p class="font-bold mb-2 text-gray-900">Persyaratan / Formulir yang dibutuhkan (bagi Non-Muslim):</p>
            <ul class="list-decimal pl-5 space-y-2 text-gray-800 text-xs sm:text-sm font-semibold mb-4">
                <li>
                    Formulir F.2-01 (Formulir Pendaftaran Perceraian) <span class="text-red-700 font-bold">*</span>
                    <a href="/formulir/download/f-201-akta-perceraian_1784778829.pdf" aria-label="Unduh Formulir F.2-01 Pendaftaran Perceraian (PDF)" class="ml-1 px-2 py-0.5 text-[10px] bg-blue-100 text-blue-900 border border-blue-300 rounded hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-600 transition inline-flex items-center gap-0.5" target="_blank" rel="noopener noreferrer">
                        <svg aria-hidden="true" class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" stroke-linecap="round"/></svg> Unduh
                    </a>
                </li>
                <li>Putusan Perceraian dari Pengadilan Negeri yang berkekuatan hukum tetap <span class="text-red-700 font-bold">*</span></li>
                <li>Kutipan Akta Perkawinan Asli <span class="text-red-700 font-bold">*</span></li>
                <li>Fotokopi Kartu Keluarga (KK) & KTP-el Mantan Suami & Istri <span class="text-red-700 font-bold">*</span></li>
            </ul>
            <p class="font-bold mb-2 text-gray-900 border-t pt-2.5">Output:</p>
            <ul class="list-decimal pl-5 space-y-1.5 text-gray-800 text-xs sm:text-sm font-semibold mb-3">
                <li>Kutipan Akta Perceraian</li>
                <li>Kartu Keluarga (KK) & KTP-el Baru dengan status Cerai Hidup</li>
            </ul>
            <p class="text-[11px] text-red-700 font-bold border-t pt-2 mt-1">Tanda (*) menunjukkan dokumen/formulir yang wajib dilengkapi.</p>
        `,
        icon: `<svg aria-hidden="true" class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>`
    },
    'default': {
        judul: 'Informasi Layanan',
        deskripsi: `
            <p class="font-bold mb-2 text-gray-900">Persyaratan / Formulir yang dibutuhkan:</p>
            <p class="text-gray-800 text-xs sm:text-sm font-semibold mb-4">Pelayanan administrasi kependudukan lainnya sesuai kebutuhan pemohon.</p>
            <p class="text-[11px] text-red-700 font-bold border-t pt-2 mt-1">Tanda (*) menunjukkan dokumen/formulir yang wajib dilengkapi.</p>
        `,
        icon: `<svg aria-hidden="true" class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>`
    }
};

function getMetaByJudul(judul) {
    const key = String(judul).toLowerCase();
    if (key.includes('keluarga')) return layananMeta['kartu keluarga'];
    if (key.includes('kartu tanda penduduk') || key.includes('ktp')) return layananMeta['ktp'];
    if (key.includes('identitas anak') || key.includes('kia')) return layananMeta['kia'];
    if (key.includes('kedatangan') || key.includes('datang')) return layananMeta['datang'];
    if (key.includes('perpindahan') || key.includes('pindah')) return layananMeta['pindah'];
    if (key.includes('kelahiran')) return layananMeta['kelahiran'];
    if (key.includes('kematian')) return layananMeta['kematian'];
    if (key.includes('perkawinan')) return layananMeta['perkawinan'];
    if (key.includes('perceraian')) return layananMeta['perceraian'];
    return layananMeta['default'];
}

function showPanduanRich(judul, htmlIsi, urlLanjutkan, urlLogin = '/login', urlDaftar = '/register') {
    const meta = getMetaByJudul(judul);
    Swal.fire({
        title: `<div class="flex items-center justify-center space-x-2 text-gray-900 font-bold text-lg">${meta.icon} <span>Informasi ${meta.judul}</span></div>`,
        html: `
            <div class="text-left text-sm text-gray-800 leading-relaxed p-4 bg-gray-50 rounded-2xl border border-gray-200 max-h-[50vh] overflow-y-auto mb-4">
                ${meta.deskripsi}
            </div>
            <div class='bg-gray-100 py-4 px-4 sm:px-4 rounded-xl border border-gray-200'>
                <div class='flex justify-between gap-2'>
                    <button type='button' class='btn-masuk flex-1 px-4 py-2 h-10 bg-green-700 text-white font-medium rounded-lg hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-600 transition-colors'>Masuk</button>
                    <button type='button' class='btn-daftar flex-1 px-4 py-2 h-10 bg-blue-700 text-white font-medium rounded-lg hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600 transition-colors'>Daftar</button>
                </div>
            </div>
        `,
        showCloseButton: true,
        showConfirmButton: false,
        showCancelButton: false,
        width: '550px',
        customClass: {
            popup: 'rounded-2xl max-w-xl',
            htmlContainer: 'p-1'
        },
        didOpen: () => {
            const btnMasuk = document.querySelector('.btn-masuk');
            const btnDaftar = document.querySelector('.btn-daftar');
            if (btnMasuk) btnMasuk.addEventListener('click', () => window.location.href = urlLogin);
            if (btnDaftar) btnDaftar.addEventListener('click', () => window.location.href = urlDaftar);
        }
    });
}

// === FUNGSI BARU: CEK STATUS TRANSAKSI ===
function maskNik(nik) {
    if (!nik || nik.length < 6) return 'xxxxxx';
    return nik.substring(0, 6) + 'xxxxxxxxxx';
}

function cekStatusTransaksi() {
    Swal.fire({
        title: 'Cek Status Permohonan',
        html: `
            <div class="text-left mb-4">
                <label for="swal-nik" class="block text-sm font-semibold text-gray-900 mb-1">NIK</label>
                <input id="swal-nik" type="text" maxlength="16" placeholder="Masukkan NIK 16 digit" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 text-gray-900">
            </div>
            <div class="text-left mb-4">
                <label for="swal-id-trx" class="block text-sm font-semibold text-gray-900 mb-1">Nomor Transaksi (ID Trx)</label>
                <input id="swal-id-trx" type="text" placeholder="Contoh: TRX20260112001" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 text-gray-900">
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'Cek Status',
        cancelButtonText: 'Batal',
        customClass: {
            popup: 'rounded-sm max-w-xl',
            content: 'text-xs sm:text-sm leading-relaxed'
        },
        preConfirm: () => {
            const nik = document.getElementById('swal-nik').value.trim();
            const id_trx = document.getElementById('swal-id-trx').value.trim();

            if (!nik || !id_trx) {
                Swal.showValidationMessage('NIK dan Nomor Transaksi wajib diisi!');
                return false;
            }

            if (!/^\d{16}$/.test(nik)) {
                Swal.showValidationMessage('NIK harus terdiri dari 16 digit angka!');
                return false;
            }

            return fetch(`/cek-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ nik, id_trx })
            })
            .then(response => response.json())
            .catch(error => {
                throw new Error('Gagal menghubungi server.');
            });
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const data = result.value;

            if (data.success && data.transaksi) {
                const fmtDate = (dateStr) => {
                    if (!dateStr) return '-';
                    const d = new Date(dateStr);
                    return d.toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: 'long',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                };

                let statusText = '';
                switch(data.transaksi.status) {
                    case 1: statusText = 'Baru, Menunggu Verifikasi'; break;
                    case 2: statusText = 'Diverifikasi'; break;
                    case 3: statusText = 'Dalam Proses'; break;
                    case 4: statusText = 'Selesai'; break;
                    case 5: statusText = 'Ditolak'; break;
                    case 6: statusText = 'Diajukan Ulang'; break;
                    default: statusText = 'Tidak Diketahui';
                }

                Swal.fire({
                    title: 'Riwayat Permohonan',
                    html: `
                        <div class="space-y-4 py-2 text-left">
                            <!-- Status Card Header -->
                            <div class="flex items-center justify-between bg-blue-50/50 border border-blue-100 rounded-xl p-4">
                                <div>
                                    <div class="text-[11px] font-semibold text-blue-600 uppercase tracking-wider">Status Permohonan</div>
                                    <div class="text-sm font-bold text-gray-800 mt-0.5">${statusText}</div>
                                </div>
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold ${
                                    data.transaksi.status == 4 ? 'bg-green-100 text-green-800' :
                                    data.transaksi.status == 5 ? 'bg-red-100 text-red-800' :
                                    data.transaksi.status == 3 ? 'bg-blue-100 text-blue-800' :
                                    'bg-amber-100 text-amber-800'
                                }">
                                    ${data.transaksi.status == 4 ? 'Selesai' : statusText}
                                </span>
                            </div>

                            <!-- Details Grid -->
                            <div class="bg-gray-50/50 border border-gray-100 rounded-xl p-4 space-y-3">
                                <div class="grid grid-cols-3 gap-2 border-b border-gray-100/80 pb-2">
                                    <span class="text-gray-500 text-xs font-medium">NIK Pemohon</span>
                                    <span class="text-gray-800 text-xs font-semibold col-span-2">${maskNik(data.transaksi.nik)}</span>
                                </div>
                                <div class="grid grid-cols-3 gap-2 border-b border-gray-100/80 pb-2">
                                    <span class="text-gray-500 text-xs font-medium">ID Transaksi</span>
                                    <span class="text-gray-800 text-xs font-mono font-bold col-span-2 text-blue-600">${data.transaksi.id_trx}</span>
                                </div>
                                <div class="grid grid-cols-3 gap-2 border-b border-gray-100/80 pb-2">
                                    <span class="text-gray-500 text-xs font-medium">Jenis Layanan</span>
                                    <span class="text-gray-800 text-xs font-semibold col-span-2">${data.transaksi.nama_layanan}</span>
                                </div>
                                <div class="grid grid-cols-3 gap-2 border-b border-gray-100/80 pb-2">
                                    <span class="text-gray-500 text-xs font-medium">Tgl. Pengajuan</span>
                                    <span class="text-gray-800 text-xs font-semibold col-span-2">${fmtDate(data.transaksi.created_at)}</span>
                                </div>
                                ${data.transaksi.tgl_proses ? `
                                <div class="grid grid-cols-3 gap-2 border-b border-gray-100/80 pb-2">
                                    <span class="text-gray-500 text-xs font-medium">Tgl. Proses</span>
                                    <span class="text-gray-800 text-xs font-semibold col-span-2">${fmtDate(data.transaksi.tgl_proses)}</span>
                                </div>` : ''}
                                ${data.transaksi.tgl_selesai ? `
                                <div class="grid grid-cols-3 gap-2 border-b border-gray-100/80 pb-2">
                                    <span class="text-gray-500 text-xs font-medium">Tgl. Selesai</span>
                                    <span class="text-gray-800 text-xs font-semibold col-span-2">${fmtDate(data.transaksi.tgl_selesai)}</span>
                                </div>` : ''}
                            </div>

                            <!-- Catatan Petugas (If any) -->
                            ${data.transaksi.pesan ? `
                            <div class="bg-amber-50 border-l-4 border-amber-500 rounded-r-xl p-4">
                                <div class="text-[11px] font-bold text-amber-800 uppercase tracking-wider">Catatan Petugas</div>
                                <p class="text-xs text-amber-900 mt-1 italic leading-relaxed">"${data.transaksi.pesan}"</p>
                            </div>` : ''}
                        </div>
                    `,
                    icon: 'info',
                    confirmButtonText: 'Tutup',
                    customClass: {
                        popup: 'rounded-xl max-w-md',
                        htmlContainer: 'text-xs sm:text-sm'
                    }
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Tidak Valid',
                    text: data.message || 'NIK dan Nomor Transaksi tidak ditemukan atau tidak sesuai.',
                    confirmButtonText: 'OK'
                });
            }
        }
    }).catch(err => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: err.message || 'Terjadi kesalahan tak terduga.',
            confirmButtonText: 'OK'
        });
    });
}

// Fetch dynamic requirements and active download forms from database
Promise.all([
    fetch('/api/persyaratan-umum').then(r => r.json()),
    fetch('/api/formulir-aktif').then(r => r.json())
]).then(([persyaratan, formulirList]) => {
    const mapKey = (name) => {
        const k = String(name).toLowerCase();
        if (k.includes('keluarga') || k.includes('kk')) return 'kartu keluarga';
        if (k.includes('ktp') || k.includes('tanda penduduk')) return 'ktp';
        if (k.includes('kia') || k.includes('identitas anak')) return 'kia';
        if (k.includes('datang') || k.includes('kedatangan')) return 'datang';
        if (k.includes('pindah') || k.includes('perpindahan')) return 'pindah';
        if (k.includes('kelahiran')) return 'kelahiran';
        if (k.includes('kematian')) return 'kematian';
        if (k.includes('perkawinan')) return 'perkawinan';
        if (k.includes('perceraian')) return 'perceraian';
        return null;
    };
    
    const convertToHtml = (syaratText, outputText) => {
        if (!syaratText) return '<p class="text-gray-500">Tidak ada persyaratan khusus.</p>';
        const lines = syaratText.split(/\r?\n/).map(l => l.trim()).filter(l => l !== '');
        let html = '<p class="font-bold mb-2 text-gray-900">Persyaratan / Formulir yang dibutuhkan:</p>';
        html += '<ul class="list-decimal pl-5 space-y-2 text-gray-800 text-xs sm:text-sm font-semibold mb-4">';
        
        lines.forEach(line => {
            let cleaned = line.replace(/^\d+\.\s*/, '');
            
            // Match any active formulir name in the line and insert the download button (only if not already containing a download link)
            if (!cleaned.includes('/formulir/download/')) {
                formulirList.forEach(f => {
                    const escapedName = f.jenis_formulir.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
                    const flexiblePattern = escapedName.replace(/\\\.|\-/g, '[.\\-\\s]?');
                    const regex = new RegExp(`(${flexiblePattern}(?:\\s+\\([^)]+\\))?)`, 'gi');
                    if (regex.test(cleaned)) {
                        const downloadUrl = `/formulir/download/${f.dokumen}`;
                        cleaned = cleaned.replace(regex, `$1 <a href="${downloadUrl}" class="ml-1 px-2 py-0.5 text-[10px] bg-blue-100 text-blue-900 border border-blue-300 rounded hover:bg-blue-200 transition inline-flex items-center gap-0.5 focus:outline-none focus:ring-2 focus:ring-blue-600" target="_blank" rel="noopener noreferrer" aria-label="Unduh ${f.jenis_formulir}"><svg aria-hidden="true" class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" stroke-linecap="round"/></svg> Unduh</a>`);
                    }
                });
            }
            
            const highlighted = cleaned.replace(/\*/g, ' <span class="text-red-700 font-bold">*</span>');
            html += `<li>${highlighted}</li>`;
        });
        
        html += '</ul>';

        // Render Output section if outputText exists
        if (outputText && outputText.trim() !== '') {
            const outLines = outputText.split(/\r?\n/).map(l => l.trim()).filter(l => l !== '');
            if (outLines.length > 0) {
                html += '<p class="font-bold mb-2 text-gray-900 border-t pt-2.5">Output:</p>';
                html += '<ul class="list-decimal pl-5 space-y-1.5 text-gray-800 text-xs sm:text-sm font-semibold mb-3">';
                outLines.forEach(line => {
                    let cleaned = line.replace(/^\d+\.\s*/, '');
                    const highlighted = cleaned.replace(/\*/g, ' <span class="text-red-700 font-bold">*</span>');
                    html += `<li>${highlighted}</li>`;
                });
                html += '</ul>';
            }
        }
        
        html += '<p class="text-[11px] text-red-700 font-bold border-t pt-2 mt-1">Tanda (*) menunjukkan dokumen/formulir yang wajib dilengkapi.</p>';
        return html;
    };
    
    persyaratan.forEach(item => {
        const key = mapKey(item.layanan);
        if (key && layananMeta[key]) {
            layananMeta[key].deskripsi = convertToHtml(item.deskripsi_syarat, item.deskripsi_output);
        }
    });
}).catch(err => console.error('Gagal load persyaratan dinamis:', err));
</script>

<style>
/* Fade-in animation */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px) scale(0.98); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}
.fade-in-card { opacity: 0; animation: fadeInUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
.fade-in-card:nth-child(1) { animation-delay: 0.1s; }
.fade-in-card:nth-child(2) { animation-delay: 0.15s; }
.fade-in-card:nth-child(3) { animation-delay: 0.2s; }
.fade-in-card:nth-child(4) { animation-delay: 0.25s; }
.fade-in-card:nth-child(5) { animation-delay: 0.3s; }
.fade-in-card:nth-child(6) { animation-delay: 0.35s; }
.fade-in-card:nth-child(7) { animation-delay: 0.4s; }
.fade-in-card:nth-child(8) { animation-delay: 0.45s; }
.fade-in-card:nth-child(9) { animation-delay: 0.5s; }

/* SweetAlert Backdrop Blur */
.swal2-container {
    background: rgba(255, 255, 255, 0.05) !important;
    backdrop-filter: blur(5px);
    -webkit-backdrop-filter: blur(5px);
    will-change: backdrop-filter;
}
.swal2-popup {
    border-top: 2px solid #3B82F6 !important;
    border-bottom: 2px solid #3B82F6 !important;
}
.swal-title-small { font-size: 1rem !important; font-weight: 600; }
.swal2-icon { margin: 1rem auto 0.5rem !important; }
@media (max-width: 640px) {
    .swal-title-small { font-size: 1.1rem !important; }
    .swal2-popup { width: 95% !important; padding: 1rem !important; }
    .swal2-html-container { padding: 0.75rem 1rem !important; font-size: 0.875rem !important; }
    .swal2-title { font-size: 1.1rem !important; padding: 0.5rem 1rem !important; }
    .swal2-icon { margin: 0.5rem auto 0.5rem !important; }
    .btn-masuk, .btn-daftar { font-size: 0.8125rem !important; padding: 0.65rem 0.75rem !important; min-height: 2.5rem !important; }
}
</style>
@endsection