<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f4f6f9; margin: 0; padding: 0; color: #333; }
        .container { width: 100%; max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-radius: 8px; margin-top: 40px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .header { text-align: center; padding-bottom: 20px; border-bottom: 1px solid #eee; }
        .header h1 { color: #d11e1f; margin: 0; font-size: 24px; }
        .content { padding: 30px 20px; text-align: center; }
        .btn { display: inline-block; background-color: #d11e1f; color: #ffffff; padding: 12px 25px; border-radius: 5px; text-decoration: none; font-weight: bold; margin-top: 20px; }
        .btn:hover { background-color: #b71c1c; }
        .footer { font-size: 12px; color: #777; text-align: center; margin-top: 30px; border-top: 1px solid #eee; padding-top: 20px; }
        .link-alt { font-size: 11px; color: #1a5c9a; word-break: break-all; margin-top: 10px; }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h1>Homeschooling Carnation</h1>
        </div>

        <div class="content">
            <h2>Permintaan Reset Password</h2>
            <p>Halo,</p>
            <p>Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda.</p>
            
            <a href="{{ $url }}" class="btn">Reset Password Saya</a>

            <p style="margin-top: 30px; font-size: 14px;">Link reset password ini akan kadaluarsa dalam 60 menit.</p>
            <p style="font-size: 14px;">Jika Anda tidak meminta reset password, abaikan saja email ini.</p>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} Homeschooling Carnation Cirebon. All rights reserved.<br>
            Jl. Ciremai Raya No. E 12 Perumnas, Cirebon.
            
            <div class="link-alt">
                <p>Jika tombol di atas tidak berfungsi, salin dan tempel link berikut ke browser Anda:</p>
                {{ $url }}
            </div>
        </div>
    </div>

</body>
</html>