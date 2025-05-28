<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Verification Code - Blog CMS</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8fafc;
        }

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            width: 60px;
            height: 60px;
            background-color: #10b981;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .otp-code {
            font-size: 36px;
            font-weight: bold;
            color: #10b981;
            text-align: center;
            letter-spacing: 8px;
            margin: 30px 0;
            padding: 20px;
            background-color: #f0fdf4;
            border: 2px dashed #10b981;
            border-radius: 8px;
        }

        .warning {
            background-color: #fef3cd;
            border: 1px solid #fecaca;
            border-radius: 6px;
            padding: 15px;
            margin: 20px 0;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            color: #6b7280;
            font-size: 14px;
        }

        .button {
            display: inline-block;
            background-color: #10b981;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <svg width="30" height="30" fill="white" viewBox="0 0 24 24">
                    <path
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h1 style="color: #1f2937; margin: 0;">Verification Code</h1>
            <p style="color: #6b7280; margin: 10px 0 0 0;">Blog CMS Security</p>
        </div>

        <p>Hello {{ $user->name }},</p>

        <p>You requested a verification code to access your Blog CMS account. Please use the code below to complete your
            login:</p>

        <div class="otp-code">{{ $otp_code }}</div>

        <div class="warning">
            <strong>⚠️ Important Security Information:</strong>
            <ul style="margin: 10px 0; padding-left: 20px;">
                <li>This code will expire in <strong>5 minutes</strong></li>
                <li>Never share this code with anyone</li>
                <li>Blog CMS will never ask for this code via phone or email</li>
                <li>If you didn't request this code, please ignore this email</li>
            </ul>
        </div>

        <p>If you're having trouble with the verification process, you can also click the button below:</p>

        <div style="text-align: center;">
            <a href="{{ route('otp.show') }}" class="button">Verify My Account</a>
        </div>

        <p>For your security, this verification code can only be used once and will expire automatically.</p>

        <div class="footer">
            <p><strong>Blog CMS Security Team</strong></p>
            <p>This is an automated message. Please do not reply to this email.</p>
            <p>If you need help, contact our support team at <a
                    href="mailto:support@blogcms.com">support@blogcms.com</a></p>
            <p style="margin-top: 20px;">
                <small>
                    Sent at {{ now()->format('M d, Y \a\t g:i A') }} ({{ now()->timezone->getName() }})
                </small>
            </p>
        </div>
    </div>
</body>

</html>
