<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktivasi Akun</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f6f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333333;">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f4f6f9; padding: 30px 15px;">
        <tr>
            <td align="center">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);">
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #1e3a8a, #3b82f6); padding: 30px; text-align: center;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 24px; font-weight: 700; letter-spacing: 0.5px;">
                                {{ config('app.name', 'Pondok App') }}
                            </h1>
                            <p style="color: #dbeafe; margin: 8px 0 0 0; font-size: 14px;">
                                Konfirmasi & Aktivasi Akun Pengguna
                            </p>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 35px 30px;">
                            <h2 style="font-size: 18px; color: #1f2937; margin: 0 0 15px 0;">
                                Halo, {{ $user->name }}!
                            </h2>
                            <p style="font-size: 14px; line-height: 1.6; color: #4b5563; margin: 0 0 25px 0;">
                                Terima kasih telah mendaftar di <strong>{{ config('app.name', 'Pondok App') }}</strong>. Untuk memastikan keamanan akun Anda, silakan aktifkan akun Anda menggunakan salah satu opsi berikut:
                            </p>

                            <!-- Option 1: 1-Click Button -->
                            <div style="text-align: center; margin-bottom: 30px;">
                                <a href="{{ $activationUrl }}" style="display: inline-block; background-color: #2563eb; color: #ffffff; text-decoration: none; font-size: 15px; font-weight: 600; padding: 14px 32px; border-radius: 8px; box-shadow: 0 2px 6px rgba(37, 99, 235, 0.4);">
                                    Aktifkan Akun Saya
                                </a>
                            </div>

                            <!-- Option 2: OTP Code -->
                            <div style="background-color: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 8px; padding: 20px; text-align: center; margin-bottom: 25px;">
                                <p style="font-size: 13px; color: #64748b; margin: 0 0 10px 0; text-transform: uppercase; font-weight: 600; letter-spacing: 1px;">
                                    Atau Masukkan Kode OTP Aktivasi:
                                </p>
                                <div style="font-size: 32px; font-weight: 800; letter-spacing: 8px; color: #1e3a8a; font-family: monospace;">
                                    {{ $otp }}
                                </div>
                                <p style="font-size: 12px; color: #94a3b8; margin: 10px 0 0 0;">
                                    Kode OTP dan tautan ini hanya berlaku selama <strong>15 menit</strong>.
                                </p>
                            </div>

                            <p style="font-size: 13px; line-height: 1.5; color: #6b7280; margin: 0 0 10px 0;">
                                Jika tombol di atas tidak dapat diklik, salin dan tempel tautan berikut di browser Anda:
                            </p>
                            <p style="font-size: 12px; word-break: break-all; color: #2563eb; margin: 0;">
                                <a href="{{ $activationUrl }}" style="color: #2563eb; text-decoration: underline;">{{ $activationUrl }}</a>
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f9fafb; border-top: 1px solid #e5e7eb; padding: 20px 30px; text-align: center;">
                            <p style="font-size: 12px; color: #9ca3af; margin: 0 0 6px 0;">
                                Pesan ini dibuat otomatis oleh sistem. Jika Anda tidak pernah merasa mendaftar di layanan ini, silakan abaikan email ini.
                            </p>
                            <p style="font-size: 12px; color: #9ca3af; margin: 0;">
                                &copy; {{ date('Y') }} {{ config('app.name', 'Pondok App') }}. Semua Hak Dilindungi.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
