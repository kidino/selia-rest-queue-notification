<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding: 20px 0;
        }
        .header h1 {
            color: #333;
        }
        .content {
            text-align: center;
            padding: 20px;
        }
        .button {
            display: inline-block;
            padding: 12px 20px;
            margin-top: 20px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #777;
        }
        @media (max-width: 600px) {
            .container {
                padding: 15px;
            }
            .content {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $title }}</h1>
        </div>
        <div class="content">
            <p>{{ $user->name }},</p>
            <p>Anda telah mendaftar dengan email {{ $user->email }}.</p>
            <p>Thank you for joining us! We're excited to have you on board.</p>
            <p>Click the button below to get started:</p>
            <a href="https://aplikasi.test/login" class="button">Login di sini</a>
        </div>
        <div class="footer">
            <p>If you have any questions, feel free to contact us.</p>
            <p>&copy; 2025 Taming Tech Sdn Bhd. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
