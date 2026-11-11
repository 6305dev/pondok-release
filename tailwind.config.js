/** @type {import('tailwindcss').Config} */
export default {
    // Semua kelas Tailwind discan dari seluruh template Blade
    content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    // Konfigurasi terpusat — sebelumnya terduplikasi inline
    // di layouts/admin.blade.php via tailwind.config CDN
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', 'sans-serif'],
                title: ['Plus Jakarta Sans', 'sans-serif'],
            },
        },
    },

    plugins: [],
};
