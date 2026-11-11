@if(!request()->is('admin*'))
<!-- Floating Accessibility Button -->
<div id="accessibility-widget-trigger" class="fixed bottom-20 right-4 sm:bottom-24 sm:right-6 z-50">
    <button id="accessibility-btn-toggle" type="button"
        class="group relative flex items-center justify-center w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-blue-700 text-white shadow-xl hover:shadow-2xl hover:scale-110 active:scale-95 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-blue-500/50 touch-manipulation"
        aria-label="Buka Menu Aksesibilitas Disabilitas" title="Menu Aksesibilitas Disabilitas">
        <i class="bi bi-universal-access text-2xl sm:text-3xl transition-transform group-hover:rotate-12" aria-hidden="true"></i>
        <span class="absolute -top-1 -right-1 flex h-3.5 w-3.5 sm:h-4 sm:w-4">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-sky-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3.5 w-3.5 sm:h-4 sm:w-4 bg-sky-500"></span>
        </span>
    </button>
</div>

<!-- Backdrop Overlay -->
<div id="accessibility-backdrop"
    class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden transition-opacity duration-300" aria-hidden="true">
</div>

<!-- Accessibility Panel Drawer -->
<aside id="accessibility-panel"
    class="fixed inset-y-0 right-0 z-50 w-full sm:w-96 max-w-full bg-white shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out flex flex-col border-l border-gray-200"
    aria-hidden="true" role="dialog" aria-labelledby="accessibility-panel-title">
    <!-- Panel Header -->
    <div class="flex items-center justify-between p-4 bg-gray-900 text-white shadow-md shrink-0">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-lg bg-blue-700 flex items-center justify-center text-white shrink-0">
                <i class="bi bi-universal-access text-xl" aria-hidden="true"></i>
            </div>
            <div>
                <h3 id="accessibility-panel-title" class="font-bold text-sm sm:text-base text-white leading-snug">Menu Aksesibilitas</h3>
                <p class="text-[11px] text-gray-300">Fitur Ramah Disabilitas &amp; Lansia</p>
            </div>
        </div>
        <button id="accessibility-btn-close" type="button"
            class="text-gray-300 hover:text-white p-2 rounded-lg hover:bg-gray-800 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500"
            aria-label="Tutup Menu Aksesibilitas">
            <i class="bi bi-x-lg text-lg" aria-hidden="true"></i>
        </button>
    </div>

    <!-- Panel Scrollable Content -->
    <div class="flex-1 overflow-y-auto p-4 space-y-5">

        <!-- 0. PROFIL KHUSUS DISABILITAS (Preset Profiles) -->
        <section class="bg-sky-50/80 p-4 rounded-xl border border-sky-200 space-y-3">
            <h4 class="font-bold text-xs text-sky-950 uppercase tracking-wider flex items-center gap-2">
                Profil Mode Aksesibilitas
            </h4>
            <div class="grid grid-cols-2 gap-2">
                <button type="button" data-profile="colorblind"
                    class="btn-profile flex items-center gap-2 p-2.5 rounded-lg border border-sky-300 text-xs font-bold text-sky-950 bg-white hover:bg-sky-100 transition-all focus:outline-none focus:ring-2 focus:ring-blue-600 shadow-sm">
                    <i class="bi bi-eye text-sky-700 text-base" aria-hidden="true"></i> Buta Warna
                </button>
                <button type="button" data-profile="dyslexia"
                    class="btn-profile flex items-center gap-2 p-2.5 rounded-lg border border-sky-300 text-xs font-bold text-sky-950 bg-white hover:bg-sky-100 transition-all focus:outline-none focus:ring-2 focus:ring-blue-600 shadow-sm">
                    <i class="bi bi-fonts text-sky-700 text-base" aria-hidden="true"></i> Disleksia
                </button>
                <button type="button" data-profile="adhd"
                    class="btn-profile flex items-center gap-2 p-2.5 rounded-lg border border-sky-300 text-xs font-bold text-sky-950 bg-white hover:bg-sky-100 transition-all focus:outline-none focus:ring-2 focus:ring-blue-600 shadow-sm">
                    <i class="bi bi-crosshair text-sky-700 text-base" aria-hidden="true"></i> Fokus ADHD
                </button>
                <button type="button" data-profile="epilepsy"
                    class="btn-profile flex items-center gap-2 p-2.5 rounded-lg border border-sky-300 text-xs font-bold text-sky-950 bg-white hover:bg-sky-100 transition-all focus:outline-none focus:ring-2 focus:ring-blue-600 shadow-sm">
                    <i class="bi bi-shield-slash text-sky-700 text-base" aria-hidden="true"></i> Kejang &amp; Epilepsi
                </button>
                <button type="button" data-profile="blindness"
                    class="btn-profile col-span-2 flex items-center justify-center gap-2 p-2.5 rounded-lg border border-sky-700 text-xs font-bold text-white bg-sky-700 hover:bg-sky-800 transition-all focus:outline-none focus:ring-2 focus:ring-blue-600 shadow-sm">
                    <i class="bi bi-volume-up-fill text-base" aria-hidden="true"></i> Netra Total (Pembaca Layar)
                </button>
            </div>
        </section>

        <!-- 1. MODE KONTRAS (Visual Theme) -->
        <section class="bg-gray-50 p-4 rounded-xl border border-gray-200 space-y-3">
            <h4 class="font-bold text-xs text-gray-900 uppercase tracking-wider flex items-center gap-2">
                Mode Kontras Visual
            </h4>
            <div class="grid grid-cols-2 gap-2">
                <button type="button" data-contrast="normal"
                    class="btn-contrast flex items-center gap-2 p-2.5 rounded-lg border border-gray-400 text-xs font-bold text-gray-900 bg-white hover:bg-gray-100 transition-all focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <span class="w-4 h-4 rounded-full bg-white border border-gray-500 shrink-0"></span> Normal
                </button>
                <button type="button" data-contrast="yellow-black"
                    class="btn-contrast flex items-center gap-2 p-2.5 rounded-lg border border-yellow-500 text-xs font-bold text-yellow-300 bg-black hover:bg-gray-900 transition-all focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    <span class="w-4 h-4 rounded-full bg-yellow-400 border border-yellow-600 shrink-0"></span>
                    Hitam-Kuning
                </button>
                <button type="button" data-contrast="high-light"
                    class="btn-contrast flex items-center gap-2 p-2.5 rounded-lg border border-black text-xs font-extrabold text-black bg-white hover:bg-gray-100 transition-all focus:outline-none focus:ring-2 focus:ring-black">
                    <span class="w-4 h-4 rounded-full bg-black border border-black shrink-0"></span> Kontras Terang
                </button>
                <button type="button" data-contrast="invert"
                    class="btn-contrast flex items-center gap-2 p-2.5 rounded-lg border border-purple-400 text-xs font-bold text-purple-200 bg-slate-900 hover:bg-slate-800 transition-all focus:outline-none focus:ring-2 focus:ring-purple-400">
                    <span class="w-4 h-4 rounded-full bg-purple-500 shrink-0"></span> Invert / Sepia
                </button>
            </div>
        </section>

        <!-- 2. UKURAN TEKS & TATA LETAK -->
        <section class="bg-gray-50 p-4 rounded-xl border border-gray-200 space-y-3">
            <h4 class="font-bold text-xs text-gray-900 uppercase tracking-wider flex items-center gap-2">
                Ukuran Teks &amp; Tampilan
            </h4>
            <div class="flex items-center justify-between gap-2">
                <span class="text-xs text-gray-900 font-bold">Ukuran Teks</span>
                <div class="flex items-center gap-1">
                    <button type="button" id="btn-font-dec"
                        class="px-3 py-1.5 rounded-lg bg-white border border-gray-400 text-xs font-bold hover:bg-gray-100 text-gray-900 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-600"
                        aria-label="Perkecil Ukuran Teks">A-</button>
                    <span id="font-size-label"
                        class="text-xs font-extrabold px-2 text-gray-950 min-w-[40px] text-center">100%</span>
                    <button type="button" id="btn-font-inc"
                        class="px-3 py-1.5 rounded-lg bg-white border border-gray-400 text-xs font-bold hover:bg-gray-100 text-gray-900 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-600"
                        aria-label="Perbesar Ukuran Teks">A+</button>
                    <button type="button" id="btn-font-reset"
                        class="px-2 py-1.5 rounded-lg bg-gray-200 text-xs font-bold hover:bg-gray-300 text-gray-800 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-600"
                        title="Reset Ukuran">Reset</button>
                </div>
            </div>

            <div class="flex items-center justify-between pt-2.5 border-t border-gray-200">
                <label for="toggle-large-cursor" class="text-xs text-gray-900 font-bold cursor-pointer">Kursor Besar</label>
                <div class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" id="toggle-large-cursor" class="sr-only peer">
                    <div
                        class="w-9 h-5 bg-gray-400 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-blue-600 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-400 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue-700">
                    </div>
                </div>
            </div>

            <div class="space-y-1.5 pt-2.5 border-t border-gray-200">
                <div class="flex justify-between text-xs">
                    <label for="input-line-height" class="text-gray-900 font-bold">Jarak Baris (Line Height):</label>
                    <span id="line-height-value" class="font-extrabold text-gray-950">1.5x</span>
                </div>
                <input type="range" id="input-line-height" min="1.0" max="2.5" step="0.1" value="1.5"
                    class="w-full h-1.5 bg-gray-300 rounded-lg appearance-none cursor-pointer accent-blue-700">
            </div>

            <div class="space-y-1.5 pt-2.5 border-t border-gray-200">
                <div class="flex justify-between text-xs">
                    <label for="input-letter-spacing" class="text-gray-900 font-bold">Jarak Huruf (Letter Spacing):</label>
                    <span id="letter-spacing-value" class="font-extrabold text-gray-950">Normal</span>
                </div>
                <input type="range" id="input-letter-spacing" min="0" max="6" step="0.5" value="0"
                    class="w-full h-1.5 bg-gray-300 rounded-lg appearance-none cursor-pointer accent-blue-700">
            </div>

            <div class="flex items-center justify-between pt-2.5 border-t border-gray-200">
                <label for="toggle-dyslexia-font" class="text-xs text-gray-900 font-bold cursor-pointer">Font Ramah Disleksia</label>
                <div class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" id="toggle-dyslexia-font" class="sr-only peer">
                    <div
                        class="w-9 h-5 bg-gray-400 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-blue-600 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-400 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue-700">
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. BANTUAN MEMBACA (Reading Ruler & Mask) -->
        <section class="bg-gray-50 p-4 rounded-xl border border-gray-200 space-y-3">
            <h4 class="font-bold text-xs text-gray-900 uppercase tracking-wider flex items-center gap-2">
                Bantuan Penanda Baca
            </h4>
            <div class="flex items-center justify-between">
                <label for="toggle-reading-ruler" class="text-xs text-gray-900 font-bold cursor-pointer">Penggaris Baca (Reading Ruler)</label>
                <div class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" id="toggle-reading-ruler" class="sr-only peer">
                    <div
                        class="w-9 h-5 bg-gray-400 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-blue-600 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-400 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue-700">
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-between pt-2.5 border-t border-gray-200">
                <label for="toggle-screen-mask" class="text-xs text-gray-900 font-bold cursor-pointer">Fokus Layar (Screen Mask)</label>
                <div class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" id="toggle-screen-mask" class="sr-only peer">
                    <div
                        class="w-9 h-5 bg-gray-400 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-blue-600 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-400 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue-700">
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. VOICE / SUARA (Text-To-Speech) -->
        <section class="bg-gray-50 p-4 rounded-xl border border-gray-200 space-y-3">
            <div class="flex items-center justify-between">
                <h4 class="font-bold text-xs text-gray-900 uppercase tracking-wider flex items-center gap-2">
                    Pembaca Suara (TTS)
                </h4>
                <span id="tts-status-badge"
                    class="px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-gray-300 text-gray-800">OFF</span>
            </div>

            <!-- Auto-Read Switch -->
            <div class="flex items-center justify-between p-2.5 bg-white rounded-lg border border-gray-200">
                <div class="space-y-0.5">
                    <label for="tts-toggle" class="text-xs font-bold text-gray-900 block cursor-pointer">Auto-Read (Hover &amp; Blok Teks)</label>
                    <span class="text-[10px] text-gray-700 block font-medium leading-tight">Bacakan otomatis saat kursor diarahkan atau teks diblok</span>
                </div>
                <div class="relative inline-flex items-center cursor-pointer shrink-0 ml-2">
                    <input type="checkbox" id="tts-toggle" class="sr-only peer">
                    <div
                        class="w-9 h-5 bg-gray-400 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-blue-600 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-400 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue-700">
                    </div>
                </div>
            </div>

            <!-- Playback Control Buttons -->
            <div class="grid grid-cols-3 gap-2 pt-1">
                <button type="button" id="tts-play"
                    class="flex items-center justify-center gap-1 py-2 px-3 rounded-lg bg-sky-100 text-sky-900 hover:bg-sky-200 font-bold text-xs border border-sky-300 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <i class="bi bi-play-fill text-base" aria-hidden="true"></i> Putar
                </button>
                <button type="button" id="tts-pause"
                    class="flex items-center justify-center gap-1 py-2 px-3 rounded-lg bg-amber-100 text-amber-900 hover:bg-amber-200 font-bold text-xs border border-amber-300 transition-colors focus:outline-none focus:ring-2 focus:ring-amber-600">
                    <i class="bi bi-pause-fill text-base" aria-hidden="true"></i> Jeda
                </button>
                <button type="button" id="tts-stop"
                    class="flex items-center justify-center gap-1 py-2 px-3 rounded-lg bg-rose-100 text-rose-900 hover:bg-rose-200 font-bold text-xs border border-rose-300 transition-colors focus:outline-none focus:ring-2 focus:ring-rose-600">
                    <i class="bi bi-square-fill text-[10px]" aria-hidden="true"></i> Stop
                </button>
            </div>

            <!-- Sliders for Rate & Pitch -->
            <div class="space-y-2.5 pt-2 border-t border-gray-200">
                <div class="space-y-1">
                    <div class="flex justify-between text-xs">
                        <label for="tts-rate" class="text-gray-900 font-bold">Kecepatan Suara:</label>
                        <span id="rate-value" class="font-extrabold text-gray-950">1.0x</span>
                    </div>
                    <input type="range" id="tts-rate" min="0.5" max="1.5" step="0.1" value="1.0"
                        class="w-full h-1.5 bg-gray-300 rounded-lg appearance-none cursor-pointer accent-blue-700">
                </div>

                <div class="space-y-1">
                    <div class="flex justify-between text-xs">
                        <label for="tts-pitch" class="text-gray-900 font-bold">Nada Suara (Pitch):</label>
                        <span id="pitch-value" class="font-extrabold text-gray-950">1.0</span>
                    </div>
                    <input type="range" id="tts-pitch" min="0.5" max="1.5" step="0.1" value="1.0"
                        class="w-full h-1.5 bg-gray-300 rounded-lg appearance-none cursor-pointer accent-blue-700">
                </div>

                <div class="space-y-1">
                    <label for="tts-lang" class="text-xs text-gray-900 font-bold block">Bahasa Pembaca:</label>
                    <select id="tts-lang"
                        class="w-full p-2 bg-white border border-gray-300 rounded-lg text-xs font-bold text-gray-900 focus:ring-2 focus:ring-blue-600 focus:outline-none">
                        <option value="id-ID" selected>Bahasa Indonesia (id-ID)</option>
                    </select>
                </div>
            </div>

            <!-- Live Text Display Box -->
            <div class="p-3 bg-white border border-gray-200 rounded-lg space-y-1">
                <span class="text-[10px] font-extrabold text-gray-600 uppercase tracking-wider block">Teks Aktif Dibaca:</span>
                <p id="tts-text-display" class="text-xs text-gray-800 italic font-semibold leading-relaxed min-h-[36px] line-clamp-3">
                    Arahkan kursor ke teks atau blok teks untuk membacakan secara otomatis.
                </p>
            </div>
        </section>

        <!-- 5. RESET BUTTON -->
        <div class="pt-1">
            <button type="button" id="btn-reset-accessibility"
                class="w-full py-2.5 px-4 rounded-xl bg-gray-200 hover:bg-gray-300 text-gray-900 font-bold text-xs transition-colors flex items-center justify-center gap-2 focus:outline-none focus:ring-2 focus:ring-blue-600">
                <i class="bi bi-arrow-counterclockwise text-sm" aria-hidden="true"></i> Reset Semua Pengaturan
            </button>
        </div>

    </div>
</aside>

<!-- Reading Ruler Element -->
<div id="accessibility-reading-ruler"
    class="fixed left-0 w-full h-9 bg-amber-300/40 border-y-2 border-amber-500 pointer-events-none z-40 hidden shadow-sm"
    style="top: 0;"></div>

<!-- Screen Focus Mask Element -->
<div id="accessibility-screen-mask" class="fixed inset-0 pointer-events-none z-40 hidden flex flex-col">
    <div id="screen-mask-top" class="bg-black/75 w-full transition-all duration-75"></div>
    <div id="screen-mask-gap"
        class="w-full h-28 border-y-2 border-sky-400 bg-transparent shrink-0 shadow-[0_0_15px_rgba(0,0,0,0.5)]"></div>
    <div id="screen-mask-bottom" class="bg-black/75 w-full flex-1 transition-all duration-75"></div>
</div>

@push('styles')
<style>
/* Mode Kontras Visual */
body.contrast-yellow-black {
    background-color: #000000 !important;
    background-image: none !important;
    color: #facc15 !important;
}
body.contrast-yellow-black *, 
body.contrast-yellow-black h1, 
body.contrast-yellow-black h2, 
body.contrast-yellow-black h3, 
body.contrast-yellow-black h4, 
body.contrast-yellow-black p, 
body.contrast-yellow-black span, 
body.contrast-yellow-black a, 
body.contrast-yellow-black label, 
body.contrast-yellow-black button, 
body.contrast-yellow-black input, 
body.contrast-yellow-black select, 
body.contrast-yellow-black textarea {
    background-color: #000000 !important;
    color: #facc15 !important;
    border-color: #facc15 !important;
}

body.contrast-high-light {
    background-color: #ffffff !important;
    background-image: none !important;
    color: #000000 !important;
}
body.contrast-high-light * {
    color: #000000 !important;
    border-color: #000000 !important;
    font-weight: 700 !important;
}

body.contrast-invert {
    filter: invert(100%) hue-rotate(180deg) !important;
}
body.contrast-invert img,
body.contrast-invert video,
body.contrast-invert iframe,
body.contrast-invert canvas {
    filter: invert(100%) hue-rotate(180deg) !important;
}

body.custom-large-cursor, 
body.custom-large-cursor * {
    cursor: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='36' height='36' viewBox='0 0 24 24' fill='%23000000' stroke='%23ffffff' stroke-width='1.5'%3E%3Cpath d='M3 3l7 18 3-7 7-3L3 3z'/%3E%3C/svg%3E"), auto !important;
}

body.custom-line-height * {
    line-height: var(--app-line-height, 1.5) !important;
}

body.custom-letter-spacing * {
    letter-spacing: var(--app-letter-spacing, 0px) !important;
}

@font-face {
    font-family: 'OpenDyslexic';
    src: url('https://cdn.jsdelivr.net/npm/open-dyslexic@1.0.3/open-dyslexic-regular.otf') format('opentype');
    font-display: swap;
}

body.dyslexia-font, 
body.dyslexia-font * {
    font-family: 'OpenDyslexic', 'Comic Sans MS', sans-serif !important;
}

body.epilepsy-safe *,
body.epilepsy-safe *::before,
body.epilepsy-safe *::after {
    animation: none !important;
    transition: none !important;
}

.tts-highlight {
    outline: 3px solid #0284c7 !important;
    background-color: #e0f2fe !important;
    border-radius: 4px;
}
body.contrast-yellow-black .tts-highlight {
    outline: 3px solid #facc15 !important;
    background-color: #334155 !important;
    color: #ffffff !important;
}
</style>
@endpush

@push('scripts')
<script>
class AccessibilityController {
  constructor() {
    this.STORAGE_KEY = "dukcapil_accessibility_settings";
    this.defaultSettings = {
      activeProfile: null,
      contrast: "normal",
      fontScale: 100,
      largeCursor: false,
      lineHeightVal: 1.5,
      letterSpacingVal: 0,
      dyslexiaFont: false,
      readingRuler: false,
      screenMask: false,
      epilepsySafe: false,
      ttsAutoRead: false,
      ttsRate: 1.0,
      ttsPitch: 1.0,
      ttsLang: "id-ID",
    };

    this.settings = { ...this.defaultSettings };
    this.speechSynth = window.speechSynthesis || null;
    this.currentUtterance = null;
    this.hoverDebounceTimer = null;
    this.currentSpokenText = "";
    this.activeElement = null;
    this.audioUnlocked = false;

    this.init();
  }

  init() {
    this.loadSettings();
    this.bindDOMEvents();
    this.applyAllSettings();
    this.setupTTSListeners();
  }

  loadSettings() {
    try {
      const saved = localStorage.getItem(this.STORAGE_KEY);
      if (saved) {
        this.settings = { ...this.defaultSettings, ...JSON.parse(saved) };
      }
    } catch (e) {
      console.warn("Unable to load accessibility settings from localStorage", e);
    }
  }

  saveSettings() {
    try {
      localStorage.setItem(this.STORAGE_KEY, JSON.stringify(this.settings));
    } catch (e) {
      console.warn("Unable to save accessibility settings to localStorage", e);
    }
  }

  unlockAudio() {
    if (this.audioUnlocked || !this.speechSynth) return;
    try {
      const silent = new SpeechSynthesisUtterance("");
      silent.volume = 0;
      this.speechSynth.speak(silent);
      this.audioUnlocked = true;
    } catch (e) {
      console.warn("Unable to unlock audio context", e);
    }
  }

  bindDOMEvents() {
    const btnToggle = document.getElementById("accessibility-btn-toggle");
    const btnClose = document.getElementById("accessibility-btn-close");
    const backdrop = document.getElementById("accessibility-backdrop");
    const panel = document.getElementById("accessibility-panel");

    if (btnToggle && panel) {
      btnToggle.addEventListener("click", () => {
        this.unlockAudio();
        this.openPanel();
      });
    }
    if (btnClose) {
      btnClose.addEventListener("click", () => this.closePanel());
    }
    if (backdrop) {
      backdrop.addEventListener("click", () => this.closePanel());
    }

    document.addEventListener("keydown", (e) => {
      if (
        e.key === "Escape" &&
        panel &&
        panel.getAttribute("aria-hidden") === "false"
      ) {
        this.closePanel();
      }
    });

    document.querySelectorAll(".btn-profile").forEach((btn) => {
      btn.addEventListener("click", (e) => {
        const profile = e.currentTarget.getAttribute("data-profile");
        this.toggleProfile(profile);
      });
    });

    document.querySelectorAll(".btn-contrast").forEach((btn) => {
      btn.addEventListener("click", (e) => {
        const mode = e.currentTarget.getAttribute("data-contrast");
        this.setContrast(mode);
      });
    });

    const btnFontInc = document.getElementById("btn-font-inc");
    const btnFontDec = document.getElementById("btn-font-dec");
    const btnFontReset = document.getElementById("btn-font-reset");

    if (btnFontInc) btnFontInc.addEventListener("click", () => this.adjustFontSize(10));
    if (btnFontDec) btnFontDec.addEventListener("click", () => this.adjustFontSize(-10));
    if (btnFontReset) btnFontReset.addEventListener("click", () => this.setFontSize(100));

    const toggleLargeCursor = document.getElementById("toggle-large-cursor");
    const inputLineHeight = document.getElementById("input-line-height");
    const inputLetterSpacing = document.getElementById("input-letter-spacing");
    const toggleDyslexiaFont = document.getElementById("toggle-dyslexia-font");
    const toggleReadingRuler = document.getElementById("toggle-reading-ruler");
    const toggleScreenMask = document.getElementById("toggle-screen-mask");

    if (toggleLargeCursor) {
      toggleLargeCursor.addEventListener("change", (e) => {
        this.settings.largeCursor = e.target.checked;
        this.applyLargeCursor();
        this.saveSettings();
      });
    }

    if (inputLineHeight) {
      inputLineHeight.addEventListener("input", (e) => {
        this.settings.lineHeightVal = parseFloat(e.target.value);
        this.applyLineHeight();
        this.saveSettings();
      });
    }

    if (inputLetterSpacing) {
      inputLetterSpacing.addEventListener("input", (e) => {
        this.settings.letterSpacingVal = parseFloat(e.target.value);
        this.applyLetterSpacing();
        this.saveSettings();
      });
    }

    if (toggleDyslexiaFont) {
      toggleDyslexiaFont.addEventListener("change", (e) => {
        this.settings.dyslexiaFont = e.target.checked;
        this.applyDyslexiaFont();
        this.saveSettings();
      });
    }

    if (toggleReadingRuler) {
      toggleReadingRuler.addEventListener("change", (e) => {
        this.settings.readingRuler = e.target.checked;
        this.applyReadingRuler();
        this.saveSettings();
      });
    }

    if (toggleScreenMask) {
      toggleScreenMask.addEventListener("change", (e) => {
        this.settings.screenMask = e.target.checked;
        this.applyScreenMask();
        this.saveSettings();
      });
    }

    const updatePointerPosition = (clientY) => {
      const ruler = document.getElementById("accessibility-reading-ruler");
      if (this.settings.readingRuler && ruler) {
        ruler.style.top = `${clientY - 18}px`;
      }

      const maskTop = document.getElementById("screen-mask-top");
      if (this.settings.screenMask && maskTop) {
        const gapHeight = 112;
        const topHeight = Math.max(0, clientY - gapHeight / 2);
        maskTop.style.height = `${topHeight}px`;
      }
    };

    document.addEventListener("mousemove", (e) => updatePointerPosition(e.clientY));
    document.addEventListener(
      "touchmove",
      (e) => {
        if (e.touches && e.touches.length > 0) {
          updatePointerPosition(e.touches[0].clientY);
        }
      },
      { passive: true }
    );

    const ttsToggle = document.getElementById("tts-toggle");
    const ttsPlay = document.getElementById("tts-play");
    const ttsPause = document.getElementById("tts-pause");
    const ttsStop = document.getElementById("tts-stop");
    const ttsRate = document.getElementById("tts-rate");
    const ttsPitch = document.getElementById("tts-pitch");
    const ttsLang = document.getElementById("tts-lang");

    if (ttsToggle) {
      ttsToggle.addEventListener("change", (e) => {
        this.unlockAudio();
        this.settings.ttsAutoRead = e.target.checked;
        this.updateTTSBadge();
        if (!this.settings.ttsAutoRead) {
          this.stopSpeech();
        }
        this.saveSettings();
      });
    }

    if (ttsPlay) {
      ttsPlay.addEventListener("click", () => {
        this.unlockAudio();
        if (this.currentSpokenText) {
          this.speakText(this.currentSpokenText);
        } else {
          const fallbackText = document.title || "Dinas Kependudukan dan Pencatatan Sipil Kabupaten Tapin";
          this.speakText(fallbackText);
        }
      });
    }

    if (ttsPause) {
      ttsPause.addEventListener("click", () => this.pauseSpeech());
    }

    if (ttsStop) {
      ttsStop.addEventListener("click", () => this.stopSpeech());
    }

    if (ttsRate) {
      ttsRate.addEventListener("input", (e) => {
        this.settings.ttsRate = parseFloat(e.target.value);
        const rateLabel = document.getElementById("rate-value");
        if (rateLabel) rateLabel.textContent = `${this.settings.ttsRate.toFixed(1)}x`;
        this.saveSettings();
      });
    }

    if (ttsPitch) {
      ttsPitch.addEventListener("input", (e) => {
        this.settings.ttsPitch = parseFloat(e.target.value);
        const pitchLabel = document.getElementById("pitch-value");
        if (pitchLabel) pitchLabel.textContent = `${this.settings.ttsPitch.toFixed(1)}`;
        this.saveSettings();
      });
    }

    if (ttsLang) {
      ttsLang.addEventListener("change", (e) => {
        this.settings.ttsLang = e.target.value;
        this.saveSettings();
      });
    }

    const btnReset = document.getElementById("btn-reset-accessibility");
    if (btnReset) {
      btnReset.addEventListener("click", () => this.resetAllSettings());
    }
  }

  openPanel() {
    const panel = document.getElementById("accessibility-panel");
    const backdrop = document.getElementById("accessibility-backdrop");
    if (panel) {
      panel.classList.remove("translate-x-full");
      panel.setAttribute("aria-hidden", "false");
    }
    if (backdrop) {
      backdrop.classList.remove("hidden");
    }
    document.body.style.overflow = "hidden";
  }

  closePanel() {
    const panel = document.getElementById("accessibility-panel");
    const backdrop = document.getElementById("accessibility-backdrop");
    if (panel) {
      panel.classList.add("translate-x-full");
      panel.setAttribute("aria-hidden", "true");
    }
    if (backdrop) {
      backdrop.classList.add("hidden");
    }
    document.body.style.overflow = "";
  }

  setContrast(mode) {
    this.settings.contrast = mode;
    this.applyContrast();
    this.saveSettings();
  }

  applyContrast() {
    document.body.classList.remove("contrast-yellow-black", "contrast-high-light", "contrast-invert");

    if (this.settings.contrast === "yellow-black") {
      document.body.classList.add("contrast-yellow-black");
    } else if (this.settings.contrast === "high-light") {
      document.body.classList.add("contrast-high-light");
    } else if (this.settings.contrast === "invert") {
      document.body.classList.add("contrast-invert");
    }
  }

  adjustFontSize(delta) {
    let newScale = this.settings.fontScale + delta;
    if (newScale < 80) newScale = 80;
    if (newScale > 140) newScale = 140;
    this.setFontSize(newScale);
  }

  setFontSize(scale) {
    this.settings.fontScale = scale;
    this.applyFontSize();
    this.saveSettings();
  }

  applyFontSize() {
    document.documentElement.style.fontSize = `${this.settings.fontScale}%`;
    const fontLabel = document.getElementById("font-size-label");
    if (fontLabel) {
      fontLabel.textContent = `${this.settings.fontScale}%`;
    }
  }

  applyLargeCursor() {
    const toggle = document.getElementById("toggle-large-cursor");
    if (toggle) toggle.checked = this.settings.largeCursor;

    if (this.settings.largeCursor) {
      document.body.classList.add("custom-large-cursor");
    } else {
      document.body.classList.remove("custom-large-cursor");
    }
  }

  applyLineHeight() {
    const input = document.getElementById("input-line-height");
    const label = document.getElementById("line-height-value");
    const val = this.settings.lineHeightVal || 1.5;

    if (input) input.value = val;
    if (label) label.textContent = `${val.toFixed(1)}x`;

    if (val > 1.0) {
      document.body.classList.add("custom-line-height");
      document.body.style.setProperty("--app-line-height", val);
    } else {
      document.body.classList.remove("custom-line-height");
      document.body.style.removeProperty("--app-line-height");
    }
  }

  applyLetterSpacing() {
    const input = document.getElementById("input-letter-spacing");
    const label = document.getElementById("letter-spacing-value");
    const val = this.settings.letterSpacingVal ?? 0;

    if (input) input.value = val;
    if (label) label.textContent = val === 0 ? "Normal" : `${val}px`;

    if (val > 0) {
      document.body.classList.add("custom-letter-spacing");
      document.body.style.setProperty("--app-letter-spacing", `${val}px`);
    } else {
      document.body.classList.remove("custom-letter-spacing");
      document.body.style.removeProperty("--app-letter-spacing");
    }
  }

  applyDyslexiaFont() {
    const toggle = document.getElementById("toggle-dyslexia-font");
    if (toggle) toggle.checked = this.settings.dyslexiaFont;

    if (this.settings.dyslexiaFont) {
      document.body.classList.add("dyslexia-font");
    } else {
      document.body.classList.remove("dyslexia-font");
    }
  }

  applyReadingRuler() {
    const toggle = document.getElementById("toggle-reading-ruler");
    const ruler = document.getElementById("accessibility-reading-ruler");
    if (toggle) toggle.checked = this.settings.readingRuler;

    if (ruler) {
      if (this.settings.readingRuler) {
        ruler.classList.remove("hidden");
      } else {
        ruler.classList.add("hidden");
      }
    }
  }

  applyScreenMask() {
    const toggle = document.getElementById("toggle-screen-mask");
    const mask = document.getElementById("accessibility-screen-mask");
    if (toggle) toggle.checked = this.settings.screenMask;

    if (mask) {
      if (this.settings.screenMask) {
        mask.classList.remove("hidden");
      } else {
        mask.classList.add("hidden");
      }
    }
  }

  applyEpilepsySafe() {
    if (this.settings.epilepsySafe) {
      document.body.classList.add("epilepsy-safe");
    } else {
      document.body.classList.remove("epilepsy-safe");
    }
  }

  toggleProfile(profileName) {
    if (this.settings.activeProfile === profileName) {
      this.resetAllSettings();
      return;
    }

    this.settings.activeProfile = profileName;

    this.settings.contrast = "normal";
    this.settings.fontScale = 100;
    this.settings.largeCursor = false;
    this.settings.lineHeightVal = 1.0;
    this.settings.letterSpacingVal = 0;
    this.settings.dyslexiaFont = false;
    this.settings.readingRuler = false;
    this.settings.screenMask = false;
    this.settings.epilepsySafe = false;
    this.settings.ttsAutoRead = false;

    switch (profileName) {
      case "colorblind":
        this.settings.contrast = "high-light";
        this.settings.largeCursor = true;
        break;
      case "dyslexia":
        this.settings.dyslexiaFont = true;
        this.settings.letterSpacingVal = 2;
        this.settings.lineHeightVal = 1.8;
        break;
      case "adhd":
        this.settings.readingRuler = true;
        this.settings.screenMask = true;
        break;
      case "epilepsy":
        this.settings.epilepsySafe = true;
        break;
      case "blindness":
        this.settings.ttsAutoRead = true;
        this.settings.contrast = "yellow-black";
        this.settings.largeCursor = true;
        this.unlockAudio();
        break;
    }

    this.applyAllSettings();
    this.saveSettings();
  }

  updateProfileUI() {
    document.querySelectorAll(".btn-profile").forEach((btn) => {
      const p = btn.getAttribute("data-profile");
      if (p === this.settings.activeProfile) {
        btn.classList.add("ring-2", "ring-blue-600", "bg-sky-100");
      } else {
        btn.classList.remove("ring-2", "ring-blue-600", "bg-sky-100");
      }
    });
  }

  applyAllSettings() {
    this.applyContrast();
    this.applyFontSize();
    this.applyLargeCursor();
    this.applyLineHeight();
    this.applyLetterSpacing();
    this.applyDyslexiaFont();
    this.applyReadingRuler();
    this.applyScreenMask();
    this.applyEpilepsySafe();
    this.updateTTSUI();
    this.updateProfileUI();
  }

  updateTTSUI() {
    const ttsToggle = document.getElementById("tts-toggle");
    const ttsRate = document.getElementById("tts-rate");
    const ttsPitch = document.getElementById("tts-pitch");
    const ttsLang = document.getElementById("tts-lang");

    if (ttsToggle) ttsToggle.checked = this.settings.ttsAutoRead;
    if (ttsRate) {
      ttsRate.value = this.settings.ttsRate;
      const rateLabel = document.getElementById("rate-value");
      if (rateLabel) rateLabel.textContent = `${this.settings.ttsRate.toFixed(1)}x`;
    }
    if (ttsPitch) {
      ttsPitch.value = this.settings.ttsPitch;
      const pitchLabel = document.getElementById("pitch-value");
      if (pitchLabel) pitchLabel.textContent = `${this.settings.ttsPitch.toFixed(1)}`;
    }
    if (ttsLang) ttsLang.value = this.settings.ttsLang;

    this.updateTTSBadge();
  }

  updateTTSBadge() {
    const badge = document.getElementById("tts-status-badge");
    if (badge) {
      if (this.settings.ttsAutoRead) {
        badge.textContent = "ON";
        badge.className = "px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-emerald-100 text-emerald-900";
      } else {
        badge.textContent = "OFF";
        badge.className = "px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-gray-300 text-gray-800";
      }
    }
  }

  resetAllSettings() {
    this.settings = { ...this.defaultSettings };
    this.saveSettings();
    this.applyAllSettings();
    this.stopSpeech();
  }

  setupTTSListeners() {
    const selector = "p, h1, h2, h3, h4, li, blockquote, a, td, th, article";

    const handleReadElement = (target) => {
      if (!this.settings.ttsAutoRead || !target) return;
      if (
        target.closest("#accessibility-panel") ||
        target.closest("#accessibility-widget-trigger")
      ) {
        return;
      }

      const text =
        target.innerText ||
        target.getAttribute("aria-label") ||
        target.getAttribute("alt") ||
        "";
      const cleanedText = text.trim();

      if (!cleanedText || cleanedText === this.currentSpokenText) return;

      clearTimeout(this.hoverDebounceTimer);
      this.hoverDebounceTimer = setTimeout(() => {
        this.highlightElement(target);
        this.speakText(cleanedText);
      }, 200);
    };

    document.addEventListener("mouseover", (e) => {
      const target = e.target.closest(selector);
      handleReadElement(target);
    });

    document.addEventListener("click", (e) => {
      if (!this.settings.ttsAutoRead) return;
      const target = e.target.closest(selector);
      if (target) {
        this.unlockAudio();
        handleReadElement(target);
      }
    });

    const handleSelection = () => {
      if (!this.settings.ttsAutoRead) return;
      const selectedText = window.getSelection().toString().trim();
      if (selectedText.length > 0) {
        clearTimeout(this.hoverDebounceTimer);
        this.removeHighlight();
        this.speakText(selectedText);
      }
    };

    document.addEventListener("mouseup", handleSelection);
    document.addEventListener("touchend", () => {
      setTimeout(handleSelection, 100);
    });
  }

  highlightElement(el) {
    this.removeHighlight();
    if (el) {
      this.activeElement = el;
      el.classList.add("tts-highlight");
    }
  }

  removeHighlight() {
    if (this.activeElement) {
      this.activeElement.classList.remove("tts-highlight");
      this.activeElement = null;
    }
  }

  speakText(text) {
    if (!text) return;

    this.currentSpokenText = text;
    const display = document.getElementById("tts-text-display");
    if (display) {
      display.textContent = text;
    }

    if (this.speechSynth) {
      this.stopSpeech();

      const utterance = new SpeechSynthesisUtterance(text);
      utterance.rate = this.settings.ttsRate;
      utterance.pitch = this.settings.ttsPitch;
      utterance.lang = this.settings.ttsLang;

      const voices = this.speechSynth.getVoices();
      const langPrefix = this.settings.ttsLang.split("-")[0];
      const matchingVoice =
        voices.find(
          (v) =>
            v.lang.startsWith(langPrefix) &&
            (v.name.includes("Female") ||
              v.name.includes("Perempuan") ||
              v.name.includes("Google") ||
              v.name.includes("Indonesian"))
        ) || voices.find((v) => v.lang.startsWith(langPrefix));

      if (matchingVoice) {
        utterance.voice = matchingVoice;
      }

      utterance.onend = () => this.removeHighlight();
      utterance.onerror = () => this.removeHighlight();

      this.currentUtterance = utterance;
      this.speechSynth.speak(utterance);
    } else {
      this.speakFallbackAPI(text);
    }
  }

  pauseSpeech() {
    if (this.speechSynth && this.speechSynth.speaking) {
      if (this.speechSynth.paused) {
        this.speechSynth.resume();
      } else {
        this.speechSynth.pause();
      }
    }
  }

  stopSpeech() {
    if (this.speechSynth) {
      this.speechSynth.cancel();
    }
    this.removeHighlight();
  }

  async speakFallbackAPI(text) {
    try {
      const baseUrl = "https://texttospeech.responsivevoice.org/v1/text:synthesize";
      const params = new URLSearchParams({
        text: text,
        lang: this.settings.ttsLang.split("-")[0] || "id",
        engine: "g3",
        name: "Indonesian Female",
        pitch: this.settings.ttsPitch,
        rate: this.settings.ttsRate,
        volume: 1,
        key: "TscFPj66",
        gender: "female",
      });

      if (this.fallbackAudio) {
        this.fallbackAudio.pause();
      }

      const response = await fetch(`${baseUrl}?${params.toString()}`);
      if (!response.ok) throw new Error("Fallback TTS Failed");
      const blob = await response.blob();
      const audioUrl = URL.createObjectURL(blob);
      this.fallbackAudio = new Audio(audioUrl);
      this.fallbackAudio.play();
      this.fallbackAudio.onended = () => this.removeHighlight();
    } catch (err) {
      console.error("Fallback TTS Error:", err);
    }
  }
}

document.addEventListener("DOMContentLoaded", () => {
  window.dukcapilAccessibility = new AccessibilityController();
});
</script>
@endpush
@endif

