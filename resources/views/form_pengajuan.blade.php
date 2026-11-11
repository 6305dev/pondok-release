@extends('layouts.app')

@section('content')
<main id="main-content"
    x-data="formPengajuan"
    x-init="initData(); initSelfieWatcher()"
>
    <h1 class="sr-only">Formulir Pengajuan Layanan Administrasi Kependudukan</h1>
    
    <div class="max-w-4xl mx-auto min-h-screen flex flex-col justify-center items-center py-12 px-4">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden w-full">
            
            <!-- Navigation Stepper -->
            <nav aria-label="Langkah Pengajuan" class="bg-white border-b border-gray-100 p-6 sm:p-5">
                <ol class="flex flex-col sm:flex-row items-stretch w-full overflow-hidden border rounded-xl bg-gray-50 list-none p-0 m-0">
                    <li class="relative flex-1 flex items-center py-3 pl-6 pr-4 transition-all"
                        :class="currentStep === 1 ? 'bg-blue-700 text-white' : (currentStep > 1 ? 'bg-white text-blue-900' : 'bg-white text-gray-700')"
                        :aria-current="currentStep === 1 ? 'step' : false"
                        class="sm:[clip-path:polygon(0%_0%,_95%_0%,_100%_50%,_95%_100%,_0%_100%)]">
                        <div class="flex items-center space-x-3">
                            <div :class="currentStep > 1 ? 'bg-blue-700 text-white border-blue-700' : (currentStep === 1 ? 'bg-white text-blue-900 border-white' : 'border-gray-400')" 
                                class="w-7 h-7 border-2 rounded-full flex items-center justify-center font-bold text-xs flex-shrink-0 transition-colors">
                                <template x-if="currentStep > 1"><svg aria-hidden="true" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></template>
                                <template x-if="currentStep <= 1"><span>01</span></template>
                            </div>
                            <span class="text-sm font-bold">Perhatian</span>
                        </div>
                    </li>

                    <li class="relative flex-1 flex items-center py-3 pl-6 pr-4 transition-all"
                        :class="currentStep === 2 ? 'bg-blue-700 text-white' : (currentStep > 2 ? 'bg-white text-blue-900' : 'bg-white text-gray-700')"
                        :aria-current="currentStep === 2 ? 'step' : false"
                        class="sm:[clip-path:polygon(95%_0%,_100%_50%,_95%_100%,_0%_100%,_5%_50%,_0%_0%)]">
                        <div class="flex items-center space-x-3">
                            <div :class="currentStep > 2 ? 'bg-blue-700 text-white border-blue-700' : (currentStep === 2 ? 'bg-white text-blue-900 border-white' : 'border-gray-400')" 
                                class="w-7 h-7 border-2 rounded-full flex items-center justify-center font-bold text-xs flex-shrink-0 transition-colors">
                                <template x-if="currentStep > 2"><svg aria-hidden="true" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></template>
                                <template x-if="currentStep <= 2"><span>02</span></template>
                            </div>
                            <span class="text-sm font-bold">Data Permohonan</span>
                        </div>
                    </li>

                    <li class="relative flex-1 flex items-center py-3 pl-6 pr-4 transition-all"
                        :class="currentStep === 3 ? 'bg-blue-700 text-white' : (currentStep > 3 ? 'bg-white text-blue-900' : 'bg-white text-gray-700')"
                        :aria-current="currentStep === 3 ? 'step' : false"
                        class="sm:[clip-path:polygon(95%_0%,_100%_50%,_95%_100%,_0%_100%,_5%_50%,_0%_0%)]">
                        <div class="flex items-center space-x-3">
                            <div :class="currentStep > 3 ? 'bg-blue-700 text-white border-blue-700' : (currentStep === 3 ? 'bg-white text-blue-900 border-white' : 'border-gray-400')" 
                                class="w-7 h-7 border-2 rounded-full flex items-center justify-center font-bold text-xs flex-shrink-0 transition-colors">
                                <template x-if="currentStep > 3"><svg aria-hidden="true" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></template>
                                <template x-if="currentStep <= 3"><span>03</span></template>
                            </div>
                            <span class="text-sm font-bold">Lampiran</span>
                        </div>
                    </li>

                    <li class="relative flex-1 flex items-center py-3 pl-6 pr-4 transition-all"
                        :class="currentStep === 4 ? 'bg-blue-700 text-white' : 'bg-white text-gray-700'"
                        :aria-current="currentStep === 4 ? 'step' : false"
                        class="sm:[clip-path:polygon(100%_0%,_100%_100%,_0%_100%,_5%_50%,_0%_0%)]">
                        <div class="flex items-center space-x-3">
                            <div :class="currentStep === 4 ? 'bg-white text-blue-900 border-white' : 'border-gray-400'" 
                                class="w-7 h-7 border-2 rounded-full flex items-center justify-center font-bold text-xs flex-shrink-0 transition-colors">
                                <span>04</span>
                            </div>
                            <span class="text-sm font-bold">Pratinjau</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="p-6 sm:p-5">
                <!-- STEP 1: PERHATIAN & KETENTUAN -->
                <section x-show="currentStep === 1" x-transition.opacity aria-labelledby="heading-step-1">
                    <h2 id="heading-step-1" class="sr-only">Langkah 1: Perhatian dan Ketentuan Ketentuan</h2>
                    <div class="bg-red-50 border-l-4 border-red-700 p-4 mb-6 rounded-r-xl">
                        <h3 class="text-red-900 font-extrabold text-base mb-1">Perhatian !!</h3>
                        <p class="text-red-800 text-sm italic font-semibold">"Barang siapa dengan sengaja melakukan pemalsuan identitas diri atau dokumen terhadap instansi pelaksana, maka dapat terancam hukuman pidana 6 tahun atau denda sebesar lima puluh juta rupiah"</p>
                        <p class="text-xs text-red-900 mt-2 uppercase font-bold tracking-wider">Undang-Undang No.23 Tahun 2006 Bab 12</p>
                    </div>

                    <div class="space-y-3 text-sm text-gray-800 mb-8 font-medium">
                        <template x-for="info in ['Pastikan Anda sudah membaca dan memahami Persyaratan.', 'Silahkan isi data permohonan dengan lengkap dan jelas sesuai instruksi yang tertera.', 'Pemilik akun dan pemilik foto selfie bertanggung jawab penuh terhadap permohonan yang diajukan.', 'Lampiran berkas wajib berupa foto dokumen asli, bukan hasil fotokopi. Lampiran dengan berkas fotokopi otomatis akan tertolak.', 'Petugas berhak menolak pengajuan dengan data atau lampiran persyaratan yang tidak sesuai prosedur.', 'Informasi status permohonan akan ditampilkan pada Menu Lacak, Lihat Bukti, atau Tombol Status.', 'Jika status pengajuan Ditolak, maka pemohon dapat Mengajukan Ulang status Ditolak pada Menu Lacak, tidak disarankan membuat pengajuan Baru yang sama.', 'Permohonan/Pengajuan akan direspon Petugas/Operator sesuai jam kerja aktif.']">
                            <div class="flex items-start">
                                <svg aria-hidden="true" class="w-5 h-5 text-green-700 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                <span x-text="info"></span>
                            </div>
                        </template>
                    </div>

                    <div class="bg-gray-50 rounded-2xl p-5 border transition-all" :class="isAgreed ? 'border-green-300 bg-green-50/50' : 'border-gray-300'">
                        <label for="checkbox-persetujuan" class="flex items-start cursor-pointer group">
                            <div class="relative inline-flex items-center cursor-pointer flex-shrink-0 mt-0.5">
                                <input id="checkbox-persetujuan" type="checkbox" x-model="isAgreed" class="sr-only peer">
                                <div class="w-12 h-6 bg-gray-400 rounded-full peer peer-checked:bg-green-700 peer-focus:ring-2 peer-focus:ring-green-600 after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-6"></div>
                            </div>
                            <span class="ml-4 text-xs sm:text-sm text-gray-800 leading-relaxed">
                                <span class="font-bold" :class="isAgreed ? 'text-green-900' : 'text-gray-900'">Konfirmasi Persetujuan :</span> <br>
                                Saya memahami, menyetujui, dan akan mengikuti aturan yang berlaku. Saya bersedia menerima konsekuensi hukum apabila melakukan pelanggaran.
                            </span>
                        </label>
                    </div>

                    <div x-show="errors.agreement && !isAgreed" role="alert" class="mt-3 flex items-center p-3 text-sm text-red-900 border border-red-300 rounded-xl bg-red-50 font-bold">
                        <svg aria-hidden="true" class="w-4 h-4 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/></svg>
                        <span class="text-xs" x-text="errors.agreement"></span>
                    </div>
                </section>

                <!-- STEP 2: DATA PERMOHONAN -->
                <section x-show="currentStep === 2" x-transition aria-labelledby="heading-step-2" class="space-y-4">
                    <h2 id="heading-step-2" class="sr-only">Langkah 2: Isi Data Permohonan</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label for="input-nik" class="text-sm font-bold text-gray-900">NIK Pemohon <span class="text-red-700">*</span></label>
                            <input id="input-nik" type="text" x-model="formData.nik" @input="formData.nik = $event.target.value.replace(/[^0-9]/g, '')" maxlength="16" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition shadow-sm text-gray-900 font-semibold" placeholder="16 digit NIK">
                            <p x-show="errors.nik" x-text="errors.nik" role="alert" class="text-xs text-red-700 italic font-bold"></p>
                            <p class="text-xs text-gray-700 italic text-left" style="text-transform: none;">* Silahkan ubah NIK jika anda mengajukan anggota lain, dan atau isi NIK Anda jika anak belum mempunyai NIK (baru lahir).</p>
                        </div>
                        <div class="space-y-1">
                            <label for="input-kk" class="text-sm font-bold text-gray-900">Nomor Kartu Keluarga <span class="text-red-700">*</span></label>
                            <input id="input-kk" type="text" x-model="formData.kk" readonly class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 bg-gray-100 text-gray-900 font-semibold outline-none shadow-sm cursor-not-allowed" placeholder="16 digit KK">
                            <p x-show="errors.kk" x-text="errors.kk" role="alert" class="text-xs text-red-700 italic font-bold"></p>
                            <p class="text-xs text-gray-700 italic text-left" style="text-transform: none;">* Anda hanya dapat mengajukan untuk anggota keluarga dalam 1 KK.</p>
                        </div>

                        <div class="space-y-1">
                            <label for="input-nama" class="text-sm font-bold text-gray-900">Nama Lengkap <span class="text-red-700">*</span></label>
                            <input id="input-nama" type="text" x-model="formData.nama" @input="formData.nama = $event.target.value.toUpperCase()" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition shadow-sm text-gray-900 font-semibold" placeholder="Nama Lengkap">
                            <p x-show="errors.nama" x-text="errors.nama" role="alert" class="text-xs text-red-700 italic font-bold"></p>
                            <p class="text-xs text-gray-700 italic text-left" style="text-transform: none;">* Silahkan ubah Nama jika anda mengajukan anggota lain dalam 1 KK Anda.</p>
                        </div>

                        <div class="space-y-1">
                            <label for="select-pengambilan" class="text-sm font-bold text-gray-900">Pengambilan Dokumen <span class="text-red-700">*</span></label>
                            <select
                                id="select-pengambilan"
                                x-on:change="
                                    formData.pengambilan_id = $event.target.value;
                                    const selected = listPengambilan.find(p => p.id == formData.pengambilan_id);
                                    formData.nama_pengambilan = selected ? selected.nama : '';
                                " 
                                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition text-gray-900 font-semibold"
                            >
                                <option value="">Pilih Tempat Pengambilan</option>
                                <template x-for="item in listPengambilan" :key="item.id">
                                    <option :value="item.id" x-text="item.nama" :selected="item.id == formData.pengambilan_id"></option>
                                </template>
                            </select>
                            <p x-show="errors.pengambilan_id" x-text="errors.pengambilan_id" role="alert" class="text-xs text-red-700 italic font-bold"></p>
                        </div>

                        <div class="md:col-span-2">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Left Column: Jenis Layanan -->
                                <div class="space-y-1" x-show="getMapping()">
                                    <span class="block text-sm font-bold text-gray-900">Jenis Layanan <span class="text-red-700">*</span></span>
                                    <div class="space-y-2">
                                        <template x-if="getMapping()">
                                            <label 
                                                class="flex items-center justify-between p-2.5 border-2 rounded-xl cursor-pointer transition-all duration-200"
                                                :class="formData.selectedLayanan.includes(getMapping().main.id.toString()) || formData.selectedLayanan.includes(getMapping().main.id) ? 'border-green-600 bg-green-50 ring-2 ring-green-100' : 'border-gray-200 bg-white hover:border-green-300'"
                                            >
                                                <div class="flex items-center">
                                                    <input type="checkbox" :value="getMapping().main.id" x-model="formData.selectedLayanan" class="w-5 h-5 accent-green-700 flex-shrink-0 focus:ring-2 focus:ring-green-600">
                                                    <span class="ml-3 flex-shrink-0 w-6 h-6 flex items-center justify-center" x-html="getMeta(getMapping().main.nama).icon"></span>
                                                    <span class="ml-3 text-sm font-bold text-gray-900" x-text="getMapping().main.nama"></span>
                                                </div>
                                                <div class="flex items-center mr-1">
                                                    <button 
                                                        type="button" 
                                                        @click.stop.prevent="showLayananInfo(getMapping().main.nama)" 
                                                        class="text-emerald-800 hover:text-emerald-900 hover:bg-emerald-200 px-2 py-0.5 rounded-full transition-all focus:outline-none focus:ring-2 focus:ring-emerald-600 flex items-center gap-1 bg-emerald-100 border border-emerald-300"
                                                        aria-label="Informasi Layanan Utama"
                                                        title="Informasi Layanan"
                                                    >
                                                        <svg aria-hidden="true" class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <span class="text-[10px] sm:text-[11px] font-bold tracking-wide">Info</span>
                                                    </button>
                                                </div>
                                            </label>
                                        </template>
                                    </div>
                                </div>

                                <!-- Right Column: Include Dokumen -->
                                <div class="space-y-1" x-show="getMapping() && (getMapping().includes.length > 0 || getMapping().note)">
                                    <span class="block text-sm font-bold text-gray-900" x-text="getMapping() ? (getMapping().includes.length > 0 ? 'Penerbitan Dokumen Terintegrasi (3-in-1 / 2-in-1)' : 'Keterangan Tambahan') : ''"></span>
                                    
                                    <!-- Optional Checkboxes -->
                                    <div class="space-y-2" x-show="getMapping() && getMapping().includes.length > 0">
                                        <template x-for="item in (getMapping() ? getMapping().includes : [])" :key="item.id">
                                            <label 
                                                class="flex items-center justify-between p-2.5 border-2 rounded-xl cursor-pointer transition-all duration-200"
                                                :class="formData.selectedLayanan.includes(item.id.toString()) || formData.selectedLayanan.includes(item.id) ? 'border-green-600 bg-green-50 ring-2 ring-green-100' : 'border-gray-200 bg-white hover:border-green-300'"
                                            >
                                                <div class="flex items-center">
                                                    <input type="checkbox" :value="item.id" x-model="formData.selectedLayanan" class="w-5 h-5 accent-green-700 flex-shrink-0 focus:ring-2 focus:ring-green-600">
                                                    <span class="ml-3 flex-shrink-0 w-6 h-6 flex items-center justify-center" x-html="getMeta(item.nama).icon"></span>
                                                    <span class="ml-3 text-sm font-bold text-gray-900" x-text="item.nama"></span>
                                                </div>
                                                <div class="flex items-center mr-1">
                                                    <button 
                                                        type="button" 
                                                        @click.stop.prevent="showLayananInfo(item.nama)" 
                                                        class="text-emerald-800 hover:text-emerald-900 hover:bg-emerald-200 px-2 py-0.5 rounded-full transition-all focus:outline-none focus:ring-2 focus:ring-emerald-600 flex items-center gap-1 bg-emerald-100 border border-emerald-300"
                                                        aria-label="Informasi Dokumen Terintegrasi"
                                                        title="Informasi Layanan"
                                                    >
                                                        <svg aria-hidden="true" class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <span class="text-[10px] sm:text-[11px] font-bold tracking-wide">Info</span>
                                                    </button>
                                                </div>
                                            </label>
                                        </template>
                                    </div>

                                    <!-- Note (Only for Pindah Keluar) -->
                                    <div class="p-4 bg-blue-50 border-l-4 border-blue-700 rounded-xl text-xs sm:text-sm font-bold text-blue-900 leading-relaxed shadow-sm" x-show="getMapping() && getMapping().note">
                                        <div class="flex items-start">
                                            <svg aria-hidden="true" class="w-5 h-5 mr-2 text-blue-700 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span x-text="getMapping() ? getMapping().note : ''"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p x-show="errors.id_dokumen" x-text="errors.id_dokumen" role="alert" class="text-xs text-red-700 italic font-bold mt-2"></p>
                        </div>

                        <div class="md:col-span-2 space-y-1">
                            <label for="textarea-keterangan" class="text-sm font-bold text-gray-900">Keterangan Permohonan <span class="text-red-700">*</span></label>
                            <textarea id="textarea-keterangan" x-model="formData.keterangan_user" @input="formData.keterangan_user = $event.target.value.toUpperCase()" rows="2" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition resize-none text-gray-900 font-semibold" placeholder="Ceritakan lebih lanjut tentang permohonan Anda..."></textarea>
                            <p x-show="errors.keterangan_user" x-text="errors.keterangan_user" role="alert" class="text-xs text-red-700 italic font-bold"></p>
                        </div>
                    </div>
                </section>

                <!-- STEP 3: LAMPIRAN & TANDA TANGAN -->
                <section x-show="currentStep === 3" 
                    x-init="$watch('currentStep', value => { if(value === 3) setTimeout(resizeCanvas, 200) })" 
                    aria-labelledby="heading-step-3"
                    class="space-y-4">    
                    <h2 id="heading-step-3" class="sr-only">Langkah 3: Unggah Lampiran dan Tanda Tangan</h2>

                    <div class="bg-blue-50 border-l-4 border-blue-700 p-3.5 rounded-r-xl shadow-sm mb-3">
                        <div class="flex items-start text-blue-900 mb-2">
                            <svg aria-hidden="true" class="w-5 h-5 mr-2 flex-shrink-0 mt-0.5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <div>
                                <h3 class="font-extrabold text-sm text-blue-950">Informasi Persyaratan Dokumen (Berkas ganda cukup diunggah sekali) :</h3>
                                <p class="text-xs text-blue-900 mt-0.5 font-semibold leading-relaxed">Silakan lengkapi berkas asli sesuai pilihan Anda di bawah. Jika terdapat berkas persyaratan yang sama di antara beberapa layanan, Anda cukup mengunggahnya satu kali saja.</p>
                            </div>
                        </div>

                        <div class="mt-2 space-y-2 sm:pl-7">
                            <template x-for="id in formData.selectedLayanan" :key="id">
                                <div class="bg-white/80 rounded-lg py-2 px-3 border border-blue-200 shadow-xs">
                                    <div class="font-bold text-xs text-blue-950 mb-0 flex items-center">
                                        <span class="w-2 h-2 rounded-full bg-blue-700 mr-2 flex-shrink-0"></span>
                                        <span x-text="getLayananNameById(id)"></span>
                                    </div>
                                    
                                    <!-- List Persyaratan -->
                                    <div class="text-xs text-gray-800 leading-relaxed pl-4 font-semibold">
                                        <span class="whitespace-pre-line block" x-html="getPersyaratanById(id).trim()"></span>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="input-lampiran" class="text-sm font-bold text-gray-900">Lampiran Persyaratan <span class="text-red-700">*</span></label>
                        <div class="border border-gray-300 rounded-2xl p-4 bg-white shadow-sm min-h-[150px]">
                            <div class="relative border-2 border-dashed border-gray-300 rounded-xl p-6 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-blue-600 transition mb-4 flex flex-col items-center justify-center group">
                                <input id="input-lampiran" type="file" accept="image/*" @change="handleFile($event, 'file')" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-30 focus:outline-none" aria-label="Unggah Berkas Lampiran Persyaratan">
                                <div class="flex flex-col items-center pointer-events-none">
                                    <div class="bg-blue-100 w-10 h-10 rounded-full flex items-center justify-center mb-2 text-blue-800">
                                        <svg aria-hidden="true" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2" stroke-linecap="round"/></svg>
                                    </div>
                                    <p class="text-xs text-gray-700 font-semibold">Seret & Jatuhkan berkas atau <span class="text-blue-800 font-extrabold underline">Jelajahi</span></p>
                                    <p class="text-[11px] text-gray-600 font-medium mt-1">Format: JPG, JPEG, PNG (Maks. 2MB per file)</p>
                                </div>
                            </div>
                            <div class="flex flex-wrap gap-3">
                                <template x-for="(src, index) in previews.file" :key="index">
                                    <div class="relative w-28 h-28 rounded-lg overflow-hidden border border-gray-300 shadow-sm">
                                        <img :src="src" alt="Pratinjau Berkas Lampiran" class="w-full h-full object-cover">
                                        <button type="button" @click="removeFile('file', index)" aria-label="Hapus file lampiran" class="absolute top-1 right-1 bg-red-700 hover:bg-red-800 text-white rounded-full p-1 focus:outline-none focus:ring-2 focus:ring-red-600"><svg aria-hidden="true" class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="2"/></svg></button>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <span class="block text-sm font-bold text-gray-900">Foto Selfie <span class="text-red-700">*</span></span>
                            <div class="border border-gray-300 rounded-2xl p-4 bg-white shadow-sm">
                                <div class="flex flex-col items-center justify-center p-6 border-2 border-dashed border-gray-300 rounded-xl">
                                    
                                    <button type="button" onclick="openCameraModal()" class="flex flex-col items-center group focus:outline-none focus:ring-2 focus:ring-blue-600 rounded-xl p-2" aria-label="Buka Kamera Ambil Foto Selfie">
                                        <div class="bg-gray-100 w-16 h-16 rounded-2xl flex items-center justify-center mb-3 group-hover:bg-blue-100 transition">
                                            <svg aria-hidden="true" class="w-8 h-8 text-gray-700 group-hover:text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                        </div>
                                        <span class="text-sm font-bold text-blue-800">Ambil Photo Selfie</span>
                                    </button>

                                    <div id="selfie-preview-container" class="mt-4 hidden">
                                        <div class="relative w-40 h-40 rounded-2xl overflow-hidden border-2 border-gray-300 shadow-lg group">
                                            <img id="selfie-result" alt="Pratinjau Foto Selfie" class="w-full h-full object-cover">
                                            
                                            <div class="absolute inset-0 bg-black/50 flex items-center justify-center gap-4 opacity-0 group-hover:opacity-100 focus-within:opacity-100 transition-opacity">
                                                <button type="button" onclick="reviewFoto()" class="bg-white/30 p-2 rounded-full hover:bg-white/50 focus:outline-none focus:ring-2 focus:ring-white transition" aria-label="Lihat Foto Selfie Penuh" title="Lihat Foto">
                                                    <svg aria-hidden="true" class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                    </svg>
                                                </button>

                                                <button type="button" onclick="openCameraModal()" class="bg-white/30 p-2 rounded-full hover:bg-white/50 focus:outline-none focus:ring-2 focus:ring-white transition" aria-label="Foto Ulang Selfie" title="Foto Ulang">
                                                    <svg aria-hidden="true" class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                    </svg>
                                                </button>
                                            </div>

                                            <button type="button" onclick="removeSelfie()" class="absolute top-1 left-1 bg-red-700 hover:bg-red-800 text-white rounded-full p-1 shadow-md focus:outline-none focus:ring-2 focus:ring-red-600" aria-label="Hapus Foto Selfie">
                                                <svg aria-hidden="true" class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="2"/></svg>
                                            </button>
                                        </div>
                                    </div>

                                    <div id="modal-review" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/90 p-4" onclick="closeReview()" role="dialog" aria-modal="true" aria-label="Pratinjau Ukuran Penuh Foto Selfie">
                                        <div class="relative max-w-2xl w-full">
                                            <img id="img-full-preview" alt="Foto Selfie Ukuran Penuh" class="w-full rounded-xl shadow-2xl border-4 border-white">
                                            <p class="text-white text-center mt-4 font-bold">Klik di mana saja untuk menutup</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" id="selfie-data" />
                        </div>

                        <!-- Modal Camera -->
                        <div id="camera-modal" class="fixed inset-0 z-[99] hidden items-center justify-center bg-black/80 p-4" role="dialog" aria-modal="true" aria-labelledby="camera-modal-title">
                            <div class="bg-white rounded-2xl overflow-hidden w-full max-w-md shadow-2xl">
                                <div class="p-4 border-b flex justify-between items-center bg-gray-50">
                                    <h3 id="camera-modal-title" class="font-extrabold text-gray-900">Ambil Foto Selfie</h3>
                                    <button onclick="closeCameraModal()" aria-label="Tutup Modal Kamera" class="text-gray-600 hover:text-gray-900 text-2xl font-bold focus:outline-none focus:ring-2 focus:ring-blue-600 rounded px-1">&times;</button>
                                </div>
                                <div class="relative bg-black aspect-square overflow-hidden">
                                    <video id="webcam" class="w-full h-full object-cover" autoplay playsinline aria-label="Tampilan Langsung Kamera Webcam"></video>
                                    <canvas id="canvas" class="hidden"></canvas>
                                </div>
                                <div class="p-4 flex justify-center gap-4 bg-gray-50">
                                    <button onclick="closeCameraModal()" class="px-6 py-2 border border-gray-400 rounded-xl text-sm font-bold text-gray-800 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-600 transition">Batal</button>
                                    <button onclick="capturePhoto()" class="px-6 py-2 bg-blue-700 text-white rounded-xl text-sm font-bold hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600 shadow-lg transition">Ambil Photo</button>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <span class="block text-sm font-bold text-gray-900">Tanda Tangan Digital <span class="text-red-700">*</span></span>
                            <div class="border border-gray-300 rounded-2xl p-4 bg-white shadow-sm flex flex-col items-center">
                                <div class="relative w-full h-[220px] border-2 border-dashed border-gray-300 rounded-xl bg-gray-50 overflow-hidden">
                                    <canvas id="signature-pad" aria-label="Area Goresan Tanda Tangan Digital" class="absolute inset-0 w-full h-full touch-none cursor-crosshair focus:outline-none focus:ring-2 focus:ring-blue-600"></canvas>
                                </div>
                                <button type="button" onclick="clearSignature()" aria-label="Hapus Tanda Tangan Digital" class="mt-3 text-xs font-bold text-red-700 uppercase hover:underline focus:outline-none focus:ring-2 focus:ring-red-600 rounded px-2 py-0.5">Hapus Tanda Tangan</button>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- STEP 4: PRATINJAU -->
                <section x-show="currentStep === 4" x-transition.opacity aria-labelledby="heading-step-4">
                    <h2 id="heading-step-4" class="sr-only">Langkah 4: Pratinjau Permohonan</h2>
                    <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200 space-y-4">
                        <div class="flex justify-between border-b border-gray-200 pb-2 text-sm"><span class="text-gray-700 font-medium">NIK :</span><span class="font-bold text-gray-900" x-text="formData.nik"></span></div>
                        <div class="flex justify-between border-b border-gray-200 pb-2 text-sm"><span class="text-gray-700 font-medium">KK :</span><span class="font-bold text-gray-900" x-text="formData.kk"></span></div>
                        <div class="flex justify-between border-b border-gray-200 pb-2 text-sm"><span class="text-gray-700 font-medium">Nama :</span><span class="font-bold text-gray-900" x-text="formData.nama"></span></div>
                        <div class="flex justify-between border-b border-gray-200 pb-2 text-sm"><span class="text-gray-700 font-medium">Pengambilan :</span><span class="font-bold text-gray-900" x-text="formData.nama_pengambilan || 'Belum dipilih'"></span></div>
                        <div class="flex justify-between border-b border-gray-200 pb-2 text-sm">
                            <span class="text-gray-700 font-medium">Layanan Dipilih :</span>
                            <span class="font-bold text-gray-900 text-right">
                                <template x-for="(id, index) in formData.selectedLayanan" :key="id">
                                    <span>
                                        <span x-text="getLayananNameById(id)"></span>
                                        <span x-show="index < formData.selectedLayanan.length - 1">, </span>
                                    </span>
                                </template>
                            </span>
                        </div>
                        <div class="flex justify-between border-b border-gray-200 pb-2 text-sm"><span class="text-gray-700 font-medium">Keterangan :</span><span class="font-bold text-gray-900" x-text="formData.keterangan_user"></span></div>
                        <div class="flex justify-between border-b border-gray-200 pb-2 text-sm"><span class="text-gray-700 font-medium">Lampiran Berkas :</span><span class="text-green-800 font-extrabold" x-text="formData.file.length + ' File diunggah'"></span></div>
                        <div class="flex justify-between border-b border-gray-200 pb-2 text-sm"><span class="text-gray-700 font-medium">Lampiran Selfie :</span><span class="text-green-800 font-extrabold" x-text="formData.file_selfie ? '1 Foto diunggah' : 'Belum ada foto selfie'"></span></div>
                        <div class="flex justify-between border-b border-gray-200 pb-2 text-sm"><span class="text-gray-700 font-medium">Lampiran TTD :</span><span class="text-green-800 font-extrabold" x-text="formData.signature ? '1 TTE diunggah' : 'Belum ada tanda tangan'"></span></div>
                    </div>
                </section>

                <div class="mt-6 pt-4 border-t border-gray-200 flex flex-col-reverse sm:flex-row justify-between items-center gap-3">
                    <button type="button" x-show="currentStep > 1" @click="prevStep" aria-label="Kembali ke Langkah Sebelumnya" class="w-full sm:w-auto px-5 py-2.5 text-sm bg-gray-200 text-gray-900 font-bold rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-600 transition">
                        Sebelumnya
                    </button>
                    <button type="button" x-show="currentStep < 4" @click="nextStep" aria-label="Lanjut ke Langkah Berikutnya" class="w-full sm:w-auto ml-auto px-6 py-2.5 text-sm bg-blue-700 text-white font-bold rounded-lg hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600 transition active:scale-95">
                        Selanjutnya
                    </button>
                    <button id="submit-btn" type="button" x-show="currentStep === 4" @click="submitForm()" aria-label="Kirim Permohonan Layanan" class="w-full sm:w-auto ml-auto px-6 py-2.5 text-sm bg-green-700 text-white font-bold rounded-lg hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-600 transition active:scale-95">
                        Kirim Permohonan
                    </button>
                </div>

            </div>
        </div>
    </div>
    <span x-effect="
        if (currentStep === 3) {
            setTimeout(() => {
                loadSignature();
                resizeCanvas && resizeCanvas();
            }, 300);
        }
    " class="hidden"></span>    
</main>
@endsection

@push('scripts')
<style>
    input::placeholder, textarea::placeholder {
        text-transform: none;
    }
    .transition-all { transition: all 0.3s ease; }
    /* Agar area input tetap bisa diklik meskipun ada list preview di bawah */
    input[type="file"] { min-height: 100px; }

    /* Animasi Loading Spinner */
    .spinner {
        display: inline-block;
        width: 16px;
        height: 16px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top: 2px solid #fff;
        animation: spin 1s linear infinite;
        margin-left: 8px;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
<script>
    // Inisialisasi variabel DOM satu kali di awal
    let videoStream = null;
    const modal = document.getElementById('camera-modal');
    const video = document.getElementById('webcam');
    const canvas = document.getElementById('canvas');
    const selfieResult = document.getElementById('selfie-result');
    const previewContainer = document.getElementById('selfie-preview-container');
    const modalReview = document.getElementById('modal-review');
    const imgFullPreview = document.getElementById('img-full-preview');
    // Ambil referensi tombol utama satu kali
    const btnTrigger = document.querySelector('[onclick="openCameraModal()"]').closest('button');

    async function openCameraModal() {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        try {
            videoStream = await navigator.mediaDevices.getUserMedia({ 
                video: { facingMode: "user" }, 
                audio: false 
            });
            video.srcObject = videoStream;
        } catch (err) {
            console.error("Error akses kamera:", err);
            alert("Tidak dapat mengakses kamera. Pastikan Anda memberikan izin.");
            closeCameraModal();
        }
    }

    function closeCameraModal() {
        if (videoStream) {
            videoStream.getTracks().forEach(track => track.stop());
            videoStream = null;
        }
        modal.classList.replace('flex', 'hidden');
    }

    function capturePhoto() {
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        const context = canvas.getContext('2d');
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        const imageData = canvas.toDataURL('image/jpeg');

        // ✅ CARA TERAMAN: Simpan ke elemen tersembunyi, lalu sync ke Alpine via $watch
        const hiddenInput = document.getElementById('selfie-data');
        if (hiddenInput) {
            hiddenInput.value = imageData;
            // Trigger input event agar Alpine bisa $watch
            hiddenInput.dispatchEvent(new Event('input'));
        }

        // Update UI
        selfieResult.src = imageData;
        previewContainer.classList.remove('hidden');
        btnTrigger.classList.add('hidden');
        closeCameraModal();
    }

    function removeSelfie() {
        selfieResult.src = "";
        previewContainer.classList.add('hidden');
        btnTrigger.classList.remove('hidden'); // Munculkan kembali tombol utama
    }

    function reviewFoto() {
        if (selfieResult.src) {
            imgFullPreview.src = selfieResult.src;
            modalReview.classList.replace('hidden', 'flex');
        }
    }

    function closeReview() {
        modalReview.classList.replace('flex', 'hidden');
    }

    const canvasSignature = document.getElementById('signature-pad');
    const ctx = canvasSignature.getContext('2d');
    let drawing = false;

    // Fungsi untuk menyesuaikan ukuran canvas dengan container-nya
    function resizeCanvas() {
        // Ambil ukuran dari elemen pembungkusnya (CSS)
        const rect = canvasSignature.getBoundingClientRect();
        
        // Setel resolusi internal canvas agar sama dengan tampilan layar
        canvasSignature.width = rect.width;
        canvasSignature.height = rect.height;
        
        // Setel ulang gaya garis setelah resize (karena ctx ter-reset)
        ctx.strokeStyle = "#000000"; // Warna hitam
        ctx.lineWidth = 3;           // Ketebalan garis
        ctx.lineCap = "round";       // Ujung garis membulat
        ctx.lineJoin = "round";
    }

    // Jalankan saat halaman siap dan saat jendela di-resize
    window.addEventListener('load', resizeCanvas);
    window.addEventListener('resize', resizeCanvas);

    function getPos(e) {
        const rect = canvasSignature.getBoundingClientRect();
        // Mendukung sentuhan (touch) dan mouse
        const clientX = e.touches ? e.touches[0].clientX : e.clientX;
        const clientY = e.touches ? e.touches[0].clientY : e.clientY;
        
        return {
            x: clientX - rect.left,
            y: clientY - rect.top
        };
    }

    function startDrawing(e) {
        drawing = true;
        const pos = getPos(e);
        ctx.beginPath();
        ctx.moveTo(pos.x, pos.y);
        // Agar bisa membuat titik saja tanpa ditarik
        ctx.lineTo(pos.x, pos.y);
        ctx.stroke();
    }

    function draw(e) {
        if (!drawing) return;
        // PENTING: Mencegah layar HP bergeser saat tanda tangan
        if (e.cancelable) e.preventDefault(); 
        
        const pos = getPos(e);
        ctx.lineTo(pos.x, pos.y);
        ctx.stroke();
    }

    function stopDrawing() {
        drawing = false;
        ctx.closePath();
    }

    let signaturePad = null;

    function initSignaturePad() {
        const canvas = document.getElementById('signature-pad');
        if (!canvas) return;

        canvas.width = canvas.offsetWidth;
        canvas.height = canvas.offsetHeight;

        signaturePad = new SignaturePad(canvas, {
            minWidth: 1,
            maxWidth: 2.5,
            penColor: 'black'
        });

        // ✅ SIMPAN TANDA TANGAN KE formData.signature SETIAP KALI SELESAI MENGGAMBAR
        signaturePad.onEnd = function () {
            const alpineEl = document.querySelector('[x-data]');
            if (alpineEl && alpineEl.__x) {
                const comp = alpineEl.__x.getComponent();
                comp.formData.signature = canvas.toDataURL('image/png');
            }
        };
    }

    // Event Listeners Mouse
    canvasSignature.addEventListener('mousedown', startDrawing);
    canvasSignature.addEventListener('mousemove', draw);
    window.addEventListener('mouseup', stopDrawing);

    // Event Listeners Touch (HP)
    canvasSignature.addEventListener('touchstart', startDrawing, { passive: false });
    canvasSignature.addEventListener('touchmove', draw, { passive: false });
    canvasSignature.addEventListener('touchend', stopDrawing);

    function clearSignature() {
        ctx.clearRect(0, 0, canvasSignature.width, canvasSignature.height);
        // Opsional: jalankan resizeCanvas lagi untuk memastikan state bersih
        resizeCanvas();
    }
</script>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('formPengajuan', () => ({
        currentStep: 1,
        isAgreed: false,
        listLayanan: [
                { id: 1, nama: 'Kartu Keluarga' }, { id: 2, nama: 'KTP' }, 
                { id: 3, nama: 'KIA' }, { id: 4, nama: 'Pindah' },
                { id: 5, nama: 'Datang' }, { id: 6, nama: 'Akta Kelahiran' },
                { id: 7, nama: 'Akta Kematian' }, { id: 8, nama: 'Akta Perkawinan' }, { id: 9, nama: 'Akta Perceraian' }
            ],
        layananMeta: {
            'kartu keluarga': {
                deskripsi: `
                    <p class="font-bold mb-2 text-gray-800">Persyaratan / Formulir yang dibutuhkan:</p>
                    <ul class="list-decimal pl-5 space-y-2 text-gray-700 text-xs sm:text-sm font-semibold mb-4">
                        <li>
                            Formulir F.1-02 (Pendaftaran Peristiwa Kependudukan) <span class="text-red-700 font-bold">*</span>
                            <a href="/formulir/download/981444167735976.pdf" aria-label="Unduh Formulir F.1-02 (Pendaftaran Peristiwa Kependudukan)" class="ml-1 px-2 py-0.5 text-[10px] bg-blue-100 text-blue-900 border border-blue-300 rounded hover:bg-blue-200 focus:ring-2 focus:ring-blue-600 transition inline-flex items-center gap-0.5" target="_blank" rel="noopener noreferrer">
                                <svg aria-hidden="true" class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" stroke-linecap="round"/></svg> Unduh
                            </a>
                        </li>
                        <li>
                            Formulir F.1-06 (Perubahan Data Kependudukan)
                            <a href="/formulir/download/113641721586859.pdf" aria-label="Unduh Formulir F.1-06 (Perubahan Data Kependudukan)" class="ml-1 px-2 py-0.5 text-[10px] bg-blue-100 text-blue-900 border border-blue-300 rounded hover:bg-blue-200 focus:ring-2 focus:ring-blue-600 transition inline-flex items-center gap-0.5" target="_blank" rel="noopener noreferrer">
                                <svg aria-hidden="true" class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" stroke-linecap="round"/></svg> Unduh
                            </a>
                        </li>
                        <li>Dokumen Pendukung (Akta Lahir/Izajah/Buku Nikah/dll)</li>
                        <li>Kartu Keluarga (KK) Lama / Asli <span class="text-red-700 font-bold">*</span></li>
                        <li>Buku Nikah / Kutipan Akta Perkawinan (jika ada perubahan status kawin)</li>
                    </ul>
                    <p class="font-bold mb-2 text-gray-800 border-t pt-2.5">Output:</p>
                    <ul class="list-decimal pl-5 space-y-1.5 text-gray-700 text-xs sm:text-sm font-semibold mb-3">
                        <li>Kartu Keluarga (KK) Baru</li>
                        <li>KTP/KIA jika ada perubahan data dalam Kartu Keluarga</li>
                    </ul>
                    <p class="text-[11px] text-red-700 font-bold border-t pt-2 mt-1">Tanda (*) menunjukkan dokumen/formulir yang wajib dilengkapi.</p>
                `,
                icon: `<svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>`
            },
            'ktp': {
                deskripsi: `
                    <p class="font-bold mb-2 text-gray-800">Persyaratan / Formulir yang dibutuhkan:</p>
                    <ul class="list-decimal pl-5 space-y-2 text-gray-700 text-xs sm:text-sm font-semibold mb-4">
                        <li>
                            Formulir F.1-02 (Pendaftaran Peristiwa Kependudukan) <span class="text-red-700 font-bold">*</span>
                            <a href="/formulir/download/981444167735976.pdf" aria-label="Unduh Formulir F.1-02 (Pendaftaran Peristiwa Kependudukan)" class="ml-1 px-2 py-0.5 text-[10px] bg-blue-100 text-blue-900 border border-blue-300 rounded hover:bg-blue-200 focus:ring-2 focus:ring-blue-600 transition inline-flex items-center gap-0.5" target="_blank" rel="noopener noreferrer">
                                <svg aria-hidden="true" class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" stroke-linecap="round"/></svg> Unduh
                            </a>
                        </li>
                        <li>
                            Formulir F.1-06 (Perubahan Data Kependudukan)
                            <a href="/formulir/download/113641721586859.pdf" aria-label="Unduh Formulir F.1-06 (Perubahan Data Kependudukan)" class="ml-1 px-2 py-0.5 text-[10px] bg-blue-100 text-blue-900 border border-blue-300 rounded hover:bg-blue-200 focus:ring-2 focus:ring-blue-600 transition inline-flex items-center gap-0.5" target="_blank" rel="noopener noreferrer">
                                <svg aria-hidden="true" class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" stroke-linecap="round"/></svg> Unduh
                            </a>
                        </li>
                        <li>Buku Nikah / Kutipan Akta Perkawinan (jika ada perubahan status kawin)</li>
                        <li>Fotokopi Kartu Keluarga (KK)/Asli <span class="text-red-700 font-bold">*</span></li>
                        <li>KTP-el Asli (jika penggantian karena rusak/ganti data) <span class="text-red-700 font-bold">*</span></li>
                        <li>Surat Keterangan Kehilangan dari Kepolisian (jika KTP-el hilang) <span class="text-red-700 font-bold">*</span></li>
                        <li>Dokumen Pendukung (Akta Lahir/Izajah/Buku Nikah/dll)</li>
                    </ul>
                    <p class="font-bold mb-2 text-gray-800 border-t pt-2.5">Output:</p>
                    <ul class="list-decimal pl-5 space-y-1.5 text-gray-700 text-xs sm:text-sm font-semibold mb-3">
                        <li>KTP-el Baru</li>
                        <li>Kartu Keluarga (KK) Baru jika ada perubahan data</li>
                    </ul>
                    <p class="text-[11px] text-red-700 font-bold border-t pt-2 mt-1">Tanda (*) menunjukkan dokumen/formulir yang wajib dilengkapi.</p>
                `,
                icon: `<svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.333 0 4 .8 4 2v1H5v-1c0-1.2 2.667-2 4-2z"/></svg>`
            },
            'kia': {
                deskripsi: `
                    <p class="font-bold mb-2 text-gray-800">Persyaratan / Formulir yang dibutuhkan:</p>
                    <ul class="list-decimal pl-5 space-y-2 text-gray-700 text-xs sm:text-sm font-semibold mb-4">
                        <li>
                            Formulir F.1-02 (Pendaftaran Peristiwa Kependudukan) <span class="text-red-700 font-bold">*</span>
                            <a href="/formulir/download/981444167735976.pdf" aria-label="Unduh Formulir F.1-02 (Pendaftaran Peristiwa Kependudukan)" class="ml-1 px-2 py-0.5 text-[10px] bg-blue-100 text-blue-900 border border-blue-300 rounded hover:bg-blue-200 focus:ring-2 focus:ring-blue-600 transition inline-flex items-center gap-0.5" target="_blank" rel="noopener noreferrer">
                                <svg aria-hidden="true" class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" stroke-linecap="round"/></svg> Unduh
                            </a>
                        </li>
                        <li>Fotokopi Akta Kelahiran Anak <span class="text-red-700 font-bold">*</span></li>
                        <li>Fotokopi Kartu Keluarga (KK) <span class="text-red-700 font-bold">*</span></li>
                        <li>Pasfoto Anak berwarna ukuran 3 x 4 sebanyak 1 lembar (untuk anak usia 5-17 tahun kurang satu hari)</li>
                    </ul>
                    <p class="font-bold mb-2 text-gray-800 border-t pt-2.5">Output:</p>
                    <ul class="list-decimal pl-5 space-y-1.5 text-gray-700 text-xs sm:text-sm font-semibold mb-3">
                        <li>KIA (Kartu Identitas Anak) Baru</li>
                        <li>Kartu Keluarga (KK) Baru jika ada perubahan data</li>
                    </ul>
                    <p class="text-[11px] text-red-700 font-bold border-t pt-2 mt-1">Tanda (*) menunjukkan dokumen/formulir yang wajib dilengkapi.</p>
                `,
                icon: `<svg class="w-6 h-6 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.333 0 4 .8 4 2v1H5v-1c0-1.2 2.667-2 4-2z"/></svg>`
            },
            'pindah': {
                deskripsi: `
                    <p class="font-bold mb-2 text-gray-800">Persyaratan / Formulir yang dibutuhkan:</p>
                    <ul class="list-decimal pl-5 space-y-2 text-gray-600 text-xs sm:text-sm font-semibold mb-4">
                        <li>
                            Formulir F.1-02 (Pendaftaran Peristiwa Kependudukan) <span class="text-red-700 font-bold">*</span>
                            <a href="/formulir/download/981444167735976.pdf" aria-label="Unduh Formulir F.1-02 (Pendaftaran Peristiwa Kependudukan)" class="ml-1 px-2 py-0.5 text-[10px] bg-blue-100 text-blue-900 border border-blue-300 rounded hover:bg-blue-200 focus:ring-2 focus:ring-blue-600 transition inline-flex items-center gap-0.5" target="_blank" rel="noopener noreferrer">
                                <svg aria-hidden="true" class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" stroke-linecap="round"/></svg> Unduh
                            </a>
                        </li>
                        <li>
                            Formulir F.1-03 (Formulir Pindah Warga Negara Indonesia) 2 (dua)Lembar jika pasangan suami-istri <span class="text-red-700 font-bold">*</span>
                            <a href="/formulir/download/631669847402004.pdf" aria-label="Unduh Formulir F.1-03 (Formulir Pindah WNI)" class="ml-1 px-2 py-0.5 text-[10px] bg-blue-100 text-blue-900 border border-blue-300 rounded hover:bg-blue-200 focus:ring-2 focus:ring-blue-600 transition inline-flex items-center gap-0.5" target="_blank" rel="noopener noreferrer">
                                <svg aria-hidden="true" class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" stroke-linecap="round"/></svg> Unduh
                            </a>
                        </li>
                        <li>Kartu Keluarga (KK) Asli <span class="text-red-700 font-bold">*</span></li>
                        <li>KTP-el Asli <span class="text-red-700 font-bold">*</span></li>
                    </ul>
                    <p class="font-bold mb-2 text-gray-800 border-t pt-2.5">Output:</p>
                    <ul class="list-decimal pl-5 space-y-1.5 text-gray-700 text-xs sm:text-sm font-semibold mb-3">
                        <li>Surat Keterangan Pindah WNI (SKPWNI)</li>
                        <li>Kartu Keluarga (KK) Baru bagi anggota keluarga yang tinggal</li>
                    </ul>
                    <p class="text-[11px] text-red-700 font-bold border-t pt-2 mt-1">Tanda (*) menunjukkan dokumen/formulir yang wajib dilengkapi.</p>
                `,
                icon: `<svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>`
            },
            'datang': {
                deskripsi: `
                    <p class="font-bold mb-2 text-gray-800">Persyaratan / Formulir yang dibutuhkan:</p>
                    <ul class="list-decimal pl-5 space-y-2 text-gray-700 text-xs sm:text-sm font-semibold mb-4">
                        <li>
                            Formulir F.1-02 (Pendaftaran Peristiwa Kependudukan) <span class="text-red-700 font-bold">*</span>
                            <a href="/formulir/download/981444167735976.pdf" aria-label="Unduh Formulir F.1-02 (Pendaftaran Peristiwa Kependudukan)" class="ml-1 px-2 py-0.5 text-[10px] bg-blue-100 text-blue-900 border border-blue-300 rounded hover:bg-blue-200 focus:ring-2 focus:ring-blue-600 transition inline-flex items-center gap-0.5" target="_blank" rel="noopener noreferrer">
                                <svg aria-hidden="true" class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" stroke-linecap="round"/></svg> Unduh
                            </a>
                        </li>
                        <li>Surat Keterangan Pindah WNI (SKPWNI) Asli dari daerah asal <span class="text-red-500 font-bold">*</span></li>
                        <li>KTP-el Asli <span class="text-red-500 font-bold">*</span></li>
                        <li>
                            Formulir F-1.03B (jika menumpang KK)
                            <a href="/formulir/download/F-1.03B.pdf" aria-label="Unduh Formulir F.1-03 (Formulir Pindah WNI)" class="ml-1 px-2 py-0.5 text-[10px] bg-blue-100 text-blue-900 border border-blue-300 rounded hover:bg-blue-200 focus:ring-2 focus:ring-blue-600 transition inline-flex items-center gap-0.5" target="_blank" rel="noopener noreferrer">
                                <svg aria-hidden="true" class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" stroke-linecap="round"/></svg> Unduh
                            </a>
                        </li>
                        <li>
                            Formulir F-1.03C (jika tempat tinggal sewa/kos)
                            <a href="/formulir/download/F-1.03C.pdf" aria-label="Unduh Formulir F.1-03 (Formulir Pindah WNI)" class="ml-1 px-2 py-0.5 text-[10px] bg-blue-100 text-blue-900 border border-blue-300 rounded hover:bg-blue-200 focus:ring-2 focus:ring-blue-600 transition inline-flex items-center gap-0.5" target="_blank" rel="noopener noreferrer">
                                <svg aria-hidden="true" class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" stroke-linecap="round"/></svg> Unduh
                            </a>
                        </li>
                    </ul>
                    <p class="font-bold mb-2 text-gray-800 border-t pt-2.5">Output:</p>
                    <ul class="list-decimal pl-5 space-y-1.5 text-gray-700 text-xs sm:text-sm font-semibold mb-3">
                        <li>Kartu Keluarga (KK) Baru</li>
                        <li>KTP-el Baru dengan alamat baru</li>
                        <li>KIA Baru dengan alamat baru</li>
                    </ul>
                    <p class="text-[11px] text-red-700 font-bold border-t pt-2 mt-1">Tanda (*) menunjukkan dokumen/formulir yang wajib dilengkapi.</p>
                `,
                icon: `<svg class="w-6 h-6 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>`
            },
            'kelahiran': {
                deskripsi: `
                    <p class="font-bold mb-2 text-gray-800">Persyaratan / Formulir yang dibutuhkan:</p>
                    <ul class="list-decimal pl-5 space-y-2 text-gray-700 text-xs sm:text-sm font-semibold mb-4">
                        <li>
                            Formulir F.2-01 (Formulir Pendaftaran Kelahiran) <span class="text-red-700 font-bold">*</span>
                            <a href="/formulir/download/079808525067389.pdf" aria-label="Unduh Formulir F.2-01 (Formulir Pendaftaran Kelahiran)" class="ml-1 px-2 py-0.5 text-[10px] bg-blue-100 text-blue-900 border border-blue-300 rounded hover:bg-blue-200 focus:ring-2 focus:ring-blue-600 transition inline-flex items-center gap-0.5" target="_blank" rel="noopener noreferrer">
                                <svg aria-hidden="true" class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" stroke-linecap="round"/></svg> Unduh
                            </a>
                        </li>
                        <li>Surat Keterangan Kelahiran dari Rumah Sakit / Bidan / Kades <span class="text-red-700 font-bold">*</span></li>
                        <li>Buku Nikah / Kutipan Akta Perkawinan Orang Tua <span class="text-red-700 font-bold">*</span></li>
                        <li>Fotokopi Kartu Keluarga (KK) & KTP-el Orang Tua <span class="text-red-700 font-bold">*</span></li>
                        <li>Fotokopi KTP-el 2 (dua) orang saksi <span class="text-red-700 font-bold">*</span></li>
                    </ul>
                    <p class="font-bold mb-2 text-gray-800 border-t pt-2.5">Output:</p>
                    <ul class="list-decimal pl-5 space-y-1.5 text-gray-700 text-xs sm:text-sm font-semibold mb-3">
                        <li>Akta Kelahiran</li>
                        <li>Kartu Keluarga (KK) Baru dengan penambahan anak</li>
                        <li>KIA Baru bagi anak baru lahir</li>
                    </ul>
                    <p class="text-[11px] text-red-700 font-bold border-t pt-2 mt-1">Tanda (*) menunjukkan dokumen/formulir yang wajib dilengkapi.</p>
                `,
                icon: `<svg class="w-6 h-6 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>`
            },
            'kematian': {
                deskripsi: `
                    <p class="font-bold mb-2 text-gray-800">Persyaratan / Formulir yang dibutuhkan:</p>
                    <ul class="list-decimal pl-5 space-y-2 text-gray-600 text-xs sm:text-sm font-semibold mb-4">
                        <li>
                            Formulir F.2-01 (Formulir Pelaporan Kematian) <span class="text-red-500 font-bold">*</span>
                            <a href="/formulir/download/794514332173911.pdf" class="ml-1 px-2 py-0.5 text-[10px] bg-blue-50 text-blue-600 border border-blue-200 rounded hover:bg-blue-100 transition inline-flex items-center gap-0.5" target="_blank">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" stroke-linecap="round"/></svg> Unduh
                            </a>
                        </li>
                        <li>Surat Keterangan Kematian dari Rumah Sakit/Dokter/Kades <span class="text-red-500 font-bold">*</span></li>
                        <li>Kartu Keluarga (KK) & KTP-el Asli yang bersangkutan (meninggal) <span class="text-red-500 font-bold">*</span></li>
                        <li>Fotokopi KTP-el pelapor & 2 (dua) orang saksi <span class="text-red-500 font-bold">*</span></li>
                    </ul>
                    <p class="font-bold mb-2 text-gray-800 border-t pt-2.5">Output:</p>
                    <ul class="list-decimal pl-5 space-y-1.5 text-gray-600 text-xs sm:text-sm font-semibold mb-3">
                        <li>Akta Kematian</li>
                        <li>Kartu Keluarga (KK) Baru dengan penghapusan anggota yang meninggal</li>
                        <li>KTP dengan status Baru bagi suami/istri yang ditinggalkan</li>
                    </ul>
                    <p class="text-[11px] text-red-500 font-bold border-t pt-2 mt-1">Tanda (*) menunjukkan dokumen/formulir yang wajib dilengkapi.</p>
                `,
                icon: `<svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>`
            },
            'perkawinan': {
                deskripsi: `
                    <p class="font-bold mb-2 text-gray-800">Persyaratan / Formulir yang dibutuhkan (bagi Non-Muslim):</p>
                    <ul class="list-decimal pl-5 space-y-2 text-gray-600 text-xs sm:text-sm font-semibold mb-4">
                        <li>
                            Formulir F.2-01 (Formulir Pendaftaran Perkawinan) <span class="text-red-500 font-bold">*</span>
                            <a href="/formulir/download/558798102271853.pdf" class="ml-1 px-2 py-0.5 text-[10px] bg-blue-50 text-blue-600 border border-blue-200 rounded hover:bg-blue-100 transition inline-flex items-center gap-0.5" target="_blank">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" stroke-linecap="round"/></svg> Unduh
                            </a>
                        </li>
                        <li>Surat Keterangan Perkawinan dari Pemuka Agama / Penghayat Kepercayaan <span class="text-red-500 font-bold">*</span></li>
                        <li>Fotokopi Akta Kelahiran Suami & Istri <span class="text-red-500 font-bold">*</span></li>
                        <li>Fotokopi Kartu Keluarga (KK) & KTP-el Suami & Istri <span class="text-red-500 font-bold">*</span></li>
                        <li>Pasfoto berdampingan ukuran 4x6 berwarna sebanyak 4 lembar <span class="text-red-500 font-bold">*</span></li>
                    </ul>
                    <p class="font-bold mb-2 text-gray-800 border-t pt-2.5">Persyaratan Tambahan:</p>
                    <ul class="list-decimal pl-5 space-y-2 text-gray-600 text-xs sm:text-sm font-semibold mb-4">
                        <li>Bagi janda/duda karena cerai mati: Fotokopi Akta Kematian pasangan</li>
                        <li>Bagi janda/duda karena cerai hidup: Fotokopi Akta Perceraian</li>
                    </ul>
                    
                    <p class="font-bold mb-2 text-gray-800 border-t pt-2.5">Output:</p>
                    <ul class="list-decimal pl-5 space-y-1.5 text-gray-600 text-xs sm:text-sm font-semibold mb-3">
                        <li>Kutipan Akta Perkawinan</li>
                        <li>Kartu Keluarga (KK) & KTP-el Baru dengan status Kawin</li>
                    </ul>
                    <p class="text-[11px] text-red-500 font-bold border-t pt-2 mt-1">Tanda (*) menunjukkan dokumen/formulir yang wajib dilengkapi.</p>
                `,
                icon: `<svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>`
            },
            'perceraian': {
                deskripsi: `
                    <p class="font-bold mb-2 text-gray-800">Persyaratan / Formulir yang dibutuhkan (bagi Non-Muslim):</p>
                    <ul class="list-decimal pl-5 space-y-2 text-gray-600 text-xs sm:text-sm font-semibold mb-4">
                        <li>
                            Formulir F.2-01 (Formulir Pendaftaran Perceraian) <span class="text-red-500 font-bold">*</span>
                            <a href="/formulir/download/f-201-akta-perceraian_1784778829.pdf" class="ml-1 px-2 py-0.5 text-[10px] bg-blue-50 text-blue-600 border border-blue-200 rounded hover:bg-blue-100 transition inline-flex items-center gap-0.5" target="_blank">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" stroke-linecap="round"/></svg> Unduh
                            </a>
                        </li>
                        <li>Putusan Perceraian dari Pengadilan Negeri yang berkekuatan hukum tetap <span class="text-red-500 font-bold">*</span></li>
                        <li>Kutipan Akta Perkawinan Asli <span class="text-red-500 font-bold">*</span></li>
                        <li>Fotokopi Kartu Keluarga (KK) & KTP-el Mantan Suami & Istri <span class="text-red-500 font-bold">*</span></li>
                    </ul>
                    <p class="font-bold mb-2 text-gray-800 border-t pt-2.5">Output:</p>
                    <ul class="list-decimal pl-5 space-y-1.5 text-gray-600 text-xs sm:text-sm font-semibold mb-3">
                        <li>Kutipan Akta Perceraian</li>
                        <li>Kartu Keluarga (KK) & KTP-el Baru dengan status Cerai Hidup</li>
                    </ul>
                    <p class="text-[11px] text-red-500 font-bold border-t pt-2 mt-1">Tanda (*) menunjukkan dokumen/formulir yang wajib dilengkapi.</p>
                `,
                icon: `<svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>`
            },
            // 'kua': {
            //     deskripsi: `
            //         <p class="font-bold mb-2 text-gray-800">Persyaratan / Formulir yang dibutuhkan:</p>
            //         <ul class="list-decimal pl-5 space-y-2 text-gray-600 text-xs sm:text-sm font-semibold mb-4">
            //             <li>Surat Pengantar Nikah dari Kelurahan / Desa (Formulir N1, N2, N4) <span class="text-red-500 font-bold">*</span></li>
            //             <li>Fotokopi Kartu Keluarga (KK) & KTP-el Calon Pengantin <span class="text-red-500 font-bold">*</span></li>
            //             <li>Pasfoto berlatar biru ukuran 2x3 & 4x6 <span class="text-red-500 font-bold">*</span></li>
            //         </ul>
            //         <p class="font-bold mb-2 text-gray-800 border-t pt-2.5">Output:</p>
            //         <ul class="list-decimal pl-5 space-y-1.5 text-gray-600 text-xs sm:text-sm font-semibold mb-3">
            //             <li>Surat Pengantar Nikah resmi untuk KUA</li>
            //         </ul>
            //         <p class="text-[11px] text-red-500 font-bold border-t pt-2 mt-1">Tanda (*) menunjukkan dokumen/formulir yang wajib dilengkapi.</p>
            //     `,
            //     icon: `<svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>`
            // },
            'default': {
                deskripsi: `
                    <p class="font-bold mb-2 text-gray-800">Persyaratan / Formulir yang dibutuhkan:</p>
                    <p class="text-gray-600 text-xs sm:text-sm font-semibold mb-4">Pelayanan administrasi kependudukan lainnya sesuai kebutuhan pemohon.</p>
                    <p class="text-[11px] text-red-500 font-bold border-t pt-2 mt-1">Tanda (*) menunjukkan dokumen/formulir yang wajib dilengkapi.</p>
                `,
                icon: `<svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>`
            }
        },
        getMeta(nama) {
            const key = String(nama).toLowerCase();
            if (key.includes('keluarga') || key.includes('kk')) return this.layananMeta['kartu keluarga'];
            if (key.includes('ktp')) return this.layananMeta['ktp'];
            if (key.includes('kia')) return this.layananMeta['kia'];
            if (key.includes('datang')) return this.layananMeta['datang'];
            if (key.includes('pindah')) return this.layananMeta['pindah'];
            if (key.includes('kelahiran')) return this.layananMeta['kelahiran'];
            if (key.includes('kematian')) return this.layananMeta['kematian'];
            if (key.includes('perkawinan')) return this.layananMeta['perkawinan'];
            if (key.includes('perceraian')) return this.layananMeta['perceraian'];
            // if (key.includes('kua')) return this.layananMeta['kua'];
            return this.layananMeta['default'];
        },
        init() {
            Promise.all([
                fetch('/api/persyaratan-umum').then(res => res.json()),
                fetch('/api/formulir-aktif').then(res => res.json())
            ]).then(([persyaratan, formulirList]) => {
                persyaratan.forEach(item => {
                    const key = this.mapLayananKey(item.layanan);
                    if (key && this.layananMeta[key]) {
                        this.layananMeta[key].deskripsi = this.convertSyaratToHtml(item.deskripsi_syarat, formulirList, item.deskripsi_output);
                    }
                });
            }).catch(err => console.error('Gagal load persyaratan dinamis:', err));
        },
        mapLayananKey(name) {
            const key = String(name).toLowerCase();
            if (key.includes('keluarga') || key.includes('kk')) return 'kartu keluarga';
            if (key.includes('ktp') || key.includes('tanda penduduk')) return 'ktp';
            if (key.includes('kia') || key.includes('identitas anak')) return 'kia';
            if (key.includes('datang') || key.includes('kedatangan')) return 'datang';
            if (key.includes('pindah') || key.includes('perpindahan')) return 'pindah';
            if (key.includes('kelahiran')) return 'kelahiran';
            if (key.includes('kematian')) return 'kematian';
            if (key.includes('perkawinan')) return 'perkawinan';
            if (key.includes('perceraian')) return 'perceraian';
            return null;
        },
        convertSyaratToHtml(text, formulirList = [], outputText = '') {
            if (!text) return '<p class="text-gray-500">Tidak ada persyaratan khusus.</p>';
            const lines = text.split(/\r?\n/).map(l => l.trim()).filter(l => l !== '');
            let html = '<p class="font-bold mb-2 text-gray-900">Persyaratan / Formulir yang dibutuhkan:</p>';
            html += '<ul class="list-decimal pl-5 space-y-2 text-gray-800 text-xs sm:text-sm font-semibold mb-4">';
            
            lines.forEach(line => {
                let cleaned = line.replace(/^\d+\.\s*/, '');
                
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
        },
        showLayananInfo(nama) {
            const meta = this.getMeta(nama);
            Swal.fire({
                title: `<div class="flex items-center justify-center space-x-2 text-gray-800 font-bold text-lg">${meta.icon} <span>Informasi ${nama}</span></div>`,
                html: `<div class="text-left text-sm text-gray-600 leading-relaxed p-4 bg-gray-50 rounded-2xl border border-gray-100 max-h-[60vh] overflow-y-auto">${meta.deskripsi}</div>`,
                confirmButtonText: 'Tutup',
                confirmButtonColor: '#3b82f6',
                customClass: {
                    popup: 'rounded-3xl',
                    confirmButton: 'rounded-xl px-6 py-2.5 text-sm font-bold shadow-md'
                }
            });
        },
        layananMapping: {
            'KTP': {
                main: { id: 2, nama: 'KTP' },
                includes: [
                    { id: 1, nama: 'Kartu Keluarga' }
                ]
            },
            'KK': {
                main: { id: 1, nama: 'Kartu Keluarga' },
                includes: [
                    { id: 2, nama: 'KTP' },
                    { id: 3, nama: 'KIA' }
                ]
            },
            'KIA': {
                main: { id: 3, nama: 'KIA' },
                includes: [
                    { id: 1, nama: 'Kartu Keluarga' }
                ]
            },
            'ALH': {
                main: { id: 6, nama: 'Akta Kelahiran' },
                includes: [
                    { id: 1, nama: 'Kartu Keluarga' },
                    { id: 3, nama: 'KIA' }
                ]
            },
            'AMT': {
                main: { id: 7, nama: 'Akta Kematian' },
                includes: [
                    { id: 1, nama: 'Kartu Keluarga' },
                    { id: 2, nama: 'KTP' }
                ]
            },
            'DTG': {
                main: { id: 5, nama: 'Pindah Datang' },
                includes: [
                    { id: 1, nama: 'Kartu Keluarga' },
                    { id: 2, nama: 'KTP' },
                    { id: 3, nama: 'KIA' }
                ]
            },
            'PDH': {
                main: { id: 4, nama: 'Pindah Keluar' },
                includes: [],
                note: 'Kartu Keluarga dan KTP/KIA akan diterbitkan di tempat tujuan'
            },
            'AKW': {
                main: { id: 8, nama: 'Akta Perkawinan' },
                includes: [
                    { id: 1, nama: 'Kartu Keluarga' },
                    { id: 2, nama: 'KTP' }
                ]
            },
            'ACR': {
                main: { id: 9, nama: 'Akta Perceraian' },
                includes: [
                    { id: 1, nama: 'Kartu Keluarga' },
                    { id: 2, nama: 'KTP' }
                ]
            }
        },
        getMapping() {
            const ket = this.formData.keterangan;
            return this.layananMapping[ket] || null;
        },
        getLayananNameById(id) {
            for (const key in this.layananMapping) {
                const m = this.layananMapping[key];
                if (m.main.id == id) return m.main.nama;
                if (m.includes) {
                    const inc = m.includes.find(i => i.id == id);
                    if (inc) return inc.nama;
                }
            }
            return 'Layanan #' + id;
        },
        getPersyaratanById(id) {
            const found = this.listPersyaratan.find(s => s.id == id);
            return found ? found.deskripsi_syarat : 'Persyaratan tidak spesifik.';
        },
        listPersyaratan: [],
        listPengambilan: [],
        formData: {
            nik: @json(auth()->user()->nik ?? ''),
            kk: @json(auth()->user()->kk ?? ''),
            nama: @json(auth()->user()->name ?? ''),
            pengambilan_id: '',
            selectedLayanan: [],
            keterangan: @json(request('keterangan') ?? ''),
            keterangan_user: '',
            file: [],
            file_selfie: '',
            signature: ''
        },
        previews: {
            file: [],
            selfie: null
        },
        errors: {},

        syncNames() {
            if (this.formData.id_dokumen) {
                const selected = this.listLayanan.find(l => l.id == this.formData.id_dokumen);
                if (selected) this.formData.nama_dokumen = selected.nama;
            }
            if (this.formData.pengambilan_id) {
                const selected = this.listPengambilan.find(p => p.id == this.formData.pengambilan_id);
                if (selected) this.formData.nama_pengambilan = selected.nama;
            }
        },

        async initData() {
            try {
                const ket = this.formData.keterangan;
                if (ket) {
                    const resLayanan = await fetch(`/api/jenis-layanan/filter/${ket}`);
                    this.listLayanan = await resLayanan.json();
                }
                const resAmbil = await fetch('/api/pengambilan-dokumen');
                this.listPengambilan = await resAmbil.json();
                
                // Ambil data persyaratan umum
                const resSyarat = await fetch('/api/persyaratan-umum');
                this.listPersyaratan = await resSyarat.json();

                this.syncNames();

                // Pre-select main service
                const mapping = this.getMapping();
                if (mapping) {
                    const mainId = mapping.main.id.toString();
                    if (!this.formData.selectedLayanan.includes(mainId)) {
                        this.formData.selectedLayanan.push(mainId);
                    }
                }
            } catch (e) {
                console.error('Gagal memuat data:', e);
            }
        },

        getSelectedLayanan() {
            return this.listLayanan.find(item => item.id == this.formData.id_dokumen) || null;
        },

        isSignatureEmpty() {
            const canvas = document.getElementById('signature-pad');
            if (!canvas) return true;
            const blank = document.createElement('canvas');
            blank.width = canvas.width;
            blank.height = canvas.height;
            return canvas.toDataURL() === blank.toDataURL();
        },

        handleFile(event, field) {
            const files = Array.from(event.target.files);
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
            const maxSize = 2 * 1024 * 1024;
            files.forEach(file => {
                if (!allowedTypes.includes(file.type)) {
                    Swal.fire({ icon: 'error', title: 'Format Salah', text: file.name + ' bukan gambar!' });
                    return;
                }
                if (file.size > maxSize) {
                    Swal.fire({ icon: 'warning', title: 'Terlalu Besar', text: file.name + ' melebihi 2MB.' });
                    return;
                }
                this.formData[field].push(file);
                const url = URL.createObjectURL(file);
                this.previews[field].push(url);
            });
            event.target.value = '';
        },

        removeFile(field, index) {
            URL.revokeObjectURL(this.previews[field][index]);
            this.formData[field].splice(index, 1);
            this.previews[field].splice(index, 1);
        },

        validate() {
            this.errors = {};
            if (this.currentStep === 1) {
                if (!this.isAgreed) this.errors.agreement = 'Pernyataan persetujuan wajib disetujui.';
            }
            if (this.currentStep === 2) {
                if (!this.formData.nik || this.formData.nik.length < 16) this.errors.nik = 'NIK wajib 16 digit.';
                if (!this.formData.kk || this.formData.kk.length < 16) this.errors.kk = 'Nomor KK wajib 16 digit.';
                if (!this.formData.nama) this.errors.nama = 'Nama lengkap wajib diisi.';
                if (!this.formData.pengambilan_id) this.errors.pengambilan_id = 'Tempat pengambilan wajib dipilih.';
                if (this.formData.selectedLayanan.length === 0) this.errors.id_dokumen = 'Pilih minimal satu jenis layanan.';
                if (!this.formData.keterangan_user || !this.formData.keterangan_user.trim()) this.errors.keterangan_user = 'Keterangan permohonan wajib diisi.';
            }
            if (this.currentStep === 3) {
                if (this.formData.file.length === 0) {
                    this.errors.file = 'Lampiran Berkas wajib diunggah.';
                }
                if (!this.previews.selfie) {
                    this.errors.file_selfie = 'Foto Selfie wajib diambil.';
                }
                if (this.isSignatureEmpty()) {
                    this.errors.signature = 'Tanda tangan digital wajib diisi.';
                }
            }
            if (Object.keys(this.errors).length > 0) {
                const firstError = Object.values(this.errors)[0];
                Swal.fire({ icon: 'error', title: 'Belum Lengkap', text: firstError });
            }
            return Object.keys(this.errors).length === 0;
        },

        nextStep() {
            if (this.validate()) {
                if (this.currentStep === 3) {
                    const canvas = document.getElementById('signature-pad');
                    this.formData.signature = canvas.toDataURL();
                }
                this.currentStep++;
                window.scrollTo({ top: 0, behavior: 'smooth' });
                if (this.currentStep === 3) setTimeout(() => {
                    this.loadSignature();
                    resizeCanvas && resizeCanvas();
                }, 300);
            }
        },

        prevStep() {
            if (this.currentStep > 1) {
                this.currentStep--;
                this.errors = {};
                window.scrollTo({ top: 0, behavior: 'smooth' });
                if (this.currentStep === 3) setTimeout(() => {
                    this.loadSignature();
                    resizeCanvas && resizeCanvas();
                }, 300);
            }
        },

        loadSignature() {
            const canvas = document.getElementById('signature-pad');
            if (!canvas || !this.formData.signature) return;
            const ctx = canvas.getContext('2d');
            const img = new Image();
            img.onload = () => {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                ctx.drawImage(img, 0, 0);
            };
            img.src = this.formData.signature;
        },

        updateSelfie(imageData) {
            this.previews.selfie = imageData;
            this.formData.file_selfie = imageData;
        },

        initSelfieWatcher() {
            const input = document.getElementById('selfie-data');
            if (input) {
                this.formData.file_selfie = input.value;
                this.previews.selfie = input.value;
                input.addEventListener('input', () => {
                    this.formData.file_selfie = input.value;
                    this.previews.selfie = input.value;
                });
            }
        },

    submitForm() {
        const btn = document.querySelector('#submit-btn');
        btn.disabled = true;
        // Simpan teks asli untuk dikembalikan nanti
        const originalText = btn.innerHTML;

        // Tambahkan spinner HTML
        btn.innerHTML = `
            <span class="flex items-center justify-center">
                Mengirim...
                <svg class="ml-2 w-4 h-4 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </span>
        `;

        const formData = new FormData();
        formData.append('nik', this.formData.nik);
        formData.append('kk', this.formData.kk);
        formData.append('nama', this.formData.nama);
        formData.append('kategori_id', this.formData.kategori_id); // Kirim ID Kategori
        // Mengirim array layanan yang dipilih
        this.formData.selectedLayanan.forEach(id => {
            formData.append('jenis_layanan[]', id);
        });
        formData.append('pengambilan_id', this.formData.pengambilan_id); // Kirim ID Pengambilan
        formData.append('isi_informasi', this.formData.keterangan_user);
        formData.append('ikm', 5);
        formData.append('keterangan', this.formData.keterangan);
        formData.append('no_resi', '');

        this.formData.file.forEach(file => {
            formData.append('file[]', file);
        });

        if (this.formData.file_selfie) {
            formData.append('file_selfie', this.formData.file_selfie);
        }
        if (this.formData.signature) {
            formData.append('signature', this.formData.signature);
        }

        fetch('{{ route('pengajuan.submit') }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                if (response.status === 413) {
                    throw new Error('Ukuran file/data yang dikirim terlalu besar. Silakan kurangi ukuran file Anda.');
                }
                if (response.status === 419) {
                    throw new Error('Sesi halaman telah kedaluwarsa (CSRF token expired). Silakan muat ulang halaman ini.');
                }
                return response.json().then(errData => {
                    throw new Error(errData.message || 'Terjadi kesalahan pada server.');
                }).catch(() => {
                    throw new Error(`Terjadi kesalahan server (Status: ${response.status}).`);
                });
            }
            return response.json();
        })
        .then(data => {
            // Kembalikan tombol ke keadaan semula
            btn.disabled = false;
            btn.innerHTML = originalText;

            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    html: `
                        <p>${data.message}</p>
                        <p><strong>ID Transaksi:</strong> <code>${data.id_trx}</code></p>
                        <p>Silakan simpan ID ini untuk pengecekan status.</p>
                    `,
                    showCancelButton: true,
                    confirmButtonText: 'Cek Status',
                    cancelButtonText: 'Tutup',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        // ✅ Arahkan ke tracking pedes
                        window.location.href = `/tracking/${data.id_trx}`;
                    } else {
                        window.location.href = '/';
                    }
                });
            } else {
                let errorMsg = data.message;
                if (data.errors) {
                    errorMsg = Object.values(data.errors).flat().join('<br>');
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    html: errorMsg
                });
            }
        })
        .catch(error => {
            // Kembalikan tombol ke keadaan semula
            btn.disabled = false;
            btn.innerHTML = originalText;

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message || 'Gagal mengirim data. Cek koneksi internet.'
            });
            console.error('Error:', error);
        });
    }
    }));
});
</script>
@endpush