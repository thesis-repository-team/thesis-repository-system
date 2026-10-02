<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <title>Verify Your Email</title>
</head>

<body style="margin: 0; padding: 0; background-color: #f4f6f8; font-family: Arial, sans-serif;">
    <div style="max-width: 600px; margin: 40px auto; background-color: #ffffff; padding: 40px; border-radius: 10px;">
        <div style="text-align: center; margin-bottom: 30px;">
            <h2 style="margin: 0; color: #0000a0; font-size: 24px;">
                Life University
            </h2>
            <p style="margin: 8px 0 0; color: #6b7280; font-size: 15px;">
                A Digital Thesis Repository Platform at Life University
            </p>
        </div>
        <h3 style="color: #111827; font-size: 20px; margin-bottom: 15px;">
            Welcome, {{ $user->name ?? $user->username }}! 👋🏻
        </h3>

        <p style="color: #374151; font-size: 15px; line-height: 1.7;">
            Thank you for joining the Life University Thesis Repository.
            Your account has been successfully created, and you're almost ready to explore our collection of academic
            research.
        </p>

        <p style="color: #374151; font-size: 15px; line-height: 1.7;">
            Please verify your email address to activate your account and get started.
        </p>

        <div style="text-align: center; margin: 32px 0;">
            <a href="{{ $url }}"
                style="
                display: inline-block;
                padding: 13px 28px;
                background-color: #0000a0;
                color: #ffffff;
                text-decoration: none;
                border-radius: 6px;
                font-size: 15px;
                font-weight: bold;
            ">
                Verify My Email
            </a>
        </div>

        <p style="color: #6b7280; font-size: 13px; line-height: 1.6;">
            Once your email is verified, you can browse and access
            research works available in the repository.
        </p>

        <p style="color: #6b7280; font-size: 13px; line-height: 1.6;">
            If you did not create this account, you can safely ignore this email.
        </p>

        <div style="border-top: 1px solid #e5e7eb; margin-top: 30px; padding-top: 20px;">
            <p style="color: #374151; font-size: 14px; line-height: 1.6; margin: 0;">
                Best regards,<br>
                <strong style="color: #0000a0;">
                    Life University Thesis Repository
                </strong>
            </p>
        </div>
    </div>
</body>

</html>
