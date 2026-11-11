<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f6f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333333;">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f4f6f9; padding: 30px 15px;">
        <tr>
            <td align="center">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);">
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #1e3a8a, #0284c7); padding: 30px; text-align: center;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 24px; font-weight: 700; letter-spacing: 0.5px;">
                                {{ config('app.name', 'Pondok App') }}
                            </h1>
                            <p style="color: #e0f2fe; margin: 8px 0 0 0; font-size: 14px;">
                                Permintaan Atur Ulang Kata Sandi
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
                                Kami menerima permintaan untuk mengatur ulang kata sandi (password) akun Anda di <strong>{{ config('app.name', 'Pondok App') }}</strong>.
                            </p>
                            <p style="font-size: 14px; line-height: 1.6; color: #4b5563; margin: 0 0 25px 0;">
                                Klik tombol di bawah ini untuk membuat kata sandi baru:
                            </p>

                            <!-- Reset Button -->
                            <div style="text-align: center; margin-bottom: 30px;">
                                <a href="{{ $resetUrl }}" style="display: inline-block; background-color: #0284c7; color: #ffffff; text-decoration: none; font-size: 15px; font-weight: 600; padding: 14px 32px; border-radius: 8px; box-shadow: 0 2px 6px rgba(2, 132, 199, 0.4);">
                                    Atur Ulang Password
                                </a>
                            </div>

                            <div style="background-color: #fef2f2; border-left: 4px solid #ef4444; border-radius: 4px; padding: 15px; margin-bottom: 25px;">
                                <p style="font-size: 13px; color: #991b1b; margin: 0; line-height: 1.5;">
                                    <strong>Perhatian:</strong> Tautan ini hanya berlaku selama <strong>15 menit</strong>. Jika Anda tidak merasa meminta reset kata sandi, abaikan email ini dan kata sandi Anda akan tetap aman.
                                </p>
                            </div>

                            <p style="font-size: 13px; line-height: 1.5; color: #6b7280; margin: 0 0 10px 0;">
                                Jika tombol di atas bermasalah, salin tautan berikut ke peramban (browser) Anda:
                            </p>
                            <p style="font-size: 12px; word-break: break-all; color: #0284c7; margin: 0;">
                                <a href="{{ $resetUrl }}" style="color: #0284c7; text-decoration: underline;">{{ $resetUrl }}</a>
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f9fafb; border-top: 1px solid #e5e7eb; padding: 20px 30px; text-align: center;">
                            <p style="font-size: 12px; color: #9ca3af; margin: 0 0 6px 0;">
                                Email ini dikirimkan secara otomatis untuk tujuan keamanan akun Anda.
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
